# -*- coding: utf-8 -*-

"""
    作者:     Robin
    版本:     1.0
    日期:     2018/08
    文件名:    utils.py
    功能：     工具文件

    声明：小象学院拥有完全知识产权的权利；只限于善意学习者在本课程使用，
         不得在课程范围外向任何第三方散播。任何其他人或机构不得盗版、复制、仿造其中的创意，
         我们将保留一切通过法律手段追究违反者的权利
"""
import pandas as pd
from sklearn.preprocessing import LabelEncoder
from sklearn.feature_extraction.text import TfidfVectorizer, CountVectorizer
import jieba.posseg as pseg
import re
import numpy as np

import config


def load_stop_words():
    """
        加载停用词
    """
    stopwords1 = [line.rstrip() for line in open('./stop_words/中文停用词库.txt', 'r', encoding='utf-8')]
    stopwords2 = [line.rstrip() for line in open('./stop_words/哈工大停用词表.txt', 'r', encoding='utf-8')]
    stopwords3 = [line.rstrip() for line in open('./stop_words/四川大学机器智能实验室停用词库.txt', 'r', encoding='utf-8')]
    stopwords = stopwords1 + stopwords2 + stopwords3

    return stopwords


def preprocess_text(raw_text, stopwords):
    """
        文本预处理操作

        参数：
            - raw_text  原始文本

        返回：
            - proc_text 处理后的文本
    """
    # 1. 使用正则表达式去除非中文字符
    filter_pattern = re.compile('[^\u4E00-\u9FD5]+')
    chinese_only = filter_pattern.sub('', raw_text)

    # 2. 结巴分词+词性标注
    words_lst = pseg.cut(chinese_only)

    # 3. 去除停用词
    meaninful_words = []
    for word, flag in words_lst:
        # if (word not in stopwords) and (flag == 'v'):
        # 也可根据词性去除非动词等
        if word not in stopwords:
            meaninful_words.append(word)

    proc_text = ' '.join(meaninful_words)

    return proc_text


def prepare_data():
    """
        加载并处理数据集
    """
    title_df = pd.read_csv(config.title_info_filepath, usecols=['title', 'category'])

    # 清理数据
    # 去掉空值的记录
    title_df.dropna(inplace=True)

    # 加载停用词
    stopwords = load_stop_words()

    # 中文文本分词
    title_df['words'] = title_df['title'].apply(preprocess_text, args=(stopwords,))

    # 添加一列label用于模型的输入
    label_encoder = LabelEncoder()
    title_df['label'] = label_encoder.fit_transform(title_df['category'].values)

    # 清理没有分词结果的记录
    title_df = title_df[title_df['words'] != '']

    # 保存结果
    title_df[['words', 'label']].to_csv(config.proc_file, index=False)

    return title_df


def do_feature_engineering(train_data, test_data):
    """
        特征工程获取文本特征

        参数：
            - train_data    训练样本集
            - test_data     测试样本集

        返回：
            - train_X       训练特征
            - test_X        测试特征
    """
    train_proc_text = train_data['words'].values
    test_proc_text = test_data['words'].values

    # TF-IDF特征提取
    tfidf_vectorizer = TfidfVectorizer(max_features=config.n_common_words)
    train_tfidf_feat = tfidf_vectorizer.fit_transform(train_proc_text).toarray()
    test_tfidf_feat = tfidf_vectorizer.transform(test_proc_text).toarray()

    # 词袋模型
    count_vectorizer = CountVectorizer(max_features=config.n_common_words)
    train_count_feat = count_vectorizer.fit_transform(train_proc_text).toarray()
    testcount_feat = count_vectorizer.transform(test_proc_text).toarray()

    # 合并特征
    train_X = np.hstack((train_tfidf_feat, train_count_feat))
    test_X = np.hstack((test_tfidf_feat, testcount_feat))

    return train_X, test_X

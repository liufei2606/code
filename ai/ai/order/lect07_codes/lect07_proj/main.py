# -*- coding: utf-8 -*-

"""
    作者:     Robin
    版本:     1.0
    日期:     2018/10
    文件名:    lect01_eg04_project.py
    功能：     主程序

    实战案例7：基于标题对短视频进行分类

    项目描述：面对大规模的短文本形式的数据，如何快速而准确地从中获取所需的关键信息，进行文本挖掘或商业挖掘，短文本分类技术发挥着非常
            重要的作用。基于标题对短视频进行分类项目旨在结合中文分词及机器学习的相关内容完成短文本分类任务，包括文本的预处理、特征表
            示及构建分类器等知识点。该项目的实践有助于强化学员对文本相似度、文本特征及机器学习相关技术内容的理解和应用。

    声明：小象学院拥有完全知识产权的权利；只限于善意学习者在本课程使用，
         不得在课程范围外向任何第三方散播。任何其他人或机构不得盗版、复制、仿造其中的创意，
         我们将保留一切通过法律手段追究违反者的权利
"""
import os
import pandas as pd
from sklearn.model_selection import train_test_split
from sklearn.linear_model import LogisticRegression
from sklearn.model_selection import GridSearchCV
from sklearn.metrics import accuracy_score

import utils
import config


def main():
    """
        主函数
    """
    if not os.path.exists(config.proc_file):
        # 加载数据并分词
        title_df = utils.prepare_data()
    else:
        # 如果已经处理好了数据，直接读取
        title_df = pd.read_csv(config.proc_file)

    # 划分数据集
    train_data, test_data = train_test_split(title_df, test_size=1/4, random_state=0)
    print('所有样本数：{}，训练集样本数：{}，测试集样本数：{}'.format(title_df.shape[0],
                                                train_data.shape[0], test_data.shape[0]))
    print('共有{}个类别'.format(title_df['label'].unique().shape[0]))

    # 特征工程处理
    X_train, X_test = utils.do_feature_engineering(train_data, test_data)
    print('共有{}维特征。'.format(X_train.shape[1]))

    # 标签处理
    y_train = train_data['label'].values
    y_test = test_data['label'].values

    # 数据建模及验证
    clf = GridSearchCV(estimator=LogisticRegression(),
                       param_grid={'C': [0.01, 1, 100]},
                       cv=5)
    clf.fit(X_train, y_train)
    y_pred = clf.predict(X_test)

    print('准确率：', accuracy_score(y_test, y_pred))


if __name__ == '__main__':
    main()

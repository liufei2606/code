# -*- coding: utf-8 -*-

"""
    作者:     Robin
    版本:     1.0
    日期:     2018/09
    文件名:    utils.py
    功能：     工具文件

    声明：小象学院拥有完全知识产权的权利；只限于善意学习者在本课程使用，
         不得在课程范围外向任何第三方散播。任何其他人或机构不得盗版、复制、仿造其中的创意，
"""
import matplotlib.pyplot as plt
import seaborn as sns
import time
import numpy as np
from sklearn.preprocessing import LabelEncoder, OneHotEncoder, MinMaxScaler
from sklearn.decomposition import PCA
from sklearn.model_selection import GridSearchCV
from sklearn.metrics import roc_auc_score

import config


def clean_data(raw_data):
    """
        清洗数据

        参数：
            - raw_data: 原始数据

        返回：
            - cln_data: 清洗后的数据
    """
    # 替换数据中的空数据为'moderate'
    # 数据中只有Saving accounts和Checking account存在空值
    cln_data = raw_data.fillna('moderate')

    # 添加一列作为标签编码
    cln_data['Label'] = cln_data['Risk'].map(config.risk_dict)

    return cln_data


def inspect_dataset(train_data, test_data):
    """
        查看数据集

        参数：
            - train_data:   训练数据集
            - test_data:    测试数据集
    """
    print('\n===================== 数据查看 =====================')
    print('训练集有{}条记录。'.format(len(train_data)))
    print('测试集有{}条记录。'.format(len(test_data)))

    # 可视化各类别的数量统计图
    plt.figure(figsize=(10, 5))

    # 训练集
    ax1 = plt.subplot(1, 2, 1)
    sns.countplot(x='Risk', data=train_data)

    plt.title('Training set')
    plt.xlabel('Risk')
    plt.ylabel('Count')

    # 测试集
    plt.subplot(1, 2, 2, sharey=ax1)
    sns.countplot(x='Risk', data=test_data)

    plt.title('Testing set')
    plt.xlabel('Risk')
    plt.ylabel('Count')

    plt.tight_layout()
    plt.show()


def transform_train_data(train_data):
    """
        对训练数据进行特征工程处理
        1. 独热编码
        2. 范围归一化

        参数：
            - train_data: 训练数据DataFrame

        返回：
            - X_train:    转换后数据特征
            - label_encs:  标签 encoders
            - onehot_enc: 独热编码 encoder
            - scaler:     范围归一化 scaler
            - pca:        降维 pca
    """
    label_encs = []
    onehot_enc = OneHotEncoder(sparse=False)
    scaler = MinMaxScaler(feature_range=(0, 1))

    # 类别型数据
    label_feats = None
    for cat_col in config.cat_cols:
        label_enc = LabelEncoder()
        label_feat = label_enc.fit_transform(train_data[cat_col].values).reshape(-1, 1)
        if label_feats is None:
            label_feats = label_feat
        else:
            label_feats = np.hstack((label_feats, label_feat))
        label_encs.append(label_enc)

    onehot_feats = onehot_enc.fit_transform(label_feats)

    # 数值型数据
    numeric_feats = train_data[config.numeric_cols].values

    # 合并所有特征
    all_feats = np.hstack((onehot_feats, numeric_feats))

    # 范围归一化
    scaled_all_feats = scaler.fit_transform(all_feats)

    print('特征处理后，特征维度为: {}（其中类别型特征维度为: {}，数值型特征维度为: {}）'.format(
        scaled_all_feats.shape[1], onehot_feats.shape[1], numeric_feats.shape[1]))

    # 使用特征降维
    pca = PCA(n_components=0.99)
    X_train = pca.fit_transform(scaled_all_feats)

    print('PCA特征降维后，特征维度为: {}'.format(X_train.shape[1]))

    return X_train, label_encs, onehot_enc, scaler, pca


def transform_test_data(test_data, label_encs, onehot_enc, scaler, pca):
    """
        对测试数据进行特征工程处理

        参数：
            - test_data: 测试数据DataFrame
            - label_encs: 来自训练数据的标签 encoders
            - onthot_enc:来自训练数据的独热编码 encoder
            - scaler:    来自训练数据的范围归一化 scaler
            - pca:       来自训练数据的特征降维 pca

        返回：
            - X_Test:    转换后数据特征
    """
    # 类别型数据
    label_feats = None
    for i, cat_col in enumerate(config.cat_cols):
        label_enc = label_encs[i]
        label_feat = label_enc.transform(test_data[cat_col].values).reshape(-1, 1)
        if label_feats is None:
            label_feats = label_feat
        else:
            label_feats = np.hstack((label_feats, label_feat))

    # 类别型数据
    onehot_feats = onehot_enc.transform(label_feats)

    # 数值型数据
    numeric_feats = test_data[config.numeric_cols].values

    # 合并特征
    all_feats = np.hstack((onehot_feats, numeric_feats))

    # 范围归一化
    scaled_all_feats = scaler.transform(all_feats)

    # 特征降维
    X_test = pca.transform(scaled_all_feats)

    return X_test


def train_test_model(X_train, y_train, X_test, y_test, model_name, model, param_range):
    """
        训练并测试模型
        model_name:
            kNN         kNN模型，对应参数为 n_neighbors
            LR          逻辑回归模型，对应参数为 C
            SVM         支持向量机，对应参数为 C
            DT          决策树，对应参数为 max_depth
            Stacking    将kNN, SVM, DT集成的Stacking模型， meta分类器为LR
            AdaBoost    AdaBoost模型，对应参数为 n_estimators
            GBDT        GBDT模型，对应参数为 learning_rate
            RF          随机森林模型，对应参数为 n_estimators

        根据给定的参数训练模型，并返回
        1. 最优模型
        2. 平均训练耗时
        3. AUC值
    """
    print('训练{}...'.format(model_name))
    clf = GridSearchCV(estimator=model,
                       param_grid=param_range,
                       cv=5,
                       scoring='roc_auc',
                       refit=True)
    start = time.time()
    clf.fit(X_train, y_train)
    # 计时
    end = time.time()
    duration = end - start
    print('耗时{:.4f}s'.format(duration))

    # 验证模型
    y_train_pred = clf.predict_proba(X_train)[:, 1]
    train_score = roc_auc_score(y_train, y_train_pred)
    print('训练AUC：{:.3f}'.format(train_score))

    y_test_pred = clf.predict_proba(X_test)[:, 1]
    test_score = roc_auc_score(y_test, y_test_pred)
    print('测试AUC：{:.3f}'.format(test_score))
    print('训练模型耗时: {:.4f}s'.format(duration))
    print()

    return clf, test_score, duration



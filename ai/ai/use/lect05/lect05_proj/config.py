# -*- coding: utf-8 -*-

"""
    作者:     Robin
    版本:     1.0
    日期:     2018/09
    文件名:    config.py
    功能：     配置文件

    声明：小象学院拥有完全知识产权的权利；只限于善意学习者在本课程使用，
         不得在课程范围外向任何第三方散播。任何其他人或机构不得盗版、复制、仿造其中的创意，
         我们将保留一切通过法律手段追究违反者的权利
"""
import os

# 指定数据集路径
dataset_path = 'data'

# 结果保存路径
output_path = 'output'
if not os.path.exists(output_path):
    os.makedirs(output_path)

# 数值特征
numeric_cols = ['Age', 'Job', 'Credit amount', 'Duration']

# 类别特征
cat_cols = ['Sex', 'Housing', 'Saving accounts', 'Checking account', 'Purpose']

feat_cols = numeric_cols + cat_cols

# 标签列
label_col = 'Risk'

risk_dict = {
    'bad':  0,
    'good': 1
}

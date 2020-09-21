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

# 正样本图片路径
pos_im_path = 'data/pos'
# 负样本图片路径
neg_im_path = 'data/neg'

# 正样本特征保存的路径
pos_feat_path = 'feats/pos'

# 负样本特征保存的路径
neg_feat_path = 'feats/neg'

# 模型保存路径
model_path = 'models/'
# 模型文件名
model_filename = os.path.join(model_path, 'trained_svm.pkl')

# confidence score阈值
conf_score_thresh = 0.8

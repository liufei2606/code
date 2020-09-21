# -*- coding: utf-8 -*-

"""
    作者:     Robin
    版本:     1.0
    日期:     2018/10
    文件名:    config.py
    功能：     配置文件

    声明：小象学院拥有完全知识产权的权利；只限于善意学习者在本课程使用，
         不得在课程范围外向任何第三方散播。任何其他人或机构不得盗版、复制、仿造其中的创意，
         我们将保留一切通过法律手段追究违反者的权利
"""
import os

# 是否加载已经训练好的模型
load_model = False

# 训练数据和测试数据路径
train_data_dir = './data/Training'
test_data_dir = './data/Testing'

# 模型保存路径
output_path = 'output'
if not os.path.exists(output_path):
    os.makedirs(output_path)

model_file = os.path.join(output_path, 'trained_cnn_model.h5')

# 类别个数
n_classes = 62

# 图像大小
img_rows, img_cols = 32, 32

# 批大小
batch_size = 32

# 迭代次数，一个epoch表示所有训练样本的一次前向传播和一次反向传播
epochs = 100

# 是否对样本进行增强
data_augmentation = True

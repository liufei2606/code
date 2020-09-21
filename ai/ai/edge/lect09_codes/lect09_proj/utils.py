# -*- coding: utf-8 -*-

"""
    作者:     Robin
    版本:     1.0
    日期:     2018/10
    文件名:    utils.py
    功能：     工具文件，包含
                - 数据加载
                - 构建CNN

    声明：小象学院拥有完全知识产权的权利；只限于善意学习者在本课程使用，
         不得在课程范围外向任何第三方散播。任何其他人或机构不得盗版、复制、仿造其中的创意，
         我们将保留一切通过法律手段追究违反者的权利
"""

import os
import keras
from keras.preprocessing import image
from keras.models import Sequential
from keras.layers import Dense, Dropout, Flatten, Activation
from keras.layers import Conv2D, MaxPooling2D
import matplotlib.pyplot as plt
import pandas as pd
import seaborn as sns
import numpy as np


import config


def load_data(data_dir):
    """
        加载数据
        数据集地址：
            - 训练数据：https://btsd.ethz.ch/shareddata/BelgiumTSC/BelgiumTSC_Training.zip
            - 测试数据：https://btsd.ethz.ch/shareddata/BelgiumTSC/BelgiumTSC_Testing.zip
        可以安装 IrfanView 查看ppm图像：https://www.irfanview.com/
    """
    # 获取所有子目录，每个子目录为一个标签
    directories = [d for d in os.listdir(data_dir)
                   if os.path.isdir(os.path.join(data_dir, d))]
    labels = []
    images = []
    for d in directories:
        label_dir = os.path.join(data_dir, d)
        file_names = [os.path.join(label_dir, f)
                      for f in os.listdir(label_dir)
                      if f.endswith('.ppm')]
        for f in file_names:
            # 以指定的尺寸读取图像数据
            image_data = image.load_img(f, target_size=(config.img_rows, config.img_cols))
            # 将图片像素值转换为0-1
            image_data = image.img_to_array(image_data) / 255
            images.append(image_data)
            labels.append(int(d))

    print('共有{}个图像被加载。'.format(len(images)))
    # 查看各类的分布
    plt.figure(figsize=(15, 8))
    sns.countplot(pd.Series(labels))
    plt.show()

    return images, labels


def display_traffic_signs(images, labels):
    """
        查看各类图像数据
    """
    # 获取类别
    unique_labels = set(labels)

    plt.figure(figsize=(10, 10))
    for i, label in enumerate(unique_labels):
        # 选取每个类别的第一幅图像
        image_data = images[labels.index(label)]
        plt.subplot(8, 8, i + 1)
        plt.axis('off')
        # 标签，该类包含的样本个数
        plt.title('Label {0} ({1})'.format(label, labels.count(label)))
        plt.imshow(image_data)
    plt.tight_layout()
    plt.show()


def process_data(images, labels):
    """
        处理加载的图像数据和标签，用于CNN的输入
    """
    X = np.array(images)
    y = np.array(labels)
    y = keras.utils.to_categorical(y, config.n_classes)

    return X, y


def build_cnn():
    """
        构建一个CNN框架
    """
    print('构建CNN')
    input_shape = (config.img_rows, config.img_cols, 3)
    model = Sequential()

    # 第一层
    model.add(Conv2D(filters=32, kernel_size=(3, 3), padding='same', input_shape=input_shape))
    model.add(Activation('relu'))
    model.add(MaxPooling2D((2, 2)))
    model.add(Dropout(0.25))

    # 第二层
    model.add(Conv2D(filters=64, kernel_size=(3, 3), padding='same'))
    model.add(Activation('relu'))
    model.add(MaxPooling2D(pool_size=(2, 2)))
    model.add(Dropout(0.25))

    # 全连接层
    model.add(Flatten())
    model.add(Dense(512))
    model.add(Activation('relu'))
    model.add(Dropout(0.5))
    model.add(Dense(config.n_classes))
    model.add(Activation('softmax'))

    # 编译模型
    model.compile(loss='categorical_crossentropy',
                  optimizer=keras.optimizers.Adam(),
                  metrics=['accuracy'])

    print(model.summary())

    return model


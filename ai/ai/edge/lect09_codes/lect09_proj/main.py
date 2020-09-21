# -*- coding: utf-8 -*-

"""
    作者:     Robin
    版本:     1.0
    日期:     2018/10
    文件名:    lect01_eg04_project.py
    功能：     主程序

    实战案例9：交通标识自动识别
    任务：搭建深度神经网络CNN，并进行交通标识的自动识别

    数据集来源： https://btsd.ethz.ch/shareddata/

    声明：小象学院拥有完全知识产权的权利；只限于善意学习者在本课程使用，
         不得在课程范围外向任何第三方散播。任何其他人或机构不得盗版、复制、仿造其中的创意，
         我们将保留一切通过法律手段追究违反者的权利
"""
import os
from keras.preprocessing.image import ImageDataGenerator
from keras.models import load_model

import utils
import config


def main():
    """
        主函数
    """
    # 是否读取已保存的模型
    if not config.load_model:
        print('加载训练数据...')
        # 加载训练数据
        train_images, train_labels = utils.load_data(config.train_data_dir)

        # 随机显示图像数据
        utils.display_traffic_signs(train_images, train_labels)

        # 处理训练数据用于模型的输入
        X_train, y_train = utils.process_data(train_images, train_labels)

        print('训练模型...')
        # 构建CNN
        cnn_model = utils.build_cnn()

        # 是否进行图像增强处理
        if not config.data_augmentation:
            print('不进行图像增强处理...')
            # 结果：
            # 测试loss: 0.226949，测试准确率：0.96

            # 训练模型
            cnn_model.fit(X_train, y_train,
                          batch_size=config.batch_size,
                          epochs=config.epochs)
        else:
            print('进行图像增强处理...')
            # 结果：
            # 测试loss: 0.200701，测试准确率：0.96
            datagen = ImageDataGenerator(
                width_shift_range=0.1,  # 在宽度上随机偏移图像10%
                height_shift_range=0.1,  # 在高度上随机偏移图像10%
                horizontal_flip=True  # 随机水平翻转
            )

            # 在训练集上应用增强处理
            datagen.fit(X_train)
            cnn_model.fit_generator(datagen.flow(X_train, y_train, batch_size=config.batch_size),
                                    epochs=config.epochs,
                                    workers=4)
        # 保存训练好的模型
        cnn_model.save(config.model_file)

    else:
        print('加载训练好的模型...')
        if os.path.exists(config.model_file):
            cnn_model = load_model(config.model_file)
        else:
            print('{}模型文件不存在'.format(config.model_file))
            return

    print('加载测试数据...')
    # 加载测试数据
    test_images, test_labels = utils.load_data(config.test_data_dir)

    # 处理训练数据用于模型的输入
    X_test, y_test = utils.process_data(test_images, test_labels)
    test_loss, test_acc = cnn_model.evaluate(X_test, y_test)
    print('测试loss: {:.6f}，测试准确率：{:.2f}'.format(test_loss, test_acc))


if __name__ == '__main__':
    main()

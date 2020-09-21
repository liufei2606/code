# -*- coding: utf-8 -*-

"""
    作者:     Robin
    版本:     1.0
    日期:     2018/09
    文件名:    lect01_eg04_project.py
    功能：     主程序

    实战案例6：行人检测
    任务：使用机器学习方法进行对图片中的行人进行检测
    参考：https://github.com/BUPTLdy/human-detector

    声明：小象学院拥有完全知识产权的权利；只限于善意学习者在本课程使用，
         不得在课程范围外向任何第三方散播。任何其他人或机构不得盗版、复制、仿造其中的创意，
         我们将保留一切通过法律手段追究违反者的权利
"""


import utils


def main():
    """
        主函数
    """
    # 特征提取
    utils.extract_feats()

    # 读取提取的HOG特征，用于训练svm模型
    utils.train_svm()

    # 对指定目录中的图片进行行人检测
    utils.detect_person_in_path('./data/test_image')


if __name__ == '__main__':
    main()

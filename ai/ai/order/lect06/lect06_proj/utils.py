# -*- coding: utf-8 -*-

"""
    作者:     Robin
    版本:     1.0
    日期:     2018/06
    文件名:    utils.py
    功能：     工具文件，包含
                - 数据加载
                - 图像数据显示
                - 特征工程等

    声明：小象学院拥有完全知识产权的权利；只限于善意学习者在本课程使用，
         不得在课程范围外向任何第三方散播。任何其他人或机构不得盗版、复制、仿造其中的创意，
         我们将保留一切通过法律手段追究违反者的权利
"""
import os
import glob
import cv2
import numpy as np
from sklearn.svm import LinearSVC
from sklearn.externals import joblib
import imutils
from skimage.transform import pyramid_gaussian
from imutils.object_detection import non_max_suppression
import matplotlib.pyplot as plt
from skimage import img_as_ubyte

import config


def extract_feats():
    """
        提取正负样本的特征，并保存到对应的目录中
    """
    # 如果目录不存在，则创建
    if not os.path.exists(config.pos_feat_path):
        os.makedirs(config.pos_feat_path)
    if not os.path.exists(config.neg_feat_path):
        os.makedirs(config.neg_feat_path)

    print('提取正样本的特征并保存...')
    for img_path in glob.glob(os.path.join(config.pos_im_path, '*')):
        im_data = cv2.imread(img_path, cv2.IMREAD_GRAYSCALE)
        hog = cv2.HOGDescriptor()
        feat = hog.compute(im_data).flatten()
        feat_filename = os.path.split(img_path)[1].split('.')[0] + '.feat'
        feat_path = os.path.join(config.pos_feat_path, feat_filename)
        joblib.dump(feat, feat_path)
    print('正样本特征已保存至{}中'.format(config.pos_feat_path))

    print('提取负样本的特征并保存...')
    for img_path in glob.glob(os.path.join(config.neg_im_path, '*')):
        im_data = cv2.imread(img_path, cv2.IMREAD_GRAYSCALE)
        hog = cv2.HOGDescriptor()
        feat = hog.compute(im_data).flatten()
        feat_filename = os.path.split(img_path)[1].split('.')[0] + '.feat'
        feat_path = os.path.join(config.neg_feat_path, feat_filename)
        joblib.dump(feat, feat_path)
    print('负样本特征已保存至{}中'.format(config.neg_feat_path))

    print('样本提取完成')


def train_svm():
    """
        读取提取的HOG特征，用于训练svm模型
    """
    feats = []
    labels = []
    # 加载正样本特征
    for feat_path in glob.glob(os.path.join(config.pos_feat_path, '*.feat')):
        feat = joblib.load(feat_path)
        feats.append(feat)
        labels.append(1)

    # 加载负样本特征
    for feat_path in glob.glob(os.path.join(config.neg_feat_path, '*.feat')):
        feat = joblib.load(feat_path)
        feats.append(feat)
        labels.append(0)

    print('一共有{}个样本，每个样本的特征维度为{}'.format(np.array(feats).shape[0], np.array(feats).shape[1]))

    clf = LinearSVC()
    print('训练SVM分类器...')
    clf.fit(feats, labels)
    if not os.path.exists(config.model_path):
        os.makedirs(config.model_path)
    joblib.dump(clf, config.model_filename)
    print('训练好的模型已保存至', config.model_filename)


def sliding_window(image, window_size, step_size):
    """
    This function returns a patch of the input 'image' of size
    equal to 'window_size'. The first image returned top-left
    co-ordinate (0, 0) and are increment in both x and y directions
    by the 'step_size' supplied.

    So, the input parameters are-
    image - Input image
    window_size - Size of Sliding Window
    step_size - incremented Size of Window

    The function returns a tuple -
    (x, y, im_window)
    """
    for y in range(0, image.shape[0], step_size[1]):
        for x in range(0, image.shape[1], step_size[0]):
            yield (x, y, image[y: y + window_size[1], x: x + window_size[0]])


def detect_person(filename):
    im = cv2.imread(filename)
    im = imutils.resize(im, width=min(400, im.shape[1]))
    min_win_size = (64, 128)
    step_size = (10, 10)
    downscale = 1.25

    # 加载分类器
    clf = joblib.load(config.model_filename)

    detections = []
    scale = 0

    for im_scaled in pyramid_gaussian(im, downscale=downscale):
        if im_scaled.shape[0] < min_win_size[1] or im_scaled.shape[1] < min_win_size[0]:
            break
        for (x, y, im_window) in sliding_window(im_scaled, min_win_size, step_size):
            if im_window.shape[0] != min_win_size[1] or im_window.shape[1] != min_win_size[0]:
                continue
            # 转换为uint8类型
            im_window = img_as_ubyte(im_window)
            im_window = cv2.cvtColor(im_window, cv2.COLOR_BGR2GRAY)
            hog = cv2.HOGDescriptor()
            feat = hog.compute(im_window).reshape(1, -1)
            pred = clf.predict(feat)[0]
            conf_score = clf.decision_function(feat)[0]

            if pred == 1 and conf_score > config.conf_score_thresh:
                # 检测出行人
                detections.append(
                    (int(x * (downscale**scale)), int(y * (downscale**scale)),
                     conf_score,
                     int(min_win_size[0] * (downscale**scale)), int(min_win_size[1] * (downscale**scale)))
                )
        scale += 1

    clone = im.copy()

    for (x, y, _, w, h) in detections:
        cv2.rectangle(im, (x, y), (x + w, y + h), (0, 255, 0), thickness=2)

    rects = np.array([[x, y, x+w, y+h] for (x, y, _, w, h) in detections])
    scores = [score for (x, y, score, w, h) in detections]
    print('scores', scores)
    scores = np.array(scores)
    pick = non_max_suppression(rects, probs=scores, overlapThresh=0.3)
    print('形状', pick.shape)

    for(xA, yA, xB, yB) in pick:
        cv2.rectangle(clone, (xA, yA), (xB, yB), (0, 255, 0), 2)

    plt.figure()
    plt.axis('off')
    plt.imshow(cv2.cvtColor(im, cv2.COLOR_BGR2RGB))
    plt.title('Raw detection results')

    plt.figure()
    plt.axis('off')
    plt.imshow(cv2.cvtColor(clone, cv2.COLOR_BGR2RGB))
    plt.title('Final results after NMS')
    plt.show()


def detect_person_in_path(test_path):
    """
        对指定目录中的图片进行行人检测
    """
    for img_path in glob.glob(os.path.join(test_path, '*')):
        detect_person(img_path)


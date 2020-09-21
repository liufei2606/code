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

# 标题信息数据文件
title_info_filepath = 'dataset/iqiyi_title_info.csv'

# 输出路径
output_path = 'output'

# 处理好的数据文件
proc_file = os.path.join(output_path, 'proc_title.csv')

# 词频个数
n_common_words = 1000

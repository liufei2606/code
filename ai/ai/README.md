# AI

*   AI>ML>DL

## Python 语法基础

*   列表推导
*   深浅拷贝
*   高阶函数
*   lambda
*   sorted

## 数学基础

*   向量 vector
	
	*   范数 norm：表征了距离这个物理量
	*   向量以列形式表示
	*   L-0：非零元素个数
	*   曼哈顿距离：L-1 |x1| +|x2| 
	*   Lp 
	
*   矩阵 matrix

    *   相乘有可能时标量

*   张量 tensor

    *   深度

*   NumPy

*   梯度下降算法

    *   梯度:是一个向量(矢量),表示某一函数在该点处的方向导数沿着该方向
        取得最大值
        *   方向:函数在该点处沿着该方向变化最快，只有正负两种
        *   大小(模):函数在该点变化率最大,最大值为该梯度的模
        *   表示变化大小与方向
    *   cost|object function
    *   根据误差迭代，判断收敛

*   线性回归，拟合做预测

    *   SSE
    *   数据预处理,将X和Y归一化到0-1
    *   修正参数：xn-dealt*alpha

*    累计分布函数(CDF)

    *   概率质量函数(Probability Mass Function, PMF):离散随机变量在各特定取
        值上的概率
    *   概率密度函数(Probability Density Function, PDF):描述连续随机变量的输
        出值,即在某个确定的取值点附近的可能性的函数
    *   协方差(covariance)：表达了两个随机变量的协同变化关系
    *   相关系数(correlation)：是单纯反应两个变量每单位变化时的相似程度

*   Pandas

    *   数据
        *   index：immutable
        *   series:自动添加索引
        *   DataFrame：通过Column 访问列
            *   loc|iloc：取行
        *   chunk
    *   清洗
        *   去空
        *   重复
        *   分箱打标签
    *   合并：数据库连表
    *   分组
    *   可视化
    *   偏导工具（tesorflow）

    # 机器学习

    *   有监督
    *   分类：离散 label
    *   回归：连续 label
    *   聚类：no label
    *   时序分析：不能用未来数据

    ##  kNN (k-NearestNeighbor)
    
    * enlei
    * huigui
     
     ## Linear Regression
     
     * Least Square
     * 数据量小的时候,使用Least Square;
     * 数据量大的时候,可以考虑使用Gradient Descent

     ## Logistic Regression
     
     * sigmodinear ->onlinear
     * 布之间的相似度,交叉熵越小两个分布越相似
     * Softmax Regression
     * 过拟合
     * 正则化:增加泛化能力,add faultcy
        * sklearn:(C值越大),正则化越弱

## 决策树

* 信息增益(Information Gain)：割损失
* 剪枝

## 支持向量机(SVM)

* 找到一个可以分割这两个类别的边界
* 带不等式约束的优化问题
* 带等式约束的优化问题
* 拉格朗日乘子法
* 数据性不可分：核函数

## 主成分分析 Principal components analysis (PCA)

* 用于减少数据集的维度,同时保持数据集中的对方差贡献最大的特征
• 保留低阶主成分,忽略高阶成分,这样的低阶成分往往能够保留住数据的最重要
方面
* 协方差矩阵
* 特征提取
* 数据降维
* dummy variable
* 不均衡数据：恐怖分子准确率 99% 没用

## 特征工程

* 独热编码(One-Hot Encoding)
* 模型调优
    - 交叉验证 (cross validation)

## 模型评价指标

* 续:
* 阈值不均衡
    - auc
* 多分类混淆矩阵(confusion matrix)

## 集成学习 Ensemble learning

 


    ------

    ## 图书

    *   统计学习方法
    *   Python for  Data Analysis


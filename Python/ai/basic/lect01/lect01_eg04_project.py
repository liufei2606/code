# -*- coding: utf-8 -*-

"""
    作者:     Robin
    版本:     1.0
    日期:     2018/09
    文件名:    lect01_eg04_project.py
    功能：     主程序

    实战案例1：利用NumPy实现梯度下降算法预测疾病

    任务：
        - 根据体重指数(BMI)和疾病发展的定量测量值(Y)使用梯度下降算法拟合出一条直线 y_hat = aX+b

    数据集来源：http://sklearn.apachecn.org/cn/0.19.0/sklearn/datasets/descr/diabetes.html

    案例文档：lect01_proj_readme.pdf

    声明：小象学院拥有完全知识产权的权利；只限于善意学习者在本课程使用，
         不得在课程范围外向任何第三方散播。任何其他人或机构不得盗版、复制、仿造其中的创意，
         我们将保留一切通过法律手段追究违反者的权利
"""
import numpy as np
import matplotlib.pyplot as plt


def load_data():
    """
        读取数据文件，加载数据
        返回：
            - data_arr:     数据的多维数组表示
    """
    data_arr = np.loadtxt('./data/diabetes_data.csv', delimiter=' ')
    target_arr = np.loadtxt('./data/diabetes_target.csv', delimiter=' ')
    data_names = ['age', 'sex', 'BMI', 'pressure', 'S1', 'S2', 'S3', 'S4', 'S5', 'S6']
    return data_arr, target_arr, data_names


def get_gradient(theta, x, y):
    """
        根据当前的参数theta计算梯度及损失值
        参数：
            - theta:    当前使用的参数
            - x:        输入的特征
            - y:        真实标签
        返回：
            - grad:     每个参数对应的梯度（以向量的形式表示）
            - cost:     损失值
    """
    m = x.shape[0]
    y_estimate = x.dot(theta)
    error = y_estimate - y
    grad = 1.0 / m * error.dot(x)
    cost = 1.0 / (2 * m) * np.sum(error ** 2)
    return grad, cost


def gradient_descent(x, y, max_iter=1500, alpha=0.01):
    """
        梯度下降算法的实现
        参数：
            - x:        输入的特征
            - y:        真实标签
            - max_iter: 最大迭代次数，默认为1500
            - alpha:    学习率，默认为0.01
        返回：
            - theta:    学习得到的最优参数
    """
    theta = np.random.randn(2)

    # 收敛阈值
    tolerance = 1e-3

    # Perform Gradient Descent
    iterations = 1

    is_converged = False
    while not is_converged:
        grad, cost = get_gradient(theta, x, y)
        new_theta = theta - alpha * grad

        # Stopping Condition
        if np.sum(abs(new_theta - theta)) < tolerance:
            is_converged = True
            print('参数收敛')

        # Print error every 50 iterations
        if iterations % 10 == 0:
            print('第{}次迭代，损失值 {:.4f}'.format(iterations, cost))

        iterations += 1
        theta = new_theta

        if iterations > max_iter:
            is_converged = True
            print('已至最大迭代次数{}'.format(max_iter))

    return theta


def main():
    """
        主函数
    """
    data_arr, target_arr, data_names = load_data()
    # y = target_arr.reshape(-1, 1)
    y = target_arr

    for i, data_name in enumerate(data_names):
        x = data_arr[:, i].reshape(-1, 1)
        # 添加一列全1的向量
        x = np.hstack((np.ones_like(x), x))

        theta = gradient_descent(x, y, alpha=0.1, max_iter=5000)
        print('线型模型参数', theta)

        # 绘制结果
        y_pred = theta[0] + theta[1] * x[:, 1]
        plt.figure()
        plt.title(data_name)
        # 绘制样本点
        plt.scatter(x[:, 1], y)

        # 绘制拟合线
        plt.plot(x[:, 1], y_pred, c='red')
        plt.tight_layout()
        plt.savefig('{}_{}.jpg'.format(i, data_name))
        plt.show()


if __name__ == '__main__':
    main()


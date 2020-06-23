package main.syntax;

public class Control {
    public static void main(String[] args) {
        int divided = 100;
        int divisor = 3;

        for (int i = 0, found = 0; i < 100 && found < 10; i++, divided++) {
            if (divided % divisor == 0) {
                System.out.println(divided + "可以整除" + divisor + "商为：" + (divided / divisor));
                found++;
            }
        }

        for (int i = 1; i < 10; i++) {
            String str = "";
            for (int j = 1; j <= i; j++) {
                str += j + "x" + i + "=" + i * j + "\t";
            }
            System.out.println(str);
        }
// 生成范围内随机数：生成区间段内随机值值
        for (int i = 1; i < 10; i++) {
            System.out.println((int) (Math.random() * (90 - 60) + 60));
            System.out.println((int) (Math.random() * 90 * 100 % (90 - 60) + 60));
        }

    }
}

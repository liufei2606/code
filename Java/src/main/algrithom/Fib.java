package main.algrithom;

public class Fib {

    static int fib(int n) {
        if (n <= 2) {
            return 1;
        }
        int a = 1;
        int b = 1;
        for (int i = 2; i < n; i++) {
            int c = a + b;
            a = b;
            b = c;
        }
        return b;
    }

    public static void main(String[] args) {
        System.out.println(fib(10));
    }
}

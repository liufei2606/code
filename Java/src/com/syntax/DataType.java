package com.syntax;

public class DataType {
    public static void main(String[] args) {

        // primary data type  基本数据
        // double > float > long >int>short>byte
        // 自动类型转换：赋值或运算时发生
        // sout　psvm
        byte byteVar = 127;
        System.out.println(byteVar);
        short shortVar = 30000;
        System.out.println(shortVar);

        int intVar = 3000000;
        System.out.println(intVar);
        int c = 011;
        int d = 0x11;
        System.out.println(c + "-" + d);

        long longVar = 9999999999999999L;
        System.out.println(longVar);

        float floatVar = 4444444444444444444.44444444444444444444444444f;
        System.out.println(floatVar);

        double doubleVar = 4444444444444444444.44444444444444444444444444;
        System.out.println(doubleVar);

        boolean condition = true;
        boolean fCondition = false;
        System.out.println(condition);
        System.out.println(fCondition);

        // 2个byte 转换int
        char charVar = 'a';
        System.out.println(charVar);
        System.out.println(charVar + 10);
        System.out.println((char) 98);


        int[] intArray = new int[9];
        System.out.println(intArray[2]);

        double[][] doubleArray = new double[100][20];
        System.out.println(doubleArray[20][10]);
    }
}

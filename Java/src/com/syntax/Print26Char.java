package com.syntax;

public class Print26Char {
    public static void main(String[] args) {
//        char ch = 'A';
        char ch = '\u4564';
        int num = ch;

        for (int i = 0; i < 26; i++) {
            System.out.println(num + ":\t" + (char) num++);
        }
    }
}

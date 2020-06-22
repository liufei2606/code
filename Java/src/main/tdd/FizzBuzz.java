package main.tdd;

class FizzBuzz {
    public void main(String[] args) {
        for (int i = 0; i < 200; i++) {
            String result = handleSignleDigit(i);
            System.out.println(result);
        }
    }

    public String handleSignleDigit(int i) {
        return String.valueOf(i);
    }
}
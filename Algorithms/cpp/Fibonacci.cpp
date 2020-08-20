long long Fibonacci(unsigned int n) {
  int result[2] = {0, 1};
  if (n < 2)
    return result[n];

  long long fibNumOne = 1;
  long long fibNumTwo = 0;
  long long fibN = 0;
  for (int i = 2; i <= n; i++) {
    fibN = fibNumOne + fibNumTwo;

    fibNumTwo = fibNumOne;
    fibNumOne = fibN;
  }

  return fibN;
}
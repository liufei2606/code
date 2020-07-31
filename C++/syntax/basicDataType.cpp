#include <stdio.h>

#define PI 3.14

int main(int argc, char const *argv[]) {
  printf("Interger:\n");
  int int_octal, int_decimal, int_hexadecial;
  int_octal = 012;
  int_decimal = 200;
  int_hexadecial = 0x25;
  short int short_int = -10;
  unsigned long int u_l_int = 200000;

  printf("%d %o %x\n", int_octal, int_octal, int_octal);
  printf("%d %o %x\n", int_decimal, int_decimal, int_decimal);
  printf("%d %o %x\n", int_hexadecial, int_hexadecial, int_hexadecial);

  printf("%d's lenth:%ld\n", short_int, sizeof(short_int));
  printf("%d's lenth:%ld\n", int_decimal, sizeof(int_decimal));
  printf("%ld's lenth:%ld\n", u_l_int, sizeof(u_l_int));

  printf("Float:\n");
  float f = 1234567890.888888;
  double df = 8888888888888.88888888888888888888;
  float r = 5;
  printf("%f's lenth:%ld\n", f, sizeof(f));
  printf("%f's lenth:%ld\n", df, sizeof(df));
  printf("%f %e %g\n", f, f, f);
  printf("s = %f\n", PI * r * r);

  printf("Char:\n");
  int i1, i2;
  char c;
  i1 = 'a' - 'A';
  i2 = 'b' - 'B';
  c = 'c' - 32;
  printf("i1 is %d and c2 is %d\n  \t", i1, i2);
  printf("c is %d and %c\n", c, c);

  printf("String:\n");
  printf("%s\n", "China's in Asia");

  printf("%-5c%-5d%-10.5f\n", c, int_decimal * 10000, f);
  return 0;
}

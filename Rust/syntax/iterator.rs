fn main() {
  let numbers = vec![1, 2, 3, 4, 5];

  let double = |n: &i32| -> i32 { n * 2 };
  let less_than_10 = |n: &i32| -> bool { *n < 10 };

  let result: Vec<i32> = numbers.iter().map(double).filter(less_than_10).collect();

  println!("{:?}", result); // [2, 4, 6, 8]
}
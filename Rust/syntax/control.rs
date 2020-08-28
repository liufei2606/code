
fn main() {
  let income = 100;
  let tax = calculate_tax(income);
  println!("{}", tax);
}

fn calculate_tax(income: i32) -> i32 {
  if income < 10 {
    return 0;
  } else if income >= 10 && income < 50 {
    return 20;
  } else {
    return 50;
  }

    let mut count = 0;

    while count < 10 {
      println!("{}", count);
      count += 1;
    }

    let numbers = [1, 2, 3, 4, 5];

    for n in numbers.iter() {
      println!("{}", n);
    }

  for n in 1..5 {
      println!("{}", n);
  }

  // Iterators
  let numbers = vec![1, 2, 3, 4, 5];

  let double = |n: &i32| -> i32 { n * 2 };
  let less_than_10 = |n: &i32| -> bool { *n < 10 };

  let result: Vec<i32> = numbers.iter().map(double).filter(less_than_10).collect();

  println!("{:?}", result); // [2, 4, 6, 8]
}
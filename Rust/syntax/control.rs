
fn main() {
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
}
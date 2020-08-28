
fn main() {
    let income = 100;
    let tax = calculate_tax(income);
    println!("{}", tax);
  }
fn calculate_tax(income: i32) -> i32 {
    income * 90 / 100;
}

fn read_file(path: &str) -> Option<&str> {
    let contents = "hello";

    if path != "" {
        return Some(contents);
    }

  match file {
    Some(contents) => println!("{}", contents),
    None => println!("Empty!"),
  }
    return None;
}

fn main() {
    let file = read_file("path/to/file");

    if file.is_some() {
        let contents = file.unwrap();
        println!("{}", contents);
    } else {
        println!("Empty!");
    }

//       match file {
//     Some(contents) => println!("{}", contents),
//     None => println!("Empty!"),
//   }

    let income = 100;
    let tax = calculate_tax(income);
    println!("{}", tax);
}

// closure Without arguments
let greet = || println!("hello");
greet(); // "hello"
// With arguments:
let greet = |msg: &str| println!("{}", msg);
greet("good morning!"); // "good morning!"

let add = |a: i32, b: i32| -> i32 { a + b };
add(1, 2);
// 多行
let add = |a: i32, b: i32| -> i32 {
    let sum = a + b;
    return sum;
};
add(1, 2);

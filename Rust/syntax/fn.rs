fn read_file(path: &str) -> Option<&str> {
    let contents = "hello";

    if path != "" {
        return Some(contents);
    }

    return None;
}

fn calculate_tax(income: i32) -> i32 {
    return income * 90 / 100;
}

fn main() {
    let file = read_file("path/to/file");

    if file.is_some() {
        let contents = file.unwrap();
        println!("{}", contents);
    } else {
        println!("Empty!");
    }

    let income = 100;
    let tax = calculate_tax(income);
    println!("{}", tax);
}


let greet = || println!("hello");
greet(); // "hello"

let greet = |msg: &str| println!("{}", msg);
greet("good morning!"); // "good morning!"

let add = |a: i32, b: i32| -> i32 { a + b };
add(1, 2);

let add = |a: i32, b: i32| -> i32 {
    let sum = a + b;
    return sum;
};
add(1, 2);

fn main() {

// numbers
let x = 123; // i32
let y = 4.5; // f64

// boolean
let x = false;

// strings
let name = "Saitama"; // &str
let name  = String::from("Genos"); // String
let name2 = "King".to_string();    // String
let name3 = name2.as_str();     // &str

// array
let list = [1, 2, 3]; //  fixed size
let mut list = vec![1, 2, 3]; //  grow/shrink in size

// Hashmap
use std::collections::HashMap;
fn main() {
  let mut colors = HashMap::new();

  colors.insert("white".to_string(), "#fff");
  colors.insert("black".to_string(), "#000");

  println!("{:?}", colors.get("white").unwrap()); // #fff
}

// Bag of data
struct Employee {
    name: String,
    age: i32,
    occupation: String,
  }

  fn main() {
    let employee = Employee {
      name: "Saitama".to_string(),
      age: 25,
      occupation: "Hero".to_string(),
    };
  }

}

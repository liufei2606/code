fn print_color(color: &str) {
  match color {
    "rose" => println!("roses are red,"),
    "violet" => println!("violets are blue,"),
    _ => println!("sugar is sweet, and so are you."),
  }
}

fn main() {
  print_color("rose"); // roses are red,
  print_color("violet"); // violets are blue,
  print_color("you"); // sugar is sweet, and so are you.
}

// destruct
struct Person {
  name: String,
  city: String,
}

fn main() {
  let rgb = [96, 172, 57];
  let [red, green, blue] = rgb;
  println!("{}", red); // 96
  println!("{}", green); // 172
  println!("{}", blue); // 57

  let person = Person {
    name: "shesh".to_string(),
    city: "singapore".to_string(),
  };
  let Person { name, city } = person;
  println!("{}", name); // name
  println!("{}", city); // city
}

// compare
truct Point {
  x: i32,
  y: i32,
}

fn main() {
  let point = Point { x: 10, y: 0 };

  match point {
    Point { x: 0, y: 0 } => println!("both are zero"),
    Point { x: 0, y } => println!("x is zero and y is {}", y),
    Point { x, y: 0 } => println!("x is {} and y is zero", x),
    Point { x, y } => println!("x is {} and y is {}", x, y),
  }
}
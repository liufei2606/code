enum Direction {
  Forward,
  Backward,
  Left,
  Right,
}

enum Operation {
  PowerOn,
  PowerOff,
  Move(Direction),
  Rotate,
  TakePhoto { is_landscape: bool, zoom_level: i32 },
}

fn operate_drone(operation: Operation) {
  match operation {
    Operation::PowerOn => println!("Power On"),
    Operation::PowerOff => println!("Power Off"),
    Operation::Move(direction) => move_drone(direction),
    Operation::Rotate => println!("Rotate"),
    Operation::TakePhoto {
      is_landscape,
      zoom_level,
    } => println!("TakePhoto {}, {}", is_landscape, zoom_level),
  }
}

fn move_drone(direction: Direction) {
  match direction {
    Direction::Forward => println!("Move Forward"),
    Direction::Backward => println!("Move Backward"),
    Direction::Left => println!("Move Left"),
    Direction::Right => println!("Move Right"),
  }
}

fn main() {
  operate_drone(Operation::Move(Direction::Forward));
  operate_drone(Operation::TakePhoto {
    is_landscape: true,
    zoom_level: 10,
  })
}
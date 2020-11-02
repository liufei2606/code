function capitalizeName(name: string): string {
	return name.toUpperCase();
}

let multiply: (first: number, second: number) => number;
multiply = function (first, second) {
	return first * second;
}

let multiplyFirst: (first: number) => ((second: number) => number);
multiplyFirst = function (first) {
	return function (num) {
		return first * num;
	}
}


const repl = require('repl');

const r = repl.start('Code:: ');

r.context.sum = (...args) => args.reduce((a, b) => a + b, 0);

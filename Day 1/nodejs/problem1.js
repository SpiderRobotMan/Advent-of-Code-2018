var fs = require('fs');

var start = process.hrtime();

var file = fs.readFileSync('./input.txt', 'utf8');
var lines = file.trim().split("\n");

var frequency = 0;

var line_count = lines.length;
for(var i = 0; i < line_count; i++) {
	frequency += +lines[i];
}

var end = process.hrtime(start);

console.log("Result: " + frequency);
console.log("Time to process: " + (end[1] / 1000000) + "ms");
var fs = require('fs');

var start = process.hrtime();

var file = fs.readFileSync('./input.txt', 'utf8');
var lines = file.trim().split("\n");

var frequency = 0;
var seen = {};
var first = null;

var loops = 0;
while(!first) {
	loops += 1;
	var line_count = lines.length;
	for(var i = 0; i < line_count; i++) {
		frequency += +lines[i];
		
		if(seen[frequency]) {
			first = frequency;
			break;
		}
		
		seen[frequency] = frequency;
	}
}

var end = process.hrtime(start);

console.log("Result: " + first);
console.log("Loops: " + loops);
console.log("Frequencies seen: " + Object.keys(seen).length);
console.log("Time to process: " + (end[1] / 1000000) + "ms");
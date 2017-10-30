// tester.js

var count = 0;

setTimeout("gofunc()",10000);

function gofunc() {
	var x = document.getElementsByClassName("description-stats");
	for (var i=0; i < x.length; i++){
		for (var j=0;j<40000;j++){
			x[i].innerHTML = count;
			count++;
		}
	}
}
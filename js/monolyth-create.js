// Bryce Mercines Monolyth-create.js
var coapp = "about";

function about() {
 document.getElementById(coapp).style.display = "none";	
 document.getElementById("about").style.display = "block";
 document.getElementById("gcode").style.display = "none";
 document.getElementById("htuse").style.display = "none";
 coapp = "about";

}

function htu() {
 document.getElementById(coapp).style.display = "none";	
 document.getElementById("about").style.display = "none";
 document.getElementById("gcode").style.display = "none";
 document.getElementById("htuse").style.display = "block";
 coapp = "htuse";

}

function gcode() {
 document.getElementById(coapp).style.display = "none";	
 document.getElementById("about").style.display = "none";
 document.getElementById("gcode").style.display = "block";
 document.getElementById("htuse").style.display = "none";
 coapp = "gcode";

}
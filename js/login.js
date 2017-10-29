//login.js
// Bryce Mercines 2017


window.onload = function(){
localStorage.removeItem('mpage');
loadcount = -1;
 document.getElementById("webcontainer").src = "";
 document.getElementById("weblink").focus();
}

var urx = document.getElementById("weblink");
     urx.addEventListener("keydown", function (e) {
      if (e.keyCode === 13) { 
       loginchk();
      }
    });

var urxmin = document.getElementById("weblinkmin");
     urxmin.addEventListener("keydown", function (e) {
      if (e.keyCode === 13) { 
       loginchkmin();
      }
    });     


var psq = document.getElementById("psw");
     psq.addEventListener("keydown", function (e) {
      if (e.keyCode === 13) { 
       window.location = "index.html";
      }
    });

var psqmin = document.getElementById("pswmin");
     psqmin.addEventListener("keydown", function (e) {
      if (e.keyCode === 13) { 
       window.location = "index.html";
      }
    });     


//check if site is loaded..
function loadchk() {
	   var x1 = document.getElementById("webcontainer");
  if ( loadcount == 1 && x1.src !== [ ] ){
  	var pid = localStorage.getItem("mpage");
  	if ( pid == "hash" ){
  		setTimeout("comptag()", 2000);
  		 setTimeout("glinktag()", 2000);
  		 setTimeout("proceed()", 1000);
  		 localStorage.removeItem('mpage');
  	}else{
  		
  		setTimeout("comptag()", 2000);
  		 setTimeout("blinktag()", 2000);
       localStorage.removeItem('mpage');
  	}
  	loadcount = 0;
  }
}

// check site compatibility
 function loginchk() {
   var x = document.getElementById("weblink").value;
   var x1 = document.getElementById("webcontainer");
   x1.src = x;
   document.getElementById("checklink").style.display = "block";
   document.getElementById("blink").style.display = "none";
 	 document.getElementById("glink").style.display = "none";
 }

  function loginchkmin() {
   var x = document.getElementById("weblinkmin").value;
   var x1 = document.getElementById("webcontainer");
   x1.src = x;
   document.getElementById("checklink").style.display = "block";
   document.getElementById("blink").style.display = "none";
 	 document.getElementById("glink").style.display = "none";
 	 logmin = 1;
 }

 function comptag() {
 	 document.getElementById("checklink").style.display = "none";
 }

 function glinktag() {
 	 document.getElementById("glink").style.display = "block";
 	 document.getElementById("blink").style.display = "none";
 }

 function blinktag() {
 	 document.getElementById("blink").style.display = "block";
 	 document.getElementById("glink").style.display = "none";
 }

 function proceed() {
 	var x2 = document.getElementById("weblink");
 	var x3 = document.getElementById("passcode");
 	x3.style.display = "block";
 	if (logmin == 1){
 		document.getElementById("pswmin").focus();
 	}else{
 	document.getElementById("psw").focus();
 }
    
 }
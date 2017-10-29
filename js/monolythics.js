//monolythics.js
//Bryce Mercines 2017

//update analytics data.

var auto_refresh = setInterval(
      function ()
      {
         $('#pagev').load('monolythics.php').fadeIn("slow");
         subloop();
      }, 200); // refresh every 10000 milliseconds




var pvarray = [ ];
function subloop() {
	var x = document.getElementById('pagev').innerHTML;
	if ( pvarray.indexOf(x) > -1){
		//do nothing
	}else{
		pvarray.push(x);
		addsimln();
		pdata();
	}
}

	/*
  if ( pvarray.indexOf( pageviews ) > -1 ){
  	//do nothing
  }else{
  	pvarray.push(pageviews);
  	addsimln();
  }
  setTimeout("subloop()",100);
}

var pvscale = function(){return pvarray;}
*/

<?php
   // zyte
  // web application copiler
 session_start();
  // update config
  if(isset($_GET['update'])){
     $newConfig = $_GET['update'];
     $config1 = explode(";",$newConfig);
     $config2 = join(";\n",$config1);
     file_put_contents('zyte.config', $config2);
  }
  $req = array("app.html","main.html","app.js","app.css","zyte.config");
  $file_missing = array();
  $missing = 0;
  $found = 0;
  $errors = array();
  $config = array();
// get configuration file
   $cfile = 'zyte.config';
      foreach(file($cfile) as $line){
           $d1 = str_replace(" ", "", $line);
           $d2 = str_replace("\n", "", $d1);
           $d3 = str_replace(";", "", $d2);
           $d4 = explode(":", $d3);
           $d5 = str_replace("\r", "", $d4);
               $config[$d5[0]] = $d5[1];
      }
      
    $_SESSION['project'] = $config['project-name'];  
    $_SESSION['entry-point'] = $config['entry-point'];
    $_SESSION['size'] = $config['size'];
    $_SESSION['compile-type'] = $config['compile-type'];
    $_SESSION['src'] = $config['src'];
  $dir = new DirectoryIterator(dirname(__FILE__));
  foreach ($dir as $fileinfo) {
    if (!$fileinfo->isDot()) {
        $file = $fileinfo->getFilename();
        if(in_array($file, $req)){
        	$found++;  
          }else{
          	$missing++;
          }
    } 
}
  if($missing != 0 && $found != sizeof($req)){
        	array_push($errors, "ERROR! dev files are missing!");
        	foreach ($req as $rfiles) {
            if(!file_exists($rfiles)){
        	array_push($errors, "ERROR! Missing file: ".$rfiles);
            }
        	}
        }else{
        	compile();
        }
 
 // check build size
 function app_size() {
   if(is_dir('build')){
    $size = 0;
    foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator('build')) as $file) {
        $size += $file->getSize();
    }
    return $size;
  }else{
    return 0;
  }
}
if(app_size() > $config['size']) {
   array_push($errors, "Error! the App size, is larger than target size");
}
// compile 
 function compile(){
     
   
 	 if(!is_dir('build')){
 	 	mkdir('build');
 	 }
   // html parsing 
   if($_SESSION["compile-type"] == 'html'){
  
 
       $appcss = file_get_contents('app.css');
           if(!is_dir("./build/".$_SESSION['src'])){
             mkdir("./build/".$_SESSION['src']);
           }
           $appcss0 = preg_replace('/\s+/S', " ", $appcss);
           $css_js0 = str_replace("'", '"', $appcss0);
           $css_js1 = "<style>".$css_js0."</style>";
   
       $appjs = file_get_contents('app.js');
           $appbody = file_get_contents('app.html');
           $appbody0 = preg_replace('/\s+/S', " ", $appbody);
        $m = file_get_contents('main.html');
            $css0 = str_replace('</head>', $css_js1.'</head>', $m);
            $m1 = str_replace("</body>", "</body>\n<script>".$appjs."</script>",$css0);
            $app_total = str_replace('</div>', $appbody0.'</div>', $m1);
            file_put_contents("./build/".$_SESSION['entry-point'], $app_total);
               
    $message = "Compile Successfully!";
       
   }
   // js parsing
   if($_SESSION['compile-type'] == 'js'){
 	 if(is_dir("build")){
    	 	$m = file_get_contents('main.html');
    	 	    $css = '"./'.$_SESSION['src'].'/app.css"';
    	 	    $js = '"./'.$_SESSION['src'].'/app.js"';
    	 	    $rel='"stylesheet"';
    	 	    $m1 = str_replace("</body>", "</body>\n<script src=".$js."></script>", $m);
    	 	    file_put_contents("./build/".$_SESSION['entry-point'], $m1);
 	   }
 
       $appcss = file_get_contents('app.css');
           if(!is_dir("./build/".$_SESSION['src'])){
             mkdir("./build/".$_SESSION['src']);
           }
           $appcss0 = preg_replace('/\s+/S', " ", $appcss);
           $css_js0 = str_replace("'", '"', $appcss0);
           $css_js1 = "<style>".$css_js0."</style>";
   
       $appjs = file_get_contents('app.js');
           $appbody = file_get_contents('app.html');
           $appbody0 = str_replace("'", "&apos;", $appbody);
           $appbody1 = preg_replace('/\s+/S', " ", $appbody0);
           $appbody2 = "document.getElementById('index').innerHTML ='".$css_js1.$appbody1."';";
           $appjs1 = $appbody2.$appjs;    
           file_put_contents("./build/".$_SESSION['src']."/app.js", $appjs1);
    $message = "Compile Successfully!";
    }
  }
      
?>
<html>
<head>
	<title>▲ zyte </title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">  
	<style>
		body {
			margin: 0;
			padding: 0;
			font-family: Helvetica, sans-serif;
      padding: 20px;
      font-weight: 100;
		}
   
    .logo span {
       color: grey;
       font-weight: 100;
       text-align: top;
    }
    .logo small{
      font-size: 15px;
    }
    .line {
      border-width: 0.5px;
    }
.container {
  width: 100%;
}
.row {
  width: 100%;
  display: flex;
  flex-wrap: wrap;
  margin-top: 5px;
  margin-left: 40px;
}
/* content */
.row div {
  box-shadow:0 2px 5px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12);
  background-color: #fff;
  padding: 3%;
  margin-right: 18px;
  height: 350px;
  border: 1px solid white;
  border-radius: 5px;
  text-align: left;
  transition: background-color 1s;
}
    .col-4 {
  width: 24.33%
}
		iframe {
			width: 100%;
			height:100%;
			border:0px;
		}
   .mobile-dashboard {
    display: none;
  }
     @media(max-width:750px){
        .row {
          display: none;
        }
        .mobile-dashboard {
          display: block;
        }
   }
    
    #config {
      width: 100%;
      height: 265px;
      border-radius: 5px;
      padding: 5px;
      background-color: black;
      color: lime;
      border: 0.5px solid #ddd;
    }
     #console {
      width: 100%;
      height: 265px;
      border-radius: 5px;
      padding: 5px;
      background-color: black;
      color: red;
      border: 0.5px solid #ddd;
    }
    .btn {
      padding-left: 10px;
      padding-right: 10px;
      padding-top: 3px;
      padding-bottom: 3px;
      border-radius: 2px;
      background-color: #333;
      border: 0;
      color: #fff;
    }
    .info {
      list-style: none;
      padding: 0;
    }
    .info li {
      padding-bottom: 5px;
    }
    .success {
      color: lime !important;
    }
    .err {
      color: red !important;
    }
		.toastify{padding:12px 20px;color:#fff;display:inline-block;box-shadow:0 3px 6px -1px rgba(0,0,0,.12),0 10px 36px -4px rgba(77,96,232,.3);background:-webkit-linear-gradient(315deg,#73a5ff,#5477f5);background:linear-gradient(135deg,#73a5ff,#5477f5);position:fixed;opacity:0;transition:all .4s cubic-bezier(.215,.61,.355,1);border-radius:2px;cursor:pointer;text-decoration:none;max-width:calc(50% - 20px);z-index: 9999;}.toastify.on{opacity:1}.toast-close{opacity:.4;padding:0 5px}.right{right:15px}.left{left:15px}.top{top:-150px}.bottom{bottom:-150px}.rounded{border-radius:25px}.avatar{width:1.5em;height:1.5em;margin:0 5px;border-radius:2px}@media only screen and (max-width:360px){.left,.right{margin-left:auto;margin-right:auto;left:0;right:0;max-width:fit-content}}
    .compile {
      padding: 10px;
      border: 0;
      border-radius: 3px;
      background-color: #333;
      color: #fff;
      text-transform: uppercase;
      margin-bottom: 10px;
      cursor: pointer;
    }
    .settings {
       position: fixed;
       z-index: 9999;
       border: 0;
       border-radius: 10px;
       width: 150px;
       height: 40px;
       background-color: rgba(0,0,0,0.3);
       padding: 10px;
       bottom: 45px;
       right: -120px;
       color: rgba(255,255,255,0.3);
       font-size: 35px;
       cursor: pointer;
       transition: 0.6s;
    }
    .settings:hover {
      color: #fff;
      width: 180px; 
      box-shadow:0 2px 5px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12);
      transition: 0.6s;
    }
	</style>
</head>
	<body spellcheck="false">
    <?php
    $sp = "display:block";
     $page = @$_GET['config'];
         if(!isset($page) && sizeof($errors) == 0){
              echo '
                  <style>
                    html, body {
                      padding:0px !important;
                    }
                  </style>
                       <a href="zyte.php?config"><div class="settings">▲</div></a>
                  <iframe src="./build/'.$_SESSION['entry-point'].'"></iframe>
              ';
             $sp = "display:none";
         }else{
            $sp = "display:block";
         }
     ?>
     <div style="<?php echo $sp; ?>" >
     <h1 class="logo">▲<span>zyte</span></h1>
     <hr class="line">
       <br>
       <br>
       <center>
      <div class="row">
    <div class="col-4"><h3>Project Info</h3>
      <ul class="info">
          <li><a href="./build/<?php echo $_SESSION['entry-point']; ?>">&diams; Build: ./build/<?php echo $_SESSION['entry-point']; ?></a></li>
          <li>&diams; Max-size: <?php echo $_SESSION['size']; ?></li>
          <li>&diams; App-size: <?php echo app_size(); ?></li>
          <li>&diams; Compile Type: <?php echo $_SESSION['compile-type']; ?></li>
          <li>&diams; Errors: <?php echo sizeof($errors);?></li>
      </ul>
        <button class="compile" onclick="window.location.reload();">Compile App</button>
        <button class="compile" onclick="window.location='zyte.php'">Preview App</button>

    </div>

    <div class="col-4"><h3>Config <button class="btn" onclick="updateConfig();">Update</button></h3>
    
         <?php
           echo '<textarea id="config">';
            if(file_exists('zyte.config')){
              echo file_get_contents('zyte.config');
            }
            echo '</textarea>'; 
         ?>
          </div>

    <div class="col-4"><h3>Console</h3>
     
          <?php
            $state = "success";
            if(sizeof($errors) !=0){
              $state = "err";
            }
            echo '<textarea id="console" class="'.$state.'">';
             if(sizeof($errors) != 0){
               foreach($errors as $err) {
                echo "> ".$err."\n";
               }
               echo "> Compile failed!";
             }else{
               echo "> Compile Complete!";
             } 
             echo '</textarea>';
          ?>
    </div>
  </div>
</center>
     <div class="mobile-dashboard">
         <h2>Project data</h2>
          <ul class="info">
            <li><a href="./build/<?php echo $_SESSION['entry-point']; ?>">&diams; Build: ./build/<?php echo $_SESSION['entry-point']; ?></a></li>
          <li>&diams; Max-size: <?php echo $_SESSION['size']; ?></li>
          <li>&diams; App-size: <?php echo app_size(); ?></li>
          <li>&diams; Compile Type: <?php echo $_SESSION['compile-type']; ?></li>
          <li>&diams; Errors: <?php echo sizeof($errors);?></li>
      </ul>
      <br>
      <button class="compile" onclick="window.location.reload();">Compile App</button>
        <button class="compile" onclick="window.location='zyte.php'">Preview App</button>
     </div>
   </div>
	</body>
	<script type="text/javascript">
		!function(t,o){"object"==typeof module&&module.exports?(require("./toastify.css"),module.exports=o()):t.Toastify=o()}(this,function(t){var i=function(t){return new i.lib.init(t)};function r(t,o){return!(!t||"string"!=typeof o)&&!!(t.className&&-1<t.className.trim().split(/\s+/gi).indexOf(o))}return i.lib=i.prototype={toastify:"1.2.2",constructor:i,init:function(t){return t||(t={}),this.options={},this.options.text=t.text||"Hi there!",this.options.duration=t.duration||3e3,this.options.selector=t.selector,this.options.callback=t.callback||function(){},this.options.destination=t.destination,this.options.newWindow=t.newWindow||!1,this.options.close=t.close||!1,this.options.gravity="bottom"==t.gravity?"bottom":"top",this.options.positionLeft=t.positionLeft||!1,this.options.backgroundColor=t.backgroundColor,this.options.avatar=t.avatar||"",this.options.className=t.className||"",this},buildToast:function(){if(!this.options)throw"Toastify is not initialized";var t=document.createElement("div");if(t.className="toastify on "+this.options.className,!0===this.options.positionLeft?t.className+=" left":t.className+=" right",t.className+=" "+this.options.gravity,this.options.backgroundColor&&(t.style.background=this.options.backgroundColor),t.innerHTML=this.options.text,""!==this.options.avatar){var o=document.createElement("img");o.src=this.options.avatar,o.className="avatar",!0===this.options.positionLeft?t.appendChild(o):t.insertAdjacentElement("beforeend",o)}if(!0===this.options.close){var i=document.createElement("span");i.innerHTML="&#10006;",i.className="toast-close",i.addEventListener("click",function(t){t.stopPropagation(),this.removeElement(t.target.parentElement),window.clearTimeout(t.target.parentElement.timeOutValue)}.bind(this));var n=0<window.innerWidth?window.innerWidth:screen.width;!0===this.options.positionLeft&&360<n?t.insertAdjacentElement("afterbegin",i):t.appendChild(i)}return void 0!==this.options.destination&&t.addEventListener("click",function(t){t.stopPropagation(),!0===this.options.newWindow?window.open(this.options.destination,"_blank"):window.location=this.options.destination}.bind(this)),t},showToast:function(){var t,o=this.buildToast();if(!(t=void 0===this.options.selector?document.body:document.getElementById(this.options.selector)))throw"Root element is not defined";return t.insertBefore(o,t.firstChild),i.reposition(),o.timeOutValue=window.setTimeout(function(){this.removeElement(o)}.bind(this),this.options.duration),this},removeElement:function(t){t.className=t.className.replace(" on",""),window.setTimeout(function(){t.parentNode.removeChild(t),this.options.callback.call(t),i.reposition()}.bind(this),400)}},i.reposition=function(){for(var t,o={top:15,bottom:15},i={top:15,bottom:15},n={top:15,bottom:15},e=document.getElementsByClassName("toastify"),s=0;s<e.length;s++){t=!0===r(e[s],"top")?"top":"bottom";var a=e[s].offsetHeight;(0<window.innerWidth?window.innerWidth:screen.width)<=360?(e[s].style[t]=n[t]+"px",n[t]+=a+15):!0===r(e[s],"left")?(e[s].style[t]=o[t]+"px",o[t]+=a+15):(e[s].style[t]=i[t]+"px",i[t]+=a+15)}return this},i.lib.init.prototype=i.lib,i});
	</script>
	<script>
	function status(message){
		Toastify({
			text: "▲ "+message,
			duration: 5000,
			newWindow: true,
			close: true,
			gravity: "top", // `top` or `bottom`
			positionRight: true, // `true` or `false`
			backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
      }).showToast();
	}
	function errors(message){
    Toastify({
      text: "▲ "+message,
      duration: 8000,
      newWindow: true,
      close: true,
      gravity: "top", // `top` or `bottom`
      positionRight: true, // `true` or `false`
      backgroundColor: "linear-gradient(to right, #dd1818, #ff8c00)",
      }).showToast();
  }
 function updateConfig(){
    var config = document.getElementById("config").value;
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", "zyte.php?update="+config, false ); 
    xmlHttp.send( null );
    Toastify({
      text: "▲ Configuration updated!",
      duration: 3000,
      newWindow: true,
      close: true,
      gravity: "top", // `top` or `bottom`
      positionRight: true, // `true` or `false`
      backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
      }).showToast();
 }
  
	</script>	

<?php
  echo '<script>';
  $t_delta = 200;
  if(sizeof($errors) != 0){
    foreach ($errors as $err) {
          $er ='"'.$err.'"';
          echo "setTimeout('errors(".$er.")',".$t_delta.");";
          $t_delta += 800;
    }
  }else{
    // no errors
    $m = "'Compile Complete!'";
    echo 'setTimeout("status('.$m.')",200);';
  }
  echo '</script>';
?>

</html>
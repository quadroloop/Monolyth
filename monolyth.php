<?php 

// Allow any site to communicate
header("Access-Control-Allow-Origin: *");

function res($msg,$status,$data){
  $responseData = array(
    "message" => $msg,
    "status" => $status,
    "data" => $data
  );
  echo json_encode($responseData);
}

// check if the db file exist
$file = "monolyth.delta.json";

if(!file_exists($file)){
   file_put_contents($file,"");
}

// get data from the database

function getData(){
  $filex = "monolyth.delta.json";
   $datax = file_get_contents($filex);
   $parsed_json = json_decode($datax,true);

   echo json_encode($parsed_json);
}


// get the size of the database
if(isset($_GET['dbStats'])){
  echo file_get_contents($file);
}

// write to the db
if(isset($_POST["mWrite"])){

  $dbData = $_POST["mWrite"];

  if($dbData[0] === "{"){
    file_put_contents($file,$dbData);
    $newDbState = file_get_contents($file);
    getData();
  }else{
    res("ERROR","500","Incomplete Parameters");
  }

}

// get all DB data
if(isset($_GET['fetch'])){
  getData();   
}
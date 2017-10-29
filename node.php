<?php
$basecount = file_get_contents('count.h');
$addview = (int)$basecount+1;
file_put_contents("count.h", $addview);
?>
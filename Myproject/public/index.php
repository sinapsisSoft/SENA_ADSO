<?php

include('../app/Config/Constant.php');


$uri=URI;
$folder="public/";

echo("</br>");
if($longUrl=strpos($uri,$folder)){
  var_dump($uri);
  echo("</br>");
  $newLongUrl=$longUrl+(strlen($folder));
  var_dump($newLongUrl);
  echo("</br>");
  $arrayGetData=explode("/",substr($uri,  $newLongUrl));
  echo("</br>");
  var_dump($arrayGetData);
}else{
  echo("Erro: 404");
}


?>
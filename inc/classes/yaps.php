<?php
class Yaps{

function __construct($db){
global $config;
$this->user=new YapsUser($db);
$this->config=$config;
$this->db=$db;
$this->modules=array();
}

function redirect($url){
header("Location: $url");
exit;
}
function local_redirect($url=""){
header("Location: ".$this->config["site_path"]."$url");
exit;
}

function addModule($code,$name,$description){
$obj=new YapsModule();
$obj->code=$code;
$obj->name=$name;
$obj->description=$description;

$this->modules[]=$obj;
}


}



class YapsModule{
var $code;
var $name;
var $description;
}

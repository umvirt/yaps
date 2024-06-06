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

function localLink($url="/"){
$url=substr($url, 1);
$target=$this->config["site_path"].$url;
return $target;
}


function local_redirect($url="/"){
//$url=substr($url, 1);
//$target=$this->config["site_path"].$url;
$target=$this->localLink($url);
header("Location: $target");
exit;
}

function addModule($object,$code,$name,$description){
$obj=new YapsModule();
$obj->object=$object;
$obj->code=$code;
$obj->name=$name;
$obj->description=$description;

$this->modules[]=$obj;
}


}


<?php
class Yaps{

function __construct($db){
global $config;
$this->user=new YapsUser($db);
$this->config=$config;
$this->db=$db;
}

function redirect($url){
header("Location: $url");
exit;
}
function local_redirect($url=""){
header("Location: ".$this->config["site_path"]."$url");
exit;
}




}

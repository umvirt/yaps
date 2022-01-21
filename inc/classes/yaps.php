<?php
class Yaps{

function __construct($db){
$this->user=new YapsUser($db);
}

function redirect($url){
header("Location: $url");
exit;
}

}

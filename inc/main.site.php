<?php
ob_start();
session_start();
include "main.php";
include INCDIR."classes/controller.php";




if(!@$_REQUEST["ns"]){
$ns="default";
}else{
$ns=$_REQUEST["ns"];
}

logmsg("current namespace is \"$ns\"");

$dirs=array();
//add common directory
$dirs[]=INCDIR."controllers/common";
//add namespace specified directory
//if(isset($namespaces[$ns])){
$dirs[]=INCDIR."controllers/".$ns;
//}
//var_dump($dirs);
//Load each file in directories
foreach($dirs as $dir){
	if(file_exists($dir)){
		if ($dh = opendir($dir)) {

logmsg("looking for controlers in \"$dir\"");

//echo ".$dir.";
			while (($file = readdir($dh)) !== false) {
				if(preg_match("/.php$/",$file)){
					include $dir."/".$file;
logmsg("loading controller \"".$dir."/".$file."\"");

///echo $dir."/".$file;
				}
			}
		}
	}else{
		echo "$dir - not found";
	}
}


$controller="default";
$controllerclassname=$controller."Controller";

logmsg("current controller is \"$controller\"");


@$action=$_REQUEST['action'];
if(!$action){$action="default";}

logmsg("current action is \"$action\"");



$method=$action."Act";
echo "- $controllerclassname - ";


	if(class_exists($controllerclassname)){
		$controllerclass=new $controllerclassname();

logmsg("controller class is found");


if(method_exists($controllerclass,$method)){
logmsg("controller action method is found");

$controllerclass->$method();
}else{die("no action method");}

}else{die("no controller class");}





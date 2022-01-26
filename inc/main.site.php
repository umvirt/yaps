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

@$controller=$_REQUEST['controller'];
$controller="default";

@$action=$_REQUEST['action'];
if(!$action){$action="default";}



//override default action
if($ns=="default" and $controller=="default" and $action=="default"){
        $ns=$config['site_default_ns'];
        $controller=$config['site_default_controller'];
        $action=$config['site_default_action'];
}

logmsg("current namespace is \"$ns\"");
logmsg("current controller is \"$controller\"");
logmsg("current action is \"$action\"");




//logmsg("current namespace is \"$ns\"");

$cdirs=array();

$mdir=INCDIR."modules/";
if ($dh = opendir($mdir)) {
 while (($file = readdir($dh)) !== false) {
  if(is_dir($mdir.'/'.$file) and !in_array($file, array('.','..'))){
$cdirs[]=INCDIR."modules/$file/controllers/".$ns;
if(file_exists(INCDIR."modules/$file/module.php")){
include(INCDIR."modules/$file/module.php");
}

}}

}


//add common directory
$cdirs[]=INCDIR."controllers/common";
//add namespace specified directory
//if(isset($namespaces[$ns])){

if(file_exists(INCDIR."controllers/".$ns)){
$cdirs[]=INCDIR."controllers/".$ns;
}

//}
//var_dump($dirs);
//Load each file in directories
foreach($cdirs as $dir){
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
//$controllerclassname=$controller."Controller";

//logmsg("current controller is \"$controller\"");


//@$action=$_REQUEST['action'];
//if(!$action){$action="default";}

//logmsg("current action is \"$action\"");

/*
//override default action
if($ns=="default" and $controller=="default" and $action=="default"){
	$ns=$config['site_default_ns'];
	$controller=$config['site_default_controller'];
	$action=$config['site_default_action'];
}

logmsg("current namespace is \"$ns\"");
logmsg("current controller is \"$controller\"");
logmsg("current action is \"$action\"");
*/

$method=$action."Act";
$rawmethod=$action."RawAct";
$cmdmethod=$action."CmdAct";



$controllerclassname=$controller."Controller";


	if(class_exists($controllerclassname)){
		$controllerclass=new $controllerclassname();
		logmsg("controller class is found");
		
		if(method_exists($controllerclass,$method)){
			logmsg("controller action method is found");
			$controllerclass->$method();
		}elseif(method_exists($controllerclass,$rawmethod)){
			ob_end_clean();
			logmsg("controller rawaction method is found");
			$controllerclass->$rawmethod();
			exit;
		}elseif(method_exists($controllerclass,$cmdmethod)){
			ob_end_clean();
			logmsg("controller cmdaction method is found");
                        $x=$controllerclass->$cmdmethod();
			$_SESSION['FLASH_MESSAGE']=$controllerclass->showCmdResult(@$x);
//var_dump($config['site_debug']);

if(!$config['site_debug']){			
					if(@$controllerclass->localnextlocation){
						$Yaps->local_redirect($controllerclass->localnextlocation);
					}
                                        if(@$controllerclass->nextlocation){
                                                $Yaps->redirect($controllerclass->nextlocation);
                                        }

					if(isset($_SERVER["HTTP_REFERER"])){
					    $Yaps->redirect($_SERVER["HTTP_REFERER"]);
					}
}
//$Yaps->redirect();
		}else{die("no action method");}

	
	}else{die("no controller class");}



$flash_msg=@json_decode($_SESSION['FLASH_MESSAGE']);
$_SESSION['FLASH_MESSAGE']="";


//var_dump($_SESSION);

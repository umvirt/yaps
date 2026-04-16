<?php
/**
 * @package YAPS
 */

/**
 * Site code
 */

// launch output buffer
ob_start();
// launch session
session_start();
// load common code
include "main.php";
// load controller class
include INCDIR."classes/YapsController.php";
// load HTML forms generator
include INCDIR."/tools/formgen/formgen.php";


// Localization init

// localization debug code
/*
$locales=array(
"english"=>'en_US.utf8',
"russian"=>'ru_RU.utf8'
);
*/

// get default (server) locale
$locale=$config['site_locale'];
logmsg("server locale is \"$locale\"");

// get user locale
if(@$_SESSION['locale'])
{
    $locale=$_SESSION['locale'];
    logmsg("user locale is \"$locale\"");
}

// init locale
$r=putenv('LC_ALL='.$locale);
if (!$r)
{
    logmsg ('putenv failed');
}

$r=setlocale(LC_ALL, $locale);
if (!$r) {
    logmsg ('setlocale failed');
}

bindtextdomain("yaps", "./inc/locale");
textdomain("yaps");

// Main request dispatching
//
// Default values overrinding by request values

// Conteroller namespace
if(!@$_REQUEST["ns"])
{
    $ns="default";
}else{
    $ns=$_REQUEST["ns"];
}

// Controller
@$controller=$_REQUEST['controller'];
if(!$controller)
{
    $controller="default";
}

// Action
@$action=$_REQUEST['action'];
if(!$action){
    $action="default";
}

// Default action override
if($ns=="default" and $controller=="default" and $action=="default")
{
    $ns=$config['site_default_ns'];
    $controller=$config['site_default_controller'];
    $action=$config['site_default_action'];
}

// print debug information
logmsg("current namespace is \"$ns\"");
logmsg("current controller is \"$controller\"");
logmsg("current action is \"$action\"");

// Conterollers directories init

// array to store controller directories
$cdirs=array();

// Load modules controllers

// define a modules directory
$mdir=INCDIR."modules/";
// open amodules directory
if($dh = opendir($mdir))
{
    // process each item in modules directory
    while (($file = readdir($dh)) !== false)
    {
        // if item is directory
        if(is_dir($mdir.'/'.$file) and !in_array($file, array('.','..')))
        {
            // if directory for specific controller namespace exists
            if(file_exists(INCDIR."modules/$file/controllers/".$ns)){
                // append it to controller directories
                $cdirs[]=INCDIR."modules/$file/controllers/".$ns;
            }
        }
    }
}

// add common directory
$cdirs[]=INCDIR."controllers/common";

// add namespace specified directory
if(file_exists(INCDIR."controllers/".$ns)){
    $cdirs[]=INCDIR."controllers/".$ns;
}

// load each controller file in controller directories
foreach($cdirs as $dir)
{
    // if directory exists
    if(file_exists($dir))
    {
        // open directory
        if ($dh = opendir($dir))
        {
            // print debug message
            logmsg("looking for controllers in \"$dir\"");

            // process each item in directory
            while (($file = readdir($dh)) !== false)
            {
                // if item is php file
                if(preg_match("/.php$/",$file))
                {
                    // include such file
                    include $dir."/".$file;

                    // print debug message
                    logmsg("loading controller \"".$dir."/".$file."\"");
                }
            }
        }
    }else{
        echo "$dir - not found";
    }
}

// define requested controller method names

// method for HTML output
$method=$action."Act";
// method for raw (custom) output
$rawmethod=$action."RawAct";
// method for command
$cmdmethod=$action."CmdAct";

//var_dump(get_declared_classes(),$LOG_DEBUG);
//exit;

// define requested contoller class name
$controllerclassname="Yaps\\Controllers\\".$ns."Namespace\\".$controller."Controller";

// Controller class method execution

// if controller class with requested name exists
if(class_exists($controllerclassname))
{
    // create object from class with requested name
    $controllerclass=new $controllerclassname();

    // print debug message
    logmsg("controller class is found");

    // if class have a default method
    if(method_exists($controllerclass,$method))
    {
        // print debug message
        logmsg("controller action method is found");
        // call default method
        $controllerclass->$method();
    // if class have a method for raw output
    }elseif(method_exists($controllerclass,$rawmethod))
    {
        // stop output buffer
        ob_end_clean();
        // print debug message
        logmsg("controller rawaction method is found");
        // call default method
        $controllerclass->$rawmethod();
        // stop execution
        exit;
    }elseif(method_exists($controllerclass,$cmdmethod))
    {
        // stop output buffer
        ob_end_clean();
        // print debug message
        logmsg("controller cmdaction method is found");
        // call default method and save return value
        $x=$controllerclass->$cmdmethod();
        //save output value in session
        $_SESSION['FLASH_MESSAGE']=$controllerclass->showCmdResult(@$x);

        // if debug is not enabled
        if(!$config['site_debug'])
        {
            // if local next location is defined
            if(@$controllerclass->localnextlocation)
            {
                //redirect to it
                $Yaps->local_redirect($controllerclass->localnextlocation);
            }
            // if next location is defined
            if(@$controllerclass->nextlocation){
                //redirect to it
                $Yaps->redirect($controllerclass->nextlocation);
            }
            // if previous script is defined
            if(isset($_SERVER["HTTP_REFERER"]))
            {
                //redirect to it
                $Yaps->redirect($_SERVER["HTTP_REFERER"]);
            }
        }
    // if no methods are found
    }else{
        // stop execution with message
        die("no action method");
    }

// if controller class not found
}else{
    //var_dump(get_declared_classes(),$controllerclassname);
    //stop execution with message
    die("no controller class");
}


//restore previous command handler value from session and save it in variable
$flash_msg=@json_decode($_SESSION['FLASH_MESSAGE']);
//delete previous command handler value from session
$_SESSION['FLASH_MESSAGE']="";

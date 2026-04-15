<?php
/**
 * @package YAPS
 *
 * Common code
 */

// enable debuging
ini_set('display_errors',1);
ini_set('error_reporting',E_ALL);

// define main constants
DEFINE('APPDIR',dirname(dirname(__file__)).'/');
DEFINE('INCDIR',APPDIR.'/inc/');

// load functions
include INCDIR."func.php";

// load config file
include INCDIR."config.php";

// load main classes

// database interface class
include INCDIR."classes/db.php";
// app object class
include INCDIR."classes/yaps.php";
// user object class
include INCDIR."classes/user.php";
// module object class
include INCDIR."classes/module.php";

// database interface init
$db=new db_connection($db_config);

// app object init
$Yaps=new Yaps($db);

$LOG_DEBUG=[];

// localization init
$locales=array(
"english"=>'en_US.utf8',
"russian"=>'ru_RU.utf8'
);

//Load modules

// define a modules directory
$mdir=INCDIR."modules/";
// open amodules directory
if ($dh = opendir($mdir))
{
    // process each item in modules directory
    while (($file = readdir($dh)) !== false)
    {
        // if item is directory
        if(is_dir($mdir.'/'.$file) and !in_array($file, array('.','..')))
        {
            // if module directory contain file 'module.php'
            if(file_exists(INCDIR."modules/$file/module.php"))
            {
                //load this file
                include(INCDIR."modules/$file/module.php");
            }
        }
    }
}



<?php
$db_config['database']='ulfs';
$db_config['user']='ulfs';
$db_config['password']='VKkvvS1eCtLkmxIb';
$db_config['server']='127.0.0.1';

$config['site_title']="UmVirt ][ackerz Portal";

$config['site_default_ns']="user";
$config['site_default_controller']="default";
$config['site_default_action']="default";

$config['site_path']="/packager";
$config['site_debug']=false;

define('OBJ_CMD_RESULT','Command result');
define('CMD_FAIL_RESULT','Execution was failed');
define('CMD_SUCCESS_RESULT','Execution completed succesfully');




//local install root path
$config['localpath']="/mnt/umvirt";
//files repository root
$config['filespath']="/mnt/raw/LFS";

//sleep when dump requested
$config['dumpsleep']=0;


$config['packages_url']="http://".@$_SERVER['SERVER_ADDR']."/linux/packages/";
$config['downloads_url']="http://".@$_SERVER['SERVER_ADDR']."/linux/downloads/";


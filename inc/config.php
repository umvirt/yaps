<?php
$db_config['database']='ulfs';
$db_config['user']='ulfs';
$db_config['password']='VKkvvS1eCtLkmxIb';
$db_config['server']='127.0.0.1';

//local install root path
$config['localpath']="/mnt/umvirt";
//files repository root
$config['filespath']="/mnt/raw/LFS";

//sleep when dump requested
$config['dumpsleep']=0;


$config['packages_url']="http://".@$_SERVER['SERVER_ADDR']."/linux/packages/";
$config['downloads_url']="http://".@$_SERVER['SERVER_ADDR']."/linux/downloads/";


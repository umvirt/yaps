<?php
echo "<html>";
echo "<h1><a href=".$Yaps->config['site_path'].">".$config['site_title']."</a></h1>";


foreach($Yaps->modules as $module){
if($module->code==$ns){
echo "<h2>Module: <a href=".$Yaps->config['site_path']."/$ns>$module->name</a></h2>";
}

}


if($flash_msg){
echo "<p>[ command execution status: <b>".$flash_msg->status."</b> ]</p>";

//if($flash_msg['])

}


echo $content;

echo "<hr>";

$t="navmap_$ns";

//echo $t;

if(function_exists($t)){
$t();
}
//var_dump($_SESSION['FLASH_MESSAGE'],$flash_msg);


?>
<!--
<?php
if($LOG_DEBUG){
 var_dump($_SESSION['FLASH_MESSAGE'],$flash_msg);
 echo("\n- ".join($LOG_DEBUG, "\n- ")."\n");
}
?>
-->
</html>


<?php
echo "<html>";
echo "<h1>".$config['site_title']."</h1>";

if($flash_msg){
echo "<p>[ command execution status: <b>".$flash_msg->status."</b> ]</p>";

//if($flash_msg['])

}


echo $content;

echo "<p>";
echo "<li><a href=".$Yaps->config['site_path']."/ulfs>ULFS</a>";


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


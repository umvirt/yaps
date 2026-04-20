<?php
echo "<html>";
echo "<h1><a href=" . $Yaps->config['site_path'] . ">" . $config['site_title'] . "</a></h1>";

foreach ($Yaps->modules as $module) {
    if ($module->code == $ns) {
        echo "<h2>" . _('YAPS_MODULE') . ": <a href=" . $Yaps->localLink("/$ns") . ">$module->name</a></h2>";
    }

}



if ($flash_msg) {
    echo "<p>[ " . _('YAPS_FLASHMSG_STATUS') . ": <b>" . $flash_msg->status . "</b> ]</p>";

    //if($flash_msg['])

}

echo "<hr>";


$islogined = $Yaps->user->is_logined();
//var_dump($islogined);
if ($islogined) {
    echo _('YAPS_USERROLE_USER') . ": " . $_SESSION['login'] . " [ <a href='" . $Yaps->localLink("/user/logout") . "'>" . _('YAPS_ACTION_LOGOUT') . "</a> ]";
} else {
    echo _('YAPS_USERROLE_VISITOR') . " [ <a href='" . $Yaps->localLink("/user/loginfrm") . "'>" . _('YAPS_ACTION_LOGIN') . "</a> ]";
}

echo "<hr>";



echo $content;

echo "<hr>";

$t = "navmap_$ns";

//echo $t;

$xlocales = [];
foreach ($locales as $k => $v) {
    $xlocales[] = "<a href=\"" . $Yaps->localLink("/user/setlocale/$k") . "\">" . $k . "</a>";
}
echo _('YAPS_LOCALE') . ": " . join(" | ", $xlocales);



if (function_exists($t)) {
    $t();
}
//var_dump($_SESSION['FLASH_MESSAGE'],$flash_msg);


?>
<!--
<?php
if ($LOG_DEBUG) {
    var_dump($Yaps->user->roles);
    var_dump($_SESSION['FLASH_MESSAGE'], $flash_msg);
    echo("\n- " . join($LOG_DEBUG, "\n- ") . "\n");
}
?>
-->
</html>


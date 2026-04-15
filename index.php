<?php
/**
 * @package YAPS
 *
 * Main HTTP/HTTPS entry point
 */

// load site code
include "inc/main.site.php";
// get output buffer data
$content=ob_get_contents();
// clear output buffer
ob_end_clean();
// load template code
include "templates/default/html/default.php";


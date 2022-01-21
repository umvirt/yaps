<?php

include "inc/main.site.php";


echo "test";

$content=ob_get_contents();
ob_end_clean();

include "templates/default/html/default.php";


<?php
namespace Yaps\Controllers\defaultNamespace;
/**
 * @package YAPS\Controllers\default
 */

/**
 * Default controller
 */
class defaultController extends \Yaps\YapsController{
    /**
     * Default action (main page)
     */
    function defaultAct()
    {
        echo "Hello World!";
    }
}

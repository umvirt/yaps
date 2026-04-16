<?php
namespace Yaps;
/**
 * @package YAPS
 */

/**
 * Run-time module object
 */
class YapsModule{
    /**
     * @var string $code module code
     */
    public $code;
    /**
    * @var string $name module name
    */
    public $name;
    /**
    * @var string $description module description text
    */
    public $description;
    /**
    * @var object $code module object
    */
    public $obj;
    /**
    * Backup module
    */
    function backup($path){}
    /**
    * Restore module
    */
    function restore($path){}
}

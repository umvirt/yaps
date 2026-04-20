<?php

namespace Yaps;

/**
 * @package YAPS
 */

/**
 * Run-time module object
 */
class YapsModule
{
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
    public function backup($path) {}
    /**
    * Restore module
    */
    public function restore($path) {}
}

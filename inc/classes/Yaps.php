<?php

/**
 * @package YAPS
 */

/**
 * Core application class
 */
class Yaps
{
    /**
     * Configuration
     * @var array $config Configuration array
     */
    public $config;
    /**
    * Database Connection
    * @var DatabaseConnection $db Database connection object
    */
    public $db;
    /**
     * Run time modules list
     * @var array<YapsModule> $modules Modules list
     */
    public $modules;
    /**
     * Current user
     * @var YapsUser $user Current user object
     */
    public $user;
    /**
     * Constructor
     *
     * @param DatabaseConnection $db Database connection object
     * @return void
     */
    public function __construct($db)
    {
        // open global configuration
        global $config;
        // init current user object
        $this->user = new YapsUser($db);
        // pass config
        $this->config = $config;
        // pass database connection
        $this->db = $db;
        // init runtime modules list
        $this->modules = [];
    }

    /**
     * Redirect browser to URL
     *
     * @param string url URL to redirect
     * @return void
     */
    public function redirect($url)
    {
        // send a http header
        header("Location: $url");
        // stop execution
        exit;
    }

    /**
     * Compose a URL for given local site path
     *
     * @param string $path path related to root directory
     * @return string URL for given path
     */
    public function localLink($path = "/")
    {
        // remove first slash
        $path = substr($path, 1);
        // append path to site path
        $target = $this->config["site_path"] . $path;
        return $target;
    }

    /**
     * Redirect to local site path
     *
     * @param string $path path related to root directory
     * @return void
     */
    public function local_redirect($path = "/")
    {
        // compose URL for path
        $target = $this->localLink($path);
        // send a http header
        header("Location: $target");
        // stop execution
        exit;
    }

    /**
     * Add module to run-time modules list
     *
     * @param object $object module object
     * @param string $code code for module
     * @param string $name name for module
     * @param string $description description for module
     * @return void
     */
    public function addModule($object, $code, $name, $description)
    {
        // create module object
        $obj = new \Yaps\YapsModule();
        // pass object to module object
        $obj->object = $object;
        // define code to module object
        $obj->code = $code;
        // define name to module object
        $obj->name = $name;
        // define description to module object
        $obj->description = $description;
        // append module object to list
        $this->modules[] = $obj;
    }
}

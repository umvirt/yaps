<?php
namespace Yaps;
/**
 * @package YAPS
 */

/**
 * Site controller
 */
class YapsController
{
    /**
     * Global variables
     * @var array $globals global variables array
     */
    public $globals;
    /**
     * All request variables
     * @var array $request _REQUEST variables array
     */
    public $request;
    /**
     * GET request variables
     * @var array $get GET request variables array
     */
    public $get;
    /**
     * POST request variables
     * @var array $post POST request variables array
     */
    public $post;
    /**
     * Session variables
     * @var array $session session variables array
     */
    public $session;
    /**
     * Cookie variables
     * @var array $cookie cookie variables array
     */
    public $cookie;
    /**
     * Environment variables
     * @var array $cookie environment variables array
     */
    public $env;
    /**
     * Server variables
     * @var array $server _SERVER variables array
     */
    public $server;
    /**
     * Files variables
     * @var array $files _FILES variables array
     */
    public $files;
    /**
     * Yaps object
     * @var Yaps $yaps core app object
     */
    public $yaps;



    /**
    * Constructor
    *
    * @return void
    */
    function __construct()
    {
        // Defining of global parameters
        @$this->globals=$GLOBALS;
        @$this->request=$GLOBALS["_REQUEST"];
        @$this->get=$GLOBALS["_GET"];
        @$this->post=$GLOBALS["_POST"];
        @$this->session=$GLOBALS["_SESSION"];
        @$this->cookie=$GLOBALS["_COOKIE"];
        @$this->env=$GLOBALS["_ENV"];
        @$this->server=$GLOBALS["_SERVER"];
        @$this->files=$GLOBALS["_FILES"];
        @$this->yaps=$GLOBALS["Yaps"];
    }

    /**
    * Show result of command actions
    *
    * Returns JSON object:
    * {status: "$status", title: "$title", text: "$text"}
    * where
    * $status := <success | fail | info > - result status of command (Success, Failure, Information)
    * $title - command title
    * $text - command text
    * @return string JSON
    */
    function showCmdResult($obj=NULL)
    {
        // title

        // if title not defined
        if(!@$this->cmdResult->title)
        {
            // get action object
            $xobj=@$this->yaps->action;
            // if action object is valid
            if(is_object($xobj))
            {
                // override title
                $this->cmdResult->title=$xobj->title_;
            }
        }

        // set title
        $title=@$this->cmdResult->title;

        // if object not passed
        if(!$obj)
        {
            // report a failure by default

            // set status
            $status="fail";
            // set description text
            $text=CMD_FAIL_RESULT;

            //if status is defined in cmdResult object
            if(@$this->cmdResult->status)
            {
                // override it
                $status=$this->cmdResult->status;
            }

            //if title is defined in cmdResult object
            if(@$this->cmdResult->title)
            {
                $title=$this->cmdResult->title;
            }

            //if description is defined in cmdResult object
            if(@$this->cmdResult->text)
            {
                $text=$this->cmdResult->text;
            }
        // if object is passed
        }else{
            // report a success

            // set status
            $status='success';
            // set description text
            $text=CMD_SUCCESS_RESULT;
        }

        //if title is not defined
        if(!@$title)
        {
            //set default title
            $title=OBJ_CMD_RESULT;
        }

        //quet mode

        //set default value
        $quiet="";

        //if quet mode requested
        if(@$this->quiet)
        {
            //overrde quet mode value
            $quiet=", \"quiet\": true";
        }

        // JSON object generation

        // if status is valid
        if($status=="success" or $status=="fail" or $status=="info")
        {
            // return JSON-object with specific status
            return "{\"status\": \"$status\", \"title\": \"$title\", \"text\": \"$text\", \"_object\": \"CmdResult\" $quiet}";
        }else{
            // return JSON-object with info status
            return "{\"status\": \"info\", \"title\": \"$title\", \"text\": \"$text\", \"_object\": \"CmdResult\" $quiet}";
        }
    }
}

/**
* Command result class
*
* Used to store command results and pass them to user as JSON object in Handler::showCmdResult()
*/
class CmdResult{
    var $status;
    var $title;
    var $text;
    var $redirect=false;
}





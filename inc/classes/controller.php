<?php

class Controller{
/**
	* Constructor
	*/
	function __construct(){
		///Defining of global parameters
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
	//	$this->cmdResut=new CmdResult();
	//	$this->data=$this->yaps->output->vars;
	//var_dump($this->request);
//echo "XxX";
}
}

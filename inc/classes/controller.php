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

/**
	* Show result of command actions
	*
	* Returns JSON object:
	* {status: "$status", title: "$title", text: "$text"}
	* where
	* $status := <success | fail | info > - result status of command (Success, Failure, Information)
	* $title - command title
	* $text - command text
	* @return string
	*/
	function showCmdResult($obj=NULL){
		

	//Set title from yaps action object	
	if(!@$this->cmdResult->title){
			$xobj=@$this->yaps->action;
			if(is_object($xobj)){
					$this->cmdResult->title=$xobj->title_;
			}
		}
		$title=@$this->cmdResult->title;
		if(!$obj){
			$status="fail";
			$text=CMD_FAIL_RESULT;
			if(@$this->cmdResult->status){
				$status=$this->cmdResult->status; 
			}
			if(@$this->cmdResult->title){
				$title=$this->cmdResult->title;
			}
			if(@$this->cmdResult->text){
				$text=$this->cmdResult->text;
			}
		}else{
			$status='success';
			$text=CMD_SUCCESS_RESULT;
		}

		if(!@$title){
		$title=OBJ_CMD_RESULT;
		}
		$quiet="";
		if(@$this->quiet){
			$quiet=", \"quiet\": true";
		}
		
		if($status=="success" or $status=="fail" or $status=="info"){
			return "{\"status\": \"$status\", \"title\": \"$title\", \"text\": \"$text\", \"_object\": \"CmdResult\" $quiet}";
		}else{
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





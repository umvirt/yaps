<?php
class defaultController extends Controller{
function loginAct(){
$login=@addslashes($this->request['login']);
$password=@addslashes($this->request['password']);


//var_dump($_SESSION,$login,$password, $this->yaps->user->chkcredentials($login,$password));

if($this->yaps->user->chkcredentials($login,$password)){
$_SESSION['login']=$login;
$_SESSION['password']=$password;

}

$this->yaps->local_redirect();
}

function logoutAct(){
$_SESSION['login']="";
$_SESSION['password']="";

$this->yaps->local_redirect();

}



function loginfrmAct(){
?>
<form action='<?php echo $this->yaps->config['site_path']."/user/login";?>' method=post><input name=login><input name=password><input type=submit></form>

<?php

}

	function defaultAct(){
		$islogined=$this->yaps->user->is_logined();
		//var_dump($islogined);
if($islogined){
echo "You logined as ".$_SESSION['login'].". Do you want to <a href='".$this->yaps->config['site_path']."/user/logout'>exit</a>?";
}else{
echo "Welcome! Do you want to <a href='".$this->yaps->config['site_path']."/user/loginfrm'>login</a>?";
}
//		echo @$user;
//		echo "tasty";
	}
}

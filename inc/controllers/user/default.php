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

$this->yaps->redirect('/packager/');
}

function logoutAct(){
$_SESSION['login']="";
$_SESSION['password']="";

$this->yaps->redirect('/packager/');

}



function loginfrmAct(){
?>
<form action='/packager/user/login' method=post><input name=login><input name=password><input type=submit></form>

<?php

}

	function defaultAct(){
		$islogined=$this->yaps->user->is_logined();
		//var_dump($islogined);
if($islogined){
echo "You logined as ".$_SESSION['login'].". Do you want to <a href='/packager/user/logout'>exit</a>?";
}else{
echo "Welcome! Do you want to <a href='/packager/user/loginfrm'>login</a>?";
}
//		echo @$user;
//		echo "tasty";
	}
}

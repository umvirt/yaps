<?php
class defaultController extends Controller{
function loginCmdAct(){
$login=@addslashes($this->request['login']);
$password=@addslashes($this->request['password']);



//var_dump($_SESSION,$login,$password, $this->yaps->user->chkcredentials($login,$password));

$uid=$this->yaps->user->chkcredentials($login,$password);

if($uid){
$_SESSION['uid']=$uid;
$_SESSION['login']=$login;
$_SESSION['password']=$password;
$this->localnextlocation="/";

return true;
}

//$this->yaps->local_redirect();
}

function logoutCmdAct(){
$_SESSION['login']="";
$_SESSION['password']="";
$this->localnextlocation="/";

return true;

//$this->yaps->local_redirect();

}



function loginfrmAct(){

$f=new Formgen_Form();
$f->AddField('Login','login','','',"User's login");
$f->AddField('Password','password','','password',"User's password");
$f->AddHiddenField('ns','user');
$f->AddHiddenField('action','login');
$f->action=$this->yaps->config['site_path'];
$f->submitlabel="Sign in";
$f->method="post";
echo $f->render();



/*
?>
<form action='<?php echo $this->yaps->config['site_path']."/user/login";?>' method=post><input name=login><input name=password><input type=submit></form>

<?php
*/


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



//var_dump($this->yaps->modules);

if(count($this->yaps->modules)){
echo "<h2>Available modules</h2>";
echo "<ul>";
foreach($this->yaps->modules as $module){
echo "<li><a href=\"".$this->yaps->config['site_path']."/".$module->code."\">$module->name</a> - $module->description";
}
echo "</ul>";
}


	}
}

<?php
class defaultController extends Controller{
function setlocaleCmdAct(){
global $locales;
$_SESSION['locale']=$locales[$_REQUEST['code']];
return true;
}



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
$f->AddField(_('YAPS_FIELD_USERLOGIN'),'login','','',_('YAPS_FIELD_USERLOGIN_DESCRIPTION'));
$f->AddField(_('YAPS_FIELD_USERPASSWORD'),'password','','password',_('YAPS_FIELD_USERPASSWORD_DESCRIPTION'));
$f->AddHiddenField('ns','user');
$f->AddHiddenField('action','login');
$f->action=$this->yaps->config['site_path'];
$f->submitlabel=_('YAPS_ACTION_LOGIN');
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
echo rstr(_('YAPS_CURRENTUSER_MESSAGE'), array('login'=>$_SESSION['login'], 'link2exit'=>$this->yaps->localLink("/user/logout")));

//"You logined as ".$_SESSION['login'].". Do you want to <a href='".$this->yaps->localLink("/user/logout")."'>exit</a>?";
}else{
echo rstr(_('YAPS_VISITOR_MESSAGE'), array('link2login'=>$this->yaps->localLink("/user/loginfrm")));
//"Welcome! Do you want to <a href='".$this->yaps->localLink("/user/loginfrm")."'>login</a>?";
}
//		echo @$user;
//		echo "tasty";



//var_dump($this->yaps->modules);

if(count($this->yaps->modules)){
echo "<h2>"._('YAPS_MODULES_AVAILABLE')."</h2>";
echo "<ul>";
foreach($this->yaps->modules as $module){
echo "<li><a href=\"".$this->yaps->localLink("/".$module->code)."\">$module->name</a> - $module->description";
}
echo "</ul>";
}


	}
}

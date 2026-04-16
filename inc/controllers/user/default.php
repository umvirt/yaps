<?php
namespace Yaps\Controllers\userNamespace;
/**
 * @package YAPS\Controllers\user
 */

/**
 * Current user controller
 */
class defaultController extends \Yaps\YapsController{
    /**
     * Set locale in session
     * @return bool command execution status
     */
    function setlocaleCmdAct()
    {
        global $locales;
        $_SESSION['locale']=$locales[$_REQUEST['code']];
        return true;
    }

    /**
     * Log in / Sign in / Enter
     * @return bool command execution status
     */
    function loginCmdAct()
    {
        $login=@addslashes($this->request['login']);
        $password=@addslashes($this->request['password']);

        // check user's credentials using request varables
        $uid=$this->yaps->user->chkcredentials($login,$password);

        // if uid exists
        if($uid)
        {
            // save data in session
            $_SESSION['uid']=$uid;
            $_SESSION['login']=$login;
            $_SESSION['password']=$password;
            $this->localnextlocation="/";

            return true;
        }
        //$this->yaps->local_redirect();
    }

    /**
     * Log out / Sign out / Exit
     * @return bool command execution status
     */
    function logoutCmdAct()
    {
        $_SESSION['login']="";
        $_SESSION['password']="";
        $this->localnextlocation="/";
        return true;
        //$this->yaps->local_redirect();

    }


    /**
    * Login form
    * @return string login form code
    */
    function loginfrmAct()
    {

        $f=new \Yaps\Tools\Formgen\FormgenForm();
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

    /**
     * Default action
     * @return string default action code
     */
    function defaultAct()
    {
        // is current user logined?
        $islogined=$this->yaps->user->is_logined();
        //var_dump($islogined);

        // if logined
        if($islogined)
        {
            // print menu for user
            echo rstr(_('YAPS_CURRENTUSER_MESSAGE'), array('login'=>$_SESSION['login'], 'link2exit'=>$this->yaps->localLink("/user/logout")));

        // if not logined
        }else{
            //print menu for visitor
            echo rstr(_('YAPS_VISITOR_MESSAGE'), array('link2login'=>$this->yaps->localLink("/user/loginfrm")));
        }

        // if modules installed
        if(count($this->yaps->modules))
        {
            // list them
            echo "<h2>"._('YAPS_MODULES_AVAILABLE')."</h2>";
            echo "<ul>";
            foreach($this->yaps->modules as $module)
            {
                echo "<li><a href=\"".$this->yaps->localLink("/".$module->code)."\">$module->name</a> - $module->description";
            }
            echo "</ul>";
        }
    }
}

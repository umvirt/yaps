<?php
/**
 * @package YAPS
 */

/**
 * Current user account class
 */
class YapsUser{
    /**
     * Database Connection
     * @var DatabaseConnection $db Database connection object
     */
    public $db;
    /**
     * User ID
     * @var int $uid User ID
     */
    public $uid;
    /**
     * Roles list
     * @var array $roles run-time user's roles list
     */
    public $roles;
    /**
     * Constructor
     *
     * @param DatabaseConnection $db Database connection object
     * @return void
    */
    function __construct($db)
    {
        // pass dataase connection
        $this->db=$db;
        // fill user's rolles list
        $this->roles=$this->getRoles();
    }
    /**
    * Return UID existance
    *
    * @param integer $uid user id
    * @return bool true if user exists
    */
    function exist($uid)
    {
        $this->db->execute("select uid from users where uid=$uid");
        $e=$this->db->dataset;
        return count($e);
    }

    /**
     * Check user's credentials
     *
     * @param string $login user's login
     * @param string $password user's passeword
     * @return int UID if user exists
     */
    function chkcredentials($login, $password)
    {
        //Simple verification (raw password)
        /*
        $sql="select uid from users where `login`=\"$login\" and `password`=\"$password\"";
        $this->db->execute($sql);
        $e=$this->db->dataset;
        foreach($e as $v){
        return $v['uid'];
        }
        */
        //Complex verification (pasword hash)
        $sql="select uid, salt, password from users where `login`=\"$login\"";
        $this->db->execute($sql);
        $e=$this->db->dataset;
        foreach($e as $v)
        {
            if(hash_equals($v['password'],crypt($password,$v['salt'])))
            {
                    return $v['uid'];
            }
        }
    }

    /**
     * Check is current user logined using session variables
     *
     * @return int UID if user exists
     */
    function is_logined()
    {
        return $this->chkcredentials(@$_SESSION['login'],@$_SESSION['password']);
    }

    /**
     * Get roles list for current user
     *
     * @return array<string> roles list
     */
    function getRoles()
    {
        // get current uid
        $this->uid=$this->is_logined();

        // init roles list
        $res=array();

        // if uid is found
        if($this->uid)
        {
            // add role user
            $res[]='user';
            //if uid is 1
            if($this->uid==1){
                //add role superuser
                $res[]='superuser';
            }
        // if UID not found
        }else{
            //add role visitor
            $res[]='visitor';
        }

        return $res;
    }

    /**
    * Check a role assignment to user
    *
    * @return bool true if role assigned to user
    */
    function in_role($code)
    {
        return in_array($code, $this->roles);
    }
}

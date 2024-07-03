<?php
class YapsUser{
var $uid;
var $roles;


function __construct($db){
$this->db=$db;
$this->roles=$this->getRoles();
}

        /**
	* Return UID existance
	* @param integer $uid user id
	* @return boolean
	*/
	function exist($uid){
		$this->db->execute("select uid from users where uid=$uid");
		$e=$this->db->dataset;
		return count($e);
	}	


	function chkcredentials($login, $password){
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
                foreach($e as $v){
			if(hash_equals($v['password'],crypt($password,$v['salt']))){
                		return $v['uid'];
			}
                }

	}

function is_logined(){
return $this->chkcredentials(@$_SESSION['login'],@$_SESSION['password']);
}

function getRoles(){
$this->uid=$this->is_logined();

$res=array();
if($this->uid){
$res[]='user';
if($this->uid==1){
$res[]='superuser';
}

}else{
$res[]='visitor';
}


return $res;
}


function in_role($code){
return in_array($code, $this->roles);
}



}

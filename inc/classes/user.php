<?php
class YapsUser{

function __construct($db){
$this->db=$db;
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
		$sql="select uid from users where `login`=\"$login\" and `password`=\"$password\"";
		$this->db->execute($sql);
                $e=$this->db->dataset;
		foreach($e as $v){
                return $v['uid'];
		}
	}

function is_logined(){
return $this->chkcredentials(@$_SESSION['login'],@$_SESSION['password']);
}


}

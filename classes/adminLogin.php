<?php
$filepath=realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/session.php');
session::checkLogin();

$filepath=realpath(dirname(__FILE__));

include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helper/formate.php');
?>

<?php

class Adminlogin{
  private $db;
  private $fm;	

	public function __construct()
	{
		$this->db=new Database();
		$this->fm=new Format();

	}
	public function Adminlogin($adminUser,$adminPass){
		$adminUser=$this->fm->validation($adminUser);
		$adminPass=$this->fm->validation($adminPass);

		$adminUser=mysqli_escape_string($this->db->link,$adminUser);
		$adminPass=mysqli_escape_string($this->db->link,$adminPass);

		if (empty($adminUser) || empty($adminPass)) {
			$loginmsg="Username Or Password  not match!";
			return $loginmsg;
		}else{
			$query="SELECT * FROM tbl_admin WHERE adminUser='$adminUser' AND adminPass='$adminPass'";
			$result=$this->db->select($query);
			if ($result !=false) {
				$value=$result->fetch_assoc();
				session::set("adminlogin",true);
				session::set("adminId",$value['adminId']);
				session::set("adminUser",$value['adminUser']);
				session::set("adminName",$value['adminName']);
				header("Location:index.php");
			}else{
				$loginmsg="Username Or Password not match!";
			      return $loginmsg;
			}
		}
	}
}



?>
<?php
$filepath=realpath(dirname(__FILE__));

include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helper/formate.php');
?>

<?php

class Customer
{	
	private $db;
    private $fm;	

	public function __construct(){
		$this->db=new Database();
		$this->fm=new Format();
}
public function customerRegistration($data){
$name        =mysqli_escape_string($this->db->link,$data['name']);
$address     =mysqli_escape_string($this->db->link,$data['address']);
$city        =mysqli_escape_string($this->db->link,$data['city']);
$country     =mysqli_escape_string($this->db->link,$data['country']);
$zip         =mysqli_escape_string($this->db->link,$data['zip']);
$phone       =mysqli_escape_string($this->db->link,$data['phone']);
$email       =mysqli_escape_string($this->db->link,$data['email']);
$password    =mysqli_escape_string($this->db->link,md5($data['password']));

if ($name=='' || $address=='' || $city=='' || $country=='' || $zip=='' || $phone=='' ||  $email=='' ||  $password=='' ) {
	$msg="<span class='error'>Filed must not be empty!</span>";
    return $msg;
// $mailquery="SELECT * FROM tbl_customer WHERE email='$email' LIMIT 1";
// $mailchk=$this->db->select($mailquery);
// if ($mailchk != false) {
// 	$msg="<span class='error'>Email already Exit!</span>";
//     return $msg;
}
else{

	$query="INSERT INTO  tbl_customer VALUES('','$name','$address','$city','$country','$zip','$phone','$email','$password')";
	$Insert_row=$this->db->insert($query);

	if ($Insert_row) {
				$msg="<span class='success'>Customer Data Inserted Successfully.</span>";

			    return $msg;
			}else{
				$msg="<span class='error'>Customer Data Not Inserted.</span>";
			    return $msg;
			}
}

}

public function customerLogin($data){
$email       =mysqli_escape_string($this->db->link,$data['email']);
$password    =mysqli_escape_string($this->db->link,md5($data['password']));
if ($email=='' || $password=='') {
	$msg="<span class='error'>Filed must not be empty!</span>";
    return $msg;
}

$query = "SELECT * FROM tbl_customer WHERE email = '$email'  ";

$result = $this->db->select($query);
 // if ($result != false) {
	$value=$result->fetch_assoc();

	Session::set("cusLogin",true);
	Session::set("cmrId",$value['id']);


	

// 	Session::set("cmrName",$value['name']);
header("Location:cart.php");
// }else{
 	// $msg="<span class='error'>Email or password not matched!</span>";
     // return $msg;
 // }
	


}

public function getCustomerData($id){


	$query="SELECT * FROM tbl_customer WHERE id ='$id'";
$result=$this->db->select($query);
return $result;
}


public function customerUpadate($data,$cmrId){

$name        =mysqli_escape_string($this->db->link,$data['name']);
$address     =mysqli_escape_string($this->db->link,$data['address']);
$city        =mysqli_escape_string($this->db->link,$data['city']);
$country     =mysqli_escape_string($this->db->link,$data['country']);
$zip         =mysqli_escape_string($this->db->link,$data['zip']);
$phone       =mysqli_escape_string($this->db->link,$data['phone']);
$email       =mysqli_escape_string($this->db->link,$data['email']);

if ($name=='' || $address=='' || $city=='' || $country=='' || $zip=='' || $phone=='' ||  $email=='') {
	$msg="<span class='error'>Filed must not be empty!</span>";
    return $msg;

}else{


	$query="UPDATE tbl_customer 
			        SET 
			        name    ='$name',
			        address ='$address',
			        city    ='$city',
			        country ='$country',
			        zip     ='$zip',
			        phone   ='$phone',
			        email   ='$email'

			        WHERE id ='$cmrId'";
			$update_rows=$this->db->update($query);  
			if ($update_rows) {
			      	$msg="<span class='success'>Customer Data Updated Successfully.</span>";
                     return $msg;
			      }  else{
			      	$msg="<span class='error'> Customer Data Not Updated.</span>";
			         return $msg;

			      } 
                }


  }
}
?>
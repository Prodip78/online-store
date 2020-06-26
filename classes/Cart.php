<?php
$filepath=realpath(dirname(__FILE__));

include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helper/formate.php');
?>


<?php

class Cart
{	
	private $db;
    private $fm;	

	public function __construct(){
		$this->db=new Database();
		$this->fm=new Format();
}

public function addToCart($quantity,$id){
$quantity=$this->fm->validation($quantity);
$quantity=mysqli_escape_string($this->db->link,$quantity);
$productId=mysqli_escape_string($this->db->link,$id);
$sId=session_id();

$squery="SELECT * FROM tbl_product WHERE productId='$productId'";
$result=$this->db->select($squery)->fetch_assoc();

$productName=$result['productName'];
$price=$result['price'];
$image=$result['image'];

$chquery="SELECT * FROM tbl_cart WHERE productId='$productId' AND sId='$sId' ";
$getPro=$this->db->select($chquery);
if ($getPro) {
	$msg="Product Already Added !";
	return $msg;
}else{

$query="INSERT INTO tbl_cart(sId,productId,productName,price,quantity,image) VALUES('$sId','$productId','$productName','$price','$quantity','$image')";
	$Insert_row=$this->db->insert($query);

	if ($Insert_row) {
				header("location:cart.php");	
			}else{
				header("location:index.php");			



}
}

}

public function getAllPro(){
$sId=session_id();
$query="SELECT * FROM tbl_cart WHERE sId='$sId'";
	$result=$this->db->select($query);
	return $result;

}
public function updateToCart($cartId,$quantity){
	// $cartId=mysqli_escape_string($this->db->link,$cartId);
	// $quantity=mysqli_escape_string($this->db->link,$quantity);
	$query="UPDATE tbl_cart 
			        SET 
			        quantity='$quantity'
			        WHERE cartId='$cartId'";
			$update_rows=$this->db->update($query);  
			if ($update_rows) {
			      	header("Location:cart.php");
			      }  else{
			      	$msg="<span class='error'>Quantity Not Updated.</span>";
			         return $msg;

			      }    

}
public function delproductByCart($delid){
	$query="DELETE FROM tbl_cart WHERE cartId='$delid'";
		$delCat=$this->db->delete($query);
		if ($delCat) {
			echo "<script>window.location('Are You Sure To Delete')</script>";
		}else{
			$msg="<span class='error'>Product Not Deleted.</span>";
			return $msg;

		}
}
public function chproCart(){
$sId=session_id();
$query="SELECT * FROM tbl_cart WHERE sId='$sId'";
$result=$this->db->select($query);
return $result;
}
public function deleteCustCart(){
	$sId=session_id();
	$query="DELETE FROM tbl_cart WHERE sId='$sId'";
	$this->db->delete($query);
}

public function proOder($cmrId){
$sId=session_id();
$query="SELECT * FROM tbl_cart WHERE sId='$sId'";
$getPro=$this->db->select($query);
if ($getPro) {
	while ($result =$getPro->fetch_assoc()) {
		$productId=$result['productId'];
		$productName=$result['productName'];
		$quantity=$result['quantity'];
		$price=$result['price'] * $quantity;
		$image=$result['image'];

		$query="INSERT INTO tbl_order(cmrId,productId,productName,quantity,price,image) VALUES('$cmrId','$productId','$productName','$quantity','$price','$image')";
	$Insert_row=$this->db->insert($query);
	}
}


}

public function payableAmount($cmrId){
$query="SELECT price FROM tbl_order WHERE cmrId ='$cmrId' AND date = now()";
$result=$this->db->select($query);
return $result;

}

public function getAllOrder($cmrId){

$query="SELECT * FROM tbl_order WHERE cmrId ='$cmrId' 	ORDER BY date DESC";
$result=$this->db->select($query);
return $result;
}

public function chkOrder($cmrId){
$query="SELECT * FROM tbl_order WHERE cmrId='$cmrId'";
$result=$this->db->select($query);
return $result;
}

public function getproductOrder(){
$query= "SELECT * FROM tbl_order ";
$result=$this->db->select($query);
return $result;
}

public function productShifted($id,$date,$price){
$id=mysqli_escape_string($this->db->link,$id);
$date=mysqli_escape_string($this->db->link,$date);
$price=mysqli_escape_string($this->db->link,$price);
$query="UPDATE tbl_order 
			        SET 
			        status ='1'
			        WHERE cmrId='$id' AND date ='$date' AND price='$price'";
			$update_rows=$this->db->update($query);  
			if ($update_rows) {
			      	$msg="<span class='success'> Updated Successfully.</span>";
                     return $msg;
			      }  else{
			      	$msg="<span class='error'> Not Updated.</span>";
			         return $msg;

			      } 


}

public function delproductShifted($id,$date,$price){
$id=mysqli_escape_string($this->db->link,$id);
$date=mysqli_escape_string($this->db->link,$date);
$price=mysqli_escape_string($this->db->link,$price);

$query="DELETE FROM tbl_order WHERE cmrId='$id' AND price='$price'";
		$delpro=$this->db->delete($query);
		if ($delpro) {
			$msg="<span class='success'>Data Deleted Successfully.</span>";
             return $msg;
		}else{
			$msg="<span class='error'>Data Not Deleted.</span>";
			return $msg;

		}

}

public function productShiftconfirm($id,$date,$price){

	$id=mysqli_escape_string($this->db->link,$id);
$date=mysqli_escape_string($this->db->link,$date);
$price=mysqli_escape_string($this->db->link,$price);
$query="UPDATE tbl_order 
			        SET 
			        status ='2'
			        WHERE cmrId='$id' AND date ='$date' AND price='$price'";
			$update_rows=$this->db->update($query);  
			if ($update_rows) {
			      	$msg="<span class='success'> Updated Successfully.</span>";
                     return $msg;
			      }  else{
			      	$msg="<span class='error'> Not Updated.</span>";
			         return $msg;

			      } 
}


}



?>
<?php
$filepath=realpath(dirname(__FILE__));

include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helper/formate.php');
?>


<?php

class Brand 
{
	private $db;
    private $fm;	

	public function __construct()
	{
		$this->db=new Database();
		$this->fm=new Format();
}
public function brandInsert($brandName){
		$brandName=$this->fm->validation($brandName);
		$brandName=mysqli_escape_string($this->db->link,$brandName);

		if (empty($brandName)) {
			$msg="<span class='error'>Brand name must not be empty!</span>";
			return $msg;
		}else{
			$query="INSERT INTO tbl_brand(brandName) VALUES('$brandName')";
			$brandInsert=$this->db->insert($query);
			if ($brandInsert) {
				$msg="<span class='success'>Brand Inserted Successfully.</span>";

			    return $msg;
			}else{
				$msg="<span class='error'>Brand Not Inserted.</span>";
			    return $msg;
			}
		}
	}
public function allGetbrand(){
	$query="SELECT * FROM tbl_brand ORDER BY brandId DESC";
		$result=$this->db->select($query);
		return $result;
}

public function getAllId($id){
		$query="SELECT * FROM tbl_brand WHERE brandId='$id'";
		$result=$this->db->select($query);
		return $result;
	}

	public function brandUpdate($brandName,$id){

		$brandName=$this->fm->validation($brandName);
		$brandName=mysqli_escape_string($this->db->link,$brandName);
		$id=mysqli_escape_string($this->db->link,$id);

		if (empty($brandName)) {
			$msg="<span class='error'>Brand name must not be empty!</span>";
			return $msg;
		}else{
			$query="UPDATE tbl_brand 
			        SET 
			        brandName='$brandName'
			        WHERE brandId='$id'";
			$update_rows=$this->db->update($query);  
			if ($update_rows) {
			      	$msg="<span class='success'>Brand name Updated Successfully.</span>";
                     return $msg;
			      }  else{
			      	$msg="<span class='error'>Brand name Not Updated.</span>";
			         return $msg;

			      }    
		}
	}
	public function delbrandById($id){
		$query="DELETE FROM tbl_brand WHERE brandId='$id'";
		$delbrand=$this->db->delete($query);
		if ($delbrand) {
			$msg="<span class='success'>Brand name Deleted Successfully.</span>";
             return $msg;
		}else{
			$msg="<span class='error'>Brand name Not Deleted.</span>";
			return $msg;

		}
	}

}

?>
<?php
$filepath=realpath(dirname(__FILE__));

include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helper/formate.php');
?>
<?php
class Category
{
  private $db;
  private $fm;	

	public function __construct()
	{
		$this->db=new Database();
		$this->fm=new Format();

	}
	public function catInsert($catName){
		$catName=$this->fm->validation($catName);
		$catName=mysqli_escape_string($this->db->link,$catName);

		if (empty($catName)) {
			$msg="<span class='error'>Category must not be empty!</span>";
			return $msg;
		}else{
			$query="INSERT INTO tbl_category(catName) VALUES('$catName')";
			$catInsert=$this->db->insert($query);
			if ($catInsert) {
				$msg="<span class='success'>Category Inserted Successfully.</span>";

			    return $msg;
			}else{
				$msg="<span class='error'>Category Not Inserted.</span>";
			    return $msg;
			}
		}
	}
	public function allGetCat(){
		$query="SELECT * FROM tbl_category ORDER BY catId DESC";
		$result=$this->db->select($query);
		return $result;
	}
	public function getAllId($id){
		$query="SELECT * FROM tbl_category WHERE catId='$id'";
		$result=$this->db->select($query);
		return $result;
	}
	public function catUpdate($catName,$id){
		$catName=$this->fm->validation($catName);
		$catName=mysqli_escape_string($this->db->link,$catName);
		$id=mysqli_escape_string($this->db->link,$id);

		if (empty($catName)) {
			$msg="<span class='error'>Category must not be empty!</span>";
			return $msg;
		}else{
			$query="UPDATE tbl_category 
			        SET 
			        catName='$catName'
			        WHERE catId='$id'";
			$update_rows=$this->db->update($query);  
			if ($update_rows) {
			      	$msg="<span class='success'>Category Updated Successfully.</span>";
                     return $msg;
			      }  else{
			      	$msg="<span class='error'>Category Not Updated.</span>";
			         return $msg;

			      }    
		}
	}

	public function delCatById($id){
		$query="DELETE FROM tbl_category WHERE catId='$id'";
		$delCat=$this->db->delete($query);
		if ($delCat) {
			$msg="<span class='success'>Category Deleted Successfully.</span>";
             return $msg;
		}else{
			$msg="<span class='error'>Category Not Deleted.</span>";
			return $msg;

		}
	}
}

?>
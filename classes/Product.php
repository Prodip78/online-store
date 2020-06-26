<?php
$filepath=realpath(dirname(__FILE__));

include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helper/formate.php');
?>
<?php

class Product 
{
	private $db;
    private $fm;	

	public function __construct()
	{
		$this->db=new Database();
		$this->fm=new Format();
}
public function productInsert($data,$file){
$productName =mysqli_escape_string($this->db->link,$data['productName']);
$catId       =mysqli_escape_string($this->db->link,$data['catId']);
$brandId     =mysqli_escape_string($this->db->link,$data['brandId']);
$body        =mysqli_escape_string($this->db->link,$data['body']);
$price       =mysqli_escape_string($this->db->link,$data['price']);
$type        =mysqli_escape_string($this->db->link,$data['type']);


 $permited     = array('jpg', 'jpeg', 'png', 'gif');
    $file_name = $file['image']['name'];
    $file_size = $file['image']['size'];
    $file_temp = $file['image']['tmp_name'];

    $div            = explode('.', $file_name);
    $file_ext       = strtolower(end($div));
    $unique_image   = substr(md5(time()), 0, 10).'.'.$file_ext;
    $uploaded_image = "uploads/".$unique_image;

if ($productName=='' || $catId=='' || $brandId=='' || $body=='' || $price=='' || $file_name=='' ||  $type=='') {
	$msg="<span class='error'>Filed must not be empty!</span>";
    return $msg;

}elseif ($file_size >1048567) {
     echo "<span class='error'>Image Size should be less then 1MB!
     </span>";
    } elseif (in_array($file_ext, $permited) === false) {
     echo "<span class='error'>You can upload only:-"
     .implode(', ', $permited)."</span>";
    }else{
	move_uploaded_file($file_temp, $uploaded_image);
	$query="INSERT INTO tbl_product(productName,catId,brandId,body,price,image,type) VALUES('$productName','$catId','$brandId','$body','$price','$uploaded_image','$type')";
	$productInsert=$this->db->insert($query);

	if ($productInsert) {
				$msg="<span class='success'>Product Inserted Successfully.</span>";

			    return $msg;
			}else{
				$msg="<span class='error'>Product Not Inserted.</span>";
			    return $msg;
			}
}

}
public function getAllProduct(){
$query="SELECT p.*,c.catName,b.brandName
		FROM tbl_product as p,tbl_category as c,tbl_brand as b
		WHERE p.catId=c.catId AND p.brandId=b.brandId 

		ORDER BY p.productId DESC";




/*$query="SELECT tbl_product.*, tbl_category.catName,tbl_brand.brandName
FROM tbl_product
INNER JOIN tbl_category
ON tbl_product.catId=tbl_category.catId

INNER JOIN tbl_brand
ON tbl_product.brandId=tbl_brand.brandId

 ORDER BY tbl_product.productId DESC";
 */
$result=$this->db->select($query);
return $result;

}


public function getProByid($id){
	$query="SELECT * FROM tbl_product WHERE productId='$id'";
	$result=$this->db->select($query);
	return $result;
}

public function productUpdate($data,$file,$id){
$productName =mysqli_escape_string($this->db->link,$data['productName']);
$catId       =mysqli_escape_string($this->db->link,$data['catId']);
$brandId     =mysqli_escape_string($this->db->link,$data['brandId']);
$body        =mysqli_escape_string($this->db->link,$data['body']);
$price       =mysqli_escape_string($this->db->link,$data['price']);
$type        =mysqli_escape_string($this->db->link,$data['type']);


 $permited     = array('jpg', 'jpeg', 'png', 'gif');
    $file_name = $file['image']['name'];
    $file_size = $file['image']['size'];
    $file_temp = $file['image']['tmp_name'];

    $div            = explode('.', $file_name);
    $file_ext       = strtolower(end($div));
    $unique_image   = substr(md5(time()), 0, 10).'.'.$file_ext;
    $uploaded_image = "uploads/".$unique_image;

if ($productName=='' || $catId=='' || $brandId=='' || $body=='' || $price=='' || $type=='') {
	$msg="<span class='error'>Filed must not be empty!</span>";
    return $msg;

}else{
	if (!empty($file_name)) {
	
if ($file_size >1048567) {
     echo "<span class='error'>Image Size should be less then 1MB!
     </span>";
    } elseif (in_array($file_ext, $permited) === false) {
     echo "<span class='error'>You can upload only:-"
     .implode(', ', $permited)."</span>";
    }else{
	move_uploaded_file($file_temp, $uploaded_image);
	$query="UPDATE tbl_product
			SET 
			productName='$productName',
			catId='$catId',
			brandId='$brandId',
			body='$body',
			price='$price',
			image='$uploaded_image',
			type='$type'
			WHERE productId='$id' ";
                                 
	$productUpdate=$this->db->update($query);

	if ($productUpdate) {
				$msg="<span class='success'>Product Updated Successfully.</span>";

			    return $msg;
			}else{
				$msg="<span class='error'>Product Not Updated.</span>";
			    return $msg;
			}
       }
       	}else{
       			
	 $query="UPDATE tbl_product
			SET 
			productName='$productName',
			catId='$catId',
			brandId='$brandId',
			body='$body',
			price='$price',
			type='$type'
			WHERE productId='$id'";
                                 
	$productUpdate=$this->db->update($query);

	if ($productUpdate) {
				$msg="<span class='success'>Product Updated Successfully.</span>";

			    return $msg;
			}else{
				$msg="<span class='error'>Product Not Updated.</span>";
			    return $msg;
			}
       	}
    }

 }

public function delproById($id){
	$query="SELECT * FROM tbl_product WHERE productId='$id'";
	$getData=$this->db->select($query);
	if ($getData) {
		while ($delImg=$getData->fetch_assoc()) {
				$delLink= $delImg['image'];
				unlink($delLink);
			}
		}

       $delquery="DELETE FROM tbl_product WHERE productId='$id'";
      $delData=$this->db->delete($delquery);
		if ($delData) {
			$msg="<span class='success'>Product Deleted Successfully.</span>";
             return $msg;
		}else{
			$msg="<span class='error'>Product Not Deleted.</span>";
			return $msg;

		}

}

public function getFeatureProduct(){

    $query="SELECT * FROM tbl_product WHERE type='0' ORDER BY productId DESC LIMIT 4";
	$result=$this->db->select($query);
	return $result;

}

public function getNewProduct(){
$query="SELECT * FROM tbl_product ORDER BY productId DESC LIMIT 4";
	$result=$this->db->select($query);
	return $result;


}
public function getSingleProduct($id){
$query="SELECT p.*,c.catName,b.brandName
		FROM tbl_product as p,tbl_category as c,tbl_brand as b
		WHERE p.catId=c.catId AND p.brandId=b.brandId AND p.productId='$id'";

// 	$query="SELECT tbl_product.*, tbl_category.catName,tbl_brand.brandName
// FROM tbl_product
// INNER JOIN tbl_category
// ON tbl_product.catId=tbl_category.catId

// INNER JOIN tbl_brand
// ON tbl_product.brandId=tbl_brand.brandId=tbl_product.productId='$id'";

$result=$this->db->select($query);
return $result;

}
public function getProIphone(){
$query="SELECT * FROM tbl_product WHERE brandId='2' ORDER BY productId DESC LIMIT 1";
	$result=$this->db->select($query);
	return $result;

}

public function getProSAMSUNG(){
$query="SELECT * FROM tbl_product WHERE brandId='3' ORDER BY productId DESC LIMIT 1";
	$result=$this->db->select($query);
	return $result;

}
public function getProAcer(){
$query="SELECT * FROM tbl_product WHERE brandId='1' ORDER BY productId DESC LIMIT 1";
	$result=$this->db->select($query);
	return $result;

}
public function getProCanon(){
$query="SELECT * FROM tbl_product WHERE brandId='4' ORDER BY productId DESC LIMIT 1";
	$result=$this->db->select($query);
	return $result;

}
public function productByCat($id){
     $query="SELECT * FROM tbl_product WHERE catId='$id'";
	 $result=$this->db->select($query);
	 return $result;


}

public function InsertCompareData($cmpId,$cmrId){
	$cmrId        =mysqli_real_escape_string($this->db->link,$cmrId);

$productId        =mysqli_real_escape_string($this->db->link,$cmpId);

$query="SELECT * FROM tbl_product WHERE productId='$productId'";
$result=$this->db->select($query)->fetch_assoc();
if ($result) {
	
		$productId=$result['productId'];
		$productName=$result['productName'];
		$price=$result['price'];
		$image=$result['image'];

		$query="INSERT INTO tbl_compaire(cmrId,productId,productName,price,image) VALUES('$cmrId','$productId','$productName','$price','$image')";
	$Insert_row=$this->db->insert($query);
if ($Insert_row) {
 
 	$msg="<span class='success'>Added to Compare.</span>";

			    return $msg;
			}else{
				$msg="<span class='error'> Not Added!</span>";
			    return $msg;
			}


}


	}









}









?>
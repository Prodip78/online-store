<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';
include_once '../helper/formate.php';
?>
<?php include '../classes/Product.php'?>

<?php
$product=new Product();
$fm=new Format();
?>
<?php

if (isset($_GET['delproduct'])) {
	$id=$_GET['delproduct'];
	$delData=$product->delproById($id);
}

?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <div class="block"> 
        <?php
                if (isset($delData)) {
                    echo $delData;
                }


                ?>       
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>SL</th>
					<th>productName</th>
					<th>Category</th>
					<th>Brand</th>
					<th>Description</th>
					<th>Price</th>
					<th>Image</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$getProduct=$product->getAllProduct();

				if ($getProduct) {
					$i=0;
					while ($result=$getProduct->fetch_assoc()) {
						$i++;
				?>
				<tr class="odd gradeX">
					<td><?php echo $i;?></td>
					<td><?php echo $result['productName'];?></td>
					<td><?php echo $result['catName'];?></td>
					<td class="center"><?php echo $result['brandName'];?></td>
					<td><?php echo $fm->textShorten( $result['body'],50);?></td>
					<td>$<?php echo $result['price'];?></td>
					<td><img src="<?php echo $result['image'];?>" height="40px;" width="60px;"></td>
					<td>
						<?php 
						if ($result['type']==0) {
							echo "featured";
						}else{
							echo "general";
						}

						?>
							
						</td>
					<td class="center"> 4</td>
					<td><a href="productEdit.php?productId=<?php echo $result['productId'];?>">Edit</a> || <a onclick="return confirm('Are you sure to Delete')" href="?delproduct= <?php echo $result['productId'];?>">Delete</a></td>
				</tr>
			<?php } }?>
			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>

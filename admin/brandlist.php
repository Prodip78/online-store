<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php'?>

<?php
$brand=new Brand();

if (isset($_GET['delBrand'])) {
	$id=$_GET['delBrand'];
	$delData=$brand->delbrandById($id);
}

?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Brand List</h2>
                <div class="block"> 

               <?php
                 if (isset($delData)) {
                    echo $delData;
                }


                ?>      
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Brand Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$getBrand=$brand->allGetbrand();
						$i=0;
						if ($getBrand) {
							while ($result=$getBrand->fetch_assoc()) {
								$i++;
							
						?>

						<tr class="odd gradeX">
							<td><?php echo $i;?></td>
							<td><?php echo $result['brandName'];?></td>
							<td><a href="brandEdit.php?brandId=<?php echo $result['brandId'];?>">Edit</a> || <a onclick="return confirm('Are you sure to Delete')" href="?delBrand= <?php echo $result['brandId'];?>">Delete</a></td>
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


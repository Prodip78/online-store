<?php include 'inc/header.php';?>
<?php
$login=Session::get("cusLogin");
if ($login==false) {
	header("Location:login.php");
}

?>
<?php
if (isset($_GET['custId'])) {
	$id =$_GET['custId'];
	$date =$_GET['date'];
	$price =$_GET['price'];
	$confirm=$ct->productShiftconfirm($id,$date,$price);
}



?>




<style>
	.tblone tr td{text-align: justify;}

</style>

<div class="main">
	<div class="content">
		<div class="section group">
			<div class="order">
				<h2>Your ordered details</h2>
				<?php
				if (isset($confirm)) {
					echo $confirm;
				}
				?>

				<table class="tblone">
							<tr>
								<th>No</th>
								<th>Product Name</th>
								<th>Image</th>
								<th>Quantity</th>
								<th>Price</th>
								<th>Date</th>
								<th>status</th>
								<th>Action</th>
							</tr>
							<tr>
								<?php
								$cmrId=Session::get("cmrId");
								$getorder=$ct->getAllOrder($cmrId);
								if ($getorder) {
									$i=0;
									while ($result=$getorder->fetch_assoc()) {
										$i++;							
								?>



								<td><?php echo $i;?></td>
								<td><?php echo $result['productName'];?></td>
								<td><img src="admin/<?php echo $result['image'];?>" alt=""/></td>
								<td><?php echo $result['quantity'];?></td>
								
								<td>Tk<?php $total=$result['price'];?>
								                                             
									
								</td>
								<td><?php echo $fm->formatDate($result['date']);?></td>

								<td>
									<?php
									 if ($result['status']=='0') {
									 	echo "Pending";
									 }elseif ($result['status']=='1') { 
									 	echo "Shifted";
									  }else{
									 	echo "ok";
									 }
									 ?>
										
									</td>
									<?php
									if ($result['status']=='1') {?>
										<td><a href="?custId=<?php echo $cmrId;?>& price=<?php echo $result['price'];?>& date=<?php echo $result['date'];?>">Confirm</a></td>
									<?php }elseif ($result['status']=='2') {?>
										<td>ok</td>

									<?php } elseif ($result['status']=='0') {?>
										<td>N/A</td>
									<?php } ?>

									
								
							</tr>
														
							<?php } }?>
							
						</table>


			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<?php include 'inc/footer.php';?>
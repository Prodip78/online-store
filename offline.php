<?php include 'inc/header.php'?>

<?php
$login=Session::get("cusLogin");
if ($login==false) {
	header("Location:login.php");
}
?>

<?php
if (isset($_GET['orderId']) && $_GET['orderId'] == 'order' ) {
  $cmrId=Session::get("cmrId");
  $insertOder=$ct->proOder($cmrId);
  $delDelete=$ct->deleteCustCart();
  header("Location:success.php");
}
?>



<style>
.division{width: 50%;float: left;}
.tblone{width: 550px;margin: 0 auto;border:2px solid #ddd;
}
.tblone tr td{text-align: justify;} 


.tbltwo{float:right;text-align:left;width: 70%;border:2px solid #ddd;margin-right: 14px;margin-top: 12px;}
.tbltwo tr td{text-align: justify; padding: 5px 10px;} 

.back a{width: 160px;margin: 5px auto 0;padding: 7px 0;text-align: center;display: block;background: #f2f;border:1px solid #333;color: #fff;border-radius: 10px;font-size: 25px; margin-bottom: 10px}

.ordernow{padding-bottom: 30px;}
.ordernow a{width: 200px;margin: 20px auto 0;text-align: center;padding: 5px;font-size: 30px;display: block;background: #ff0000;color: #fff;border-radius: 3px;}
</style>

 <div class="main">
    <div class="content">
    	<div class="section group">
	       <div class="division">


        <div class="back">
               <a href="cart.php">Previous</a>
           </div>

            <table class="tblone">
              <tr>
                <th>No</th>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total </th>
              </tr>
              <tr>
                <?php

                $getpro=$ct->getAllPro();
                if ($getpro) {
                  $i=0;
                  $sum=0;
                  $qty=0;
                  while ($result=$getpro->fetch_assoc()) {
                    $i++;
              
                ?>



                <td><?php echo $i;?></td>
                <td><?php echo $result['productName'];?></td>
                <td>Tk<?php echo $result['price'];?></td>
                <td><?php echo $result['quantity'];?></td>

             
                <td>Tk
                  <?php 
                      $total=$result['price']*$result['quantity'];
                       echo $total;
                     ?>
                  
                </td>

                
              </tr>
              <?php
              $qty=$qty+ $result['quantity'];
              $sum=$sum+$total;
              
              ?>
              
              <?php } }?>
              
            </table>


            <table class="tbltwo">
              <tr>
                <td>Sub Total</td>
                <td>:</td>
                <td><?php echo $sum;?></td>
              </tr>
              <tr>
                <td>VAT</td>
                <td>:</td>
                <td>10%(<?php echo $vat=$sum * 0.1;?>)</td>
              </tr>
              <tr>
                <td>Grand Total</td>
                <td>:</td>
                <td><?php
                $vat=$sum * 0.1;
                $grandTotal=$sum+$vat;
                echo $grandTotal;
                ?></td>
              </tr>

              <tr>
                <td>Quantity</td>
                <td>:</td>
                <td><?php echo $qty;?></td>
              </tr>


             </table>
            
          

         </div>


         <div class="division">

           
  <?php
$id=Session::get("cmrId");
$getData=$ctmr->getCustomerData($id);
if ($getData) {
    while ($result = $getData->fetch_assoc()) {
 

?>
            <table class="tblone">
                <tr>
                    <td colspan="3"><h2>Your Profile Details</h2></td>
                 </tr>

          <tr>
            <td width="20%">Name</td>
            <td width="5%">:</td>
            <td><?php echo $result['name'];?></td>
          </tr>
          <tr>
            <td>Phone</td>
            <td>:</td>
            <td><?php echo $result['phone'];?></td>
          </tr>
          <tr>
            <td>Email</td>
            <td>:</td>
            <td><?php echo $result['email'];?></td>
          </tr>
          <tr>
            <td>Address</td>
            <td>:</td>
            <td><?php echo $result['address'];?></td>
          </tr>
          <tr>
            <td>City</td>
            <td>:</td>
            <td><?php echo $result['city'];?></td>
          </tr>
          <tr>
            <td>Zip code</td>
            <td>:</td>
            <td><?php echo $result['zip'];?></td>
          </tr>
          <tr>
            <td>Country</td>
            <td>:</td>
            <td><?php echo $result['country'];?></td>
          </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td><a href="profileEdit.php">Update Details</a></td>
                </tr>



        </table>
      <?php } } ?>

      </div>
          
 	</div>
<div class="ordernow"><a href="?orderId=order">Order</a></div>


	</div>
	<?php include 'inc/footer.php'?>

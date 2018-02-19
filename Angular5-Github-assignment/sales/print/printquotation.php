<?php
require '../logincheck.php';
?>
<!DOCTYPE html>
<html lang="en">
	<head>        
		<title>Sales and Order Management System</title>            
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" type="text/css" id="theme" href="../css/theme-blue.css"/>
		<script src="../js/plugins/jquery/jquery.min.js"></script>
		<style type="text/css">
			@media print {
				#print{
					display: none !important;
				}
			}
		</style>
	</head>
	<body>
		<?php 
		$conn = new mysqli("localhost", "root", "", "sales") or die(mysqli_error());
		$query = $conn->query("SELECT * FROM `users` WHERE `user_id` = $_SESSION[user_id]") or die(mysqli_error());
		$find = $query->fetch_array();
		?>
		<div class="page-content">
			<div class="row">
				<div class="col-md-12">
					<!-- START TEXT ELEMENTS -->
					<div class="panel panel-default">
						<div class="panel-heading">
							<div class="btn-group pull-left">
								<div class="pull-left">
									<img style="width:30px;height:30px;"src="../assets2/img/cubes.png" alt="BC Logo"/>     
								</div>
							</div>
							<h3 class="panel-title"><strong>Product Quotation</strong><span style="font-size:12px;"> </span></h3>
							<div class="btn-group pull-right">
								<div class="pull-left">
									<i><?php echo date('F j, Y', strtotime("+8 HOURS"));?></i>
									<button id="print" class="btn btn-default btn-sm" onclick="javascript:window.print()">Print</button>      
								</div>
							</div> 
						</div>
						<div class="panel-body">
							<div class="row">
								<?php
								$query1 = $conn->query("SELECT * FROM `temp_trans` where `user_id` = '$_GET[id]' ORDER BY `temp_trans_id` DESC") or die(mysqli_error());
								$fetch1 = $query1->fetch_array();
								$query2 = $conn->query("SELECT * FROM `users` where `user_id` = '$_GET[id]'") or die(mysqli_error());
								$fetch2 = $query2->fetch_array();
								?>
								<p><span style="font-size:12px;">Sales and Order Management System</span></p>
								<p><span style="font-size:12px;">XYZ Corporation</span></p>
								<p><span style="font-size:12px;">Lizares Avenue, Bacolod City</span></p>
								<p><span style="font-size:12px;">Quotation Number: 000<?php echo $fetch1['temp_trans_id']?></span></p><br>
								<p><span style="font-size:15px;">Customer Name: <?php echo $fetch2['fullname']?></span></p>
								<p><span style="font-size:15px;">Contact Number: <?php echo $fetch2['contact_no']?></span></p><br>
								<table class="table table-condensed">
									<thead>

										<tr>
											<th><center>Quantity</center></th>
											<th><center>Unit</center></th>
											<th><center>Product Name</center></th>
											<th><center>Product Price</center></th>
											<th><center>Total</center></th>
										</tr>
									</thead>
									<tbody>

									</tbody><tbody>

									<?php
	$conn = new mysqli ("localhost", "root", "", "sales") or die(mysqli_error());
									$query = $conn->query("SELECT * FROM `temp_trans` where `user_id` = '$_GET[id]' && `status` = 'Pending' ORDER BY `temp_trans_id` DESC") or die(mysqli_error());
									$grand = 0;

									while($fetch = $query->fetch_array()){
										$total = $fetch['quantity']*$fetch['price'];
										$grand=$grand+$total;
									?>
									<tr>
										<td><center><?php echo $fetch['quantity']?></center></td>
										<td><center>pc/s</center></td>
										<td><center><?php echo $fetch['prod_name']?></center></td>
										<td><center><?php echo $fetch['price']?></center></td>
										<td><center><?php echo number_format($total, 2)?></center></td>
									</tr>
									<?php
									}
									$conn->close();
									?>
									<tr>
										<td></td>
										<td></td>
										<td></td>
										<td><center><strong><span style="font-size:17px;">Total Amount Due</span></strong></center></td>
										<td><center><strong><span style="font-size:17px;">Php <?php echo number_format($grand, 2)?></span></strong></center></td>
									</tr>
									</tbody>
								</table>
								<div class="panel-body">
									<div class="col-md-12">
										<div id="treatment_outcome" style="width: 100%; height: 275px"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="../js/plugins/jquery/jquery-ui.min.js"></script>
		<script type="text/javascript" src="../js/plugins/bootstrap/bootstrap.min.js"></script>        
		<script type="text/javascript" src="../js/plugins/datatables/jquery.dataTables.min.js"></script>  
	</body>
</html>






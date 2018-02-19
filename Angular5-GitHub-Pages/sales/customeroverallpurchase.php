<?php
require 'logincheck.php';
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Sales Order Management System</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="icon" href="assets/images/project_logo.png" type="image/x-icon" />
		<link rel="stylesheet" type="text/css" id="theme" href="css/theme-brown.css" />
		<link rel="stylesheet" type="text/css" href="assets2/vendor/font-awesome/css/font-awesome.min.css" />
	</head>
	<body>
		<?php 
		require 'config.php';
		$query = $conn->query("SELECT * FROM `users` WHERE `user_id` = $_SESSION[user_id]") or die(mysqli_error());
		$find = $query->fetch_array();
		?>
		<div class="page-container">
			<?php require 'require/employeesidebar.php'?>
			<div class="page-content">
				<?php require 'require/header.php'?>
				<ul class="breadcrumb">
					<li class="active"><strong><mark>Products</mark></strong></li>
				</ul>
				<div class="page-content-wrap">
					<div class="row">

						<div class="col-md-8">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<h3 class="panel-title">Purchase List</h3>
									<div class="btn-group pull-right">
										<div class="pull-left">
											<button class="btn btn-default btn-md" data-toggle="modal" data-target="#new_purchase">Add Products</button>
										</div>
									</div>
								</div>
								<div class="panel-body list-group list-group-contacts scroll" style="height: 470px;">
									<div class="panel-body">
										<table id="print" class="table table-hover">
											<thead>
												<tr class="warning">

													<th><center>Product Name</center></th>
													<th><center>Quantity</center></th>
													<th><center>Price</center></th>
													<th><center>Total</center></th>
													<th><center>Action</center></th>
												</tr>
											</thead>
											<tbody>
												<?php
	$conn = new mysqli("localhost", "root", "", "sales") or die(mysqli_error());
			$query = $conn->query("SELECT * from `purchase` where `user_id` = '$_GET[id]' && `status` = 'Pending'") or die(mysqli_error());
			$grand = 0;
			while($fetch = $query->fetch_array()){
				$total = $fetch['quantity']*$fetch['price'];
				$grand=$grand+$total;
												?>
												<tr>
													<td><center><?php echo $fetch['prod_name']?></center></td>
													<td><center><?php echo $fetch['quantity']?></center></td>
													<td><center><?php echo $fetch['price']?></center></td>
													<td><center><?php echo number_format($total, 2)?></center></td>
													<td><center>
														<a href="#updatepurchase<?php echo $fetch['purchase_id'];?>" data-target="#updatepurchase<?php echo $fetch['purchase_id'];?>" data-toggle="modal" class="btn btn-default btn-sm">Edit</a>
														<a href="#deletepurchase<?php echo $fetch['purchase_id'];?>" data-target="#deletepurchase<?php echo $fetch['purchase_id'];?>" data-toggle="modal" class = "btn btn-sm btn-danger">Delete</a>
														</center>
													</td>
												</tr>
												<?php
			}
			$conn->close();
												?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="panel panel-primary">
								<div class="panel-body">
									<form method="post">
										<div class="form-group">
											<label>Total</label>
											<input style="color:#000; text-align:right; font-size:15px;" type="text" name="total" class="form-control" value="<?php echo number_format($grand,2)?>"disabled/>
										</div> 
										<div class="form-group">
											<label>Amount Due</label>
											<input style="color:#000; text-align:right; font-size:15px;" type="text" name="final" class="form-control" 
												   value="<?php echo number_format($grand,2)?>"disabled/>
										</div>  
										<div class="form-group">
											<label>Cash Tendered</label>
											<input style="color:#000; text-align:right; font-size:15px;" type="text" name="tendered" class="form-control" onFocus="startCalc();" onBlur="stopCalc();"  id="cash" value="0"/>
										</div>  
										<div class="form-group">
											<label>Change</label>
											<input style="color:#000; text-align:right; font-size:15px;" type="text" id="changed" name="change" class="form-control" 
												   />
										</div>  

										<div class="form-group">
											<a href="#" class="btn btn-warning btn-md" onclick="oInv()">Complete Sales</a>
										</div>  
									</form>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>

		<div class="modal fade" id="new_purchase" tabindex="-1" role="dialog" aria-labelledby="smallModalHead" aria-hidden="true">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title" id="smallModalHead">Choose Products</h4>
					</div>
					<form role="form" class="form-horizontal" action="actions/purchase.php" method="post" onsubmit="return confirm('Add to Purchase List?');">
						<div class="modal-body">
							<div class="row">
								<div class="panel-body">
									<div class="form-group">
										<label>Product Name</label>
										<input type="hidden"  name="user_id" value="<?php echo $_GET['id']?>"class="form-control"/>
										<select class="form-control select" name="prod_name" data-live-search="true">
											<option>Select</option>
											<?php
	$conn = new mysqli("localhost", "root", "", "sales") or die(mysqli_error());
												   $query = $conn->query("SELECT * FROM `products`") or die(mysqli_error());
												   while($fetch = $query->fetch_array()){
											?>
											<option value="<?php echo $fetch['prod_name'];?>"><?php echo $fetch['prod_name']?></option>
											<?php
												   }
											?>
										</select>
									</div>
									<div class="form-group">
										<label>Quantity</label>
										<input type="number" name="quantity" class="form-control"/>
									</div>    
								</div>
							</div>                       
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-default" name="purchase">Purchase</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		<?php
		$conn = new mysqli("localhost", "root", "", "sales") or die(mysqli_error());
		$query = $conn->query("SELECT * FROM `purchase`") or die(mysqli_error());
		while($fetch = $query->fetch_array()){
		?>
		<div id="updatepurchase<?php echo $fetch['purchase_id'];?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="smallModalHead" aria-hidden="true">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title" id="smallModalHead">Update Purchase</h4>
					</div>
					<form role="form" class="form-horizontal" action="actions/updatepurchase.php" method="post" onsubmit="return confirm('Are you sure you want to update this product?');">
						<div class="modal-body">
							<div class="row">
								<div class="panel-body">
									<h5 class="push-up-1">Quantity</h5>
									<div class="form-group ">
										<div class="col-md-12 col-xs-12">
											<input type="hidden"  name="user_id" value="<?php echo $_GET['id']?>"class="form-control"/>
											<input type="hidden" name="purchase_id" value="<?php echo $fetch['purchase_id']?>">
											<input required type="text" class="form-control" name="quantity" value="<?php echo $fetch['quantity']?>"/>
										</div>
									</div>
								</div>
							</div>   
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-default" name="update">Update</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span>Cancel</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div id="deletepurchase<?php echo $fetch['purchase_id'];?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="smallModalHead" aria-hidden="true">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title" id="smallModalHead">Delete Product</h4>
					</div>
					<form role="form" class="form-horizontal" action="actions/deletepurchase.php" method="post">
						<div class="modal-body">
							<div class="row">
								<div class="panel-body">
									<input type="hidden"  name="user_id" value="<?php echo $_GET['id']?>"class="form-control"/>
									<input type="hidden" name="purchase_id" value="<?php echo $fetch['purchase_id']?>">
									<h5 class="push-up-1">Are you sure you want to delete <?php echo $fetch['prod_name']?></h5>
								</div>
							</div>   
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-danger" name="delete">Delete</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<?php
		}
		$conn->close();
		?>


		<script>
			function oInv() {
				myWindow = window.open("print/printinvoice.php?id=<?php echo $_GET['id']?>", "", "width=1000, height=650");
			}
		</script>
		<?php require 'require/logout.php'?>
		<audio id="audio-fail" src="audio/fail.mp3" preload="auto"></audio>
		<script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
		<script type="text/javascript" src="js/plugins/jquery/jquery-ui.min.js"></script>
		<script type="text/javascript" src="js/plugins/bootstrap/bootstrap.min.js"></script>
		<script type='text/javascript' src='js/plugins/bootstrap/bootstrap-select.js'></script>
		<script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
		<script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
		<script type="text/javascript" src="js/plugins/datatables/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="js/plugins.js"></script>
		<script type="text/javascript" src="js/actions.js"></script> 
	</body>
</html>
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
		<script src="js/plugins/jquery/jquery.min.js"></script>
		<script src = "js/jquery.canvasjs.min.js"></script>
		<?php require 'js/loadchart/products.php'?>
	</head>
	<body>
		<?php 
	require 'config.php';
		$query = $conn->query("SELECT * FROM `users` WHERE `user_id` = $_SESSION[user_id]") or die(mysqli_error());
		$find = $query->fetch_array();
		?>
		<div class="page-container">
			<?php require 'require/managersidebar.php'?>
			<div class="page-content">
				<?php require 'require/header.php'?>
				<ul class="breadcrumb">
					<li class="active"><strong><mark>Products</mark></strong></li>
				</ul>
				<div class="page-content-wrap">
					<div class="panel-body list-group list-group-contacts scroll" style="height: 545px;">
						<div class="row">
							<div class="col-md-7">
								<div class="panel panel-primary">
									<div class="panel-heading">
										<h3 class="panel-title"><strong>Products List</strong></h3>
										<div class="btn-group pull-right">
											<div class="pull-left">
												<button data-toggle="modal" data-target="#addstocks" class="btn btn-default btn-md">Add Stocks</button>
											</div>
										</div>
									</div>
									<div class="panel-body">
										<table id="print" class="table datatable">
											<thead>
												<tr class="warning">
													<th><center>Code</center></th>
													<th><center>Name</center></th>
													<th><center>Description</center></th>
													<th><center>Supplier</center></th>
													<th><center>Price</center></th>
													<th><center>Balance</center></th>
												</tr>
											</thead>
											<tbody>
												<?php
	require 'config.php';
			$query = $conn->query("SELECT * FROM `products` ORDER BY `product_id` DESC") or die(mysqli_error());
			while($fetch = $query->fetch_array()){
												?>

												<tr>
													<td><center><?php echo $fetch['code']?></center></td>
													<td><center><?php echo $fetch['prod_name']?></center></td>
													<td><center><?php echo $fetch['description']?></center></td>
													<td><center><?php echo $fetch['supplier']?></center></td>
													<td><center>₱<?php echo number_format($fetch['price'], 2)?></center></td>
													<td><center><?php echo $fetch['balance']?></center></td>
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
							<div class="col-md-5">
								<div class="panel panel-primary">
									<div class="panel-heading">
										<h3 class="panel-title"><strong>Graphical</strong><strong></strong></h3>
									</div>
									<div class="panel-body">
										<div id="products" style="width: 100%; height: 400px"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="addstocks" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title" id="defModalHead">New Stocks</h4>
					</div>
					<form role="form" class="form-horizontal" action="actions/addstocks.php" method="post" onsubmit="return confirm('Are you sure you want to add new stocks for this product?');">
						<div class="modal-body">
							<div class="panel-body">
								<h5 class="push-up-1">Name of Product</h5>
								<div class="form-group ">
									<div class="col-md-12 col-xs-12">
										<select class="form-control select" data-live-search="true" name="prod_name" required>
											<option>Select</option>
											<?php
											$conn = new mysqli("localhost", "root", "", "sales") or die(mysqli_error());
											$query = $conn->query("SELECT * FROM `products`") or die(mysqli_error());

											while($fetch = $query->fetch_array()){
											?>
											<option value="<?php echo $fetch['prod_name'];?>"><?php echo $fetch['prod_name'];?></option>
											<?php
											}
											?> 
										</select>
									</div>
								</div>
								<h5 class="push-up-1">Quantity</h5>
								<div class="form-group ">
									<div class="col-md-12 col-xs-12">
										<input data-toggle="tooltip" data-placement="bottom" title="Quantity" type="number" class="form-control" name="quantity" 
											   required/>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-info" name="addstocks">Save</button> 
							<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>                        
						</div>
					</form>
				</div>
			</div>
		</div>
		<?php require 'require/logout.php'?>
		<audio id="audio-fail" src="audio/fail.mp3" preload="auto"></audio>
		<script type="text/javascript" src="js/plugins/jquery/jquery-ui.min.js"></script>
		<script type="text/javascript" src="js/plugins/bootstrap/bootstrap.min.js"></script>
		<script type='text/javascript' src='js/plugins/bootstrap/bootstrap-datepicker.js'></script>
		<script type='text/javascript' src='js/plugins/bootstrap/bootstrap-select.js'></script>
		<script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
		<script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
		<script type="text/javascript" src="js/plugins/datatables/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="js/plugins.js"></script>
		<script type="text/javascript" src="js/actions.js"></script> 
	</body>
</html>
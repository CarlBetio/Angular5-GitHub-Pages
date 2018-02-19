<?php
require 'logincheck.php';
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Sales and Order Management System</title>
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
					<li class="active"><strong><mark>Suppliers</mark></strong></li>
				</ul>
				<div class="page-content-wrap">
					<div class="panel-body list-group list-group-contacts scroll" style="height: 550px;">
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-primary">
									<div class="panel-heading">
										<h3 class="panel-title"><strong>Suppliers List</strong></h3>
										<div class="btn-group pull-right">
											<div class="pull-left">
												<button class="btn btn-default btn-md" data-toggle="modal" data-target="#new_supplier">New Supplier</button>
											</div>
										</div>
									</div>
									<div class="panel-body">
										<table id="print" class="table datatable">
											<thead>
												<tr class="warning">
													<th><center>Supplier Name</center></th>
													<th><center>Supplier Address</center></th>
													<th><center>Supplier Contact Number</center></th>
													<th><center>Action</center></th>
												</tr>
											</thead>
											<tbody>
												<?php
	require 'config.php';
			$query = $conn->query("SELECT * FROM `suppliers` ORDER BY `supplier_id` DESC") or die(mysqli_error());
			while($fetch = $query->fetch_array()){
												?>

												<tr>
													<td><center><?php echo $fetch['name']?></center></td>
													<td><center><?php echo $fetch['address']?></center></td>
													<td><center><?php echo $fetch['contactno']?></center></td>
													<td><center>
														<a href="#updatesupplier<?php echo $fetch['supplier_id'];?>" data-target="#updatesupplier<?php echo $fetch['supplier_id'];?>" data-toggle="modal" class="btn btn-default btn-sm">Edit</a>
														<a onclick = "return confirm('Are you sure you want to delete this supplier?');" href = "actions/deletesupplier.php?supplier_id=<?php echo $fetch['supplier_id']?>" class = "btn btn-sm btn-danger">Delete</a>
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
					</div>
				</div>
			</div>
		</div>


		<div class="modal fade" id="new_supplier" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title" id="defModalHead"><strong>New Supplier</strong></h4>
					</div>
					<form role="form" class="form-horizontal" action="actions/addsupplier.php" method="post" onsubmit="return confirm('Are you sure you want to add new supplier?');">
						<div class="modal-body">
							<div class="row">
								<div class="panel-body">
									<h5 class="push-up-1">Supplier Name</h5>
									<div class="form-group ">
										<div class="col-md-12 col-xs-12">
											<input required type="text" class="form-control" name="name"/>
										</div>
									</div>
									<h5 class="push-up-1">Supplier Address</h5>
									<div class="form-group ">
										<div class="col-md-12 col-xs-12">
											<input required type="text" class="form-control" name="address"/>
										</div>
									</div>
									<h5 class="push-up-1">Supplier Contact Number</h5>
									<div class="form-group ">
										<div class="col-md-12 col-xs-12">
											<input required type="text" class="form-control" name="contactno"/>
										</div>
									</div>
								</div>
							</div>                       
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-default" name="submit">Save Supplier</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span>Cancel</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		<?php
		$conn = new mysqli("localhost", "root", "", "sales") or die(mysqli_error());
		$query = $conn->query("SELECT * FROM `suppliers`") or die(mysqli_error());
		while($fetch = $query->fetch_array()){
		?>

		<div id="updatesupplier<?php echo $fetch['supplier_id'];?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title" id="defModalHead">Update Supplier</h4>
					</div>
					<form role="form" class="form-horizontal" action="actions/updatesupplier.php" method="post" onsubmit="return confirm('Are you sure you want to update this supplier?');">
						<div class="modal-body">
							<div class="row">
								<div class="panel-body">
									<h5 class="push-up-1">Supplier Name</h5>
									<div class="form-group ">
										<div class="col-md-12 col-xs-12">
											<input required type="hidden" class="form-control" name="supplier_id" value="<?php echo $fetch['supplier_id']?>"/>
											<input required type="text" class="form-control" name="name" value="<?php echo $fetch['name']?>"/>
										</div>
									</div>
									<h5 class="push-up-1">Supplier Address</h5>
									<div class="form-group ">
										<div class="col-md-12 col-xs-12">
											<input required type="text" class="form-control" name="address" value="<?php echo $fetch['address']?>"/>
										</div>
									</div>
									<h5 class="push-up-1">Supplier Contact Number</h5>
									<div class="form-group ">
										<div class="col-md-12 col-xs-12">
											<input required type="text" class="form-control" name="contactno" value="<?php echo $fetch['contactno']?>"/>
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
		<?php
		}
		$conn->close();
		?>

		<?php require 'require/logout.php'?>
		<audio id="audio-fail" src="audio/fail.mp3" preload="auto"></audio>
		<script src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
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
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
					<li class="active"><strong><mark>Employees</mark></strong></li>
				</ul>
				<div class="page-content-wrap">
					<div class="panel-body list-group list-group-contacts scroll" style="height: 550px;">
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-primary">
									<div class="panel-heading">
										<h3 class="panel-title"><strong>Customer List</strong></h3>
									</div>
									<div class="panel-body">
										<table id="print" class="table datatable">
											<thead>
												<tr class="warning">
													<th><center>Complete Name</center></th>
													<th><center>Contact Number</center></th>
													<th><center>Last Login</center></th>
													<th><center>Action</center></th>
												</tr>
											</thead>
											<tbody>
												<?php
	require 'config.php';
			$query = $conn->query("SELECT *, count(*) as total FROM `users`, `temp_trans` where users.user_id = temp_trans.user_id && `type` = 'Customer' && status = 'Pending' group by fullname") or die(mysqli_error());
			while($fetch = $query->fetch_array()){
												?>

												<tr>
													<td><center><?php echo $fetch['fullname']?></center></td>
													<td><center><?php echo $fetch['contact_no']?></center></td>
													<td><center><?php echo $fetch['login']?></center></td>
													<td><center><a href="customerquotation.php?id=<?php echo $fetch['user_id']?>" class="btn btn-default btn-md">Quotation <span class="badge badge-danger"><?php echo $fetch['total']?></span></a></center></td>
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
		<?php require 'require/logout.php'?>
		<audio id="audio-fail" src="audio/fail.mp3" preload="auto"></audio>
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
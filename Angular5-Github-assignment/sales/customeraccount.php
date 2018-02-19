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
			<?php require 'require/customersidebar.php'?>
			<div class="page-content">
				<?php require 'require/header.php'?>
				<ul class="breadcrumb">
					<li class="active"><strong><mark>Products</mark></strong></li>
				</ul>
				<div class="page-content-wrap">
					<div class="panel-body list-group list-group-contacts scroll" style="height: 550px;">
						<div class="row">
							<div class="col-md-6">
								<?php
	$conn = new mysqli('localhost', 'root', '', 'sales') or die(mysqli_error());
			$id = $_SESSION['user_id'];
			$q = $conn->query("SELECT * FROM `users` where `user_id` = '$id'") or die(mysqli_error());
			$f = $q->fetch_array();

								?>
								<form role="form" id="user" class="form-horizontal" action="actions/updatecustomerprofile.php" method="post" onsubmit="return confirm('Are you sure you want to your profile?');">
									<div class="panel panel-info">
										<div class="panel-heading">
											<h3 class="panel-title"><strong> Update My Account</strong></h3>
										</div>
										<div class="panel-body">
											<h5 class="push-up-1">Full Name</h5>
											<div class="form-group ">
												<div class="col-md-12 col-xs-12">
													<input data-toggle="tooltip" data-placement="bottom" title="Name" type="text" class="form-control" name="fullname" value="<?php echo $f['fullname']?>"/>
												</div>
											</div>
											<h5 class="push-up-1">Contact Number</h5>
											<div class="form-group ">
												<div class="col-md-12 col-xs-12">
													<input data-toggle="tooltip" data-placement="bottom" title="Name" type="text" class="form-control" name="contact_no" value="<?php echo $f['contact_no']?>"/>
												</div>
											</div>
											<h5 class="push-up-1">Username</h5>
											<div class="form-group ">
												<div class="col-md-12 col-xs-12">
													<input data-toggle="tooltip" data-placement="bottom" title="Username" type="text" class="form-control" name="username" value="<?php echo $f['username'];?>"/>
												</div>
											</div>
											<h5 class="push-up-1">New Password</h5>
											<div class="form-group ">
												<div class="col-md-12 col-xs-12">
													<input data-toggle="tooltip" data-placement="bottom" title="New Password" type="text" class="form-control" id="password" name="password"/>
												</div>
											</div>
											<h5 class="push-up-1">Confirm Password</h5>
											<div class="form-group ">
												<div class="col-md-12 col-xs-12">
													<input data-toggle="tooltip" data-placement="bottom" title="Confirm Password" type="text" class="form-control" id="cfmPassword" name="newpassword" />
												</div>
											</div>
											<h5 class="push-up-1">Old Password</h5>
											<div class="form-group ">
												<div class="col-md-12 col-xs-12">
													<input data-toggle="tooltip" data-placement="bottom" title="Old Password" type="text" class="form-control" name="passwordold" required/>
												</div>
											</div>
										</div>
										<div class="panel-footer">
											<button type="submit" name="update" class="btn btn-default pull-right">Update</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
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
		<script type='text/javascript' src='js/plugins/jquery-validation/jquery.validate.js'></script>   
		<script type="text/javascript" src="js/actions.js"></script>
		<script>
			$("#user").validate({
				ignore: [],
				rules: {
					password: {
						minlength: 6,
						maxlength: 10
					},
					'newpassword': {
						minlength: 5,
						maxlength: 10,
						equalTo: "#password"
					}
				}
			});
		</script>
	</body>
</html>
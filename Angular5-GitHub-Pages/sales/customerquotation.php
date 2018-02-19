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
		$user_id = $find['user_id'];
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
									<h3 class="panel-title">Selected Products</h3>
								</div>
								<div class="panel-body list-group list-group-contacts scroll" style="height: 500px;">
									<div class="panel-body">
										<table id="print" class="table table-hover">
											<thead>
												<tr class="warning">

													<th><center>Product Name</center></th>
													<th><center>Quantity</center></th>
													<th><center>Price</center></th>
													<th><center>Total</center></th>
												</tr>
											</thead>
											<tbody>
												<?php
	require 'config.php';
			$query = $conn->query("SELECT * FROM `temp_trans` where `status` = 'Pending' && `user_id` = '$_GET[id]' ORDER BY `temp_trans_id` DESC") or die(mysqli_error());
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
							<div class="panel panel-default">
								<div class="panel-body">
									<form>
										<div class="form-group">
											<label>Total</label>
											<input style="color:#000; text-align:right; font-size:15px;" type="text" name="total" class="form-control" value="<?php echo number_format($grand,2)?>"disabled/>
										</div> 
										<div class="form-group">
											<label>Final Payment Due</label>
											<input style="color:#000; text-align:right; font-size:15px;" type="text" name="final" class="form-control" 
												   value="<?php echo number_format($grand,2)?>"disabled/>
										</div>   

										<div class="form-group">
											<div class="col-md-5">
												<a href="#" class="btn btn-warning btn-md" onclick="pQout()">Print Quotation</a>
											</div>
										</div>
										<div class="form-group">
											<div class="col-md-5">
												<a href="actions/confirmquotation.php?id=<?php echo $_GET['id']?>" class="btn btn-default btn-md" onclick="return confirm('Confirm Quotation?');">Confirm Quotation</a>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
		<script>
			function pQout() {
				myWindow = window.open("print/printquotation.php?id=<?php echo $_GET['id']?>", "", "width=1350, height=650");
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

<?php
session_start();
if(ISSET($_POST['login'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	date_default_timezone_set('Asia/Manila');
	$date=date("F j, Y, g:i a");



	$conn = new mysqli("localhost", "root", "", "sales") or die(mysqli_error());
	$query = $conn->query("SELECT * FROM `users` WHERE BINARY `username` = '$username' && BINARY `password` = '$password'") or die(mysqli_error());
	$fetch = $query->fetch_array();
	$valid = $query->num_rows;
	$type = $fetch['type'];
	$user_id = $fetch['user_id'];

	if($valid > 0){
		if ($type == 'Customer') {
			$_SESSION['user_id'] = $fetch['user_id'];
			echo '<meta http-equiv="refresh" content="2;url=../home.php">';
			$conn->query ("UPDATE `users` SET `login` = '$date' WHERE `user_id` = '$user_id'") or die(mysqli_error());
			echo '<i>Please wait...</i>';
		}
		if ($type == 'Employee') {
			$_SESSION['user_id'] = $fetch['user_id'];
			echo '<meta http-equiv="refresh" content="2;url=../home_employee.php">';
			$conn->query ("UPDATE `users` SET `login` = '$date' WHERE `user_id` = '$user_id'") or die(mysqli_error());
			echo '<i>Please wait...</i>';
		}
		if ($type == 'Manager') {
			$_SESSION['user_id'] = $fetch['user_id'];
			echo '<meta http-equiv="refresh" content="2;url=../managerhome.php">';
			$conn->query ("UPDATE `users` SET `login` = '$date' WHERE `user_id` = '$user_id'") or die(mysqli_error());
			echo '<i>Please wait...</i>';
		}
	}
	else{
		echo "<script>alert('Invalid account. Please check your username and password.')</script>";
		echo "<script>window.location = '../index.php'</script>";
	}

	$conn->close();
}	
?>
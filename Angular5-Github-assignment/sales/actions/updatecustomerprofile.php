<?php 
session_start();
if(empty($_SESSION['user_id'])):
header('Location:index.php');
endif;

$id = $_SESSION['user_id'];
$fullname = $_POST['fullname'];
$contact_no = $_POST['contact_no'];
$username = $_POST['username'];
$password = $_POST['password'];
$old = $_POST['passwordold'];

$pass = $old;
$password = $password;
$conn = new mysqli("localhost", 'root', '', 'sales') or die(mysqli_error());
$q2 = $conn->query ("SELECT * FROM `users` WHERE `user_id` = $id") or die(mysqli_error());
$f2 = $q2->fetch_array();
$id = $f2['user_id'];


$passold = $f2['password'];
if ($passold == $pass){
	if ($password<>""){
		$conn->query("UPDATE `users` SET `fullname` = '$fullname', `contact_no` = '$contact_no', `username` = '$username', `password` = '$password' WHERE `user_id` = '$id'") or die(mysqli_error());

	}
	else {
		$conn->query("UPDATE `users` SET `fullname` = '$fullname', `contact_no` = '$contact_no', `username` = '$username' WHERE `user_id` = '$id'") or die(mysqli_error());
	}
	echo "<script type='text/javascript'> alert('Successfully changed account information!'); </script>";
	echo "<script>document.location='../customeraccount.php'</script>";
}
else 
	echo "<script type='text/javascript'> alert('Old password does not match!'); </script>";
echo "<script>document.location='../customeraccount.php'</script>";
?>
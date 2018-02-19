<?php
if(ISSET($_POST['addstocks'])){
	$prod_name = $_POST['prod_name'];
	$quantity = $_POST['quantity'];
	date_default_timezone_set('Asia/Manila');
	$date=date("F j, Y, g:i a");
	$conn = new mysqli("localhost", "root", "", "sales") or die(mysqli_error());
	$conn->query("INSERT INTO `stocks` VALUES('', '$prod_name', '$quantity', '$date')") or die(mysqli_error());
	$conn->query("UPDATE `products` SET `balance` = `balance` + '$quantity' WHERE `prod_name` = '$prod_name'") or die(mysqli_error());
	$conn->close();
	echo "<script type='text/javascript'>alert('Successfully added new stocks!');</script>";
	echo "<script>document.location='../managerhome.php'</script>";  
}
?>
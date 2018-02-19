<?php
require '../logincheck.php';
if(ISSET($_POST['add'])){
	$user_id = $_POST['user_id'];
	$prod_name = $_POST['prod_name'];
	$quantity = $_POST['quantity'];
	$month = date("M", strtotime("+8 HOURS"));
	$year = date("Y", strtotime("+8 HOURS"));

	$conn = new mysqli("localhost", "root", "", "sales") or die(mysqli_error());
	$q2 = $conn->query ("SELECT * FROM `products` WHERE `prod_name` = '$prod_name'") or die(mysqli_error());
	$f2 = $q2->fetch_array();
	$price = $f2['price'];

	$q3 = $conn->query ("SELECT * FROM `temp_trans` WHERE `prod_name` = '$prod_name' && `user_id` = '$user_id' && `status` = 'Pending'") or die(mysqli_error());
	$f3 = $q3->fetch_array();
	$check = $q3->num_rows;

	$total = $price*$quantity;

	if($check > 0){
		$conn->query("UPDATE `temp_trans` SET `quantity` = `quantity` + '$quantity' WHERE `prod_name` = '$prod_name'") or die(mysqli_error());
	}
	else{
		$conn->query("INSERT INTO `temp_trans` VALUES('', '$prod_name', '$price', '$quantity', '$user_id', 'Pending', '$month', '$year')") or die(mysqli_error());
		$conn->close();
	}
	echo "<script type='text/javascript'>alert('Successfully added new product!');</script>";
	echo "<script>document.location='../quote.php?id=$user_id'</script>";
}
?>
<?php
require '../logincheck.php';
if(ISSET($_POST['purchase'])){
	$user_id = $_POST['user_id'];
	$prod_name = $_POST['prod_name'];
	$quantity = $_POST['quantity'];

	$conn = new mysqli("localhost", "root", "", "sales") or die(mysqli_error());
	$q2 = $conn->query ("SELECT * FROM `products` WHERE `prod_name` = '$prod_name'") or die(mysqli_error());
	$f2 = $q2->fetch_array();
	$price = $f2['price'];

	$q3 = $conn->query ("SELECT * FROM `purchase` WHERE `prod_name` = '$prod_name' && `user_id` = '$user_id' && `status` = 'Pending'") or die(mysqli_error());
	$f3 = $q3->fetch_array();
	$check = $q3->num_rows;

	$total = $price*$quantity;

	if($check > 0){
		$conn->query("UPDATE `purchase` SET `quantity` = `quantity` + '$quantity' WHERE `prod_name` = '$prod_name'") or die(mysqli_error());
	}
	else{
		$conn->query("INSERT INTO `purchase` VALUES('', '$prod_name', '$price', '$quantity', '', '$user_id', 'Pending')") or die(mysqli_error());
		$conn->close();
	}
	echo "<script type='text/javascript'>alert('Successfully added to purchase list!');</script>";
	echo "<script>document.location='../customeroverallpurchase.php?id=$user_id'</script>";
}
?>
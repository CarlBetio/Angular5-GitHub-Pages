<?php
if(ISSET($_POST['update'])){
	$user_id = $_POST['user_id'];
	$purchase_id = $_POST['purchase_id'];
	$quantity = $_POST['quantity'];    


	$conn = new mysqli("localhost", "root", "", "sales") or die(mysqli_error());

	$conn->query("UPDATE `purchase` SET `quantity` = '$quantity' WHERE `purchase_id` = '$purchase_id'") or die(mysqli_error());
	$conn->close();
	echo "<script type='text/javascript'>alert('Successfully updated product!');</script>";
	echo "<script>document.location='../customeroverallpurchase.php?id=$user_id'</script>";  
}

?>
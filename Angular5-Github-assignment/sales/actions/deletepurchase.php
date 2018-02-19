<?php
if(ISSET($_POST['delete'])){
	$user_id = $_POST['user_id'];
	$purchase_id = $_POST['purchase_id'];

	$conn = new mysqli("localhost", "root", "", "sales") or die(mysqli_error());
	$conn->query("DELETE FROM `purchase` WHERE `purchase_id` = '$purchase_id'") or die(mysqli_error());
	$conn->close();
	echo "<script type='text/javascript'>alert('Successfully deleted product!');</script>";
	echo "<script>document.location='../customeroverallpurchase.php?id=$user_id'</script>";  
}
?> 
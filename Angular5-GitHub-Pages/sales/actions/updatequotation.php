<?php
if(ISSET($_POST['update'])){
	$user_id = $_POST['user_id'];
	$temp_trans_id = $_POST['temp_trans_id'];
	$quantity = $_POST['quantity'];    


	$conn = new mysqli("localhost", "root", "", "sales") or die(mysqli_error());

	$conn->query("UPDATE `temp_trans` SET `quantity` = '$quantity' WHERE `temp_trans_id` = '$temp_trans_id'") or die(mysqli_error());
	$conn->close();
	echo "<script type='text/javascript'>alert('Successfully updated quotation!');</script>";
	echo "<script>document.location='../quote.php?id=$user_id'</script>";  
}

?>
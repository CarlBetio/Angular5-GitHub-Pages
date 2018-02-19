<?php
if(ISSET($_POST['delete'])){
	$user_id = $_POST['user_id'];
	$temp_trans_id = $_POST['temp_trans_id'];

	$conn = new mysqli("localhost", "root", "", "sales") or die(mysqli_error());
	$conn->query("DELETE FROM `temp_trans` WHERE `temp_trans_id` = '$temp_trans_id'") or die(mysqli_error());
	$conn->close();
	echo "<script type='text/javascript'>alert('Successfully deleted quotation!');</script>";
	echo "<script>document.location='../quote.php?id=$user_id'</script>";  
}
?> 
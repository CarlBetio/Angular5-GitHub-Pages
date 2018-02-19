<?php


	$conn = new mysqli("localhost", "root", "", "sales") or die(mysqli_error());

	$conn->query("UPDATE `temp_trans` SET `status` = 'Confirmed' WHERE `user_id` = '$_GET[id]'") or die(mysqli_error());
	$conn->close();
	echo "<script type='text/javascript'>alert('Successfully confirmed quotation!');</script>";
	echo "<script>document.location='../customer.php'</script>";  


?>
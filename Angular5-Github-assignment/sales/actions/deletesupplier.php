		<?php
		$conn = new mysqli("localhost", "root", "", "sales") or die(mysqli_error());
		$conn->query("DELETE FROM `suppliers` WHERE `supplier_id` = '$_GET[supplier_id]'") or die(mysqli_error());
		$conn->close();
		echo "<script type='text/javascript'>alert('Successfully deleted supplier!');</script>";
		echo "<script>document.location='../suppliers.php'</script>";  
		?> 
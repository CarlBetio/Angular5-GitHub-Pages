<?php
if(ISSET($_POST['update'])){
	$supplier_id = $_POST['supplier_id'];
	$name = $_POST['name'];    
	$address = $_POST['address'];
	$contactno = $_POST['contactno'];


	$conn = new mysqli("localhost", "root", "", "sales") or die(mysqli_error());

	$conn->query("UPDATE `suppliers` SET `name` = '$name', `address` = '$address', `contactno` = '$contactno' WHERE `supplier_id` = '$supplier_id'") or die(mysqli_error());
	$conn->close();
	echo "<script type='text/javascript'>alert('Successfully updated supplier!');</script>";
	echo "<script>document.location='../suppliers.php'</script>";  
}

?>
<?php
if(ISSET($_POST['update'])){
	$product_id = $_POST['product_id'];
	$code = $_POST['code'];    
	$prod_name = $_POST['prod_name'];
	$description = $_POST['description'];
	$supplier = $_POST['supplier'];
	$price = $_POST['price'];

	$conn = new mysqli("localhost", "root", "", "sales") or die(mysqli_error());

	$conn->query("UPDATE `products` SET `code` = '$code', `prod_name` = '$prod_name', `description` = '$description', `supplier` = '$supplier', 
			`price` = '$price' WHERE `product_id` = '$product_id'") or die(mysqli_error());
	$conn->close();
	echo "<script type='text/javascript'>alert('Successfully updated product!');</script>";
	echo "<script>document.location='../home_employee.php'</script>";  
}

?>
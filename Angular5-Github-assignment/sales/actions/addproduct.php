<?php
if(ISSET($_POST['submit'])){
    $code = $_POST['code'];
    $prod_name = $_POST['prod_name'];
    $description = $_POST['description'];
    $supplier = $_POST['supplier'];
    $price = $_POST['price'];
    $conn = new mysqli("localhost", "root", "", "sales") or die(mysqli_error());
    $conn->query("INSERT INTO `products` VALUES('', '$code', '$prod_name', '$description', '$supplier', '$price', '')") or die(mysqli_error());
    $conn->close();
    echo "<script type='text/javascript'>alert('Successfully added new product!');</script>";
    echo "<script>document.location='../home_employee.php'</script>";  
}
?>
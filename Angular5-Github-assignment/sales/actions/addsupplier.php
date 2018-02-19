<?php
if(ISSET($_POST['submit'])){
    $name = $_POST['name'];
    $address = $_POST['address'];
    $contactno = $_POST['contactno'];
    $conn = new mysqli("localhost", "root", "", "sales") or die(mysqli_error());
    $conn->query("INSERT INTO `suppliers` VALUES('', '$name', '$address', '$contactno')") or die(mysqli_error());
    $conn->close();
    echo "<script type='text/javascript'>alert('Successfully added new supplier!');</script>";
    echo "<script>document.location='../suppliers.php'</script>";  
}
?>
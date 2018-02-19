<?php
if(ISSET($_POST['register'])){
    $fullname = $_POST['fullname'];
    $contact_no = $_POST['contact_no'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $type = $_POST['type'];
    $conn = new mysqli("localhost", "root", "", "sales") or die(mysqli_error());
    $conn->query("INSERT INTO `users` VALUES('', '$fullname', '$contact_no', '$username', '$password', '$type', '')") or die(mysqli_error());
    $conn->close();
    echo "<script type='text/javascript'>alert('Successfully registered account!');</script>";
    echo "<script>document.location='../index.php'</script>";  
}
?>
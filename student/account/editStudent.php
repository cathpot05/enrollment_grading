<?php
include "../../dbcon.php";
$id = $_GET['id'];
$username=$_POST['username'];
$Lname=$_POST['Lname'];
$Fname=$_POST['Fname'];
$Mname=$_POST['Mname'];
$address=$_POST['address'];
$religion=$_POST['religion'];
$phoneNo=$_POST['phoneNo'];

$sql = "UPDATE student SET  username='$username', Lname = '$Lname', Fname= '$Fname', Mname= '$Mname', contactno= '$phoneNo', address= '$address', religion = '$religion' where ID=$id";
$result = mysqli_query($con,$sql);

	echo "<script>alert('Updated account information');
	window.location.href = 'account_info.php'; </script>";

?>
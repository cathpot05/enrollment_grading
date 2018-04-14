<?php
session_start();

include "../dbcon.php";
$adminID = $_SESSION['adminID'];

$sql = "Select *from admin where ID=$adminID";
$result = mysqli_query($con,$sql);

	while($row = mysqli_fetch_array($result))
	{
				$user = $row['username'];
				echo $sql2 = "INSERT INTO log(user,userType,logType) VALUES('$user','Admin','Logged out')";
				$result2 = mysqli_query($con,$sql2);
	}

		unset($_SESSION['adminID']);
header('location:../login.php');
?>
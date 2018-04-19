<?php
session_start();
include "../dbcon.php";
echo $studentID = $_SESSION['encoderID'];

echo $sql = "Select *from encoder where ID=$encoderID";
$result = mysqli_query($con,$sql);

	while($row = mysqli_fetch_array($result))
	{
				$user = $row['Fname']." ". $row['Lname'];
				echo $sql2 = "INSERT INTO log(user,userType,logType) VALUES('$user','Encoder','Logged out')";
				$result2 = mysqli_query($con,$sql2);
	}
unset($_SESSION['encoderID']);
header('location:../login.php');
?>
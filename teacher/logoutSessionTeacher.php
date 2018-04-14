<?php
session_start();
include "../dbcon.php";
echo $teacherID = $_SESSION['teacherID'];
echo $sql = "Select *from teacher where ID=$teacherID";
$result = mysqli_query($con,$sql);

	while($row = mysqli_fetch_array($result))
	{
				$user = $row['Fname']." ". $row['Lname'];
				echo $sql2 = "INSERT INTO log(user,userType,logType) VALUES('$user','Teacher','Logged out')";
				$result2 = mysqli_query($con,$sql2);
	}
	unset($_SESSION['teacherID']);
header('location:../login.php');
?>
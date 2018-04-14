<?php
session_start();
include "../dbcon.php";
echo $studentID = $_SESSION['studentID'];

echo $sql = "Select *from student where ID=$studentID";
$result = mysqli_query($con,$sql);

	while($row = mysqli_fetch_array($result))
	{
				$user = $row['Fname']." ". $row['Lname'];
				echo $sql2 = "INSERT INTO log(user,userType,logType) VALUES('$user','Student','Logged out')";
				$result2 = mysqli_query($con,$sql2);
	}
unset($_SESSION['studentID']);
header('location:../login.php');
?>
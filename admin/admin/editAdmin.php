<?php
include "../../dbcon.php";
include "../sessionAdmin.php";
$id = $_GET['id'];
$username = $_POST['username'];
$Lname = $_POST['Lname'];
$Fname = $_POST['Fname'];
$Mname = $_POST['Mname'];
	echo $sql = "UPDATE admin SET username = '$username', Lname = '$Lname', Fname = '$Fname', Mname = '$Mname' where ID=$id";
	$result = mysqli_query($con,$sql);
	$username='';
	$sqlAdmin = "Select *from admin where ID=$adminID";
	$resultAdmin = mysqli_query($con,$sqlAdmin);
	if(mysqli_num_rows($resultAdmin)>0)
	{
		while($rowAdmin = mysqli_fetch_array($resultAdmin))
		{
			$username=$rowAdmin['username'];
		}
	}
	$sql2 = "INSERT INTO log(user,userType,logType) VALUES('$username','Admin','Edited Admin Information')";
	$result2 = mysqli_query($con,$sql2);

	echo "<script>alert('Updated Admin Information');
			window.location.href = 'admin_frame.php'; </script>";	
?>
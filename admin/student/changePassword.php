<?php
include "../../dbcon.php";
include "../sessionAdmin.php";
$id = $_GET['id'];
$username = $_POST['username'];

if(isset($_POST['oldPassword']) && $_POST['oldPassword'] != null)
{
	$oldPassword= md5($_POST['oldPassword']);
	$newPassword= md5($_POST['newPassword']);
	$newPassword2= md5($_POST['newPassword2']);
	$sql = "Select *from student where ID=$id AND password = '$oldPassword'";
	$result = mysqli_query($con,$sql);

	if(mysqli_num_rows($result)>0) 
	{
		if($newPassword == $newPassword2)
		{
			$sql = "UPDATE student SET username='$username', password='$newPassword' where ID=$id";
			$result = mysqli_query($con,$sql);
			$username='';
		}
		else
		{
			echo "<script>alert('New Password not matched');
			window.location.href = 'student_frame.php'; </script>";
		}
	} 
	else
	{
		echo "<script>alert('Incorrect Old Password');
		window.location.href = 'student_frame.php'; </script>";	
	}
}
else
{
	echo $sql = "UPDATE student SET 	username='$username' where ID=$id";
	$result = mysqli_query($con,$sql);
}

$sqlAdmin = "Select *from admin where ID=$adminID";
$resultAdmin = mysqli_query($con,$sqlAdmin);
if(mysqli_num_rows($resultAdmin)>0)
{
	while($rowAdmin = mysqli_fetch_array($resultAdmin))
	{
		$username=$rowAdmin['username'];
	}
}

$sql2 = "INSERT INTO log(user,userType,logType) VALUES('$username','Admin','Changed Password (Student)')";
$result2 = mysqli_query($con,$sql2);
//echo "<script>alert('Successfully change password');
//	window.location.href = 'student_frame.php'; </script>";
?>
<?php
include "../../dbcon.php";
include "../sessionAdmin.php";
$id = $_GET['id'];
$username = $_POST['username'];
if(isset($_POST['newPassword']) && $_POST['newPassword'] != null)
{
	$newPassword= md5($_POST['newPassword']);
	$newPassword2= md5($_POST['newPassword2']);
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
	$sql = "UPDATE student SET username='$username' where ID=$id";
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
$sql2 = "INSERT INTO log(user,userType,logType) VALUES('$username','Admin','Changed Student Password')";
$result2 = mysqli_query($con,$sql2);
echo "<script>alert('Successfully Change Student Passsword');
	window.location.href = 'student_frame.php'; </script>";
?>
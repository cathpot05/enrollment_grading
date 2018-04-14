<?php
include "../../dbcon.php";
$id = $_GET['id'];
$username=$_POST['username'];
echo $password=$_POST['password'];
$password2=$_POST['password2'];
if($password != "")
{
	$password=md5($password);
	$password2=md5($password2);
	if($password == $password2)
	{
$sql = "UPDATE admin SET username = '$username', password= '$password' where ID=$id";
	$result = mysqli_query($con,$sql);
	echo "<script>alert('Updated account information');
			window.location.href = 'account_info.php'; </script>";
	}
	else
	{
		echo "<script>alert('Password not matched');
			window.location.href = 'account_info.php'; </script>";
	}
}
else
{
	$sql = "UPDATE admin SET username = '$username' where ID=$id";
$result = mysqli_query($con,$sql);

	echo "<script>alert('Updated account information');
			window.location.href = 'account_info.php'; </script>";
}	

?>
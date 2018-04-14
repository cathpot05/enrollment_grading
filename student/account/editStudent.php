<?php
include "../../dbcon.php";
$id = $_GET['id'];
$username=$_POST['username'];
$password=$_POST['password'];
$password2=$_POST['password2'];
$Lname=$_POST['Lname'];
$Fname=$_POST['Fname'];
$Mname=$_POST['Mname'];
$address=$_POST['address'];
$religion=$_POST['religion'];
$phoneNo=$_POST['phoneNo'];
$bday=$_POST['bday'];
$age=$_POST['age'];
$gender=$_POST['gender'];
$genAvg=$_POST['genAvg'];

if($password != "")
{
	$password=md5($password);
	$password2=md5($password2);
	if($password == $password2)
	{
 $sql = "UPDATE student SET  username='$username', password='$password', Lname = '$Lname', Fname= '$Fname', Mname= '$Mname', phoneNo= '$phoneNo', address= '$address', religion = '$religion', bday='$bday', age='$age', gender = '$gender', genAvg='$genAvg' where ID=$id";
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
	$sql = "UPDATE student SET  username='$username', Lname = '$Lname', Fname= '$Fname', Mname= '$Mname', phoneNo= '$phoneNo', address= '$address', religion = '$religion', bday='$bday', age='$age', gender = '$gender', genAvg='$genAvg' where ID=$id";
$result = mysqli_query($con,$sql);

	echo "<script>alert('Updated account information');
	window.location.href = 'account_info.php'; </script>";
}
?>
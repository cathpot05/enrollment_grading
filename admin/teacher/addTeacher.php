<?php
include "../../dbcon.php";
include "../sessionAdmin.php";
$employeeNo=$_POST['employeeNo'];
$password= md5($_POST['password']);
$password2 = md5($_POST['password2']);
$Lname=$_POST['Lname'];
$Fname=$_POST['Fname'];
$Mname=$_POST['Mname'];
$contactNo=$_POST['contactNo'];
if($password == $password2){
	$sql = "INSERT INTO teacher(employeeNo,password,Lname,Fname,Mname,contactNo) VALUES('$employeeNo','$password','$Lname','$Fname','$Mname','$contactNo')";
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
	$sql2 = "INSERT INTO log(user,userType,logType) VALUES('$username','Admin','Added New Teacher')";
	$result2 = mysqli_query($con,$sql2);

echo "<script>alert('Added new Teacher');
			window.location.href = 'teacher_frame.php'; </script>";
}
else
{
	echo "<script>alert('Password not matched');
			window.location.href = 'teacher_frame.php'; </script>";
	
}
	
	
?>
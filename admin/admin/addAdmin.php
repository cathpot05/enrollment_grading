<?php
include "../../dbcon.php";
include "../sessionAdmin.php";
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	$password2 = md5($_POST['password2']);
	$Lname = $_POST['Lname'];
	$Fname = $_POST['Fname'];
	$Mname = $_POST['Mname'];
	
	if($password == $password2)
	{
		$sql = "INSERT INTO admin(username,password,Lname,Fname,Mname,status) VALUES('$username','$password','$Lname','$Fname','$Mname',0)";
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
		
		$sql2 = "INSERT INTO log(user,userType,logType) VALUES('$username','Admin','Added new Admin')";
		$result2 = mysqli_query($con,$sql2);
		
		echo "<script>alert('Added new Admin account');
			window.location.href = 'admin_frame.php'; </script>";	
	}
	else
	{
		
		echo "<script>alert('Password not matched');
			window.location.href = 'admin_frame.php'; </script>";
		
	}

?>
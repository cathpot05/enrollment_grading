<?php
include "../../dbcon.php";
include "../sessionEncoder.php";
$id = $_GET['id'];
$oldPassword= md5($_POST['oldPassword']);
$newPassword= md5($_POST['newPassword']);
$newPassword2= md5($_POST['newPassword2']);

 $sql = "Select *from encoder where ID=$id AND password = '$oldPassword'";
	$result = mysqli_query($con,$sql);
	if(mysqli_num_rows($result)>0)
	{

			if($newPassword == $newPassword2)
			{
				$sql = "UPDATE encoder SET password='$newPassword' where ID=$id";
				$result = mysqli_query($con,$sql);
				$username='';
				$sqlAdmin = "Select *from encoder where ID=$encoderID";
				$resultAdmin = mysqli_query($con,$sqlAdmin);
				if(mysqli_num_rows($resultAdmin)>0)
				{
					while($rowAdmin = mysqli_fetch_array($resultAdmin))
					{
						$username=$rowAdmin['employeeNo'];
					}
				}
				
				$sql2 = "INSERT INTO log(user,userType,logType) VALUES('$username','Encoder','Changed his password')')";
				$result2 = mysqli_query($con,$sql2);
				echo "<script>alert('Successfully changed password');
					window.location.href = 'account_info.php'; </script>";
			}
			else
			{
					echo "<script>alert('New Password not matched');
					window.location.href = 'account_info.php'; </script>";
			}
	}
	else
	{
			echo "<script>alert('Incorrect Old Password');
			window.location.href = 'account_info.php'; </script>";
		
	}
?>
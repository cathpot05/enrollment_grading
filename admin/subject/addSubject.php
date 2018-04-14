<?php
include "../../dbcon.php";
include "../sessionAdmin.php";
$code=$_POST['code'];
$subject=$_POST['subject'];
	$sql = "INSERT INTO subject(code,subject) VALUES('$code','$subject')";
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
	
	
	
	$sql2 = "INSERT INTO log(user,userType,logType) VALUES('$username','Admin','Added New Subject')";
	$result2 = mysqli_query($con,$sql2);

	header('Location:subject_frame.php');
	
	
	
?>
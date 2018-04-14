<?php
include "../../dbcon.php";
include "../sessionAdmin.php";
	$year = $_POST['year'];
	$section = $_POST['section'];
	echo $sql = "INSERT INTO section(year,section) VALUES('$year','$section')";
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
	
	
	
	$sql2 = "INSERT INTO log(user,userType,logType) VALUES('$username','Admin','Added new Section')";
	$result2 = mysqli_query($con,$sql2);
	
	header('Location:section_frame.php');
	
	
	
?>
<?php
include "../../dbcon.php";
include "../sessionAdmin.php";
$level=$_POST['level'];
echo $sql = "INSERT INTO level (level) VALUES('$level')";
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
	
	
	
	$sql2 = "INSERT INTO log(user,userType,logType) VALUES('$username','Admin','Added New SchoolYear')";
	$result2 = mysqli_query($con,$sql2);

header('Location:year_level_frame.php');
?>
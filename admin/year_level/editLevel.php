<?php
include "../../dbcon.php";
include "../sessionAdmin.php";
$id = $_GET['id'];
$level=$_POST['level'];
$sql = "UPDATE level SET level = '$level' where ID=$id";
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
	
	
	
	$sql2 = "INSERT INTO log(user,userType,logType) VALUES('$username','Admin','Edited Year Level')";
	$result2 = mysqli_query($con,$sql2);

header('Location:year_level_frame.php');
?>
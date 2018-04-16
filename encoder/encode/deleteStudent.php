<?php
include "../../dbcon.php";
include "../sessionEncoder.php";
$id=$_GET['delID'];
echo $sql = "DELETE FROM student where ID = $id";
$result = mysqli_query($con,$sql);

	$username='';
	$sqlAdmin = "Select *from encoder where ID=$encoderID";
	$resultAdmin = mysqli_query($con,$sqlAdmin);
	if(mysqli_num_rows($resultAdmin)>0)
	{
		while($rowAdmin = mysqli_fetch_array($resultAdmin))
		{
			$username=$rowAdmin['username'];
		}
	}
	
	
	
	$sql2 = "INSERT INTO log(user,userType,logType) VALUES('$username','Encoder','Deleted Student')";
	$result2 = mysqli_query($con,$sql2);

header('Location:encode_frame.php');
?>
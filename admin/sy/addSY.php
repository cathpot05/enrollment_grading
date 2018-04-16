<?php
include "../../dbcon.php";
include "../sessionAdmin.php";
$from=$_POST['from'];
$to=$_POST['to'];
$sy=$from."-".$to;
$sql = "INSERT INTO sy(schoolYear) VALUES('$sy')";
$result = mysqli_query($con,$sql);

	$sqlSY = "Select *from sy ORDER BY ID DESC LIMIT 1 ";
	$resultSY = mysqli_query($con,$sqlSY);
	$rowSY = mysqli_fetch_array($resultSY);
	$sy_ID = $rowSY['ID'];
	$sqlLevel = "Select *from level";
	$resultLevel = mysqli_query($con,$sqlLevel);
	if(mysqli_num_rows($resultLevel)>0)
	{
		while($rowLevel = mysqli_fetch_array($resultLevel))
		{
			$level_ID = $rowLevel['ID'];
			$sql = "INSERT INTO sy_level(sy_ID,level_ID) VALUES($sy_ID,$level_ID)";
			$result = mysqli_query($con,$sql);
		}
	}
	
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

header('Location:../manage/managesy.php');
?>
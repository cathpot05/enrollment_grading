<?php
session_start();
$id=$_GET['id'];
if(isset($_GET['id']))
{
	$_SESSION['studentID'] = $id;
	header('Location:dashboard/dashboard.php');
}
else
{
	header('Location:../login.php');
}
?>
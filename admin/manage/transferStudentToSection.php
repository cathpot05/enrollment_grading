<?php
include "../../dbcon.php";
	$schoolYearID = $_GET['schoolYearID'];
$id = $_GET['id'];
$sysection=$_POST['sysection'];
	echo $sql2 = "UPDATE enrolled_student SET sy_section_ID = '$sysection' where ID=$id";
	$result2 = mysqli_query($con,$sql2);


	header("Location:manage.php?schoolYearID=".$schoolYearID."");
?>
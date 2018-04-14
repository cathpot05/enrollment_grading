<?php
include "../../dbcon.php";
	$schoolYearID = $_GET['schoolYearID'];
$sectionID = $_GET['sectionID'];
$year=$_POST['year'];
$section=$_POST['section'];
	echo $sql2 = "UPDATE section SET year = '$year', section = '$section' where ID=$sectionID";
	$result2 = mysqli_query($con,$sql2);


	header("Location:manage.php?schoolYearID=".$schoolYearID."");
?>
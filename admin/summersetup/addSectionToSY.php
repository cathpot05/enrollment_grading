<?php
include "../../dbcon.php";

	$section = $_POST['section'];
	$schoolYearID = $_GET['schoolYearID'];
	echo $sql = "INSERT INTO sy_section(section_ID,sy_ID) VALUES('$section','$schoolYearID')";
	$result = mysqli_query($con,$sql);
	header("Location:manage.php?schoolYearID=".$schoolYearID."");
	
	
?>
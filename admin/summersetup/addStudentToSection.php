<?php
include "../../dbcon.php";
	$schoolYearID = $_GET['schoolYearID'];
	$student = $_POST['student'];
	$sy_section = $_GET['sy_section'];
	echo $sql = "INSERT INTO enrolled_student (student_ID,sy_section_ID) VALUES('$student','$sy_section')";
	$result = mysqli_query($con,$sql);
	header("Location:manage.php?schoolYearID=".$schoolYearID."");
	
	
?>
<?php
include "../../dbcon.php";
	$schoolYearID = $_GET['schoolYearID'];
	$subject = $_POST['subject'];
	$teacher = $_POST['teacher'];
	$sy_section = $_GET['sy_section'];
	echo $sql = "INSERT INTO sy_section_subject(subject_ID,sy_section_ID,teacher_ID) VALUES('$subject','$sy_section','$teacher')";
	$result = mysqli_query($con,$sql);
	header("Location:manage.php?schoolYearID=".$schoolYearID."");
	
	
?>
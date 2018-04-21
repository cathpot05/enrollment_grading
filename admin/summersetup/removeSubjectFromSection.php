<?php
include "../../dbcon.php";
	$schoolYearID = $_GET['schoolYearID'];
$sy_section_subject=$_GET['sy_section_subject'];
echo $sql = "DELETE FROM sy_section_subject where ID=$sy_section_subject ";
$result = mysqli_query($con,$sql);
	header("Location:manage.php?schoolYearID=".$schoolYearID."");
?>
<?php
include "../../../dbcon.php";
$schoolYearID = $_GET['id'];
$sy_level_section_id=$_GET['sectionId'];

echo $sql = "DELETE FROM summer_subject where ID=$sy_level_section_id ";
$result = mysqli_query($con,$sql);
	header("Location:../manage.php?schoolYearID=".$schoolYearID."");
?>
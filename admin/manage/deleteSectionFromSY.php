<?php
include "../../dbcon.php";
	$schoolYearID = $_GET['schoolYearID'];
$sy_section=$_GET['sy_section'];
echo $sql = "DELETE FROM sy_section where ID=$sy_section ";
$result = mysqli_query($con,$sql);
	header("Location:manage.php?schoolYearID=".$schoolYearID."");
?>
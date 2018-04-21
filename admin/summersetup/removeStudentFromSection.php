<?php
include "../../dbcon.php";
	$schoolYearID = $_GET['schoolYearID'];
$enrolled_student=$_GET['enrolled_student'];
echo $sql = "DELETE FROM enrolled_student where ID=$enrolled_student ";
$result = mysqli_query($con,$sql);
	header("Location:manage.php?schoolYearID=".$schoolYearID."");
?>
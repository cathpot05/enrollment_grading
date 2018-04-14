<?php
include "../../dbcon.php";
$schoolYearID = $_GET['schoolYearID'];
$enrolled_student=$_GET['enrolled_student'];
echo $sql = "UPDATE  enrolled_student SET status = 1 where ID=$enrolled_student ";
$result = mysqli_query($con,$sql);
	header("Location:manage.php?schoolYearID=".$schoolYearID."");
?>
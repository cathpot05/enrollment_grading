<?php
include "../../dbcon.php";
$schoolYearID = $_GET['schoolYearID'];
$id = $_GET['id'];
			$sql2 = "UPDATE grade_actions SET status = 2 where ID = $id";
		$result2 = mysqli_query($con,$sql2);
	header("Location:manage.php?schoolYearID=".$schoolYearID."");

?>
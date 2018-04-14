<?php
include "../../dbcon.php";
$id = $_GET['id'];


$sql = "SELECT *FROM grade_actions where ID = $id";
$result = mysqli_query($con,$sql);

while($row = mysqli_fetch_array($result))
	{
		$gradeid= $row['grade_ID'];
		$q1 = $row['q1'];
		$q2 = $row['q2'];
		$q3 = $row['q3'];
		$q4 = $row['q4'];
		$final = $row['final'];
		
		$sql2 = "UPDATE grade SET q1 = $q1,q2 = $q2,q3 = $q3,q4 = $q4, final = $final where ID = $gradeid";
		$result2 = mysqli_query($con,$sql2);

	}
		$sql2 = "UPDATE grade_actions SET status = 1 where ID = $id";
		$result2 = mysqli_query($con,$sql2);
	header("Location:dashboard.php");

?>
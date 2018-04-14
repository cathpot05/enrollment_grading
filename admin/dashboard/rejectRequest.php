<?php
include "../../dbcon.php";
$id = $_GET['id'];
			$sql2 = "UPDATE grade_actions SET status = 2 where ID = $id";
		$result2 = mysqli_query($con,$sql2);
	header("Location:dashboard.php");

?>
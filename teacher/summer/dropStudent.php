<?php
include "../../dbcon.php";
include "../sessionTeacher.php";
$id = $_GET['id'];
$dropStudentID = $_POST['dropStudentID'];
 $sql = "UPDATE summer_enrolled SET status = 1  where ID=$dropStudentID";
$result = mysqli_query($con,$sql);

$sqlAdmin = "Select *from teacher where ID=$teacherID";
	$resultAdmin = mysqli_query($con,$sqlAdmin);
	if(mysqli_num_rows($resultAdmin)>0)
	{
		$user = $rowAdmin['Fname']." ". $rowAdmin['Lname'];
		while($rowAdmin = mysqli_fetch_array($resultAdmin))
		{
			$username=$rowAdmin['employeeNo'];
		}
	}
	
	$sql2 = "INSERT INTO log(user,userType,logType) VALUES('$user','Teacher','Dropped a student')";
	$result2 = mysqli_query($con,$sql2);
	
	echo "<script>alert('Successfully dropped a student');
	 window.history.back(); </script>";

?>
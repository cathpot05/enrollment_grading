<?php
include "../../dbcon.php";
$id = $_GET['id'];
$sy_section_subjectID=$_GET['sy_section_subjectID'];
$q1=$_POST['q1'];
$q2=$_POST['q2'];
$q3=$_POST['q3'];
$q4=$_POST['q4'];
$final = ($q1+$q2+$q3+$q4)/4;
echo $gradeid=$row['ID'];
echo $sql = "INSERT INTO grade_actions(grade_ID,actionType,q1,q2,q3,q4,final) VALUES($id,1,$q1,$q2,$q3,$q4,$final)";
$result = mysqli_query($con,$sql);
$sqlAdmin = "Select *from teacher where ID=$teacherID";
	$resultAdmin = mysqli_query($con,$sqlAdmin);
	if(mysqli_num_rows($resultAdmin)>0)
	{
		
		while($rowAdmin = mysqli_fetch_array($resultAdmin))
		{
			$user = $rowAdmin['Fname']." ". $rowAdmin['Lname'];
		}
	}
	
	$sql2 = "INSERT INTO log(user,userType,logType) VALUES('$user','Teacher','Edited a grade')";
	$result2 = mysqli_query($con,$sql2);



	header("Location:grade_frame.php?id=".$sy_section_subjectID."");

?>
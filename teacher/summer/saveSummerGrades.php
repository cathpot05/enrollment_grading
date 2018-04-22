<?php
include "../../dbcon.php";
include "../sessionTeacher.php";
$id = $_GET['id'];

$sql = "SELECT C.*,D.grade, E.start, E.end, B.ID as seID, A.ID as ssID,D.ID as sgID from summer_subject A
		INNER JOIN summer_enrolled B ON B.summer_subject_ID = A.ID
		INNER JOIN student C ON B.student_ID = C.ID
		LEFT JOIN summer_grade D ON D.summer_subject_ID = A.ID AND D.summer_enrolled_ID = B.ID
		LEFT JOIN summer_grade_sched E ON E.sy_level_ID = A.sy_level_ID
		where A.ID = $id";
$result = mysqli_query($con,$sql);
if(mysqli_num_rows($result)>0)
{
	while($row = mysqli_fetch_array($result))
	{
		$seID=$row['seID'];
		$ssID = $row['ssID'];
		
		if($row['sgID'] == null)
		{
			 $sqlGrade = "INSERT INTO summer_grade(summer_enrolled_ID,summer_subject_ID) VALUES($seID,$ssID)";
			$resultGrade = mysqli_query($con,$sqlGrade);
		}
		
		if(isset($_POST['grade_'.$seID.'_'.$ssID]))
		{
			 $grade=$_POST['grade_'.$seID.'_'.$ssID];
			$sqlQ = "Update summer_grade SET grade=$grade where summer_enrolled_ID = $seID AND summer_subject_ID = $ssID";
			$resultQ = mysqli_query($con,$sqlQ);
			
		}
		
		
		echo "<script>alert('Updated summer student grades.');
			window.location.href = 'viewSummerGrades.php?id=$id'; </script>";
	}
}
													
?>
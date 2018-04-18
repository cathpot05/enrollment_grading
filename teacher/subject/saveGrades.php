<?php
include "../../dbcon.php";
include "../sessionTeacher.php";
$id = $_GET['id'];

$sql = "Select D.*,E.q1,E.q2,E.q3,E.q4,E.final,C.ID as esID, A.ID as tssID , E.ID as gID
		from teacher_section_subject A 
		INNER JOIN sy_level_section B ON A.sy_level_section_ID = B.ID
		INNER JOIN enrolled_student C ON C.sy_level_section_ID = B.ID
		INNER JOIN student D ON C.student_ID = D.ID
		LEFT JOIN grade E ON E.enrolled_student_ID = C.ID and E.teacher_section_subject_ID = A.ID 
		INNER JOIN sy_level_subject F ON A.sy_level_subject_ID = F.ID
		where A.ID = $id";
$result = mysqli_query($con,$sql);
if(mysqli_num_rows($result)>0)
{
	while($row = mysqli_fetch_array($result))
	{
		$esID=$row['esID'];
		$tssID = $row['tssID'];
		
		if($row['gID'] == null)
		{
			$sqlGrade = "INSERT INTO grade(enrolled_student_ID,teacher_section_subject_ID) VALUES($esID,$tssID)";
			$resultGrade = mysqli_query($con,$sqlGrade);
		}
		
		if(isset($_POST['q1_'.$esID.'_'.$tssID]))
		{
			$q1=$_POST['q1_'.$esID.'_'.$tssID];
			$sqlQ = "Update grade SET q1=$q1 where enrolled_student_ID = $esID AND teacher_section_subject_ID = $tssID";
			$resultQ = mysqli_query($con,$sqlQ);
			
		}
		
		if(isset($_POST['q2_'.$esID.'_'.$tssID]))
		{
			$q2=$_POST['q2_'.$esID.'_'.$tssID];
			$sqlQ = "Update grade SET q2=$q2 where enrolled_student_ID = $esID AND teacher_section_subject_ID = $tssID";
			$resultQ = mysqli_query($con,$sqlQ);
			
		}
		
		if(isset($_POST['q3_'.$esID.'_'.$tssID]))
		{
			$q3=$_POST['q3_'.$esID.'_'.$tssID];
			$sqlQ = "Update grade SET q3=$q3 where enrolled_student_ID = $esID AND teacher_section_subject_ID = $tssID";
			$resultQ = mysqli_query($con,$sqlQ);
			
		}
		
		if(isset($_POST['q4_'.$esID.'_'.$tssID]))
		{
			$q4=$_POST['q4_'.$esID.'_'.$tssID];
			$sqlQ = "Update grade SET q4=$q4 where enrolled_student_ID = $esID AND teacher_section_subject_ID = $tssID";
			$resultQ = mysqli_query($con,$sqlQ);
		}
		
		echo "<script>alert('Updated student grades.');
			window.location.href = 'viewGrades.php?id=$id'; </script>";
	}
}
													
?>
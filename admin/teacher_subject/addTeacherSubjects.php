<?php
/**
 * Created by PhpStorm.
 * User: Ms. Cath
 * Date: 4/21/18
 * Time: 12:14 PM
 */

include "../../dbcon.php";
include "../sessionAdmin.php";
$teacherId= $_POST['teacherId'];
$sy= $_POST['sy'];
if(!empty($_POST['checklist_section'])) {
    foreach($_POST['checklist_section'] as $check) {
        $sylevelSecId = $_POST['sylevelSecId_'.$check];
        $sylevelSubjId =  $_POST['sylevelSubjId_'.$check];

        $sql = "INSERT INTO teacher_section_subject (teacher_ID, sy_level_subject_ID, sy_level_section_ID)
        VALUES('".$teacherId."', '".$sylevelSubjId."', '".$sylevelSecId."')";
        $result = mysqli_query($con,$sql);
        //header("Location:view_teacher_subj.php?teacherId='.$teacherId.'&sy='.$sy");
        //echo $conn->error();
    }
}

echo "<script>alert('Added new Subject'); window.history.back()</script>";
    /*echo "<script>alert('Added new Subject');
			window.location.href = 'view_teacher_subj.php?teacherId='.$teacherId.'&sy='.$sy; </script>";*/
?>
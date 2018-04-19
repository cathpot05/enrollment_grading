<?php
/**
 * Created by PhpStorm.
 * User: Ms. Cath
 * Date: 4/17/18
 * Time: 10:00 PM
 */


include "../../dbcon.php";
$status = $_POST['radio_section'];
$syLevelId = $_POST['syLevelId_subj'];
$sy_Id = $_POST['sy_Id_subj'];

if($status == 'prev_year'){

    if(!empty($_POST['checklist_section'])) {
        foreach($_POST['checklist_section'] as $check) {
            $sql_check = "SELECT * FROM  sy_level_subject A
              WHERE A.sy_level_ID = $syLevelId AND A.subject_ID = $check ";
            $result_section = mysqli_query($con,$sql_check);
            if(mysqli_num_rows($result_section)>0)
            {
                //do not insert
            }
            else{

                $sql = "INSERT INTO sy_level_subject (sy_level_ID, subject_ID)
                        VALUES('".$syLevelId."', '".$check."')";
                $result = mysqli_query($con,$sql);
                header("Location:managesy.php?schoolYearID=".$sy_Id."");
                //echo $conn->error();
            }
        }
    }


}else{
    //checklist_section
    if(!empty($_POST['checklist_section'])) {
        foreach($_POST['checklist_section'] as $check) {
            $sql_check = "SELECT * FROM  sy_level_subject A
              WHERE A.sy_level_ID = $syLevelId AND A.subject_ID = $check ";
            $result_section = mysqli_query($con,$sql_check);
            if(mysqli_num_rows($result_section)>0)
            {
                //do not insert
            }
            else{

            $sql = "INSERT INTO sy_level_subject (sy_level_ID, subject_ID)
                    VALUES('".$syLevelId."', '".$check."')";
            $result = mysqli_query($con,$sql);
            header("Location:managesy.php?schoolYearID=".$sy_Id."");
            }
        }
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: Ms. Cath
 * Date: 4/15/18
 * Time: 9:22 PM
 */

include "../../../dbcon.php";
include "../../sessionAdmin.php";
 $status = $_POST['radio_section'];
 $syLevelId = $_POST['syLevelId'];
$sy_Id = $_POST['sy_Id'];

if($status == 'prev_year'){

    if(!empty($_POST['checklist_section'])) {
        foreach($_POST['checklist_section'] as $check) {
             $capacity = $_POST['capacity_'.$check];
             $adviser =  $_POST['cboAdviser_'.$check];
             $chkVal =  $_POST['chk__'.$check];

          echo $sql = "INSERT INTO sy_level_section (capacity, section_ID, sy_level_ID, teacher_ID)
        VALUES('".$capacity."', '".$chkVal."', '".$syLevelId."', '".$adviser."')";
            $result = mysqli_query($con,$sql);
            //header("Location:../managesy.php?schoolYearID=".$sy_Id."");
            //echo $conn->error();
        }
    }


}else{
    //checklist_section
    if(!empty($_POST['checklist_section'])) {
    foreach($_POST['checklist_section'] as $check) {
        $capacity = $_POST['capacity_'.$check];
        $adviser =  $_POST['cboAdviser_'.$check];
     $sql = "INSERT INTO sy_level_section (capacity, section_ID, sy_level_ID, teacher_ID)
        VALUES('".$capacity."', '".$check."', '".$syLevelId."', '".$adviser."')";
        $result = mysqli_query($con,$sql);
        header("Location:../managesy.php?schoolYearID=".$sy_Id."");
        //echo $conn->error();
    }
}
}

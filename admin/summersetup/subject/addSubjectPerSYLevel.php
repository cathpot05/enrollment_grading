<?php
/**
 * Created by PhpStorm.
 * User: Ms. Cath
 * Date: 4/17/18
 * Time: 10:00 PM
 */


include "../../../dbcon.php";
include "../../sessionAdmin.php";
$syLevelId = $_POST['syLevelId_subj'];
$sy_Id = $_POST['sy_Id_subj'];


    if(!empty($_POST['checklist_section'])) {
        foreach($_POST['checklist_section'] as $check) {
            $teacher =  $_POST['cboTeacher_'.$check];
            $sql_check = "SELECT * FROM  summer_subject A
              WHERE A.sy_level_ID = $syLevelId AND A.subject_ID = $check";
            $result_section = mysqli_query($con,$sql_check);
            if(mysqli_num_rows($result_section)>0)
            {
                //do not insert
            }
            else{

                $sql = "INSERT INTO summer_subject (sy_level_ID, subject_ID, teacher_ID)
                        VALUES('".$syLevelId."', '".$check."', $teacher)";
                $result = mysqli_query($con,$sql);
                header("Location:../managesy.php?schoolYearID=".$sy_Id."");
                //echo $conn->error();
            }
        }

        $username='';
        $sqlAdmin = "Select *from admin where ID=$adminID";
        $resultAdmin = mysqli_query($con,$sqlAdmin);
        if(mysqli_num_rows($resultAdmin)>0)
        {
            while($rowAdmin = mysqli_fetch_array($resultAdmin))
            {
                $username=$rowAdmin['username'];
            }
        }



        $sql2 = "INSERT INTO log(user,userType,logType) VALUES('$username','Admin','Added Summer Subject Per SY')";
        $result2 = mysqli_query($con,$sql2);
    }

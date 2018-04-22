<?php
/**
 * Created by PhpStorm.
 * User: PB7N0062
 * Date: 4/19/18
 * Time: 1:08 PM
 */


include "../../../dbcon.php";
include "../../sessionAdmin.php";
$section = $_POST['sylevelsectionId'];

    if(!empty($_POST['checklist_section'])) {
        foreach($_POST['checklist_section'] as $check) {
              $sql = "INSERT INTO summer_enrolled (status, student_ID, summer_subject_ID)
        VALUES('0', '".$check."', '".$section."')";
            $result = mysqli_query($con,$sql);
            header("Location:viewStudentsEnrolled.php?sectionId=".$section."");
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



        $sql2 = "INSERT INTO log(user,userType,logType) VALUES('$username','Admin','Added Student in Summer Subject Per SY')";
        $result2 = mysqli_query($con,$sql2);
    }


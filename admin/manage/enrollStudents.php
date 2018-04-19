<?php
/**
 * Created by PhpStorm.
 * User: PB7N0062
 * Date: 4/19/18
 * Time: 1:08 PM
 */


include "../../dbcon.php";
$section = $_POST['sylevelsectionId'];

    if(!empty($_POST['checklist_section'])) {
        foreach($_POST['checklist_section'] as $check) {
            $sql = "INSERT INTO enrolled_student (status, student_ID, sy_level_section_ID)
        VALUES('0', '".$check."', '".$section."')";
            $result = mysqli_query($con,$sql);
            header("Location:viewStudentsEnrolled.php?sectionId=".$section."");
        }
    }


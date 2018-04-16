<?php
/**
 * Created by PhpStorm.
 * User: Ms. Cath
 * Date: 4/15/18
 * Time: 9:22 PM
 */

include "../../dbcon.php";
$status = $_POST['radio_section'];
if($status = 'prev_year'){

}else{
    //checklist_section
    if(!empty($_POST['checklist_section'])) {
    foreach($_POST['checklist_section'] as $check) {
        echo $check;
        /*$sql = "INSERT INTO tbl_sy_course (syId, courseId)
        VALUES('".$_POST["sy_id"]."','".$check."')";
        $result = $conn->query($sql);*/
        //echo $conn->error();
    }
}
}

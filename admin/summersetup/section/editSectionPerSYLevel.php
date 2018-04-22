<?php
/**
 * Created by PhpStorm.
 * User: PB7N0062
 * Date: 4/17/18
 * Time: 10:52 AM
 */

include "../../../dbcon.php";
$id = $_POST['sy_level_section_id'];
$cboAdviser_edit = $_POST['cboAdviser_edit'];
$sy_Id = $_POST['syId_Edit'];;

$sql2 = "UPDATE summer_subject
SET
teacher_ID = $cboAdviser_edit
where ID=$id";
$result2 = mysqli_query($con,$sql2);
header("Location:../managesy.php?schoolYearID=".$sy_Id."");

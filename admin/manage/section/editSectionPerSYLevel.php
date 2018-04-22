<?php
/**
 * Created by PhpStorm.
 * User: PB7N0062
 * Date: 4/17/18
 * Time: 10:52 AM
 */

include "../../../dbcon.php";
include "../../sessionAdmin.php";
$id = $_POST['sy_level_section_id'];
$capacity_edit = $_POST['capacity_edit'];
$cboAdviser_edit = $_POST['cboAdviser_edit'];
$sy_Id = $_POST['syId_Edit'];;

$sql2 = "UPDATE sy_level_section
SET
capacity = $capacity_edit,
teacher_ID = $cboAdviser_edit
where ID=$id";
$result2 = mysqli_query($con,$sql2);




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



$sql2 = "INSERT INTO log(user,userType,logType) VALUES('$username','Admin','Updated Section Per SY')";
$result2 = mysqli_query($con,$sql2);
header("Location:../managesy.php?schoolYearID=".$sy_Id."");

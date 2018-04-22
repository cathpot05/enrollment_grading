<?php
/**
 * Created by PhpStorm.
 * User: PB7N0062
 * Date: 4/18/18
 * Time: 11:10 AM
 */

include "../../../dbcon.php";
include "../../sessionAdmin.php";
$syLevelId = $_POST['sylevelId'];
$gradeId = $_POST['gradeId'];
$syId = $_POST['grade_sy'];
$q1S = $_POST['q1S'];
$q2S = $_POST['q2S'];
$q3S = $_POST['q3S'];
$q4S = $_POST['q4S'];
$q1E = $_POST['q1E'];
$q2E = $_POST['q2E'];
$q3E = $_POST['q3E'];
$q4E = $_POST['q4E'];
if($gradeId > 0){
//update
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



    $sql2 = "INSERT INTO log(user,userType,logType) VALUES('$username','Admin','Update Grade Sched')";
    $result2 = mysqli_query($con,$sql2);


     $sql2 = "UPDATE grade_sched
            SET
            sy_level_ID = '".$syLevelId."',
            q1Start = '".$q1S."',
            q1End = '".$q1E."',
            q2Start = '".$q2S."',
            q2End = '".$q2E."',
            q3Start = '".$q3S."',
            q3End = '".$q3E."',
            q4Start = '".$q4S."',
            q4End = '".$q4E."'
            where ID=$gradeId";
$result2 = mysqli_query($con,$sql2);
}else{
    echo $sql = "INSERT INTO grade_sched (sy_level_ID, q1Start, q1End, q2Start, q2End, q3Start, q3End, q4Start, q4End)
        VALUES('".$syLevelId."', '".$q1S."', '".$q1E."', '".$q2S."', '".$q2E."', '".$q3S."', '".$q3E."', '".$q4S."', '".$q4E."')";
    $result = mysqli_query($con,$sql);

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
    $sql2 = "INSERT INTO log(user,userType,logType) VALUES('$username','Admin','Added Grade Sched')";
    $result2 = mysqli_query($con,$sql2);

}

header("Location:../managesy.php?schoolYearID=".$syId."");


?>
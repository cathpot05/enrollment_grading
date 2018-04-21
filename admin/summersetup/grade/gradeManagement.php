<?php
/**
 * Created by PhpStorm.
 * User: PB7N0062
 * Date: 4/18/18
 * Time: 11:10 AM
 */

include "../../../dbcon.php";
$syLevelId = $_POST['sylevelId'];
$gradeId = $_POST['gradeId'];
$syId = $_POST['grade_sy'];
$q1S = $_POST['q1S'];
$q1E = $_POST['q1E'];
if($gradeId > 0){
//update

    echo $sql2 = "UPDATE summer_grade_sched
            SET
            sy_level_ID = '".$syLevelId."',
            start = '".$q1S."',
            end = '".$q1E."'
            where ID=$gradeId";
$result2 = mysqli_query($con,$sql2);
}else{
    echo $sql = "INSERT INTO summer_grade_sched (sy_level_ID, start, end)
        VALUES('".$syLevelId."', '".$q1S."', '".$q1E."')";
    $result = mysqli_query($con,$sql);


}

header("Location:../managesy.php?schoolYearID=".$syId."");


?>
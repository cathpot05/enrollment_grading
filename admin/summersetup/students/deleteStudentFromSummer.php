<?php
/**
 * Created by PhpStorm.
 * User: Ms. Cath
 * Date: 4/21/18
 * Time: 10:07 PM
 */

include "../../../dbcon.php";
$id = $_GET['id'];
$syId =  $_GET['sy'];

echo $sql = "DELETE FROM summer_enrolled where ID=$id ";
$result = mysqli_query($con,$sql);
header("Location:../manage.php?schoolYearID=".$syId."");
?>
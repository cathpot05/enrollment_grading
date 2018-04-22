<?php
/**
 * Created by PhpStorm.
 * User: Ms. Cath
 * Date: 4/21/18
 * Time: 10:07 PM
 */

include "../../../dbcon.php";
include "../../sessionAdmin.php";
$id = $_GET['id'];
$syId =  $_GET['sy'];

echo $sql = "DELETE FROM summer_enrolled where ID=$id ";
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



$sql2 = "INSERT INTO log(user,userType,logType) VALUES('$username','Admin','Delete Student From Summer Subject')";
$result2 = mysqli_query($con,$sql2);
header("Location:../manage.php?schoolYearID=".$syId."");
?>
<?php
/**
 * Created by PhpStorm.
 * User: Ms. Cath
 * Date: 4/18/18
 * Time: 12:08 AM
 */


include "../../../dbcon.php";
include "../../sessionAdmin.php";
$id = $_GET['id'];

echo $sql = "DELETE FROM sy_level_subject where ID=$id ";
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



$sql2 = "INSERT INTO log(user,userType,logType) VALUES('$username','Admin','Delete Summer Subject Per SY')";
$result2 = mysqli_query($con,$sql2);
?>
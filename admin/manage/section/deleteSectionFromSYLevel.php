<?php
include "../../../dbcon.php";
include "../../sessionAdmin.php";
$schoolYearID = $_GET['id'];
$sy_level_section_id=$_GET['sectionId'];

echo $sql = "DELETE FROM sy_level_section where ID=$sy_level_section_id ";
$result = mysqli_query($con,$sql);
	header("Location:../manage.php?schoolYearID=".$schoolYearID."");



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



$sql2 = "INSERT INTO log(user,userType,logType) VALUES('$username','Admin','Delete Section Per SY')";
$result2 = mysqli_query($con,$sql2);
?>
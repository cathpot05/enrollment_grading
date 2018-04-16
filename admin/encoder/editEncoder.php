<?php
include "../../dbcon.php";
include "../sessionAdmin.php";
$id = $_GET['id'];
$employeeNo=$_POST['employeeNo'];
$Lname=$_POST['Lname'];
$Fname=$_POST['Fname'];
$Mname=$_POST['Mname'];
$contactNo=$_POST['contactNo'];
$sql = "UPDATE encoder SET employeeNo = '$employeeNo',Lname = '$Lname', Fname= '$Fname', Mname= '$Mname', contactNo= '$contactNo' where ID=$id";
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

$sql2 = "INSERT INTO log(user,userType,logType) VALUES('$username','Admin','Edited Encoder')";
$result2 = mysqli_query($con,$sql2);

echo "<script>alert('Updated Encoder Information');
			window.location.href = 'encoder_frame.php'; </script>";

?>
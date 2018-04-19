<?php
include "../../dbcon.php";
include "../sessionTeacher.php";
$id = $_GET['id'];

$employeeNo=$_POST['employeeNo'];
$Lname=$_POST['Lname'];
$Fname=$_POST['Fname'];
$Mname=$_POST['Mname'];
$contactNo=$_POST['contactNo'];

 $sql = "UPDATE teacher SET employeeNo = '$employeeNo',Lname = '$Lname', Fname= '$Fname', Mname= '$Mname', contactNo= '$contactNo' where ID=$id";
$result = mysqli_query($con,$sql);

$sqlAdmin = "Select *from teacher where ID=$id";
	$resultAdmin = mysqli_query($con,$sqlAdmin);
	if(mysqli_num_rows($resultAdmin)>0)
	{
		$user = $rowAdmin['Fname']." ". $rowAdmin['Lname'];
		while($rowAdmin = mysqli_fetch_array($resultAdmin))
		{
			$username=$rowAdmin['employeeNo'];
		}
	}
	
	$sql2 = "INSERT INTO log(user,userType,logType) VALUES('$user','Teacher','Updated his account')";
	$result2 = mysqli_query($con,$sql2);
	
	echo "<script>alert('Updated account information');
	window.location.href = 'account_info.php'; </script>";

?>
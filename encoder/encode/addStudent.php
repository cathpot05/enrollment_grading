<?php
include "../../dbcon.php";
include "../sessionEncoder.php";

$username = $_POST['username'];
$password = md5($_POST['password']);
$password2 = md5($_POST['password2']);
$Fname = $_POST['Fname'];
$Lname = $_POST['Lname'];
$Mname = $_POST['Mname'];
$LRN = $_POST['LRN'];
$classification = $_POST['classification'];
$address = $_POST['address'];
$religion = $_POST['religion'];
$contactno = $_POST['contactno'];
$birthdate = $_POST['byear']."-".$_POST['bmonth']."-".$_POST['bday'];
$age = $_POST['age'];
$gender = $_POST['gender'];

$nameMother = $_POST['nameMother'];
$occupationMother = $_POST['occupationMother'];
$contactMother = $_POST['contactMother'];
$nameFather = $_POST['nameFather'];
$occupationFather = $_POST['occupationFather'];
$contactFather = $_POST['contactFather'];

$dateCreated = date('Y-m-d');
if(isset($_POST['docs']))
	$nameGuardian = $_POST['nameGuardian'];
else
	$nameGuardian = "";

if(isset($_POST['docs']))
	$contactGuardian= $_POST['contactGuardian'];
else
	$contactGuardian= "";

$prevSchool = $_POST['prevSchool'];
$prevSY = $_POST['prevSY'];
$prevLevel = $_POST['prevLevel'];

$average = $_POST['average'];

if(isset($_POST['docs']) && $_POST['docs']!= null)
{
	$docs="";
	foreach($_POST['docs'] as $documents)
	{
		$docs .= $documents.",";
	}	
}
else
{
	$docs="";
}

if(isset($_POST['remarks']))
	$remarks = $_POST['remarks']; 
else
	$remarks = "";


if($password == $password2){
	
	$sql = "INSERT INTO student(username,password,Lname,Fname,Mname,LRN,classification,
	religion,address,contactno,birthdate,age,gender,nameMother,contactMother,occupationMother,
	nameFather,contactFather,occupationFather,nameGuardian,contactGuardian,prevSchool,prevSY,
	prevLevel,average,docs,remarks,dateCreated) 
	VALUES ('$username','$password','$Lname','$Fname','$Mname','$LRN','$classification',
	'$religion','$address','$contactno','$birthdate','$age','$gender','$nameMother','$contactMother','$occupationMother',
	'$nameFather','$contactFather','$occupationFather','$nameGuardian','$contactGuardian','$prevSchool','$prevSY',
	'$prevLevel',$average,'$docs','$remarks','$dateCreated')";
	$result = mysqli_query($con,$sql);
	
	$username='';
	$sqlAdmin = "Select *from encoder where ID=$encoderID";
	$resultAdmin = mysqli_query($con,$sqlAdmin);
	
	if(mysqli_num_rows($resultAdmin)>0)
	{
		while($rowAdmin = mysqli_fetch_array($resultAdmin))
		{
			$username=$rowAdmin['employeeNo'];
		}
	}
	
	$sql2 = "INSERT INTO log(user,userType,logType) VALUES('$username','Encoder','Added new Student')";
	$result2 = mysqli_query($con,$sql2);
	$sql = "SELECT MAX(id) as id from student";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($result);
	$maxID = $row['id'];

	echo "<script>alert('Added new Student');
		window.location.href = 'encodeMore.php?id=$maxID'; </script>";
	
}
else
{
	echo "<script>alert('Password not matched');
			window.location.href = 'encode_frame.php'; </script>";
}
	
	
?>
<?php
include "../../dbcon.php";
include "../sessionAdmin.php";

$id = $_GET['id'];
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

	$sql = "UPDATE student SET Lname='$Lname',Fname='$Fname',Mname='$Mname',LRN='$LRN',classification='$classification',
	religion='$religion',address='$address',contactno='$contactno',birthdate='$birthdate',age='$age',gender='$gender',nameMother='$nameMother',contactMother='$contactMother',occupationMother='$occupationMother',
	nameFather='$nameFather',contactFather='$contactFather',occupationFather='$occupationFather',nameGuardian='$nameGuardian',contactGuardian='$contactGuardian',prevSchool='$prevSchool',prevSY='$prevSY',
	prevLevel='$prevLevel',average=$average,docs='$docs',remarks='$remarks'
	where ID=$id";
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
	
	$sql2 = "INSERT INTO log(user,userType,logType) VALUES('$username','Admin','Edited new Student')";
	$result2 = mysqli_query($con,$sql2);
	
	echo "<script>alert('Updated Student Information');
		window.location.href = 'student_frame.php'; </script>";
	
	
	
?>
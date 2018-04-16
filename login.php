<?php include "dbcon.php"; 
session_start();
unset($_SESSION['adminID']);
unset($_SESSION['teacherID']);
unset($_SESSION['studentID']);
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDFMNHS</title>
	<link rel="shortcut icon" href="../../pdfmnhs.png" type="image/png">
    <!-- Core CSS - Include with every page -->
    <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
   <link href="assets/css/style.css" rel="stylesheet" />
      <link href="assets/css/main-style.css" rel="stylesheet" />

</head>

<body class="body-Login-back">

    <div class="container">
       
        <div class="row">
            <div class="col-md-4 col-md-offset-4 text-center logo-margin">
			 <img style="height:100px; width:100px; " src="pdfmnhs.png" alt="" /><br>
              <strong style="color:white; font-size:2.5em">&nbsp;&nbsp;PDFMNHS LOGIN</strong>
            </div>
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
					<form role="form" method=post action="">				
                    <div class="panel-heading">
                        <h3 class="panel-title">Login 
						 <select name=userType style="float:right">
							<option value="Student">Student</option>
							<option value="Teacher">Teacher</option>
							<option value="Encoder">Encoder</option>
							<option value="Admin">Admin</option>
						 </select>
						 </h3>
                    </div>
                    <div class="panel-body">
                        
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="username" type="text" autofocus required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="" required>
                                </div>
                                
                                <!-- Change this to a button or input when using this as a form -->
                                <input class="btn btn-lg btn-success btn-block" type="submit" value="Login" name="login">
                            </fieldset>
                        
                    </div>
					</form>
                </div>
            </div>
        </div>
    </div>

     <!-- Core Scripts - Include with every page -->
    <script src="assets/plugins/jquery-1.10.2.js"></script>
    <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="assets/plugins/metisMenu/jquery.metisMenu.js"></script>

</body>

</html>

<?php
if(isset($_POST['login']))
{
	$username=$_POST['username'];
	$password=md5($_POST['password']);
	
	if($_POST['userType'] == "Student")
	{
		$sql = "Select *from student where username='$username' AND password='$password'";
		$result = mysqli_query($con,$sql);
		if(mysqli_num_rows($result)>0)
		{
			while($row = mysqli_fetch_array($result))
			{
				$user = $row['Fname']." ". $row['Lname'];
				$sql2 = "INSERT INTO log(user,userType,logType) VALUES('$user','Student','Logged in')";
				$result2 = mysqli_query($con,$con,$sql2);
				header("Location:student/loginSessionStudent.php?id=".$row['ID']);
				 
			}
		}
		else
		{
			echo "<script>alert('Incorrect username or password');
			window.location.href = 'login.php'; </script>";
		}
	}
	else if($_POST['userType'] == "Teacher")
	{
		$sql = "Select *from teacher where employeeNo='$username' AND password='$password'";
		$result = mysqli_query($con,$sql);
		if(mysqli_num_rows($result)>0)
		{
			while($row = mysqli_fetch_array($result))
			{
				$user = $row['Fname']." ". $row['Lname'];
				$sql2 = "INSERT INTO log(user,userType,logType) VALUES('$user','Teacher','Logged in')";
				$result2 = mysqli_query($con,$sql2);	
				header("Location:teacher/loginSessionTeacher.php?id=".$row['ID']);
			}
		}
		else
		{
			echo "<script>alert('Incorrect username or password');
			window.location.href = 'login.php'; </script>";
		}
	}
	else if($_POST['userType'] == "Encoder")
	{
		$sql = "Select *from encoder where employeeNo='$username' AND password='$password'";
		$result = mysqli_query($con,$sql);
		if(mysqli_num_rows($result)>0)
		{
			while($row = mysqli_fetch_array($result))
			{
				$user = $row['Fname']." ". $row['Lname'];
				$sql2 = "INSERT INTO log(user,userType,logType) VALUES('$user','Encoder','Logged in')";
				$result2 = mysqli_query($con,$con,$sql2);
				header("Location:encoder/loginSessionEncoder.php?id=".$row['ID']);
			}
		}
		else
		{
			echo "<script>alert('Incorrect username or password');
			window.location.href = 'login.php'; </script>";
		}
	}
	else if($_POST['userType'] == "Admin")
	{
		$sql = "Select *from admin where username='$username' AND password='$password'";
		$result = mysqli_query($con,$sql);
		if(mysqli_num_rows($result)>0)
		{
			while($row = mysqli_fetch_array($result))
			{
				$user = $row['username'];
				$sql2 = "INSERT INTO log(user,userType,logType) VALUES('$user','Admin','Logged in')";
				$result2 = mysqli_query($con,$sql2);
				header("Location:admin/loginSessionAdmin.php?id=".$row['ID']);
			}
		}
		else
		{
			echo "<script>alert('Incorrect username or password');
			window.location.href = 'login.php'; </script>";
		}
	}	
}
?>

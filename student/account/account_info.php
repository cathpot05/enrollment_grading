<?php

include "../../dbcon.php";
include "../sessionStudent.php";
$username='';
$sql = "Select *from student where ID=$studentID";
$result = mysqli_query($con,$sql);
if(mysqli_num_rows($result)>0)
{
	while($row = mysqli_fetch_array($result))
	{
		$username=$row['Fname']." ".$row['Lname'];
	}
}
else
{

}
?>
<!DOCTYPE html>
<html>
<style>
#icon{
    font-size:1.1em;
}
#icon:hover{
    font-size:1.3em;
     
}
</style>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDFMNHS</title>
	<link rel="shortcut icon" href="../../pdfmnhs.png" type="image/png">
    <!-- Core CSS - Include with every page -->
    <link href="../../assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="../../assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="../../assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
    <link href="../../assets/css/style.css" rel="stylesheet" />
    <link href="../../assets/css/main-style.css" rel="stylesheet" />
    <!-- Page-Level CSS -->
    <link href="../../assets/plugins/morris/morris-0.4.3.min.css" rel="stylesheet" />
	<link href="../../assets/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
</head>
<body>
    <!--  wrapper -->
    <div id="wrapper">
        <!-- navbar top -->
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="navbar">
            <!-- navbar-header -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand"  href="#">
                    <img style="height:60px; width:60px; " src="../../pdfmnhs.png" alt="" /><strong style="color:white; font-size:1.2em">&nbsp;&nbsp;PRUDENCIA D. FULE MEMORIAL NATIONAL HIGH SCHOOL</strong>
                </a>
            </div>
            <!-- end navbar-header -->
            <!-- navbar-top-links -->
            <ul class="nav navbar-top-links navbar-right">
                <!-- main dropdown -->


                <li class="dropdown">
                    <a href="../logoutSessionStudent.php">
                        <i class="fa fa-sign-out fa-3x"></i>
                    </a>
                    <!-- dropdown user-->
                    <!-- end dropdown-user -->
                </li>
                <!-- end main dropdown -->
            </ul>
            <!-- end navbar-top-links -->

        </nav>
        <!-- end navbar top -->
        <!-- navbar side -->
        <nav class="navbar-default navbar-static-side" role="navigation">
            <!-- sidebar-collapse -->
            <div class="sidebar-collapse">
                <!-- side-menu -->
                <ul class="nav" id="side-menu">
                    <li>
                        <!-- user image section-->
                        <div class="user-section">
                            <div class="user-info">
                                <div><a href="../account/account_info.php"><strong><?php echo $username; ?></strong></a></div>
                                <div class="user-text-online" align="left">
                                    <span></span>&nbsp;Student
                                </div>
								
                            </div>
							
                        </div>
						
                        <!--end user image section-->
                    </li>
					 <li>
                        <a href="../dashboard/dashboard.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                    </li>
					
					<li>
					  <a href="#"><i class="fa fa-bar-chart fa-fw"></i> My Grades<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
						<?php
						
						$sql2 = "Select A.level, A.ID from level A
								INNER JOIN sy_level B ON B.level_ID = A.ID
								INNER JOIN sy_level_section C ON C.sy_level_ID = B.ID
								INNER JOIN enrolled_student D ON D.sy_level_section_ID = B.ID
								where D.student_ID = $studentID GROUP BY A.ID
								ORDER BY RIGHT(A.level,2) ASC";
						$result2 = mysqli_query($con,$sql2);
						if(mysqli_num_rows($result2)>0)
						{
							while($row2 = mysqli_fetch_array($result2))
							{
								?>
								<li><a href="../grade/grade_frame.php?level_ID=<?php echo $row2['ID']; ?>"  >&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row2['level']; ?></a></li>
														
								<?php				
							}
						}
						?>
						</ul>
                  
                    </li>
					 <li>
                        <a href="../summer/summer_frame.php"><i class="fa fa-dashboard fa-fw"></i> Summers</a>
                    </li>
                </ul>
                <!-- end side-menu -->
            </div>
            <!-- end sidebar-collapse -->
        </nav>
        <!-- end navbar side -->
        <!--  page-wrapper -->
        <div id="page-wrapper">
            <div class="row">
                <!-- Page Header -->
                <div class="col-lg-10">
                    <h1 class="page-header">Account Information</h1>
                </div>
				<div class="col-lg-2">
							<div style="float:right; margin-top:40px" >
                            <button class="btn btn-primary btn-md" data-toggle="modal" data-target="#changePasswordModal" >
                                Change Password
                            </button>
							</div>
							
                </div>
				<div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel">Change Password</h4>
                                        </div>
										<form role="form" action="changePassword.php?id=<?php echo $studentID; ?>" method=post required>
                                        <div class="modal-body">
										<label>Old Password</label>	
										<input type=password class="form-control" name="oldPassword" required> 
										<label>New Password</label>	
										<input type=password class="form-control"  name="newPassword" required>
										<label>Confirm New Password</label>	
										<input type=password class="form-control"  name="newPassword2" required>
                                        </div>
                                        <div class="modal-footer">
											<button type="submit" class="btn btn-primary">Save</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
										</form>
                                    </div>
                                </div>
                            </div>
                <!--End Page Header -->
            </div>
			<div class="row">
			<div class="col-lg-2">
			</div>
                <div class="col-lg-8">
					<div class="well well-lg">
						<h4>Edit Account Info</h4>
					<form role="form" action="editStudent.php?id=<?php echo $studentID; ?>" method=post>
					<div class="modal-body">
			
			<?php
			
			$sql = "Select *from student where ID=$studentID";
			$result = mysqli_query($con,$sql);
			while($row = mysqli_fetch_array($result))
			{
				$bday = date($row['birthdate']);   
				?>
				
                                        <div class="modal-body">
										<label>Username</label>	
										<input type=text class="form-control" name="username" value="<?php echo $row['username']; ?>" required>
										<label>Last Name</label>	
										<input type=text class="form-control" name="Lname" value="<?php echo $row['Lname']; ?>" readonly required>
										<label>First Name</label>	
										<input type=text class="form-control" name="Fname" value="<?php echo $row['Fname']; ?>" readonly required>
										<label>Middle Name</label>	
										<input type=text class="form-control" name="Mname" value="<?php echo $row['Mname']; ?>" readonly required>
										<label>Address</label>	
										<input type=text class="form-control" name="address" value="<?php echo $row['address']; ?>" required>
										<label>Religion</label>	
										<input type=text class="form-control" name="religion" value="<?php echo $row['religion']; ?>" required>
										<label>Contact No.</label>	
										<input type=text class="form-control" name="phoneNo" value="<?php echo $row['contactno']; ?>" required>
										</div>
										<div class="modal-footer">
											<button type="submit" class="btn btn-primary">Save</button>
											<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>										
										</div>
                                    </div>
										</form>
			<?php
			}
			?>
			</div>
		
			
			</div>
                    <!--End Advanced Tables -->
                </div>
				<div class="col-lg-2">
			</div>
            </div>
        </div>
        <!-- end page-wrapper -->

    </div>
    <!-- end wrapper -->

    <!-- Core Scripts - Include with every page -->
    <script src="../../assets/plugins/jquery-1.10.2.js"></script>
    <script src="../../assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="../../assets/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="../../assets/plugins/pace/pace.js"></script>
    <script src="../../assets/scripts/siminta.js"></script>
    <!-- Page-Level Plugin Scripts-->
    <script src="../../assets/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="../../assets/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script>
        $(document).ready(function () {
            $('#dataTables-example').dataTable();
        });
    </script>
	<script type="text/javascript">
    function reload(){
    document.getElementById("myform").submit();
    }
	
	function changeID(newID,type){
        var xhr;
			if (window.XMLHttpRequest) xhr = new XMLHttpRequest(); // all browsers 
			else xhr = new ActiveXObject("Microsoft.XMLHTTP"); 	// for IE
			var url = 'changeID.php?postID='+newID+'&actiontype='+type;
			xhr.open('GET', url, false);
			xhr.onreadystatechange = function () {
                            if(type==='edit')
                            {
                         document.getElementById("editform").innerHTML = xhr.responseText;
                     }
                    else if(type==='delete')
                      {
                         document.getElementById("delForm").action = "deleteStudent.php?delID="+xhr.responseText+"";
                     }
			}
			xhr.send();
			// ajax stop
			return false;
  
    }

	</script>

</body>

</html>

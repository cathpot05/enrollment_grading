<?php

include "../../dbcon.php";
include "../sessionTeacher.php";
$username='';
$sql = "Select *from teacher where ID=$teacherID";
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
                    <a href="../logoutSessionTeacher.php">
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
                                    <span></span>&nbsp;Teacher
                                </div>
								
                            </div>
							
                        </div>
						
                        <!--end user image section-->
                    </li>
				<li>
                        <a href="../dashboard/dashboard.php"><i class="fa fa-dashboard fa-fw"></i>Dashboard</a>
                    </li>
					 <li>
                        <a href="#"><i class="fa fa-sitemap fa-fw"></i>School Year<span class="fa arrow"></span></a>
						
                        <ul class="nav nav-second-level">
						<?php
										$sql = "Select sy.schoolYear, sy.ID from sy_section_subject 
												JOIN sy_section ON sy_section_subject.sy_section_ID = sy_section.ID
												JOIN sy ON sy_section.sy_ID = sy.ID
												where sy_section_subject.teacher_ID = $teacherID GROUP BY sy_section.sy_ID";
										$result = mysqli_query($con,$sql);
										if(mysqli_num_rows($result)>0)
										{
											
											while($row = mysqli_fetch_array($result))
											{
												$sy_sectionID=$row['ID'];
												?>
												<li>
												<a href="#">&nbsp;&nbsp;<?php echo $row['schoolYear']; ?> <span class="fa arrow"></span></a>
												
												 <ul class="nav nav-third-level">
												 <?php
												$sql2 = "Select subject.subject,section.year,section.section,sy_section_subject.ID from sy_section_subject 
												JOIN subject ON sy_section_subject.subject_ID = subject.ID
												JOIN sy_section ON sy_section_subject.sy_section_ID = sy_section.ID
												JOIN section ON sy_section.section_ID = section.ID
												JOIN sy ON sy_section.sy_ID = sy.ID
												where sy_section_subject.teacher_ID = $teacherID AND sy.ID = $sy_sectionID ";
												$result2 = mysqli_query($con,$sql2);
												if(mysqli_num_rows($result2)>0)
												{
													while($row2 = mysqli_fetch_array($result2))
													{
														?>
														<li><a href="../grades/grade_frame.php?id=<?php echo $row2['ID'];?>">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row2['subject']."  (".$row2['year']."-".$row2['section'].")" ;?></a></li>
														<?php
													}
												}
												?>
												 </ul>
												
												</li>
												<?php
											}
										}
									?>
                        </ul>
                        <!-- second-level-items -->
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
                <div class="col-lg-12">
                    <h1 class="page-header">Account Information</h1>
                </div>
                <!--End Page Header -->
            </div>
			<div class="row">
			<div class="col-lg-2">
			</div>
                <div class="col-lg-8">
				
				
			
									<?php
									$sql = "Select *from teacher where ID=$teacherID";
									$result = mysqli_query($con,$sql);
									if(mysqli_num_rows($result)>0)
									{
										while($row = mysqli_fetch_array($result))
										{	
										?>
											<div class="well well-lg">
											<h3>Edit Account Information</h3>
											<br>
											<form role="form" action="editTeacher.php?id=<?php echo $teacherID; ?>" method=post>
											<label>Employee No.</label>	
											<input type=text class="form-control" value="<?php echo $row['employeeNo']; ?>" name="employeeNo" required>
											<label>Password</label>	
											<input type=password class="form-control"  name="password">
											<label>Confirm Password</label>	
											<input type=password class="form-control"  name="password2">
											<label>Last Name</label>	
											<input type=text class="form-control" value="<?php echo $row['Lname']; ?>" name="Lname" readonly required>
											<label>First Name</label>	
											<input type=text class="form-control" value="<?php echo $row['Fname']; ?>" name="Fname" readonly required>
											<label>Middle Name</label>	
											<input type=text class="form-control" value="<?php echo $row['Mname']; ?>" name="Mname" readonly required>
											<label>Contact No.</label>	
											<input type=text class="form-control" value="<?php echo $row['contactNo']; ?>" name="contactNo" required>
											<div class="modal-footer">
											<button type="submit" class="btn btn-primary">Save</button>
                                            
                                        </div>
										</form>
										
										</div>
										<?php
										}
										
									}
									
									?>
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

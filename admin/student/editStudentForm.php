<?php

include "../../dbcon.php";
include "../sessionAdmin.php";
$chosenSY = '';
$username='';
$sql = "Select *from admin where ID=$adminID";
$result = mysqli_query($con,$sql);
if(mysqli_num_rows($result)>0)
{
	while($row = mysqli_fetch_array($result))
	{
		$username=$row['username'];
	}
}

if(isset($_SESSION['selectSY']))
{
	
}
else{
	
	$_SESSION['selectSY']='';
}
if(isset($_POST['selectSY']))
{
	$_SESSION['selectSY']=$_POST['selectSY'];
}

$student_ID = $_GET['id'];
$sql = "Select *from student where ID=$student_ID";
$result = mysqli_query($con,$sql);
$rowStudent = mysqli_fetch_array($result);

$bday = date('j', strtotime($rowStudent['birthdate']));
$bmonth = date('n', strtotime($rowStudent['birthdate']));
$byear = date('Y', strtotime($rowStudent['birthdate']));

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
	<link rel="stylesheet" href="../../assets/font-awesome/css/font-awesome.min.css">
    <link href="../../assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
    <link href="../../assets/css/style.css" rel="stylesheet" />
    <link href="../../assets/css/main-style.css" rel="stylesheet" />
    <!-- Page-Level CSS -->
    <link href="../../assets/plugins/morris/morris-0.4.3.min.css" rel="stylesheet" />
	<link href="../../assets/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
</head>
<style>
#icon{
    font-size:1.1em;
}
#icon:hover{
    font-size:1.3em;
     
}

th, td {
    padding-top: 5px;
}

</style>
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
                <a class="navbar-brand" href="#">
                    <img style="height:60px; width:60px; " src="../../pdfmnhs.png" alt="" /><strong style="color:white; font-size:1.2em">&nbsp;&nbsp;PRUDENCIA D. FULE MEMORIAL NATIONAL HIGH SCHOOL</strong>
                </a>
            </div>
            <!-- end navbar-header -->
            <!-- navbar-top-links -->
             <ul class="nav navbar-top-links navbar-right">
                <!-- main dropdown -->

				<li class="dropdown">
				<?php
					$sqlcount = "Select COUNT(ID) as id from grade_actions where status=0";
					$resultcount = mysqli_query($con,$sqlcount);
					$rowcount = mysqli_fetch_array($resultcount);
					$notifCount=$rowcount['id'];
				?>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <span class="top-label label label-warning"><?php echo $notifCount; ?></span>  <i class="fa fa-bell fa-3x"></i>
                    </a>
                    <!-- dropdown alerts-->
					<ul class="dropdown-menu dropdown-alerts">
					
					<?php
					$sqlnotif = "Select teacher.Fname as TFname, teacher.Lname as TLname, student.Fname as SFname, student.Lname as SLname, grade_actions.actionType,grade_actions.status,grade_actions.Date, grade_actions.ID  FROM grade_actions
					INNER JOIN grade ON grade_actions.grade_ID = grade.ID 
					INNER JOIN sy_section_subject ON grade.sy_section_subject_ID = sy_section_subject.ID 
					INNER JOIN teacher ON sy_section_subject.teacher_ID = teacher.ID
					INNER JOIN enrolled_student ON grade.enrolled_student_ID = enrolled_student.ID
					INNER JOIN student ON enrolled_student.student_ID = student.ID
					ORDER BY DATE DESC LIMIT 6";
					$resultnotif = mysqli_query($con,$sqlnotif);
					if(mysqli_num_rows($resultnotif)>0)
					{
						while($rownotif = mysqli_fetch_array($resultnotif))
						{
							if($rownotif['actionType']==1)
								{
									if($rownotif['status'] == 0)
									{
										
										?>
									<li>
										<a data-toggle="modal" data-target="#requestModal" onclick="changeID(<?php echo $rownotif['ID']; ?>,'all');"  href=#>
											<div >
												<i class="fa fa-edit fa-fw"></i><strong><?php echo $rownotif['TFname']." ".$rownotif['TLname']; ?></strong>
												<span class="pull-right text-muted small"><?php echo date("M-d-y h:i",strtotime($rownotif['Date'])); ?></span>
												<br>
												<i>Edited <?php echo $rownotif['SFname']." ".$rownotif['SLname']; ?>'s grades</i>
												<span class="pull-right text-muted small" >Pending</span>
											</div>
										</a>
									</li>
									<li class="divider "></li>
                        
									<?php	
									}
									else if($rownotif['status'] == 1)
									{
											?>
									<li  style="background-color:#f2f2f2 ">
										<a>
											<div>
												<i class="fa fa-edit fa-fw"></i><strong><?php echo $rownotif['TFname']." ".$rownotif['TLname']; ?></strong>
												<span class="pull-right text-muted small"><?php echo date("M-d-y h:i",strtotime($rownotif['Date'])); ?></span>
												<br>
												<i>Edited <?php echo $rownotif['SFname']." ".$rownotif['SLname']; ?>'s grades</i>
												<span class="pull-right text-muted small"  style="background-color:#f2f2f2 ">Approved</span>
											</div>
										</a>
									</li>
									<li class="divider " style="background-color:#f2f2f2 "></li>
                        
									<?php	
										
									}
									 else if($rownotif['status'] == 2)
									{
											?>
									<li style="background-color:#f2f2f2 ">
										<a>
											<div>
												<i class="fa fa-edit fa-fw"></i><strong><?php echo $rownotif['TFname']." ".$rownotif['TLname']; ?></strong>
												<span class="pull-right text-muted small"><?php echo date("M-d-y h:i",strtotime($rownotif['Date'])); ?></span>
												<br>
												<i>Edited <?php echo $rownotif['SFname']." ".$rownotif['SLname']; ?>'s grades</i>
												<span class="pull-right text-muted small"  style="background-color:#f2f2f2 ">Rejected</span>
											</div>
										</a>
									</li>
									<li class="divider " style="background-color:#f2f2f2 "></li>
									<?php	
										
									}
									
									
								}
							?>
							
							
							<?php
						}
					}
					?>
					<li>
                            <a class="text-center" data-toggle="modal" data-target="#requestModal" onclick="changeID(0,'all');">
                                <strong>Show All Request</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
					</ul>

                    <!-- end dropdown-alerts -->
                </li>
                <li class="dropdown">
                    <a href="../logoutSessionAdmin.php">
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
                                    <span></span>&nbsp;Admin
                                </div>
                            </div>
                        </div>
                        <!--end user image section-->
                    </li>
                    <li>
                        <a href="../dashboard/dashboard.php"><i class="fa fa-dashboard fa-fw"></i>Dashboard</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-sitemap fa-fw"></i>Management Setup<span class="fa arrow"></span></a>
                        <div class="nav-collapse">
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="../sy/sy_frame.php">&nbsp;&nbsp;<i class="fa fa-calendar fa-fw"></i>School Years</a>
                                </li>
                                <li>
                                    <a href="../year_level/year_level_frame.php">&nbsp;&nbsp;<i class="fa fa-industry fa-fw"></i>Year Level</a>
                                </li>
                                <li >
                                    <a href="../section/section_frame.php">&nbsp;&nbsp;<i class="fa fa-list-ul fa-fw"></i>Sections</a>
                                </li>
                                <li>
                                    <a href="../subject/subject_frame.php">&nbsp;&nbsp;<i class="fa fa-book fa-fw"></i>Subjects</a>
                                </li>
                                <li  >
                                    <a href="../teacher/teacher_frame.php">&nbsp;&nbsp;<i class="fa fa-users fa-fw"></i>Teachers</a>
                                </li>
                                <li class="selected">
                                    <a href="../student/student_frame.php">&nbsp;&nbsp;<i class="fa fa-users fa-fw"></i>Students</a>
                                </li>
                                <li>
                                    <a href="../encoder/encoder_frame.php">&nbsp;&nbsp;<i class="fa fa-keyboard-o fa-fw"></i>Encoder</a>
                                </li>
                                <li>
                                    <a href="../admin/admin_frame.php">&nbsp;&nbsp;<i class="fa fa-user-plus fa-fw"></i>Admin</a>
                                </li>

                            </ul>
                        </div>
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-sitemap fa-fw"></i>School Year<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="../manage/managesy.php?schoolYearID=">&nbsp;&nbsp;<i class="fa fa-calendar fa-fw"></i>Enrollment Setup</a>
                            </li>
                            <li>
                                <a href="../summersetup/managesy.php?schoolYearID=">&nbsp;&nbsp;<i class="fa fa-calendar fa-fw"></i>Summer Setup</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="../teacher_subject/teacherSubj_frame.php"><i class="fa fa-user-circle fa-fw"></i>Teacher Subject</a>
                    </li>


                    <li>
                        <a href="../reports/report_frame.php"><i class="fa fa-list fa-fw"></i>Reports</a>
                    </li>
                    <li>
                        <a href="../log/log_frame.php" ><i class ="fa fa-industry fa-fw"></i>Log Activities</a>
                    </li>
                    <li>
                        <a target="_blank" href="../DatabaseBackup/phpExport.php" ><i class="fa fa-database fa-fw"></i>Backup Database</a>
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
                    <h1 class="page-header">Edit Student Form</h1>
                </div>
                <!--End Page Header -->
            </div>
			<div class="row">
                <div class="col-lg-12">
				
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
						<center>
						<br>
							<h3><strong>PRUDECIA D. FULE MEMORIAL NATIONAL HIGH SCHOOL</strong></h3>
								<i>Brgy. San Nicolas, San Pablo City</i>
								<br>
								<br>
								
								<form action="editStudent.php?id=<?php echo $student_ID; ?>" method="post">
								<table width=96% id="studentForm">
								<thead>
									<tr>
										<td width=8% ></td>
										<td width=8% ></td>
										<td width=8% ></td>
										<td width=8% ></td>
										<td width=8% ></td>
										<td width=8% ></td>
										<td width=8% ></td>
										<td width=8% ></td>
										<td width=8% ></td>
										<td width=8% ></td>
										<td width=8% ></td>
										<td width=8% ></td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td colspan=3><strong>Last Name</strong></td>
										<td colspan=3><strong>First Name</strong></td>
										<td colspan=3><strong>Middle Name</strong></td>
										<td colspan=3><strong>LRN</strong></td>
									</tr>
									
									<tr>
										<td colspan=3>
											<input type="text" name="Lname" value="<?php echo $rowStudent['Lname']; ?>" class="form-control" style="width:90%" required>
										</td>
										<td colspan=3>
											<input type="text" name="Fname" value="<?php echo $rowStudent['Fname']; ?>" class="form-control"  style="width:90%" required>
										</td>
										<td colspan=3>
											<input type="text" name="Mname" value="<?php echo $rowStudent['Mname']; ?>" class="form-control" style="width:90%" required>
										</td>
										<td colspan=3>
											<input type="text" name="LRN" value="<?php echo $rowStudent['LRN']; ?>" class="form-control"  >
										</td>
									</tr>
									<tr>
										<td colspan=9 ><strong>Classification</strong></td>
										<td colspan=3 ><strong>Religion</strong></td>
									</tr>
									<tr>
										<td colspan =3>
											<input type=radio name="classification" value="new" <?php if($rowStudent['classification'] == "new") echo "checked"; ?> > New Student
										</td>
										<td  colspan =3>
											<input type=radio name="classification" value="return" <?php if($rowStudent['classification'] == "return") echo "checked"; ?>> Returned Student
										</td>
										<td  colspan =3>
											<input type=radio name="classification" value="transferee" <?php if($rowStudent['classification'] == "transferee") echo "checked"; ?>> Transferee
										</td>
										<td colspan=3>
											<input type="text" name="religion" value="<?php echo $rowStudent['religion']; ?>" class="form-control" required></td>
										</td>
									</tr>
									<tr>
										<td colspan=9><strong>Address</strong></td>
										<td colspan=3><strong>Contact No.</strong></td>
									</tr>
									<tr>
										<td colspan=9>
											<input type="text" class="form-control" value="<?php echo $rowStudent['address']; ?>" name="address" style="width:97%" required>
										</td>
										<td colspan=3>
											<input type="text" class="form-control" value="<?php echo $rowStudent['contactno']; ?>" name="contactno" required>
										</td>
									</tr>
									<tr>
										<td colspan =6><strong>Birthdate</strong></td>
										<td colspan =3><strong>Age</strong></td>
										<td colspan =3><strong>Gender</strong></td>
									</tr>
									<tr>
										<td colspan =2>
										<select id="bmonth" name="bmonth" class="form-control" name="" style="width:80%" onchange="getAge()" required>
											<option value="">Month</option>
											<option value="1" <?php if($bmonth == "1") echo "selected"; ?>>January</option>
											<option value="2" <?php if($bmonth == "2") echo "selected"; ?>>February</option>
											<option value="3" <?php if($bmonth == "3") echo "selected"; ?>>March</option>
											<option value="4" <?php if($bmonth == "4") echo "selected"; ?>>April</option>
											<option value="5" <?php if($bmonth == "5") echo "selected"; ?>>May</option>
											<option value="6" <?php if($bmonth == "6") echo "selected"; ?>>June</option>
											<option value="7" <?php if($bmonth == "7") echo "selected"; ?>>July</option>
											<option value="8" <?php if($bmonth == "8") echo "selected"; ?>>August</option>
											<option value="9" <?php if($bmonth == "9") echo "selected"; ?>>September</option>
											<option value="10" <?php if($bmonth == "10") echo "selected"; ?>>October</option>
											<option value="11" <?php if($bmonth == "11") echo "selected"; ?>>November</option>
											<option value="12" <?php if($bmonth == "12") echo "selected"; ?>>December</option>
										</select>
										</td>
										<td colspan =2>
										<select id="bday" name="bday" class="form-control" name="" style="width:80%" onchange="getAge()" required>
											<option value="">Day</option>
											<?php 
											for($i=1; $i<=31; $i++)
											{
											?>
											<option value="<?php echo $i; ?>" <?php if($bday == $i) echo "selected"; ?>><?php echo $i; ?></option>
											<?php
											}
											?>
										</select>
										</td>
										<td colspan =2>
										<select id="byear" name="byear" class="form-control" style="width:80%" onchange="getAge()" required>
											<option value="">Year</option>
											<?php
											for($i=0; $i<80; $i++)
											{
											?>
												<option value="<?php echo date('Y')-$i; ?>" <?php if($byear == date('Y')-$i) echo "selected"; ?>><?php echo date('Y')-$i; ?></option>
											<?php
											}
											?>
										</select>
										</td>
										
										<td colspan =3>
											<input type="number" id="age" class="form-control" name="age" value="<?php echo $rowStudent['age']; ?>" style="width:90%" required readonly>
										</td>
										<td colspan =3 >
											<input type=radio name="gender" value="Male" required <?php if($rowStudent['gender'] == "Male") echo "checked"; ?>> Male
											<input type=radio name="gender" value="Female" required <?php if($rowStudent['gender'] == "Female") echo "checked"; ?>> Female
										</td>
									</tr>
									<tr><td colspan=12><hr></td></tr>
									<tr>
										<td colspan =6><strong>Name of Mother</strong></td>
										<td colspan =4><strong>Occupation</strong></td>
										<td colspan =2><strong>Contact No.</strong></td>
									</tr>
									<tr>
										<td colspan =6>
											<input type="text" class="form-control" value="<?php echo $rowStudent['nameMother']; ?>" name="nameMother" style="width:90%" required>
										</td>
										<td colspan =4>
											<input type="text" class="form-control" value="<?php echo $rowStudent['occupationMother']; ?>" name="occupationMother" style="width:90%" required>
										</td>
										<td colspan =2>
											<input type="text" class="form-control" value="<?php echo $rowStudent['contactMother']; ?>" name="contactMother" required>
										</td>
									</tr>
									<tr>
										<td colspan =6><strong>Name of Father</strong></td>
										<td colspan =4><strong>Occupation</strong></td>
										<td colspan =2><strong>Contact No.</strong></td>
									</tr>
									<tr>
										<td colspan =6>
											<input type="text" class="form-control" value="<?php echo $rowStudent['nameFather']; ?>" name="nameFather" style="width:90%" required>
										</td>
										<td colspan =4>
											<input type="text" class="form-control" value="<?php echo $rowStudent['occupationFather']; ?>" name="occupationFather" style="width:90%" required>
										</td>
										<td colspan =2>
											<input type="text" class="form-control" value="<?php echo $rowStudent['contactFather']; ?>" name="contactFather" required>
										</td>
									</tr>
									<tr>
										<td colspan =8><strong>Guardian</strong> <i>(if not living with parent)</i></td>
										<td colspan =4><strong>Contact No.</strong></td>
									</tr>
									<tr>
										<td colspan =8>
											<input type="text" class="form-control" value="<?php echo $rowStudent['nameGuardian']; ?>" name="nameGuardian" style="width:90%">
										</td>
										<td colspan =4>
											<input type="text" class="form-control" value="<?php echo $rowStudent['contactGuardian']; ?>" name="contactGuardian">
										</td>
									</tr>
									<tr><td colspan=12><hr></td></tr>
									<tr>
										<td colspan =12><strong>Previous School Attended</strong></td>
									</tr>
									<tr>
										<td colspan =12>
											<input type="text" class="form-control" name="prevSchool" value="<?php echo $rowStudent['prevSchool']; ?>" required>
										</td>
									</tr>
									<tr>
										<td colspan =8><strong>Last School Year Attended</strong></td>
										<td colspan =4><strong>Grade/Year Level Last Attended</strong></td>
									</tr>
									<tr>
										<td colspan =8>
											<input type="text" class="form-control" name="prevSY" value="<?php echo $rowStudent['prevSY']; ?>" style="width:90%">
										</td>
										<td colspan =4>
											<input type="text" class="form-control" name="prevLevel" value="<?php echo $rowStudent['prevLevel']; ?>" required>
										</td>
									</tr>
									<tr>
										<td colspan =4><strong>General Average</strong></td>
										<td colspan =8><strong>Documents Submitted</strong></td>
									</tr>
									<tr>
										<td colspan =4>
											<input type="number" step="0.01" class="form-control" name="average" value="<?php echo $rowStudent['average']; ?>" style="width:90%">
										</td>
										<?php
										$docs = explode(",", $rowStudent['docs']);	
										?>
										<td colspan =2>
											 <input type=checkbox name="docs[]" value="BC" <?php foreach($docs as $doc){ if($doc == "BC"){ echo "checked"; }}?>> BC
										</td>
										<td colspan =2> 
											 <input type=checkbox name="docs[]" value="F138" <?php foreach($docs as $doc){ if($doc == "F138"){ echo "checked"; }}?>> F138
										</td>
										<td colspan =2>
											 <input type=checkbox name="docs[]" value="F137" <?php foreach($docs as $doc){ if($doc == "F137"){ echo "checked"; }}?>> F137
										</td>
										<td colspan =2>
											 <input type=checkbox name="docs[]" value="GMC" <?php foreach($docs as $doc){ if($doc == "GMC"){ echo "checked"; }}?>> GMC
										</td>
									</tr>
									<tr><td colspan=12><hr></td></tr>
									<tr>
										<td colspan =12><strong>Remarks</strong></td>
									</tr>
									<tr>
										<td colspan =12><input type="test" class="form-control" name="remarks"  value="<?php echo $rowStudent['remarks']; ?>"></td>
									</tr>
								</tbody>
							
							</table>
							</center>
							<br>
							<button type="submit" style="width:100%" class="btn btn-primary">Save</button>
							</form>
						
                        </div>
                    </div>
                    <!--End Advanced Tables -->
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
	
        function getAge()
		{
			var day = document.getElementById("bday").value;
			var month = document.getElementById("bmonth").value;
			var year = document.getElementById("byear").value;
			var curr_year = <?php echo date('Y'); ?>;
			var curr_month = <?php echo date('n'); ?>;
			var curr_day = <?php echo date('j'); ?>;
			
			if(day != "" && month != "" && year != "")
			{
				var age = parseInt(curr_year) - parseInt(year);
				if(month == curr_month)
				{
					if(curr_day<day)
					{
						age--;
					}					
				}
				else if(month>curr_month)
				{
					age--;
				}
				
				document.getElementById("age").value = age;
				
			}
		}
    </script>

</body>

</html>


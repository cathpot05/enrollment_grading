<?php

include "../../dbcon.php";
include "../sessionTeacher.php";
$id = $_GET['id'];
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
$sySel = "";
if(isset($_GET['sySel']))
{
	$sySel = $_GET['sySel'];
}
else
{
		$sql = "Select *from sy ORDER BY RIGHT(schoolYear,4) DESC LIMIT 1";
		$result = mysqli_query($con,$sql);
		$row = mysqli_fetch_array($result);
		$sySel = $row['ID'];
	
}
$now = date('Y-m-d');
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
<style>
#icon{
    font-size:1.1em;
}
#icon:hover{
    font-size:1.3em;
     
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
						<a href="#"><i class="fa fa-sitemap fa-fw"></i>Manage<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level in">
						<li><a href="../subject/subject_frame.php">&nbsp;&nbsp;&nbsp;&nbsp; My Subjects</a></li>
						<li class="selected"><a href="../summer/summer_frame.php">&nbsp;&nbsp;&nbsp;&nbsp; Summer Subjects</a></li>
						</ul>
					</li>
					<li>
						<a href="../advisory/advisory_frame.php"><i class="fa fa-users fa-fw"></i>My Sections</a>
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
                    <h1 class="page-header"> Student Grades</h1>
                </div>
				
                <!--End Page Header -->
            </div>
			
				<div class="row">
                <div class="col-lg-12">
                    <!-- Advanced Tables -->
							    <div class="panel panel-default">
								<div class="panel-heading">
								List of Students
								</div>
								<div class="panel-body">
									<div class="table-responsive">
									<form action="saveSummerGrades.php?id=<?php echo $id; ?>" method=post >
										<table class="table table-hovered" >
											<thead>
												<tr>
													<th>Name</th>
													<th width=5%>Finals</th>
													<th width=5%>Drop</th>
													
												</tr>
											</thead>
											<tbody>
											<?php
											$sql = "SELECT C.*,D.grade,B.status, E.start, E.end, B.ID as seID, A.ID as ssID from summer_subject A
													INNER JOIN summer_enrolled B ON B.summer_subject_ID = A.ID
													INNER JOIN student C ON B.student_ID = C.ID
													LEFT JOIN summer_grade D ON D.summer_subject_ID = A.ID AND D.summer_enrolled_ID = B.ID
													LEFT JOIN summer_grade_sched E ON E.sy_level_ID = A.sy_level_ID
													where A.ID = $id";
											$result = mysqli_query($con,$sql);
											if(mysqli_num_rows($result)>0)
											{
												while($row = mysqli_fetch_array($result))
												{
													?>
													<tr <?php if($row['status']==1) echo "class='bg-danger'"; ?>>
														<td><?php echo $row['Fname']." ".$row['Mname']." ".$row['Lname']; ?></td>
														<td style="text-align:center">
														<?php
															if(strtotime($now) >= strtotime($row['start']) && strtotime($now) <= strtotime($row['end']) && $row['status'] == 0)
															{
																?>
															<input max="100" name="grade_<?php echo $row['seID']; ?>_<?php echo $row['ssID']; ?>" type=number value="<?php if($row['grade'] != null && $row['grade'] >0){ echo $row['grade']; }else { echo "0"; } ?>" style="width:100%" >
															<?php
															}
															else if(strtotime($now) > strtotime($row['end'])  && $row['end'] != null)
															{
																if($row['grade'] != null && $row['grade'] >0){ echo $row['grade']; }else { echo "NG"; }
															}
															else
															{
																if($row['grade'] != null && $row['grade'] >0){ echo $row['grade']; }else { echo "-"; }
															}	
														?>
														</td>
														<td>
														<?php
														if($row['status'] == 0)
														{
														
														?>
															<span  id="icon" class="fa fa-ban fa-fw" data-toggle="modal" data-target="#dropStudentModal"  onclick="changeDropID(<?php echo $row['seID']; ?>)" ></span>
															<?php 
														}
														?>
														</td >
													</tr>
													<?php
												}
											}
											?>
												
											</tbody>
										</table>
										<button style="float:right" type="submit" class="btn btn-primary">Save Changes</button>
										</form>
									</div>
								</div>
							</div>


                    <!--End Advanced Tables -->
                </div>
            <div class="modal fade" id="dropStudentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
										<form action='dropStudent.php' method=post >
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel">Drop Student</h4>
                                        </div>
										<div class="modal-body">
										<input type=hidden name="dropStudentID" id="dropStudentID">
										<p>Are you sure to drop this student? </p>
                                        </div>
                                        <div class="modal-footer">
											<button type="submit" class="btn btn-primary">Yes</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                        </div>
										</form>
                                    </div>
                                </div>
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
		function changeDropID(id)
		{
			document.getElementById("dropStudentID").value = id;
			
		}
    </script>
	<script type="text/javascript">
    function reload(){
    document.getElementById("sySelForm").submit();
    }
	

	</script>

</body>

</html>
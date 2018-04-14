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
$highestGrade=0;
$sql2 = "SELECT MAX(grade.final) AS final from grade JOIN enrolled_student ON grade.enrolled_student_ID = enrolled_student.ID 
										JOIN student ON enrolled_student.student_ID = student.ID where student.ID = $studentID";
$result2 = mysqli_query($con,$sql2);
if(mysqli_num_rows($result2)>0)
{
while($row2 = mysqli_fetch_array($result2))
{	

$highestGrade = $row2['final'];													
												
}
}

$passedSubject=0;
$sql2 = "SELECT COUNT(grade.final) AS final from grade JOIN enrolled_student ON grade.enrolled_student_ID = enrolled_student.ID 
										JOIN student ON enrolled_student.student_ID = student.ID 
										where student.ID = $studentID AND grade.final>=75";
$result2 = mysqli_query($con,$sql2);
if(mysqli_num_rows($result2)>0)
{
while($row2 = mysqli_fetch_array($result2))
{	

$passedSubject = $row2['final'];													
												
}
}
$totalSubjects = 0;
$sql2 = "SELECT COUNT(sy_section_subject.subject_ID) AS total from grade JOIN enrolled_student ON grade.enrolled_student_ID = enrolled_student.ID 
										JOIN student ON enrolled_student.student_ID = student.ID 
										JOIN sy_section_subject ON grade.sy_section_subject_ID = sy_section_subject.ID 
										where student.ID = $studentID";
$result2 = mysqli_query($con,$sql2);
if(mysqli_num_rows($result2)>0)
{
while($row2 = mysqli_fetch_array($result2))
{	

$totalSubjects = $row2['total'];													
												
}
}
$since=0;
$sql2 = "Select *from student where ID=$studentID";
	$result2 = mysqli_query($con,$sql2);
	if(mysqli_num_rows($result2)>0)
	{
		while($row2 = mysqli_fetch_array($result2))
		{
			$since=date($row2['dateCreated']); 									
		}
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
                   <div class="hidden-sm"> <img style="height:60px; width:60px; " src="../../pdfmnhs.png" alt="" /><strong style="color:white; font-size:1.2em">&nbsp;&nbsp;PRUDENCIA D. FULE MEMORIAL NATIONAL HIGH SCHOOL</strong></div>
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
					 <li class="selected">
                        <a href="dashboard.php"><i class="fa fa-dashboard fa-fw"></i>Dashboard</a>
                    </li>
					 <li>
                        <a href="#"><i class="fa fa-sitemap fa-fw"></i>School Year<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
						<?php
										$sql = "Select sy.schoolYear, sy.ID from enrolled_student 
												JOIN sy_section ON enrolled_student.sy_section_ID = sy_section.ID
												JOIN sy ON sy_section.sy_ID = sy.ID
												JOIN student ON enrolled_student.student_ID = student.ID
												where student.ID = $studentID GROUP BY sy_section.sy_ID";
										$result = mysqli_query($con,$sql);
										if(mysqli_num_rows($result)>0)
										{
											
											while($row = mysqli_fetch_array($result))
											{
												$syID=$row['ID'];
												?>
												<li>
												<a href="#">&nbsp;&nbsp;<?php echo $row['schoolYear']; ?> <span class="fa arrow"></span></a>
												 <ul class="nav nav-third-level">
												 <?php
												$sql2 = "Select section.year, section.section,enrolled_student.ID from enrolled_student
												JOIN student ON enrolled_student.student_ID = student.ID
												JOIN sy_section ON enrolled_student.sy_section_ID = sy_section.ID
												JOIN section ON sy_section.section_ID = section.ID
												JOIN sy ON sy_section.sy_ID = sy.ID
												where enrolled_student.student_ID = $studentID AND sy.ID = $syID ";
												$result2 = mysqli_query($con,$sql2);
												if(mysqli_num_rows($result2)>0)
												{
													
													while($row2 = mysqli_fetch_array($result2))
													{
														?>
														<li><a href="../grades/grade_frame.php?id=<?php echo $row2['ID'];?>">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row2['year']."-".$row2['section'] ;?></a></li>
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
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!--End Page Header -->
            </div>
			<div class="row">
			
                <!-- Welcome -->
                <div class="col-md-12">
                    <div class="alert alert-info">
                        <i class="fa fa-folder-open"></i><b>&nbsp;Hello ! </b>Welcome Back <b><?php echo $username; ?></b>
						
                    </div>
                </div>
                <!--end  Welcome -->
            </div>
			<div class="row">
				<div class="col-lg-12">
					<div class="row">
					<div class="col-lg-3">
                    <div class="alert alert-danger text-center">
                        <i class="fa fa-book fa-3x"></i>&nbsp;<b><?php echo $totalSubjects; ?> </b> Total subject taken since <?php echo date("Y",strtotime($since))?>.

                    </div>
                </div>
				                <div class="col-lg-3">
                    <div class="alert alert-success text-center">
                        <i class="fa  fa-certificate fa-3x"></i>&nbsp;<b><?php echo $highestGrade; ?></b> Highest grade recieved since <?php echo date("Y",strtotime($since))?>.
                    </div>
                </div>
				<div class="col-lg-3">
                    <div class="alert alert-info text-center">
                        <i class="fa fa-thumbs-up fa-3x"></i>&nbsp;<b><?php echo $passedSubject; ?></b> Total Subjects Passed since <?php echo date("Y",strtotime($since))?>.

                    </div>
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
    <script src="../../assets/plugins/morris/raphael-2.1.0.min.js"></script>
    <script src="../../assets/plugins/morris/morris.js"></script>
    <script src="../../assets/scripts/morris-demo.js"></script>
	<script src="../../assets/scripts/dashboard-demo.js"></script>
	<script type="text/javascript">
    function reload(){
    document.getElementById("myform").submit();
    }
	</script>
	
	
</body>

</html>

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

$totalSubjects=0;
$sql2 = "SELECT COUNT(ID) as total from teacher_section_subject where teacher_ID = $teacherID GROUP BY teacher_ID";
	$result2 = mysqli_query($con,$sql2);
	if(mysqli_num_rows($result2)>0)
	{
		while($row2 = mysqli_fetch_array($result2))
		{
			$totalSubjects=$row2['total']; 									
		}
	}
	
$totalSummerSubjects=0;
$sql2 = "SELECT COUNT(ID) as total from summer_subject where teacher_ID = $teacherID GROUP BY teacher_ID";
	$result2 = mysqli_query($con,$sql2);
	if(mysqli_num_rows($result2)>0)
	{
		while($row2 = mysqli_fetch_array($result2))
		{
			$totalSummerSubjects=$row2['total']; 									
		}
	}
	
$totalSection=0;
$sql2 = "SELECT COUNT(ID) as total from sy_level_section where teacher_ID = $teacherID GROUP BY teacher_ID";
	$result2 = mysqli_query($con,$sql2);
	if(mysqli_num_rows($result2)>0)
	{
		while($row2 = mysqli_fetch_array($result2))
		{
			$totalSection=$row2['total']; 									
		}
		
	}	
$since=0;
$sql2 = "Select *from teacher where ID=$teacherID";
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
					<li class="selected">
                        <a href="../dashboard/dashboard.php"><i class="fa fa-dashboard fa-fw"></i>Dashboard</a>
                    </li>
					<li>
						<a href="#"><i class="fa fa-sitemap fa-fw"></i>Manage<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
						<li><a href="../subject/subject_frame.php">&nbsp;&nbsp;&nbsp;&nbsp; My Subjects</a></li>
						<li><a href="../summer/summer_frame.php">&nbsp;&nbsp;&nbsp;&nbsp; Summer Subjects</a></li>
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
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!--End Page Header -->
            </div>
			<div class="row">
                <!-- Welcome -->
                <div class="col-lg-12">
                    <div class="alert alert-info">
                        <i class="fa fa-folder-open"></i><b>&nbsp;Hello ! </b>Welcome Back <b><?php echo $username; ?></b>
						
                    </div>
                </div>
                <!--end  Welcome -->
            </div>
			<div class="row">
				<div class="col-md-12">
					<div class="row">
					<div class="col-md-3">
                    <div class="alert alert-danger text-center">
                        <i class="fa fa-book fa-3x"></i>&nbsp;<b> <?php echo $totalSubjects;  ?></b> Total Subjects Handled since <?php echo date("Y",strtotime($since))?>
                    </div>
					</div>
					<div class="col-md-3">
                    <div class="alert alert-warning text-center">
                        <i class="fa fa-book fa-3x"></i>&nbsp;<b> <?php echo $totalSummerSubjects;  ?></b> Total Summer Subjects Handled since <?php echo date("Y",strtotime($since))?>
                    </div>
					</div>
					<div class="col-md-3">
                    <div class="alert alert-info text-center">
                        <i class="fa fa-users fa-3x"></i>&nbsp;<b> <?php echo $totalSection;  ?></b> Sections Handled since <?php echo date("Y",strtotime($since))?>
                    </div>
					</div>
					<div class="col-md-3">
						<div class="alert alert-success text-center">
							<i class="fa fa-calendar fa-3x"></i>&nbsp;<b> <?php if(date("Y")-date("Y",strtotime($since)) >0 ) echo date("Y")-date("Y",strtotime($since)); else echo "Less than 1 ";  ?></b> year/s of teaching students passionately.
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
    function reload()
	{
    document.getElementById("myform").submit();
    }
	</script>
	
	
</body>

</html>

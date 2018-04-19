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
$totalSubjects=0;
$sql2 = "Select COUNT(A.ID) as total from sy_level_subject A
INNER JOIN sy_level_section B ON A.sy_level_ID = B.sy_level_ID
INNER JOIN enrolled_student C ON C.sy_level_section_ID = B.ID
where C.student_ID = $studentID";
$result2 = mysqli_query($con,$sql2);
if(mysqli_num_rows($result2)>0)
{
while($row2 = mysqli_fetch_array($result2))
{	

$totalSubjects = $row2['total'];													
												
}
}
$highestGrade=0;
$sql2 = "Select MAX((A.q1+A.q2+A.q3+A.q4)/4) as final from grade A
INNER JOIN enrolled_student B ON A.enrolled_student_ID = B.ID
where B.student_ID = $studentID";
$result2 = mysqli_query($con,$sql2);
if(mysqli_num_rows($result2)>0)
{
while($row2 = mysqli_fetch_array($result2))
{	

$highestGrade = $row2['final'];													
												
}
}

$passedSubject=0;
$sql2 = "Select (A.q1+A.q2+A.q3+A.q4)/4 as final from grade A
INNER JOIN enrolled_student B ON A.enrolled_student_ID = B.ID
where B.student_ID = $studentID";
$result2 = mysqli_query($con,$sql2);
if(mysqli_num_rows($result2)>0)
{
while($row2 = mysqli_fetch_array($result2))
{	
if($row2['final']>75)
{
$passedSubject++;		
}													
												
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
                                    <span></span>&nbsp; Student
                                </div>
								
                            </div>
							
                        </div>
						
                        <!--end user image section-->
                    </li>
					 <li class="selected">
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
								
								<li><a href="../grade/grade_frame.php?level_ID=<?php echo $row2['ID']; ?>" >&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row2['level']; ?></a></li>
														
								<?php				
							}
						}
						?>
						</ul>
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

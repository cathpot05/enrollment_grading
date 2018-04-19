<?php

include "../../dbcon.php";
include "../sessionStudent.php";
$level_ID = $_GET['level_ID'];
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

$sySel = "";
if(isset($_GET['sySel']))
{
	$sySel = $_GET['sySel'];
}
else
{
		$sql = "Select B.* from sy_level A
							INNER JOIN sy B ON A.sy_ID = B.ID
							INNER JOIN sy_level_section C ON C.sy_level_ID = A.ID
							INNER JOIN enrolled_student D ON D.sy_level_section_ID = C.ID
							where A.level_ID = $level_ID AND D.student_ID=$studentID
							ORDER BY RIGHT(schoolYear,4) DESC";
		$result = mysqli_query($con,$sql);
		$row = mysqli_fetch_array($result);
		$sySel = $row['ID'];
	
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
					 <li>
                        <a href="../dashboard/dashboard.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                    </li>
					
					<li>
					  <a href="#"><i class="fa fa-bar-chart fa-fw"></i> My Grades<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level in">
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
								<li <?php if($level_ID == $row2['ID']){ echo 'class="selected"'; } ?> ><a href="../grade/grade_frame.php?level_ID=<?php echo $row2['ID']; ?>"  >&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row2['level']; ?></a></li>
														
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
                    <h1 class="page-header">Grades</h1>
                </div>
				<div class="col-lg-2">
					<div style="float:right; margin-top:40px" >
                       <form action='subject_frame.php' method ="get" id="sySelForm"> 
							<label> SY: <label> 
							<select name="sySel" class="form-control" onchange="reload();">
							<?php
							$sql = "Select B.* from sy_level A
							INNER JOIN sy B ON A.sy_ID = B.ID
							INNER JOIN sy_level_section C ON C.sy_level_ID = A.ID
							INNER JOIN enrolled_student D ON D.sy_level_section_ID = C.ID
							where A.level_ID = $level_ID AND D.student_ID=$studentID
							ORDER BY RIGHT(schoolYear,4) DESC";
							$result = mysqli_query($con,$sql);
							if(mysqli_num_rows($result)>0)
							{
								while($row = mysqli_fetch_array($result))
								{
									?>
									<option value="<?php echo $row['ID']?>" <?php if($row['ID'] == $sySel) echo "selected"; ?>><?php echo $row['schoolYear']; ?></option>
									<?php
								}
							}
							?>
							</select>
						</form> 
					</div>
				</div>
                <!--End Page Header -->
            </div>
			<div class="row">
                <div class="col-lg-12">
                    <!-- Advanced Tables -->
							    <div class="panel panel-default">
								<div class="panel-heading">
									Grades
								</div>
								<div class="panel-body">
									<div class="table-responsive">
										<table class="table table-hovered">
											<thead>
												<tr>
													<th>Subjects</th>
													<th width=5%>1st Quarter</th>
													<th width=5%>2nd Quarter</th>
													<th width=5%>3rd Quarter</th>
													<th width=5%>4th Quarter</th>
													<th width=5%>Final</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$sql = "SELECT G.subject,F.q1,F.q2,F.q3,F.q4, (F.q1+F.q2+F.q3+F.q4)/4 as finals from sy_level_subject A
														INNER JOIN sy_level B ON A.sy_level_ID = B.ID
														INNER JOIN sy_level_section C ON C.sy_level_ID = B.ID
														INNER JOIN enrolled_student D ON D.sy_level_section_ID = C.ID
														INNER JOIN teacher_section_subject E ON E.sy_level_subject_ID = A.ID
														LEFT JOIN grade F ON F.enrolled_student_ID = D.ID AND F.teacher_section_subject_ID = E.ID
														INNER JOIN subject G ON A.subject_ID = G.ID
														WHERE B.sy_ID = $sySel AND B.level_ID =$level_ID AND D.student_ID = $studentID";
														$result = mysqli_query($con,$sql);
														if(mysqli_num_rows($result)>0)
														{
															while($row = mysqli_fetch_array($result))
															{
																?>
																<tr>
																	<td><?php echo $row['subject']; ?></td>
																	<td><?php if($row['q1'] != null && $row['q1'] >0){ echo $row['q1']; }else { echo "-"; } ?></td>
																	<td><?php if($row['q2'] != null && $row['q2'] >0){ echo $row['q2']; }else { echo "-"; } ?></td>
																	<td><?php if($row['q3'] != null && $row['q3'] >0){ echo $row['q3']; }else { echo "-"; } ?></td>
																	<td><?php if($row['q4'] != null && $row['q4'] >0){ echo $row['q4']; }else { echo "-"; }; ?></td>
																	<td>
																	<?php 
																	if($row['finals'] != null && $row['finals'] >0)
																	{
																		if($row['finals']<70)
																		{
																			echo "<strong style='color:red'>".$row['finals']."</strong>";
																		}
																		else
																		{
																			echo "<strong>".$row['finals']."</strong>";
																		}
																	}
																	else
																	{
																		echo "-";																		
																	}
																	?>
																	</td>
																</tr>
																<?php
															}
														}
														?>
											</tbody>
										</table>
									</div>
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

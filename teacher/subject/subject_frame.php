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
						<li  class="selected"><a href="../subject/subject_frame.php">&nbsp;&nbsp;&nbsp;&nbsp; My Subjects</a></li>
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
                <div class="col-lg-10">
                    <h1 class="page-header">Subjects</h1>
                </div>
				<div class="col-lg-2">
					<div style="float:right; margin-top:40px" >
                       <form action='subject_frame.php' method ="get" id="sySelForm"> 
							<label> SY: <label> 
							<select name="sySel" class="form-control" onchange="reload();">
							<?php
							$sql = "Select *from sy ORDER BY RIGHT(schoolYear,4) DESC";
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
					<?php
					$sql = "Select B.level,A.ID from sy_level A 
							INNER JOIN level B ON A.level_ID = B.ID
							where A.sy_ID = $sySel";
					$result = mysqli_query($con,$sql);
					if(mysqli_num_rows($result)>0)
					{
						while($row = mysqli_fetch_array($result))
						{
							$sy_level_ID = $row['ID']; 
							?>
							
							    <div class="panel panel-default">
								<div class="panel-heading">
									<?php echo $row['level']; ?>
								</div>
								<div class="panel-body">
									<div class="table-responsive">
										<table class="table table-hovered">
											<thead>
												<tr>
													<th>Subject</th>
													<th>Section</th>
													<th width=5%>Grades</th>
												</tr>
											</thead>
											<tbody>
											<?php
											$sql2 = "Select A.ID,E.subject,F.section from teacher_section_subject A
											INNER JOIN teacher  B ON A.teacher_ID = B.ID
											INNER JOIN sy_level_subject C ON A.sy_level_subject_ID = C.ID
											INNER JOIN sy_level_section D ON A.sy_level_section_ID = D.ID
											INNER JOIN subject E ON C.subject_ID = E.ID
											INNER JOIN section F ON D.section_ID = F.ID
											where B.ID = $teacherID AND C.sy_level_ID = $sy_level_ID AND D.sy_level_ID = $sy_level_ID";
											$result2 = mysqli_query($con,$sql2);
											if(mysqli_num_rows($result2)>0)
											{
												while($row2 = mysqli_fetch_array($result2))
												{
													?>
													<tr>
														<td><?php echo $row2['subject']; ?></td>
														<td><?php echo $row2['section']; ?></td>
														<td>
															<span id="icon" class="fa fa-list fa-fw" onclick="window.location.href='viewGrades.php?id=<?php echo $row2['ID']; ?>'" ></span>
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
							<?php
						}
					}
					?>
					
					
					

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
    function reload(){
    document.getElementById("sySelForm").submit();
    }
	

	</script>

</body>

</html>

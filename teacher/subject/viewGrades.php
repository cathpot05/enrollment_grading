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
									<form action="saveGrades.php?id=<?php echo $id; ?>" method=post >
										<table class="table table-hovered">
											<thead>
												<tr>
													<th>Name</th>
													<th width=5%>1st Quarter</th>
													<th width=5%>2nd Quarter</th>
													<th width=5%>3rd Quarter</th>
													<th width=5%>4th Quarter</th>
													<th width=5%>Finals</th>
												</tr>
											</thead>
											<tbody>
											<?php
											$sql = "Select D.*,E.q1,E.q2,E.q3,E.q4,(E.q1+E.q2+E.q3+E.q4)/4 as final,C.ID as esID, A.ID as tssID,
											G.q1Start,G.q1End,G.q2Start,G.q2End,G.q3Start,G.q3End,G.q4Start,G.q4End
											from teacher_section_subject A 
											INNER JOIN sy_level_section B ON A.sy_level_section_ID = B.ID
											INNER JOIN enrolled_student C ON C.sy_level_section_ID = B.ID
											INNER JOIN student D ON C.student_ID = D.ID
											LEFT JOIN grade E ON E.enrolled_student_ID = C.ID and E.teacher_section_subject_ID = A.ID 
											INNER JOIN sy_level_subject F ON A.sy_level_subject_ID = F.ID
											LEFT JOIN grade_sched G ON B.sy_level_ID = G.sy_level_ID AND F.sy_level_ID = G.sy_level_ID
											where A.ID = $id";
											$result = mysqli_query($con,$sql);
											if(mysqli_num_rows($result)>0)
											{
												while($row = mysqli_fetch_array($result))
												{
													?>
													<tr>
														<td><?php echo $row['Fname']." ".$row['Mname']." ".$row['Lname']; ?></td>
														<td style="text-align:center" >
															<?php
															if(strtotime($now) >= strtotime($row['q1Start']) && strtotime($now) <= strtotime($row['q1End']))
															{
																?>
																<input max="100" name="q1_<?php echo $row['esID']; ?>_<?php echo $row['tssID']; ?>" type=number value="<?php if($row['q1'] != null && $row['q1'] >0){ echo $row['q1']; }else { echo "0"; }?>" style="width:100%">
																<?php
															}
															else if(strtotime($now) > strtotime($row['q1End']) && $row['q1End'] != null)
															{
																if($row['q1'] != null && $row['q1'] >0){ echo $row['q1']; }else { echo "NG"; }
															}
															else
															{
																if($row['q1'] != null && $row['q1'] >0){ echo $row['q1']; }else { echo "-"; }
															}
																
																?>
														</td>
														<td style="text-align:center">
														<?php
															if(strtotime($now) >= strtotime($row['q2Start']) && strtotime($now) <= strtotime($row['q2End']))
															{
																?>
															<input max="100" name="q2_<?php echo $row['esID']; ?>_<?php echo $row['tssID']; ?>" type=number value="<?php if($row['q2'] != null && $row['q2'] >0){ echo $row['q2']; }else { echo "0"; } ?>" style="width:100%" >
															<?php
															}
															else if(strtotime($now) > strtotime($row['q2End']) && $row['q2End'] != null)
															{
																if($row['q2'] != null && $row['q2'] >0){ echo $row['q2']; }else { echo "NG"; }
															}
															else
															{
																if($row['q2'] != null && $row['q2'] >0){ echo $row['q2']; }else { echo "-"; }
															}
																
																?>
														</td>
														<td style="text-align:center">
														<?php
															if(strtotime($now) >= strtotime($row['q3Start']) && strtotime($now) <= strtotime($row['q3End']))
															{
																?>
															<input max="100" name="q3_<?php echo $row['esID']; ?>_<?php echo $row['tssID']; ?>" type=number value="<?php if($row['q3'] != null && $row['q3'] >0){ echo $row['q3']; }else { echo "0"; } ?>" style="width:100%" >
															<?php
															}
															else if(strtotime($now) > strtotime($row['q3End'])  && $row['q3End'] != null)
															{
																if($row['q3'] != null && $row['q3'] >0){ echo $row['q3']; }else { echo "NG"; }
															}
															else
															{
																if($row['q3'] != null && $row['q3'] >0){ echo $row['q3']; }else { echo "-"; }
															}
																
																?>
														</td>
														<td style="text-align:center">
														<?php
															if(strtotime($now) >= strtotime($row['q4Start']) && strtotime($now) <= strtotime($row['q4End']))
															{
																?>
															<input max="100" name="q4_<?php echo $row['esID']; ?>_<?php echo $row['tssID']; ?>" type=number value="<?php if($row['q4'] != null && $row['q4'] >0){ echo $row['q4']; }else { echo "0"; } ?>" style="width:100%" >
															<?php
															}
															else if(strtotime($now) > strtotime($row['q4End']) && $row['q4End'] != null)
															{
																if($row['q4'] != null && $row['q4'] >0){ echo $row['q4']; }else { echo "NG"; }
															}
															else
															{
																if($row['q4'] != null && $row['q4'] >0){ echo $row['q4']; }else { echo "-"; }
															}
																
																?>
														</td>
														<td style="text-align:center">
														<?php 
															if(($row['q1'] != null  && $row['q1'] >0) && ($row['q2'] != null  && $row['q2'] >0) && ($row['q3'] != null  && $row['q3'] >0) && ($row['q4'] != null  && $row['q4'] >0))
															{
																$finals=($row['q1']+$row['q2']+$row['q3']+$row['q4'])/4;
																
																if($finals<70)
																{
																	echo "<strong style='color:red'>".$finals."</strong>";
																}
																else
																{
																	echo "<strong>".$finals."</strong>";
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
											<button style="float:right" type="submit" class="btn btn-primary">Save Changes</button>
										</form>
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
    <script src="../../assets/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="../../assets/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script>
        $(document).ready(function () {
            $('#dataTables-example').dataTable();
        });
		function editCell(inputId) {
			
			console.log(inputId);
			var inputIdWithHash = "#" + inputId;
			var elementValue = $(inputIdWithHash).text();
			$(inputIdWithHash).replaceWith('<input name="'+inputId+'" id="' + inputId + '" type="number" value="' + elementValue + '" style="width:100%" autofocus>');
			
			$(document).click(function (event) {
				
				if (!$(event.target).closest(inputIdWithHash).length) {
					$(inputIdWithHash).replaceWith('<p id="' + inputId + '" onclick="editCell(\'' + inputId + '\')">' + elementValue + '</p>');
				}
			});
		}
    </script>
	<script type="text/javascript">
    function reload(){
    document.getElementById("sySelForm").submit();
    }
	

	</script>

</body>

</html>

<?php

include "../../dbcon.php";
include "../sessionTeacher.php";
$id=$_GET['id'];
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
$sql2 = "Select subject.subject,section.year,section.section,sy_section_subject.ID from sy_section_subject 
												JOIN subject ON sy_section_subject.subject_ID = subject.ID
												JOIN sy_section ON sy_section_subject.sy_section_ID = sy_section.ID
												JOIN section ON sy_section.section_ID = section.ID
												JOIN sy ON sy_section.sy_ID = sy.ID
												where sy_section_subject.teacher_ID = $teacherID AND sy_section_subject.ID = $id";
												$result2 = mysqli_query($con,$sql2);
												if(mysqli_num_rows($result2)>0)
												{
													
													while($row2 = mysqli_fetch_array($result2))
													{
														$subjectGrades = $row2['subject']." (".$row2['year']."-".$row2['section'].")";
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
														<li class=<?php if($row2['ID']==$id){echo "selected";} ?>><a href="../grades/grade_frame.php?id=<?php echo $row2['ID'];?>">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row2['subject']."  (".$row2['year']."-".$row2['section'].")" ;?></a></li>
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
                    <h1 class="page-header"><?php echo $subjectGrades; ?> Student Grades</h1>
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
                                <table class="table table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
											<th width=5%>1st Quarter</th>
											<th width=5%>2nd Quarter</th>
											<th width=5%>3rd Quarter</th>
											<th width=5%>4th Quarter</th>
											<th width=5%>Finals</th>
											<th width=5%>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									$sql = "Select student.Lname, student.Fname, student.Mname, enrolled_student.ID,enrolled_student.status from sy_section_subject 
											JOIN sy_section ON  sy_section_subject.sy_section_ID=sy_section.ID  
											JOIN section ON sy_section.section_ID = section.ID
											JOIN enrolled_student ON  sy_section.ID=enrolled_student.sy_section_ID  
											JOIN student ON enrolled_student.student_ID = student.ID
											where sy_section_subject.ID = $id AND sy_section_subject.teacher_ID = $teacherID";
									$result = mysqli_query($con,$sql);
									if(mysqli_num_rows($result)>0)
									{
										while($row = mysqli_fetch_array($result))
										{	
										?>
											<tr>
                                            <td><?php if($row['status']==1){echo "<del style=color:red>";}?><?php echo $row['Lname'].", ".$row['Fname']." ".$row['Mname']; ?></td>
											
											<?php
											$esID = $row['ID'];
											$sql2 = "SELECT *from grade where enrolled_student_ID = $esID AND sy_section_subject_ID = $id";
											$result2 = mysqli_query($con,$sql2);
											if(mysqli_num_rows($result2)>0)
											{
												while($row2 = mysqli_fetch_array($result2))
												{	
													?>
													<div>
													<td><?php echo round($row2['q1'], 2, PHP_ROUND_HALF_UP); ?></td>
													<td><?php echo round($row2['q2'], 2, PHP_ROUND_HALF_UP); ?></td>
													<td><?php echo round($row2['q3'], 2, PHP_ROUND_HALF_UP); ?></td>
													<td><?php echo round($row2['q4'], 2, PHP_ROUND_HALF_UP); ?></td>
													<td><strong><font color=<?php if($row2['final']<75)echo "red";?>><?php echo round($row2['final'], 2, PHP_ROUND_HALF_UP); ?></font><strong></td>
													</div>
													<td><center><span id="icon" class="fa fa-edit fa-fw"  data-toggle="modal" data-target="#gradeModal" onclick="changeID(<?php echo $row2['ID']; ?>,'grade');"></span></center></td>
													<?php
												}
											}
											else
											{
												?>
													<div>
													<td>0</td>
													<td>0</td>
													<td>0</td>
													<td>0</td>
													<td><strong>0<strong></td>
													</div>
													<td><center><span id="icon" class="fa fa-edit fa-fw"  data-toggle="modal" data-target="#gradeModal" onclick="changeID(<?php echo $esID; ?>,'grade2');"></span></center></td>
													<?php
											}
											?>
											</tr>
										<?php
										}
										
									}
									
									?>
                                       
                                    </tbody>
                                </table>
								
                            </div>
							<button class="btn btn-primary btn-md" onclick="changeID(<?php echo $id; ?>,'printgrade');">Print Report</button>
								
								<div class="modal fade" id="" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog" style="width:80%">
										<div id="printTable">
										</div>
                                </div>
                                </div>
								
                            <div class="modal fade" id="gradeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel">Edit Grades</h4>
                                        </div>
										<div id=gradeform>
										</div>
                                    </div>
                                </div>
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
    </script>
	<script type="text/javascript">
    function reload(){
    document.getElementById("myform").submit();
    }
	
	function changeID(newID,type){
        var xhr;

			if (window.XMLHttpRequest) xhr = new XMLHttpRequest(); // all browsers 
			else xhr = new ActiveXObject("Microsoft.XMLHTTP"); 	// for IE
			var url = 'changeID.php?postID='+newID+'&sssID=<?php echo $id; ?>&actiontype='+type+'&sy_section_subjectID=<?php echo $id; ?>';
			xhr.open('GET', url, false);
			xhr.onreadystatechange = function () {
				  if(type==='grade'||type==='grade2')
                            {
                         document.getElementById("gradeform").innerHTML = xhr.responseText;
                     }
					  else if(type==='printgrade')
                            {
                        document.getElementById("printTable").innerHTML = xhr.responseText;
						  printData();
                     }

                     
			}
			xhr.send();
			// ajax stop
			return false;
  
    }
	
	function printData()
		{
			
	
		   var divToPrint=document.getElementById("printTable");
		   newWin= window.open("");
		   newWin.document.write(divToPrint.outerHTML);
		   newWin.print();
		   newWin.close();
		}

	</script>

</body>

</html>

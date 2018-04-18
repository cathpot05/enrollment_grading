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
                        <ul class="nav nav-second-level">
						<li><a href="../subject/subject_frame.php">&nbsp;&nbsp;&nbsp;&nbsp; My Subjects</a></li>
						<li><a href="../summer/summer_frame.php">&nbsp;&nbsp;&nbsp;&nbsp; Summer Subjects</a></li>
						</ul>
					</li>
					<li  class="selected">
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
                    <h1 class="page-header">Student List</h1>
                </div>
				<div class="col-lg-2">
					<div style="float:right; margin-top:40px" >
                       <form action='' method ="get" id="sySelForm"> 
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
				    <div class="panel panel-default">
						<div class="panel-heading">
						<table width=100%>
							<tr>
								<td><?php
											$sql = "SELECT C.* from sy_level_section A
											INNER JOIN sy_level B ON A.sy_level_ID = B.ID
											INNER JOIN section C ON A.section_ID = C.ID
											where A.teacher_ID = $teacherID and B.sy_ID = $sySel";
											$result = mysqli_query($con,$sql);
											$row = mysqli_fetch_array($result);
											echo "List of Students from <strong>".$row['section']."</strong>";
													?>
													
													</td>
								<td style="text-align:right">
								<strong>Subjects : </strong>
								</td>
								<td width=20%>
								 <select id="subjSel" name="subjSel" class="form-control" style="width:90%; float:right" onchange="subjectList();">
								 <option value=0>Choose Subject</option>
								<?php
											echo $sql = "SELECT D.subject,C.ID from sy_level A 
											INNER JOIN sy_level_section B ON B.sy_level_ID = A.ID
											INNER JOIN sy_level_subject C ON C.sy_level_ID = A.ID
											INNER JOIN subject D ON c.subject_ID = D.ID
											where B.teacher_ID = $teacherID and A.sy_ID = $sySel";
											$result = mysqli_query($con,$sql);
											if(mysqli_num_rows($result)>0)
											{
												while($row = mysqli_fetch_array($result))
												{
													?>
													<option value="<?php echo $row['ID']; ?>"><?php echo $row['subject']; ?></option>
													<?php
													
												}
											}
								?>
								</select>
								</td>
							</tr>
						</table>
					</div>
					<div class="panel-body">
					<div class="table-responsive" id="subjectList">
						
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
    document.getElementById("sySelForm").submit();
    }
	
	function subjectList()
	{
		var subjectID = document.getElementById('subjSel').value;
		var xhr;
		if (window.XMLHttpRequest) xhr = new XMLHttpRequest(); // all browsers 
		else xhr = new ActiveXObject("Microsoft.XMLHTTP"); 	// for IE
		var url = 'subjectList.php?subjectID='+subjectID;
		xhr.open('GET', url, false);
		xhr.onreadystatechange = function () {
				document.getElementById("subjectList").innerHTML = xhr.responseText;
			}
			xhr.send();
			// ajax stop
			return false;
		
	}

	</script>

</body>

</html>

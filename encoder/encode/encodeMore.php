<?php

include "../../dbcon.php";
include "../sessionEncoder.php";
$id=$_GET['id'];
$username='';
$sql = "Select *from encoder where ID=$encoderID";
$result = mysqli_query($con,$sql);
if(mysqli_num_rows($result)>0)
{
	while($row = mysqli_fetch_array($result))
	{
		$username=$row['Fname']." ".$row['Lname'];
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
                    <a href="../logoutSessionEncoder.php">
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
                                    <span></span>&nbsp;Encoder
                                </div>
								
                            </div>
							
                        </div>
						
                        <!--end user image section-->
                    </li>
					 <li>
                        <a href="../dashboard/dashboard.php"><i class="fa fa-dashboard fa-fw"></i>Dashboard</a>
                    </li>
					<li class="selected">
                        <a href="../encode/encode_frame.php"><i class="fa fa-users fa-fw"></i>Encode</a>
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
                <div class="col-lg-10">
                    <h1 class="page-header">Student Information</h1>
                </div>
				<div class="col-lg-2">
							<div style="float:right; margin-top:40px" >
                            <button class="btn btn-primary btn-md" onclick="window.location.href='encode_frame.php'" >
                                Encode More
                            </button>
							</div>
				</div>
                <!--End Page Header -->
            </div>
			<div class="row">
				<div class="col-lg-12">
				<div class="well">
				<?php
					$sql = "Select *from student where ID=$id";
					$result = mysqli_query($con,$sql);
					$row = mysqli_fetch_array($result);
					
				?>
                   <table class="table table-striped" width=100% >
						<tr>
							<td width=25%></td>
							<td width=25%></td>
							<td width=25%></td>
							<td width=25%></td>
						</tr>
						<tr>
							<td><strong>Name</strong></td>
							<td><?php echo $row['Fname']." ".$row['Mname']." ".$row['Lname']; ?></td>
							<td><strong>LRN</strong></td>
							<td><?php echo $row['LRN']; ?></td>
						</tr>
						<tr>
							<td><strong>Classification</strong></td>
							<td><?php echo $row['classification']; ?></td>
							<td><strong>Religion</strong></td>
							<td><?php echo $row['religion']; ?></td>
						</tr>
						<tr>
							<td colspan=1><strong>Address</strong></td>
							<td colspan=3><?php echo $row['address']; ?></td>
						</tr>
						<tr>
							<td><strong>Contact No.</strong></td>
							<td><?php echo $row['contactno']; ?></td>
							<td><strong>Gender</strong></td>
							<td><?php echo $row['gender']; ?></td>
						</tr>
						<tr>
							<td><strong>Birthdate</strong></td>
							<td><?php echo $row['birthdate']; ?></td>
							<td><strong>Age</strong></td>
							<td><?php echo $row['age']; ?></td>
						</tr>
						<tr>
							<td colspan=1><strong>Name of Mother</strong></td>
							<td colspan=3><?php echo $row['nameMother']; ?></td>
						</tr>
						<tr>
							<td><strong>Ocuupation</strong></td>
							<td><?php echo $row['occupationMother']; ?></td>
							<td><strong>Contact No.</strong></td>
							<td><?php echo $row['contactMother']; ?></td>
						</tr>
						<tr>
							<td colspan=1><strong>Name of Father</strong></td>
							<td colspan=3><?php echo $row['nameFather']; ?></td>
						</tr>
						<tr>
							<td><strong>Occupation</strong></td>
							<td><?php echo $row['occupationFather']; ?></td>
							<td><strong>Contact No.</strong></td>
							<td><?php echo $row['contactFather']; ?></td>
						</tr>
						<tr>
							<td><strong>Name of Guardian</strong></td>
							<td><?php echo $row['nameGuardian']; ?></td>
							<td><strong>Contact No.</strong></td>
							<td><?php echo $row['contactGuardian']; ?></td>
						</tr>
						<tr>
							<td colspan=1><strong>Previous School Attended</strong></td>
							<td colspan=3><?php echo $row['prevSchool']; ?></td>
						</tr>
						<tr>
							<td><strong>Last School Year</strong></td>
							<td><?php echo $row['prevSY']; ?></td>
							<td><strong>Year Level Last Attended</strong></td>
							<td><?php echo $row['prevLevel']; ?></td>
						</tr>
						<tr>
							<td><strong>General Average</strong></td>
							<td><?php echo $row['average']; ?></td>
							<td><strong>Documents Submitted</strong></td>
							<td><?php echo $row['docs']; ?></td>
						</tr>
						<tr>
							<td colspan=1><strong>Remarks</strong></td>
							<td colspan=3><?php echo $row['remarks']; ?></td>
						</tr>
						
				   </table>
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

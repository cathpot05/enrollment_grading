<?php

include "../../dbcon.php";
include "../sessionEncoder.php";

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
					<li  class="selected">
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
                    <h1 class="page-header">Encode Student</h1>
                </div>
				<div class="col-lg-2">
							<div style="float:right; margin-top:40px" >
                            <button class="btn btn-primary btn-md" onclick="window.location.href='encodeStudentForm.php'" >
                                Add New Student
                            </button>
							</div>
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
											<th>Username</th>
                                            <th>Name</th>
											<th>Birthday</th>
											<th>Gender</th>
											<th width=5%>Edit</th>
											<th width=5%>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									$sql = "Select *from student";
									$result = mysqli_query($con,$sql);
									if(mysqli_num_rows($result)>0)
									{
										while($row = mysqli_fetch_array($result))
										{	
										?>
											<tr>
											<td><?php echo $row['username']; ?></td>
                                            <td><?php echo $row['Lname'].", ".$row['Fname']." ".$row['Mname']; ?></td>
											<td><?php echo  date('F d, Y', strtotime($row['birthdate'])); ?></td>
											<td><?php echo $row['gender']; ?></td>
											<td>
											<center>
											
											<span id="icon" class="fa fa-edit fa-fw" onclick="window.location.href='editStudentForm.php?id=<?php echo $row['ID']; ?>';" ></span></center></td>
											<td><center><span id="icon" class="fa fa-times fa-fw" data-toggle="modal" data-target="#deleteModal" onclick="changeID(<?php echo $row['ID']; ?>,'delete');"></span></center></td>
														
											</tr>
										<?php
										}
										
									}
									
									?>
                                       
                                    </tbody>
                                </table>
								
								<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel">Delete Student</h4>
                                        </div>
										<form role="form" action="" method=post id=delForm>
                                        <div class="modal-body">
										Are you sure you want to delete?
                                        </div>
                                        <div class="modal-footer">
											<button type="submit" class="btn btn-primary">Yes</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                        </div>
										</form>
                                    </div>
                                </div>
                            </div>
							
							<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel">Edit Student</h4>
                                        </div>
										<div id=editform>
										</div>
                                    </div>
                                </div>
									
									
								</div>
							
							<div class="modal fade" id="docsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel">Submit Documents</h4>
                                        </div>
										<div id="docsform">
										</div>
                                    </div>
                                </div>
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
			var url = 'changeID.php?postID='+newID+'&actiontype='+type;
			xhr.open('GET', url, false);
			xhr.onreadystatechange = function () {
                            if(type==='edit')
                            {
                         document.getElementById("editform").innerHTML = xhr.responseText;
                     }
                    else if(type==='delete')
                      {
                         document.getElementById("delForm").action = "deleteStudent.php?delID="+xhr.responseText+"";
                     }
					  else if(type==='password')
                      {
                         document.getElementById("changePasswordForm").innerHTML = xhr.responseText;
                     }
					 else if(type==='docs')
					 {
						 document.getElementById("docsform").innerHTML = xhr.responseText;
						 
					 }
					  else if(type==='all')
                      {
                          document.getElementById("requestform").innerHTML = xhr.responseText;
                     }
			}
			xhr.send();
			// ajax stop
			return false;
  
    }
	
	function requirePassword()
	{

		var newPassword = document.getElementById("newPasswordText").value;
		var newPassword2 = document.getElementById("newPassword2Text").value;
		
		if(newPassword != '' || newPassword2 != '')
		{
			document.getElementById("newPasswordText").required = true;
			document.getElementById("newPassword2Text").required = true;
		}
		else
		{
			document.getElementById("newPasswordText").required = false;
			document.getElementById("newPassword2Text").required = false;
		}
	}
	</script>
	
</body>

</html>

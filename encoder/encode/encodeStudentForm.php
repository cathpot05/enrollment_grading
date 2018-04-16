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
                <div class="col-lg-12">
                    <h1 class="page-header">Encode Student</h1>
                </div>
                <!--End Page Header -->
            </div>
			<div class="row">
                <div class="col-lg-12">
				
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
						<center>
						<br>
							<h3><strong>PRUDECIA D. FULE MEMORIAL NATIONAL HIGH SCHOOL</strong></h3>
								<i>Brgy. San Nicolas, San Pablo City</i>
								<br>
								<br>
								
								<form action="addStudent.php" method="post">
                            <table width=96% id="studentForm">
								<thead>
									<tr>
										<td width=8% ></td>
										<td width=8% ></td>
										<td width=8% ></td>
										<td width=8% ></td>
										<td width=8% ></td>
										<td width=8% ></td>
										<td width=8% ></td>
										<td width=8% ></td>
										<td width=8% ></td>
										<td width=8% ></td>
										<td width=8% ></td>
										<td width=8% ></td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td colspan=3><strong>Last Name</strong></td>
										<td colspan=3><strong>First Name</strong></td>
										<td colspan=3><strong>Middle Name</strong></td>
										<td colspan=3><strong>LRN</strong></td>
									</tr>
									
									<tr>
										<td colspan=3>
											<input type="text" name="Lname" class="form-control" style="width:90%" required>
										</td>
										<td colspan=3>
											<input type="text" name="Fname" class="form-control"  style="width:90%" required>
										</td>
										<td colspan=3>
											<input type="text" name="Mname" class="form-control" style="width:90%" required>
										</td>
										<td colspan=3>
											<input type="text" name="LRN" class="form-control"  >
										</td>
									</tr>
									<tr>
										<td colspan=9 ><strong>Classification</strong></td>
										<td colspan=3 ><strong>Religion</strong></td>
									</tr>
									<tr>
										<td colspan =3>
											<input type=radio name="classification" value="new" checked> New Student
										</td>
										<td  colspan =3>
											<input type=radio name="classification" value="return"> Returned Student
										</td>
										<td  colspan =3>
											<input type=radio name="classification" value="transferee"> Transferee
										</td>
										<td colspan=3>
											<input type="text" name="religion" class="form-control" required></td>
										</td>
									</tr>
									<tr>
										<td colspan=9><strong>Address</strong></td>
										<td colspan=3><strong>Contact No.</strong></td>
									</tr>
									<tr>
										<td colspan=9>
											<input type="text" class="form-control" name="address" style="width:97%" required>
										</td>
										<td colspan=3>
											<input type="text" class="form-control" name="contactno" required>
										</td>
									</tr>
									<tr>
										<td colspan =6><strong>Birthdate</strong></td>
										<td colspan =3><strong>Age</strong></td>
										<td colspan =3><strong>Gender</strong></td>
									</tr>
									<tr>
										<td colspan =2>
										<select id="bmonth" name="bmonth" class="form-control" name="" style="width:80%" onchange="getAge()" required>
											<option value="">Month</option>
											<option value="1">January</option>
											<option value="2">February</option>
											<option value="3">March</option>
											<option value="4">April</option>
											<option value="5">May</option>
											<option value="6">June</option>
											<option value="7">July</option>
											<option value="8">August</option>
											<option value="9">September</option>
											<option value="10">October</option>
											<option value="11">November</option>
											<option value="12">December</option>
										</select>
										</td>
										<td colspan =2>
										<select id="bday" name="bday" class="form-control" name="" style="width:80%" onchange="getAge()" required>
											<option value="">Day</option>
											<?php 
											for($i=1; $i<=31; $i++)
											{
											?>
											<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
											<?php
											}
											?>
										</select>
										</td>
										<td colspan =2>
										<select id="byear" name="byear" class="form-control" style="width:80%" onchange="getAge()" required>
											<option value="">Year</option>
											<?php
											for($i=0; $i<80; $i++)
											{
											?>
												<option value="<?php echo date('Y')-$i; ?>"><?php echo date('Y')-$i; ?></option>
											<?php
											}
											?>
										</select>
										</td>
										
										<td colspan =3>
											<input type="number" id="age" class="form-control" name="age" style="width:90%" required readonly>
										</td>
										<td colspan =3 >
											<input type=radio name="gender" value="Male" required> Male
											<input type=radio name="gender" value="Female" required> Female
										</td>
									</tr>
									<tr><td colspan=12><hr></td></tr>
									<tr>
										<td colspan =6><strong>Name of Mother</strong></td>
										<td colspan =4><strong>Occupation</strong></td>
										<td colspan =2><strong>Contact No.</strong></td>
									</tr>
									<tr>
										<td colspan =6>
											<input type="text" class="form-control" name="nameMother" style="width:90%" required>
										</td>
										<td colspan =4>
											<input type="text" class="form-control" name="occupationMother" style="width:90%" required>
										</td>
										<td colspan =2>
											<input type="text" class="form-control" name="contactMother" required>
										</td>
									</tr>
									<tr>
										<td colspan =6><strong>Name of Father</strong></td>
										<td colspan =4><strong>Occupation</strong></td>
										<td colspan =2><strong>Contact No.</strong></td>
									</tr>
									<tr>
										<td colspan =6>
											<input type="text" class="form-control" name="nameFather" style="width:90%" required>
										</td>
										<td colspan =4>
											<input type="text" class="form-control" name="occupationFather" style="width:90%" required>
										</td>
										<td colspan =2>
											<input type="text" class="form-control" name="contactFather" required>
										</td>
									</tr>
									<tr>
										<td colspan =8><strong>Guardian</strong> <i>(if not living with parent)</i></td>
										<td colspan =4><strong>Contact No.</strong></td>
									</tr>
									<tr>
										<td colspan =8>
											<input type="text" class="form-control" name="nameGuardian" style="width:90%">
										</td>
										<td colspan =4>
											<input type="text" class="form-control" name="contactGuardian">
										</td>
									</tr>
									<tr><td colspan=12><hr></td></tr>
									<tr>
										<td colspan =12><strong>Previous School Attended</strong></td>
									</tr>
									<tr>
										<td colspan =12>
											<input type="text" class="form-control" name="prevSchool" required>
										</td>
									</tr>
									<tr>
										<td colspan =8><strong>Last School Year Attended</strong></td>
										<td colspan =4><strong>Grade/Year Level Last Attended</strong></td>
									</tr>
									<tr>
										<td colspan =8>
											<input type="text" class="form-control" name="prevSY" style="width:90%">
										</td>
										<td colspan =4>
											<input type="text" class="form-control" name="prevLevel" required>
										</td>
									</tr>
									<tr>
										<td colspan =4><strong>General Average</strong></td>
										<td colspan =8><strong>Documents Submitted</strong></td>
									</tr>
									<tr>
										<td colspan =4>
											<input type="number" class="form-control" name="average" style="width:90%">
										</td>
										<td colspan =2>
											 <input type=checkbox name="docs[]" value="BC"> BC
										</td>
										<td colspan =2>
											 <input type=checkbox name="docs[]" value="F138"> F138
										</td>
										<td colspan =2>
											 <input type=checkbox name="docs[]" value="F137"> F137
										</td>
										<td colspan =2>
											 <input type=checkbox name="docs[]" value="GMC"> GMC
										</td>
									</tr>
									<tr><td colspan=12><hr></td></tr>
									<tr>
										<td colspan =12><strong>Remarks</strong></td>
									</tr>
									<tr>
										<td colspan =12><input type="test" class="form-control" name="remarks" ></td>
									</tr>
								</tbody>
							
							</table>
							</center>
							<br>
							<span style=" margin: 15px; float:right; " data-toggle="modal" data-target="#accountModal" class="btn btn-primary">Next</span>
							 <div class="modal fade" id="accountModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel">Add Student Account</h4>
                                        </div>
                                        <div class="modal-body">
											<label>Username</label>	
											<input type=text class="form-control" name="username" required>
											<label>Password</label>	
											<input type=password class="form-control" name="password" required>
											<label>Confirm Password</label>	
											<input type=password class="form-control" name="password2" required>
                                        </div>
                                        <div class="modal-footer">
											<button type="submit" class="btn btn-primary">Save</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div> 	
                                    </div>
                                </div>
                            </div>
							</form>
							
							<br>
							<br>
							<br>
							<br>
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
	<script type="text/javascript">
	
        function getAge()
		{
			var day = document.getElementById("bday").value;
			var month = document.getElementById("bmonth").value;
			var year = document.getElementById("byear").value;
			var curr_year = <?php echo date('Y'); ?>;
			var curr_month = <?php echo date('n'); ?>;
			var curr_day = <?php echo date('j'); ?>;
			
			if(day != "" && month != "" && year != "")
			{
				var age = parseInt(curr_year) - parseInt(year);
				if(month == curr_month)
				{
					if(day < curr_day)
					{
						age--;
					}					
				}
				else if(month>curr_month)
				{
					age--;
				}
				
				document.getElementById("age").value = age;

			}
		}
    </script>
	
</body>

</html>

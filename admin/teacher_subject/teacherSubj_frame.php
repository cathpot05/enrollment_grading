<?php
/**
 * Created by PhpStorm.
 * User: Ms. Cath
 * Date: 4/21/18
 * Time: 3:44 AM
 */


include "../../dbcon.php";
include "../sessionAdmin.php";
$chosenSY = '';
$username='';
$sql = "Select *from admin where ID=$adminID";
$result = mysqli_query($con,$sql);
if(mysqli_num_rows($result)>0)
{
    while($row = mysqli_fetch_array($result))
    {
        $username=$row['username'];
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
    <link rel="stylesheet" href="../../assets/font-awesome/css/font-awesome.min.css">
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
        <a class="navbar-brand"  href="#" >
            <img style="height:60px; width:60px; " src="../../pdfmnhs.png" alt="" /><strong style="color:white; font-size:1.2em">&nbsp;&nbsp;PRUDENCIA D. FULE MEMORIAL NATIONAL HIGH SCHOOL</strong>
        </a>
    </div>
    <!-- end navbar-header -->
    <!-- navbar-top-links -->
    <ul class="nav navbar-top-links navbar-right">
        <!-- main dropdown -->


        <li class="dropdown">
            <a href="../logoutSessionAdmin.php">
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
                        <div><strong><a href="../account/account_info.php"><?php echo $username; ?></strong></a></div>
                        <div class="user-text-online" align="left">
                            <span></span>&nbsp;Admin
                        </div>
                    </div>
                </div>
                <!--end user image section-->
            </li>
            <li>
                <a href="../dashboard/dashboard.php"><i class="fa fa-dashboard fa-fw"></i>Dashboard</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-sitemap fa-fw"></i>Management Setup<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="../sy/sy_frame.php">&nbsp;&nbsp;<i class="fa fa-calendar fa-fw"></i>School Years</a>
                        </li>
                        <li>
                            <a href="../year_level/year_level_frame.php">&nbsp;&nbsp;<i class="fa fa-industry fa-fw"></i>Year Level</a>
                        </li>
                        <li >
                            <a href="../section/section_frame.php">&nbsp;&nbsp;<i class="fa fa-list-ul fa-fw"></i>Sections</a>
                        </li>
                        <li>
                            <a href="../subject/subject_frame.php">&nbsp;&nbsp;<i class="fa fa-book fa-fw"></i>Subjects</a>
                        </li>
                        <li>
                            <a href="../teacher/teacher_frame.php">&nbsp;&nbsp;<i class="fa fa-users fa-fw"></i>Teachers</a>
                        </li>
                        <li>
                            <a href="../student/student_frame.php">&nbsp;&nbsp;<i class="fa fa-users fa-fw"></i>Students</a>
                        </li>
                        <li>
                            <a href="../encoder/encoder_frame.php">&nbsp;&nbsp;<i class="fa fa-keyboard-o fa-fw"></i>Encoder</a>
                        </li>
                        <li>
                            <a href="../admin/admin_frame.php">&nbsp;&nbsp;<i class="fa fa-user-plus fa-fw"></i>Admin</a>
                        </li>
                    </ul>
            </li>

            <li>
                <a href="#"><i class="fa fa-sitemap fa-fw"></i>School Year<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="../manage/managesy.php?schoolYearID=">&nbsp;&nbsp;<i class="fa fa-calendar fa-fw"></i>Enrollment Setup</a>
                    </li>
                    <li>
                        <a href="../summersetup/managesy.php?schoolYearID=">&nbsp;&nbsp;<i class="fa fa-calendar fa-fw"></i>Summer Setup</a>
                    </li>
                </ul>
            </li>
            <li class="selected">
                <a href="../teacher_subject/teacherSubj_frame.php"><i class="fa fa-user-circle fa-fw"></i>Teacher Subject</a>
            </li>
            <li>
                <a href="../reports/report_frame.php"><i class="fa fa-list fa-fw"></i>Reports</a>
            </li>
            <li>
                <a href="../log/log_frame.php" ><i class ="fa fa-industry fa-fw"></i>Log Activities</a>
            </li>
            <li>
                <a target="_blank" href="../DatabaseBackup/phpExport.php" ><i class="fa fa-database fa-fw"></i>Backup Database</a>
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
            <h1 class="page-header text-primary">Teacher - Subject Management</h1>
        </div>
        <div class="col-lg-2">
        </div>
        <!--End Page Header -->
    </div>
    <div class="row">
        <div class="col-lg-12">
            <!-- Advanced Tables -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    List of Teachers
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>View Subjects</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sql = "Select *from teacher";
                            $result = mysqli_query($con,$sql);
                            if(mysqli_num_rows($result)>0)
                            {
                                while($row = mysqli_fetch_array($result))
                                {
                                    ?>
                                    <tr>
                                        <?php $mid = $row['Mname'];?>
                                        <td><?php echo $row['Lname'].", ".$row['Fname']." ".$mid[0]."." ?></td>
                                        <td><a href="view_teacher_subj.php?teacherId=<?php echo $row['ID']; ?>&sy=0"><span id="icon" class="fa fa-list fa-fw" data-toggle="modal" data-target="#viewSubjectModal" onclick="changeID(<?php echo $row['ID']; ?>);"></span></a></td>
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
                                        <h4 class="modal-title" id="myModalLabel">Delete Teacher</h4>
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
                                        <h4 class="modal-title" id="myModalLabel">Edit Teacher</h4>
                                    </div>
                                    <div id=editform>
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
    <div class="modal fade" id="requestModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width:80%">

            <div id=requestform>
            </div>



        </div>
    </div>

    <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Change Password</h4>
                </div>
                <form role="form" action="" method=post id="changePasswordForm">
                    <div class="modal-body">
                        <label>New Password</label>
                        <input type=password class="form-control"  name="newPassword" required>
                        <label>Confirm New Password</label>
                        <input type=password class="form-control"  name="newPassword2" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
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
        var url = 'changeID.php?postID='+newID+'&actiontype='+type;
        xhr.open('GET', url, false);
        xhr.onreadystatechange = function () {
            if(type==='edit')
            {
                document.getElementById("editform").innerHTML = xhr.responseText;
            }
            else if(type==='delete')
            {
                document.getElementById("delForm").action = "deleteTeacher.php?delID="+xhr.responseText+"";
            }
            else if(type==='password')
            {
                document.getElementById("changePasswordForm").action = "changePassword.php?id="+xhr.responseText+"";
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


</script>

</body>

</html>

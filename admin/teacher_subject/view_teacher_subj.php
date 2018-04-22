<?php
/**
 * Created by PhpStorm.
 * User: Ms. Cath
 * Date: 4/21/18
 * Time: 4:06 AM
 */


include "../../dbcon.php";
include "../sessionAdmin.php";
$chosenSY = '';
$username='';
$teacherId = $_GET['teacherId'];
$sy = $_GET['sy'];
$sql = "Select *from admin where ID=$adminID";
$result = mysqli_query($con,$sql);
if(mysqli_num_rows($result)>0)
{
    while($row = mysqli_fetch_array($result))
    {
        $username=$row['username'];
    }
}

if($sy == 0){
    $sql_sy = "Select MAX(A.ID) as ID from sy A";
    $result_sy = mysqli_query($con,$sql_sy);
    if(mysqli_num_rows($result_sy)>0)
    {
        while($row_sy = mysqli_fetch_array($result_sy))
        {
            $sy=$row_sy['ID'];
        }
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
            <?php
            $sqlcount = "Select COUNT(ID) as id from grade_actions where status=0";
            $resultcount = mysqli_query($con,$sqlcount);
            $rowcount = mysqli_fetch_array($resultcount);
            $notifCount=$rowcount['id'];
            ?>
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <span class="top-label label label-warning"><?php echo $notifCount; ?></span>  <i class="fa fa-bell fa-3x"></i>
            </a>
            <!-- dropdown alerts-->
            <ul class="dropdown-menu dropdown-alerts">

                <?php
                $sqlnotif = "Select teacher.Fname as TFname, teacher.Lname as TLname, student.Fname as SFname, student.Lname as SLname, grade_actions.actionType,grade_actions.status,grade_actions.Date, grade_actions.ID  FROM grade_actions
					INNER JOIN grade ON grade_actions.grade_ID = grade.ID
					INNER JOIN sy_section_subject ON grade.sy_section_subject_ID = sy_section_subject.ID
					INNER JOIN teacher ON sy_section_subject.teacher_ID = teacher.ID
					INNER JOIN enrolled_student ON grade.enrolled_student_ID = enrolled_student.ID
					INNER JOIN student ON enrolled_student.student_ID = student.ID
					ORDER BY DATE DESC LIMIT 6";
                $resultnotif = mysqli_query($con,$sqlnotif);

                if(mysqli_num_rows($resultnotif)>0)
                {
                    while($rownotif = mysqli_fetch_array($resultnotif))
                    {
                        if($rownotif['actionType']==1)
                        {
                            if($rownotif['status'] == 0)
                            {

                                ?>
                                <li>
                                    <a data-toggle="modal" data-target="#requestModal" onclick="changeID(<?php echo $rownotif['ID']; ?>,'all');"  href=#>
                                        <div >
                                            <i class="fa fa-edit fa-fw"></i><strong><?php echo $rownotif['TFname']." ".$rownotif['TLname']; ?></strong>
                                            <span class="pull-right text-muted small"><?php echo date("M-d-y h:i",strtotime($rownotif['Date'])); ?></span>
                                            <br>
                                            <i>Edited <?php echo $rownotif['SFname']." ".$rownotif['SLname']; ?>'s grades</i>
                                            <span class="pull-right text-muted small" >Pending</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="divider "></li>

                            <?php
                            }
                            else if($rownotif['status'] == 1)
                            {
                                ?>
                                <li  style="background-color:#f2f2f2 ">
                                    <a>
                                        <div>
                                            <i class="fa fa-edit fa-fw"></i><strong><?php echo $rownotif['TFname']." ".$rownotif['TLname']; ?></strong>
                                            <span class="pull-right text-muted small"><?php echo date("M-d-y h:i",strtotime($rownotif['Date'])); ?></span>
                                            <br>
                                            <i>Edited <?php echo $rownotif['SFname']." ".$rownotif['SLname']; ?>'s grades</i>
                                            <span class="pull-right text-muted small"  style="background-color:#f2f2f2 ">Approved</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="divider " style="background-color:#f2f2f2 "></li>

                            <?php

                            }
                            else if($rownotif['status'] == 2)
                            {
                                ?>
                                <li style="background-color:#f2f2f2 ">
                                    <a>
                                        <div>
                                            <i class="fa fa-edit fa-fw"></i><strong><?php echo $rownotif['TFname']." ".$rownotif['TLname']; ?></strong>
                                            <span class="pull-right text-muted small"><?php echo date("M-d-y h:i",strtotime($rownotif['Date'])); ?></span>
                                            <br>
                                            <i>Edited <?php echo $rownotif['SFname']." ".$rownotif['SLname']; ?>'s grades</i>
                                            <span class="pull-right text-muted small"  style="background-color:#f2f2f2 ">Rejected</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="divider " style="background-color:#f2f2f2 "></li>
                            <?php

                            }


                        }
                        ?>


                    <?php
                    }
                }





                ?>
                <li>
                    <a class="text-center" data-toggle="modal" data-target="#requestModal" onclick="changeID(0,'all');">
                        <strong>Show All Request</strong>
                        <i class="fa fa-angle-right"></i>
                    </a>
                </li>
            </ul>

            <!-- end dropdown-alerts -->
        </li>
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
                <a href="#"><i class="fa fa-sitemap fa-fw"></i>Initials<span class="fa arrow"></span></a>
                <div class="nav-collapse">
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
                    </ul>
                </div>
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
        <div class="col-lg-6">
            <?php
            $sql_teach = "SELECT CONCAT(A.Lname, ', ', A.Fname) as teacher FROM teacher A where A.ID = $teacherId";
            $result_teach = mysqli_query($con,$sql_teach);
            if(mysqli_num_rows($result)>0)
            {
                while($row_teach = mysqli_fetch_array($result_teach))
                {
                    $teacher=$row_teach['teacher'];
                }
            }

            ?>
            <h1 class="page-header text-primary">Teacher - Subject Management</h1>
            <h4 class="text-primary">Teacher Name: <?php echo $teacher;?></h4>
        </div>
        <div class="col-lg-6">
            <div class="form-inline" style="float:right; margin-top:40px" >
                <label>SY:</label>
                <select class="form-control chosen" name="cboSY" id="cboSY">
                    <?php
                    $sql = "SELECT * FROM sy ORDER BY LEFT(schoolYear,4) DESC";
                    $result = mysqli_query($con,$sql);
                    if(mysqli_num_rows($result)> 0)
                    {
                        while($row = mysqli_fetch_array($result))
                        {
                            echo '
                       <option value='.$row["ID"].'>'.$row["schoolYear"].'</option>
                       ';
                        }
                    }
                    ?>
                </select>
            </div>
        </div>

        <!--End Page Header -->
    </div>
    <div class="row">
        <div class="col-lg-12">
            <!-- Advanced Tables -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    List of Handled Subjects
                    <button style="padding:3px;" class="pull-right btn btn-primary btn-sm" data-toggle="modal" data-target="#addModal" >
                        Add Subjects
                    </button>


                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th>Subject</th>
                                <th>Grade</th>
                                <th>Section</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sql = "SELECT A.ID, A.sy_level_subject_ID, A.sy_level_section_ID, E.subject, G.section, B.Fname, B.Lname, H.level, H.ID as level_id
                                FROM teacher_section_subject A
                                INNER JOIN teacher B ON A.teacher_ID = B.ID
                                INNER JOIN sy_level_subject C ON A.sy_level_subject_ID = C.ID
                                INNER JOIN sy_level_section D ON A.sy_level_section_ID = D.ID
                                INNER JOIN subject E ON C.subject_ID = E.ID
                                INNER JOIN sy_level F ON D.sy_level_ID = F.ID
                                INNER JOIN level H ON F.level_id = H.ID
                                INNER JOIN section G ON D.section_ID = G.ID
                                WHERE A.teacher_ID = $teacherId AND F.sy_ID = $sy
";
                            $result = mysqli_query($con,$sql);
                            if(mysqli_num_rows($result)>0)
                            {
                                while($row = mysqli_fetch_array($result))
                                {
                                    ?>
                                    <tr>
                                        <td><?php echo strtoupper( $row['subject']); ?></td>
                                        <td><?php echo strtoupper( $row['level']); ?></td>
                                        <td><?php echo strtoupper($row['section']); ?></td>
                                        <td><a href="deleteTeacherSubj.php?id=<?php echo $row['ID'];?>"><span class="fa fa-trash"></span></a></td>
                                    </tr>
                                <?php
                                }
                            }
                            ?>
                            </tbody>
                        </table>


                        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">Add Handled Subject</h4>
                                    </div>
                                    <form role="form" action="addTeacherSubjects.php" method=post>
                                        <div class="modal-body">
                                            <table class="table table-hover table-inverse" id="dataTables-example" style="border-style:inset; margin-top: 20px;">
                                                <caption>Chooose Subject</caption>
                                                <thead>
                                                <tr>
                                                    <th><input type="checkbox" name="checkall" id="checkall" value=""/> Check All</th>
                                                    <th>Level</th>
                                                    <th>Section</th>
                                                    <th>Subject</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                <input type="hidden" name="teacherId" value="<?php echo $teacherId; ?>" />
                                                <input type="hidden" name="sy" value="<?php echo $sy; ?>" />
                                                <?php
                                                $sql_section = "SELECT A.ID as sy_level_subject_id, B.ID as sy_level_section_id, D.section, G.subject, F.level, E.schoolYear, H.teacher_ID
                                                    FROM sy_level_subject A
                                                    INNER JOIN sy_level_section B ON B.sy_level_ID =  A.sy_level_ID
                                                    INNER JOIN sy_level C ON A.sy_level_ID = C.level_ID
                                                    INNER JOIN section D ON B.section_ID = D.ID
                                                    INNER JOIN sy E ON C.sy_ID = E.ID
                                                    INNER JOIN level F ON C.level_ID = F.ID
                                                    INNER JOIN subject G ON A.subject_ID = G.ID
                                                    LEFT JOIN teacher_section_subject H ON A.ID = H.sy_level_subject_ID AND B.ID = H.sy_level_section_ID
                                                    WHERE H.teacher_ID IS NULL
                                                    AND E.ID = $sy
                                                    ORDER BY D.section, F.level ASC";
                                                $result_section = mysqli_query($con,$sql_section);

                                                if(mysqli_num_rows($result_section)>0)
                                                {
                                                    while($row_section = mysqli_fetch_array($result_section))
                                                    {
                                                        $section = $row_section["section"];
                                                        echo '
         <tr>
            <td width="20%" ><input type="checkbox" name="checklist_section[]" value="'.$row_section["sy_level_subject_id"].'_'.$row_section["sy_level_section_id"].'"/>
             </td>
            <td>'.$row_section["level"].' <input type=hidden class="form-control" name=sylevelSecId_'.$row_section["sy_level_subject_id"].'_'.$row_section["sy_level_section_id"].'  value="'.$row_section["sy_level_section_id"].'"/></td>
            <td>'.$row_section["section"].' <input type=hidden class="form-control" name=sylevelSubjId_'.$row_section["sy_level_subject_id"].'_'.$row_section["sy_level_section_id"].'  value="'.$row_section["sy_level_subject_id"].'"/></td>
            <td>'.$row_section["subject"].'</td>
         </tr>
        ';
                                                    }
                                                }
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


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

    $('#cboSY option[value="<?php echo $sy; ?>"]').attr('selected', 'selected');
    $("#cboSY").on('change', function() {
        var x =$("#cboSY").val();
        window.location.href = "view_teacher_subj.php?teacherId=<?php echo $teacherId;?>&sy="+x;
    });

    $("#checkall").click(function(){
        $('input:checkbox').not(this).prop('checked', this.checked);
    });




</script>

</body>

</html>
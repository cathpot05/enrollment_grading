<?php
/**
 * Created by PhpStorm.
 * User: Ms. Cath
 * Date: 4/15/18
 * Time: 2:48 PM
 */


//error_reporting(0);
include "../../dbcon.php";
include "../sessionAdmin.php";
$schoolYearID=$_GET['schoolYearID'];

if($schoolYearID == ""){
    $sql_e = "Select MAX(ID) as ID from sy";
    $result_e = mysqli_query($con,$sql_e);
    if(mysqli_num_rows($result_e)>0)
    {
        while($row_e= mysqli_fetch_array($result_e))
        {
            $schoolYearID=$row_e['ID'];
        }
    }
}



$sql = "Select *from admin where ID=$adminID";
$result = mysqli_query($con,$sql);
if(mysqli_num_rows($result)>0)
{
    while($row = mysqli_fetch_array($result))
    {
        $username=$row['username'];
    }
}
$sql = "Select *from sy where ID=$schoolYearID";
$result = mysqli_query($con,$sql);
if(mysqli_num_rows($result)>0)
{
    while($row = mysqli_fetch_array($result))
    {
        $SYname=$row['schoolYear'];
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
        <a class="navbar-brand" href="#">
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
                        <div><a href="../account/account_info.php"><strong><?php echo $username; ?></strong></a></div>
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
                <ul class="nav nav-second-level">
                    <li>
                        <a href="../sy/sy_frame.php">&nbsp;&nbsp;<i class="fa fa-calendar fa-fw"></i>School Years</a>
                    </li>
                    <li>
                        <a href="../year_level/year_level_frame.php">&nbsp;&nbsp;<i class="fa fa-industry fa-fw"></i>Year Level</a>
                    </li>
                    <li>
                        <a href="../section/section_frame.php">&nbsp;&nbsp;<i class="fa fa-list-ul fa-fw"></i>Sections</a>
                    </li>
                    <li>
                        <a href="../subject/subject_frame.php">&nbsp;&nbsp;<i class="fa fa-book fa-fw"></i>Subjects</a>
                    </li>
                    <li  >
                        <a href="../teacher/teacher_frame.php">&nbsp;&nbsp;<i class="fa fa-users fa-fw"></i>Teachers</a>
                    </li>
                    <li>
                        <a href="../student/student_frame.php">&nbsp;&nbsp;<i class="fa fa-users fa-fw"></i>Students</a>
                    </li>
                    <li>
                        <a href="../encoder/encoder_frame.php">&nbsp;&nbsp;<i class="fa fa-keyboard-o fa-fw"></i>Encoder</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-sitemap fa-fw"></i>School Year<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="../manage/managesy.php?schoolYearID=">&nbsp;&nbsp;<i class="fa fa-calendar fa-fw"></i>Enrollment Setup</a>
                    </li>
                    <li class="selected">
                        <a href="../summersetup/managesy.php?schoolYearID=">&nbsp;&nbsp;<i class="fa fa-calendar fa-fw"></i>Summer Setup</a>
                    </li>
                </ul>
            </li>
            <li>
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
        <h1 class="page-header text-primary">Summer Setup Management</h1>
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
        <div id="loadLevelData"></div>
    </div>
    <!--End Advanced Tables -->
</div>
<div class="modal fade" id="requestModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:80%">

        <div id=requestform>
        </div>



    </div>
</div>
</div>
</div>
<!-- end page-wrapper -->

</div>
<!-- end wrapper -->

<script src="../../assets/plugins/jquery-1.10.2.js"></script>
<script src="../../assets/plugins/bootstrap/bootstrap.min.js"></script>
<script src="../../assets/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="../../assets/plugins/pace/pace.js"></script>
<script src="../../assets/scripts/siminta.js"></script>
<!-- Page-Level Plugin Scripts-->
<script src="../../assets/plugins/dataTables/jquery.dataTables.js"></script>
<script src="../../assets/plugins/dataTables/dataTables.bootstrap.js"></script>
<link rel="stylesheet" href="../../assets/plugins/jquery-ui-1.12.1/jquery-ui.css">
<script src="../../assets/plugins/jquery-ui-1.12.1/jquery-ui.js"></script>
<script src="../../assets/plugins/chosen.jquery.js"></script>
<link rel="stylesheet" href="../../assets/plugins/chosen.css">
<script type="text/javascript">

    ( function ( $ ) {
        $("#cboSY").on('click', function() {
            //alert( this.value );
            var x = this.value;
            $.ajax({
                type: "GET",
                url: "level/loadYearLevel.php?SYid="+x,
                cache: false,
                success: function(html){
                    $("#loadLevelData").empty(html);
                    $("#loadLevelData").append(html);
                }
            });
        });
    } )( jQuery );
    $('#cboSY option[value="<?php echo $schoolYearID; ?>"]').attr('selected', 'selected');
    //$("#cboSY").chosen();
    $.ajax({
        type: "GET",
        url: "level/loadYearLevel.php?SYid="+<?php echo $schoolYearID; ?>,
        cache: false,
        success: function(html){
            $("#loadLevelData").empty(html);
            $("#loadLevelData").append(html);
        }
    });
</script>

</body>

</html>
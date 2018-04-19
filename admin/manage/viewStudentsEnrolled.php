<?php
/**
 * Created by PhpStorm.
 * User: Ms. Cath
 * Date: 4/18/18
 * Time: 9:42 PM
 */


include "../../dbcon.php";
include "../sessionAdmin.php";
$chosenSY = '';
$username='';
$section=$_GET['sectionId'];
$sql = "Select *from admin where ID=$adminID";
$result = mysqli_query($con,$sql);
if(mysqli_num_rows($result)>0)
{
    while($row = mysqli_fetch_array($result))
    {
        $username=$row['username'];
    }
}

echo $sql_ = "SELECT A.ID, A.sy_level_ID, A.section_ID, A.teacher_ID, A.capacity, CONCAT(C.Fname, ' ', C.Lname) as teacher, B.section, F.level, E.schoolYear, D.ID as syID_
FROM sy_level_section A
INNER JOIN section B ON A.section_ID = B.ID
INNER JOIN teacher C ON A.teacher_ID = C.ID
INNER JOIN sy_level D ON A.sy_level_ID = D.ID
INNER JOIN sy E ON D.sy_ID = E.ID
INNER JOIN level F ON D.level_ID = F.ID
WHERE A.ID = $section";
$result_ = mysqli_query($con,$sql_);
if(mysqli_num_rows($result_)>0)
{
    while($row_ = mysqli_fetch_array($result_))
    {
        $sectionname=$row_['section'];
        $teachername=$row_['teacher'];
        $capacity=$row_['capacity'];
        $leveldesc =  $row_['level'];
        $sydesc =  $row_['schoolYear'];
        $sydID =  $row_['syID_'];

    }
}

$sql_capacityInfo = "SELECT COUNT(A.ID) AS curCount
                            FROM enrolled_student A
                            INNER JOIN student B ON A.student_ID = B.ID
                            WHERE A.sy_level_section_ID = $section";
$result_cap = mysqli_query($con,$sql_capacityInfo);
if(mysqli_num_rows($result_cap)>0)
{
    while($row_cap = mysqli_fetch_array($result_cap))
    {
        $curCount=$row_cap['curCount'];

    }
}
else{
    $curCount = -1;
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
                        <li class="selected">
                            <a href="../encoder/encoder_frame.php">&nbsp;&nbsp;<i class="fa fa-keyboard-o fa-fw"></i>Encoder</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li>
                <a href="#"><i class="fa fa-sitemap fa-fw"></i>School Year<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <?php
                    $sql = "Select *from SY ORDER BY schoolYear DESC";
                    $result = mysqli_query($con,$sql);
                    if(mysqli_num_rows($result)>0)
                    {

                        while($row = mysqli_fetch_array($result))
                        {
                            ?>
                            <li><a href="../manage/manage.php?schoolYearID=<?php echo $row['ID']?>">&nbsp;&nbsp;<?php echo $row['schoolYear']; ?></a></li>
                        <?php
                        }
                    }
                    ?>
                </ul>
                <!-- second-level-items -->
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
            <h3 class="page-header"><?php echo strtoupper($leveldesc). "-". strtoupper($sectionname)."(" .$sydesc.")"; ?> : </h3>
        </div>
        <div class="col-lg-2">
            <div style="float:right; margin-top:40px" >
                <button class="btn btn-primary btn-md" data-toggle="modal" data-target="#addModal" id="btnEnroll">
                    Enroll Student
                </button>
            </div>
            <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Enroll Students</h4>
                        </div>
                        <form role="form" action="enrollStudents.php" method=post>
                            <div class="modal-body">
                                <?php
                                if($curCount > -1)
                                {?>
                                    <label>Section Capacity:<b> <?php echo $capacity;?></b></label>
                                    <label>,Current Student Count:<b> <?php echo $curCount;?></b></label>
                                    <input type="hidden" name="avail_count" id="avail_count" value="<?php echo ($capacity - $curCount);?>"/>
                                    <label>,Slot Available: <b><?php echo ($capacity - $curCount);?></b></label>
                                 <?php }else{?>
                                    <label class="text-danger"><b>Please set up capacity for this section</b></label>
                                <?php
                                }
                                ?>
                                <input type="hidden" name="choice" id="choice" class="form-control input-sm">
                                <input type="hidden" name="sec_capacity" class="form-control input-sm" disabled value="<?php echo $capacity;?>">
                                <input type="hidden" name="sylevelsectionId" value="<?php echo $section;?>">
                               <div id="loadEnrolledStudents"></div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" id="saveEnrollStudent">Add Students</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
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
                                <th>Student Name</th>
                                <th>Transfer Section</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sql_stu = "SELECT A.ID as enrolleId, A.student_ID, CONCAT(B.Lname, ',', B.Fname, ' ', B.Mname) as student, A.status
                            FROM enrolled_student A
                            INNER JOIN student B ON A.student_ID = B.ID
                            WHERE A.sy_level_section_ID = $section
                            ORDER BY B.Lname ASC";
                            $result_stu = mysqli_query($con,$sql_stu);
                            if(mysqli_num_rows($result_stu)>0)
                            {
                                while($row_stu = mysqli_fetch_array($result_stu))
                                {
                                    if($row_stu['status']){
                                        echo '<tr class="bg-danger text-danger">';
                                        $active = "DROP";
                                    }
                                    else{
                                        echo '<tr>';
                                        $active = "";
                                    }
                                    ?>
                                        <td><?php echo strtoupper($row_stu['student']); ?></td>
                                        <td><span id="icon" class="fa fa-arrow-right fa-fw" data-toggle="modal" data-target="#transferStudent" onClick="transferData(<?php echo $row_stu["enrolleId"];?>, <?php echo '$row_stu["student"]';?> )"> </span> <?php echo $active;?></td>
                                    </tr>
                                <?php
                                }
                            }
                            ?>
                            </tbody>
                        </table>

                        <div class="modal fade" id="transferStudent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">Transfer Section</h4>
                                         <label>Student Name:</label>
                                         <input type="text" name="stud_name" id="stud_name" class="form-control" disabled/>
                                         <input type="hidden" name="stud_enrollID" id="stud_enrollID" class="form-control"/>
                                         <label>Section:</label>
                                        <select class="form-control" name="cboSection">
                                        <?php
                                        $sql_sec2 = "
                                        SELECT A.*, B.*
                                        FROM sy_level_section A
                                        INNER JOIN sy_level B ON A.sy_level_ID = B.ID
                                        WHERE A.ID <> $section AND B.level_ID = $sydID

                                        ";
                                        $result_sec2 = mysqli_query($con,$sql_sec2);
                                        if(mysqli_num_rows($result_sec2)> 0)
                                        {
                                            while($row_sec = mysqli_fetch_array($result_sec2))
                                            {
                                                echo '
                                            <option value=0>wala pang data</option>
                                            ';
                                            }
                                        }
                                        ?>
                                        </select>
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

<link rel="stylesheet" href="../../assets/plugins/jquery-ui-1.12.1/jquery-ui.css">
<script src="../../assets/plugins/jquery-ui-1.12.1/jquery-ui.js"></script>
<script src="../../assets/plugins/chosen.jquery.js"></script>
<link rel="stylesheet" href="../../assets/plugins/chosen.css">
<script>
    $(document).ready(function () {
        $('#dataTables-example').dataTable();
    });
</script>
<script type="text/javascript">
    $("#btnEnroll").on('click', function() {
        $.ajax({
            type: "GET",
            url: "loadToEnrollStudents.php?sectionId="+<?php echo $section;?>,
            cache: false,
            success: function(html){
                $("#loadEnrolledStudents").empty(html);
                $("#loadEnrolledStudents").append(html);
            }
        });
    });


    function transferData(enrollId, name){
        document.getElementById("stud_enrollID").value = enrollId;
        document.getElementById("stud_name").value = name;
    }

</script>

</body>

</html>

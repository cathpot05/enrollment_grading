<?php
/**
 * Created by PhpStorm.
 * User: Ms. Cath
 * Date: 4/18/18
 * Time: 9:42 PM
 */


include "../../../dbcon.php";
include "../../sessionAdmin.php";
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

 $sql_ = "SELECT A.ID, A.sy_level_ID, A.subject_ID, A.teacher_ID, CONCAT(C.Fname, ' ', C.Lname) as teacher, F.level, B.subject, E.schoolYear
FROM summer_subject A
INNER JOIN subject B ON A.subject_ID = B.ID
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
        $sectionname=$row_['subject'];
        $teachername=$row_['teacher'];
        $leveldesc =  $row_['level'];
        $sydesc =  $row_['schoolYear'];

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
    <link href="../../../assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="../../../assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../../assets/font-awesome/css/font-awesome.min.css">
    <link href="../../../assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
    <link href="../../../assets/css/style.css" rel="stylesheet" />
    <link href="../../../assets/css/main-style.css" rel="stylesheet" />
    <!-- Page-Level CSS -->
    <link href="../../../assets/plugins/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <link href="../../../assets/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
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
            <img style="height:60px; width:60px; " src="../../../pdfmnhs.png" alt="" /><strong style="color:white; font-size:1.2em">&nbsp;&nbsp;PRUDENCIA D. FULE MEMORIAL NATIONAL HIGH SCHOOL</strong>
        </a>
    </div>
    <!-- end navbar-header -->
    <!-- navbar-top-links -->
    <ul class="nav navbar-top-links navbar-right">
        <!-- main dropdown -->


        <li class="dropdown">
            <a href="../../logoutSessionAdmin.php">
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
                        <div><a href="../../account/account_info.php"><strong><?php echo $username; ?></strong></a></div>
                        <div class="user-text-online" align="left">
                            <span></span>&nbsp;Admin
                        </div>
                    </div>
                </div>
                <!--end user image section-->
            </li>
            <li>
                <a href="../../dashboard/dashboard.php"><i class="fa fa-dashboard fa-fw"></i>Dashboard</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-sitemap fa-fw"></i>Management Setup<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="../sy/sy_frame.php">&nbsp;&nbsp;<i class="fa fa-calendar fa-fw"></i>School Years</a>
                    </li>
                    <li>
                        <a href="../../year_level/year_level_frame.php">&nbsp;&nbsp;<i class="fa fa-industry fa-fw"></i>Year Level</a>
                    </li>
                    <li>
                        <a href="../../section/section_frame.php">&nbsp;&nbsp;<i class="fa fa-list-ul fa-fw"></i>Sections</a>
                    </li>
                    <li>
                        <a href="../../subject/subject_frame.php">&nbsp;&nbsp;<i class="fa fa-book fa-fw"></i>Subjects</a>
                    </li>
                    <li  >
                        <a href="../../teacher/teacher_frame.php">&nbsp;&nbsp;<i class="fa fa-users fa-fw"></i>Teachers</a>
                    </li>
                    <li>
                        <a href="../../../student/student_frame.php">&nbsp;&nbsp;<i class="fa fa-users fa-fw"></i>Students</a>
                    </li>
                    <li>
                        <a href="../../encoder/encoder_frame.php">&nbsp;&nbsp;<i class="fa fa-keyboard-o fa-fw"></i>Encoder</a>
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
                        <a href="../../manage/managesy.php?schoolYearID=">&nbsp;&nbsp;<i class="fa fa-calendar fa-fw"></i>Enrollment Setup</a>
                    </li>
                    <li class="selected">
                        <a href="../../summersetup/managesy.php?schoolYearID=">&nbsp;&nbsp;<i class="fa fa-calendar fa-fw"></i>Summer Setup</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="../../teacher_subject/teacherSubj_frame.php"><i class="fa fa-user-circle fa-fw"></i>Teacher Subject</a>
            </li>
            <li>
                <a href="../../reports/report_frame.php"><i class="fa fa-user-circle fa-fw"></i>Reports</a>
            </li>
            <li>
                <a href="../../log/log_frame.php" ><i class ="fa fa-industry fa-fw"></i>Log Activities</a>
            </li>
            <li>
                <a target="_blank" href="../../DatabaseBackup/phpExport.php" ><i class="fa fa-database fa-fw"></i>Backup Database</a>
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
            <h3 class="page-header text-primary"><?php echo strtoupper($leveldesc). "-". strtoupper($sectionname)."(" .$sydesc.")"; ?> : <?php echo "Teacher:". strtoupper($teachername); ?></h3>

        </div>
        <div class="col-lg-2">
            <div style="float:right; margin-top:40px" >
                <button class="btn btn-primary btn-md" data-toggle="modal" data-target="#addModal" id="btnEnroll">
                    Add Student
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
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sql_stu = "SELECT A.ID as enrolleId, A.student_ID, CONCAT(B.Lname, ',', B.Fname, ' ', B.Mname) as student, A.status
                                FROM summer_enrolled A
                                INNER JOIN student B ON A.student_ID = B.ID
                                WHERE A.summer_subject_ID = $section
                                ORDER BY B.Lname ASC";

                            $sqlPrint = urlencode("SELECT CONCAT(B.Lname, ',', B.Fname, ' ', B.Mname) as Student
                                FROM summer_enrolled A
                                INNER JOIN student B ON A.student_ID = B.ID
                                WHERE A.summer_subject_ID = $section
                                ORDER BY B.Lname ASC
    ");

                            $header = urlencode("Summer Class Students List for ".strtoupper($leveldesc). '-'. strtoupper($sectionname).'(' .$sydesc.')');


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
                                        <td>
                                            <span id="icon" class="fa fa-trash fa-fw" onClick="confirmDelete(<?php echo $row_stu['enrolleId'];?>,<?php echo $section;?>)"> </span>
                                            <?php echo $active;?>
                                        </td>
                                    </tr>
                                <?php
                                }
                            }
                            ?>
                            </tbody>
                        </table>


                    </div>
                    <div style="float:right" id="icon"  onclick="printData('<?php echo $sqlPrint; ?>','<?php echo $header; ?>');">
                        <span class="fa fa-print fa-fw" ></span> Print
                    </div>
                    <div class="modal fade" id="requestModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog" style="width:80%">
                            <div id="printTable">
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
<script src="../../../assets/plugins/jquery-1.10.2.js"></script>
<script src="../../../assets/plugins/bootstrap/bootstrap.min.js"></script>
<script src="../../../assets/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="../../../assets/plugins/pace/pace.js"></script>
<script src="../../../assets/scripts/siminta.js"></script>
<script src="../../../assets/plugins/dataTables/jquery.dataTables.js"></script>
<script src="../../../assets/plugins/dataTables/dataTables.bootstrap.js"></script>
<link rel="stylesheet" href="../../../assets/plugins/jquery-ui-1.12.1/jquery-ui.css">
<script src="../../../../assets/plugins/jquery-ui-1.12.1/jquery-ui.js"></script>
<script src="../../../assets/plugins/chosen.jquery.js"></script>
<link rel="stylesheet" href="../../../assets/plugins/chosen.css">
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

    function confirmDelete(id, syId) {
        if (confirm("Are you sure you want to delete?")) {
            $.ajax({
                type: "GET",
                url: "deleteStudentFromSummer.php?id="+id+'&sy='+syId,
                cache: false,
                success: function(html){
                    window.location.href= 'viewStudentsEnrolled.php?sectionId='+syId;
                }
            });
        }
    }

    function printData(sql,header)
    {

        var xhr;
        if (window.XMLHttpRequest) xhr = new XMLHttpRequest(); // all browsers
        else xhr = new ActiveXObject("Microsoft.XMLHTTP"); 	// for IE
        var url = '../../printTable.php?sql='+sql+'&header='+header;

        xhr.open('GET', url, false);
        xhr.onreadystatechange = function () {
            document.getElementById("printTable").innerHTML = xhr.responseText;
            var divToPrint=document.getElementById("printTable");
            newWin= window.open("");
            newWin.document.write(divToPrint.outerHTML);
            newWin.print();
            newWin.close();
        }
        xhr.send();
        // ajax stop
        return false;
    }


</script>

</body>

</html>

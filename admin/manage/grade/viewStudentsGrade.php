<?php
/**
 * Created by PhpStorm.
 * User: PB7N0062
 * Date: 4/18/18
 * Time: 1:29 PM
 */


include "../../../dbcon.php";
include "../../sessionAdmin.php";
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


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDFMNHS</title>
    <link rel="shortcut icon" href="../../../pdfmnhs.png" type="image/png">
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
        <a class="navbar-brand" href="#">
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
                        <a href="../../sy/sy_frame.php">&nbsp;&nbsp;<i class="fa fa-calendar fa-fw"></i>School Years</a>
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
                        <a href="../../student/student_frame.php">&nbsp;&nbsp;<i class="fa fa-users fa-fw"></i>Students</a>
                    </li>
                    <li>
                        <a href="../../encoder/encoder_frame.php">&nbsp;&nbsp;<i class="fa fa-keyboard-o fa-fw"></i>Encoder</a>
                    </li>
                    <li>
                        <a href="../../admin/admin_frame.php">&nbsp;&nbsp;<i class="fa fa-user-plus fa-fw"></i>Admin</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-sitemap fa-fw"></i>School Year<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="selected">
                        <a href="../../manage/managesy.php?schoolYearID=">&nbsp;&nbsp;<i class="fa fa-calendar fa-fw"></i>Enrollment Setup</a>
                    </li>
                    <li>
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
        <div class="col-lg-8">
            <h1 class="page-header text-primary">Student Grade Information </h1>
                <h4 class="text-info"  name="teacher_assign" id="teacher_assign"></h4>

        </div>
        <div class="col-lg-4">
            <div class="form-inline" style="float:right; margin-top:40px" >
                <label>Subjects:</label>
                <select class="form-control" name="cbosyLevlSubj" id="cbosyLevlSubj">
                    <?php
                    $sql = "SELECT C.ID, C.code, C.subject
                            FROM sy_level_section A
                            INNER JOIN sy_level_subject B ON A.sy_level_ID = B.sy_level_ID
                            INNER JOIN subject C ON B.subject_ID = C.ID
                            WHERE A.ID = $section";
                    $result = mysqli_query($con,$sql);
                    if(mysqli_num_rows($result)> 0)
                    {
                        while($row = mysqli_fetch_array($result))
                        {
                            echo '
                       <option value='.$row["ID"].'>'.$row["subject"].'</option>
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
            <div id="loadStudentGradeContainer"></div>
        </div>
        <!--End Advanced Tables -->
    </div>
</div>
</div>
<!-- end page-wrapper -->

</div>
<!-- end wrapper -->

<script src="../../../assets/plugins/jquery-1.10.2.js"></script>
<script src="../../../assets/plugins/bootstrap/bootstrap.min.js"></script>
<script src="../../../assets/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="../../../assets/plugins/pace/pace.js"></script>
<script src="../../../assets/scripts/siminta.js"></script>
<script src="../../../assets/plugins/dataTables/jquery.dataTables.js"></script>
<script src="../../../assets/plugins/dataTables/dataTables.bootstrap.js"></script>
<link rel="stylesheet" href="../../../assets/plugins/jquery-ui-1.12.1/jquery-ui.css">
<script src="../../../assets/plugins/jquery-ui-1.12.1/jquery-ui.js"></script>
<script type="text/javascript">

    //$("#cbosyLevlSubj").val($("#cbosyLevlSubj option:first").val());
    var y =$("#cbosyLevlSubj").val();
    $.ajax({
        type: "GET",
        url: "loadStudentGradePerSYLevelSec.php?subjectId="+y+"&syLevelSec="+<?php echo $section;?>,
        cache: false,
        success: function(html){
            $("#loadStudentGradeContainer").empty(html);
            $("#loadStudentGradeContainer").append(html);
        }
    });

    $("#cbosyLevlSubj").on('click', function() {
        var x = this.value;
        $.ajax({
            type: "GET",
            url: "loadStudentGradePerSYLevelSec.php?subjectId="+x+"&syLevelSec="+<?php echo $section;?>,
            cache: false,
            success: function(html){
                $("#loadStudentGradeContainer").empty(html);
                $("#loadStudentGradeContainer").append(html);
            }
        });
    })


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
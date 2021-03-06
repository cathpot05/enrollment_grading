<?php
/**
 * Created by PhpStorm.
 * User: Ms. Cath
 * Date: 4/18/18
 * Time: 11:49 PM
 */



include "../../../dbcon.php";
include "../../sessionAdmin.php";
$chosenSY = '';
$username='';
$section=$_GET['sectionId'];

?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<div class="col-lg-12">






    <?php
    $sql_ = "SELECT A.ID, A.sy_level_ID, A.section_ID, A.teacher_ID, A.capacity, CONCAT(C.Fname, ' ', C.Lname) as teacher, B.section, F.level, E.schoolYear, D.ID as syID_, E.ID as IdSY
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
            $IdSY =  $row_['IdSY'];

        }
    }
    ?>


    <?php
    $sqlsy = "SELECT
    (SELECT Z.schoolYear
    FROM sy Z
    WHERE LEFT(Z.schoolYear, 4) < LEFT(A.schoolYear,4)
    ORDER BY LEFT(Z.schoolYear, 4) DESC LIMIT 1) AS prevyear , A.ID
FROM sy A
WHERE A.ID = $IdSY";
    $result_sy = mysqli_query($con,$sqlsy);
    if(mysqli_num_rows($result_sy)>0)
    {
        while($row_sy = mysqli_fetch_array($result_sy))
        {
            //$prevSyID=$row_sy['ID'];
            $prevSydesc=$row_sy['prevyear'];
        }
    }


     $sqlsy1 = "SELECT A.ID
                FROM sy A
                WHERE A.schoolYear = '$prevSydesc'";
    $result_sy1 = mysqli_query($con,$sqlsy1);
    if(mysqli_num_rows($result_sy1)>0)
    {
        while($row_sy1 = mysqli_fetch_array($result_sy1))
        {
            $prevSyID=$row_sy1['ID'];
        }
    }


    ?>



    <!-- Advanced Tables -->

    <div class="pull-right">
        <button class="btn btn-primary btn-sm" id="btnPrevSY" style="padding: 3px;">From Prev School Year</button>
        <button class="btn btn-primary btn-sm" id="btnAllStud" style="padding: 3px;">From Student List</button>
    </div>


    <div class="panel panel-default">
        <div class="panel-heading">
            List of Students From Prev School Year : <?php echo $prevSydesc; ?>
        </div>
        <div class="panel-body div_enrolledStudent">
            <div class="table-responsive">
                <table class="table table-hover" id="dataTables-example_1">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Student Name</th>
                        <th>Average</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if($prevSydesc == ""){
                        echo '
                        <tr class="text-danger"><td colspan="3">NO PREVIOUS SCHOOL YEAR. NO STUDENTS TO LOAD.</td></tr>

                        ';
                    }else{
                        $x = 0;
                        $sql = "SELECT A.ID as enrolledId, CONCAT(C.Lname, ', ', C.Fname, ' ', C.Mname) as student, A.student_ID,
                                    (
                                    SELECT AVG(((X.q1 + X.q2 + X.q3 + X.q4)/4))
                                    FROM grade X
                                    WHERE X.enrolled_student_ID = B.enrolled_student_ID
                                    ) AS Grade_Average
									FROM enrolled_student A
									INNER JOIN grade B ON A.ID = B.enrolled_student_ID
									INNER JOIN student C ON A.student_ID = C.ID
									INNER JOIN sy_level_section D ON A.sy_level_section_ID = D.ID
									INNER JOIN sy_level E ON D.sy_level_ID =  E.ID
									INNER JOIN sy F ON E.sy_ID = F.ID
									WHERE F.ID = $prevSyID
									AND A.student_ID NOT IN (
                                         SELECT XX.student_ID FROM enrolled_student XX
                                         INNER JOIN sy_level_section ZZ ON XX.sy_level_section_ID = ZZ.ID
                                         INNER JOIN sy_level YY ON ZZ.sy_level_ID = YY.ID
                                        WHERE  YY.sy_ID = $IdSY
                                     ) AND A.status = 0
                                     AND (B.q1+B.q2+B.q3+B.q4)/4 >=75
                            GROUP BY A.ID
                            ORDER BY Grade_Average DESC";
                        $result = mysqli_query($con,$sql);
                        if(mysqli_num_rows($result)>0)
                        {

                            while($row = mysqli_fetch_array($result))
                            {

                                ?>
                                <tr>
                                    <td><input type="checkbox" class="chk_studID_<?php echo $x;?>"  name="checklist_section[]" value="<?php echo $row['student_ID'];?>"/></td>
                                    <td><?php echo strtoupper($row['student']); ?></td>
                                    <td><?php echo $row['Grade_Average']?></td>
                                </tr>
                            <?php
                                $x++;
                            }
                        }

                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!--End Advanced Tables -->
    </div>
</div>




<script>
    $(document).ready(function () {
        //$('#dataTables-example_1').dataTable();
    });
</script>
<script type="text/javascript">

    /*$("#checkall").click(function(){
        $('input:checkbox').not(this).prop('checked', this.checked);
    });*/


    check();
    function check() {
        for (var i=0;i<$("#avail_count").val();i++) {
            $('.chk_studID_'+i).prop('checked', true);
        }
    }



    $('input[name="checklist_section[]"').on('click', function() {
        var total=$('input[name="checklist_section[]"]:checked').length;
        if(total > $("#avail_count").val()){
            alert("Exceed to maximum number of slot available.");
            $(this).prop('checked', false);
        }

    });

    //$('input:checkbox').attr('checked','checked');

    $("#btnPrevSY").on('click', function() {
        document.getElementById("choice").value = "prevSY";
        event.preventDefault();
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
    $("#btnAllStud").on('click', function() {
        document.getElementById("choice").value = "allStud";
        event.preventDefault();
        $.ajax({
            type: "GET",
            url: "loadFromStudentList.php?sectionId="+<?php echo $section;?>,
            cache: false,
            success: function(html){
                $("#loadEnrolledStudents").empty(html);
                $("#loadEnrolledStudents").append(html);
            }
        });
    });
   /* $("#btnEnroll").on('click', function() {
        $.ajax({
            type: "GET",
            url: "loadToEnrollStudents.php?sectionId="+<?php echo $section;?>,
            cache: false,
            success: function(html){
                $("#loadEnrolledStudents").empty(html);
                $("#loadEnrolledStudents").append(html);
            }
        });
    });*/

</script>

</body>

</html>

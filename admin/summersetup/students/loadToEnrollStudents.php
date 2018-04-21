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

    $sql_ = "SELECT A.ID, A.sy_level_ID, A.subject_ID, A.teacher_ID, CONCAT(C.Fname, ' ', C.Lname) as teacher, F.level, B.subject, E.schoolYear, E.ID as SYid
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
            $syId =  $row_['SYid'];

        }
    }
    ?>


    <!-- Advanced Tables -->
    <div class="panel panel-default">
        <div class="panel-heading">
            List of Students
        </div>
        <div class="panel-body div_enrolledStudent">
            <div class="table-responsive">
                <table class="table table-hover" id="dataTables-example_1">
                    <thead>
                    <tr>
                        <th><input type="checkbox" name="checkall" id="checkall" value=""/> Check All</th>
                        <th>Student Name</th>
                        <th>Average</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
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
                            WHERE F.ID = $syId
                             AND A.student_ID NOT IN (
                                         SELECT XX.student_ID FROM summer_enrolled XX
                                 		INNER  JOIN summer_subject BB ON XX.summer_subject_ID = BB.ID
                                         INNER JOIN sy_level YY ON BB.sy_level_ID = YY.ID
                                        WHERE  YY.sy_ID = $syId
                                     ) AND A.status = 0
                                     AND (B.q1+B.q2+B.q3+B.q4)/4 <75
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
                        }else{
                            echo '
                        <tr class="text-danger"><td colspan="3">.NO STUDENTS TO LOAD. NO FAILED STUDENTS.</td></tr>

                        ';

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

    $("#checkall").click(function(){
        $('input:checkbox').not(this).prop('checked', this.checked);
    });


</script>

</body>

</html>

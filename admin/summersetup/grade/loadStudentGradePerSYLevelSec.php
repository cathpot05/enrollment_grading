<?php
/**
 * Created by PhpStorm.
 * User: PB7N0062
 * Date: 4/18/18
 * Time: 1:50 PM
 */


include "../../../dbcon.php";
include "../../sessionAdmin.php";
$syLevelSec=$_GET['syLevelSec'];
$teach = "";
$subject="";
$sql1 = "SELECT A.ID, B.subject, CONCAT(C.Fname, ', ', C.Lname) as teacher
                FROM summer_subject A
                INNER JOIN subject B ON A.subject_ID = B.ID
                INNER JOIN teacher C ON A.teacher_ID = C.ID
                INNER JOIN sy_level D ON A.sy_level_ID = D.ID
                where A.ID=$syLevelSec";
$result1 = mysqli_query($con,$sql1);
if(mysqli_num_rows($result1)>0)
{
while($row1 = mysqli_fetch_array($result1))
{
    $teach = $row1['teacher'];
    $subject = $row1['subject'];
}
}
?>
<!DOCTYPE html>
<html>
<div class="panel panel-default">
    <div class="panel-body">
    <div class="table-responsive">
        <div>
            <table class="table table-hover table-inverse" id="dataTables-example" style= "margin-top: 20px;" id="dataTables-example">
                <thead class="text-info">
                <tr>
                    <th>STUDENT</th>
                    <th>GRADE</th>
                </tr>
                </thead>
                <tbody>


                <?php
                  $sql_section = "SELECT A.ID, CONCAT(F.Lname, ' ', F.Fname) as student, G.subject, CONCAT(H.Fname, ' ', H.Lname) as teacher, B.grade, G.subject
                    FROM  summer_enrolled E
                    LEFT JOIN summer_subject A ON A.ID = E.summer_subject_ID
                    LEFT JOIN summer_grade B ON E.ID = B.summer_enrolled_ID
                    LEFT JOIN student F ON E.student_ID = F.ID
                    LEFT JOIN subject G ON A.subject_ID = G.ID
                    LEFT JOIN teacher H ON A.teacher_ID = H.ID
                    LEFT JOIN sy_level J ON J.ID = A.sy_level_ID
                    LEFT JOIN level K ON J.level_ID = K.ID
                    WHERE A.ID = $syLevelSec
                    ORDER BY F.Lname ASC";
                $result_section = mysqli_query($con,$sql_section);

                if(mysqli_num_rows($result_section)>0)
                {
                    while($row_section = mysqli_fetch_array($result_section))
                    {
                        $teach = $row_section["teacher"];

                        if($row_section["grade"] == null){
                            $q1 =  "NO GRADE YET";
                        }else{
                            $q1 = $row_section["grade"]  ;
                        }


                        echo '
                         <tr>
                            <td>'.strtoupper($row_section["student"]).' </td>
                            <td><i>'.$q1.'</i> </td>
                         </tr>
                        ';
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    </div>
</div>

<?php
$sqlPrint = urlencode("SELECT CONCAT(F.Lname, ' ', F.Fname) as Student, G.subject as Subject
              , CONCAT(H.Fname, ' ', H.Lname) as Teacher, B.grade as Grade
                    FROM  summer_enrolled E
                    LEFT JOIN summer_subject A ON A.ID = E.summer_subject_ID
                    LEFT JOIN summer_grade B ON E.ID = B.summer_enrolled_ID
                    LEFT JOIN student F ON E.student_ID = F.ID
                    LEFT JOIN subject G ON A.subject_ID = G.ID
                    LEFT JOIN teacher H ON A.teacher_ID = H.ID
                    LEFT JOIN sy_level J ON J.ID = A.sy_level_ID
                    LEFT JOIN level K ON J.level_ID = K.ID
                    WHERE A.ID = $syLevelSec
                    ORDER BY F.Lname ASC
    ");

$header = urlencode("Student Summer Grade");
?>
<div style="float:right" id="icon"  onclick="printData('<?php echo $sqlPrint; ?>','<?php echo $header; ?>');">
    <span class="fa fa-print fa-fw" ></span> Print
</div>
<div class="modal fade" id="requestModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:80%">
        <div id="printTable">
        </div>
    </div>
</div>

<script type="text/javascript">
    //$teach
    <?php
    if($teach==""){
    ?>
        $('#teacher_assign').empty();
        $('#teacher_assign').append("Teacher Assign: N/A");
        $('#subject_desc').empty();
    <?php
    }else{
    ?>
        $('#teacher_assign').empty();
        $('#teacher_assign').append("Teacher Assign: "+<?php echo '\''.strtoupper($teach). '\'';?> );
        $('#subject_desc').append("Subject: "+<?php echo '\''.strtoupper($subject). '\'';?>);
    //subject_desc
    <?php
    }
    ?>
</script>


</html>
<?php
/**
 * Created by PhpStorm.
 * User: PB7N0062
 * Date: 4/18/18
 * Time: 1:50 PM
 */


include "../../../dbcon.php";
include "../../sessionAdmin.php";
$subjId=$_GET['subjectId'];
$syLevelSec=$_GET['syLevelSec'];
$teach = "";
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
                    <th>QUARTER 1</th>
                    <th>QUARTER 2</th>
                    <th>QUARTER 3</th>
                    <th>QUARTER 4</th>
                    <th>FINAL</th>
                </tr>
                </thead>
                <tbody>


                <?php
                  $sql_section = "SELECT A.ID, A.section_ID,K.level, I.section, G.ID,CONCAT(F.Lname, ' ', F.Fname) as student, G.subject, CONCAT(H.Fname, ' ', H.Lname) as teacher, D.q1, D.q2, D.q3, D.q4, (( D.q1 + D.q2 + D.q3 + D.q4)/4) as final
                    FROM  enrolled_student E
                    LEFT JOIN sy_level_section A ON A.ID = E.sy_level_section_ID
                    LEFT JOIN sy_level_subject B ON A.sy_level_ID = B.sy_level_ID
                    LEFT JOIN teacher_section_subject C ON C.sy_level_subject_ID = B.ID AND A.ID = C.sy_level_section_ID
                    LEFT JOIN student F ON E.student_ID = F.ID
                    LEFT JOIN grade D ON C.ID = D.teacher_section_subject_ID AND E.ID = D.enrolled_student_ID
                    LEFT JOIN subject G ON B.subject_ID = G.ID
                    LEFT JOIN teacher H ON C.teacher_ID = H.ID
                    LEFT JOIN section I ON A.section_ID = I.ID
                    LEFT JOIN sy_level J ON J.ID = B.sy_level_ID AND A.sy_level_ID = J.level_ID
                    LEFT JOIN level K ON J.level_ID = K.ID
                    WHERE A.ID = $syLevelSec AND G.ID = $subjId AND F.ID IS NOT NULL
                    ORDER BY F.Lname ASC";
                $result_section = mysqli_query($con,$sql_section);

                if(mysqli_num_rows($result_section)>0)
                {
                    while($row_section = mysqli_fetch_array($result_section))
                    {
                        $teach = $row_section["teacher"];

                        if($row_section["q1"] == null){
                            $q1 =  "NO GRADE YET";
                        }
                        else{
                            $q1 =  $row_section["q1"];
                        }

                        if($row_section["q2"] == null){
                            $q2 =  "NO GRADE YET";
                        }
                        else{
                            $q2 =  $row_section["q2"];
                        }

                        if($row_section["q3"] == null){
                            $q3 =  "NO GRADE YET";
                        }
                        else{
                            $q3 =  $row_section["q3"];
                        }

                        if($row_section["q4"] == null){
                            $q4 =  "NO GRADE YET";
                        }
                        else{
                            $q4 =  $row_section["q4"];
                        }

                        if($row_section["final"] == null){
                            $final =  "NO GRADE YET";
                        }
                        else{
                            $final =  $row_section["final"];
                        }


                        echo '
                         <tr>
                            <td>'.strtoupper($row_section["student"]).' </td>
                            <td><i>'.$q1.'</i> </td>
                            <td><i>'.$q2.'</i> </td>
                            <td><i>'.$q3.'</i> </td>
                            <td><i>'.$q4.'</i> </td>
                            <td><i>'.$final.'</i> </td>
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
$sqlPrint = urlencode("SELECT K.level as Grade_Level, I.section as Section,CONCAT(F.Lname, ' ', F.Fname) as Student_Name, G.subject as Subject, CONCAT(H.Fname, ' ', H.Lname) as Teacher, D.q1 as Q1, D.q2 as Q2, D.q3 as Q3, D.q4 as Q4, (( D.q1 + D.q2 + D.q3 + D.q4)/4) as Final
                    FROM  enrolled_student E
                    LEFT JOIN sy_level_section A ON A.ID = E.sy_level_section_ID
                    LEFT JOIN sy_level_subject B ON A.sy_level_ID = B.sy_level_ID
                    LEFT JOIN teacher_section_subject C ON C.sy_level_subject_ID = B.ID AND A.ID = C.sy_level_section_ID
                    LEFT JOIN student F ON E.student_ID = F.ID
                    LEFT JOIN grade D ON C.ID = D.teacher_section_subject_ID AND E.ID = D.enrolled_student_ID
                    LEFT JOIN subject G ON B.subject_ID = G.ID
                    LEFT JOIN teacher H ON C.teacher_ID = H.ID
                    LEFT JOIN section I ON A.section_ID = I.ID
                    LEFT JOIN sy_level J ON J.ID = B.sy_level_ID AND A.sy_level_ID = J.level_ID
                    LEFT JOIN level K ON J.level_ID = K.ID
                    WHERE A.ID = $syLevelSec AND G.ID = $subjId AND F.ID IS NOT NULL
                    ORDER BY F.Lname ASC
    ");

$header = urlencode("Student Grade");
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
    <?php
    }else{
    ?>
        $('#teacher_assign').empty();
        $('#teacher_assign').append("Teacher Assign: "+<?php echo '\''.$teach. '\'';?>);
    <?php
    }
    ?>
</script>


</html>
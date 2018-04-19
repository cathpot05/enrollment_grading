<?php
/**
 * Created by PhpStorm.
 * User: PB7N0062
 * Date: 4/18/18
 * Time: 1:50 PM
 */


include "../../dbcon.php";
include "../sessionAdmin.php";
$subjId=$_GET['subjectId'];
$syLevelSec=$_GET['syLevelSec'];
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
                    <th>SUBJECT</th>
                    <th>TEACHER</th>
                    <th>QUARTER 1</th>
                    <th>QUARTER 2</th>
                    <th>QUARTER 3</th>
                    <th>QUARTER 4</th>
                    <th>FINAL</th>
                </tr>
                </thead>
                <tbody>


                <?php
                $sql_section = "SELECT A.ID, A.section_ID,K.level, I.section, G.ID,CONCAT(F.Fname, ' ', F.Lname) as student, G.subject,
                    CONCAT(H.Fname, ' ', H.Lname) as teacher, D.q1, D.q2, D.q3, D.q4, D.final
                    FROM sy_level_section A
                    LEFT JOIN sy_level_subject B ON A.sy_level_ID =  B.sy_level_ID
                    LEFT JOIN teacher_section_subject C ON C.sy_level_subject_ID = B.ID
                    LEFT JOIN enrolled_student E ON A.ID = E.sy_level_section_ID
                    LEFT JOIN student F ON E.student_ID =  F.ID
                    LEFT JOIN grade D ON C.ID =  D.teacher_section_subject_ID AND E.ID =  D.enrolled_student_ID
                    LEFT JOIN subject G ON B.subject_ID = G.ID
                    LEFT JOIN teacher H ON C.teacher_ID = H.ID
                    LEFT JOIN section I ON A.section_ID = I.ID
                    LEFT JOIN sy_level J ON J.ID = B.sy_level_ID
                    LEFT JOIN level K ON J.level_ID =  K.ID
                    WHERE A.ID = $syLevelSec AND G.ID = $subjId";
                $result_section = mysqli_query($con,$sql_section);

                if(mysqli_num_rows($result_section)>0)
                {
                    while($row_section = mysqli_fetch_array($result_section))
                    {
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
                            <td>'.strtoupper($row_section["subject"]).' </td>
                            <td>'.strtoupper($row_section["teacher"]).' </td>
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

<script type="text/javascript">
</script>


</html>
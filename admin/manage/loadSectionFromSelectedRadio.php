<?php
/**
 * Created by PhpStorm.
 * User: PB7N0062
 * Date: 4/16/18
 * Time: 2:07 PM
 */


include "../../dbcon.php";
include "../sessionAdmin.php";
$levelId=$_GET['LevelId'];
$leveldesc=$_GET['LevelDesc'];
$schoolYearID=$_GET['SY'];
$status=$_GET['Status'];
//Status
?>
<!DOCTYPE html>
<html>
    <div class="table-responsive" >
        <div>
            <table class="table table-hover table-inverse" id="dataTables-example" style="border-style:inset; margin-top: 20px;">
                <caption>List of Sections for <?php echo $leveldesc; ?></caption>
                <thead>
                <tr>
                    <th><input type="checkbox" name="checkall" id="checkall" value=""/> Check All</th>
                    <th>Section Name</th>
                    <th>Section Capacity</th>
                    <th>Adviser</th>
                </tr>
                </thead>
                <tbody>


                <?php

                if($status == 'current_sec'){
                   $sql_section = "SELECT A.*
                FROM section A
                WHERE A.ID NOT IN (
                    SELECT X.section_ID
                    FROM sy_level_section X
                    INNER JOIN sy_level Z ON X.sy_level_ID =  Z.ID
                    WHERE  Z.sy_ID = $schoolYearID
                )AND
                A.level_id = $levelId";



                $result_section = mysqli_query($con,$sql_section);

                    if(mysqli_num_rows($result_section)>0)
                    {
                        while($row_section = mysqli_fetch_array($result_section))
                        {
                            $section = $row_section["section"];
                            echo '
         <tr>
            <td width="20%" ><input type="checkbox"  name="checklist_section[]" value="'.$row_section["ID"].'"/> </td>
            <td> '.$row_section["section"].'</td>
            <td> <input type=number class="form-control" name=capacity_'.$row_section["ID"].'  value="0"/> </td>
            <td>  <select class="form-control" name="cboAdviser_'.$row_section["ID"].'">
            ';
                            $sql_teacher = "SELECT ID, Concat(FName, ' ', LName) AS teacher_name FROM teacher";
                            $result_teacher = mysqli_query($con,$sql_teacher);
                            if(mysqli_num_rows($result_teacher)> 0)
                            {
                                while($row_teacher = mysqli_fetch_array($result_teacher))
                                {
                                    echo '
                       <option value='.$row_teacher["ID"].'>'.$row_teacher["teacher_name"].'</option>
                       ';
                                }
                            }
                            echo '
        </select>
        </td>
         </tr>
        ';
                        }
                    }
         }
        else{
            $sql_section = "SELECT A.ID, A.sy_level_ID, A.section_ID, A.teacher_ID, A.capacity, B.sy_ID,D.section, CONCAT(E.Fname, ' ', E.Lname) AS teacher
            FROM sy_level_section A
            INNER JOIN sy_level B ON A.sy_level_ID = B.ID
            INNER JOIN sy C ON B.sy_ID = C.ID
            INNER JOIN section D ON A.section_ID =  D.ID
            INNER JOIN teacher E ON A.teacher_ID = E.ID
            WHERE C.ID = $schoolYearID  AND B.ID = $levelId";
            $result_section = mysqli_query($con,$sql_section);
            if(mysqli_num_rows($result_section)>0)
            {
                while($row_section = mysqli_fetch_array($result_section))
                {
                    $section = $row_section["section"];
                    echo '
                     <tr>
                        <td width="20%" ><input type="checkbox"  name="checklist_section[]" value="'.$row_section["section_ID"].'"/> </td>
                        <td> '.$row_section["section"].'</td>
                        <td> '.$row_section["capacity"].' <input type=hidden class="form-control" name=capacity_'.$row_section["ID"].' value="'.$row_section["capacity"].'"/></td>
                        <td> '.$row_section["teacher"].'  <input type=hidden class="form-control" name=cboAdviser_'.$row_section["ID"].' value="'.$row_section["teacher_ID"].'"</td>
                     </tr>
                    ';
                }
            }
        }
                ?>
                </tbody>
            </table>
        </div>
        <p style="color: red;">NOTE: Check and uncheck desired section to add.</p>
    </div>

<script type="text/javascript">
    $("#checkall").click(function(){
        $('input:checkbox').not(this).prop('checked', this.checked);
    });



</script>


</html>
<?php
/**
 * Created by PhpStorm.
 * User: PB7N0062
 * Date: 4/17/18
 * Time: 4:03 PM
 */


include "../../../dbcon.php";
include "../../sessionAdmin.php";
$levelId = $_GET['LevelId'];
$leveldesc = $_GET['LevelDesc'];
$schoolYearID = $_GET['SY_cbo'];
$syLevelId = $_GET['SY'];
?>
<!DOCTYPE html>
<html>

<div>
    <div id="loadDataContainer_subj">
        <div class="table-responsive">
            <div>
                <table class="table table-hover table-inverse" id="dataTables-example" style= "margin-top: 20px;">
                    <caption>LIST OF SUBJECTS</caption>
                    <thead class="text-info">
                    <tr>
                        <th  ><input type="checkbox" name="checkall" id="checkall_subj" value=""/> Check All</th>
                        <th>SUBJECT CODE</th>
                        <th>SUBJECT DESCRIPTION</th>
                        <th>CHOOSE TEACHER</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                     $sql_section = "SELECT A.*
                                        FROM subject A
                                        LEFT JOIN sy_level_subject B ON A.Id = B.subject_ID
                                        WHERE A.ID NOT IN ( SELECT X.subject_ID FROM summer_subject X
                                                           INNER JOIN sy_level Z ON X.sy_level_ID = Z.ID
                                                           WHERE Z.ID = $syLevelId )
                                        AND B.sy_level_ID = $syLevelId
                                ";
                    $result_section = mysqli_query($con,$sql_section);

                    if(mysqli_num_rows($result_section)>0)
                    {
                        while($row_section = mysqli_fetch_array($result_section))
                        {
                            echo '
         <tr>
            <td width="20%" ><input type="checkbox"  name="checklist_section[]" value="'.$row_section["ID"].'"/> </td>
            <td> '.strtoupper($row_section["code"]).'</td>
            <td> '.strtoupper($row_section["subject"]).'</td>
            <td>  <select class="form-control" name="cboTeacher_'.$row_section["ID"].'">

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
                    ?>
                    </tbody>
                </table>
            </div>
            <p style="color: red;">NOTE: Check and uncheck desired subject to add.</p>
        </div>
    </div>
</div>

<script type="text/javascript">
    $("#checkall_subj").click(function(){
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
</script>


</html>
<?php
/**
 * Created by PhpStorm.
 * User: PB7N0062
 * Date: 4/17/18
 * Time: 4:42 PM
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
        <table class="table table-hover table-inverse" id="dataTables-example" style= "margin-top: 20px;">
           <caption>LIST OF SUBJECTS</caption>
            <thead class="text-info">
            <tr>
                <th><input type="checkbox" name="checkall" id="checkall_subj" value=""/> Check All</th>
                <th>SUBJECT CODE</th>
                <th>SUBJECT DESCRIPTION</th>
            </tr>
            </thead>
            <tbody>


            <?php

            if($status == 'current_sec'){
                $sql_section = "SELECT A.*
                                FROM subject A
                                WHERE A.ID NOT IN (
                                    SELECT X.subject_ID
                                    FROM sy_level_subject X
                                    INNER JOIN sy_level Z ON X.sy_level_ID =  Z.ID
                                    WHERE X.sy_level_ID = $levelId
                                )";
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
         </tr>
        ';
                    }
                }
            }
            else{
                 $sql_section = "SELECT A.subject_ID, D.code, D.subject
                    FROM sy_level_subject A
                    INNER JOIN sy_level B ON B.ID = A.sy_level_ID
                    INNER JOIN sy C ON B.sy_ID = C.ID
                    INNER JOIN subject D ON A.subject_ID = D.ID
                    WHERE C.ID = $schoolYearID  AND B.ID IN
                    (SELECT X.ID FROM sy_level X WHERE X.sy_ID = $schoolYearID AND X.level_ID = $levelId)
                    ";
                $result_section = mysqli_query($con,$sql_section);
                if(mysqli_num_rows($result_section)>0)
                {
                    while($row_section = mysqli_fetch_array($result_section))
                    {
                        echo '
                     <tr>
                        <td width="20%" ><input type="checkbox"  name="checklist_section[]" value="'.$row_section["subject_ID"].'"/> </td>
                        <td> '.strtoupper($row_section["code"]).'</td>
                        <td> '.strtoupper($row_section["subject"]).'</td>
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
    $("#checkall_subj").click(function(){
        $('input:checkbox').not(this).prop('checked', this.checked);
    });

</script>


</html>
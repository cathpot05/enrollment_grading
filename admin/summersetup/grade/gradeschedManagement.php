<?php
/**
 * Created by PhpStorm.
 * User: PB7N0062
 * Date: 4/18/18
 * Time: 9:09 AM
 */


include "../../../dbcon.php";
include "../../sessionAdmin.php";
$sylevelId=$_GET['id'];
$section = $_GET['leveldesc'];
?>
<!DOCTYPE html>
<html>
<style>
    .input-xs {
        height: 22px;
        padding: 2px 5px;
        font-size: 12px;
        line-height: 1.5; /* If Placeholder of the input is moved up, rem/modify this. */
        border-radius: 3px;
    }
</style>

<div>
    <input type="hidden" name="sylevelId" value="<?php echo $sylevelId; ?>"/>
    <div class="table-responsive">
        <div>
            <table class="table table-hover table-inverse" id="dataTables-example" style="border: inset;">
                <caption><b>GRADE SCHEDULE FOR SUMMER<i><?php echo strtoupper($section) ; ?></i></b></caption>
                <thead>
                <tr class="text-primary">
                    <th style="border-right: inset ;" colspan="2"><center>Please set date schedule</center></th>
                </tr>
                </thead>
                <tbody>


                <?php
                $sql_section = "SELECT A.* FROM summer_grade_sched A WHERE A.sy_level_ID = $sylevelId";
                $result_section = mysqli_query($con,$sql_section);

                if(mysqli_num_rows($result_section)>0)
                {
                    while($row_section = mysqli_fetch_array($result_section))
                    {
                        echo '
                        <tr>
                        <input type="hidden" name="gradeId" value="'.$row_section["ID"].'"/>
                        <td><label>From:</label> <input type="text" class="form-control quarterDate"  name="q1S" id="q1S" value="'.$row_section["start"].'"/> </td>
                        <td style="border-right: inset ;"> <label>To:</label><input type="text" class="form-control quarterDate"  name="q1E" id="q1E" value="'.$row_section["end"].'"/> </td>
                        </tr>
                    ';
                    }
                }else{
                    //echo '<tr><td colspan="3" style="color: red"> NO DATA TO DISPLAY. ADD SUBJECTS FOR THIS YEAR LEVEL.</td></tr>';
                    echo '
                    <tr>
                        <input type="hidden" name="gradeId" value="0"/>
                        <td><label>From:</label> <input type="text" class="form-control  quarterDate"  name="q1S" id="q1S"/> </td>
                        <td style="border-right: inset ;"> <label>To:</label><input type="text" class="form-control quarterDate"  name="q1E" id="q1E"/> </td>
                        </tr>
                    ';
                }
                ?>
                </tbody>
            </table>
        </div>

    </div>

</div>
<script type="text/javascript">

    $("#q1S").datepicker({
        dateFormat: 'yy-mm-dd',
        minDate:0,
        onSelect: function(dateText, inst){
            $("#q1E").datepicker("option","minDate",$("#q1S").datepicker("getDate"));
        }
    });
    $("#q1E").datepicker({ dateFormat: 'yy-mm-dd'});

    $(".quarterDate").prop('required',true);
</script>


</html>
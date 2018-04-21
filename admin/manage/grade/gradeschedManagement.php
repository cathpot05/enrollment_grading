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
                <caption><b>GRADE SCHEDULE FOR <i><?php echo strtoupper($section) ; ?></i></b></caption>
                <thead>
                <tr class="text-primary">
                    <th style="border-right: inset ;" colspan="2">QUARTER 1</th>
                    <th style="border-right: inset ;" colspan="2">QUARTER 2</th>
                    <th style="border-right: inset ;" colspan="2">QUARTER 3</th>
                    <th style="border-right: inset ;" colspan="2">QUARTER 4</th>
                </tr>
                </thead>
                <tbody>


                <?php
                $sql_section = "SELECT A.* FROM grade_sched A WHERE A.sy_level_ID = $sylevelId";
                $result_section = mysqli_query($con,$sql_section);

                if(mysqli_num_rows($result_section)>0)
                {
                    while($row_section = mysqli_fetch_array($result_section))
                    {
                        echo '
                        <tr>
                        <input type="hidden" name="gradeId" value="'.$row_section["ID"].'"/>
                        <td><label>From:</label> <input type="text" class="form-control input-xs quarterDate"  name="q1S" id="q1S" value="'.$row_section["q1Start"].'"/> </td>
                        <td style="border-right: inset ;"> <label>To:</label><input type="text" class="form-control input-xs quarterDate"  name="q1E" id="q1E" value="'.$row_section["q1End"].'"/> </td>
                        <td><label>From:</label> <input type="text" class="form-control input-xs quarterDate"  name="q2S" id="q2S" value="'.$row_section["q2Start"].'"/> </td>
                        <td style="border-right: inset ;"> <label>To:</label> <input type="text" class="form-control input-xs quarterDate"  name="q2E" id="q2E" value="'.$row_section["q2End"].'"/> </td>
                        <td><label>From:</label> <input type="text" class="form-control input-xs quarterDate"  name="q3S" id="q3S" value="'.$row_section["q3Start"].'"/> </td>
                        <td style="border-right: inset ;"><label>To:</label> <input type="text" class="form-control input-xs quarterDate"  name="q3E" id="q3E" value="'.$row_section["q3End"].'"/> </td>
                        <td><label>From:</label> <input type="text" class="form-control input-xs quarterDate"  name="q4S" id="q4S" value="'.$row_section["q4Start"].'"/> </td>
                        <td style="border-right: inset ;"><label>To:</label> <input type="text" class="form-control input-xs quarterDate"  name="q4E" id="q4E" value="'.$row_section["q4End"].'"/> </td>
                        </tr>
                    ';
                    }
                }else{
                    //echo '<tr><td colspan="3" style="color: red"> NO DATA TO DISPLAY. ADD SUBJECTS FOR THIS YEAR LEVEL.</td></tr>';
                    echo '
                    <tr>
                        <input type="hidden" name="gradeId" value="0"/>
                        <td><label>From:</label> <input type="text" class="form-control input-xs  quarterDate"  name="q1S" id="q1S"/> </td>
                        <td style="border-right: inset ;"> <label>To:</label><input type="text" class="form-control input-xs quarterDate"  name="q1E" id="q1E"/> </td>
                        <td><label>From:</label> <input type="text" class="form-control input-xs quarterDate"  name="q2S" id="q2S"/> </td>
                        <td style="border-right: inset ;"> <label>To:</label><input type="text" class="form-control input-xs quarterDate"  name="q2E" id="q2E" /> </td>
                        <td><label>From:</label>  <input type="text" class="form-control input-xs quarterDate"  name="q3S" id="q3S" /> </td>
                        <td style="border-right: inset ;"><label>To:</label> <input type="text" class="form-control input-xs quarterDate"  name="q3E" id="q3E" /> </td>
                        <td><label>From:</label> <input type="text" class="form-control input-xs quarterDate"  name="q4S" id="q4S" /> </td>
                        <td style="border-right: inset ;"><label>To:</label> <input type="text" class="form-control input-xs quarterDate"  name="q4E" id="q4E" /> </td>
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

    $("#q2S").datepicker({
        dateFormat: 'yy-mm-dd',
        minDate:0,
        onSelect: function(dateText, inst){
            $("#q2E").datepicker("option","minDate",$("#q2S").datepicker("getDate"));
        }
    });
    $("#q2E").datepicker({ dateFormat: 'yy-mm-dd'});

    $("#q3S").datepicker({
        dateFormat: 'yy-mm-dd',
        minDate:0,
        onSelect: function(dateText, inst){
            $("#q3E").datepicker("option","minDate",$("#q3S").datepicker("getDate"));
        }
    });
    $("#q3E").datepicker({ dateFormat: 'yy-mm-dd'});

    $("#q4S").datepicker({
        dateFormat: 'yy-mm-dd',
        minDate:0,
        onSelect: function(dateText, inst){
            $("#q4E").datepicker("option","minDate",$("#q4S").datepicker("getDate"));
        }
    });
    $("#q4E").datepicker({ dateFormat: 'yy-mm-dd'});

    //$(".quarterDate").prop('required',true);
</script>


</html>
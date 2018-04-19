<?php
/**
 * Created by PhpStorm.
 * User: Ms. Cath
 * Date: 4/15/18
 * Time: 9:40 PM
 */

include "../../dbcon.php";
include "../sessionAdmin.php";
$levelId=$_GET['LevelId'];
$leveldesc=$_GET['LevelDesc'];
$schoolYearID=$_GET['SY'];
?>
<!DOCTYPE html>
<html>




<div>

    <div class="form-inline">
        <label>Choose Data to Load:</label>
        <input style="margin-left: 20px;" type="radio" name="radio_section" class="radio_"  value="current_sec" checked/> Current Section List
        <input style="margin-left: 20px;" type="radio" name="radio_section" class="radio_" value="prev_year"/>From Other School Year

        <div id="sYcboHolder" style="display: none; float:right;">
            <label>SY:</label>
            <select class="form-control" name="cboSY" id="cboSY_">
                <?php
                $sql_cbo = "SELECT * FROM sy WHERE id <> $schoolYearID";
                $result_cbo = mysqli_query($con,$sql_cbo);
                if(mysqli_num_rows($result_cbo)> 0)
                {
                    while($row_cbo = mysqli_fetch_array($result_cbo))
                    {
                        echo '
                       <option value='.$row_cbo["ID"].'>'.$row_cbo["schoolYear"].'</option>
                       ';
                    }
                }
                ?>
            </select>
        </div>
    </div>

<div id="loadDataContainer">
    <div class="table-responsive">
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
                ?>
                </tbody>
            </table>
        </div>
        <p style="color: red;">NOTE: Check and uncheck desired section to add.</p>
    </div>

</div>

</div>

<script type="text/javascript">
    $("#checkall").click(function(){
        $('input:checkbox').not(this).prop('checked', this.checked);
    });




    $(".radio_").on('click', function() {
        //var schoolyear1 = $('#cboSY').val();
        var value = $('input[name=radio_section]:checked').val();
        if(value == 'current_sec'){
            var level_id = <?php echo $levelId; ?>;
            var level_desc = <?php echo "'.$leveldesc.'"; ?>;
            var schoolyear = $('#cboSY').val();
            $('#sYcboHolder').hide();
           $.ajax({
                type: "GET",
                url: "loadSectionFromSelectedRadio.php?Status="+value+"&LevelId="+level_id+"&LevelDesc="+level_desc+"&SY="+schoolyear,
                cache: false,
                success: function(html){
                    $("#loadDataContainer").empty(html);
                    $("#loadDataContainer").append(html);
                }
            });

        }else{
            $('#sYcboHolder').show();
            var level_id = <?php echo $levelId; ?>;
            var level_desc = <?php echo "'.$leveldesc.'"; ?>;

            $("#cboSY_").on('click', function() {
                var schoolyear = $('#cboSY_').val();

                $.ajax({
                    type: "GET",
                    url: "loadSectionFromSelectedRadio.php?Status="+value+"&LevelId="+level_id+"&LevelDesc="+level_desc+"&SY="+schoolyear,
                    cache: false,
                    success: function(html){
                        $("#loadDataContainer").empty(html);
                        $("#loadDataContainer").append(html);
                    }
                });
            });

        }
    });

</script>


</html>
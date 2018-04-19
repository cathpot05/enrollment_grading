<?php
/**
 * Created by PhpStorm.
 * User: PB7N0062
 * Date: 4/17/18
 * Time: 4:03 PM
 */


include "../../dbcon.php";
include "../sessionAdmin.php";
$levelId = $_GET['LevelId'];
$leveldesc = $_GET['LevelDesc'];
$schoolYearID = $_GET['SY_cbo'];
$syLevelId = $_GET['SY'];
?>
<!DOCTYPE html>
<html>

<div>

    <div class="form-inline">
        <label>Choose Subject to Load:</label>
        <input style="margin-left: 20px;" type="radio" name="radio_section" class="radio_subj"  value="current_sec" checked/> All Subject
        <input style="margin-left: 20px;" type="radio" name="radio_section" class="radio_subj" value="prev_year"/>From Other School Year

        <div id="sYcboHolder_subj" style="display: none; float:right;">
            <label>SY:</label>
            <select class="form-control" name="cboSY" id="cboSY_subj">
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
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql_section = "SELECT A.*
                                FROM subject A
                                WHERE A.ID NOT IN (
                                    SELECT X.subject_ID
                                    FROM sy_level_subject X
                                    INNER JOIN sy_level Z ON X.sy_level_ID =  Z.ID
                                    WHERE X.sy_level_ID = $syLevelId
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


    $(".radio_subj").on('click', function() {
        var value = $('input[name=radio_section]:checked').val();
        if(value == 'current_sec'){
            var level_id = <?php echo $syLevelId; ?>;
            var level_desc = <?php echo "'.$leveldesc.'"; ?>;
            var schoolyear = $('#cboSY').val();
            $('#sYcboHolder').hide();
            $.ajax({
                type: "GET",
                url: "loadSubjectFromSelectedRadio.php?Status="+value+"&LevelId="+level_id+"&LevelDesc="+level_desc+"&SY="+schoolyear,
                cache: false,
                success: function(html){
                    $("#loadDataContainer_subj").empty(html);
                    $("#loadDataContainer_subj").append(html);
                }
            });

        }else{
            $('#sYcboHolder_subj').show();
            var level_id = <?php echo $levelId; ?>;
            var level_desc = <?php echo "'.$leveldesc.'"; ?>;

            $("#cboSY_subj").on('click', function() {
                var schoolyear = $('#cboSY_subj').val();

                $.ajax({
                    type: "GET",
                    url: "loadSubjectFromSelectedRadio.php?Status="+value+"&LevelId="+level_id+"&LevelDesc="+level_desc+"&SY="+schoolyear,
                    cache: false,
                    success: function(html){
                        $("#loadDataContainer_subj").empty(html);
                        $("#loadDataContainer_subj").append(html);
                    }
                });
            });
        }
    });
</script>


</html>
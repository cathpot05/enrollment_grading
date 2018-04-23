<?php
/**
 * Created by PhpStorm.
 * User: Ms. Cath
 * Date: 4/22/18
 * Time: 9:18 PM
 */


include "../../dbcon.php";
include "../sessionAdmin.php";
?>

<html>

<div class="row">
    <div class="col-lg-12">
        <div class="panel">
            <div class="panel-body">
                <div class="form-inline col-lg-6" >
                    <label>SchoolYear:</label>
                    <select class="form-control chosen" name="cboSY" id="cboSY">
                        <?php
                        $sql = "SELECT * FROM sy ORDER BY LEFT(schoolYear,4) DESC";
                        $result = mysqli_query($con,$sql);
                        if(mysqli_num_rows($result)> 0)
                        {
                            while($row = mysqli_fetch_array($result))
                            {
                                echo '
                               <option value='.$row["ID"].'>'.$row["schoolYear"].'</option>
                               ';
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="form-inline col-lg-6 cboLevel_container" >
                    <label>Grade Level:</label>
                    <select class="form-control">
                        <option>Choose School Year First</option>
                    </select>
                </div>
            </div>

            <div class="panel-body">
                <div id="loadLevelData" class="loadLevelData">

                </div>
            </div>
        </div>
    </div>
</div>



</html>

<script type="text/javascript">
    $("#cboSY").on('click', function() {
        var x = this.value;
        $.ajax({
            type: "GET",
            url: "level_syLevelFilter.php?SYid="+x,
            cache: false,
            success: function(html){
                $(".cboLevel_container").empty(html);
                $(".cboLevel_container").append(html);
            }
        });
    });
</script>
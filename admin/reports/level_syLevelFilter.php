<?php
/**
 * Created by PhpStorm.
 * User: Ms. Cath
 * Date: 4/22/18
 * Time: 9:18 PM
 */
include "../../dbcon.php";
include "../sessionAdmin.php";
$sy = $_GET['SYid'];
?>

<html>
<label>Grade Level:</label>
<select class="form-control chosen" name="cboLevel" id="cboLevel">
    <?php
    $sql_level = "
    SELECT A.ID, B.level
FROM sy_level A
INNER JOIN level B ON A.level_ID = B.ID
WHERE A.sy_ID = $sy
ORDER BY RIGHT(B.level, 2) ASC
    ";
    $result_level = mysqli_query($con,$sql_level);
    if(mysqli_num_rows($result_level)> 0)
    {
        while($row_level = mysqli_fetch_array($result_level))
        {
            echo '
                               <option value='.$row_level["ID"].'>'.$row_level["level"].'</option>
                               ';
        }
    }
    ?>
</select>
</html>


<script type="text/javascript">
    $("#cboLevel").on('click', function() {
        var x = this.value;
        var sy = $("#cboSY").val();
        $.ajax({
            type: "GET",
            url: "level_report.php?levelid="+x+"&syId="+sy,
            cache: false,
            success: function(html){
                $("#loadLevelData").empty(html);
                $("#loadLevelData").append(html);
            }
        });
    });
</script>
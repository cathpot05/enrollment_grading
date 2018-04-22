<?php
/**
 * Created by PhpStorm.
 * User: Ms. Cath
 * Date: 4/22/18
 * Time: 9:18 PM
 */


include "../../dbcon.php";
include "../sessionAdmin.php";

$level = $_GET['levelid'];
$syId = $_GET['syId'];
?>

<html>
<label>Grade Level:</label>
<select class="form-control chosen" name="cboSection" id="cboSection">
    <?php
    $sql_section = "SELECT A.ID, C.section
FROM sy_level_section A
INNER JOIN sy_level B ON A.sy_level_ID = B.ID
INNER JOIN section C ON A.section_ID = C.ID
WHERE B.ID = $level AND B.sy_ID = $syId
    ";
    $result_section = mysqli_query($con,$sql_section);
    if(mysqli_num_rows($result_section)> 0)
    {
        while($row_section = mysqli_fetch_array($result_section))
        {
            echo '
                               <option value='.$row_section["ID"].'>'.$row_section["section"].'</option>
                               ';
        }
    }
    ?>
</select>
</html>


<script type="text/javascript">
    $("#cboSection").on('click', function() {
        var x = this.value;
        var sy = $("#cboSY").val();
        var level = $("#cboLevel").val();
        $.ajax({
            type: "GET",
            url: "section_report.php?sylevelsec="+x+"&syId="+sy+"&sylevel="+level,
            cache: false,
            success: function(html){
                $("#loadSectionData").empty(html);
                $("#loadSectionData").append(html);
            }
        });
    });
</script>
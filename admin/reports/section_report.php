<?php
/**
 * Created by PhpStorm.
 * User: Ms. Cath
 * Date: 4/22/18
 * Time: 9:14 PM
 */
include "../../dbcon.php";
include "../sessionAdmin.php";

$level = $_GET['sylevel'];
$syId = $_GET['syId'];
$sylevelsec = $_GET['sylevelsec'];
?>
<html>

<label>Choose Report:</label>
<select class="form-control chosen" id="reportType">
    <option value="1">TOP 10 STUDENTS PER SECTION</option>
    <option value="2">LIST OF FAILED STUDENTS PER SECTION</option>
    <option value="3">SUBJECT PER SECTION</option>
</select>

<div id="reportResult">

</div>
</html>


<script type="text/javascript">
    $("#reportType").on('click', function() {
        var x = this.value;
        var sy = $("#cboSY").val();
        var level = $("#cboLevel").val();
        var sylevelsec = $("#cboSection").val();

        $.ajax({
            type: "GET",
            url: "result_section.php?sylevelsec="+sylevelsec+"&syId="+sy+"&sylevel="+level+"&type="+x,
            cache: false,
            success: function(html){
                $("#reportResult").empty(html);
                $("#reportResult").append(html);
            }
        });
    });



</script>

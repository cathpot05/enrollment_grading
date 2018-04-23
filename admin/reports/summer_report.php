<?php
/**
 * Created by PhpStorm.
 * User: Ms. Cath
 * Date: 4/22/18
 * Time: 9:14 PM
 */
include "../../dbcon.php";
include "../sessionAdmin.php";

$syId = $_GET['syId'];
?>
<html>

<label>Choose Report:</label>
<select class="form-control chosen" id="reportType">
    <option value="1">LIST OF STUDENTS WITH SUMMER SUBJECTS</option>
    <option value="2">SUMMER OFFERED SUBJECTS</option>
    <!--<option value="3">COUNT OF PASSED/FAILED STUDENTS IN SUMMER</option>
    <option value="4">PASSED STUDENTS IN SUMMER</option>
    <option value="5">FAILED STUDENTS IN SUMMER</option>-->


</select>

<div id="reportResult">

</div>
</html>


<script type="text/javascript">
    $("#reportType").on('click', function() {
        var x = this.value;
        var sy = $("#cboSY").val();

        $.ajax({
            type: "GET",
            url: "result_summer.php?syId="+sy+"&type="+x,
            cache: false,
            success: function(html){
                $("#reportResult").empty(html);
                $("#reportResult").append(html);
            }
        });
    });
</script>

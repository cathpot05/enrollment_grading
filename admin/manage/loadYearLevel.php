<?php
/**
 * Created by PhpStorm.
 * User: Ms. Cath
 * Date: 4/15/18
 * Time: 3:51 PM
 */

include "../../dbcon.php";
include "../sessionAdmin.php";
$schoolYearID=$_GET['SYid'];
?>
<!DOCTYPE html>
<html>
<head>

</head>
<style>


</style>

<?php
$sql = "select B.level, A.sy_ID,B.ID
from sy_level A
inner join level B On A.level_ID = B.ID
where A.sy_ID=$schoolYearID
GROUP BY B.level, A.sy_ID
ORDER BY RIGHT(B.level, 2) ASC";

$result = mysqli_query($con,$sql);
if(mysqli_num_rows($result)>0)
{
    while($row = mysqli_fetch_array($result))
    {
        $level_id = $row["ID"];
        $level_desc = $row["level"];
        echo '
        <div style="background-color:rgb(85,180,163); margin-bottom:10px;" class="panel">
            <div class="panel-heading">
                Level: '.$row["level"].'
                 <button style="padding:3px;" class="pull-right btn btn-primary btn-sm" data-toggle="modal" data-target="#addExModal" onClick="passData('.$row["ID"].', \''.$level_desc.'\')">Add Section</button>
            </div>
        </div>
        <div>
                <div class="table-responsive" >
                    <div>
                        <table class="table table-hover" id="dataTables-example" style="border-style:inset;">
                            <thead>
                            <tr>
                                <th>Section</th>
                                <th>Capacity</th>
                                <th>Adviser</th>
                                <th width=5%>Edit</th>
                                <th width=5%>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
        ';
        $sql1 = "select a.sy_ID, G.level, B.section_ID, B.teacher_ID,  B.capacity, D.section, CONCAT(F.Fname, ' ', F.Lname)as teacher
                from sy_level A
                left join sy_level_section B on A.ID = b.sy_level_ID
                left join section D ON B.section_ID = D.ID
                left join teacher F on B.teacher_ID = F.ID
                left join level G ON A.level_ID =  G.ID
                where A.sy_ID=$schoolYearID AND G.ID = $level_id ";
        $result1 = mysqli_query($con,$sql1);
        if(mysqli_num_rows($result1)>0)
        {
            while($row1 = mysqli_fetch_array($result1))
            {
                if($row1["section_ID"] == null){
                    echo '<tr><td colspan="5" style="color: red"> NO DATA TO DISPLAY. ADD SECTION FOR THIS LEVEL.</td></tr>';
                }
                else{
                    echo '
                            <tr>
                                <td> '.$row1["section"].'</td>
                                <td> '.$row1["capacity"].'</td>
                                <td> '.$row1["teacher"].'</td>
                                <td><center><span id="icon" class="fa fa-edit fa-fw" data-toggle="modal" data-target="#editModal-'.$row1["section"].'"> </span></center></td>
                                <td><center><span id="icon" class="fa fa-times fa-fw" data-toggle="modal" data-target="#deleteModal"></span></center></td>
                            </tr>';
                }
            }
        }
        echo'</tbody>
                        </table>
                    </div>
                </div>
            </div>';

    }
}
?>

<div class="modal fade" id="addExModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Add Section</h4>
        </div>
        <form role="form" action="addSectionPerSYLevel.php" method=post>
            <div class="modal-body">
                <input type=hidden name=level_id id=level_id>
                <input type=hidden name=level_desc id=level_desc>
                <div id="loadSections"></div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
</div>
</div>
<script type="text/javascript">
    function passData(level_id, level_desc)
    //function passData(level_id)
    {
        document.getElementById("level_id").value = level_id;
        document.getElementById("level_desc").value = level_desc;
            var x = $("#level_id").val();
			var y = $("#level_desc").val();
             $.ajax({
                 type: "GET",
                 url: "getSectionData.php?LevelId="+x+"&LevelDesc="+y+"&SY="+<?php echo $schoolYearID;?>,
                 cache: false,
                 success: function(html){
                 $("#loadSections").empty(html);
                 $("#loadSections").append(html);
                 }
             });

    }

</script>



</html>
<?php
/**
 * Created by PhpStorm.
 * User: PB7N0062
 * Date: 4/17/18
 * Time: 2:02 PM
 */


include "../../dbcon.php";
include "../sessionAdmin.php";
$levelId=$_GET['id'];
$section = $_GET['section'];
$syId = $_GET['syId'];
?>
<!DOCTYPE html>
<html>


<div>
    <div class="table-responsive">
        <div>
            <table class="table table-hover table-inverse" id="dataTables-example">
                <caption><b>LIST OF SUBJECTS FOR <i><?php echo strtoupper($section) ; ?></i></b></caption>
                <thead>
                <tr class="text-primary">
                    <th>SUBJECT CODE</th>
                    <th>SUBJECT DESCRIPTION</th>
                    <th>SUBJECT TEACHER</th>
                    <th>DELETE</th>
                </tr>
                </thead>
                <tbody>


                <?php
                /*$sql_section = "SELECT C.code, C.subject, CONCAT(F.Fname, ' ', F.Lname) as teacher
FROM  sy_level_subject A
INNER JOIN sy_level B ON A.sy_level_ID =  B.ID
INNER JOIN subject C ON A.subject_ID =  C.ID
LEFT JOIN teacher_section_subject D ON A.ID = D.sy_level_subject_ID
LEFT JOIN sy_level_section E ON D.sy_level_section_ID =  E.ID
LEFT JOIN teacher F ON D.teacher_ID = F.ID
WHERE B.ID IN (SELECT sy_level_ID FROM sy_level_section WHERE ID = $levelId)";*/

                $sql_section = "SELECT C.code, C.subject, CONCAT(F.Fname, ' ', F.Lname) as teacher, A.ID
FROM  sy_level_subject A
INNER JOIN sy_level B ON A.sy_level_ID =  B.ID
INNER JOIN subject C ON A.subject_ID =  C.ID
LEFT JOIN teacher_section_subject D ON A.ID = D.sy_level_subject_ID
LEFT JOIN sy_level_section E ON D.sy_level_section_ID =  E.ID
LEFT JOIN teacher F ON D.teacher_ID = F.ID
WHERE B.ID = $levelId";
                $result_section = mysqli_query($con,$sql_section);

                if(mysqli_num_rows($result_section)>0)
                {
                    while($row_section = mysqli_fetch_array($result_section))
                    {
                        echo '
                        <tr>
                        <td> '.strtoupper($row_section["code"]).'</td>
                        <td> '.strtoupper($row_section["subject"]).'</td>
                        <td> '.strtoupper($row_section["teacher"]).'</td>
                        <td><span id="icon" class="fa fa-trash fa-fw" data-toggle="modal" onClick="confirmDeleteSubject('.$row_section["ID"].', '.$syId.')"></span></td>
                        </tr>
                    ';
                    }
                }else{
                    echo '<tr><td colspan="3" style="color: red"> NO DATA TO DISPLAY. ADD SUBJECTS FOR THIS YEAR LEVEL.</td></tr>';
                }
                ?>
                </tbody>
            </table>
        </div>

    </div>

    </div>

<script type="text/javascript">

    var syLevelId = <?php echo $levelId; ?>;
    var level_desc = <?php echo '".$section."'; ?>;
    var syId = <?php echo $syId; ?>;


    function confirmDeleteSubject(id, syId) {
        if (confirm("Are you sure you want to delete")) {
            $.ajax({
                type: "GET",
                url: "deleteSubjectFromSYLevel.php?id="+id+"&syId="+syId,
                cache: false,
                success: function(html){
                    //window.location.href= 'managesy.php?schoolYearID='+syId;
                    $("#viewSubjectContainer").empty(html);
                    $("#viewSubjectContainer").append(html);

                        reload();
                }
            });
        }
    }

    function reload(){
        $.ajax({
            type: "GET",
            url: "viewSubjectSYLevel.php?id="+syLevelId+"&section="+level_desc+"&syId="+syId,
            cache: false,
            success: function(html){
                $("#viewSubjectContainer").empty(html);
                $("#viewSubjectContainer").append(html);
            }
        });

    }
</script>


</html>
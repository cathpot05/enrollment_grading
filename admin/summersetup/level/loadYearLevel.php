<?php
/**
 * Created by PhpStorm.
 * User: Ms. Cath
 * Date: 4/15/18
 * Time: 3:51 PM
 */

include "../../../dbcon.php";
include "../../sessionAdmin.php";
$schoolYearID=$_GET['SYid'];
?>
<!DOCTYPE html>
<html>

<head>

</head>
<style>


</style>

<?php
$sql = "select B.level, A.sy_ID,A.ID, B.ID as levelId_
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
        $sylevelid = $row["ID"];
        $level_id = $row["levelId_"];
        $level_desc = $row["level"];
        echo '
        <div style="background-color:rgb(85,180,163); margin-bottom:10px;" class="panel-primary">
            <div class="panel-heading">
                Level: '.$row["level"].'


                <div class="pull-right pull-right">
                <div class="dropdown">
                    <button style="padding:3px;"  class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" >
                        <span  class="fa fa-wrench fa-fw"></span> Manage Level <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        <li><a data-toggle="modal" data-target="#addSubjectModal" onClick="subjData('.$row["levelId_"].', \''.$level_desc.'\', '.$sylevelid.')"> <span class="fa fa-book fa-fw"></span>Add Subjects</a></li>
                        <li class="divider"></li>
                        <li><a data-toggle="modal" data-target="#scheduleModal" onClick="schedData(\''.$level_desc.'\', '.$sylevelid.')"  ><span class="fa fa-calendar fa-fw"></span>Grade Schedule</a></li>
                    </ul>
                </div>
                </div>
            </div>
        </div>
        <div>
                <div class="table-responsive" >
                    <div>
                        <table class="table table-hover" id="dataTables-example" style="border-style:inset;">
                            <thead>
                            <tr class="text-info">
                                <th>Subjects</th>
                                <th>Teacher</th>
                                <th width=5%>Students</th>
                                <th width=5%>Grades</th>
                                <th width=5%>Edit</th>
                                <th width=5%>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
        ';
        $sql1 = "SELECT A.ID, B.subject, CONCAT(C.Fname, ', ', C.Lname) as teacher
                FROM summer_subject A
                INNER JOIN subject B ON A.subject_ID = B.ID
                INNER JOIN teacher C ON A.teacher_ID = C.ID
                INNER JOIN sy_level D ON A.sy_level_ID = D.ID
                where D.sy_ID=$schoolYearID AND D.level_ID = $level_id ";
        $result1 = mysqli_query($con,$sql1);
        if(mysqli_num_rows($result1)>0)
        {
            while($row1 = mysqli_fetch_array($result1))
            {
                if($row1["ID"] == null){

                }
                else{
                    echo '
                            <tr>
                                <td> '.$row1["subject"].'</td>
                                <td> '.$row1["teacher"].'</td>
                                <td><center><a href="students/viewStudentsEnrolled.php?sectionId='.$row1["ID"].' " target="_blank"><span id="icon" class="fa fa-users fa-fw"></a> </span></center></td>
                                <td><center><a href="grade/viewStudentsGrade.php?sectionId='.$row1["ID"].' " target="_blank"><span id="icon" class="fa fa-th fa-fw"></span></a></center></td>
                                <td><center><span id="icon" class="fa fa-edit fa-fw" data-toggle="modal" data-target="#editModal" onClick="editData('.$row1["ID"].' )"> </span></center></td>
                                <td><center><span id="icon" class="fa fa-times fa-fw" data-toggle="modal" data-target="#deleteModal" onClick="confirmDelete('.$row1["ID"].', '.$schoolYearID.')"></span></center></td>
                            </tr>';
                }
            }
        }
        else{
            echo '<tr><td colspan="6" style="color: red"> NO DATA TO DISPLAY. ADD SUBJECT FOR THIS SUMMER LEVEL.</td></tr>';
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
        <form role="form" action="section/addSectionPerSYLevel.php" method=post>
            <div class="modal-body">
                <input type=text name=level_id id=level_id>
                <input type=text name=level_desc id=level_desc>
                <input type=text name=syLevelId id=syLevelId>
                <input type=text name=sy_Id id=sy_Id value="<?php echo $schoolYearID ;?>">
                <div id="loadSections"></div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="addSection">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
</div>
</div>


<div class="modal fade" id="addSubjectModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Add Subject</h4>
            </div>
            <form role="form" action="subject/addSubjectPerSYLevel.php" method=post>
                <div class="modal-body">
                    <input type=hidden name=level_id_subj id=level_id_subj>
                    <input type=hidden name=level_desc_subj id=level_desc_subj>
                    <input type=hidden name=syLevelId_subj id=syLevelId_subj>
                    <input type=hidden name=sy_Id_subj id=sy_Id_subj value="<?php echo $schoolYearID ;?>">
                    <div id="loadSubjectsContainer"></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Edit Subject Info</h4>
            </div>
            <form role="form" action="section/editSectionPerSYLevel.php" method=post>
                <div class="modal-body">
                    <input type=hidden name=sy_level_section_id id=sy_level_section_id>
                    <input type=hidden name=syId_Edit id=syId_Edit value="<?php echo $schoolYearID ;?>">
                    <div id="editSectionsContainer"></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="viewSubjModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Subject Info</h4>
            </div>
                <div class="modal-body">
                    <div id="viewSubjectContainer"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
        </div>
    </div>
</div>

<div class="modal fade" id="scheduleModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Grade Schedule Info</h4>
            </div>
            <form role="form" action="grade/gradeManagement.php" method=post>
                <div class="modal-body">
                    <input type="hidden" name="grade_sy" id="grade_sy"/>
                    <div id="viewGradeScheduleContainer"></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="closeSched">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">


    function subjData(level_id, level_desc, syLevelId)
    {
        document.getElementById("level_id_subj").value = level_id;
        document.getElementById("level_desc_subj").value = level_desc;
        document.getElementById("syLevelId_subj").value = syLevelId;
        var x = $("#level_id_subj").val();
        var y = $("#level_desc_subj").val();
      $.ajax({
            type: "GET",
            url: "subject/getSubjectPerSYLevel.php?LevelId="+x+"&LevelDesc="+y+"&SY="+syLevelId+"&SY_cbo="+<?php echo $schoolYearID;?>,
            cache: false,
            success: function(html){
                $("#loadSubjectsContainer").empty(html);
                $("#loadSubjectsContainer").append(html);
            }
        });
    }

    function viewSubject(level_desc, syLevelId){
        var syId = $("#cboSY").val();
        $.ajax({
            type: "GET",
            url: "subject/viewSubjectSYLevel.php?id="+syLevelId+"&section="+level_desc+"&syId="+syId,
            cache: false,
            success: function(html){
                $("#viewSubjectContainer").empty(html);
                $("#viewSubjectContainer").append(html);
            }
        });
    }



    function schedData(level_desc, syLevelId){
        var syId = $("#cboSY").val();
        document.getElementById("grade_sy").value = syId;
        $.ajax({
            type: "GET",
            url: "grade/gradeschedManagement.php?id="+syLevelId+"&leveldesc="+level_desc,
            cache: false,
            success: function(html){
                $("#viewGradeScheduleContainer").empty(html);
                $("#viewGradeScheduleContainer").append(html);
            }
        });
    }


    function editData(sy_level_section_id){
        document.getElementById("sy_level_section_id").value = sy_level_section_id;
        var x = $("#sy_level_section_id").val();
        $.ajax({
            type: "GET",
            url: "section/getEditSYLevelSectionData.php?id="+x,
            cache: false,
            success: function(html){
                $("#editSectionsContainer").empty(html);
                $("#editSectionsContainer").append(html);
            }
        });
    }





    function confirmDelete(sy_level_section_id, syId) {
        if (confirm("Are you sure you want to delete")) {
            $.ajax({
                type: "GET",
                url: "section/deleteSectionFromSYLevel.php?sectionId="+sy_level_section_id+"&id="+syId,
                cache: false,
                success: function(html){
                    window.location.href= 'managesy.php?schoolYearID='+syId;
                }
            });
        }
    }

    $('#addSection').on('click', function(){
        var total=$('input[name="checklist_section[]"]:checked').length;
        if(total <= 0){
            alert("Please check at least 1 section before saving");
            event.preventDefault();
        }else{

        }
    });

</script>



</html>
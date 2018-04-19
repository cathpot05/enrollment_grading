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
        <div style="background-color:rgb(85,180,163); margin-bottom:10px;" class="panel">
            <div class="panel-heading">
                Level: '.$row["level"].'


                <div class="pull-right pull-right">
                <div class="dropdown">
                    <button style="padding:3px;"  class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" >
                        <span  class="fa fa-wrench fa-fw"></span> Manage Level <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        <li><a data-toggle="modal" data-target="#addExModal" onClick="passData('.$row["levelId_"].', \''.$level_desc.'\', '.$sylevelid.')"> <span class="fa fa-list fa-fw"></span>Add Section</a></li>
                        <li class="divider"></li>
                        <li><a data-toggle="modal" data-target="#addSubjectModal" onClick="subjData('.$row["levelId_"].', \''.$level_desc.'\', '.$sylevelid.')"> <span class="fa fa-book fa-fw"></span>Add Subjects</a></li>
                        <li><a data-toggle="modal" data-target="#viewSubjModal" onClick="viewSubject(\''.$level_desc.'\', '.$sylevelid.')"> <span class="fa fa-folder fa-fw"></span>View Subjects</a></li>
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
                            <tr>
                                <th>Section</th>
                                <th>Capacity</th>
                                <th>Adviser</th>
                                <th width=5%>Students</th>
                                <th width=5%>Grades</th>
                                <th width=5%>Edit</th>
                                <th width=5%>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
        ';
        $sql1 = "select B.ID, a.sy_ID, G.level, B.section_ID, B.teacher_ID,  B.capacity, D.section, CONCAT(F.Fname, ' ', F.Lname)as teacher
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
                    echo '<tr><td colspan="7" style="color: red"> NO DATA TO DISPLAY. ADD SECTION FOR THIS LEVEL.</td></tr>';
                }
                else{
                    echo '
                            <tr>
                                <td> '.$row1["section"].'</td>
                                <td> '.$row1["capacity"].'</td>
                                <td> '.$row1["teacher"].'</td>
                                <td><center><a href="viewStudentsEnrolled.php?sectionId='.$row1["ID"].' " target="_blank"><span id="icon" class="fa fa-users fa-fw"></a> </span></center></td>
                                <td><center><a href="viewStudentsGrade.php?sectionId='.$row1["ID"].' " target="_blank"><span id="icon" class="fa fa-th fa-fw"></span></a></center></td>
                                <td><center><span id="icon" class="fa fa-edit fa-fw" data-toggle="modal" data-target="#editModal" onClick="editData('.$row1["ID"].' )"> </span></center></td>
                                <td><center><span id="icon" class="fa fa-times fa-fw" data-toggle="modal" data-target="#deleteModal" onClick="confirmDelete('.$row1["ID"].', '.$schoolYearID.')"></span></center></td>
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
                <input type=hidden name=syLevelId id=syLevelId>
                <input type=hidden name=sy_Id id=sy_Id value="<?php echo $schoolYearID ;?>">
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


<div class="modal fade" id="addSubjectModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Add Subject</h4>
            </div>
            <form role="form" action="addSubjectPerSYLevel.php" method=post>
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
                <h4 class="modal-title" id="myModalLabel">Edit Section Info</h4>
            </div>
            <form role="form" action="editSectionPerSYLevel.php" method=post>
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
            <form role="form" action="gradeManagement.php" method=post>
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
    function passData(level_id, level_desc, syLevelId)
    //function passData(level_id)
    {
        document.getElementById("level_id").value = level_id;
        document.getElementById("level_desc").value = level_desc;
        document.getElementById("syLevelId").value = syLevelId;
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

    function subjData(level_id, level_desc, syLevelId)
    {
        document.getElementById("level_id_subj").value = level_id;
        document.getElementById("level_desc_subj").value = level_desc;
        document.getElementById("syLevelId_subj").value = syLevelId;
        var x = $("#level_id_subj").val();
        var y = $("#level_desc_subj").val();
      $.ajax({
            type: "GET",
            url: "getSubjectPerSYLevel.php?LevelId="+x+"&LevelDesc="+y+"&SY="+syLevelId+"&SY_cbo="+<?php echo $schoolYearID;?>,
            cache: false,
            success: function(html){
                $("#loadSubjectsContainer").empty(html);
                $("#loadSubjectsContainer").append(html);
            }
        });
    }


    //function viewSubject(sy_level_section_id, section){
    function viewSubject(level_desc, syLevelId){
       /* $.ajax({
            type: "GET",
            url: "viewSubjectSYLevel.php?id="+sy_level_section_id+"&section="+section,
            cache: false,
            success: function(html){
                $("#viewSubjectContainer").empty(html);
                $("#viewSubjectContainer").append(html);
            }
        });*/
        var syId = $("#cboSY").val();
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



    function schedData(level_desc, syLevelId){
        var syId = $("#cboSY").val();
        document.getElementById("grade_sy").value = syId;
        $.ajax({
            type: "GET",
            url: "gradeschedManagement.php?id="+syLevelId+"&leveldesc="+level_desc,
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
            url: "getEditSYLevelSectionData.php?id="+x,
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
                url: "deleteSectionFromSYLevel.php?sectionId="+sy_level_section_id+"&id="+syId,
                cache: false,
                success: function(html){
                    window.location.href= 'managesy.php?schoolYearID='+syId;
                }
            });
        }
    }

</script>



</html>
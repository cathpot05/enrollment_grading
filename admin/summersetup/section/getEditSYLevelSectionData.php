<?php
/**
 * Created by PhpStorm.
 * User: PB7N0062
 * Date: 4/17/18
 * Time: 10:28 AM
 */


include "../../../dbcon.php";
include "../../sessionAdmin.php";
$id=$_GET['id'];
?>
<!DOCTYPE html>
<html>

<?php
        $sql1 = "SELECT A.ID, B.subject, CONCAT(C.Fname, ', ', C.Lname) as teacher, C.Id as teacher_ID
        FROM summer_subject A
        INNER JOIN subject B ON A.subject_ID = B.ID
        INNER JOIN teacher C ON A.teacher_ID = C.ID
        INNER JOIN sy_level D ON A.sy_level_ID = D.ID
        where A.ID = $id";
$result1 = mysqli_query($con,$sql1);
if(mysqli_num_rows($result1)>0)
{
while($row1 = mysqli_fetch_array($result1))
{
    echo'
    <label>Subject:</label>
    <input type="text" name="sectionname_edit" class="form-control" value="'.$row1["subject"].'" disabled/>

    <label>Teacher:</label>
    <select class="form-control" name="cboAdviser_edit">';
    $sql_teacher = "SELECT ID, Concat(FName, ' ', LName) AS teacher_name FROM teacher";
    $result_teacher = mysqli_query($con,$sql_teacher);
    if(mysqli_num_rows($result_teacher)> 0)
    {
        while($row_teacher = mysqli_fetch_array($result_teacher))
        {
            $val = $row1["teacher_ID"];
            $selected = ($val == $row_teacher['ID'] ? 'selected="selected"' : '');
            echo '<option value ="' . $row_teacher['ID'] . '" '. $selected .'>' . $row_teacher['teacher_name'] . '</option>';
        }
    }

    echo'
    </select>
    ';
}
}
?>
<script type="text/javascript">

</script>


</html>
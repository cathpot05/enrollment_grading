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
$sql1 = "select B.ID, a.sy_ID, G.level, B.section_ID, B.teacher_ID,  B.capacity, D.section, CONCAT(F.Fname, ' ', F.Lname)as teacher
                from sy_level A
                inner join sy_level_section B on A.ID = b.sy_level_ID
                inner join section D ON B.section_ID = D.ID
                inner join teacher F on B.teacher_ID = F.ID
                inner join level G ON A.level_ID =  G.ID
                where B.ID=$id";
$result1 = mysqli_query($con,$sql1);
if(mysqli_num_rows($result1)>0)
{
while($row1 = mysqli_fetch_array($result1))
{
    echo'
    <label>Section:</label>
    <input type="text" name="sectionname_edit" class="form-control" value="'.$row1["section"].'" disabled/>

    <label>Capacity:</label>
    <input type="number" name="capacity_edit" class="form-control" value="'.$row1["capacity"].'"/>

    <label>Adviser:</label>
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
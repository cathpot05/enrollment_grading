<?php
/**
 * Created by PhpStorm.
 * User: Ms. Cath
 * Date: 4/22/18
 * Time: 10:36 PM
 */
include "../../dbcon.php";
$syId = $_GET['syId'];
$id = $_GET['type'];


$sql = 0;
if($id == 1)
{
    $sql = "Select CONCAT(E.LName, ', ', E.Fname, ' ' , E.Mname) as 'Student Name', F.subject AS Subject, G.grade AS Grade
			from sy A
			INNER JOIN sy_level B ON A.ID =B.sy_ID
			INNER JOIN summer_subject C ON B.ID =C.sy_level_ID
			INNER JOIN summer_enrolled D ON C.ID =D.summer_subject_ID
            INNER JOIN student E ON D.student_ID =  E.ID
            INNER JOIN subject F ON C.subject_ID = F.ID
            LEFT JOIN summer_grade G ON G.summer_subject_ID =  C.ID AND G.summer_enrolled_ID =  D.ID
            WHERE A.ID = $syId
            ORDER BY F.subject ASC";
}
else if($id == 2){
    $sql = "Select F.subject AS Subject, CONCAT(G.LName, ', ', G.Fname, ' ' , G.Mname) as 'Teacher Name'
			from sy A
			INNER JOIN sy_level B ON A.ID =B.sy_ID
			INNER JOIN summer_subject C ON B.ID =C.sy_level_ID
            INNER JOIN subject F ON C.subject_ID = F.ID
            INNER JOIN teacher G ON C.teacher_ID = G.ID
            WHERE A.ID = $syId
            ORDER BY F.subject ASC";
}
$result = mysqli_query($con,$sql);
?>
<div class="panel-body">
    <div class="table-responsive">
<?php

if(mysqli_num_rows($result)>0)
{
    ?>
    <table class="table table-hover" id="dataTables-example">
        <thead>
        <tr>
            <?php
            $colArr = array();
            while($col = mysqli_fetch_field($result))
            {
                ?>
                <th><?php echo str_replace('_',' ',$col->name); ?></th>
                <?php
                $colArr[] = $col->name;
            }

            ?>
        </tr>
        </thead>
        <tbody>
        <?php
        $colCount = mysqli_num_fields($result);
        while($row = mysqli_fetch_array($result))
        {
            ?>
            <tr>
                <?php
                for($i=0; $i<$colCount; $i++)
                {
                    ?>
                    <td><?php echo $row[$colArr[$i]]; ?></td>
                <?php
                }
                ?>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
    </div>
    </div>
<?php
}
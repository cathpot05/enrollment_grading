<?php
/**
 * Created by PhpStorm.
 * User: Ms. Cath
 * Date: 4/22/18
 * Time: 10:36 PM
 */
include "../../dbcon.php";
$level = $_GET['sylevel'];
$syId = $_GET['syId'];
$id = $_GET['type'];


$sql = 0;
if($id == 1)
{
    $sql = "SELECT CONCAT(C.Lname, ', ', C.Fname, ' ', C.Mname) as Name ,ZZ.level as 'Grade Level',
                                    (
                                    SELECT AVG(((X.q1 + X.q2 + X.q3 + X.q4)/4))
                                    FROM grade X
                                    WHERE X.enrolled_student_ID = B.enrolled_student_ID
                                    ) AS Grade_Average
									FROM enrolled_student A
									INNER JOIN grade B ON A.ID = B.enrolled_student_ID
									INNER JOIN student C ON A.student_ID = C.ID
									INNER JOIN sy_level_section D ON A.sy_level_section_ID = D.ID
									INNER JOIN sy_level E ON D.sy_level_ID =  E.ID
									INNER JOIN sy F ON E.sy_ID = F.ID
									INNER JOIN section AA ON D.section_ID = AA.ID
									INNER JOIN level ZZ ON E.level_ID = ZZ.ID
									WHERE F.ID = $syId AND E.ID = $level
                                     AND (B.q1+B.q2+B.q3+B.q4)/4 >=75
                                     GROUP BY A.ID
                            ORDER BY Grade_Average DESC  LIMIT 10";
}
else if($id == 2){
    $sql = "SELECT CONCAT(C.Lname, ', ', C.Fname, ' ', C.Mname) as Name ,ZZ.level as 'Grade Level',
                                    (
                                    SELECT AVG(((X.q1 + X.q2 + X.q3 + X.q4)/4))
                                    FROM grade X
                                    WHERE X.enrolled_student_ID = B.enrolled_student_ID
                                    ) AS Grade_Average
									FROM enrolled_student A
									INNER JOIN grade B ON A.ID = B.enrolled_student_ID
									INNER JOIN student C ON A.student_ID = C.ID
									INNER JOIN sy_level_section D ON A.sy_level_section_ID = D.ID
									INNER JOIN sy_level E ON D.sy_level_ID =  E.ID
									INNER JOIN sy F ON E.sy_ID = F.ID
									INNER JOIN section AA ON D.section_ID = AA.ID
									INNER JOIN level ZZ ON E.level_ID = ZZ.ID
									WHERE F.ID = $syId AND E.ID = $level
                                     AND (B.q1+B.q2+B.q3+B.q4)/4 < 75
                                     GROUP BY A.ID
                            ORDER BY Grade_Average DESC  LIMIT 10";
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
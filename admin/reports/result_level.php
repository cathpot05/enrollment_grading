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


    $header = urlencode("TOP 10 STUDENTS PER LEVEL");


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


    $header = urlencode("LIST OF FAILED STUDENTS PER LEVEL");
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
else if($id == 2){

    $header = urlencode("LIST OF FAILED STUDENTS PER LEVEL");
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

else if($id == 3){


    $header = urlencode("LIST OF SECTIONS PER YEAR LEVEL");

                $sql = "SELECT E.level as Grade_Level, D.section as Section
                        FROM sy A
                        INNER JOIN sy_level B ON A.ID = B.sy_ID
                        INNER JOIN sy_level_section C ON B.ID =  C.sy_level_ID
                        INNER JOIN section D ON C.section_ID = D.ID
                        INNER JOIN level E ON B.level_ID = E.ID
                        WHERE A.ID = $syId AND B.ID = $level
                        ORDER BY LEFT(A.schoolYear, 4) ASC, RIGHT(E.level, 2) ASC, D.section ASC";
}
else if($id == 4){


    $header = urlencode("LIST OF SUBJECTS PER YEAR LEVEL");
                $sql = "SELECT E.level as Grade_Level, G.subject as Subjects
                        FROM sy A
                        INNER JOIN sy_level B ON A.ID = B.sy_ID
                        INNER JOIN level E ON B.level_ID = E.ID
                        INNER JOIN sy_level_subject F ON F.sy_level_ID = B.ID
                        INNER JOIN subject G ON F.subject_ID = G.ID
                        WHERE A.ID = $syId AND B.ID = $level
                        ORDER BY LEFT(A.schoolYear, 4) ASC, RIGHT(E.level, 2) ASC
                        ";
}
$sqlPrint = urlencode($sql);
$result = mysqli_query($con,$sql);
?>
<div class="panel-body">
    <div style="float:right" id="icon"  onclick="printData('<?php echo $sqlPrint; ?>','<?php echo $header; ?>');">
        <span class="fa fa-print fa-fw" ></span> Print
    </div>
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

    <div class="modal fade" id="requestModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width:80%">
            <div id="printTable">
            </div>
        </div>
    </div>
    </div>
<?php
}
?>



<script type="text/javascript">

    function printData(sql,header)
    {

        var xhr;
        if (window.XMLHttpRequest) xhr = new XMLHttpRequest(); // all browsers
        else xhr = new ActiveXObject("Microsoft.XMLHTTP"); 	// for IE
        var url = '../printTable.php?sql='+sql+'&header='+header;

        xhr.open('GET', url, false);
        xhr.onreadystatechange = function () {
            document.getElementById("printTable").innerHTML = xhr.responseText;
            var divToPrint=document.getElementById("printTable");
            newWin= window.open("");
            newWin.document.write(divToPrint.outerHTML);
            newWin.print();
            newWin.close();
        }
        xhr.send();
        // ajax stop
        return false;
    }
</script>
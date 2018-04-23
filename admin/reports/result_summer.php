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

    $header = urlencode("LIST OF STUDENTS WITH SUMMER SUBJECTS");

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

    $header = urlencode("SUMMER OFFERED SUBJECTS");

    $sql = "Select F.subject AS Subject, CONCAT(G.LName, ', ', G.Fname, ' ' , G.Mname) as 'Teacher Name'
			from sy A
			INNER JOIN sy_level B ON A.ID =B.sy_ID
			INNER JOIN summer_subject C ON B.ID =C.sy_level_ID
            INNER JOIN subject F ON C.subject_ID = F.ID
            INNER JOIN teacher G ON C.teacher_ID = G.ID
            WHERE A.ID = $syId
            ORDER BY F.subject ASC";
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
}?>


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
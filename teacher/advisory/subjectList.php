<?php
include "../../dbcon.php";
include "../sessionTeacher.php";

$subjectID = $_GET['subjectID'];
$header = urlencode("Student Grade List");
?>
 <table class="table table-hover" id="dataTables-example">
    <thead>
        <tr>
			<th>Name</th>
            <th width=5%>1st Quarter</th>
			<th width=5%>2nd Quarter</th>
			<th width=5%>3rd Quarter</th>
			<th width=5%>4th Quarter</th>
			<th width=5%>Finals</th>
        </tr>
    </thead>
	<tbody>
	<?php
	$sql = "Select D.*,E.q1,E.q2,E.q3,E.q4,(E.q1+E.q2+E.q3+E.q4)/4 as final,C.ID as esID, A.ID as tssID 
			from teacher_section_subject A 
			INNER JOIN sy_level_section B ON A.sy_level_section_ID = B.ID
			INNER JOIN enrolled_student C ON C.sy_level_section_ID = B.ID
			INNER JOIN student D ON C.student_ID = D.ID
			LEFT JOIN grade E ON E.enrolled_student_ID = C.ID and E.teacher_section_subject_ID = A.ID 
			INNER JOIN sy_level_subject F ON A.sy_level_subject_ID = F.ID
			where B.teacher_ID = $teacherID AND F.ID = $subjectID";
			$sqlPrint = urlencode("Select CONCAT(D.Fname, ' ',D.Mname, ' ', D.Lname) as Name,
			E.q1 as 1st_Quarter,E.q2 as 2nd_Quarter,E.q3 as 3rd_Quarter ,E.q4 as 4th_Quarter,(E.q1+E.q2+E.q3+E.q4)/4 as Final 
			from teacher_section_subject A 
			INNER JOIN sy_level_section B ON A.sy_level_section_ID = B.ID
			INNER JOIN enrolled_student C ON C.sy_level_section_ID = B.ID
			INNER JOIN student D ON C.student_ID = D.ID
			LEFT JOIN grade E ON E.enrolled_student_ID = C.ID and E.teacher_section_subject_ID = A.ID 
			INNER JOIN sy_level_subject F ON A.sy_level_subject_ID = F.ID
			where B.teacher_ID = $teacherID AND F.ID = $subjectID");
			$result = mysqli_query($con,$sql);
			if(mysqli_num_rows($result)>0)
			{
				while($row = mysqli_fetch_array($result))
				{
				?>
					<tr>
						<td><?php echo $row['Fname']." ".$row['Mname']." ".$row['Lname']; ?></td>
						<td style="text-align:center" ><?php if($row['q1'] != null){ echo $row['q1']; }else { echo "-"; }?></td>
						<td  style="text-align:center"><?php if($row['q2'] != null){ echo $row['q2']; }else { echo "-"; } ?></td>
						<td style="text-align:center"><?php if($row['q3'] != null){ echo $row['q3']; }else { echo "-"; } ?></td>
						<td  style="text-align:center"><?php if($row['q4'] != null){ echo $row['q4']; }else { echo "-"; } ?></td>
						<td  style="text-align:center">
						<?php 
						if($row['final'] != null)
						{ 
							if($row['final']<70)
							{
								echo "<strong style='color:red'>".$row['final']."</strong>";
							}
							else
							{
								echo "<strong>".$row['final']."</strong>";
							}
						}
						else { echo "-"; } 
						?></td>
					</tr>
				<?php			
				}
			}
	?>
	</tbody>
</table>
<div style="float:left" id="icon"  onclick="printData('<?php echo $sqlPrint; ?>','<?php echo $header; ?>');">
<span class="fa fa-print fa-fw" ></span> Print
</div>

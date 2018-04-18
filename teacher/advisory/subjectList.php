<?php
include "../../dbcon.php";
include "../sessionTeacher.php";

$subjectID = $_GET['subjectID'];

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
	$sql = "Select D.*,E.q1,E.q2,E.q3,E.q4,E.final,C.ID as esID, A.ID as tssID 
			from teacher_section_subject A 
			INNER JOIN sy_level_section B ON A.sy_level_section_ID = B.ID
			INNER JOIN enrolled_student C ON C.sy_level_section_ID = B.ID
			INNER JOIN student D ON C.student_ID = D.ID
			LEFT JOIN grade E ON E.enrolled_student_ID = C.ID and E.teacher_section_subject_ID = A.ID 
			INNER JOIN sy_level_subject F ON A.sy_level_subject_ID = F.ID
			where B.teacher_ID = $teacherID AND F.ID = $subjectID";
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
						<td  style="text-align:center"><?php if($row['final'] != null){ echo $row['final']; }else { echo "-"; } ?></td>
					</tr>
				<?php			
				}
			}
	?>
	</tbody>
</table>

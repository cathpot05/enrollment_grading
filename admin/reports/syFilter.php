<?php
include "../../dbcon.php";
$id =$_GET['id'];

$sql = 0;
if($id == 1)
{
	$sql = "Select B.schoolYear as School_Year,  COUNT(DISTINCT(C.ID)) as Total_Section, COUNT(DISTINCT(E.ID)) as Total_Subject, COUNT(DISTINCT(D.ID)) as Total_Student
										from  sy B
										LEFT JOIN sy_level A ON A.sy_ID = B.ID
										LEFT JOIN sy_level_section C ON C.sy_level_ID = A.ID
										LEFT JOIN sy_level_subject E ON E.sy_level_ID = A.ID
										LEFT JOIN enrolled_student D ON D.sy_level_section_ID = C.ID
										GROUP BY B.ID";
}
else if($id == 2)
{
	$sql = "Select B.schoolYear as School_Year, AVG((G.q1+G.q2+G.q3+G.q4)/4)as General_Average
			from  sy B
			LEFT JOIN sy_level A ON A.sy_ID = B.ID
			LEFT JOIN sy_level_section C ON C.sy_level_ID = A.ID
			LEFT JOIN sy_level_subject E ON E.sy_level_ID = A.ID
			LEFT JOIN enrolled_student D ON D.sy_level_section_ID = C.ID
			LEFT JOIN teacher_section_subject F ON F.sy_level_section_ID = C.ID AND F.sy_level_subject_ID = E.ID
			LEFT JOIN grade G ON G.enrolled_student_ID = D.ID AND G.teacher_section_subject_ID = F.ID
			GROUP BY B.ID";
}
else if($id == 3)
{
	$sql = "Select B.schoolYear as School_Year, (Select COUNT((G1.q1+G1.q2+G1.q3+G1.q4)/4)
			from  sy B1
			LEFT JOIN sy_level A1 ON A1.sy_ID = B1.ID
			LEFT JOIN sy_level_section C1 ON C1.sy_level_ID = A1.ID
			LEFT JOIN sy_level_subject E1 ON E1.sy_level_ID = A1.ID
			LEFT JOIN enrolled_student D1 ON D1.sy_level_section_ID = C1.ID
			LEFT JOIN teacher_section_subject F1 ON F1.sy_level_section_ID = C1.ID AND F1.sy_level_subject_ID = E1.ID
			LEFT JOIN grade G1 ON G1.enrolled_student_ID = D1.ID AND G1.teacher_section_subject_ID = F1.ID
			WHERE ((G1.q1+G1.q2+G1.q3+G1.q4)/4) >= 75 AND B1.ID = B.ID 
            ) as Passed_Student,
			(Select COUNT((G2.q1+G2.q2+G2.q3+G2.q4)/4)
			from  sy B2
			LEFT JOIN sy_level A2 ON A2.sy_ID = B2.ID
			LEFT JOIN sy_level_section C2 ON C2.sy_level_ID = A2.ID
			LEFT JOIN sy_level_subject E2 ON E2.sy_level_ID = A2.ID
			LEFT JOIN enrolled_student D2 ON D2.sy_level_section_ID = C2.ID
			LEFT JOIN teacher_section_subject F2 ON F2.sy_level_section_ID = C2.ID AND F2.sy_level_subject_ID = E2.ID
			LEFT JOIN grade G2 ON G2.enrolled_student_ID = D2.ID AND G2.teacher_section_subject_ID = F2.ID
			WHERE ((G2.q1+G2.q2+G2.q3+G2.q4)/4) < 75 AND B2.ID = B.ID
            ) as Failed_Student
			from  sy B
			LEFT JOIN sy_level A ON A.sy_ID = B.ID
			LEFT JOIN sy_level_section C ON C.sy_level_ID = A.ID
			LEFT JOIN sy_level_subject E ON E.sy_level_ID = A.ID
			LEFT JOIN enrolled_student D ON D.sy_level_section_ID = C.ID
			LEFT JOIN teacher_section_subject F ON F.sy_level_section_ID = C.ID AND F.sy_level_subject_ID = E.ID
			LEFT JOIN grade G ON G.enrolled_student_ID = D.ID AND G.teacher_section_subject_ID = F.ID
			GROUP BY B.ID";
}
else if($id == 4)
{
	$sql = "";
}else if($id == 5)
{
	$sql = "";
}

$result = mysqli_query($con,$sql);
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
	<?php
}
<?php
include "../../dbcon.php";
$id =$_GET['id'];
$sySel = $_GET['sySel'];
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
	$sql = "Select A.schoolYear as School_Year, 
	(SELECT COUNT(C1.ID) from sy A1 
		INNER JOIN sy_level B1 ON A1.ID =B1.sy_ID 
		INNER JOIN summer_subject C1 ON B1.ID =C1.sy_level_ID
		INNER JOIN summer_enrolled D1 ON C1.ID =D1.summer_subject_ID	
		WHERE A1.ID = A.ID
	) as Total_Summer_Subjects,
	( SELECT COUNT(DISTINCT(D2.ID)) from sy A2 
		INNER JOIN sy_level B2 ON A2.ID =B2.sy_ID 
		INNER JOIN summer_subject C2 ON B2.ID =C2.sy_level_ID
		INNER JOIN summer_enrolled D2 ON C2.ID =D2.summer_subject_ID	
		WHERE A2.ID = A.ID 
	)as Total_Summer_Students 
			from sy A 
			INNER JOIN sy_level B ON A.ID =B.sy_ID 
			INNER JOIN summer_subject C ON B.ID =C.sy_level_ID
			INNER JOIN summer_enrolled D ON C.ID =D.summer_subject_ID
			GROUP BY A.ID";
}else if($id == 5)
{
	$sql = "Select B.ID,B.username, B.Fname, B.Lname, D.section, F.level 
			from enrolled_student A
			INNER JOIN student B ON A.student_ID = B.ID
			INNER JOIN sy_level_section C ON C.ID = A.sy_level_section_ID
			INNER JOIN section D ON D.ID = C.section_ID
			INNER JOIN sy_level E ON E.ID = C.sy_level_ID
			INNER JOIN level F ON F.ID = E.level_ID
 			where E.sy_ID = $sySel";
}
else if($id == 6)
{
$sql = "SELECT CONCAT(C.Lname, ', ', C.Fname, ' ', C.Mname) as Name ,AA.section AS Section,
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
									WHERE F.ID = $sySel
                                     AND (B.q1+B.q2+B.q3+B.q4)/4 >=75
                            GROUP BY A.ID
                            ORDER BY Grade_Average DESC";
}


$result = mysqli_query($con,$sql);

	?>
	<div class="panel-heading">
                             List of Student per School Year
							 <?php
							 if($id>=5)
							 {
										$sql2 = "SELECT *from sy";
										$result2 = mysqli_query($con,$sql2);
										if(mysqli_num_rows($result2)>0)
										{
											?>
											<select id="syStudent" style="float:right" onchange="syFilter(<?php echo $id; ?>,this.value);">
											<?php
											while($row2 = mysqli_fetch_array($result2))
											{
												?>
													<option value="<?php echo $row2['ID']; ?>" <?php if($sySel == $row2['ID']) echo "selected"; ?>> <?php echo $row2['schoolYear']; ?></option>
												<?php
											}
											?>
											</select>
											<?php
										}
							 }
											?>
							
                        </div>
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

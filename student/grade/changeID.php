<?php
include "../../dbcon.php";
include "../sessionStudent.php";
$id = $studentID;
$type =$_GET['actiontype'];
$genAVG=0;
$countSubject=0;
if($type=="printgrade"){
	
	$sql = "Select student.Lname,student.Fname from enrolled_student INNER JOIN student ON enrolled_student.student_ID = student.ID where student.ID=$id";
$result = mysqli_query($con,$sql);
if(mysqli_num_rows($result)>0)
{
	while($row = mysqli_fetch_array($result))
	{
		$username=$row['Fname']." ".$row['Lname'];
	}
}
	?>
	
	<table border=1>
	
	<tr>
	<h2><?php echo $username;  ?>'s Grades</h2>
	</tr>
                                    
                                        <tr>
                                            <th>Subject</th>
											<th>Teacher</th>
											<th width=5%>1st Quarter</th>
											<th width=5%>2nd Quarter</th>
											<th width=5%>3rd Quarter</th>
											<th width=5%>4th Quarter</th>
											<th width=5%>Finals</th>
										
                                        </tr>
                                
                                    
									<?php
									$sql = "Select subject.subject, sy_section_subject.ID, teacher.Lname,teacher.Fname,teacher.Mname from sy_section_subject 
											JOIN sy_section ON  sy_section_subject.sy_section_ID=sy_section.ID  
											JOIN section ON sy_section.section_ID = section.ID
											JOIN enrolled_student ON  sy_section.ID=enrolled_student.sy_section_ID  
											JOIN subject ON sy_section_subject.subject_ID = subject.ID
											JOIN teacher ON sy_section_subject.teacher_ID = teacher.ID
											where enrolled_student.ID = $id AND enrolled_student.student_ID = $id";
									$result = mysqli_query($con,$sql);
									if(mysqli_num_rows($result)>0)
									{
										while($row = mysqli_fetch_array($result))
										{	
										?>
											<tr>
                                            <td><?php echo $row['subject']; ?></td>
											<?php $mid = $row['Mname'];?>
											<td><?php echo $row['Lname'].", ".$row['Fname']." ".$mid[0]."." ?></td>
											
											<?php
											$sssID = $row['ID'];
											$sql2 = "SELECT *from grade where enrolled_student_ID = $id AND sy_section_subject_ID = $sssID";
											$result2 = mysqli_query($con,$sql2);
											if(mysqli_num_rows($result2)>0)
											{
												while($row2 = mysqli_fetch_array($result2))
												{	
													?>
													
													<td><?php echo round($row2['q1'], 2, PHP_ROUND_HALF_UP); ?></td>
													<td><?php echo round($row2['q2'], 2, PHP_ROUND_HALF_UP); ?></td>
													<td><?php echo round($row2['q3'], 2, PHP_ROUND_HALF_UP); ?></td>
													<td><?php echo round($row2['q4'], 2, PHP_ROUND_HALF_UP); ?></td>
													<td><strong><font color=<?php if($row2['final']<75)echo "red";?> ><?php echo round($row2['final'], 2, PHP_ROUND_HALF_UP); ?></font><strong></td>
													
													<?php
													$genAVG += $row2['final'];
												}
											}
											else
											{
												?>
													
													<td>0</td>
													<td>0</td>
													<td>0</td>
													<td>0</td>
													<td><strong>0<strong></td>
													
													<?php
											}
											?>
											
											</tr>
											
										<?php
										$countSubject++;
										
										}
										
									}
									if($genAVG != 0)
									{
									$totalAVG=$genAVG/$countSubject;
									}
									else
									{
										$totalAVG=0;
									}
									?>
 
                                    
									                                      <tr>
									   <td></td>
									   <td></td>
									   <td></td>
									   <td colspan="3"><h4>Gen AVG:</h4></td>
									   <td><font color=<?php if($totalAVG<75)echo "red";?>><h4><?php echo round($totalAVG, 2, PHP_ROUND_HALF_UP); ?></font></h4></td>
									   </tr>
                                </table>
	
	
	<?php
	
	
	
}
?>
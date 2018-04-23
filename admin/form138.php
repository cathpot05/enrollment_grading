<?php
include "../dbcon.php";

$id = $_GET['id'];


$sqlInfo = "SELECT B.*, E.schoolYear FROM enrolled_student A 
INNER JOIN student B ON A.student_ID = B.ID 
INNER JOIN sy_level_section C ON A.sy_level_section_ID = C.ID
INNER JOIN sy_level D ON C.sy_level_ID = D.ID
INNER JOIN sy E ON D.sy_ID = E.ID
where A.ID = $id";
$resultInfo = mysqli_query($con,$sqlInfo);
$rowInfo = mysqli_fetch_array($resultInfo);

?>
	<center>
						<br>
						
							<h3><strong>PRUDECIA D. FULE MEMORIAL NATIONAL HIGH SCHOOL</strong></h3>
								<i>Brgy. San Nicolas, San Pablo City</i>
								<br>
								<br>	 
								</center>
								
								
<table width=100%>	
	<tr>
		<td width=8.33%></td>
		<td width=8.33%></td>
		<td width=8.33%></td>
		<td width=8.33%></td>
		<td width=8.33%></td>
		<td width=8.33%></td>
		<td width=8.33%></td>
		<td width=8.33%></td>
		<td width=8.33%></td>
		<td width=8.33%></td>
		<td width=8.33%></td>
		<td width=8.33%></td>		
	</tr>	
	<tr>
		<td colspan=8 ></td>
		<td colspan=1>LRN : </td>
		<td colspan=3 align=center style="border-bottom: thin solid #000000"><?php echo $rowInfo['LRN']; ?></td>
	</tr>
	<tr>
		<td colspan=4 align=center style="border-bottom: thin solid #000000"><?php echo $rowInfo['Lname']; ?></td>
		<td colspan=4 align=center style="border-bottom: thin solid #000000"><?php echo $rowInfo['Fname']; ?></td>
		<td colspan=4 align=center style="border-bottom: thin solid #000000"><?php echo $rowInfo['Mname']; ?></td>
	</tr>
	<tr>
	<td colspan =4 align=center>Surname</td>
		<td colspan =4 align=center>First Name</td>
		<td colspan =4 align=center>Middle Name</td>
	</tr>
	<tr>
		<td colspan=1>Sex : </td>
		<td colspan=4 style="border-bottom: thin solid #000000" align=center><?php echo $rowInfo['gender']; ?></td>
		<td colspan=1>Birthday</td>
		<td colspan=6 style="border-bottom: thin solid #000000" align=center><?php echo date("F d, Y",strtotime($rowInfo['birthdate'])); ?></td>
	</tr>
	<tr>
		<td colspan=1>Address</td>
		<td colspan=11 style="border-bottom: thin solid #000000" align=center ><?php echo $rowInfo['address']; ?></td>
	</tr>
	<tr>
		<td colspan = 2>School Year</td>
		<td colspan = 4 style="border-bottom: thin solid #000000" align=center><?php echo $rowInfo['schoolYear']; ?></td>
		<td colspan=2></td>
		<td colspan = 2>General Average</td>
		<td colspan = 2 style="border-bottom: thin solid #000000" align=center><?php echo $rowInfo['average']; ?></td>
	</tr>
</table>	
<br>		
<table width=100% border=1 style="border-collapse: collapse;">
    <thead>
		<tr>
			<td>Classified as:</td>
			<td colspan=7 ><strong> School: <br> School Year: </strong> </td>
		</tr>
        <tr>
			<th>Curriculumn</th>
			<th>Areas of Learning</th>
			<th width=5%>1st</th>
			<th width=5%>2nd</th>
			<th width=5%>3rd</th>
			<th width=5%>4th</th>
			<th width=5%>Finals</th>
			<th width=15%>Remarks</th>
        </tr>
    </thead>
	<tbody>
	
		<?php
		$sql = "SELECT G.subject,F.q1,F.q2,F.q3,F.q4, (F.q1+F.q2+F.q3+F.q4)/4 as finals 
				from sy_level_subject A
				INNER JOIN sy_level B ON A.sy_level_ID = B.ID
				INNER JOIN sy_level_section C ON C.sy_level_ID = B.ID
				INNER JOIN enrolled_student D ON D.sy_level_section_ID = C.ID
				INNER JOIN teacher_section_subject E ON E.sy_level_subject_ID = A.ID
				LEFT JOIN grade F ON F.enrolled_student_ID = D.ID AND F.teacher_section_subject_ID = E.ID
				INNER JOIN subject G ON A.subject_ID = G.ID
				WHERE D.ID = $id";
				
		$result = mysqli_query($con,$sql);
		if(mysqli_num_rows($result)>0)
		{
			?>
			<tr>
				<td rowspan=<?php echo mysqli_num_rows($result) + 1; ?> >K12</td>
			</tr>
			<?php
			while($row = mysqli_fetch_array($result))
			{
				?>
					<tr>
						<td>
							<?php echo $row['subject']; ?>
						</td>
						<td>
							<?php if($row['q1']==null) echo "NG"; else echo $row['q1']; ?>
						</td>
						<td>
							<?php if($row['q2']==null) echo "NG"; else echo $row['q2']; ?>
						</td>
						<td>
							<?php if($row['q3']==null) echo "NG"; else echo $row['q3']; ?>
						</td>
						<td>
							<?php if($row['q4']==null) echo "NG"; else echo $row['q4']; ?>
						</td>
						<td>
							<?php  echo $row['finals']; ?>
						</td>
						<td>
							 <?php
							if($row['finals']<75)
							{
								echo "<strong style='color:red' >Failed</strong>";
								
								
							}
							else
							{
								echo "<strong >Passed</strong>";
								
							}
							
							?>
						</td>
					</tr>
				<?php
			}
		}
		
		?>
	</tbody>
</table>
<br>

										<table width=100% border=1 style="border-collapse: collapse;">
											<thead>
											<tr>
											<th></th>
											<th>Jun</th>
											<th>Jul</th>
											<th>Aug</th>
											<th>Sept</th>
											<th>Oct</th>
											<th>Nov</th>
											<th>Dec</th>
											<th>Jan</th>
											<th>Feb</th>
											<th>Mar</th>
											<th>Total</th>
											</tr>
											</thead>
											<tbody>
											<tr>
											<td>No. of school days</td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											
											</tr>
											<tr>
											<td>No. of days present</td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											
											</tr>
											<tr>
											<td>No. of days absent</td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											
											</tr>
											</tbody>
										</table>
									   </td>
									   </tr>
									   <tr>
									   <td>
									   <table width=100%>
										<tr>
												<td width=25%>Has advanced unit in: </td>
												<td colspan=3>_______________________________________</td>
												<td></td>
												<td></td>
												</tr>
												<tr>
												<td>Has lacked unit in: </td>
												<td colspan=3>_______________________________________</td>
												<td></td>
												<td width=20%>____________________</td>
												</tr>
												<tr>
												<td>No. of years in school: </td>
												<td>______</td>
												<td width=10%>To be classified as: </td>
												<td align=center>_____________</td>
												<td></td>
												<td align=center>Adviser</td>
									   </tr>
									   </table>
									   </td>
									   </tr>
        </table>
	<br><br><br>
	<center><i>****************************** Nothing Follows ******************************</i></center>
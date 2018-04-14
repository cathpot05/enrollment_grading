
<?php
header("Refresh:5;");
include "../../dbcon.php";
$id = $_GET['postID'];
$type =$_GET['actiontype'];
	$schoolYearID = $_GET['schoolYearID'];
if($type=="delete"){
?>
										<form role="form" action="deleteSectionFromSY.php?sy_section=<?php echo $id; ?>&schoolYearID=<?php echo $schoolYearID; ?>" method=post id=delForm>
                                        <div class="modal-body">
										Are you sure you want to delete?
                                        </div>
                                        <div class="modal-footer">
											<button type="submit" class="btn btn-primary">Yes</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                            
                                        </div>
										</form>

<?php
}
else if($type=="edit")
{
	$sql = "Select section.year, section.section,section.ID from sy_section JOIN section ON sy_section.section_ID = section.ID where sy_section.ID=$id";
	$result = mysqli_query($con,$sql);
	if(mysqli_num_rows($result)>0)
	{
		
		while($row = mysqli_fetch_array($result))
		{	
			?>
			<form role="form" action="editSectionOfSY.php?sectionID=<?php echo $row['ID']; ?>&schoolYearID=<?php echo $schoolYearID; ?>" method=post>
            <div class="modal-body">
			<label>Year</label>
			<select  class="form-control" name="year">
				<option value="1"<?php if($row['year']==1){ echo "selected"; }?>>1st</option>
				<option value="2"<?php if($row['year']==2){ echo "selected"; }?>>2nd</option>
				<option value="3"<?php if($row['year']==3){ echo "selected"; }?>>3rd</option>
				<option value="4"<?php if($row['year']==4){ echo "selected"; }?>>4th</option>
			
			</select>
			<label>Section</label>
			<input type=text class="form-control" name=section value=<?php echo $row['section']; ?>>
				<?php
			}
			?>
			</div>
			<div class="modal-footer">
			<button type="submit" class="btn btn-primary">Save</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
														
			</div>
			</form>
			<?php
		}
	
}
else if($type == "subject")
{
	
	$sql = "Select section.year, section.section from sy_section JOIN section ON sy_section.section_ID = section.ID where sy_section.ID=$id";
$result = mysqli_query($con,$sql);
if(mysqli_num_rows($result)>0)
{
	while($row = mysqli_fetch_array($result))
	{
		$Sectionname=$row['year']."-".$row['section'];
	}
}


	?>
	<div class="panel panel-default" >
                        <div class="panel-heading">
                           <div class=row>
                                            <div class="col-lg-10"><h4 class="modal-title" id="myModalLabel"><?php echo $Sectionname; ?> Subjects</h4></div>
											<div class="col-lg-2">
											<div>
														<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addSubjectModal" onclick="changeID(<?php echo $id; ?>,'addSubject');">
															Add Subjects
														</button>
											</div>
                            
									</div>
									</div>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
							<div class="table-bordered">
                                <table class="table table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Subject Code</th>
											<th>Subject Name</th>
											<th>Teacher</th>
											<th width=5%>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									$sql = "Select sy_section_subject.ID, subject.code, subject.subject,teacher.Lname,teacher.Fname,teacher.Mname from sy_section_subject JOIN subject ON sy_section_subject.subject_ID = subject.ID JOIN sy_section ON sy_section_subject.sy_section_ID = sy_section.ID JOIN teacher ON sy_section_subject.teacher_ID = teacher.ID  where sy_section_subject.sy_section_ID=$id";
									$result = mysqli_query($con,$sql);
									if(mysqli_num_rows($result)>0)
									{
										while($row = mysqli_fetch_array($result))
										{	
										?>
											<tr>
                                            <td><?php echo $row['code']; ?></td>
											<td><?php echo $row['subject']; ?></td>
											<?php $mid = $row['Mname'];?>
											<td><?php echo $row['Lname'].", ".$row['Fname']." ".$mid[0]."." ?></td>
											<td></center><span id="icon" class="fa fa-times fa-fw" data-toggle="modal" data-target="#removeSubjectModal" onclick="changeID(<?php echo $row['ID']; ?>,'removeSubject');"></span></center></td>
											
											</tr>
										<?php
										}
									}
									
									?>
                                       
                                    </tbody>
                                </table>
								</div>
								<br>
								<button class="btn btn-primary btn-md" onclick="changeID('<?php echo $id; ?>','printsysectionsubject');">Print Report</button>
							
						
                            </div>
                            
                        </div>
                    </div>
	
	<?php
}
else if($type == "addSubject")
{
	?>
										<form role="form" action="addSubjectToSection.php?sy_section=<?php echo $id; ?>&schoolYearID=<?php echo $schoolYearID; ?>" method=post>
                                        <div class="modal-body">
										<label>Select Subject
										</label>
										<select  class="form-control" name="subject">
										<?php
											echo $sql = "Select *from subject where ID not in (select subject_ID from sy_section_subject where sy_section_subject.sy_section_ID=$id)";
											$result = mysqli_query($con,$sql);
											if(mysqli_num_rows($result)>0)
											{
												while($row = mysqli_fetch_array($result))
												{
													?>
													<option value="<?php echo $row['ID']; ?>"><?php echo $row['subject'];?></option>
													<?php
												}
											}
											?>
										</select>
										
										<label>Select Teacher
										</label>
										<select  class="form-control" name="teacher">
										<?php
											echo $sql = "Select *from teacher";
											$result = mysqli_query($con,$sql);
											if(mysqli_num_rows($result)>0)
											{
												while($row = mysqli_fetch_array($result))
												{
													$mid = $row['Mname'];?>
													<option value="<?php echo $row['ID']; ?>"><?php echo $row['Lname'].", ".$row['Fname']." ".$mid[0]."." ?></option>
													<?php
												}
											}
											?>
										</select>
										
										
                                        </div>
                                        <div class="modal-footer">
											<button type="submit" class="btn btn-primary">Save</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            
                                        </div>
										</form>
										<?php

}
else if($type=="removeSubject")
{
	
	?>
	<form role="form" action="removeSubjectFromSection.php?sy_section_subject=<?php echo $id; ?>&schoolYearID=<?php echo $schoolYearID; ?>" method=post id=delForm>
                                        <div class="modal-body">
										Are you sure you want to remove subject?
                                        </div>
                                        <div class="modal-footer">
											<button type="submit" class="btn btn-primary">Yes</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                            
                                        </div>
										</form>
	
	
	<?php
}

else if($type=="student")
{
	
		$sql = "Select section.year, section.section from sy_section JOIN section ON sy_section.section_ID = section.ID where sy_section.ID=$id";
$result = mysqli_query($con,$sql);
if(mysqli_num_rows($result)>0)
{
	while($row = mysqli_fetch_array($result))
	{
		$Sectionname=$row['year']."-".$row['section'];
	}
}

	
	?>
	<div class="panel panel-default">
                        <div class="panel-heading">
                           <div class=row>
                                            <div class="col-lg-10"><h4 class="modal-title" id="myModalLabel"><?php echo $Sectionname; ?> Students</h4></div>
											<div class="col-lg-2">
											<div>
														<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addStudentModal" onclick="changeID(<?php echo $id; ?>,'addStudent');">
															Add Students
														</button>
											</div>
                            
									</div>
									</div>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
							<div class="table-bordered">
                                <table class="table table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
											<th width=5%>Move</th>
											<th width=5%>Drop</th>
											<th width=5%>Remove</th>
											
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									$sql = "Select enrolled_student.ID, student.Lname, student.Fname, student.Mname, enrolled_student.status from enrolled_student JOIN student ON enrolled_student.student_ID = student.ID where sy_section_ID = $id";
									$result = mysqli_query($con,$sql);
			
									if(mysqli_num_rows($result)>0)
									{
										while($row = mysqli_fetch_array($result))
										{	
										?>
											<tr>
                                            <td><?php if($row['status']==1){echo "<del style=color:red>";}?><?php echo $row['Lname'].", ".$row['Fname']." ".$row['Mname']; ?></font></td>
											<td><center><span id="icon" class="fa fa-exchange fa-fw" data-toggle="modal" data-target="#transferStudentModal" onclick="changeID(<?php echo $row['ID']; ?>,'transferStudent');"></span></center></td>
											
											<?php  if($row['status']==0){  ?><td><center><span id="icon" class="fa fa-minus fa-fw" data-toggle="modal" data-target="#dropStudentModal" onclick="changeID(<?php echo $row['ID']; ?>,'dropStudent');"></span></center></td><?php }else{ echo "<td></td>"; }  ?>
											
											<td><center><span id="icon" class="fa fa-times fa-fw" data-toggle="modal" data-target="#removeStudentModal" onclick="changeID(<?php echo $row['ID']; ?>,'removeStudent');"></span></center></td>
											
											</tr>
										<?php
										}
									}
									
									?>
                                    </tbody>
                                </table>
								</div>
								<br>
								<button class="btn btn-primary btn-md" onclick="changeID('<?php echo $id; ?>','printsysectionstudent');">Print Report</button>
                            </div>
                            
                        </div>
							
                    </div>
	
	
	<?php
	
	
}

else if($type=="addStudent")
{
	?>
	<form role="form" action="addStudentToSection.php?sy_section=<?php echo $id; ?>&schoolYearID=<?php echo $schoolYearID; ?>" method=post>
                                        <div class="modal-body">
										<label>Select Student
										</label>
										<select  class="form-control" name="student">
										<?php
										echo $sql = "Select *from sy_section where ID = $id";
											$result = mysqli_query($con,$sql);
											if(mysqli_num_rows($result)>0)
											{
												while($row = mysqli_fetch_array($result))
												{
													$syID=$row['sy_ID'];
													echo $sql2 = "Select *from student where ID not in (select enrolled_student.student_ID from enrolled_student JOIN sy_section ON enrolled_student.sy_section_ID = sy_section.ID where sy_section.sy_ID=$syID)";
													$result2 = mysqli_query($con,$sql2);
													if(mysqli_num_rows($result2)>0)
													{
														while($row2 = mysqli_fetch_array($result2))
														{
															?>
															<option value="<?php echo $row2['ID']; ?>"><?php echo $row2['Lname'].", ".$row2['Fname']." ".$row2['Mname']; ?></option>
															<?php
														}
													}
												}
											}
											?>
										</select>
                                        </div>
                                        <div class="modal-footer">
											<button type="submit" class="btn btn-primary">Save</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            
                                        </div>
										</form>
										<?php
	
	
}

else if($type=="dropStudent")
{
	?>
	<form role="form" action="dropStudentFromSection.php?enrolled_student=<?php echo $id; ?>&schoolYearID=<?php echo $schoolYearID; ?>" method=post id=delForm>
                                        <div class="modal-body">
										Are you sure you want to Drop Students?
                                        </div>
                                        <div class="modal-footer">
											<button type="submit" class="btn btn-primary">Yes</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                            
                                        </div>
										</form>
	
	
	<?php
	
	
}
else if($type=="removeStudent")
{
	
	?>
	<form role="form" action="removeStudentFromSection.php?enrolled_student=<?php echo $id; ?>&schoolYearID=<?php echo $schoolYearID; ?>" method=post id=delForm>
                                        <div class="modal-body">
										Are you sure you want to remove Students?
                                        </div>
                                        <div class="modal-footer">
											<button type="submit" class="btn btn-primary">Yes</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                            
                                        </div>
										</form>
	
	
	<?php
}
else if($type=="transferStudent")
{
	?>
	<form role="form" action="transferStudentToSection.php?schoolYearID=<?php echo $schoolYearID; ?>&id=<?php echo $id; ?>" method=post>
                                        <div class="modal-body">
										<label>Select Section
										</label>
										<select  class="form-control" name="sysection">
										<?php
											echo $sql = "Select section.year, section.section,sy_section.ID from sy_section INNER JOIN section ON sy_section.section_ID = section.ID where sy_section.sy_ID = $schoolYearID";
											$result = mysqli_query($con,$sql);
											if(mysqli_num_rows($result)>0)
											{
												while($row = mysqli_fetch_array($result))
												{
													?>
													<option value="<?php echo $row['ID']; ?>"><?php echo $row['year']."-".$row['section'];?></option>
													<?php
												}
											}
											?>
										</select>
										
                                        </div>
                                        <div class="modal-footer">
											<button type="submit" class="btn btn-primary">Save</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            
                                        </div>
										</form>
	<?php
	
	
}





else if($type == "grade")
{
	
	$sql = "Select section.year, section.section from sy_section JOIN section ON sy_section.section_ID = section.ID where sy_section.ID=$id";
$result = mysqli_query($con,$sql);
if(mysqli_num_rows($result)>0)
{
	while($row = mysqli_fetch_array($result))
	{
		$Sectionname=$row['year']."-".$row['section'];
	}
}


	?>
	<div class="panel panel-default" >
                        <div class="panel-heading">
                           <div class=row>
                                            <div class="col-lg-10"><h4 class="modal-title" id="myModalLabel"><?php echo $Sectionname; ?> grades</h4></div>
											<div class="col-lg-2">
                            
									</div>
									</div>
                        </div>
                        <div class="panel-body">
                            <div class="table-bordered">
                                <table class="table table-hover" id="dataTables-example">
                                    <thead>
                                        <?php
										$sysectionsubject = array();
										$sql = "Select subject.subject,sy_section_subject.ID from sy_section_subject JOIN subject ON sy_section_subject.subject_ID = subject.ID JOIN sy_section ON sy_section_subject.sy_section_ID = sy_section.ID JOIN teacher ON sy_section_subject.teacher_ID = teacher.ID  where sy_section_subject.sy_section_ID=$id";
										$result = mysqli_query($con,$sql);
										if(mysqli_num_rows($result)>0)
										{
											?>
											<tr>
											<th>Student</th>
											<?php
											while($row = mysqli_fetch_array($result))
											{	
											?>
												
												<th><?php echo $row['subject']; ?></th>
												
											<?php
												array_push($sysectionsubject,$row['ID']);
											}
											?>
											<th width=5%>Print</th>
											</tr>
											<?php
										}
										
										?>
                                    </thead>
                                    <tbody>
									<?php
									$sql2 = "Select enrolled_student.ID, student.Lname, student.Fname, student.Mname, enrolled_student.status from enrolled_student JOIN student ON enrolled_student.student_ID = student.ID where enrolled_student.sy_section_ID = $id";
									$result2 = mysqli_query($con,$sql2);
			
									if(mysqli_num_rows($result2)>0)
									{
										while($row2 = mysqli_fetch_array($result2))
										{	
										?>
											<tr>
                                            <td><?php if($row2['status']==1){echo "<del style=color:red>";}?><?php echo $row2['Lname'].", ".$row2['Fname']." ".$row2['Mname']; ?></font></td>
											<?php
											$studID = $row2['ID'];
											for($sys=0;$sys<count($sysectionsubject);$sys++){
												$syssec = $sysectionsubject[$sys];
											$sql3 = "SELECT grade.final from grade where enrolled_student_ID = $studID AND sy_section_subject_ID=$syssec";
											$result3 = mysqli_query($con,$sql3);
											if(mysqli_num_rows($result3)>0)
											{
												while($row3 = mysqli_fetch_array($result3))
												{	
													
													?>
													<td><strong><font color=<?php if($row3['final']<75)echo "red";?> ><?php echo round($row3['final'], 2, PHP_ROUND_HALF_UP); ?></font><strong></td>
													<?php

												}
												
											}
											else
											{
												?>
												<td><strong>0</strong></td>
													<?php
											}
											}
											?>
											<td><span id="icon" class="fa fa-print" data-toggle="modal" onclick="changeID('<?php echo $studID; ?>','printstudentgrade');"></span></td>
											</tr>
										<?php
										}
									}
									
									?>
                                       
                                    </tbody>
                                </table>
								

							
						
                            </div>
							<br>
							<button class="btn btn-primary btn-md" onclick="changeID('<?php echo $id; ?>','printsysectiongrade');">Print Report</button>
                            
                        </div>
                    </div>
	
	<?php
}
else if($type=='printsysection')
{
	
	$sql = "Select *from sy where ID=$schoolYearID";
	$result = mysqli_query($con,$sql);
	if(mysqli_num_rows($result)>0)
	{
		while($row = mysqli_fetch_array($result))
		{
			$SYname=$row['schoolYear'];
		}
	}
	
	?>
	<center>
	<table border=1 width=80%>
	<tr>
		<h2><?php echo $SYname; ?> Sections</h2>
	<tr>
	<tr>

		<th>Section</th>
		<th>No. of Students</th>
		<th>No. of Subjects</th>
	</tr>

	<?php
									$sql = "Select sy_section.ID,section.year, section.section from sy_section JOIN section ON sy_section.section_ID = section.ID where sy_section.sy_ID = $schoolYearID";
									$result = mysqli_query($con,$sql);
									if(mysqli_num_rows($result)>0)
									{
										while($row = mysqli_fetch_array($result))
										{	
									?>
											<tr>
                                            <td><?php echo $row['year']."-".$row['section']; ?></td>
											<?php
											$sysectionID=$row['ID'];
										$sql2 = "Select count(student_ID) as noStud from enrolled_student where sy_section_ID = $sysectionID";
										$result2 = mysqli_query($con,$sql2);
										while($row2 = mysqli_fetch_array($result2))
										{
											

											?>
											
											<td><?php echo $row2['noStud'];?></td>	
											
											<?php
										}
										$sql3 = "Select count(subject_ID) as noSub from sy_section_subject where sy_section_ID = $sysectionID ";
										$result3 = mysqli_query($con,$sql3);
										while($row3 = mysqli_fetch_array($result3))
										{
											

											?>
											
											<td><?php echo $row3['noSub'];?></td>	
											
											<?php
										}
										?>
										
											</tr>
										<?php
										}
									}
									
									?>
	

	</table>
	

	<?php
	}
	else if($type=='printsysectionstudent')
	{
		$sql = "Select section.year, section.section from sy_section JOIN section ON sy_section.section_ID = section.ID where sy_section.ID=$id";
		$result = mysqli_query($con,$sql);
		if(mysqli_num_rows($result)>0)
		{
			while($row = mysqli_fetch_array($result))
			{
				$Sectionname=$row['year']."-".$row['section'];
			}

		}
		
		?>
		<center>
		<table border=1>
		<tr><h2><?php echo $Sectionname; ?> Students</h2></tr>

                                        <tr>
                                            <th>Name</th>
										<tr>
									<?php
									$sql = "Select enrolled_student.ID, student.Lname, student.Fname, student.Mname, enrolled_student.status from enrolled_student JOIN student ON enrolled_student.student_ID = student.ID where sy_section_ID = $id";
									$result = mysqli_query($con,$sql);
			
									if(mysqli_num_rows($result)>0)
									{
										while($row = mysqli_fetch_array($result))
										{	
										?>
											<tr>
                                            <td><?php if($row['status']==1){echo "<del style=color:red>";}?><?php echo $row['Lname'].", ".$row['Fname']." ".$row['Mname']; ?></font></td>
											
											</tr>
										<?php
										}
									}
									
									?>
                                  
                                </table>
		
		
		
		<?php
		
			
	}
	else if($type=='printsysectionsubject')
	{
			$sql = "Select section.year, section.section from sy_section JOIN section ON sy_section.section_ID = section.ID where sy_section.ID=$id";
			$result = mysqli_query($con,$sql);
			if(mysqli_num_rows($result)>0)
			{
				while($row = mysqli_fetch_array($result))
				{
					$Sectionname=$row['year']."-".$row['section'];
				}
			}
			
			?>
			<center>
			<table border=1>
                                  <tr>
								  <h2><?php echo $Sectionname; ?> Subjects</h2>
								  </tr>
                                        <tr>
                                            <th>Subject Code</th>
											<th>Subject Name</th>
											<th>Teacher</th>
											
                                        </tr>
                                    
                                   
									<?php
									$sql = "Select sy_section_subject.ID, subject.code, subject.subject,teacher.Lname,teacher.Fname,teacher.Mname from sy_section_subject JOIN subject ON sy_section_subject.subject_ID = subject.ID JOIN sy_section ON sy_section_subject.sy_section_ID = sy_section.ID JOIN teacher ON sy_section_subject.teacher_ID = teacher.ID  where sy_section_subject.sy_section_ID=$id";
									$result = mysqli_query($con,$sql);
									if(mysqli_num_rows($result)>0)
									{
										while($row = mysqli_fetch_array($result))
										{	
										?>
											<tr>
                                            <td><?php echo $row['code']; ?></td>
											<td><?php echo $row['subject']; ?></td>
											<?php $mid = $row['Mname'];?>
											<td><?php echo $row['Lname'].", ".$row['Fname']." ".$mid[0]."." ?></td>
											
											
											</tr>
										<?php
										}
									}
									
									?>
                                       
                                    
                                </table>

			<?php
			
		
		
	}
	else if($type == 'printsysectiongrade')
	{
		
		
			$sql = "Select section.year, section.section from sy_section JOIN section ON sy_section.section_ID = section.ID where sy_section.ID=$id";
			$result = mysqli_query($con,$sql);
			if(mysqli_num_rows($result)>0)
			{
				while($row = mysqli_fetch_array($result))
				{
					$Sectionname=$row['year']."-".$row['section'];
				}
			}
		
		
		
		
		
		
		?>
		<center>
		<table border=1>
		<tr><h2><?php echo $Sectionname; ?> Grades </h2>
		</tr>
                                        <?php
										$sysectionsubject = array();
										$sql = "Select subject.subject,sy_section_subject.ID from sy_section_subject JOIN subject ON sy_section_subject.subject_ID = subject.ID JOIN sy_section ON sy_section_subject.sy_section_ID = sy_section.ID JOIN teacher ON sy_section_subject.teacher_ID = teacher.ID  where sy_section_subject.sy_section_ID=$id";
										$result = mysqli_query($con,$sql);
										if(mysqli_num_rows($result)>0)
										{
											?>
											<tr>
											<th>Student</th>
											<?php
											while($row = mysqli_fetch_array($result))
											{	
											?>
												
												<th><?php echo $row['subject']; ?></th>
												
											<?php
												array_push($sysectionsubject,$row['ID']);
											}
											?>
											</tr>
											<?php
										}
										
										?>


									<?php
									$sql2 = "Select enrolled_student.ID, student.Lname, student.Fname, student.Mname, enrolled_student.status from enrolled_student JOIN student ON enrolled_student.student_ID = student.ID where enrolled_student.sy_section_ID = $id";
									$result2 = mysqli_query($con,$sql2);
			
									if(mysqli_num_rows($result2)>0)
									{
										while($row2 = mysqli_fetch_array($result2))
										{	
										?>
											<tr>
                                            <td><?php if($row2['status']==1){echo "<del style=color:red>";}?><?php echo $row2['Lname'].", ".$row2['Fname']." ".$row2['Mname']; ?></font></td>
											<?php
											$studID = $row2['ID'];
											for($sys=0;$sys<count($sysectionsubject);$sys++){
												$syssec = $sysectionsubject[$sys];
											$sql3 = "SELECT grade.final from grade where enrolled_student_ID = $studID AND sy_section_subject_ID=$syssec";
											$result3 = mysqli_query($con,$sql3);
											if(mysqli_num_rows($result3)>0)
											{
												while($row3 = mysqli_fetch_array($result3))
												{	
													
													?>
													<td><strong><font color=<?php if($row3['final']<75)echo "red";?> ><?php echo round($row3['final'], 2, PHP_ROUND_HALF_UP); ?></font><strong></td>
													<?php

												}
												
											}
											else
											{
												?>
												<td><strong>0</strong></td>
													<?php
											}
											}
											?>
											</tr>
										<?php
										}
									}
									
									?>
                                       

                                </table>
		
		
		<?php
		
		
		
	}
	
	else if($type == 'printstudentgrade')
	{
		
		
		$countSubject=0;
$genAVG=0;
$Lname="";
$Fname="";
$Mname="";
$bday = "";
$schoolYear = "";
$gender = "";
$generalAVG = "";
			$sql = "Select student.Lname,student.Fname,student.Mname,student.address,student.bday,sy.schoolYear,student.gender,student.genAvg from enrolled_student 
							JOIN student ON enrolled_student.student_ID = student.ID 
							JOIN sy_section ON enrolled_student.sy_section_ID  = sy_section.ID 
							JOIN sy ON sy_section.sy_ID = sy.ID 
							where enrolled_student.ID = $id";
			$result = mysqli_query($con,$sql);
			if(mysqli_num_rows($result)>0)
			{
				while($row = mysqli_fetch_array($result))
				{
					$Lname=$row['Lname'];
					$Fname=$row['Fname'];
					$Mname=$row['Mname'];
					$bday = $row['bday'];
					$schoolYear = $row['schoolYear'];
					$gender = $row['gender'];
					$generalAVG = $row['genAvg'];
					
				}
			}
		
		
		
		
		
		
		?>
		<center>
		<table width=90%>
		<tr>
		<td>
		<table width=100%>
		<tr>
		<td>
		<table>
		<tr>
		<td width=33%></td>
		<td width=33%></td>
		<td width=33%>LRN: ______________________</td>
		</tr>
		<tr>
			<td align=center style="border-bottom: thin solid #000000"><?php echo $Lname; ?></td>
			<td align=center style="border-bottom: thin solid #000000"><?php echo $Fname; ?></td>
			<td align=center style="border-bottom: thin solid #000000"><?php echo $Mname; ?></td>
		</tr>
		<tr>
		<td align=center>Surname</td>
		<td align=center>First Name</td>
		<td align=center>Middle Name</td>
		</tr>
		</table>
		</td>
		</tr>
		<tr>
		<td>
		<table width=100%>
		<tr>
		<td>Sex:</td>
		<td style="border-bottom: thin solid #000000" align=center><?php echo $gender; ?></td>
		<td>Birthday:</td>
		<td colspan=3 style="border-bottom: thin solid #000000" align=center><?php echo date("F d, Y",strtotime($bday)); ?></td>
		</tr>
		<tr>
			<td colspan=6>Birth Place: ________________________________________________________________________</td>
		</tr>
		<tr>
			<td  colspan=6> Intermediate Course Completed (School): ________________________________________________</td>
		</tr>
		<tr>
		<td>School Year:</td> 
		<td style="border-bottom: thin solid #000000" align=center> <?php echo $schoolYear; ?></td>
		<td align=center>Gen AVG: </td>
		<td width=15% style="border-bottom: thin solid #000000" align=center ><?php echo $generalAVG; ?></td>
		<td colspan=2>Total no. of yrs to finish Elem: _______________</td>
		</tr>
		</table>
		</td>
		</tr>
		</table>
		</td>
		</tr>
		<tr>
		</tr>
		<tr>
		
		<td>
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
									$sql = "Select subject.subject, sy_section_subject.ID from sy_section_subject 
											JOIN sy_section ON  sy_section_subject.sy_section_ID=sy_section.ID  
											JOIN section ON sy_section.section_ID = section.ID
											JOIN enrolled_student ON  sy_section.ID=enrolled_student.sy_section_ID  
											JOIN subject ON sy_section_subject.subject_ID = subject.ID
											where enrolled_student.ID = $id";
									$result = mysqli_query($con,$sql);
									if(mysqli_num_rows($result)>0)
									{
										$numRows = mysqli_num_rows($result);
										$cc=0;
										while($row = mysqli_fetch_array($result))
										{	
										?>
											<tr>
											<?php 
											if($cc==0)
											{
												?>
												<td rowspan=<?php echo $numRows; ?> ><span>K to 12</span></td>
												<?php
												$cc=1;
												
											}
											
											?>
                                            <td><?php echo $row['subject']; ?></td>
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
													<td><font color=<?php if($row2['final']<75)echo "red";?> ><?php if($row2['final']<75){echo "Failed";} else {echo "Passed";}?></font></td>
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
													<td>Not Graded</td>
													
													<?php
											}
											?>
											
											</tr>
											
										<?php
										$countSubject++;
										
										}
										
									}
									$totalAVG=$genAVG/$countSubject;
									?>
 
                                   
									   <tr>
									   <td colspan="7" align=right >Geneneral Average:</td>
									   <td align=center><font color=<?php if($totalAVG<75)echo "red";?>  ><?php echo round($totalAVG, 2, PHP_ROUND_HALF_UP); ?></font></td>
									   </tr>
									    </tbody>
									   </table>
									   </td>
									   </tr>
									   <tr>
									   <td>
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

		<?php
		
		
		
	}
	else if($type=="all"){
	?>
	<div class="panel panel-default">
                        <div class="panel-heading">
                           <div class=row>
                                    <div class="col-lg-10"><h4 class="modal-title" id="myModalLabel"> Request to Edit Grades</h4></div>
											
									</div>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
							<div class="table-bordered">
                                <table class="table table-bordered" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Student</th>
											<th>Subject</th>
											<th>1st Qtr</th>
											<th>2nd Qtr</th>
											<th>3rd Qtr</th>
											<th>4th Qtr</th>
											<th>Final</th>
											<th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									$sql = "Select grade_actions.ID, student.Lname, student.Fname, subject.subject, grade_actions.q1 as tq1 , grade_actions.q2 as tq2, grade_actions.q3 as tq3, grade_actions.q4 as tq4, grade_actions.final as tfinal,grade.q1 , grade.q2, grade.q3, grade.q4, grade.final  from grade_actions 
											INNER JOIN grade ON grade_actions.grade_ID = grade.ID
											INNER JOIN enrolled_student ON grade.enrolled_student_ID = enrolled_student.ID
											INNER JOIN student ON enrolled_student.student_ID = student.ID
											INNER JOIN sy_section_subject ON grade.sy_section_subject_ID = sy_section_subject.ID
											INNER JOIN subject ON sy_section_subject.subject_ID = subject.ID
											WHERE grade_actions.status = 0 ORDER BY grade_actions.Date DESC ";
									$result = mysqli_query($con,$sql);
			
									if(mysqli_num_rows($result)>0)
									{
										while($row = mysqli_fetch_array($result))
										{	
											
												
										?>
											<tr <?php if($row['ID']==$id){ echo "bgcolor=#ffe6e6"; }?>>
												<td><?php echo $row['Lname'].", ".$row['Fname']; ?></td>
												<td><?php echo $row['subject']; ?></td>
												<td><?php echo $row['tq1']."(".$row['q1'].")"; ?></td>
												<td><?php echo $row['tq2']."(".$row['q2'].")"; ?></td>
												<td><?php echo $row['tq3']."(".$row['q3'].")"; ?></td>
												<td><?php echo $row['tq4']."(".$row['q4'].")"; ?></td>
												<td><?php echo $row['tfinal']."(".$row['final'].")"; ?></td>
												<td>
													<a href="approveRequest.php?id=<?php echo $row['ID']; ?>&schoolYearID=<?php echo $schoolYearID; ?>"><button type="button" class="btn btn-primary btn-xs">Approve</button></a>
													<a href="rejectRequest.php?id=<?php echo $row['ID']; ?>&schoolYearID=<?php echo $schoolYearID; ?>"><button type="button" class="btn btn-danger btn-xs" href=#>Reject</button></a>
												</td>
											</tr>
										<?php
										}
									}
									
									?>
                                    </tbody>
                                </table>
								</div>
								<br>
								
                            </div>
                            
                        </div>
							
                    </div>
	
	<?php
}
?>
	

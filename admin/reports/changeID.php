<?php
include "../../dbcon.php";
$type =$_GET['actiontype'];
$sySel = $_GET['sySel'];
if($type == 'sy')
{
	?>
		<div class="row">
			<div class="col-lg-6">
				<div class="form-inline" >
				<label class="control-label"> Filter</label>
						<select id="sySelFilter" class="form-control" style="width:90%" onchange="syFilter(this.value,<?php echo $sySel; ?>);">
						<option value="1">Yearly Report</option>
						<option value="2">Yearly Student Average</option>
						<option value="3">Passed/Failed Student Report</option>
						<option value="4">Summer Subjects and Enrolled Student</option>
						<option value="5">Enrolled Students per School Year</option>
						<option value="6">Top Student per School Year</option>
					</select>
				</div>
			</div>
			<div class="col-lg-6">
				
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-lg-12">
				
				<div class="panel panel-default">	
				<div id=syFilterTable >
							  <div class="panel-heading">
                             List of School Year
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
											<th>School Year</th>
                                            <th>Total Section</th>
											<th>Total Subject</th>
											<th>Total Student</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php
										$sql = "Select B.schoolYear, COUNT(DISTINCT(D.ID)) as totalStudent, COUNT(DISTINCT(C.ID)) as totalSection, COUNT(DISTINCT(E.ID)) as totalSubject 
										from  sy B
										LEFT JOIN sy_level A ON A.sy_ID = B.ID
										LEFT JOIN sy_level_section C ON C.sy_level_ID = A.ID
										LEFT JOIN sy_level_subject E ON E.sy_level_ID = A.ID
										LEFT JOIN enrolled_student D ON D.sy_level_section_ID = C.ID
										GROUP BY B.ID";
										$result = mysqli_query($con,$sql);
										if(mysqli_num_rows($result)>0)
										{
											while($row = mysqli_fetch_array($result))
											{	
											?>
												<tr>
												<td><?php echo $row['schoolYear']; ?></td>
												<td><?php echo $row['totalSection']; ?></td>
												<td><?php echo $row['totalSubject']; ?></td>
												<td><?php echo $row['totalStudent']; ?></td>
												</tr>
											<?php
											}
										}
										?>
                                    </tbody>
                                </table>
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
			</div>
			</div>
		</div>
	<?php
	
}
else if($type == 'student')
{
	?>
			<div class="row">
			<div class="col-lg-6">
				<div class="form-inline" >
				<label class="control-label"> Filter</label>
					<select name="sySel" class="form-control" style="width:90%" onchange="syStudent(this.value,<?php echo $sySel; ?>);">
						<option value="1">Student List per School Year</option>
						<option value="2">Top Student per School Year</option>
						<option value="2">Top Student per Year Level</option>
						<option value="2">Top Student per Section</option>
					</select>
				</div>
			</div>
			<div class="col-lg-6">
				
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-lg-12">
				
				<div class="panel panel-default">
                        <div class="panel-heading">
                             List of Students
							 <select id="syStudent" style="float:right">
								<?php
										$sql = "SELECT *from sy";
										$result = mysqli_query($con,$sql);
										if(mysqli_num_rows($result)>0)
										{
											while($row = mysqli_fetch_array($result))
											{
												?>
													<option value="<?php echo $row['ID']; ?>" <?php if($sySel == $row['ID']) echo "selected"; ?>> <?php echo $row['schoolYear']; ?></option>
												<?php
											}
										}
											?>
							 </select>
                        </div>
                        <div class="panel-body">
							<div class="table-responsive">
							<div id=syFilterTable >
                                <table class="table table-hover" id="dataTables-example">
                                    <thead>
										<tr>
											<th>Name</th>
											<th>Year Level</th>
											<th>Section`</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$sql = "Select B.ID,B.username, B.Fname, B.Lname, D.section, F.level 
										from enrolled_student A
										INNER JOIN student B ON A.student_ID = B.ID
										INNER JOIN sy_level_section C ON C.ID = A.sy_level_section_ID
										INNER JOIN section D ON D.ID = C.section_ID
										INNER JOIN sy_level E ON E.ID = C.sy_level_ID
										INNER JOIN level F ON F.ID = E.level_ID
 										where E.sy_ID = $sySel";
										
										$result = mysqli_query($con,$sql);
										if(mysqli_num_rows($result)>0)
										{
											while($row = mysqli_fetch_array($result))
											{	
											?>
												<tr>
													<td><?php echo $row['Fname']." ".$row['Lname']; ?></td>
													<td><?php echo $row['level']; ?></td>
													<td><?php echo $row['section']; ?></td>
												</tr>
											<?php
											}
										}
										?>
                                    </tbody>
                                </table>
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
			</div>
			</div>
		</div>
	<?php
}
else if($type == 'teacher')
{
	?>
	
	<?php
}
else if($type == 'section')
{
	?>
	
	<?php
}
else if($type == 'subject')
{
	?>
	
	<?php
}

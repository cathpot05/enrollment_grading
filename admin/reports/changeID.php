<?php
include "../../dbcon.php";
$type =$_GET['actiontype'];

if($type == 'sy')
{
	?>
		<div class="row">
			<div class="col-lg-6">
				<div class="form-inline" >
				<label class="control-label"> Filter</label>
					<select name="sySel" class="form-control" style="width:90%" onchange="syFilter(this.value);">
						<option value="1">Yearly Report</option>
						<option value="2">Yearly Student Average</option>
						<option value="3">Passed/Failed Student Report</option>
						<option value="4">Summer Enrolled Student</option>
						<option value="5">Summer Subject Offered</option>
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
                             List of School Year
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
							<div id=syFilterTable >
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

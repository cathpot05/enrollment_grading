<?php
include "../../dbcon.php";
$id = $_GET['postID'];
$type =$_GET['actiontype'];

if($type=="delete"){
    echo $id;
}
else if($type=="edit")
{
	$sql = "Select *from section where ID=$id";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($result);	
			
			?>
			<form role="form" action="editSection.php?id=<?php echo $id; ?>" method=post>
            <div class="modal-body">
				<label>Year</label>
				<select class="form-control" name="year">
				<?php
					$sql2 = "Select *from level ORDER BY RIGHT(level,2) ASC";
					$result2 = mysqli_query($con,$sql2);
					if(mysqli_num_rows($result2)>0)
					{
						while($row2 = mysqli_fetch_array($result2))
						{
						?>
							<option value="<?php echo $row2['ID']; ?>" <?php if($row['level_id'] == $row2['ID']) echo "Selected";  ?>><?php echo $row2['level']; ?></option>
						<?php
						}
					}
						?>	
				</select>
				<label>Section</label>
				<input type=text class="form-control" name="section" value="<?php echo $row['section']; ?>">
			</div>
			<div class="modal-footer">
			<button type="submit" class="btn btn-primary">Save</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>										
			</div>
			</form>
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
													<a href=approveRequest.php?id=<?php echo $row['ID']; ?>><button type="button" class="btn btn-primary btn-xs">Approve</button></a>
													<a href=rejectRequest.php?id=<?php echo $row['ID']; ?>><button type="button" class="btn btn-danger btn-xs" href=#>Reject</button></a>
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
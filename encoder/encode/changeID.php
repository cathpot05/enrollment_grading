<?php
include "../../dbcon.php";
$id = $_GET['postID'];
$type =$_GET['actiontype'];

if($type=="delete"){
    echo $id;
}
else if($type=="password"){
	
    $sql = "Select *from student where ID=$id";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($result);
	?>
		<form role="form" action="changePassword.php?id=<?php echo $id; ?>" method=post>
			<div class="modal-body">
				<label>Username</label>	
				<input type=text class="form-control" name="username" value="<?php echo $row['username']; ?>" required>
				<label>New Password</label>	
				<input type=password class="form-control"  name="newPassword" id="newPasswordText"  onkeyup="requirePassword()">
				<label>Confirm New Password</label>	 
				<input type=password class="form-control"  name="newPassword2" id="newPassword2Text" onkeyup="requirePassword()">
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Save</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			</div>
		</form>
	<?php
	
}
else if($type=="edit")
{			
			?>
			<form role="form" action="editStudent.php?id=<?php echo $id; ?>" method=post>
            <div class="modal-body">
			
			<?php
			
			$sql = "Select *from student where ID=$id";
			$result = mysqli_query($con,$sql);
			while($row = mysqli_fetch_array($result))
			{
				$bday = date($row['bday']);   
				?>
				
                                        <div class="modal-body">
										<label>Username</label>	
										<input type=text class="form-control" name="username" value="<?php echo $row['username']; ?>" required>
										<label>Last Name</label>	
										<input type=text class="form-control" name="Lname" value="<?php echo $row['Lname']; ?>" required>
										<label>First Name</label>	
										<input type=text class="form-control" name="Fname" value="<?php echo $row['Fname']; ?>" required>
										<label>Middle Name</label>	
										<input type=text class="form-control" name="Mname" value="<?php echo $row['Mname']; ?>" required>
										<label>Address</label>	
										<input type=text class="form-control" name="address" value="<?php echo $row['address']; ?>" required>
										<label>Religion</label>	
										<input type=text class="form-control" name="religion" value="<?php echo $row['religion']; ?>" required>
										<label>Phone No.</label>	
										<input type=text class="form-control" name="phoneNo" value="<?php echo $row['phoneNo']; ?>" required>
										<label>Birthday</label>	
										<input type=date class="form-control" name="bday" value="<?php echo $bday; ?>" required>
										<label>Age</label>	
										<input type=number class="form-control" name="age" value="<?php echo $row['age']; ?>" required>
										<div class="form-group">
										<label>Gender</label>
                                        <div class="radio">
                                                <label>
                                                    <input type="radio" name="gender" id="optionsRadios1" value="Male" <?php if($row['gender']=="Male")echo "checked";?> >Male
                                                </label>
                                            </div>	
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="gender" id="optionsRadios2" value="Female" <?php if($row['gender']=="Female")echo "checked";?> >Female
                                                </label>
                                            </div>
										</div>
										<label>General Avg.</label>	
										<input type=number step="0.01" class="form-control" name="genAvg" value="<?php echo $row['genAvg']; ?>" required>
                                        </div>
										
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
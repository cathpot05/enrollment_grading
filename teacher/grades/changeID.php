<?php
include "../../dbcon.php";
include "../sessionTeacher.php";
$id = $_GET['postID'];
$type =$_GET['actiontype'];
$sy_section_subjectID = $_GET['sy_section_subjectID'];
if($type=="grade"){
$sql2 = "SELECT *from grade where ID = $id";
											$result2 = mysqli_query($con,$sql2);
											if(mysqli_num_rows($result2)>0)
											{
												while($row2 = mysqli_fetch_array($result2))
												{	
?>
			<form role="form" action="editGrade.php?id=<?php echo $id; ?>&sy_section_subjectID=<?php echo $sy_section_subjectID;?>" method=post>
            <div class="modal-body">
			<div class=row>
				<div class="col-md-3">
				<label>1st Qtr</label>
				<input type=number step="0.01" class="form-control" min="50" name=q1 value=<?php echo $row2['q1'];?> max=100>
				</div>
				<div class="col-md-3">
				<label>2nd Qtr</label>
				<input type=number step="0.01" class="form-control" min="50" name=q2 value=<?php echo $row2['q2'];?> max=100>
				</div>
				<div class="col-md-3">
				<label>3rd Qtr</label>
				<input type=number step="0.01" class="form-control" min="50" name=q3 value=<?php echo $row2['q3'];?> max=100>
				</div>
				<div class="col-md-3">
				<label>4th Qtr</label>
				<input type=number step="0.01" class="form-control" min="50" name=q4 value=<?php echo $row2['q4'];?> max=100>
				</div>
			</div>
			</div>
			<div class="modal-footer">
			<button type="submit" class="btn btn-primary">Save</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
														
			</div>
			</form>
			<?php
												}
											}

}
else if($type=="grade2")
{
	$sssID = $_GET['sssID'];
			
			
			?>
			<form role="form" action="addGrade.php?esID=<?php echo $id; ?>&sssID=<?php echo $sssID; ?>&sy_section_subjectID=<?php echo $sy_section_subjectID; ?>" method=post>
            <div class="modal-body">
			<div class=row>
				<div class="col-md-3">
				<label>1st Qtr</label>
				<input type=number step="0.01" class="form-control" name=q1 value=0 max=100 min=50/>
				</div>
				<div class="col-md-3">
				<label>2nd Qtr</label>
				<input type=number step="0.01" class="form-control" name=q2 value=0 max=100 min=50/>
				</div>
				<div class="col-md-3">
				<label>3rd Qtr</label>
				<input type=number step="0.01" class="form-control" name=q3 value=0 max=100 min=50/>
				</div>
				<div class="col-md-3">
				<label>4th Qtr</label>
				<input type=number step="0.01" class="form-control" name=q4 value=0 max=100 min=50/>
				</div>
			</div>
			</div>
			<div class="modal-footer">
			<button type="submit" class="btn btn-primary">Save</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
														
			</div>
			</form>
			<?php
		
	
}
else if($type=="printgrade")
{
	?>
	 <table border=1>
                                 
                                        <tr>
                                            <th>Name</th>
											<th width=5%>1st Quarter</th>
											<th width=5%>2nd Quarter</th>
											<th width=5%>3rd Quarter</th>
											<th width=5%>4th Quarter</th>
											<th width=5%>Finals</th>
											
                                        </tr>
                               
									<?php
									$sql = "Select student.Lname, student.Fname, student.Mname, enrolled_student.ID,enrolled_student.status from sy_section_subject 
											JOIN sy_section ON  sy_section_subject.sy_section_ID=sy_section.ID  
											JOIN section ON sy_section.section_ID = section.ID
											JOIN enrolled_student ON  sy_section.ID=enrolled_student.sy_section_ID  
											JOIN student ON enrolled_student.student_ID = student.ID
											where sy_section_subject.ID = $id AND sy_section_subject.teacher_ID = $teacherID";
									$result = mysqli_query($con,$sql);
									if(mysqli_num_rows($result)>0)
									{
										while($row = mysqli_fetch_array($result))
										{	
										?>
											<tr>
                                            <td><?php if($row['status']==1){echo "<del style=color:red>";}?><?php echo $row['Lname'].", ".$row['Fname']." ".$row['Mname']; ?></td>
											
											<?php
											$esID = $row['ID'];
											$sql2 = "SELECT *from grade where enrolled_student_ID = $esID AND sy_section_subject_ID = $id";
											$result2 = mysqli_query($con,$sql2);
											if(mysqli_num_rows($result2)>0)
											{
												while($row2 = mysqli_fetch_array($result2))
												{	
													?>
													<div>
													<td><?php echo round($row2['q1'], 2, PHP_ROUND_HALF_UP); ?></td>
													<td><?php echo round($row2['q2'], 2, PHP_ROUND_HALF_UP); ?></td>
													<td><?php echo round($row2['q3'], 2, PHP_ROUND_HALF_UP); ?></td>
													<td><?php echo round($row2['q4'], 2, PHP_ROUND_HALF_UP); ?></td>
													<td><strong><font color=<?php if($row2['final']<75)echo "red";?>><?php echo round($row2['final'], 2, PHP_ROUND_HALF_UP); ?></font><strong></td>
													</div>
													<?php
												}
											}
											else
											{
												?>
													<div>
													<td>0</td>
													<td>0</td>
													<td>0</td>
													<td>0</td>
													<td><strong>0<strong></td>
													</div>
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



?>
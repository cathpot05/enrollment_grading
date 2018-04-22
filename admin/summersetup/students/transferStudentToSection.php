<?php
include "../../../dbcon.php";
include "../../sessionAdmin.php";
$stud_enrollID = $_POST['stud_enrollID'];
$sectionId = $_POST['sectionId'];
$transferTo = $_POST['cboSection'];
 $sql_sec2 = "
                                         SELECT A.*
											FROM sy_level_section A
											WHERE A.ID = $transferTo
                                        ";
                                        $result_sec2 = mysqli_query($con,$sql_sec2);
                                        if(mysqli_num_rows($result_sec2)> 0)
                                        {
                                            while($row_sec = mysqli_fetch_array($result_sec2))
                                            {
												$capacity = $row_sec['capacity'];
											}
										}

	 $sql_sec3 = "
	 SELECT COUNT(A.ID) as cnt
		FROM enrolled_student A
		WHERE A.sy_level_section_ID = $transferTo
	";
	$result_sec3 = mysqli_query($con,$sql_sec3);
	if(mysqli_num_rows($result_sec2)> 0)
	{
		while($row_sec3 = mysqli_fetch_array($result_sec3))
		{
			$cnt = $row_sec3['cnt'];
		}
	}
	
	if($capacity == $cnt){
		echo "<script type='text/javascript'>alert('Unable to transfer. Capacity for chosen section is full.');
		window.location.href='viewStudentsEnrolled.php?sectionId=".$sectionId."';
		 </script>";
		//header("Location:viewStudentsEnrolled.php?sectionId=".$sectionId."");
	}
	else{
	
	 $sql2 = "UPDATE enrolled_student SET sy_level_section_ID = '$transferTo' where ID=$stud_enrollID";
	$result2 = mysqli_query($con,$sql2);



        $username='';
        $sqlAdmin = "Select *from admin where ID=$adminID";
        $resultAdmin = mysqli_query($con,$sqlAdmin);
        if(mysqli_num_rows($resultAdmin)>0)
        {
            while($rowAdmin = mysqli_fetch_array($resultAdmin))
            {
                $username=$rowAdmin['username'];
            }
        }



        $sql3 = "INSERT INTO log(user,userType,logType) VALUES('$username','Admin','Transfer Student in Summer Subject Per SY')";
        $result23 = mysqli_query($con,$sql3);

	header("Location:viewStudentsEnrolled.php?sectionId=".$sectionId."");
}

	
?>
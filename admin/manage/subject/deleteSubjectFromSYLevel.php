<?php
/**
 * Created by PhpStorm.
 * User: Ms. Cath
 * Date: 4/18/18
 * Time: 12:08 AM
 */


include "../../../dbcon.php";
$id = $_GET['id'];

echo $sql = "DELETE FROM sy_level_subject where ID=$id ";
$result = mysqli_query($con,$sql);

?>
<?php
/**
 * Created by PhpStorm.
 * User: Ms. Cath
 * Date: 4/21/18
 * Time: 12:29 PM
 */

include "../../dbcon.php";
include "../sessionAdmin.php";
$id = $_GET['id'];


 $sql = "DELETE FROM teacher_section_subject where ID=$id";
$result = mysqli_query($con,$sql);
echo '<script>window.history.back()</script>';





<?php
function __backup_mysqli_database($params)
{
	$mtables = array();
    //$mtables = array("admin", "student", "sy", "section", "teacher", "sy_section", "enrolled_student", "sy_section_subject", "grade", "grade_action", "log"); 
	$mtables[] = "admin"; 
	$mtables[] = "student"; 
	$mtables[] = "sy"; 
	$mtables[] = "section"; 
	$mtables[] = "teacher"; 
	$mtables[] = "subject"; 
	$mtables[] = "enrolled_student"; 
	$mtables[] = "grade"; 
	$mtables[] = "grade_actions"; 
	$mtables[] = "log"; 
	$mtables[] = "grade_sched"; 
	$mtables[] = "level"; 
	$mtables[] = "summer_enrolled"; 
	$mtables[] = "summer_grade"; 
	$mtables[] = "summer_grade_sched"; 
	$mtables[] = "summer_subject"; 
	$mtables[] = "sy_level"; 
	$mtables[] = "sy_level_section"; 
	$mtables[] = "teacher_section_subject";
	$mtables[] = "encoder"; 	
	$contents = "-- Database: `".$params['db_to_backup']."` --\n";
    
    $mysqli = new mysqli($params['db_host'], $params['db_uname'], $params['db_password'], $params['db_to_backup']);
    if ($mysqli->connect_error) {
        die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
    }
    
  /*  $results = $mysqli->query("SHOW TABLES");
    
    while($row = $results->fetch_array()){
        if (!in_array($row[0], $params['db_exclude_tables'])){
            $mtables[] = $row[0];
        }
    }
	*/

    foreach($mtables as $table){
        $contents .= "-- Table `".$table."` --\n";
        $results = $mysqli->query("SHOW CREATE TABLE ".$table);
        while($row = $results->fetch_array()){
           $contents .= $row[1].";\n\n";
        }

        $results = $mysqli->query("SELECT * FROM ".$table);
        $row_count = $results->num_rows;
        $fields = $results->fetch_fields();
        $fields_count = count($fields);
        
        $insert_head = "INSERT INTO `".$table."` (";
        for($i=0; $i < $fields_count; $i++){
            $insert_head  .= "`".$fields[$i]->name."`";
                if($i < $fields_count-1){
                        $insert_head  .= ', ';
                    }
        }
        $insert_head .=  ")";
        $insert_head .= " VALUES\n";        
                
        if($row_count>0){
            $r = 0;
            while($row = $results->fetch_array()){
                if(($r % 400)  == 0){
                    $contents .= $insert_head;
                }
                $contents .= "(";
                for($i=0; $i < $fields_count; $i++){
                    $row_content =  str_replace("\n","\\n",$mysqli->real_escape_string($row[$i]));
                    
                    switch($fields[$i]->type){
                        case 8: case 3:
                            $contents .=  $row_content;
                            break;
                        default:
                            $contents .= "'". $row_content ."'";
                    }
                    if($i < $fields_count-1){
                            $contents  .= ', ';
                        }
                }
                if(($r+1) == $row_count || ($r % 400) == 399){
                    $contents .= ");\n\n";
                }else{
                    $contents .= "),\n";
                }
                $r++;
            }
        }
    }
    
    if (!is_dir ( $params['db_backup_path'] )) {
            mkdir ( $params['db_backup_path'], 0777, true );
     }
    
    $backup_file_name = "enrollment_db-backup-".date( "d-m-Y--h-i-s").".sql";
         
    $fp = fopen($backup_file_name ,'w+');
    if (($result = fwrite($fp, $contents))) {
        echo "Backup file created '--$backup_file_name' ($result)"; 
    }
    fclose($fp);
}


$para = array(
    'db_host'=> 'localhost',  //mysql host
    'db_uname' => 'root',  //user
    'db_password' => '', //pass
    'db_to_backup' => 'enrollment_db', //database name
    'db_backup_path' => '/DatabaseBackup/', //where to backup
    'db_exclude_tables' => array('wp_comments','wp_w3tc_cdn_queue') //tables to exclude
);
__backup_mysqli_database($para);
?>

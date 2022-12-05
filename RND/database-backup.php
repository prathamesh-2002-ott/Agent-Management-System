<?php

// Database configuration
$host = "localhost";
$username = "root";
$password = "";
$database_name = "textile";

// Get connection object and set the charset
$conn = mysqli_connect($host, $username, $password, $database_name);
$conn->set_charset("utf8");


// Get All Table Names From the Database
$tables = array();
$sql = "SHOW FULL TABLES";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_row($result)) {
    $tables[] = array($row[0],$row[1]);
    
}

$sqlScript = "";
$columnNames ="";
foreach ($tables as $table) {
    
    // Prepare SQLscript for creating table structure
    $query = "SHOW CREATE TABLE .".$table[0]." ";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_row($result);
    
    if($table[1]=="VIEW"){
        $sqlScript.="\n\n  DROP VIEW IF EXISTS `$table[0]`; \n\n";
        $sqlScript .= "\n\n" . $row[1] . ";\n\n";
    }else {
        $sqlScript.="\n\n  DROP TABLE IF EXISTS `$table[0]`; \n\n";
    
    
    
    $sqlScript .= "\n\n" . $row[1] . ";\n\n";
    
    
    $query = "SELECT * FROM $table[0]";
    //$sqlScript .=$query;
    $result = mysqli_query($conn, $query);
    
    $columnCount = mysqli_num_fields($result);
    //$columnNames ="";
    $columnNames  ="(";
    for($a=0;$a<$columnCount;$a++){
 
    $fields=mysqli_fetch_field($result);
    //echo $fields;
    //$sqlScript.="Hello";
    //foreach($fields as $flied){

        $columnNames.=$fields->name ;
        if ($a < ($columnCount - 1)) {
            $columnNames .= ',';
        }


    //}
    }
    $columnNames  .=")";
    
    // Prepare SQLscript for dumping data for each table
    for ($i = 0; $i < $columnCount; $i ++) {
        while ($row = mysqli_fetch_row($result)) {

            $sqlScript .= "INSERT INTO $table[0] $columnNames VALUES(";
            for ($j = 0; $j < $columnCount; $j ++) {
                $row[$j] = $row[$j];
                
                if (isset($row[$j])) {
                    $sqlScript .= '"' . $row[$j] . '"';
                } else {
                    $sqlScript .= '""';
                }
                if ($j < ($columnCount - 1)) {
                    $sqlScript .= ',';
                }
            }
            $sqlScript .= ");\n";
        }
    }
    }
    $sqlScript .= "\n"; 
}

if(!empty($sqlScript))
{
    // Save the SQL script to a backup file
    $backup_file_name = $database_name . '_backup_' . time() . '.sql';
    $fileHandler = fopen($backup_file_name, 'w+');
    $number_of_lines = fwrite($fileHandler, $sqlScript);
    fclose($fileHandler); 

    // Download the SQL backup file to the browser
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . basename($backup_file_name));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($backup_file_name));
    ob_clean();
    flush();
    readfile($backup_file_name);
    exec('rm ' . $backup_file_name); 
}
?>
<?php include("../includes/check_session.php"); 
include("../includes/config.php"); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Backup </title>
<link rel="icon" type="image/x-icon" href="<?php echo $web_path; ?>images/dt-favicon.ico" />
<link href="<?php echo $web_path; ?>css/style.css" rel="stylesheet" type="text/css" />

</head>
<script>

    function downloadBackup(){
        document.getElementById('download').action='backup_download.php';
        //document.getElementById('download').target="_new";
        document.getElementById('download').submit();


    }
</script>
<body>
<form method="post" id="download" enctype="multipart/form-data" > 
<table width="100%" border="0" align="center" style="border:1px solid #e5f1f8;background-color:#FFFFFF">
<tr>
    <td><?php include("../includes/header.php"); ?></td>
  </tr>
  <tr>
    <td><?php include("../includes/menu.php"); ?></td>
  </tr>
</table>
<table width="100%">
  <tr><td style="font-size: 12px;color: #ffffff;background-color:#ffffff" align='center' width="100%">

</td>
</tr>
<?php


// Get connection object and set the charset
$conn = get_connection();
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
    $time=time()+19800; // Timestamp is in GMT now converted to IST
    $date=date('d_m_Y_H_i_s',$time);
    //$date=date('Ymd',$time);
    // Save the SQL script to a backup file
    //$backup_file_name = "backup/".DB_DATABASE.'_backup_' . $date . '.sql';
    $backup_file_name = "backup/".DB_DATABASE.'_backup_' . $date . '.sql';
    $fileHandler = fopen($backup_file_name, 'w+');
    $number_of_lines = fwrite($fileHandler, $sqlScript);
    fclose($fileHandler); 
    //readfile($backup_file_name);
}
?>
<tr><td style="background-color:#ffffff" align='center' width="100%">
<?php 
echo "<BR><h4>";
echo "Data file '$backup_file_name' has been Backed Up  ";
echo "</h4><BR>";
echo "<BR>";
echo "<BR>";

?>
<input type='hidden' name='backupfilename' id='backupfilename' value='<?php echo $backup_file_name;?>' >
<input  type="button" class="form-button" onclick="downloadBackup()" name="ls_dnload" value="Download Backup" />
<a href='<?php echo $backup_file_name;?>' >Download</a>

</td>
</tr>
<tr> <td style="background-color:#ffffff"> 
<BR>
</td>
</tr>
<tr> <td style="background-color:#ffffff">
<BR>
</td>
</tr>
<tr> <td style="background-color:#ffffff">
<BR>
</td>
</tr>
<tr> <td style="background-color:#ffffff">
<BR>
</td>
</tr>
<tr> <td>

<?php include("../includes/footer.php"); ?></td>
                  </tr>
</table>
</body>
<?php 
release_connection($conn);
?>




<?php include("../includes/check_session.php");
include("../includes/config.php");

//set_time_limit(120);

$backup_file_name=$_REQUEST['backupfilename'];
//$backup_file_name=$web_path . "/utility//" . $backup_file_name;
//$backup_file_name="textile_backup_15_08_2020_04_38_34_test.sql";
header('Content-Description: File Transfer');
//text/plain
header('Content-Type: application/octet-stream');
//header('Content-Type: text/plain');
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate ');
//header('Cache-Control: must-revalidate , post-check=0, pre-check=0');
//header('Cache-Control: private');
header('Pragma: public');
header('Content-Length: ' . filesize($backup_file_name));
//header('Content-Disposition: inline; filename=' . basename($backup_file_name));
//header('Content-Disposition: attachment; filename=' . basename($backup_file_name));
header('Content-Disposition: attachment; filename=' . basename($backup_file_name));



ob_clean();
flush();
readfile($backup_file_name);

exec('rm ' . $backup_file_name); 
//set_time_limit(60);
//die();
?>

 



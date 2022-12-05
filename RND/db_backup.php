<?php include("../includes/check_session.php");
include("../includes/config.php");
$con=get_connection();
?>

<?php
//include 'config.php';
//include 'opendb.php';
/*
$tableName  = 'menu';
$backupFile = 'backup/menu.sql';
$query      = "SELECT * INTO OUTFILE '$backupFile' FROM $tableName";
$result = mysqli_query($con,$query);
echo mysqli_errno($con);
echo mysqli_error($con);
*/
//include 'closedb.php';
?> 
Hello

<?php 
/*

include 'config.php';
include 'opendb.php';

$tableName  = 'mypet';
$backupFile = 'mypet.sql';
$query      = "LOAD DATA INFILE 'backupFile' INTO TABLE $tableName";
$result = mysql_query($query);


include 'closedb.php';
*/




?>

<?php


//DB_HOST, DB_USER, DB_PASSWORD,DB_DATABASE

//$dbname='textile';
//$dbhost=DB_HOST;
//$dbuser=DB_USER;
//$dbpass=DB_PASSWORD;

//$backupFile = $dbname . date("Y-m-d-H-i-s") . '.gz';
//$backupFile = $dbname . date("Y-m-d-H-i-s") . '.sql';
//$command = "mysqldump --opt -h $dbhost -u $dbuser -p $dbpass $dbname | gzip > $backupFile";
//$command = "mysqldump --opt -h$dbhost -u$dbuser -p$dbpass $dbname | gzip >$backupFile";
//$command = 'mysqldump  -user $dbuser  $dbname --result-file="D:\$backupfile"';
//$command ='mysqldump --user root  textile  --result-file="c:\AgencyMgmt\backup\textiledump1_%date:~6,4%-%date:~3,2%-%date:~0,2%-%time:~0,2%-%time:~3,2%-%time:~6,2%.sql"';

$command = "c:\AgencyMgmt\Task\backup.bat";
system($command);

echo "<BR>";
echo "Command - ".$command;
echo "<BR>";
//echo "Backup File - ".$backupFile;


?>

<?php
/*
include 'config.php';
include 'opendb.php';

$backupFile = $dbname . date("Y-m-d-H-i-s") . '.gz';
$command = "mysqldump --opt -h $dbhost -u $dbuser -p $dbpass $dbname | gzip > $backupFile";
system($command);

include 'closedb.php';
*/



/*

echo off 
start "" "C:\wamp\bin\mysql\mysql5.6.12\bin\mysqldump.exe(your mysqldump address)"
 --user root --password=(provide here) databaseNameHere 
 --result-file="D:\where you want path with SqlFileName.sql" 
--database databaseNameHere

.%date:~10,4%-%date:~7,2%-%date:~4,2% Blockquote

for date
%date:~6,4%-%date:~3,2%-%date:~0,2%-%time:~0,2%-%time:~3,2%-%time:~6,2%

// cmd prompt
mysqldump --user root  textile  --result-file="c:\AgencyMgmt\backup\textiledump1_%date:~6,4%-%date:~3,2%-%date:~0,2%-%time:~0,2%-%time:~3,2%-%time:~6,2%.sql

*/
?>
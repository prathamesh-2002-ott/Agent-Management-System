<?php include("../includes/check_session.php"); 
include("../includes/config_test.php"); 
    //echo "Start--- ";
/*
$mysql_host = "localhost";
$mysql_database = "devendratextiles";
$mysql_user = "root";
$mysql_password = "";
# MySQL with PDO_MYSQL  
$db = new PDO("mysql:host=$mysql_host;dbname=$mysql_database", $mysql_user, $mysql_password);
echo $db->errorInfo();

$con = get_connection();
$query = file_get_contents("textile_backup_test.sql");
//echo $query;
$stmt = $con->prepare($query);
$stmt->bind_param("","");

if ($stmt->execute()){
     echo "Success";
}else {
     echo "Fail";
}


$stmt->execute();
echo "<BR>";
echo "---- Done";
//$stmt->close();
$con->close();
 */   
?>
<?php


// Name of the file
$filename = 'textile_backup_test.sql';
/*
// MySQL host
$mysql_host = 'localhost';
// MySQL username
$mysql_username = 'username';
// MySQL password
$mysql_password = 'password';
// Database name
$mysql_database = 'database';
*/
// Connect to MySQL server

$count=0;
set_time_limit(600);
$start_time=time();
echo $start_time;
$con =get_connection();
// Check connection
if ($con->connect_errno) {
    echo "Failed to connect to MySQL: " . $con->connect_errno;
    echo "<br/>Error: " . $con->connect_error;
}
echo "Tables Import Started";
echo "<br>";
// Temporary variable, used to store current query
$templine = '';
// Read in entire file
$lines = file($filename);
// Loop through each line
foreach ($lines as $line) {
// Skip it if it's a comment
    if (substr($line, 0, 2) == '--' || $line == '')
        continue;

// Add this line to the current segment
    $templine .= $line;
// If it has a semicolon at the end, it's the end of the query
    if (substr(trim($line), -1, 1) == ';') {
        // Perform the query
        $con->query($templine) or print('Error performing query \'<strong>' . $templine . '\': '  . '<br /><br />');
        //echo $templine;
        echo $count++;
        //echo "<br>";
        // Reset temp variable to empty
        $templine = '';
    }
}
echo "<br>";
echo "Tables imported successfully";
$end_time= time();
echo ($end_time-$start_time)/60;
set_time_limit(60);
$con->close();



/*



$commands = file_get_contents($location);   
$this->_connection->multi_query($commands);

function run_sql_file($location){
    //load file
    $commands = file_get_contents($location);

    //delete comments
    $lines = explode("\n",$commands);
    $commands = '';
    foreach($lines as $line){
        $line = trim($line);
        if( $line && !startsWith($line,'--') ){
            $commands .= $line . "\n";
        }
    }

    //convert to array
    $commands = explode(";", $commands);

    //run commands
    $total = $success = 0;
    foreach($commands as $command){
        if(trim($command)){
            $success += (@mysql_query($command)==false ? 0 : 1);
            $total += 1;
        }
    }

    //return number of successful queries and total number of queries found
    return array(
        "success" => $success,
        "total" => $total
    );
}


// Here's a startsWith function
function startsWith($haystack, $needle){
    $length = strlen($needle);
    return (substr($haystack, 0, $length) === $needle);
}

*/
?>


<?php 

/*
$message = '';
if(isset($_POST["import"]))
{
 if($_FILES["database"]["name"] != '')
 {
  $array = explode(".", $_FILES["database"]["name"]);
  $extension = end($array);
  if($extension == 'sql')
  {
   $connect = mysqli_connect("localhost", "root", "", "testing1");
   $output = '';
   $count = 0;
   $file_data = file($_FILES["database"]["tmp_name"]);
   foreach($file_data as $row)
   {
    $start_character = substr(trim($row), 0, 2);
    if($start_character != '--' || $start_character != '/*' || $start_character != '//' || $row != '')
    {
     $output = $output . $row;
     $end_character = substr(trim($row), -1, 1);
     if($end_character == ';')
     {
      if(!mysqli_query($connect, $output))
      {
       $count++;
      }
      $output = '';
     }
    }
   }
   if($count > 0)
   {
    $message = '<label class="text-danger">There is an error in Database Import</label>';
   }
   else
   {
    $message = '<label class="text-success">Database Successfully Imported</label>';
   }
  }
  else
  {
   $message = '<label class="text-danger">Invalid File</label>';
  }
 }
 else
 {
  $message = '<label class="text-danger">Please Select Sql File</label>';
 }
}

*/
?>
<!--
<!DOCTYPE html>  
<html>  
 <head>  
  <title>How to Import SQL File in Mysql Database using PHP</title>  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
 </head>  
 <body>  
  <br /><br />  
  <div class="container" style="width:700px;">  
   <h3 align="center">How to Import SQL File in Mysql Database using PHP</h3>  
   <br />
   <div><?php // echo $message; ?></div>
   <form method="post" enctype="multipart/form-data">
    <p><label>Select Sql File</label>
    <input type="file" name="database" /></p>
    <br />
    <input type="submit" name="import" class="btn btn-info" value="Import" />
   </form>
  </div>  
 </body>  
</html> -->
<?php  	// DRY approch -- Don't Repeat Yourself 
if(false) {
} else {
	define('DB_HOST', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASSWORD', '');
	define('DB_DATABASE', 'agencysystemdemo');	
	//define('DB_DATABASE', 'textile');	
}
/*
$mysql = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("Error:".mysql_error());
mysql_select_db(DB_DATABASE);
*/
function get_connection(){
	$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_DATABASE) or die("Error:".mysqli_connect_error());
	return $con;
}
	//error_reporting(0);
  // function to convert the date formate from dd-mm-yy to yy/mm/dd to store in mysql
  function convert_date($date) {
    if(!empty($date)) {
	  	$temp_date=explode("-",$date);
		$dd=$temp_date[0];
		$mm=$temp_date[1];
		$yy=trim($temp_date[2]);
		$new_date=$yy."-".$mm."-".$dd;
		return $new_date;
	} else {
		return;
	}				
  }
  // end function 	



  // function to convert the date formate from dd-mm-yy to yy/mm/dd to store in mysql
  function rev_convert_date($date) {
    if(!empty($date) && $date!='0000-00-00') {
	  	$temp_date=explode("-",$date);
		$dd=$temp_date[2];
		$mm=$temp_date[1];
		$yy=$temp_date[0];
		$new_date=$dd."-".$mm."-".$yy;
		return $new_date;
	} else {
		return;
	}				
  }
  // end function 	
  /*
  function db_query($sql) {
	$result_set=array();
	$result=mysql_query($sql);
	while($rs=mysql_fetch_assoc($result)) {
		$result_set[]=$rs;
	}
	return $result_set;
 }	

 */
/********************************************************************
		FUNCTION FOR MYSQL SUCCESS/ERROR NUMBER AND THEIR MESSAGES
*********************************************************************/
	function getSqlMessage($error_no,$str) {
		switch ($error_no) {
/*			case 0:
				// 0 for no error or Success of query
				$msg= " Successfully";
				break;
*/			case 1451:
				$msg= " Can not delete as it linked with some another data";
				break;
			case 1452:
				$msg= " Can not add as it linked with some another data";
				break;
		}
		return $str.$msg;
	}
	
/**********************************************************
		FUNCTION dateDiff($start_date, $end_date) gives the number of days between two dates in yyyy-mm-dd format
***********************************************************/		
 function dateDiff($start, $end) {
	$start_ts = strtotime($start);
	$end_ts = strtotime($end);
	$diff = $start_ts - $end_ts;
	if($end_ts=="") 
		return 0;
	return round($diff / 86400);
}	

function zeroToBlank($num){
	if(is_nan($num)){
		return "";
	}else if($num==0){
		return "";
	}
	return $num;

}
function defaultDateToBlank($date){
	if($date=='0000-00-00'){
		return "";
	}
	return $date;
}
	
?>
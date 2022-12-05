<?php

// This Should be always ON
$err_log="ON";

// This Should be always OFF Switch it ON when Debugging
//$debug_log="ON";
$debug_log="OFF";

// This Should be always OFF Switch it ON when Debugging
//$process_page_log="ON";
$process_page_log="OFF";

// This Should be always ON when not debugging
$process_page_redirect="ON"; 
//$process_page_redirect="OFF"; 



function date_time(){
	$time=time()+19800; // Timestamp is in GMT now converted to IST
	$date=date('d-m-Y H:i:s',$time);
	return $date;
}

function date_time_filename(){
    $time=time()+19800; // Timestamp is in GMT now converted to IST
	$date=date('d_m_Y_H_i_s',$time);
	return $date; 
}

/*************/  // Parent Function
//  Parent function for Error Log
function parent_error_log($str,$log_file){
    if($GLOBALS["err_log"]=="ON"){
        error_log(" \n".date_time()." \n".$str ."\n",3,$log_file);
    }
}

// Parent function Debug log
function parent_debug_log($str,$log_file){
    if($GLOBALS["debug_log"]=="ON"){
        error_log(" \n".date_time()." \n".$str ."\n",3,$log_file);
    }
}

// Parent function for Dispaly log specially for process files
function process_logging_disp($str){
    // This function is created for Process Echo to be switched on and off when required
    if($GLOBALS["process_page_log"]=="ON"){
        echo "<BR>";
        echo $str;
        echo "<BR>";
    }

}

// Parent function for Redierct for Process file
function process_redirect($str){
    // This function is created for Process REdirect to be switched on and off when required
    if($GLOBALS["process_page_redirect"]=="ON"){
        echo $str;
    }
}

/*************/

/*************/ //  Commission Summary Display Log
function comm_log($str){
    $log_file="log/comm_summ_disp_php_debug.log";
	parent_debug_log($str,$log_file);

}
/*************/



/*************/ // for Add_Payment PHP file only
function add_payment_log($str){
	$log_file="log/add_payment_php_debug.log";
	parent_debug_log($str,$log_file);
}
/*************/

/*************/ // for Edit_Payment PHP file only
function edit_payment_log($str){
	$log_file="log/edit_payment_php_debug.log";
	parent_debug_log($str,$log_file);
}
/*************/


/*************/   // Process Payment PHP
// For process_payment PHP file Only
function process_payment_entry_logging_disp($str){
    $log_file="log/process_payment_php_debug.log";
	process_logging_disp($str);
	parent_debug_log($str,$log_file);
}

// For process_payment PHP file Only
function process_payment_entry_error_log($str){
	$error_log="log/process_payment_php_error.log";
	parent_error_log($str,3,$error_log);
}

// For process_payment PHP file Only
function process_payment_entry_redirect($str){
    process_redirect($str);
}

/*************/


// For XLS_Reporting PHP file Only
function xls_report_log($str){
    $log_file="log/xls_report.log";
	parent_debug_log($str,$log_file);
}

/*************/

//


?>
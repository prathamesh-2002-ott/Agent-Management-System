<?php  

$host=$_SERVER["HTTP_HOST"];

if(false) {
		$web_path="http://malwainfotech.com/Textile/";      
	}
 else {
	$web_path="http://$host/HTextile/";   	
	//$web_path="http://$host/AgencySystemDemo/";   	
}




$user_type_ar=array('admin' => 'Admin',
					'user' => 'User',
					'master' =>'Master'
			);
			
if(!defined('FIR_NUM_ROWS')){
define("FIR_NUM_ROWS",20);
}

				
?>
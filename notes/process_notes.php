<?php include("../includes/check_session.php");
include("../includes/config.php"); ?>


<?php
$action = isset($_GET['action']) ? $_GET['action'] : '';

switch($action) {
	case 'add':
		save();
		break;
	case 'modify':
		update();
		break;
	case 'delete' :
		delete(); 
		break;
	case 'remfile' :
		removeFile();
		break;				
}


echo "<script language='javascript'>";
echo "location.href='index.php'";
echo "</script>";

/*
if($_REQUEST['disp']!='child'){
	if($action=='add'){
		
		echo "<script language='javascript'>";
		echo "location.href='add_bill_entry.php'";
		echo "</script>";
		
	}else{
		
		if($_REQUEST['src']=='search') { 
			$supplier_code=$_REQUEST['search_supplier_account_code'];
			$buyer_code=$_REQUEST['search_buyer_account_code'];
			$bill_start_date=$_REQUEST['bill_start_date'];
			$bill_end_date=$_REQUEST['bill_end_date'];
			$vou_start_date=$_REQUEST['vou_start_date'];
			$vou_end_date=$_REQUEST['vou_end_date'];
			$search_bill_entry_id=$_REQUEST['search_bill_entry_id'];
			$search_bill_number=$_REQUEST['search_bill_number'];
			//src=search&vou_end_date=$vou_end_date&vou_start_date=$vou_start_date&bill_end_date=$bill_end_date&bill_start_date=$bill_start_date&buyer_account_code=$buyer_code&supplier_account_code=$supplier_code&bill_entry_id=$bill_entry_id
			echo "<script language='javascript'>";
			echo "location.href='bill_search.php?src=search&search_bill_entry_id=$search_bill_entry_id&search_bill_number=$search_bill_number&vou_end_date=$vou_end_date&vou_start_date=$vou_start_date&bill_end_date=$bill_end_date&bill_start_date=$bill_start_date&search_buyer_account_code=$buyer_code&search_supplier_account_code=$supplier_code&bill_entry_id=$bill_entry_id'";
			echo "</script>";			
		 } else {
			
			echo "<script language='javascript'>";
			echo "location.href='index.php'";
			echo "</script>";
			
		 }
	}
}else {
	echo "<script language='javascript'>";
	echo "location.href='../ledger/child_update_submit.php'";
	echo "</script>";

}
*/


function save() 
{
	$con=get_connection();
		// get data 
		//echo "Hello 0";
	if(($_REQUEST['open_date']) && ($_SESSION['uid']==77)) 
	{
        $_SESSION['uid']=11; // this is to prevent the call of function if Save is clicked twice .
		//echo "Hello 1";
        $supplier_group_code=$_REQUEST['supplier_group_code'];
        $buyer_group_code=$_REQUEST['buyer_group_code'];

        $open_date=$_REQUEST['open_date'];
        $status_selected=$_REQUEST['status'];
        
        $supplier_code=$_REQUEST['supplier_code'];
        $buyer_code=$_REQUEST['buyer_code'];
        $reminder_for=$_REQUEST['reminder_for'];
        $ref_bill_number=$_REQUEST['ref_bill_number'];
        $status=$_REQUEST['status'];
        $last_update_user=$_SESSION['LOGID'];

        $notes_data=$_REQUEST['notes_data'];

        $sql_main="insert into 	notes_main
                (notes_open_date,
                reminder_for,
                supplier_group,
                buyer_group,
                supplier_code,
                buyer_code,
                ref_bill_number,
                status,
				last_update_user,
				last_update_date,
				create_user,
				create_date)
				values(
					'".convert_date($open_date)."',
					'$reminder_for',
					'".blankToZero($supplier_group_code)."',
					'".blankToZero($buyer_group_code)."',
					'".blankToZero($supplier_code)."',
					'".blankToZero($buyer_code)."',
					'$ref_bill_number',
					'$status',
					'$last_update_user',
					NOW(),
					'$last_update_user',
					NOW())";

        $sql_error_message="";
        $sql_success_code=0;
	    //echo $sql_main;
        $result=mysqli_query($con,$sql_main);
		$notes_main_id=mysqli_insert_id($con);
		//echo "<br>";
		//echo $notes_main_id;
		//echo "<br>";
		
		if(mysqli_error($con)==0) 
		{ 
			$sql_success_code+=0;
			//echo " 1 ".mysqli_error($con);
			//$_SESSION['msg']="<div class='success-message'>Payment Entry Bill Successfully Added</div>";
		} 
		else 
		{
			$sql_success_code+=1;
			$sql_error_message+="Notes Main";
			//echo " 2 ".mysqli_error($con);
			//$_SESSION['msg']="<div class='error-message'>Payment Entry Bill Details Not Addedd</div>";
		}		

		if($sql_success_code== 0) {
			$sql_detail="insert into notes_detail
			(notes_main_id,
			notes,
			notes_date,
			last_update_user,
			last_update_date,
			create_user,
			create_date)
			values(
				'$notes_main_id',
				'$notes_data',
				NOW(),
				'$last_update_user',
				NOW(),
				'$last_update_user',
				NOW())";
				//echo $sql_detail;
			$result=mysqli_query($con,$sql_detail);
		

				if(mysqli_error($con)==0) 
				{ 
					$sql_success_code+=$sql_success_code;
					//$_SESSION['msg']="<div class='success-message'>Payment Entry Bill Successfully Added</div>";
				} 
				else 
				{
					$sql_success_code+=1;
					$sql_error_message+="Notes Detail";
					//$_SESSION['msg']="<div class='error-message'>Payment Entry Bill Details Not Addedd</div>";
				}	
		
		}


		if($sql_success_code>0){
			$_SESSION['msg']="<div class='error-message'>Notes Not Addedd ".$sql_error_message."</div>";

		}else{
			$_SESSION['msg']="<div class='success-message'>Notes (".$notes_main_id.")  Successfully Added</div>";
		}
	
	} //(($_REQUEST['open_date']) && ($_SESSION['uid']==77)) 

	release_connection($con);

}



function update()
{
	if(($_REQUEST['notes_main_id']) && ($_SESSION['uid']==77))
	{
		$_SESSION['uid']=11; // this is to prevent the call of function if Save is clicked twice .
		
		$con=get_connection();



        $supplier_code=$_REQUEST['supplier_code'];
        $buyer_code=$_REQUEST['buyer_code'];
        $reminder_for=$_REQUEST['reminder_for'];
        $ref_bill_number=$_REQUEST['ref_bill_number'];

		$status=$_REQUEST['status'];
        $last_update_user=$_SESSION['LOGID'];
		$notes_main_id=$_REQUEST['notes_main_id'];
		$notes_data=$_REQUEST['notes_data'];


		

  $sql_main="update	notes_main 
				set 
				buyer_code='".blankToZero($buyer_code)."',
				supplier_code='".blankToZero($supplier_code)."',
				reminder_for='$reminder_for',
				ref_bill_number='$ref_bill_number',
                status = '$status', 
				last_update_user ='$last_update_user',
				last_update_date=NOW(),
				create_user='$last_update_user',
				create_date=NOW()

				WHERE notes_main_id='$notes_main_id' ";

        $sql_error_message="";
        $sql_success_code=0;


        $result=mysqli_query($con,$sql_main);
		if(mysqli_error($con)==0) 
		{ 
			$sql_success_code+=0;
			//$_SESSION['msg']="<div class='success-message'>Payment Entry Bill Successfully Added</div>";
		} 
		else 
		{
			$sql_success_code+=1;
			$sql_error_message+="Notes Main";
			//$_SESSION['msg']="<div class='error-message'>Payment Entry Bill Details Not Addedd</div>";
		}	

		if($sql_success_code== 0) {

				$sql_detail="insert into notes_detail
				(notes_main_id,
				notes,
				notes_date,
				last_update_user,
				last_update_date,
				create_user,
				create_date)
				values(
					'$notes_main_id',
					'$notes_data',
					NOW(),
					'$last_update_user',
					NOW(),
					'$last_update_user',
					NOW())";
				
				
				$sql_success_code=0;			
				$result=mysqli_query($con,$sql_detail);
				
				if(mysqli_error($con)==0) 
				{ 
					$sql_success_code+=$sql_success_code;
					//$_SESSION['msg']="<div class='success-message'>Payment Entry Bill Successfully Added</div>";
				} 
				else 
				{
					$sql_success_code+=1;
					$sql_error_message+="Notes Detail";
					//$_SESSION['msg']="<div class='error-message'>Payment Entry Bill Details Not Addedd</div>";
				}		
		}

		if($sql_success_code>0){
			$_SESSION['msg']="<div class='error-message'>Notes Not Addedd ".$sql_error_message."</div>";

		}else{
			$_SESSION['msg']="<div class='success-message'>Notes  (".$notes_main_id.")  Successfully Updated</div>";
		}		

		
		
		release_connection($con);
		
	} // End  if(($_REQUEST['notes_main_id']) && ($_SESSION['uid']==77))
} // End  function update()

/*
function delete()
{
	$con=get_connection();
	if(($_REQUEST['bill_entry_id']) && ($_SESSION['uid']==77))
	{
		$bill_entry_id=$_REQUEST['bill_entry_id'];
		$delete_user=$_SESSION['LOGID'];
		//$sql="delete from txt_bill_entry where bill_entry_id='$bill_entry_id'";

		$sql=" update txt_bill_entry set  delete_tag='TRUE',";
		$sql .=" delete_user='$delete_user',";
		$sql .=" delete_date=NOW()";
		$sql .=" where bill_entry_id='$bill_entry_id'";

		$log_file = "my-errors.log";
		error_log($sql,3,$log_file);


		$result=mysqli_query($con,$sql);
		if(mysqli_error($con)==0) 
		{ 
			$_SESSION['msg']="<div class='success-message'>Notes Successfully Deleted</div>";
		} 
		else 
		{
			$msg=getSqlMessage(mysqli_error($con),"Notes Not Deleted  ");
			$_SESSION['msg']="<div class='error-message'>$msg</div>";
		}
		$_SESSION['uid']=11;
	}

	release_connection($con);

}
*/
function removeFile()
{
	echo "Remove File";
	echo ":--".$_REQUEST['bill_entry_id'];
	echo $_SESSION['uid'];
	if(($_REQUEST['bill_entry_id']) && ($_SESSION['uid']==77))
	{
		echo "Remove File inside if";

		$con=get_connection();
		$bill_entry_id=$_REQUEST['bill_entry_id'];
		$ft=$_REQUEST['ft'];  // ft= file type 
		
		if($ft=="bill_upload") 
		{
			//$sql="select bill_entry_id from txt_bill_entry where bill_entry_id='$bill_entry_id'";
			$sql_update="update txt_bill_entry set bill_upload='' where bill_entry_id='$bill_entry_id'";
		}
		
		if($ft=="supporting_doc") 
		{
			//$sql="select supporting_doc from txt_bill_entry where bill_entry_id='$bill_entry_id'";
			$sql_update="update txt_bill_entry set supporting_doc='' where bill_entry_id='$bill_entry_id'";
		}
		

		
		//$result=mysqli_query($con,$sql);	
		//$row=mysql_fetch_row($result);
			
		mysqli_query($con,$sql_update);
		
		if(mysqli_errno($con)==0) { 
					$_SESSION['msg']="<div class='success-message'>File Successfully Deleted</div>";
				} else {
					$msg=getSqlMessage(mysqli_error($con),"File Not Deleteted");
					$_SESSION['msg']="<div class='success-message'>$msg</div>";
				}
				
			

		
		if($_REQUEST['disp']!='child'){
			echo "<script language='javascript'>";
			echo "location.href='edit_bill_entry.php?bill_entry_id=$bill_entry_id'";
			echo "</script>";
		}else {
			echo "<script language='javascript'>";
			echo "location.href='edit_bill_entry.php?disp=child&bill_entry_id=$bill_entry_id'";
			echo "</script>";
		
		}

		
		release_connection($con);
		
	}
}

?>
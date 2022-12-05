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
$req_disp="";
if(isset($_REQUEST['disp'])){
	$req_disp=$_REQUEST['disp'];
}

$req_src="";
if(isset($_REQUEST['src'])){
	$req_src=$_REQUEST['src'];
}


if($req_disp!='child'){
	if($action=='add'){
		
		echo "<script language='javascript'>";
		echo "location.href='add_bill_entry.php'";
		echo "</script>";
		
	}else{
		
		if($req_src=='search') { 
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


function save() 
{
	$con=get_connection();
		// get data 
	if(($_REQUEST['voucher_date']) && ($_SESSION['uid']==77)) 
	{

		$bill_number=$_REQUEST['bill_number'];
		$bill_date=$_REQUEST['bill_date'];
			$bill_date=convert_date($bill_date);
		$supplier_account_code=$_REQUEST['supplier_account_code'];			

		$sql_bill_check="SELECT bill_entry_id ,
								voucher_date
						 from txt_bill_entry 
						 where delete_tag='FALSE' 
						 AND bill_number='$bill_number' 
						 AND bill_date='$bill_date' 
						 AND supplier_account_code='$supplier_account_code' ";


		$result_bill_check=mysqli_query($con,$sql_bill_check);
		//echo $sql_bill_check;
		$bill_entry_id_check=-1;
		$voucher_date_check="";
		while($rs=mysqli_fetch_array($result_bill_check)){
			$bill_entry_id_check=$rs['bill_entry_id'];
			$voucher_date_check=$rs['voucher_date'];
			//echo "Inside While";
		}


		if($bill_entry_id_check>-1){
			
			$_SESSION['msg']="<div class='error-message'>Bill Already Exist (Entry Id : $bill_entry_id_check  Entry Date : ".rev_convert_date($voucher_date_check).")</div>";


		}else{


			$voucher_number=$_REQUEST['voucher_number'];
			$voucher_date=$_REQUEST['voucher_date'];
				$voucher_date=convert_date($voucher_date);
			$bill_number=$_REQUEST['bill_number'];
			$bill_date=$_REQUEST['bill_date'];
				$bill_date=convert_date($bill_date);
			$lr_number=$_REQUEST['lr_number'];
			$lr_date=$_REQUEST['lr_date'];
				$lr_date=convert_date($lr_date);
			$transport_name=$_REQUEST['transport_name'];
			$supplier_account_code=$_REQUEST['supplier_account_code'];
			$buyer_account_code=$_REQUEST['buyer_account_code'];
			$agent=$_REQUEST['agent'];
			$gross_amount=blankToZero($_REQUEST['gross_amount']);
			$deduction_amount=blankToZero($_REQUEST['deduction_amount']);
			$additional_amount=blankToZero($_REQUEST['additional_amount']);
			$net_amount=blankToZero($_REQUEST['net_amount']);
			$discount_percentage=blankToZero($_REQUEST['discount_percentage']);
			$discount_amount=blankToZero($_REQUEST['discount_amount']);
			$bill_amount=blankToZero($_REQUEST['bill_amount']);
			$remarks=$_REQUEST['remarks'];
	
			$gst_per=blankToZero($_REQUEST['gst_percent']);
			$gst_amount=blankToZero($_REQUEST['gst_amount']);
			$round_off=blankToZero($_REQUEST['round_off']);
			$last_update_user=$_SESSION['LOGID'];
			//echo "Pritesh - ".$lr_date."--";
			$bill_upload="";
			if($_FILES['bill_upload']['name']!="") { // only if files are selected -- to pevent blank entry in table
				$file_name_bill_upload = $_FILES['bill_upload']['name'];
				$file_size_bill_upload =$_FILES['bill_upload']['size'];
				$file_tmp_bill_upload =$_FILES['bill_upload']['tmp_name'];
				$file_type_bill_upload=$_FILES['bill_upload']['type'];	
				if($file_size_bill_upload > 10485760){  // 2097152  
					$errors[]='File size must be less than 2 MB';
				}		
					$random_digit=time()+3;
					$file_name_bill_upload = str_replace(' ', '_', $file_name_bill_upload);
					$file_name_bill_upload = $random_digit."_".$file_name_bill_upload;
					move_uploaded_file($file_tmp_bill_upload,"upload/".$file_name_bill_upload); //echo $file_name1;
					$bill_upload=$file_name_bill_upload;
			}	
				$supporting_doc="";
			if($_FILES['supporting_doc']['name']!="") { // only if files are selected -- to pevent blank entry in table
				$file_name_supporting_doc = $_FILES['supporting_doc']['name'];
				$file_size_supporting_doc =$_FILES['supporting_doc']['size'];
				$file_tmp_supporting_doc =$_FILES['supporting_doc']['tmp_name'];
				$file_type_supporting_doc=$_FILES['supporting_doc']['type'];	
				if($file_size_supporting_doc > 10485760){  // 2097152
					$errors[]='File size must be less than 2 MB';
				}		
					$random_digit=time()+4;
					$file_name_supporting_doc = str_replace(' ', '_', $file_name_supporting_doc);
					$file_name_supporting_doc = $random_digit."_".$file_name_supporting_doc;
						move_uploaded_file($file_tmp_supporting_doc,"upload/".$file_name_supporting_doc); //echo $file_name1;
						$supporting_doc=$file_name_supporting_doc;
			}				

			$log_file = "my-errors.log";
			
			$sql="insert into 
			txt_bill_entry
				(voucher_number,
				voucher_date,
				bill_number,
				bill_date,
				lr_number,
				lr_date,
				transport_name,
				supplier_account_code,
				buyer_account_code,
				agent,
				gross_amount,
				deduction_amount,
				additional_amount,
				net_amount,
				discount_percentage,
				discount_amount,
				bill_amount,
				remarks,
				gst_percent,
				gst_amount,
				round_off,
				bill_upload,
				supporting_doc,
				last_update_user,
				last_update_date,
				create_user,
				create_date)
				values(
					'$voucher_number',
					'$voucher_date',
					'$bill_number',
					'$bill_date',
					'$lr_number',
					'$lr_date',
					'$transport_name',
					'$supplier_account_code',
					'$buyer_account_code',
					'$agent',
					'".blankToZero($gross_amount)."',
					'".blankToZero($deduction_amount)."',
					'".blankToZero($additional_amount)."',
					'".blankToZero($net_amount)."',
					'".blankToZero($discount_percentage)."',
					'".blankToZero($discount_amount)."',
					'".blankToZero($bill_amount)."',
					'$remarks',
					'".blankToZero($gst_per)."',
					'".blankToZero($gst_amount)."',
					'".blankToZero($round_off)."',
					'$bill_upload',
					'$supporting_doc',
					'$last_update_user',
					NOW(),
					'$last_update_user',
					NOW())";

			//error_log($sql,3,$log_file);

			$result=mysqli_query($con,$sql); 
			//echo $sql;
			//echo $result;
				if(mysqli_errno($con)==0) 
					{ 
						$bill_entry_id=mysqli_insert_id($con);
						$_SESSION['msg']="<div class='success-message'>Bill Entry Id : $bill_entry_id Successfully Added</div>";
						//echo "<BR> Prit - 1" .mysqli_error($con);
						//echo "Bill Entry Id - ".$bill_entry_id;
						//echo "<br>";
						//error_log("Success \n ",3,$log_file);
						//error_log($sql,3,$log_file);

						//error_log($sql,1,"pritsneh@gmail.com");
					} 
					else 
					{
						$msg=mysqli_errno($con);
						$_SESSION['msg']="<div class='error-message'>Bill Entry Not Addedd Error Code($msg) </div>";
						echo " <BR>Prit - 2" .mysqli_error($con);
						echo "<br>";
						$time=time()+19800; // Timestamp is in GMT now converted to IST
						$date=date('d_m_Y_H_i_s',$time);
						error_log("\n *******Fail **************** \n " .$date,3,$log_file);
						error_log("\n ".mysqli_error($con),3,$log_file);
						error_log("\n".$sql."\n ",3,$log_file);
						//error_log($sql,1,"pritsneh@gmail.com");

						//$_SESSION['msg']=$msg;
					}

					$_SESSION['uid']=11;
		}
	} //(($_REQUEST['voucher_date']) && ($_SESSION['uid']==77)) 


	release_connection($con);

}



function update()
{
	if(($_REQUEST['voucher_date']) && ($_SESSION['uid']==77))
	{
		$_SESSION['uid']=11; // this is to prevent the call of function if Save is clicked twice .
		
		$con=get_connection();

		$bill_entry_id=$_REQUEST['bill_entry_id'];

		$check_pay_sql=" select * from txt_payment_bill_entry where delete_tag='FALSE' and bill_entry_id='$bill_entry_id' ";

		$pay_attached=0;
		$result=mysqli_query($con,$check_pay_sql);
		while($rs=mysqli_fetch_array($result))
		{
			$pay_attached++;
		}


		if($pay_attached==0)
		{

		
		$bill_entry_id=$_REQUEST['bill_entry_id'];
		$voucher_number=$_REQUEST['voucher_number'];
		$voucher_date=$_REQUEST['voucher_date'];
			$voucher_date=convert_date($voucher_date);
		$bill_number=$_REQUEST['bill_number'];
		$bill_date=$_REQUEST['bill_date'];
			$bill_date=convert_date($bill_date);
		$lr_number=$_REQUEST['lr_number'];
		$lr_date=$_REQUEST['lr_date'];
			$lr_date=convert_date($lr_date);
		$transport_name=$_REQUEST['transport_name'];
		$supplier_account_code=$_REQUEST['supplier_account_code'];
		$buyer_account_code=$_REQUEST['buyer_account_code'];
		$agent=$_REQUEST['agent'];
		$gross_amount=blankToZero($_REQUEST['gross_amount']);
		$deduction_amount=blankToZero($_REQUEST['deduction_amount']);
		$additional_amount=blankToZero($_REQUEST['additional_amount']);
		$net_amount=blankToZero($_REQUEST['net_amount']);
		$discount_percentage=blankToZero($_REQUEST['discount_percentage']);
		$discount_amount=blankToZero($_REQUEST['discount_amount']);
		$bill_amount=blankToZero($_REQUEST['bill_amount']);
		$remarks=$_REQUEST['remarks'];

		$gst_per=blankToZero($_REQUEST['gst_percent']);
		$gst_amount=blankToZero($_REQUEST['gst_amount']);
		$round_off=blankToZero($_REQUEST['round_off']);
		$last_update_user=$_SESSION['LOGID'];

		$bill_upload="";
		if($_FILES['bill_upload']['name']!="") { // only if files are selected -- to pevent blank entry in table
			$file_name_bill_upload = $_FILES['bill_upload']['name'];
			$file_size_bill_upload =$_FILES['bill_upload']['size'];
			$file_tmp_bill_upload =$_FILES['bill_upload']['tmp_name'];
			$file_type_bill_upload=$_FILES['bill_upload']['type'];

			if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
				process_payment_entry_logging_disp("Upload-"."upload was successful");
			 } else {
				process_payment_entry_logging_disp("Upload-"."upload was FAILED");
			 }
			process_payment_entry_logging_disp("Name-".$file_name_bill_upload);
			process_payment_entry_logging_disp("Size-".$file_size_bill_upload);
			process_payment_entry_logging_disp("Temp-".$file_tmp_bill_upload);
			process_payment_entry_logging_disp("Type-".$file_type_bill_upload);
				
			if($file_size_bill_upload > 10485760){  // 2097152
				$errors[]='File size must be less than 2 MB';
			}		
				$random_digit=time()+3;
				$file_name_bill_upload = str_replace(' ', '_', $file_name_bill_upload);
				$file_name_bill_upload = $random_digit."_".$file_name_bill_upload;
				 move_uploaded_file($file_tmp_bill_upload,"upload/".$file_name_bill_upload); //echo $file_name1;
				 $bill_upload=$file_name_bill_upload;
		}	
		$supporting_doc=""	;
		if($_FILES['supporting_doc']['name']!="") { // only if files are selected -- to pevent blank entry in table
			$file_name_supporting_doc = $_FILES['supporting_doc']['name'];
			$file_size_supporting_doc =$_FILES['supporting_doc']['size'];
			$file_tmp_supporting_doc =$_FILES['supporting_doc']['tmp_name'];
			$file_type_supporting_doc=$_FILES['supporting_doc']['type'];	
			if($file_size_supporting_doc > 10485760){  // 2097152
				$errors[]='File size must be less than 2 MB';
			}		
				$random_digit=time()+4;
				$file_name_supporting_doc = str_replace(' ', '_', $file_name_supporting_doc);
				$file_name_supporting_doc = $random_digit."_".$file_name_supporting_doc;
					move_uploaded_file($file_tmp_supporting_doc,"upload/".$file_name_supporting_doc); //echo $file_name1;
					$supporting_doc=$file_name_supporting_doc;
		}				



		$sql="update txt_bill_entry set 
			voucher_number='$voucher_number',
			voucher_date='$voucher_date',
			bill_number='$bill_number',
			bill_date='$bill_date',
			lr_number='$lr_number',
			lr_date='$lr_date',
			transport_name='$transport_name',
			supplier_account_code='$supplier_account_code',
			buyer_account_code='$buyer_account_code',
			agent='$agent',
			gross_amount='$gross_amount',
			deduction_amount='$deduction_amount',
			additional_amount='$additional_amount',
			net_amount='$net_amount',
			discount_percentage='$discount_percentage',
			discount_amount='$discount_amount',
			bill_amount='$bill_amount',
			remarks='$remarks',";

			if($bill_upload != "") {
				$sql .= " bill_upload='$bill_upload',";	}
			if($supporting_doc != "") {
				$sql .= " supporting_doc='$supporting_doc',";	}				

		$sql.="gst_percent='$gst_per',
			gst_amount='$gst_amount',
			round_off='$round_off',
			last_update_user='$last_update_user',
			last_update_date=NOW()
			where bill_entry_id='$bill_entry_id'";

				//		gst_percent,gst_amount,round_off,last_update_user,last_update_date)
				//'$gst_per','$gst_amount','$round_off','$last_update_user',NOW())"			

			$result=mysqli_query($con,$sql);	

			$log_file = "my-errors.log";

			error_log($sql,3,$log_file);


			if(mysqli_errno($con)==0) 
				{ 
					$_SESSION['msg']="<div class='success-message'>Bill Entry  $bill_entry_id Successfully Updated</div>";

					//echo " <BR>Prit - 1 -" .mysqli_error($con);
					//echo "<br>";
				} 
				else 
				{
					$msg= "<div class='error-message'> Error Message - ".mysqli_error($con)."  Bill Entry Not updated </div>";
//					$_SESSION['msg']="<div class='error-message'>Book Not Addedd $msg</div>";
					$_SESSION['msg']=$msg;

					//echo " <BR>Prit - 2" .mysqli_error($con);
					//echo "<br>";
					$time=time()+19800; // Timestamp is in GMT now converted to IST
					$date=date('d_m_Y_H_i_s',$time);
					error_log("\n *******Fail **************** \n " .$date,3,$log_file);
					error_log("\n ".mysqli_error($con),3,$log_file);
					error_log("\n".$sql."\n ",3,$log_file);

				}

			}
			else
			{
				$msg="Bill Entry Not Updated  $pay_attached Payments already attached to the Bill  ";
				$_SESSION['msg']="<div class='error-message'>$msg</div>";	

			}				

				$_SESSION['uid']=11;
				release_connection($con);

	}
}


function delete()
{
	$con=get_connection();
	if(($_REQUEST['bill_entry_id']) && ($_SESSION['uid']==77))
	{

		$bill_entry_id=$_REQUEST['bill_entry_id'];

		$check_pay_sql=" select * from txt_payment_bill_entry where delete_tag='FALSE' and bill_entry_id='$bill_entry_id' ";

		$pay_attached=0;
		$result=mysqli_query($con,$check_pay_sql);
		while($rs=mysqli_fetch_array($result))
		{
			$pay_attached++;
		}


		if($pay_attached==0)
		{


				
				$delete_user=$_SESSION['LOGID'];
				//$sql="delete from txt_bill_entry where bill_entry_id='$bill_entry_id'";

				$sql=" update txt_bill_entry set  delete_tag='TRUE',";
				$sql .=" delete_user='$delete_user',";
				$sql .=" delete_date=NOW()";
				$sql .=" where bill_entry_id='$bill_entry_id'";

				$log_file = "my-errors.log";
				error_log($sql,3,$log_file);


				$result=mysqli_query($con,$sql);
				if(mysqli_errno($con)==0) 
				{ 
					$_SESSION['msg']="<div class='success-message'>Bill Entry Successfully Deleted</div>";
				} 
				else 
				{
					$msg=" Error Code (".mysqli_errno($con).") Bill Entry Not Deleted  ";
					$_SESSION['msg']="<div class='error-message'>$msg</div>";
					echo " <BR>Prit - 2 -" .mysqli_error($con);
					echo "<br>";
					$time=time()+19800; // Timestamp is in GMT now converted to IST
					$date=date('d_m_Y_H_i_s',$time);
					error_log("\n *******Fail **************** \n " .$date,3,$log_file);
					error_log("\n ".mysqli_error($con),3,$log_file);
					error_log("\n".$sql."\n ",3,$log_file);
				}
		}
		else
		{
			$msg="Bill Entry Not Deleted  $pay_attached Payments already attached to the Bill  ";
			$_SESSION['msg']="<div class='error-message'>$msg</div>";	
		}
		$_SESSION['uid']=11;

		release_connection($con);

	}
}

function removeFile()
{
	echo "Remove File";
	$log_file = "my-errors.log";
	echo ":--".$_REQUEST['bill_entry_id'];
	echo $_SESSION['uid'];
	if(($_REQUEST['bill_entry_id']) && ($_SESSION['uid']==77))
	{
		//echo "Remove File inside if";

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
					$msg= "File Delete Error - ".mysqli_error($con)." -File Not Deleteted";
					$_SESSION['msg']="<div class='success-message'>$msg</div>";
					echo " <BR>Prit - 2" .mysqli_error($con);
					echo "<br>";
					$time=time()+19800; // Timestamp is in GMT now converted to IST
					$date=date('d_m_Y_H_i_s',$time);
					error_log("\n *******Fail **************** \n " .$date,3,$log_file);
					error_log("\n ".mysqli_error($con),3,$log_file);
					error_log("\n".$sql_update."\n ",3,$log_file);
				}
				
			

		$req_disp="";
		if(isset($_REQUEST['disp'])){
			$req_disp=$_REQUEST['disp'];
		}
		if($req_disp!='child'){
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
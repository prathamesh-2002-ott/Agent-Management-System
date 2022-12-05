<?php include("../includes/check_session.php");
include("../includes/config.php");
ini_set("max_execution_time", "500");
?>


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
		
		process_payment_entry_redirect( "<script language='javascript'>");
		process_payment_entry_redirect( "location.href='add_payment_entry.php'");
		process_payment_entry_redirect( "</script>");
		
	}else{	

		if($req_src=='search') { 
			$supplier_code=$_REQUEST['search_supplier_account_code'];
			$buyer_code=$_REQUEST['search_buyer_account_code'];
			$vou_start_date=$_REQUEST['vou_start_date'];
			$vou_end_date=$_REQUEST['vou_end_date'];
			$src_man_vou_num=$_REQUEST['src_man_vou_num'];
			$src_pay_ent_id=$_REQUEST['src_pay_ent_id'];			
			//src=search&vou_end_date=$vou_end_date&vou_start_date=$vou_start_date&bill_end_date=$bill_end_date&bill_start_date=$bill_start_date&buyer_account_code=$buyer_code&supplier_account_code=$supplier_code&bill_entry_id=$bill_entry_id
			process_payment_entry_redirect( "<script language='javascript'>");
			process_payment_entry_redirect( "location.href='payment_search.php?src=search&src_man_vou_num=$src_man_vou_num&src_pay_ent_id=$src_pay_ent_id&vou_end_date=$vou_end_date&vou_start_date=$vou_start_date&search_buyer_account_code=$buyer_code&search_supplier_account_code=$supplier_code&payment_entry_id=$payment_entry_id'");
			process_payment_entry_redirect( "</script>");			
		 } else {
			
			process_payment_entry_redirect( "<script language='javascript'>");
			process_payment_entry_redirect( "location.href='index.php'");
			process_payment_entry_redirect( "</script>");
			
		 }
	}
}else {
	process_payment_entry_redirect( "<script language='javascript'>");
	process_payment_entry_redirect( "location.href='../ledger/child_update_submit.php'");
	process_payment_entry_redirect( "</script>");

}

function save() {

	$con=get_connection();

	if(($_REQUEST['manual_voucher_number']) && ($_SESSION['uid']==77)) 	{
		$log_file = "my-errors.log";

		$_SESSION['uid']=11; // this is to prevent the call of function if Save is clicked twice .

		$last_update_user=$_SESSION['LOGID'];

		$manual_voucher_number=$_REQUEST['manual_voucher_number'];
		$voucher_date=$_REQUEST['voucher_date'];
		$voucher_type=$_REQUEST['voucher_type'];
		$supplier_account_code=$_REQUEST['supplier_account_code'];
		$buyer_account_code=$_REQUEST['buyer_account_code'];
		$narration=$_REQUEST['narration'];
		$total_amount=blankToZero($_REQUEST['total_amount']);
		$total_discount=blankToZero($_REQUEST['total_discount']);
		$total_goods_return=blankToZero($_REQUEST['total_goods_return']);


		$supporting_doc_1="";
		if($_FILES['supporting_doc_1']['name']!="") { // only if files are selected -- to pevent blank entry in table
			$file_name_supporting_doc_1 = $_FILES['supporting_doc_1']['name'];
			$file_size_supporting_doc_1 =$_FILES['supporting_doc_1']['size'];
			$file_tmp_supporting_doc_1 =$_FILES['supporting_doc_1']['tmp_name'];
			$file_type_supporting_doc_1=$_FILES['supporting_doc_1']['type'];	
			if($file_size_supporting_doc_1 > 2097152){
				$errors[]='File size must be less than 2 MB';
			}	 //if($file_size_supporting_doc_1 > 2097152)	
				$random_digit=time()+3;
				$file_name_supporting_doc_1 = str_replace(' ', '_', $file_name_supporting_doc_1);
				$file_name_supporting_doc_1 = $random_digit."_".$file_name_supporting_doc_1;
					move_uploaded_file($file_tmp_supporting_doc_1,"upload/".$file_name_supporting_doc_1); //process_payment_entry_logging_disp(  $file_name1);
					$supporting_doc_1=$file_name_supporting_doc_1;
		}//if($_FILES['supporting_doc_1']['name']!="") 

		$supporting_doc_2="";
		if($_FILES['supporting_doc_2']['name']!="") { // only if files are selected -- to pevent blank entry in table
			$file_name_supporting_doc_2 = $_FILES['supporting_doc_2']['name'];
			$file_size_supporting_doc_2 =$_FILES['supporting_doc_2']['size'];
			$file_tmp_supporting_doc_2 =$_FILES['supporting_doc_2']['tmp_name'];
			$file_type_supporting_doc_2=$_FILES['supporting_doc_2']['type'];	
			if($file_size_supporting_doc_2 > 2097152){
				$errors[]='File size must be less than 2 MB';
			}		
				$random_digit=time()+4;
				$file_name_supporting_doc_2 = str_replace(' ', '_', $file_name_supporting_doc_2);
				$file_name_supporting_doc_2 = $random_digit."_".$file_name_supporting_doc_2;
					move_uploaded_file($file_tmp_supporting_doc_2,"upload/".$file_name_supporting_doc_2); //process_payment_entry_logging_disp(  $file_name1);
					$supporting_doc_2=$file_name_supporting_doc_2;
		}	// if($_FILES['supporting_doc_2']['name']!="")	

		$voucher_date=convert_date($voucher_date);
		

		$payment_entry_id=0; // will populated once insert query for Main is executed.

		$sql_main="insert into 
			txt_payment_entry_main
			(manual_vou_number,
			voucher_date, 
			supplier_account_code,
			buyer_account_code,
			payment_amount,
			discount_amount,
			gr_amount,
			vou_type,
			narration,
			supporting_doc_1,
			supporting_doc_2,
			last_update_user,
			last_update_date,
			create_user,
			create_date
			)
			values
			('$manual_voucher_number',
			'$voucher_date',
			'$supplier_account_code',
			'$buyer_account_code',
			'$total_amount',
			'$total_discount',
			'$total_goods_return',
			'$voucher_type',
			'$narration',
			'$supporting_doc_1',
			'$supporting_doc_2',
			'$last_update_user',
			NOW(),			
			'$last_update_user',
			NOW()
			)";

			
			$sql_error_message="";
			$sql_success_code=0;

			$result=mysqli_query($con,$sql_main);
			process_payment_entry_logging_disp(  $sql_main);

			// Payment Entry ID
			$payment_entry_id=mysqli_insert_id($con);
			if(mysqli_errno($con)==0) { 
				$sql_success_code+=0;
				//$_SESSION['msg']="<div class='success-message'>Payment Entry (".$payment_entry_id.") Successfully Added</div>";
				process_payment_entry_logging_disp( "Payment Entry Main - Success" .mysqli_error($con));
				process_payment_entry_logging_disp( "Payment Entry Id - ".$payment_entry_id);

			} else {
				$sql_success_code+=1;
				$sql_error_message = $sql_error_message."-MAIN-";
				process_payment_entry_logging_disp( " Payment Entry Main - Error" .mysqli_error($con));

	
				process_payment_entry_error_log("\n *******Fail **************** \n " .date_time());
				process_payment_entry_error_log("\n ".mysqli_error($con));
				process_payment_entry_error_log("\n".$sql_main."\n ");

				//$_SESSION['msg']="<div class='error-message'>Payment Entry Not Addedd</div>";

			} //if(mysqli_errno($con)==0)


	if((mysqli_errno($con)==0)){
		if(  ($voucher_type=="Payment" || $voucher_type=="Advance Payment" || $voucher_type=="Discount" )){


			$cheque_number_array=$_REQUEST['cheque_number'];
			$cheque_number_array_size=sizeof($cheque_number_array);

			$bank_name_array=$_REQUEST['bank_name'];
			$chq_amount_array=$_REQUEST['chq_amount'];
			$cheque_date_array=$_REQUEST['cheque_date'];
			$discount_amt_array=$_REQUEST['discount_amt'];
			$chq_remarks_array=$_REQUEST['chq_remarks'];

			for($a=0;$a<$cheque_number_array_size;$a++){

			$cheque_date_array[$a]=convert_date($cheque_date_array[$a]);
			$chq_amount_array[$a] =blankToZero($chq_amount_array[$a]);
			$discount_amt_array[$a] =blankToZero($discount_amt_array[$a]);
			

				if($chq_amount_array[$a]>0 || $discount_amt_array[$a]>0 ){
					$sql_chq[$a]="insert into
							txt_payment_cheque_entry
							(
							payment_entry_id,
							chq_number,
							chq_date,
							bank,
							chq_amt,
							dis_amt,
							remark,
							create_user,
							create_date
							)
							values
							(
							'$payment_entry_id',
							'$cheque_number_array[$a]', 
							'$cheque_date_array[$a]',
							'$bank_name_array[$a]',
							'$chq_amount_array[$a]',
							'$discount_amt_array[$a]',
							'$chq_remarks_array[$a]',
							'$last_update_user',
								NOW()
							)";
				
							process_payment_entry_logging_disp( $sql_chq[$a]);
							$result=mysqli_query($con,$sql_chq[$a]);

							
							if(mysqli_errno($con)==0) 
							{ 
								$sql_success_code+=0;
								//$_SESSION['msg']="<div class='success-message'>Payment Entry Chq Successfully Added</div>";

								process_payment_entry_logging_disp(  "Chq  - Success" .mysqli_error($con));
								process_payment_entry_logging_disp(  "Payment Entry Id - ".$payment_entry_id);

							
							} 
							else 
							{
								$sql_success_code+=1;  
								$sql_error_message= $sql_error_message. " CHQ ".$a ." ";

								process_payment_entry_logging_disp(  " Chq - Fail" .mysqli_error($con));


								process_payment_entry_error_log("\n *******Fail **************** \n " .date_time());
								process_payment_entry_error_log("\n ".mysqli_error($con));
								process_payment_entry_error_log("\n".$$sql_chq[$a]."\n ");

								//$_SESSION['msg']="<div class='error-message'>Payment Entry Chq Details Not Addedd</div>";
							}//if(mysqli_errno($con)==0) 

				}// if($chq_amount_array[$a]>0 || $discount_amt_array[$a]>0 )

			}//for($a=0;$a<$cheque_number_array_size;$a++)
		}else if ( $voucher_type=="Goods Return" || $voucher_type=="GR After Payment"){



			$lr_number_array=$_REQUEST['lr_number'];
			$lr_number_array_size=sizeof($lr_number_array);

			$transport_name_array=$_REQUEST['transport_name'];
			$booked_to_array=$_REQUEST['booked_to'];
			$lr_date_array=$_REQUEST['lr_date'];
			$goods_return_amt_array=$_REQUEST['goods_return_amt'];
			$no_of_bales_array=$_REQUEST['no_of_bales'];
			$total_weight_array=$_REQUEST['total_weight'];
			$gr_remarks_array=$_REQUEST['gr_remarks'];

			for($a=0;$a<$lr_number_array_size;$a++){

				$lr_date_array[$a]=convert_date($lr_date_array[$a]);
				$goods_return_amt_array[$a]=blankToZero($goods_return_amt_array[$a]);

				if($goods_return_amt_array[$a]>0){
					$sql_lr[$a]="insert into
					txt_payment_gr_entry
					(
					payment_entry_id,
					lr_number,
					lr_date,
					transport,
					booked_to,
					number_of_bales,
					total_weight,
					gr_amount,
					remark,
					create_user,
					create_date
					)
					values
					(
					'$payment_entry_id',
					'$lr_number_array[$a]', 
					'$lr_date_array[$a]',
					'$transport_name_array[$a]',
					'$booked_to_array[$a]',
					'$no_of_bales_array[$a]',
					'$total_weight_array[$a]',
					'$goods_return_amt_array[$a]',
					'$gr_remarks_array[$a]',
					'$last_update_user',
						NOW()
					)";		
					$result=mysqli_query($con,$sql_lr[$a]);
						
					if(mysqli_errno($con)==0) 
					{ 
						$sql_success_code+=0;
						//$_SESSION['msg']="<div class='success-message'>Payment Entry LR Successfully Added</div>";
						process_payment_entry_logging_disp(  "GR - Success" .mysqli_error($con));
						process_payment_entry_logging_disp(  "Payment Entry Id - ".$payment_entry_id);

					} 
					else 
					{
						$sql_success_code+=1;
						$sql_error_message = $sql_error_message ." LR " .$a ."<br> ";
						//$_SESSION['msg']="<div class='error-message'>Payment Entry Goods Return Details Not Addedd</div>";
						process_payment_entry_logging_disp(  " GR - Fail" .mysqli_error($con));

	
						process_payment_entry_error_log("\n *******Fail **************** \n " .date_time());
						process_payment_entry_error_log("\n ".mysqli_error($con));
						process_payment_entry_error_log("\n".$sql_lr[$a]."\n ");
					} //if(mysqli_errno($con)==0)

				} //if($goods_return_amt_array[$a]>0)

			} // for($a=0;$a<$lr_number_array_size;$a++)

		} //else if ( $voucher_type=="Goods Return" || $voucher_type=="GR After Payment")
	if((mysqli_errno($con)==0)){  // - 2

		if($voucher_type=="Advance Payment" ){

			// will  be implemented later
			
			$_SESSION['msg']="<div class='success-message'>Payment Entry (".$payment_entry_id.")  Successfully Added</div>";
			

		}else {

			$total_amount_received=$_REQUEST['total_amount_received'];
			$total_discount_received=$_REQUEST['total_discount_received'];
			$total_goods_return_received=$_REQUEST['total_goods_return_received'];
			$amount_received_difference=$_REQUEST['amount_received_difference'];

			$bill_entry_id_array=$_REQUEST['bill_entry_id'];
			$bill_entry_id_array_size=sizeof($bill_entry_id_array);

			//$bill_voucher_number_array=$_REQUEST['bill_voucher_number'];
			//$bill_voucher_date_array=$_REQUEST['bill_voucher_date'];
			$bill_number_array=$_REQUEST['bill_number'];
			$bill_date_array=$_REQUEST['bill_date'];
			$bill_amt_array=$_REQUEST['bill_amt'];
			$adj_amt_array=$_REQUEST['adj_amt'];
			$adj_dis_array=$_REQUEST['adj_dis'];
			$adj_dis_array=$_REQUEST['adj_dis'];
			$adj_gr_array=$_REQUEST['adj_gr'];
			$bill_payment_type_array=$_REQUEST['bill_payment_type'];
			$bill_discount_percent_array=$_REQUEST['bill_discount_percent'];
			$bill_discount_amt_array=$_REQUEST['bill_discount_amt'];
			$bill_deduction_amt_array=$_REQUEST['bill_deduction_amt'];

			$bill_goods_return_array=$_REQUEST['bill_goods_return'];
			$bill_received_amt_array=$_REQUEST['bill_received_amt'];
			$bill_bal_amt_array=$_REQUEST['bill_bal_amt'];
			$bill_remarks_array=$_REQUEST['bill_remarks'];

			for($b=0;$b<$bill_entry_id_array_size;$b++){

				//$bill_voucher_date_array[$b]=convert_date($bill_voucher_date_array[$b]);
				$bill_date_array[$b]=convert_date($bill_date_array[$b]);

				$bill_amt_array[$b]=blankToZero($bill_amt_array[$b]);
				$adj_amt_array[$b]=blankToZero($adj_amt_array[$b]);
				$adj_gr_array[$b]=blankToZero($adj_gr_array[$b]);
				$adj_dis_array[$b]=blankToZero($adj_dis_array[$b]);
				$bill_received_amt_array[$b]=blankToZero($bill_received_amt_array[$b]);
				$bill_discount_percent_array[$b]=blankToZero($bill_discount_percent_array[$b]);
				$bill_discount_amt_array[$b]=blankToZero($bill_discount_amt_array[$b]);
				$bill_deduction_amt_array[$b]=blankToZero($bill_deduction_amt_array[$b]);
				$bill_goods_return_array[$b]=blankToZero($bill_goods_return_array[$b]);
				$bill_bal_amt_array[$b]=blankToZero($bill_bal_amt_array[$b]);

				if($bill_payment_type_array[$b]=="Full" || $bill_payment_type_array[$b]=="Part"){

					$sql_bill[$b]="insert into 
							txt_payment_bill_entry 
							(
								payment_entry_id,
								payment_entry_vou_date,
								bill_entry_id,
								bill_number,
								bill_date,
								bill_amount,
								amount_adjusted,
								gr_adjusted,
								discount_adjusted,
								bill_payment_type,
								payment_received,
								dis_percent,
								dis_amount,
								deduction_amount,
								bill_gr_amt,
								balance_amount,
								remark,
								create_user,
								create_date
							)
							values
							(
								'$payment_entry_id',
								'$voucher_date',
								'$bill_entry_id_array[$b]',
								'$bill_number_array[$b]',
								'$bill_date_array[$b]',
								'$bill_amt_array[$b]',
								'$adj_amt_array[$b]',
								'$adj_gr_array[$b]',
								'$adj_dis_array[$b]',
								'$bill_payment_type_array[$b]',
								'$bill_received_amt_array[$b]',
								'$bill_discount_percent_array[$b]',
								'$bill_discount_amt_array[$b]',
								'$bill_deduction_amt_array[$b]',
								'$bill_goods_return_array[$b]',
								'$bill_bal_amt_array[$b]',
								'$bill_remarks_array[$b]',
								'$last_update_user',
								NOW()
							)";
							$result=mysqli_query($con,$sql_bill[$b]);
						
							if(mysqli_errno($con)==0) 
							{ 
								$sql_success_code+=0;
								//$_SESSION['msg']="<div class='success-message'>Payment Entry Bill Successfully Added</div>";
								process_payment_entry_logging_disp(  " Payment Bill - Success" .mysqli_error($con));
								process_payment_entry_logging_disp(  "Payment Entry Id  - Bill - ".$bill_number_array[$b]);

							} 
							else 
							{
								$sql_success_code+=1;
								$sql_error_message=$sql_error_message."  BILL - ".$bill_number_array[$b] ." ";
								//$_SESSION['msg']="<div class='error-message'>Payment Entry Bill Details Not Addedd</div>";
								process_payment_entry_logging_disp(  " Payment Bill  - Fail" .mysqli_error($con));

	
								process_payment_entry_error_log("\n *******Fail **************** \n " .date_time());
								process_payment_entry_error_log("\n ".mysqli_error($con));
								process_payment_entry_error_log("\n".$sql_bill[$b]."\n ");								
							} //if(mysqli_errno($con)==0) 

				} //if($bill_payment_type_array[$b]=="Full" || $bill_payment_type_array[$b]=="Part")

			} //for($b=0;$b<$bill_entry_id_array_size;$b++)
							
							if($sql_success_code>0){
								$_SESSION['msg']="<div class='error-message'>Payment Entry (".$payment_entry_id.") Partially Added ,  Bill Details Not Addedd ( ".$sql_error_message." )</div>";

							}else{
								$_SESSION['msg']="<div class='success-message'>Payment Entry (".$payment_entry_id.")  Successfully Added</div>";
							}
							
		} //if($voucher_type=="Advance Payment" )
		
	} else{ //if((mysqli_errno($con)==0)) - 2
		if($sql_success_code>0){
			$_SESSION['msg']="<div class='error-message'>Payment Entry (".$payment_entry_id.") Partially Added , Chque/GR &  Bill Details Not Addedd ".$sql_error_message."</div>";

		}else{
			$_SESSION['msg']="<div class='success-message'>Payment Entry (".$payment_entry_id.")  Successfully Added</div>";
		}

	} //if((mysqli_errno($con)==0)) - 2 - else

	}else{   // if((mysqli_errno($con)==0))
	if($sql_success_code>0){
		$_SESSION['msg']="<div class='error-message'>Payment Entry  Not Addedd ".$sql_error_message."</div>";

	}else{
		$_SESSION['msg']="<div class='success-message'>Payment Entry (".$payment_entry_id.")  Successfully Added</div>";
	} //if($sql_success_code>0)

	} // if((mysqli_errno($con)==0)) - else

 	//if($sql_success_code>0) {}
			/*
			$chq_len=sizeof($sql_chq);

			$lr_len=sizeof($sql_lr);

			$bill_len=sizeof($sql_bill);


			for($a=0;$a<$chq_len;$a++){
				process_payment_entry_logging_disp(  "Cheque Query - ".$a."-".$sql_chq[$a]);

			}

			for($a=0;$a<$lr_len;$a++){
				process_payment_entry_logging_disp(  "Lr  Query - ".$a."-".$sql_lr[$a]);

			}

			for($a=0;$a<$bill_len;$a++){
				process_payment_entry_logging_disp(  "Bill  Query - ".$a."-".$sql_bill[$a]);

			}
			*/
	
	} // if(($_REQUEST['manual_voucher_number']) && ($_SESSION['uid']==77))
	$_SESSION['uid']=11;

	release_connection($con);

} // function save()

/*
Update Function 
This function will update main table and will delete(update with delete tag) the child records 
and insert new records
*/

function update() {
	$con=get_connection();
	$log_file = "my-errors.log";
	if(($_REQUEST['payment_entry_id']) && ($_SESSION['uid']==77))
	{

		$_SESSION['uid']=11; // this is to prevent the call of function if Save is clicked twice .
		
		$last_update_user=$_SESSION['LOGID'];

		$payment_entry_id=$_REQUEST['payment_entry_id'];
		$manual_voucher_number=$_REQUEST['manual_voucher_number'];
		$voucher_date=$_REQUEST['voucher_date'];
		$voucher_type=$_REQUEST['voucher_type'];
		$supplier_account_code=$_REQUEST['supplier_account_code'];
		$buyer_account_code=$_REQUEST['buyer_account_code'];
		$narration=$_REQUEST['narration'];
		/*
		$total_amount=$_REQUEST['total_amount'];
		$total_discount=$_REQUEST['total_discount'];
		$total_goods_return=$_REQUEST['total_goods_return'];
		*/

		$total_amount=blankToZero($_REQUEST['total_amount']);
		$total_discount=blankToZero($_REQUEST['total_discount']);
		$total_goods_return=blankToZero($_REQUEST['total_goods_return']);


		$voucher_date=convert_date($voucher_date);
		$supporting_doc_1="";
		if($_FILES['supporting_doc_1']['name']!="") { // only if files are selected -- to pevent blank entry in table
			$file_name_supporting_doc_1 = $_FILES['supporting_doc_1']['name'];
			$file_size_supporting_doc_1 =$_FILES['supporting_doc_1']['size'];
			$file_tmp_supporting_doc_1 =$_FILES['supporting_doc_1']['tmp_name'];
			$file_type_supporting_doc_1=$_FILES['supporting_doc_1']['type'];	
			if($file_size_supporting_doc_1 > 2097152){
				$errors[]='File size must be less than 2 MB';
			}		
				$random_digit=time()+3;
				$file_name_supporting_doc_1 = str_replace(' ', '_', $file_name_supporting_doc_1);
				$file_name_supporting_doc_1 = $random_digit."_".$file_name_supporting_doc_1;
					move_uploaded_file($file_tmp_supporting_doc_1,"upload/".$file_name_supporting_doc_1); //process_payment_entry_logging_disp(  $file_name1);
					$supporting_doc_1=$file_name_supporting_doc_1;
		} // if($_FILES['supporting_doc_1']['name']!="")
		$supporting_doc_2="";
		if($_FILES['supporting_doc_2']['name']!="") { // only if files are selected -- to pevent blank entry in table
			$file_name_supporting_doc_2 = $_FILES['supporting_doc_2']['name'];
			$file_size_supporting_doc_2 =$_FILES['supporting_doc_2']['size'];
			$file_tmp_supporting_doc_2 =$_FILES['supporting_doc_2']['tmp_name'];
			$file_type_supporting_doc_2=$_FILES['supporting_doc_2']['type'];	
			if($file_size_supporting_doc_2 > 2097152){
				$errors[]='File size must be less than 2 MB';
			}		
				$random_digit=time()+4;
				$file_name_supporting_doc_2 = str_replace(' ', '_', $file_name_supporting_doc_2);
				$file_name_supporting_doc_2 = $random_digit."_".$file_name_supporting_doc_2;
					move_uploaded_file($file_tmp_supporting_doc_2,"upload/".$file_name_supporting_doc_2); //process_payment_entry_logging_disp(  $file_name1);
					$supporting_doc_2=$file_name_supporting_doc_2;
		}	 // if($_FILES['supporting_doc_2']['name']!="")	
		

		$update_sql_main= "UPDATE txt_payment_entry_main  set
			manual_vou_number='$manual_voucher_number',
			voucher_date='$voucher_date', 
			payment_amount='$total_amount',
			discount_amount='$total_discount', 
			gr_amount='$total_goods_return', 
			narration='$narration',
			vou_type='$voucher_type',";

		if($supporting_doc_1 != "") {
			$update_sql_main .= " supporting_doc_1='$supporting_doc_1',";	}

		if($supporting_doc_2 != "") {
			$update_sql_main .= " supporting_doc_2='$supporting_doc_2',";	}
	

		$update_sql_main.=" last_update_user='$last_update_user',
			last_update_date=NOW()
			WHERE payment_entry_id='$payment_entry_id' ";
		
		//process_payment_entry_logging_disp(  $update_sql_main);



			
			$sql_error_message="";
			$sql_success_code=0;

			$result=mysqli_query($con,$update_sql_main);

			// process_payment_entry_logging_disp(  $result );

			if(mysqli_errno($con)==0) 
			{ 
				$sql_success_code+=0;
				//$_SESSION['msg']="<div class='success-message'>Payment Entry (".$payment_entry_id.") Successfully Added</div>";
				process_payment_entry_logging_disp("Payment Entry Main - 1" .mysqli_error($con));
				process_payment_entry_logging_disp( "Payment Entry Id - ".$payment_entry_id);
			
			} 
			else 
			{
				$sql_success_code+=1;
				$sql_error_message= $sql_error_message. " -MAIN- ";

				process_payment_entry_logging_disp( " Payment Entry Main - 2" .mysqli_error($con));


				process_payment_entry_error_log("\n *******Fail **************** \n " .date_time());
				process_payment_entry_error_log("\n ".mysqli_error($con));
				process_payment_entry_error_log("\n".$update_sql_main."\n ");				

				//$_SESSION['msg']="<div class='error-message'>Payment Entry Not Addedd</div>";

			} // if(mysqli_errno($con)==0)

		if((mysqli_errno($con)==0)){			

			if($voucher_type=="Payment" || $voucher_type=="Advance Payment" || $voucher_type=="Discount" ){


				$cheque_number_array=$_REQUEST['cheque_number'];
				$cheque_number_array_size=sizeof($cheque_number_array);

				$bank_name_array=$_REQUEST['bank_name'];
				$chq_amount_array=$_REQUEST['chq_amount'];
				$cheque_date_array=$_REQUEST['cheque_date'];
				$discount_amt_array=$_REQUEST['discount_amt'];
				$chq_remarks_array=$_REQUEST['chq_remarks'];

				$sql_chq_del="UPDATE txt_payment_cheque_entry SET
								delete_tag='TRUE',
								last_update_user='$last_update_user',
								last_update_date=NOW() ,
								delete_date=NOW()
								where payment_entry_id='$payment_entry_id' ";

				//process_payment_entry_logging_disp(  $sql_chq_del);		


				$result=mysqli_query($con,$sql_chq_del);

				// process_payment_entry_logging_disp(  $result);

				if(mysqli_errno($con)==0) 
				{ 
					$sql_success_code+=0;
					//$_SESSION['msg']="<div class='success-message'>Payment Entry (".$payment_entry_id.") Successfully Added</div>";
					process_payment_entry_logging_disp(  "Chq  - 1" .mysqli_error($con));
					process_payment_entry_logging_disp(  "Payment Entry Id - ".$payment_entry_id);

				} 
				else 
				{
					$sql_success_code+=1;
					$sql_error_message= $sql_error_message. " CHQ Entry Delete";

					process_payment_entry_logging_disp(  " Chq Entry Delete -" .mysqli_error($con));

					process_payment_entry_error_log("\n *******Fail **************** \n " .date_time());
					process_payment_entry_error_log("\n ".mysqli_error($con));
					process_payment_entry_error_log("\n".$sql_chq_del."\n ");

					//$_SESSION['msg']="<div class='error-message'>Payment Entry Not Addedd</div>";

				} //if(mysqli_errno($con)==0) 			

				if(mysqli_errno($con)==0) { 				
					for($a=0;$a<$cheque_number_array_size;$a++){

						$cheque_date_array[$a]=convert_date($cheque_date_array[$a]);
						$chq_amount_array[$a] =blankToZero($chq_amount_array[$a]);
						$discount_amt_array[$a] =blankToZero($discount_amt_array[$a]);
			
						if($chq_amount_array[$a]>0 || $discount_amt_array[$a]>0 ){

							$sql_chq[$a]="insert into
									txt_payment_cheque_entry
									(
									payment_entry_id,
									chq_number,
									chq_date,
									bank,
									chq_amt,
									dis_amt,
									remark,
									create_user,
									create_date
									)
									values
									(
									'$payment_entry_id',
									'$cheque_number_array[$a]', 
									'$cheque_date_array[$a]',
									'$bank_name_array[$a]',
									'$chq_amount_array[$a]',
									'$discount_amt_array[$a]',
									'$chq_remarks_array[$a]',
									'$last_update_user',
										NOW()
									)";
						
									$result=mysqli_query($con,$sql_chq[$a]);
									process_payment_entry_logging_disp(  $sql_chq[$a]);

									if(mysqli_errno($con)==0) 
									{ 
										$sql_success_code+=0;
										//$_SESSION['msg']="<div class='success-message'>Payment Entry Chq Successfully Added</div>";
										//process_payment_entry_logging_disp(  "Chq Success");
										process_payment_entry_logging_disp(  " Chq  - 1" .mysqli_error($con));
										process_payment_entry_logging_disp(  "Payment Entry Id - ".$payment_entry_id);
								
									} 
									else 
									{
										$sql_success_code+=1;  
										$sql_error_message= $sql_error_message. " CHQ ".$a ." ";

										process_payment_entry_logging_disp(  " Chq - 2" .mysqli_error($con));


										process_payment_entry_error_log("\n *******Fail **************** \n " .date_time());
										process_payment_entry_error_log("\n ".mysqli_error($con));
										process_payment_entry_error_log("\n".$sql_chq[$a]."\n ");
										//process_payment_entry_logging_disp(  "Chq Fail");

										//$_SESSION['msg']="<div class='error-message'>Payment Entry Chq Details Not Addedd</div>";
									} //if(mysqli_errno($con)==0) 

						} //if($chq_amount_array[$a]>0 || $discount_amt_array[$a]>0 )

					} // for($a=0;$a<$cheque_number_array_size;$a++)

				} //if(mysqli_errno($con)==0)
			}else if ( $voucher_type=="Goods Return" || $voucher_type=="GR After Payment"){



				$lr_number_array=$_REQUEST['lr_number'];
				$lr_number_array_size=sizeof($lr_number_array);

				$transport_name_array=$_REQUEST['transport_name'];
				$booked_to_array=$_REQUEST['booked_to'];
				$lr_date_array=$_REQUEST['lr_date'];
				$goods_return_amt_array=$_REQUEST['goods_return_amt'];
				$no_of_bales_array=$_REQUEST['no_of_bales'];
				$total_weight_array=$_REQUEST['total_weight'];
				$gr_remarks_array=$_REQUEST['gr_remarks'];
				
				$sql_gr_del="UPDATE txt_payment_gr_entry SET
								delete_tag='TRUE',
								last_update_user='$last_update_user',
								last_update_date=NOW() ,
								delete_date=NOW()
								where payment_entry_id='$payment_entry_id' ";

				//process_payment_entry_logging_disp(  $sql_gr_del);		


				$result=mysqli_query($con,$sql_gr_del);

				// process_payment_entry_logging_disp(  $result);

				if(mysqli_errno($con)==0) 
				{ 
					$sql_success_code+=0;
					//$_SESSION['msg']="<div class='success-message'>Payment Entry (".$payment_entry_id.") Successfully Added</div>";
					process_payment_entry_logging_disp(  "Old GR - 1" .mysqli_error($con));
					process_payment_entry_logging_disp(  "Payment Entry Id - ".$payment_entry_id);
			
				} 
				else 
				{
					$sql_success_code+=1;
					$sql_error_message=$sql_error_message."- Old GR Remove -";
					process_payment_entry_logging_disp(  " Old GR - 2" .mysqli_error($con));


					process_payment_entry_error_log("\n *******Fail **************** \n " .date_time());
					process_payment_entry_error_log("\n ".mysqli_error($con));
					process_payment_entry_error_log("\n".$sql_gr_del."\n ");				

					//$_SESSION['msg']="<div class='error-message'>Payment Entry Not Addedd</div>";

				} //if(mysqli_errno($con)==0)			

				if(mysqli_errno($con)==0) 
				{
					for($a=0;$a<$lr_number_array_size;$a++){

						$lr_date_array[$a]=convert_date($lr_date_array[$a]);
						$goods_return_amt_array[$a]=blankToZero($goods_return_amt_array[$a]);

						if($goods_return_amt_array[$a]>0){
							$sql_lr[$a]="insert into
							txt_payment_gr_entry
							(
							payment_entry_id,
							lr_number,
							lr_date,
							transport,
							booked_to,
							number_of_bales,
							total_weight,
							gr_amount,
							remark,
							create_user,
							create_date
							)
							values
							(
							'$payment_entry_id',
							'$lr_number_array[$a]', 
							'$lr_date_array[$a]',
							'$transport_name_array[$a]',
							'$booked_to_array[$a]',
							'$no_of_bales_array[$a]',
							'$total_weight_array[$a]',
							'$goods_return_amt_array[$a]',
							'$gr_remarks_array[$a]',
							'$last_update_user',
								NOW()
							)";		
							$result=mysqli_query($con,$sql_lr[$a]);
							//process_payment_entry_logging_disp(  $sql_lr[$a]);

								
							if(mysqli_errno($con)==0) 
							{ 
								$sql_success_code+=0;
								//$_SESSION['msg']="<div class='success-message'>Payment Entry LR Successfully Added</div>";
								process_payment_entry_logging_disp(  " GR - 1" .mysqli_error($con));
								process_payment_entry_logging_disp(  "Payment Entry Id - ".$payment_entry_id);
					
							} 
							else 
							{
								$sql_success_code+=1;
								$sql_error_message = $sql_error_message ." LR " .$a ." ";
								//$_SESSION['msg']="<div class='error-message'>Payment Entry Goods Return Details Not Addedd</div>";
								process_payment_entry_logging_disp(  " GR - 2" .mysqli_error($con));


								process_payment_entry_error_log("\n *******Fail **************** \n " .date_time());
								process_payment_entry_error_log("\n ".mysqli_error($con));
								process_payment_entry_error_log("\n".$sql_lr[$a]."\n ");

							} //if(mysqli_errno($con)==0) 
							
						} //if($goods_return_amt_array[$a]>0)

					} //for($a=0;$a<$lr_number_array_size;$a++)

				} //if((mysqli_errno($con)==0))

			} // else if ( $voucher_type=="Goods Return" || $voucher_type=="GR After Payment")
		


			if($voucher_type=="Advance Payment" || $voucher_type=="GR After Payment" ){

				// will  be implemented later

				$total_amount_received=$_REQUEST['total_amount_received'];
				$total_discount_received=$_REQUEST['total_discount_received'];
				$total_goods_return_received=$_REQUEST['total_goods_return_received'];
				$amount_received_difference=$_REQUEST['amount_received_difference'];

				$bill_entry_id_array=$_REQUEST['bill_entry_id'];
				$bill_entry_id_array_size=sizeof($bill_entry_id_array);

				//$bill_voucher_number_array=$_REQUEST['bill_voucher_number'];
				//$bill_voucher_date_array=$_REQUEST['bill_voucher_date'];
				$bill_number_array=$_REQUEST['bill_number'];
				$bill_date_array=$_REQUEST['bill_date'];
				$bill_amt_array=$_REQUEST['bill_amt'];
				$adj_amt_array=$_REQUEST['adj_amt'];
				$adj_dis_array=$_REQUEST['adj_dis'];
				$adj_dis_array=$_REQUEST['adj_dis'];
				$adj_gr_array=$_REQUEST['adj_gr'];
				$bill_payment_type_array=$_REQUEST['bill_payment_type'];
				$bill_discount_percent_array=$_REQUEST['bill_discount_percent'];
				$bill_discount_amt_array=$_REQUEST['bill_discount_amt'];
				$bill_deduction_amt_array=$_REQUEST['bill_deduction_amt'];

				$bill_goods_return_array=$_REQUEST['bill_goods_return'];
				$bill_received_amt_array=$_REQUEST['bill_received_amt'];
				$bill_bal_amt_array=$_REQUEST['bill_bal_amt'];
				$bill_remarks_array=$_REQUEST['bill_remarks'];

				$sql_bill_del="UPDATE txt_payment_bill_entry SET
				delete_tag='TRUE',
				last_update_user='$last_update_user',
				last_update_date=NOW(),
				delete_date=NOW()
				where payment_entry_id='$payment_entry_id' ";

				//process_payment_entry_logging_disp(  $sql_bill_del);		


				$result=mysqli_query($con,$sql_bill_del);

				// process_payment_entry_logging_disp(  $result);

				if(mysqli_errno($con)==0) 
				{ 
					$sql_success_code+=0;
					//$_SESSION['msg']="<div class='success-message'>Payment Entry (".$payment_entry_id.") Successfully Added</div>";
					process_payment_entry_logging_disp(  " Bill Entry Del 1" .mysqli_error($con));
					process_payment_entry_logging_disp(  "Payment Entry Id - ".$payment_entry_id);
			
				} 
				else 
				{
					$sql_success_code+=1;
					$sql_error_message=$sql_error_message."- BILL Entry Del -";

					process_payment_entry_logging_disp(  " BILL Entry Del" .mysqli_error($con));


					process_payment_entry_error_log("\n *******Fail **************** \n " .date_time());
					process_payment_entry_error_log("\n ".mysqli_error($con));
					process_payment_entry_error_log("\n".$sql_bill_del."\n ");				

					//$_SESSION['msg']="<div class='error-message'>Payment Entry Not Addedd</div>";

				}	//if(mysqli_errno($con)==0)			

			}else {
				// If any of the above Sql has failed we need to stop this execution
				if((mysqli_errno($con)==0)){
					$total_amount_received=$_REQUEST['total_amount_received'];
					$total_discount_received=$_REQUEST['total_discount_received'];
					$total_goods_return_received=$_REQUEST['total_goods_return_received'];
					$amount_received_difference=$_REQUEST['amount_received_difference'];

					$bill_entry_id_array=$_REQUEST['bill_entry_id'];
					$bill_entry_id_array_size=sizeof($bill_entry_id_array);

					//$bill_voucher_number_array=$_REQUEST['bill_voucher_number'];
					//$bill_voucher_date_array=$_REQUEST['bill_voucher_date'];
					$bill_number_array=$_REQUEST['bill_number'];
					$bill_date_array=$_REQUEST['bill_date'];
					$bill_amt_array=$_REQUEST['bill_amt'];
					$adj_amt_array=$_REQUEST['adj_amt'];
					$adj_dis_array=$_REQUEST['adj_dis'];
					$adj_dis_array=$_REQUEST['adj_dis'];
					$adj_gr_array=$_REQUEST['adj_gr'];
					$bill_payment_type_array=$_REQUEST['bill_payment_type'];
					$bill_discount_percent_array=$_REQUEST['bill_discount_percent'];
					$bill_discount_amt_array=$_REQUEST['bill_discount_amt'];
					$bill_deduction_amt_array=$_REQUEST['bill_deduction_amt'];

					$bill_goods_return_array=$_REQUEST['bill_goods_return'];
					$bill_received_amt_array=$_REQUEST['bill_received_amt'];
					$bill_bal_amt_array=$_REQUEST['bill_bal_amt'];
					$bill_remarks_array=$_REQUEST['bill_remarks'];

					$sql_bill_del="UPDATE txt_payment_bill_entry SET
					delete_tag='TRUE',
					last_update_user='$last_update_user',
					last_update_date=NOW(),
					delete_date=NOW()
					where payment_entry_id='$payment_entry_id' ";

					//process_payment_entry_logging_disp(  $sql_bill_del);		


					$result=mysqli_query($con,$sql_bill_del);

					// process_payment_entry_logging_disp(  $result);

					if(mysqli_errno($con)==0) 
					{ 
						$sql_success_code+=0;
						//$_SESSION['msg']="<div class='success-message'>Payment Entry (".$payment_entry_id.") Successfully Added</div>";
						process_payment_entry_logging_disp(  " Bill - 1" .mysqli_error($con));
						process_payment_entry_logging_disp(  "Payment Entry Id Bill Entry Delete ".$payment_entry_id);
										
					} 
					else 
					{
						$sql_success_code+=1;
						$sql_error_message=$sql_error_message."  Payment BILL Delete  - ";

						//$_SESSION['msg']="<div class='error-message'>Payment Entry Not Addedd</div>";

						process_payment_entry_logging_disp(  "Bill  - 2" .mysqli_error($con));
						

						process_payment_entry_error_log("\n *******Fail **************** \n " .date_time());
						process_payment_entry_error_log("\n ".mysqli_error($con));
						process_payment_entry_error_log("\n".$sql_bill_del."\n ");												

					}	 //if(mysqli_errno($con)==0) 		



					for($b=0;$b<$bill_entry_id_array_size;$b++){

						//$bill_voucher_date_array[$b]=convert_date($bill_voucher_date_array[$b]);
						$bill_date_array[$b]=convert_date($bill_date_array[$b]);
						$bill_amt_array[$b]=blankToZero($bill_amt_array[$b]);
						$adj_amt_array[$b]=blankToZero($adj_amt_array[$b]);
						$adj_gr_array[$b]=blankToZero($adj_gr_array[$b]);
						$adj_dis_array[$b]=blankToZero($adj_dis_array[$b]);
						
						$bill_received_amt_array[$b]=blankToZero($bill_received_amt_array[$b]);
						$bill_discount_percent_array[$b]=blankToZero($bill_discount_percent_array[$b]);
						$bill_discount_amt_array[$b]=blankToZero($bill_discount_amt_array[$b]);
						$bill_deduction_amt_array[$b]=blankToZero($bill_deduction_amt_array[$b]);
						$bill_goods_return_array[$b]=blankToZero($bill_goods_return_array[$b]);
						$bill_bal_amt_array[$b]=blankToZero($bill_bal_amt_array[$b]);


						if($bill_payment_type_array[$b]=="Full" || $bill_payment_type_array[$b]=="Part"){

							$sql_bill[$b]="insert into 
									txt_payment_bill_entry 
									(
										payment_entry_id,
										payment_entry_vou_date,
										bill_entry_id,
										bill_number,
										bill_date,
										bill_amount,
										amount_adjusted,
										gr_adjusted,
										discount_adjusted,
										bill_payment_type,
										payment_received,
										dis_percent,
										dis_amount,
										deduction_amount,
										bill_gr_amt,
										balance_amount,
										remark,
										create_user,
										create_date
									)
									values
									(
										'$payment_entry_id',
										'$voucher_date',
										'$bill_entry_id_array[$b]',
										'$bill_number_array[$b]',
										'$bill_date_array[$b]',
										'$bill_amt_array[$b]',
										'$adj_amt_array[$b]',
										'$adj_gr_array[$b]',
										'$adj_dis_array[$b]',
										'$bill_payment_type_array[$b]',
										'$bill_received_amt_array[$b]',
										'$bill_discount_percent_array[$b]',
										'$bill_discount_amt_array[$b]',
										'$bill_deduction_amt_array[$b]',
										'$bill_goods_return_array[$b]',
										'$bill_bal_amt_array[$b]',
										'$bill_remarks_array[$b]',
										'$last_update_user',
										NOW()
									)";
									$result=mysqli_query($con,$sql_bill[$b]);
									process_payment_entry_logging_disp(  " - SQL -".$sql_bill[$b]);


									if(mysqli_errno($con)==0) 
									{ 
										$sql_success_code+=0;
										//$_SESSION['msg']="<div class='success-message'>Payment Entry Bill Successfully Added</div>";
										process_payment_entry_logging_disp(  "Bill - 1" .mysqli_error($con));
										process_payment_entry_logging_disp(  "Payment Entry Id  - Bill - ".$bill_number_array[$b]);
							
									} 
									else 
									{
										$sql_success_code+=1;
										$sql_error_message=$sql_error_message."  BILL - ".$bill_number_array[$b] ." ";
										//$_SESSION['msg']="<div class='error-message'>Payment Entry Bill Details Not Addedd</div>";
										process_payment_entry_logging_disp(  "Bill  - 2" .mysqli_error($con));


										process_payment_entry_error_log("\n *******Fail **************** \n " .date_time());
										process_payment_entry_error_log("\n ".mysqli_error($con));
										process_payment_entry_error_log("\n".$sql_bill[$b]."\n ");																
									}//if(mysqli_errno($con)==0) 

									
						}  //if($bill_payment_type_array[$b]=="Full" || $bill_payment_type_array[$b]=="Part")

					} //for($b=0;$b<$bill_entry_id_array_size;$b++)
					if($sql_success_code>0){
						$_SESSION['msg']="<div class='error-message'>Payment Entry Bill Details Not Addedd ".$sql_error_message."</div>";

					}else{
						$_SESSION['msg']="<div class='success-message'>Payment Entry (".$payment_entry_id.")  Successfully Added</div>";
					} //if($sql_success_code>0)
				} //if((mysqli_errno($con)==0))

			} //if($voucher_type=="Advance Payment" || $voucher_type=="GR After Payment" ) - else

			if($sql_success_code>0){
				$_SESSION['msg']="<div class='error-message'>Payment Entry Bill Details Not Addedd ".$sql_error_message."</div>";

			}else{
				$_SESSION['msg']="<div class='success-message'>Payment Entry (Voucher No -".$payment_entry_id.")  Successfully updated</div>";
			} //if($sql_success_code>0)

		} //if((mysqli_errno($con)==0))
		if($sql_success_code>0){
			$_SESSION['msg']="<div class='error-message'>Payment Entry Cheque/GR & Bill Details Not updated ".$sql_error_message."</div>";

		}else{
			$_SESSION['msg']="<div class='success-message'>Payment Entry (Voucher No -".$payment_entry_id.")  Successfully updated</div>";
		} //if($sql_success_code>0)

	}	//if(($_REQUEST['payment_entry_id']) && ($_SESSION['uid']==77))	
	
	release_connection($con);
	
	} //function update()
//}



function delete()
{
	$con=get_connection();
	
	process_payment_entry_logging_disp(  "Inside Delete Function");
	
	if(($_REQUEST['payment_entry_id']) && ($_SESSION['uid']==77))
	{

		
		$last_update_user=$_SESSION['LOGID'];

		$payment_entry_id=$_REQUEST['payment_entry_id'];

		
		$update_sql_main= "UPDATE txt_payment_entry_main  set
			delete_tag='TRUE',
			delete_user='$last_update_user',
			delete_date=NOW()
			WHERE payment_entry_id='$payment_entry_id' ";
		
		process_payment_entry_logging_disp(  $update_sql_main);

		$result=mysqli_query($con,$update_sql_main);

		$sql_chq_del="UPDATE txt_payment_cheque_entry SET
			delete_tag='TRUE',
			delete_user='$last_update_user',
			delete_date=NOW()
			where payment_entry_id='$payment_entry_id' ";


		$result=mysqli_query($con,$sql_chq_del);		

		$sql_gr_del="UPDATE txt_payment_gr_entry SET
			delete_tag='TRUE',
			delete_user='$last_update_user',
			delete_date=NOW()
			where payment_entry_id='$payment_entry_id' ";

		$result=mysqli_query($con,$sql_gr_del);

		$sql_bill_del="UPDATE txt_payment_bill_entry SET
			delete_tag='TRUE',
			delete_user='$last_update_user',
			delete_date=NOW()
			where payment_entry_id='$payment_entry_id' ";

		$result=mysqli_query($con,$sql_bill_del);		

	}
	
	release_connection($con);

} //function delete()


function removeFile()
{
	process_payment_entry_logging_disp(  "Function Remove File");
	process_payment_entry_logging_disp(  ":--".$_REQUEST['payment_entry_id']);
	process_payment_entry_logging_disp(  $_SESSION['uid']);
	if(($_REQUEST['payment_entry_id']) && ($_SESSION['uid']==77))
	{
		process_payment_entry_logging_disp(  "Remove File inside if");

		$con=get_connection();
		$payment_entry_id=$_REQUEST['payment_entry_id'];
		$ft=$_REQUEST['ft'];  // ft= file type 
		
		if($ft=="supporting_doc_1") 
		{
			process_payment_entry_logging_disp(  "Remove File inside if  1");
			//$sql="select bill_entry_id from txt_payment_entry_main where bill_entry_id='$bill_entry_id'";
			$sql_update="update txt_payment_entry_main set supporting_doc_1='' where payment_entry_id='$payment_entry_id'";
			process_payment_entry_logging_disp(  $sql_update);
		}
		
		if($ft=="supporting_doc_2") 
		{
			process_payment_entry_logging_disp(  "Remove File inside if  2");
			//$sql="select supporting_doc from txt_payment_entry_main where bill_entry_id='$bill_entry_id'";
			$sql_update="update txt_payment_entry_main set supporting_doc_2='' where payment_entry_id='$payment_entry_id'";

			process_payment_entry_logging_disp(  $sql_update);
		}
		

		
		//$result=mysqli_query($con,$sql);	
		//$row=mysql_fetch_row($result);
			
		mysqli_query($con,$sql_update);
		
		if(mysqli_errno($con)==0) { 
					$_SESSION['msg']="<div class='success-message'>File Successfully Deleted</div>";
				} else {
					$msg=mysqli_error($con)."File Not Deleteted";
					$_SESSION['msg']="<div class='success-message'>$msg</div>";
				}
				
			

		$req_disp="";
		if(isset($_REQUEST['disp'])){
			$req_disp=$_REQUEST['disp'];
		}

		if($req_disp!='child'){
			process_payment_entry_redirect( "<script language='javascript'>");
			process_payment_entry_redirect( "location.href='edit_payment_entry.php?payment_entry_id=$payment_entry_id'");
			process_payment_entry_redirect( "</script>");
		}else {
			process_payment_entry_redirect( "<script language='javascript'>");
			process_payment_entry_redirect( "location.href='edit_payment_entry.php?disp=child&payment_entry_id=$payment_entry_id'");
			process_payment_entry_redirect( "</script>");
		
		}		
		
		release_connection($con);

	}
}//function removeFile()

?>

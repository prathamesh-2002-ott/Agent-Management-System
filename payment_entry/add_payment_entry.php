<?php
include("../includes/check_session.php");
include("../includes/config.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add Payment Entry</title>
<link rel="icon" type="image/x-icon" href="<?php echo $web_path; ?>images/dt-favicon.ico" />
<link href="<?php echo $web_path; ?>css/style.css" rel="stylesheet" type="text/css" />


<style>

*
{
	margin:0;
	padding:0;
}


table {
  text-align: left;

  border-collapse: collapse;  
}

.th-sticky {
  background: white;
  position: sticky;
  top: 0;
  box-shadow: 0 2px 2px -1px rgba(0, 0, 0, 0.4);
}

.tbl_border  {
  border:1px solid #cccccc; 
  border-collapse:collapse; 
	padding: 1px 4px;
  margin:0px;
}

.tbl_border td {
  border:1px solid #cccccc; 
  border-collapse:collapse; 
	padding: 10px 10px;
	padding: 0.25rem;
}

.tbl_border th {
  border:1px solid #cccccc;
  background-color:#F5F5F5;   
  border-collapse:collapse; 
  padding: 1px 4px;
  margin:0px;
  padding: 0.25rem;
}	

.table_scroll
{	
	overflow:auto;
	display:block;
	position:relative;
	overflow-x:hidden;
}

.table_scroll_h
{	
	overflow:auto;
	display:block;
}
	 
</style>	

<script type="text/javascript" src="../js/payment_entry.js"></script>
<script type="text/javascript" src="../js/dateCheck.js"></script>

<script type="text/javascript">
        window.onbeforeunload = function () {
            var inputs = document.getElementsByTagName("INPUT");
            for (var i = 0; i < inputs.length; i++) {
                if (inputs[i].type == "button" || inputs[i].type == "submit") {
                    inputs[i].disabled = true;
                }
            }
        };
    </script>

<script type="text/javascript">





function checkBillPaymentTypeSelected()
{
	//alert('in checkBillPaymentTypeSelected ');
	var l_bill_payment_type_array=document.getElementsByName('bill_payment_type[]');
	
	var l_bill_discount_amt_array=document.getElementsByName('bill_discount_amt[]');
    var l_bill_deduction_amt_array=document.getElementsByName('bill_deduction_amt[]');
    var l_bill_goods_return_array=document.getElementsByName('bill_goods_return[]');
	var l_bill_received_amt_array=document.getElementsByName('bill_received_amt[]');
	var l_bill_bal_amt_array=document.getElementsByName('bill_bal_amt[]');

	l_size=l_bill_payment_type_array.length;
	for(a=0;a<l_size;a++){
		l_bill_type_val=l_bill_payment_type_array[a].value;
		l_bill_bal_amt_val=processBlanktoZero(l_bill_bal_amt_array[a].value);

		// If Bill Payment Type Selected is Full and Balance Amount is Not 0
		if(l_bill_type_val=="Full" && l_bill_bal_amt_val!=0){
			alert('Bill Balance Amount Should be 0');
			l_bill_received_amt_array[a].focus();
			return false;
		}

		// If Bill Payment Type Selected is Part and Balance Amount is 0
		if(l_bill_type_val=="Part" && l_bill_bal_amt_val==0){
			alert('Bill Balance Amount Should not be 0 Please Select Bill Payment Type Full ');
			l_bill_received_amt_array[a].focus();
			return false;
		}		

		l_bill_dis_amt_val=processBlanktoZero(l_bill_discount_amt_array[a].value);
		l_bill_ded_amt_val=processBlanktoZero(l_bill_deduction_amt_array[a].value);
		l_bill_gr_amt_val=processBlanktoZero(l_bill_goods_return_array[a].value);
		l_bill_rec_amt_val=processBlanktoZero(l_bill_received_amt_array[a].value);		
		
		// If Bill Payment Type Selected is Part and  no Value is is entered in discout, Received Amout , Goods Return
		if(l_bill_type_val=="Part" && l_bill_dis_amt_val==0 && l_bill_ded_amt_val==0 && l_bill_gr_amt_val==0 && l_bill_rec_amt_val==0 )
		{
			alert('Please enter Value for Discoout or Goods Return or Amount Received');
			l_bill_received_amt_array[a].focus();
			return false;
		}

		// If Bill Payment Type is not selected and Value is available for Amout REceived or Discount or Goods Return
		if(l_bill_type_val=="Select" && (l_bill_dis_amt_val>0 || l_bill_ded_amt_val>0 || l_bill_gr_amt_val>0 || l_bill_rec_amt_val>0)){
			alert('Please Select Bill Payment Type to Part or Full');
			l_bill_payment_type_array[a].focus();
			return false;

		}
	}
	return true;

}

function checkAllDifference(){
	//amount_received_difference
	//discount_received_difference
	//goods_return_received_difference

	l_amt_rec_diff_val=document.getElementById("amount_received_difference").value;
	l_dis_rec_diff_val=document.getElementById("discount_received_difference").value;
	l_gr_rec_diff_val=document.getElementById("goods_return_received_difference").value;

	if(l_amt_rec_diff_val!=0 || l_dis_rec_diff_val !=0 || l_gr_rec_diff_val!=0  ){
		alert("All Difference should be 0 Please Adjust the Amount Properly");
		document.getElementsByName('bill_discount_amt[]')[0].focus();
		return false;
	}
	return true;

}

function finalCheck(){
	// this is just a place holder it will be implemented later
	//l_header_values=check();
	//l_chq_gr_values=checkMinOneChqGRDetail();
	//l_bill_details=checkMinOneBillHasValue();

	l_vou_type_last=document.getElementById('voucher_type_last_value').value;
	l_vou_type_selected=document.getElementById('voucher_type').value;
//alert( 'Final Check');
	
	if((l_vou_type_selected=="Advance Payment" || l_vou_type_selected=="GR After Payment")  ){
		if(l_vou_type_last==l_vou_type_selected){
			if(check()){
				//alert('Hi Testing')
				if(checkMinOneChqGRDetail()){
					//alert('1');
					return true;
				}else{
					//alert('2');
					return false;
				}
			}else{
				return false;
			}
		}else{
			alert('Please Click Next and populate Voucher Again')
			document.getElementById('narration').focus();
			return false
		}
	}else {
		if(check()){
			if(checkMinOneChqGRDetail()){
				if(checkMinOneBillHasValue()){
					if(balanceLessThenZero()){
						if(checkBillPaymentTypeSelected()){
							if(checkAllDifference()){
								return true;
							}else{
								return false;
							}
						}else{
							return false;
						}
					}else{
						return false;
					}
				}else{
					return false;
				}
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	
	//alert(l_header+l_chq_gr_values+l_bill_details);
/*
	if(l_header && l_chq_gr_values && l_bill_details ){
		return true;
	}else{
		return false;
	}
*/	
}

function check()
{
	//alert('in Check');
	var voucher_number=document.getElementById("manual_voucher_number").value;
		if(voucher_number=="") {
			alert("Please Enter Voucher Number");
			document.getElementById("manual_voucher_number").focus();
			return false;
		}
	var voucher_date=document.getElementById("voucher_date").value;
		if(voucher_date=="") {
			alert("Please Enter Voucher Date");
			document.getElementById("voucher_date").focus();
			return false;
		}

	var voucher_type=document.getElementById("voucher_type").value;
		if(voucher_type=="Select") {
			alert("Please Select Voucher Type");
			document.getElementById("voucher_type").focus();
			return false;
		}



	var buyer_account_number=document.getElementById("buyer_account_code").value;
		if(buyer_account_number=="") {
			alert("Please Select Buyer ");
			document.getElementById("buyer_account_code").focus();
			return false;
		}
	var supplier_account_number=document.getElementById("supplier_account_code").value;
		if(supplier_account_number=="") {
			alert("Please Select Supplier ");
			document.getElementById("supplier_account_code").focus();
			return false;
		}
		//alert('in Check Complete');
	return true;
}

function final_submit() {
	//alert("in final submit mode");
	//document.getElementById('final_btn').disabled=true;
	if(finalCheck()) {
		//alert('Final Check 0');
		document.getElementById('total_amount').disabled=false;
		document.getElementById('total_discount').disabled=false;
		document.getElementById('total_goods_return').disabled=false;
		//alert('Final Check 0 1');
		l_vou_type_selected=document.getElementById('voucher_type').value;
		//alert('Final Check 0 2'+l_vou_type_selected );
		if((l_vou_type_selected!="Advance Payment" && l_vou_type_selected!="GR After Payment")  ){
			//alert('Final Check 1');
			document.getElementById('total_amount_received').disabled=false;
			document.getElementById('total_discount_received').disabled=false;
			document.getElementById('total_goods_return_received').disabled=false;
			document.getElementById('amount_received_difference').disabled=false;
			//alert('Hello');
			//alert('Final Check 2');
			var l_bill_entry_id_array=document.getElementsByName('bill_entry_id[]');
			//var l_bill_voucher_date_array=document.getElementsByName('bill_voucher_date[]');
			var l_bill_number_array=document.getElementsByName('bill_number[]');
			l_size=l_bill_number_array.length;
			var l_bill_date_array=document.getElementsByName('bill_date[]');
			var l_bill_amt_array=document.getElementsByName('bill_amt[]');
			var l_adj_amt_array=document.getElementsByName('adj_amt[]');
			var l_adj_dis_array=document.getElementsByName('adj_dis[]');
			var l_adj_gr_array=document.getElementsByName('adj_gr[]');
			var l_bill_bal_amt_array=document.getElementsByName('bill_bal_amt[]');
			//alert('Final Check 3');
			//alert(l_size);
			for(bn=0;bn<l_size;bn++){
				//alert(bn);
				l_bill_entry_id_array[bn].disabled=false;
				//l_bill_voucher_date_array[bn].disabled=false;
				l_bill_number_array[bn].disabled=false;
				l_bill_date_array[bn].disabled=false;
				l_bill_amt_array[bn].disabled=false;
				l_adj_amt_array[bn].disabled=false;
				l_adj_dis_array[bn].disabled=false;
				l_adj_gr_array[bn].disabled=false;
				l_bill_bal_amt_array[bn].disabled=false;
			}
			//alert(l_size+"Hello");
			//alert('Final Check 4');
		}
		//alert('Final Check 4 1');
		if(document.getElementById('voucher_type_tag').value=="FALSE"){
			alert ("Voucher Type Changed ");
		}else if(document.getElementById('buyer_tag').value=="FALSE"){
			alert ("Buyer Changed ");
		}else if(document.getElementById('supplier_tag').value=="FALSE"){
			alert ("Supplier Changed ");
		}else{
			// commented for testing Java Script Validation
			//alert("Submit");
			document.getElementById('payment_vou').action='process_payment_entry.php?action=add';
			document.getElementById('payment_vou').submit();
			document.getElementById('final_btn').disabled=true;
			

		}
		//alert('Final Check 5 1');
		document.getElementById('final_btn').disabled=false;	
	}
}

function first_submit() {
	//alert("in first submit mode");
	if(check()) {
		document.getElementById('payment_vou').action='add_payment_entry.php';
		document.getElementById('payment_vou').submit();
	}
}

</script>
<?php include("../includes/jQDate.php"); ?>	
</head>	

<?php


?>
<?php
	$con=get_connection();

	$manual_vou_number="";
	if(isset($_REQUEST['manual_voucher_number'])){
		$manual_vou_number=$_REQUEST['manual_voucher_number'];
	}
	//<?php echo date("d-m-Y");

	$voucher_date="";
	if(isset($_REQUEST['voucher_date'])){
		$voucher_date=$_REQUEST['voucher_date'];
	}

	if($voucher_date==""){
		$voucher_date=	date("d-m-Y");
	}
	
	$voucher_type="";
	if(isset($_REQUEST['voucher_type'])){
		$voucher_type=$_REQUEST['voucher_type'];
	}

	$supplier="";
	if(isset($_REQUEST['supplier_account_code'])){
		$supplier=$_REQUEST['supplier_account_code'];
	}

	$buyer="";
	if(isset($_REQUEST['buyer_account_code'])){
		$buyer=$_REQUEST['buyer_account_code'];
	}

	$narration="";
	if(isset($_REQUEST['narration'])){
		$narration=$_REQUEST['narration'];
	}
?>
<table width="100%" border="0" align="center" style="border:0px solid #e5f1f8;background-color:#FFFFFF">
<tr>
    <td><?php include("../includes/header.php"); ?></td>
  </tr>
  <tr>
    <td><?php include("../includes/menu.php"); ?></td>
  </tr>
  <tr>
    <td  valign="top"><table width="100%" style="margin-top:0px" align="center" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td valign="top">
                            <div class="content_padding">
                            <div class="content-header">
                            <a href="index.php">Back</a>
            <table width="100%"><tr>								<td width="25%" align='left'>
									<h3>Add Payment Entry :</h3>
								</td>
								<td align="center" width="30%">
                    				<?php
									if(isset($_SESSION['msg'])) {
                    					echo $_SESSION['msg'];
                    					$_SESSION['msg']='';
									}
									?>
								</td>								
								<td width="45%" align="right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								</td>
            </tr>
            </table>
            </div>
    
    <table cellpadding="0" cellspacing="0" border="0">
            <tr>
             <td width="100%"  valign="top">
    <form method="post" id="payment_vou" enctype="multipart/form-data">
    
    <table width="850" class="tbl_border">	


	<tr>
		<th  align="center" >Manual Voucher Number <span class="astrik">*</span></th>
		<th  align="center" >Voucher Date <span class="astrik">*</span></th>
		<th align="center" >Voucher Type</th>
	</tr>
	<tr>
        <td align="center" ><input type="text" name="manual_voucher_number" id="manual_voucher_number" value="<?php echo $manual_vou_number;?>" size="10"></td>
			
		<td align="center" ><input type="text" onChange="validatedate_format(this)" name="voucher_date" class="datepick" id="voucher_date" value="<?php echo $voucher_date;?>" size="8"></td>
		
		<td align="center" >

		<input type="hidden" name="voucher_type_tag" id="voucher_type_tag"  value="" >
		<input type="hidden" name="voucher_type_last_value" id="voucher_type_last_value"  value="<?php echo $voucher_type;?>" >
		<select onChange="voucherTypeChange()" name="voucher_type" id="voucher_type">
        		<option value="Select">--Select--</option>
				<?php
				

				$arr=array('Payment','Advance Payment','Goods Return','Discount','GR After Payment');

				foreach($arr as $v)
				{
					$selected="";
					if($v==$voucher_type){
						$selected="selected";
					}
					echo "<option $selected >".$v."</option>";
				}
				?>
        	</select>

		</td>
    </tr>
   
    <tr>
		<th align="center" >Buyer  <span class="astrik">*</span></th>
		<th align="center">Supplier <span class="astrik">*</span></th>
		<th align="center">Narration</th>
	</tr>

		<td align="center" >
		<input type="hidden" name="buyer_tag" id="buyer_tag"  value="" >
		<input type="hidden" name="buyer_last_value" id="buyer_last_value"  value="<?php echo $buyer;?>" >
        	<select name="buyer_account_code" id="buyer_account_code" onChange="buyerChange()">
            	<option value="">--Select--</option>
                <?php
					$s_sql="SELECT * FROM txt_company WHERE Firm_type='Buyer' and delete_tag='FALSE' order by firm_name ASC";
					$s_result=mysqli_query($con,$s_sql);
					while($s_rs=mysqli_fetch_array($s_result))
					{
						$selected="";
						if($buyer==$s_rs['company_id'])
						{
							$selected="selected";
						}						
						echo "<option $selected value='".$s_rs['company_id']."'>".$s_rs['firm_name']."</option>";
					}
				?>
            </select>
		</td>			

		
		<td align="center" >
		<input type="hidden" name="supplier_tag" id="supplier_tag"  value="" >
		<input type="hidden" name="supplier_last_value" id="supplier_last_value"  value="<?php echo $supplier;?>" >
		<select name="supplier_account_code" id="supplier_account_code" onChange="supplierChange()">
            	<option value="">--Select--</option>
                <?php
					$s_sql="SELECT * FROM txt_company WHERE Firm_type='Supplier' and delete_tag='FALSE' order by firm_name ASC";
					$s_result=mysqli_query($con,$s_sql);
					while($s_rs=mysqli_fetch_array($s_result))
					{
						$selected="";
						if($supplier==$s_rs['company_id'])
						{
							$selected="selected";
						}						

						echo "<option $selected value='".$s_rs['company_id']."'>".$s_rs['firm_name']."</option>";
					}
				?>
            </select>
		</td>
		<td align="center" width="102"><textarea name="narration" id="narration"  cols="40" rows="3"><?php echo $narration; ?></textarea></td>
    </tr>
  
</table>
 <br>
				    <table width="324">
                	    <tr>
                    	    <td width="116">
                            <a href="index.php">Cancel</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                       		<input  type="button" class="form-button" onclick="first_submit()" name="my_btn" value="Next" />
                 			</td>
						</tr>
					</table>
					<br>	
					
<?php

if($voucher_type=="Payment" || $voucher_type=="Advance Payment" || $voucher_type=="Discount" ){

	//echo "Hello";
?>


		<input type="hidden" name="chq_lr_div" id="chq_lr_div" value="CHQ">
		<table cellpadding="0" cellspacing="0" border="0">
			<TR>
				<TH class="th-sticky"> <b> Cheqe Details : </> <br /></TH>
			</TR>

		   <tr>
			<td valign="top">

	<div class="table_scroll" style="height:150px; width: 1000px; border:1px solid;">		
    <table  class="tbl_border">	
	<tr>
    	<th class="th-sticky" align="left">Check Number </th>
		<th class="th-sticky" align="left">Bank Name <span class="astrik">*</span></th>
		<th class="th-sticky" align="left">Amount <span class="astrik">*</span></th>
		<th class="th-sticky" align="left">Check Date</th> 
		<th class="th-sticky" align="left">Discount Amount</th>
		<th class="th-sticky" align="left">Remarks </th>

		</tr>
	<?php
		for($i=1; $i<=3; $i++){
			
			?>
	<tr>	
        <td><input type="text"  name="cheque_number[]" id="cheque_number" size="8" onkeypress="return isNumberKey(event)" ></td>
        <td><input type="text" name="bank_name[]" id="bank_name" size="15"></td>
        <td><input type="text" onblur="calculateChqAmount()" name="chq_amount[]" id="chq_amount" size="15" onkeypress="return isNumberKey(event)" ></td>
        <td><input type="text" onChange="validatedate_format(this)" name="cheque_date[]" class="datepick" id="cheque_date<?php echo $i ?>" size="8"></td>
		<td><input type="text" onblur="calculateDiscountAmount()"  name="discount_amt[]" id="discount_amt" size="8" onkeypress="return isNumberKey(event)" ></td>
		<td><input type="text" name="chq_remarks[]" id="chq_remarks"></td>
    </tr>
		<?php } ?>
    </table>
		</div>
		</TD>
		</TR>
		</TABLE>


<?PHP
}else if ( $voucher_type=="Goods Return" || $voucher_type=="GR After Payment"){
	//echo "GR";
	?>

		<input type="hidden" name="chq_lr_div" id="chq_lr_div" value="LR">
		<table cellpadding="0" cellspacing="0" border="0">
			<TR>
				<TH class="th-sticky"> <b>Goods Return Details : </> <br /></TH>
			</TR>

		   <tr>
			<td valign="top">

	<div class="table_scroll" style="height:150px; width: 1100px; border:1px solid;">		
    <table  class="tbl_border">	
	<tr>
    	<th class="th-sticky" align="left">LR Number </th>
		<th class="th-sticky" align="left">Transport Name </th>
		<th class="th-sticky" align="left">Booked To</span></th>
		<th class="th-sticky" align="left">LR Date</th> 
		<th class="th-sticky" align="left">Goods Return <br> Amount<span class="astrik">*</span></th>
		<th class="th-sticky" align="left">No of Bales </th>
		<th class="th-sticky" align="left">Weight </th>
		<th class="th-sticky" align="left">Remarks </th>

		</tr>


<?php
$s_sql="SELECT * 
		FROM txt_company 
		WHERE Firm_type='Transport' 
		AND delete_tag='FALSE' 
		ORDER BY firm_name ASC";
$s_result=mysqli_query($con,$s_sql);
$transport;
$count=0;
while($s_rs=mysqli_fetch_array($s_result))
{
	//echo "<option value='".$s_rs['company_id']."'>".$s_rs['firm_name']."</option>";
	$transport[$count][0]=$s_rs['company_id'];
	$transport[$count][1]=$s_rs['firm_name'];
	$count++;
}
?>

<?php

		for($i=1; $i<=3; $i++){
			
			?>
	<tr>	
		<td><input type="text" name="lr_number[]" id="lr_number" size="8"></td>
		
        
		<td>
        	<select name="transport_name[]" id="transport_name">
            	<option value="">--Select--</option>
                <?php
					for($a=0;$a<sizeof($transport);$a++)
					{
						echo "<option value='".$transport[$a][0]."'>".$transport[$a][1]."</option>";
					}
				?>
            </select>
		</td>			
		
		<td><input type="text" name="booked_to[]" id="booked_to" size="15"></td>
        <td><input type="text" onChange="validatedate_format(this)" name="lr_date[]" class="datepick" id="lr_date" size="8"></td>
		<td><input type="text" onblur="calculateGRAmount()" name="goods_return_amt[]" id="goods_return_amt" size="8" onkeypress="return isNumberKey(event)" ></td>
		<td><input type="text" name="no_of_bales[]" id="no_of_bales" onkeypress="return isNumberKey(event)" size="4" ></td>
		<td><input type="text" name="total_weight[]" id="total_weight" size="8" ></td>
		<td><input type="text" name="gr_remarks[]" id="gr_remarks"></td>
    </tr>
		<?php } ?>
    </table>
		</div>	
		</td>	
		</tr>
		</table>


<?php

}

if($voucher_type!=""){
?>
<BR>
<table class="tbl_border" >

<tr>
    	<th align="left">Amount (Calculated)</th>
        <td><input disabled type="text" name="total_amount" id="total_amount" value=""></td>
		<th align="left">Discount (Calculated)</th>
        <td><input disabled type="text" name="total_discount" id="total_discount" value="" ></td>
		<th align="left">Goods Return (Calculated)</th>
        <td><input disabled type="text" name="total_goods_return" id="total_goods_return" value="" ></td>

	</tr>
</table>
<?php
}

$bill_result_rows=0;

$save_btn_disp=true;

if($voucher_type!="" && $voucher_type!="Advance Payment" && $voucher_type != "GR After Payment" ){

	$bill_sql="SELECT * 
				FROM txt_bill_entry 
				WHERE buyer_account_code='$buyer' 
				AND supplier_account_code='$supplier' 
				AND delete_tag='FALSE' 
				ORDER BY bill_date ASC, bill_number ASC ";
	//echo $bill_sql;
	$bill_result=mysqli_query($con,$bill_sql);
	$bill_result_rows=mysqli_num_rows($bill_result);
	//echo $bill_result_rows;
	$save_btn_disp=false;
	if($bill_result_rows>0){
		$save_btn_disp=true;
?>
<br>
<table cellpadding="0" cellspacing="0" border="0">
<TR>
	<TH class="th-sticky"> <b> Bill Details : </> <br /></TH>
</TR>
<tr>
	<td valign="top">
<div class="table_scroll_h" style="height:200px; width: 1400px; border:1px solid;">		
    <table width='100%' class="tbl_border">	
		<tr>
    	<th class="th-sticky" align="left">S. No.</th>

		<th class="th-sticky" align="left">Bill Id.</th>
		<th class="th-sticky" align="left">Bill No.</th>
		<th class="th-sticky" align="left">Bill Date</th>
		<th class="th-sticky" align="left">Bill Amt.</th>
		<th class="th-sticky" align="left">Adjusted <br> Amount</th>
		<th class="th-sticky" align="left">Adjusted <br> Discount</th>
		<th class="th-sticky" align="left">Adjusted <br> GR</th>
		<th class="th-sticky" align="left">Type</th>
		
		<th class="th-sticky" align="left">Disc. %</th>
		<th class="th-sticky" align="left">Discount <br> Amount </th>
		<th class="th-sticky" align="left">Deduction <br> Amount</th>
		<th class="th-sticky" align="left">Goods <br> Return</th>
		<th class="th-sticky" align="left">Payment <br>Received</th>

		<th class="th-sticky" align="left">Bal. Amt. <br> (Calculated)</th>
		<th class="th-sticky" align="left">Remarks</th>
		</tr>
<?php
		$i=0;
		while($rs=mysqli_fetch_array($bill_result)){
			$i++;

			$bill_ent_id=$rs['bill_entry_id'];
			// to check if bill is paid it should not be displayed
			$paybill_sql="SELECT * FROM 
						txt_payment_bill_entry 
						WHERE bill_entry_id='$bill_ent_id' 
						AND delete_tag='FALSE' AND bill_payment_type='FULL' ";
			$pay_bill_result=mysqli_query($con,$paybill_sql);	
			add_payment_log(" -Checking Full Payment Info - ".$paybill_sql);
			$len_rs=mysqli_num_rows($pay_bill_result);
			//echo "Pritesh --".$len_rs;
			// if result set is Zero then check for same bill_entry id and sum the values
			if($len_rs==0){
				//echo "Pritesh in --";
				add_payment_log("Bill Not Fully Paid");
				$bill_ent_id_child="SELECT
									 SUM(payment_received)AS sum_pay_rec,
									 SUM(dis_amount)AS sum_dis_amount, 
									 SUM(deduction_amount)AS sum_ded_amt,
									 SUM(bill_gr_amt)AS sum_bill_gr 
									 FROM txt_payment_bill_entry 
									 WHERE bill_entry_id='$bill_ent_id' AND delete_tag='FALSE' ";
				//echo $bill_ent_id_child;echo "<br>";
				
				$pay_bill_child_result=mysqli_query($con,$bill_ent_id_child);

				add_payment_log("- Sum Query - ".$bill_ent_id_child);

				$sum_adj_amt=0;
				$sum_adj_dis=0;
				$sum_adj_ded=0;
				$sum_adj_gr=0;
				while ($rs_c=mysqli_fetch_array($pay_bill_child_result)){
					//echo "Pritesh inside While--";echo "<br>";
					add_payment_log("inside While");
					$sum_adj_amt=number_format($rs_c['sum_pay_rec'],2,'.','');
					$sum_adj_dis=number_format($rs_c['sum_dis_amount'],2,'.','');
					$sum_adj_ded=number_format($rs_c['sum_ded_amt'],2,'.','');
					$sum_adj_gr=number_format($rs_c['sum_bill_gr'],2,'.','');

					$sum_adj_dis+=$sum_adj_ded;
					$sum_adj_dis=number_format($sum_adj_dis,2,'.','');
					//echo $sum_adj_amt.$sum_adj_dis.$sum_adj_gr;
					//echo $sum_adj_amt;echo "<br>";
					//echo $rs_c['sum_pay_rec'];echo "<br>";
					add_payment_log(implode($rs_c));
				}
				//echo "Pritesh out While--";
				//echo $sum_adj_amt.$sum_adj_dis.$sum_adj_gr.$sum_adj_ded;
				$disp_bill_amt=number_format($rs['bill_amount'],2,'.','');
				$disp_bal_amt=number_format($disp_bill_amt-$sum_adj_amt-$sum_adj_dis-$sum_adj_gr,2,'.','');

					

?>
				<tr>	
				<td align="left"><?php echo $i; ?></td>
			
				<td> 
				<input type="text" size="4" disabled id='bill_entry_id[]' name="bill_entry_id[]" value="<?php echo $rs['bill_entry_id']; ?>">
				</td>


				<td>
				<input type="text" size="5" disabled name="bill_number[]" id="bill_number" value="<?php echo $rs['bill_number']; ?>">
				</td>

				<td>
				<input type="text" size="6" disabled name="bill_date[]" id="bill_date" value="<?php echo rev_convert_date($rs['bill_date']); ?>">		
				</td>


				<td><input disabled type="text" size="6" name="bill_amt[]" id="bill_amt" value="<?php echo $rs['bill_amount'] ?>" id="bill_amt" size="10"></td>		
				<td><input disabled type="text" size="6" name="adj_amt[]"  id="adj_amt" size="10" value="<?php echo $sum_adj_amt ?>" ></td>
				<td><input disabled type="text" size="6" name="adj_dis[]"  id="adj_dis" size="10" value="<?php echo $sum_adj_dis ?>" ></td>		
				<td><input disabled type="text" size="6" name="adj_gr[]"  id="adj_gr" size="10" value="<?php echo $sum_adj_gr ?>" ></td>
				<td><select onChange="billVouTypeChange()" name="bill_payment_type[]" id="bill_payment_type" ><option>Select</option><option value="Full">Full</option><option value="Part">Part</option></Select></td>		
				<td><input type="text" size="2" value="" onblur="calculateBillDiscount()" name="bill_discount_percent[]" id="bill_discount_percent" size="5" onkeypress="return isNumberKey(event)" ></td>
				<td><input type="text" size="6" value="" onblur="calculateBillDiscountAmount()" name="bill_discount_amt[]" id="bill_discount_amt" size="10" onkeypress="return isNumberKey(event)" ></td>
				<td><input type="text" size="6" value="" onblur="calculateBillDiscountAmount()" name="bill_deduction_amt[]" id="bill_deduction_amt" size="10" onkeypress="return isNumberKey(event)" ></td>
				<td><input type="text" size="6" value="" onblur="calculateBillGRAmount()" name="bill_goods_return[]" id="bill_goods_return" size="10" onkeypress="return isNumberKey(event)" ></td>
				<td><input type="text" size="6" value="" onblur="calculateBillReceivedAmount()" name="bill_received_amt[]" id="bill_received_amt" size="10" onkeypress="return isNumberKey(event)" ></td>
				<td><input type="text" disabled size="6" name="bill_bal_amt[]" id="bill_bal_amt" size="10" value="<?php echo $disp_bal_amt; ?>"></td>
				<td><textarea name="bill_remarks[]"  id="bill_remarks" cols="10" rows="2"></textarea></td>
				</tr>
<?php
			}

	} 
?>
    </table>
</div>
	</td>
	</tr>

</table>


<BR>
<table  class="tbl_border">
			<tr>

				<th width="54">Total Received</th>
				<td width="220"><input disabled value="" type="text" name="total_amount_received" id="total_amount_received" /></td>
				<th width="100">Discount Total</th>
				<td width="222"><input disabled value="" type="text" name="total_discount_received" id="total_discount_received" /></td>
				<th width="100">Goods Return Total</th>
				<td width="222"><input disabled value="" type="text" name="total_goods_return_received" id="total_goods_return_received" /></td>
			</tr>
			<tr>
				<td colspan='6'></td>
			</tr>
			<tr>

				<th width="100">Amount Difference</th>
				<td width="222"><input disabled value="" type="text" name="amount_received_difference" id="amount_received_difference" /></td>

				<th width="100">Discount Difference</th>
				<td width="222"><input disabled value="" type="text" name="discount_received_difference" id="discount_received_difference" /></td>


				<th width="100">Goods Return Difference</th>
				<td width="222"><input disabled value="" type="text" name="goods_return_received_difference" id="goods_return_received_difference" /></td>



			</tr>
			<tr>
		    	<th align="left">Supporting Document 1</th>
        		<td><img src="../images/upload_2.png" alt="no image" id="prev0" style="width:25px;height:25px;" name="prev_img1[]" />
        		<input type="file" name="supporting_doc_1" id="supporting_doc_1"></td>
    			<th align="left">Supporting Document 2</th>
        		<td><img src="../images/upload_2.png" alt="no image" id="prev0" style="width:25px;height:25px;" name="prev_img1[]" />
				<input type="file" name="supporting_doc_2" id="supporting_doc_2"></td>		
				<td colspan='2'></td>
    		</tr>

		</table>
<?php
	}
}

if($voucher_type!="" && $save_btn_disp){

?>
 <br>
<table width="324">
	<tr>
		<td width="116">
		<a href="index.php">Cancel</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input  type="button" class="form-button" onclick="final_submit()" name="final_btn" value="Save" />
		</td>
	</tr>
</table>
<br>
<?php
}

?>

</form>
	</td></tr></table><?php $_SESSION['uid']=77; ?>
	</div>
	</td></tr></table>
	</td></tr>
	<tr>
	<td> <?php include("../includes/footer.php"); ?></td>
	</tr>
	</table>
	<br>
	<script>
		document.getElementById('manual_voucher_number').focus();
		
		ll_vou_type_val=document.getElementById('voucher_type').value;
		if (ll_vou_type_val=="Payment" || ll_vou_type_val=="Advance Payment" || ll_vou_type_val=="Discount" ){
			document.getElementsByName("cheque_number[]")[0].focus();
		}
		if(ll_vou_type_val=="GR After Payment" || ll_vou_type_val=="Goods Return"){
			document.getElementsByName("lr_number[]")[0].focus();
		}

	</script>	
</body>
</html>
<?php 
release_connection($con);
?>
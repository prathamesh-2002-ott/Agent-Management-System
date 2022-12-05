<?php
include("../includes/check_session.php");
include("../includes/config.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Payment Entry</title>
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




<?php include("../includes/jQDate.php"); ?>	
</head>	

<?php

$req_disp="";
if(isset($_REQUEST['disp'])){
	$req_disp=$_REQUEST['disp'];
}
$req_src="";
if(isset($_REQUEST['src'])){
	$req_src=$_REQUEST['src'];
}

$con=get_connection();

$pay_ent_id=$_REQUEST['payment_entry_id'];
//echo $pay_ent_id;

$sql_main="SELECT * FROM txt_payment_entry_main where payment_entry_id='$pay_ent_id'";
//echo $sql_main;

$main_result=mysqli_query($con,$sql_main);
$main_rs=mysqli_fetch_array($main_result);



?>
<?php

	$con=get_connection();

	$payment_entry_id=$main_rs['payment_entry_id'];
	$manual_vou_number=$main_rs['manual_vou_number'];
	$voucher_date=$main_rs['voucher_date'];
	$voucher_type=$main_rs['vou_type'];
	$supplier=$main_rs['supplier_account_code'];
	$buyer=$main_rs['buyer_account_code'];
	$narration=$main_rs['narration'];

	
?>
<table width="100%" border="0" align="center" style="border:0px solid #e5f1f8;background-color:#FFFFFF">
<tr>
    <td>
		<?php if($req_disp!='child'){include("../includes/header.php"); }?>
	</td>
  </tr>
  <tr>
    <td><?php if($req_disp!='child'){include("../includes/menu.php"); } ?></td>
  </tr>
  <tr>
  <tr>
    <td height="326" valign="top"><table width="100%" style="margin-top:0px" align="center" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td valign="top">
                            <div class="content_padding">
                            <div class="content-header">
                            <?php 	if($req_disp!='child'){ 
										if($req_src=='search') { 
											$search_supplier_code=$_REQUEST['search_supplier_account_code'];
											$search_buyer_code=$_REQUEST['search_buyer_account_code'];
											$vou_start_date=$_REQUEST['vou_start_date'];
											$vou_end_date=$_REQUEST['vou_end_date'];
											$src_man_vou_num=$_REQUEST['src_man_vou_num'];
											$src_pay_ent_id=$_REQUEST['src_pay_ent_id'];
											//src=search&vou_end_date=$vou_end_date&vou_start_date=$vou_start_date&bill_end_date=$bill_end_date&bill_start_date=$bill_start_date&buyer_account_code=$buyer_code&supplier_account_code=$supplier_code&bill_entry_id=$bill_entry_id
											echo "<a href='payment_search.php?src=search&src_man_vou_num=$src_man_vou_num&src_pay_ent_id=$src_pay_ent_id&vou_end_date=$vou_end_date&vou_start_date=$vou_start_date&search_buyer_account_code=$search_buyer_code&search_supplier_account_code=$search_supplier_code&payment_entry_id=$payment_entry_id'>Back</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
											} else {
												echo ' <a href="index.php">Back</a>'; 
										} 
									}?>
            <table width="100%"><tr><td><h3>View Payment Entry :</h3></td>
            	<td align="right"></td>
            </tr>
            </table>
			</div>
    
    <table cellpadding="0" cellspacing="0" border="0">
            <tr>
             <td width="818" height="138" valign="top">
    <form method="post" id="payment_vou" enctype="multipart/form-data">
    
    <table width="770" class="tbl_border">	


	<tr>
		<th width="193" align="left" > 
			Payment Voucher Id
		</th>
		<td >
			<input type=hidden name='payment_entry_id' id='payment_entry_id' value='<?php echo $payment_entry_id;?>'>
		<?php echo $payment_entry_id;?>
		</td>
		<td colspan='2'></td>
		<td colspan='2'></td>
	</tr>
	<tr>
		<td colspan='6'></td>
	</tr>
	<tr>
    	<th width="193" align="left">Manual Voucher Number </th>
        <td width="191"><?php echo $manual_vou_number;?> </td>
			<th width="222" align="left">Voucher Date </th>
		<td width="144"><?php echo rev_convert_date($voucher_date);?></td>
		<th>Voucher Type</th>
		<td><?php echo $voucher_type ?>

		</td>
    </tr>
   
    <tr>
    	<th align="left">Buyer  </th>
		<td>
                <?php
					$s_sql="SELECT * FROM txt_company WHERE Firm_type='Buyer' and delete_tag='FALSE' order by firm_name ASC";
					$s_result=mysqli_query($con,$s_sql);
					while($s_rs=mysqli_fetch_array($s_result))
					{
						$selected="";
						if($buyer==$s_rs['company_id'])
						{
							echo $s_rs['firm_name'];
						}						
					
					}
				?>
            
		</td>			

		<th align="left">Supplier </th>
		<td>

                <?php
					$s_sql="SELECT * FROM txt_company WHERE Firm_type='Supplier' and delete_tag='FALSE' order by firm_name ASC";
					$s_result=mysqli_query($con,$s_sql);
					while($s_rs=mysqli_fetch_array($s_result))
					{
						$selected="";
						if($supplier==$s_rs['company_id'])
						{
							echo $s_rs['firm_name'];
						}						

						
					}
				?>


		</td>

		<th width="88">Narration</th>
				<td width="102"><?php echo $narration; ?></td>
    </tr>

  
    
</table>
 <br>

					
<?php

if($voucher_type=="Payment" || $voucher_type=="Advance Payment" || $voucher_type=="Discount" ){

	$sql_chq="SELECT * FROM txt_payment_cheque_entry where payment_entry_id='$pay_ent_id' and delete_tag='FALSE'";
	$chq_result=mysqli_query($con,$sql_chq);

	//$chq_rs=mysqli_fetch_array($chq_result);


?>



		<table cellpadding="1" cellspacing="1" border="1">
			<TR >
				<TH class=> <b> Cheqe Details : </b> <br /></TH>
			</TR>

		   <tr>
			<td valign="top">

		
    <table  class="tbl_border">	
	<tr>
    	<th  align="left">Check Number </th>
		<th  align="left">Bank Name </th>
		<th  align="left">Amount </th>
		<th  align="left">Check Date</th> 
		<th  align="left">Discount Amount</th>
		<th  align="left">Remarks </th>

		</tr>
<?php		
		$rec=0;
	while($chq_rs=mysqli_fetch_array($chq_result))
	{
		$rec++;		
?>
	<tr style='background-color:#f0f5f4f3' >	
        <td><?php echo $chq_rs['chq_number']?></td>
        <td><?php echo $chq_rs['bank']?></td>
        <td><?php echo zeroToBlank($chq_rs['chq_amt'])?></td>
        <td><?php echo rev_convert_date(defaultDateToBlank($chq_rs['chq_date']))?></td>
		<td><?php echo zeroToBlank($chq_rs['dis_amt'])?></td>
		<td><?php echo $chq_rs['remark']?></td>
    </tr>
<?php } ?>



    </table>

		</TD>
		</TR>
		</TABLE>
		

<?PHP
	
}else if ( $voucher_type=="Goods Return" || $voucher_type=="GR After Payment"){
	//echo "GR";
	?>

		<input type="hidden" name="chq_lr_div" id="chq_lr_div" value="LR">
		<table cellpadding="0" cellspacing="0" border="1">
			<TR>
				<TH > <b>Goods Return Details : </> <br /></TH>
			</TR>

		   <tr>
			<td valign="top">

		
    <table  class="tbl_border">	
	<tr>
    	<th  align="left">LR Number </th>
		<th  align="left">Transport Name </th>
		<th  align="left">Booked To</span></th>
		<th  align="left">LR Date</th> 
		<th  align="left">Goods Return <BR> Amount</th>
		<th  align="left">No of <BR> Bales </th>
		<th  align="left">Weight </th>
		<th  align="left">Remarks </th>

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
	$gr_sql=" SELECT * from txt_payment_gr_entry where payment_entry_id='$pay_ent_id' and delete_tag='FALSE'";

	$gr_result=mysqli_query($con,$gr_sql);

	$gr_rec=0;
	while($gr_rs=mysqli_fetch_array($gr_result)){
		
?>
	<tr style='background-color:#f0f5f4f3'>	
		<td><?php echo $gr_rs['lr_number']?></td>
		
        
		<td>

                <?php
					for($a=0;$a<sizeof($transport);$a++)
					{
						$selected="";
						if($gr_rs['transport']==$transport[$a][0]){
							echo $transport[$a][1];
						}
						
					}
				?>

		</td>			
		
		<td><?php echo $gr_rs['booked_to']?></td>
        <td><?php echo rev_convert_date($gr_rs['lr_date'])?></td>
		<td><?php echo $gr_rs['gr_amount']?></td>
		<td><?php echo $gr_rs['number_of_bales']?></td>
		<td><?php echo $gr_rs['total_weight']?></td>
		<td><?php echo $gr_rs['remark']?></td>
    </tr>



<?php
		$gr_rec++;
	}

?>


    </table>
		
		</td>	
		</tr>
		</table>


<?php

}


?>
<BR>

<?php


$bill_result_rows=0;

$save_btn_disp=true;

//if($voucher_type!="" && $voucher_type!="Advance Payment" && $voucher_type != "GR After Payment" ){
if($voucher_type!="" ){	

?>
<br>
<table cellpadding="1" cellspacing="1" border="1">
<TR>
	<TH > <b> Bill Details : </b></TH>
</TR>
<tr>
	<td valign="top">
	
    <table width='100%' class="tbl_border">	
		<tr>
    	<th  align="left">S. No.</th>

		<th  align="left">Bill Id.</th>
		<th  align="left">Bill No.</th>
		<th  align="left">Bill Date</th>
		<th  align="left">Bill Amt.</th>
		<th  align="left">Adjusted <BR> Amount</th>
		<th  align="left">Adjusted <BR> Discount</th>
		<th  align="left">Adjusted <BR> GR</th>
		<th  align="left">Type</th>
		
		<th  align="left">Disc. %</th>
		<th  align="left">Discount <BR> Amount</th>
		<th  align="left">Deduction <BR> Amount</th>
		<th  align="left">Goods <BR> Return</th>
		<th  align="left">Payment <BR> Received</th>

		<th  align="left">Bal. Amt. <BR> (Calculated)</th>
		<th  align="left">Remarks</th>
		</tr>
<?php
		$vou_bill_sql="SELECT * FROM 
		txt_payment_bill_entry
		WHERE payment_entry_id = '$pay_ent_id' and delete_tag='FALSE'";

		$vou_bill_result=mysqli_query($con,$vou_bill_sql);
		$i=0;

		$where="";
		while($rs=mysqli_fetch_array($vou_bill_result)){
			$i++;

			// Making Where Clause for Next Query
			$where_bill_ent_id=$rs['bill_entry_id'];
			$where.=" AND bill_entry_id !='$where_bill_ent_id' ";
?>

<tr style='background-color:#f0f5f4f3'>	
				<td align="left"><?php echo $i; ?></td>
			
				<td>  <?php echo $rs['bill_entry_id']; ?></td>
				<td><?php echo $rs['bill_number']; ?></td>
				<td><?php echo rev_convert_date($rs['bill_date']); ?></td>


				<td><?php echo $rs['bill_amount'] ?></td>		
				<td><?php echo zeroToBlank($rs['amount_adjusted']) ?></td>
				<td><?php echo zeroToBlank($rs['discount_adjusted']) ?></td>		
				<td><?php echo zeroToBlank($rs['gr_adjusted']) ?></td>

				<td><?php echo $rs['bill_payment_type']?>
</td>		
				
				<td><?php echo zeroToBlank($rs['dis_percent'])?></td>
				<td><?php echo zeroToBlank($rs['dis_amount'])?></td>
				<td><?php echo zeroToBlank($rs['deduction_amount'])?></td>
				<td><?php echo zeroToBlank($rs['bill_gr_amt'])?></td>
				<td><?php echo zeroToBlank($rs['payment_received'])?></td>
				<td><?php echo zeroToBlank($rs['balance_amount'])?></td>
				<td><?php echo $rs['remark']?></td>
				</tr>



<?php

		}
?>

    </table>

	</td>
	</tr>

</table>


<BR>
<table  class="tbl_border">
			<tr>
<?php
	$disp_total_rec="";
	$disp_total_dis="";
	$disp_total_gr="";
	if($voucher_type!="Advance Payment" && $voucher_type!="GR After Payment"){
		$disp_total_rec=zeroToBlank($main_rs['payment_amount']);
		$disp_total_dis=zeroToBlank($main_rs['discount_amount']);
		$disp_total_gr=zeroToBlank($main_rs['gr_amount']);
	}

?>
				<th width="54">Total Received</th>
				<td width="220"><?php echo $disp_total_rec ?></td>
				<th width="100">Discount Total</th>
				<td width="222"><?php echo $disp_total_dis ?></td>
				<th width="100">Goods Return Total</th>
				<td width="222"><?php echo $disp_total_gr ?></td>
			</tr>
			<tr>
				<td colspan='6'></td>
			</tr>
			<tr>
		    	<th align="left">Supporting Document 1</th>
				<td>
        <?php
        if($main_rs['supporting_doc_1']!="") { ?>
			<a href='<?php echo $web_path; ?>payment_entry/upload/<?php echo $main_rs['supporting_doc_1']; ?>'>Supporting Doc 1</a>
		<?php } ?>
        </td>
    			<th align="left">Supporting Document 2</th>
				<td>
        <?php
        if($main_rs['supporting_doc_2']!="") { ?>
			<a href='<?php echo $web_path; ?>payment_entry/upload/<?php echo $main_rs['supporting_doc_2']; ?>'>Supporting Doc 2</a>
 		<?php } ?>
		</td>
		<td colspan='2'></td>
    		</tr>			

		</table>
<?php

}

if($voucher_type!="" && $save_btn_disp){

?>
 <br>
<table width="324">
	<tr>
		<td width="116">
		<?php if($req_disp!='child') { ?>
			<?php if($req_src=='search') { 
				$search_supplier_code=$_REQUEST['search_supplier_account_code'];
				$search_buyer_code=$_REQUEST['search_buyer_account_code'];
				$vou_start_date=$_REQUEST['vou_start_date'];
				$vou_end_date=$_REQUEST['vou_end_date'];
				$src_man_vou_num=$_REQUEST['src_man_vou_num'];
				$src_pay_ent_id=$_REQUEST['src_pay_ent_id'];
				
				echo "<a href='payment_search.php?src=search&src_man_vou_num=$src_man_vou_num&src_pay_ent_id=$src_pay_ent_id&vou_end_date=$vou_end_date&vou_start_date=$vou_start_date&search_buyer_account_code=$search_buyer_code&search_supplier_account_code=$search_supplier_code&payment_entry_id=$payment_entry_id'>Cancel</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			} else {?>			
				<a href="index.php">Cancel</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<?php } 
		}?>
		
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
	
</body>
</html>
<?php 
release_connection($con);
?>
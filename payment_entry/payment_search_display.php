<table width="100%" border="0" align="center" style="border:1px solid #e5f1f8;background-color:#FFFFFF">

  <tr>
    <td height="326" valign="top"><table width="100%" style="margin-top:0px" align="center" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td valign="top">
                            <div class="content_padding">
       
    
    <table cellpadding="0" cellspacing="0" border="0">
            <tr>
             <td  valign="top">
              

<table class="tbl_border">
             	
	<tr>
    	<th valign="top" >S.No.</th>
      <th valign="top" >Edit</th>
      <th valign="top" >View</th>      
        <th valign="top" >Payment <BR>Entry Id</th>
        <th valign="top" >Manual Voucher <BR>Number</th>
        <th valign="top" >Voucher Date</th>
        <th valign="top" >Buyer Name</th>
        <th valign="top" >Supplier Name</th>
        <th valign="top" >Payment Amount</th>
        <th valign="top" >Discount Amount</th>
        <th valign="top" >Goods Return <BR> Amount</th>


<!--        <th>Delete</th> -->

    </tr>
    <?php /*
$search_supplier_code=$_REQUEST['search_supplier_account_code'];
$search_buyer_code=$_REQUEST['search_buyer_account_code'];
$bill_start_date=$_REQUEST['bill_start_date'];
$bill_end_date=$_REQUEST['bill_end_date'];
$vou_start_date=$_REQUEST['vou_start_date'];
$vou_end_date=$_REQUEST['vou_end_date'];
*/
?>    
<?php
$con=get_connection();



$sql="select * from txt_company where delete_tag='FALSE' order by company_id ASC";
$result=mysqli_query($con,$sql);

$rowcount=0;
// Creating Company Array with reverse Key Value Pair 
// because array_search function searched value and returns key
// first value Dummy to show the position of details
$company_array=array("Value"=>"Key"); 
while($rs=mysqli_fetch_array($result))
{
  $companyRow[$rowcount][0]=$rs['company_id'];
  $companyRow[$rowcount][1]=$rs['firm_name'];
  $com_array=array($rs['firm_name']=>$rs['company_id']);
  $company_array=array_merge($company_array,$com_array);
  
/*
  echo $companyRow[$rowcount][0];
  echo $companyRow[$rowcount][1];
*/
  $rowcount++;

}

//$result -> free_result();

    

$sql_pay="select * from txt_payment_entry_main 
        where delete_tag='FALSE' ";
    if($search_supplier_code!=''){
        $sql_pay.=" AND supplier_account_code='$search_supplier_code' ";
    }
    
    if($search_buyer_code!=''){
        $sql_pay.=" AND buyer_account_code='$search_buyer_code' ";
    }
    
    $sql_vou_start_date=convert_date($vou_start_date);
    if($vou_start_date!=''){
        $sql_pay.=" AND voucher_date>='$sql_vou_start_date' ";
    }
    
    $sql_vou_end_date=convert_date($vou_end_date);
    if($vou_end_date!=''){
        $sql_pay.=" AND voucher_date<='$sql_vou_end_date' ";
    }

    if($src_pay_ent_id!=''){
      $sql_pay.=" AND payment_entry_id='$src_pay_ent_id' ";
  }
  
  if($src_man_vou_num!=''){
      $sql_pay.=" AND manual_vou_number='$src_man_vou_num' ";
  }



$sql_pay.="order by voucher_date DESC, payment_entry_id desc ";

//echo $sql_pay;     
$result=mysqli_query($con,$sql_pay);
$count=0;
while($rs=mysqli_fetch_array($result))
{
	$payment_entry_id=$rs[0];
	echo "<tr>";
  echo "<td>".++$count."</td>";
  echo "<td><a href='edit_payment_entry.php?src=search&src_man_vou_num=$src_man_vou_num&src_pay_ent_id=$src_pay_ent_id&vou_end_date=$vou_end_date&vou_start_date=$vou_start_date&search_buyer_account_code=$search_buyer_code&search_supplier_account_code=$search_supplier_code&payment_entry_id=$payment_entry_id'><img src='../images/noun_project_edit_1.png' height='16' width='16' border='0' title='Edit' /></a></td>";
  echo "<td><a href='view_payment_entry.php?src=search&src_man_vou_num=$src_man_vou_num&src_pay_ent_id=$src_pay_ent_id&vou_end_date=$vou_end_date&vou_start_date=$vou_start_date&search_buyer_account_code=$search_buyer_code&search_supplier_account_code=$search_supplier_code&payment_entry_id=$payment_entry_id'><img src='../images/noun_project_preview_1.png' height='16' width='16' border='0' title='View' /></a></td>";
  echo "<td>".$rs['payment_entry_id']."</td>";
	echo "<td>".$rs['manual_vou_number']."</td>";
  echo "<td>".rev_convert_date($rs['voucher_date'])."</td>";
  
   
  $disp_supp_name=$disp_buyer_name="Not Found";
  
 /*
  for($a=0;$a<sizeof($companyRow);$a++){

    if($rs['supplier_account_code']==$companyRow[$a][0]){
      $disp_supp_name=$companyRow[$a][1];
    }
    if($rs['buyer_account_code']==$companyRow[$a][0]){
      $disp_buyer_name=$companyRow[$a][1];
    }

    


  }
*/
//$disp_transport_name=array_search($rs['transport_name'],$company_array);
$disp_supp_name=array_search($rs['supplier_account_code'],$company_array);
$disp_buyer_name=array_search($rs['buyer_account_code'],$company_array);


	echo "<td>".$disp_buyer_name."</td>";
  echo "<td>".$disp_supp_name."</td>";
  echo "<td>".zeroToBlank($rs['payment_amount'])."</td>";
  echo "<td>".zeroToBlank($rs['discount_amount'])."</td>";
  echo "<td>".zeroToBlank($rs['gr_amount'])."</td>";

	//echo "<td><a href='process_payment_entry.php?action=delete&payment_entry_id=$payment_entry_id' onclick='return confirm_delete();'>Delete</a></td>";
	
	echo"</tr>";
}
?>
</table>

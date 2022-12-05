<table width="100%" border="0" align="center" style="border:1px solid #e5f1f8;background-color:#FFFFFF">

<tr>
  <td height="326" valign="top"><table width="100%" style="margin-top:0px" align="center" cellpadding="0" cellspacing="0" border="0">
                      <tr>
                          <td valign="top">
                          <div class="content_padding">
      
  
  <table cellpadding="0" cellspacing="0" border="0">
          <tr>
           <td width="100%" height="138" valign="top">
            

<table class="tbl_border" width="100%" >
  <tr>
    <th width="24">S.No..</th>
    <!-- <th width="27">Edit</th>       -->
    <!-- <th width="27">View</th>             -->
    <th width="50">Bill Id</th>      
      <!--<th width="60">Voucher Number</th> -->
    <th width="100">Voucher Date</th>
    <th width="54">Bill Number</th>
    <th width="100">Bill Date</th>

    <th width="250">Supplier </th>
    <th width="250">Buyer </th>
    <th width="50">Dis %</th>
    <th width="80">Net Amt</th>
    <th width="50">GST Amt</th>
    <th width="80">Bill Amount</th>
    <th width="80">Bill Attached</th>


<!--        <th width="50">Delete</th> -->
  </tr>
<?php 
$search_supplier_code="";
if(isset ($_REQUEST['search_supplier_account_code'])){
  $search_supplier_code=$_REQUEST['search_supplier_account_code'];
}


$search_buyer_code="";
if (isset($_REQUEST['search_buyer_account_code'])){
  $search_buyer_code=$_REQUEST['search_buyer_account_code'];
}




$bill_start_date="";
if(isset($_REQUEST['bill_start_date'])){
  $bill_start_date=$_REQUEST['bill_start_date'];
}


$bill_end_date="";
if(isset($_REQUEST['bill_end_date'])){
  $bill_end_date=$_REQUEST['bill_end_date'];
}


$vou_start_date="";

if(isset($_REQUEST['vou_start_date'])){
  $vou_start_date=$_REQUEST['vou_start_date'];
}

$vou_end_date="";

if(isset($_REQUEST['vou_end_date'])){

}

$search_bill_entry_id="";
if(isset($_REQUEST['search_bill_entry_id'])){
  $search_bill_entry_id=$_REQUEST['search_bill_entry_id'];
}

$search_bill_number="";

if(isset($_REQUEST['search_bill_number'])){
  $search_bill_number=$_REQUEST['search_bill_number'];
}


$order="";
if(isset($_REQUEST['order'])){
  $order=$_REQUEST['order'];
}

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

$result -> free_result();
/*
echo"<BR>";
echo"<BR>";
echo"<BR>";
echo"<BR>";
echo"<BR>";


echo"<BR>";
echo sizeof($companyRow);
echo " Saumya ";
for($a=0;$a<sizeof($companyRow);$a++){
echo $companyRow[$a][0];
echo $companyRow[$a][1];
}

echo"<BR>";
echo sizeof($companyRow);
echo " Vagmi ";
*/







$sql="select * from txt_bill_entry 
where delete_tag='FALSE' ";
if($search_supplier_code!=''){
  $sql.=" AND supplier_account_code='$search_supplier_code' ";
}

if($search_buyer_code!=''){
  $sql.=" AND buyer_account_code='$search_buyer_code' ";
}

$sql_bill_start_date=convert_date($bill_start_date);
if($bill_start_date!=''){
  $sql.=" AND bill_date>='$sql_bill_start_date' ";
}

$sql_bill_end_date=convert_date($bill_end_date);
if($bill_end_date!=''){
  $sql.=" AND bill_date<='$sql_bill_end_date' ";
}

$sql_vou_start_date=convert_date($vou_start_date);
if($vou_start_date!=''){
  $sql.=" AND voucher_date>='$sql_vou_start_date' ";
}

$sql_vou_end_date=convert_date($vou_end_date);
if($vou_end_date!=''){
  $sql.=" AND voucher_date<='$sql_vou_end_date' ";
}

if($search_bill_entry_id!=''){
$sql.=" AND bill_entry_id ='$search_bill_entry_id' ";
}
if($search_bill_number!=''){
$sql.=" AND bill_number ='$search_bill_number' ";
}


// Entry Date
$sql_order_by=' voucher_date DESC ,bill_entry_id DESC';
if($order=='Bill Date'){
$sql_order_by=' bill_date DESC,bill_number DESC';
}


$sql.=" ORDER BY $sql_order_by ";
$result=mysqli_query($con,$sql);

$col_switch=0;
$td_col="style='background-color:#FF0000'";

$count=0;
while($rs=mysqli_fetch_array($result))
{
  if ($col_switch==0){
    $col_switch=1;
    $td_col="style='background-color:#FFFFFF'";
  }else{
    $col_switch=0;
    $td_col="style='background-color:#99FF99'";
  }
  $bill_entry_id=$rs[0];
echo "<tr $td_col >";

echo "<td >".++$count."</td>";
//echo "<td><a href='edit_bill_entry.php?src=search&search_bill_entry_id=$search_bill_entry_id&search_bill_number=$search_bill_number&vou_end_date=$vou_end_date&vou_start_date=$vou_start_date&bill_end_date=$bill_end_date&bill_start_date=$bill_start_date&search_buyer_account_code=$search_buyer_code&search_supplier_account_code=$search_supplier_code&bill_entry_id=$bill_entry_id'><img src='../images/noun_project_edit_1.png' height='16' width='16' border='0' title='Edit' /></a></td>";
//echo "<td><a href='view_bill_entry.php?src=search&search_bill_entry_id=$search_bill_entry_id&search_bill_number=$search_bill_number&vou_end_date=$vou_end_date&vou_start_date=$vou_start_date&bill_end_date=$bill_end_date&bill_start_date=$bill_start_date&search_buyer_account_code=$search_buyer_code&search_supplier_account_code=$search_supplier_code&bill_entry_id=$bill_entry_id'><img src='../images/noun_project_preview_1.png' height='16' width='16' border='0' title='View' /></a></td>";  
echo "<td>".$rs['bill_entry_id']."</td>";
?>
 <input type='hidden' name='bill_entry_id[]' id='bill_entry_id'  value='<?php echo $rs['bill_entry_id'] ?>' >
<?php
//echo "<td>".$rs['voucher_number']."</td>";
echo "<td>".rev_convert_date($rs['voucher_date'])."</td>";
$bill_num=$rs['bill_number'];
  echo "<td>".$rs['bill_number']."</td>";
  echo "<td>".rev_convert_date($rs['bill_date'])."</td>";


$disp_transport_name=$disp_supp_name=$disp_buyer_name=$disp_agent_name="Not Found";

/*
for($a=0;$a<sizeof($companyRow);$a++){
  if($rs['transport_name']==$companyRow[$a][0]){
    $disp_transport_name=$companyRow[$a][1];
  }
  if($rs['supplier_account_code']==$companyRow[$a][0]){
    $disp_supp_name=$companyRow[$a][1];
  }
  if($rs['buyer_account_code']==$companyRow[$a][0]){
    $disp_buyer_name=$companyRow[$a][1];
  }
  if($rs['agent']==$companyRow[$a][0]){
    $disp_agent_name=$companyRow[$a][1];
  }

}
*/

//$disp_transport_name=array_search($rs['transport_name'],$company_array);
$disp_supp_name=array_search($rs['supplier_account_code'],$company_array);
$disp_buyer_name=array_search($rs['buyer_account_code'],$company_array);

  //echo "<td>".$disp_transport_name."</td>";
  //echo "<td>".$rs['transport_name']."</td>";
echo "<td>".$disp_supp_name."</td>";
//echo "<td>".$rs['supplier_account_code']."</td>";
echo "<td>".$disp_buyer_name."</td>";
//echo "<td>".$rs['buyer_account_code']."</td>";

echo "<td align='right' >".zeroToBlank($rs['discount_percentage'])."</td>";
echo "<td align='right'>".$rs['net_amount']."</td>";
echo "<td align='right'>".$rs['gst_amount']."</td>";

echo "<td align='right'>".$rs['bill_amount']."</td>";

echo "<td align='right'> ";
if($rs['bill_upload']!="") { ?>
    <a href='<?php echo $web_path; ?>bill_entry/upload/<?php echo $rs['bill_upload']; ?>'>Bill Copy</a>
	
<?php 
} else { ?>
        <!-- <img src="../images/upload_2.png" alt="no image" id="prev0" style="width:25px;height:25px;" name="prev_img1[]" /> -->
        <input type="file" name="bill_upload_<?php echo $rs['bill_entry_id'] ?>" id="bill_upload"> 
<?php 
} 
echo "</td>";
/*
if($rs['bill_upload']==""){
    echo "<td align='right'> ";
    echo "No Image";
    echo "</td>";
}else{
    echo "<td align='right'>".$rs['bill_upload']."</td>";
}
*/
  
  //echo "<td><a href='process_bill_entry.php?action=delete&bill_entry_id=$bill_entry_id' onclick='return confirm_delete($bill_num,\"$disp_supp_name\");'>Delete</a></td>";
  echo"</tr>";
}

?>
</table>

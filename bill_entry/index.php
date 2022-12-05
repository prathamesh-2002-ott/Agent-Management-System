<?php include("../includes/check_session.php"); 
include("../includes/config.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--<html xmlns="http://www.w3.org/1999/xhtml">-->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bill Entry </title>
<link rel="icon" type="image/x-icon" href="<?php echo $web_path; ?>images/dt-favicon.ico" />
<link href="<?php echo $web_path; ?>css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function confirm_delete(bill_num,supp)
{
	if(confirm("Are you sure to delete Bill - "+bill_num+" of Supplier - "+supp))
	{
		return true;
	}
	else
	{
		return false;
	}
}
</script>
<style>
*
{
	margin:0;
	padding:0;
}

table,th,td
{
	border-collapse:collapse;
}
</style>
<script>
function bill_index_refresh(){
  document.getElementById('Check').value='';
  document.getElementById('bill_index').action='index.php';
  
  document.getElementById('bill_index').submit();
    
}

function bill_index_Ascending(){
  document.getElementById('Check').value='OK';
  document.getElementById('bill_index').action='index.php';
  
  document.getElementById('bill_index').submit();

}

//add_bill_entry.php
function addBillEntry(){
  document.getElementById('bill_index').action='add_bill_entry.php';
  
  document.getElementById('bill_index').submit();
}

</script>
</head>

<body>
<form method="post" id="bill_index" enctype="multipart/form-data" >  
<input type='hidden' name='Check' id='Check' value='' >
<table width="100%" border="0" align="center" style="border:1px solid #e5f1f8;background-color:#FFFFFF">
<tr>
    <td><?php include("../includes/header.php"); ?></td>
  </tr>
  <tr>
    <td><?php include("../includes/menu.php"); ?></td>
  </tr>
  <tr>
  <?php
  $lastDisplayCount= array('50','100','150','200','250'); 

  $lastCountSelected='50'; // Default value
if(isset($_REQUEST['LastDisplayCount'])){
  if($_REQUEST['LastDisplayCount'] != '' ){
    $lastCountSelected=$_REQUEST['LastDisplayCount'];
  }
}
  ?>
    <td height="326" valign="top"><table width="100%" style="margin-top:0px" align="center" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td valign="top">
                            <div class="content_padding">
                            <div class="content-header">
                          
            <table width="100%" border='0'><tr><td width='335'><h3>Bill Entry :</h3><h4>
            Last &nbsp; <select name="LastDisplayCount" id="LastDisplayCount">
            <?php
            foreach($lastDisplayCount as $v)
                      {
                        $selected="";
                        if($v==$lastCountSelected){
                          $selected="selected";
                        }
                        echo "<option $selected >".$v."</option>";
                      }
                      ?>
            </select>&nbsp; Entries
            Displayed in order of last updated</h4></td>
             <td align="center">
                    <?php
									if(isset($_SESSION['msg'])) {
                    echo $_SESSION['msg'];
                    $_SESSION['msg']='';
									}
								?></td>
                <td> </td>
            	<td align="right"><button onclick="bill_index_Ascending()">Ascending</button> &nbsp; &nbsp; <button onclick="bill_index_refresh()" >Refresh</button> &nbsp; &nbsp; <button onclick="addBillEntry()">Add Bill</button></td>
            </tr>
            </table>
            </div>
    
    <table cellpadding="0" cellspacing="0" border="0">
            <tr>
             <td width="100%" height="138" valign="top">
              

<table class="tbl_border" width="100%" >
	<tr>
      <th  valign="top" >S.No.</th>
      <th  valign="top" >Edit</th>      
      <th  valign="top" >View</th>            
      <th  valign="top"  width="50">Bill <BR> Entry Id</th>      
    	<th  valign="top" width="60" >Voucher Number</th>
      <th  valign="top" width="80">Voucher Date</th>
      <th  valign="top" >Bill Number</th>
      <th  valign="top"width="80">Bill Date</th>

      <th  valign="top" >Supplier </th>
      <th  valign="top" >Buyer </th>
      <th  valign="top"  width="50">Discount %</th>
      <th  valign="top"  width="80">Net Amount</th>
      <th  valign="top"  width="50">GST Amount</th>
      <th  valign="top"   width="80">Bill Amount</th>
      <th valign="top" width="80">Bill Attached</th>      


<!--        <th width="50">Delete</th> -->
    </tr>
    
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





$req_check="";
if(isset($_REQUEST['Check'])){
	$req_check=$_REQUEST['Check'];
}

if($req_check=="OK"){
  $orderby='ASC';
}else{
  $orderby='DESC';
}

$sql=" select * from (select * from txt_bill_entry 
where delete_tag='FALSE'
 ORDER BY last_update_date desc,voucher_date DESC ,bill_date DESC,bill_entry_id DESC LIMIT 0,".$lastCountSelected." )
  AS BILL_ENT_VIEW order by last_update_date ".$orderby." ";
$result=mysqli_query($con,$sql);
$count=0;

//echo $sql;
while($rs=mysqli_fetch_array($result))
{
	$bill_entry_id=$rs[0];
  echo "<tr>";
  
  echo "<td align='left' >".++$count."</td>";
  echo "<td><a href='edit_bill_entry.php?bill_entry_id=$bill_entry_id'><img src='../images/noun_project_edit_1.png' height='16' width='16' border='0' title='Edit' /></a></td>";
  echo "<td><a href='view_bill_entry.php?bill_entry_id=$bill_entry_id'><img src='../images/noun_project_preview_1.png' height='16' width='16' border='0' title='View' /></a></td>";  
  echo "<td align='left' >".$rs['bill_entry_id']."</td>";
  echo "<td align='left' >".$rs['voucher_number']."</td>";
  echo "<td align='center' >".rev_convert_date($rs['voucher_date'])."</td>";
  $bill_num=$rs['bill_number'];
	echo "<td align='left' >".$rs['bill_number']."</td>";
	echo "<td  align='center' >".rev_convert_date($rs['bill_date'])."</td>";

  
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

  $disp_transport_name=array_search($rs['transport_name'],$company_array);
  $disp_supp_name=array_search($rs['supplier_account_code'],$company_array);
  $disp_buyer_name=array_search($rs['buyer_account_code'],$company_array);

	//echo "<td>".$disp_transport_name."</td>";
	//echo "<td>".$rs['transport_name']."</td>";
  echo "<td>".$disp_supp_name."</td>";
  //echo "<td>".$rs['supplier_account_code']."</td>";
  echo "<td>".$disp_buyer_name."</td>";
  //echo "<td>".$rs['buyer_account_code']."</td>";

  echo "<td align='right' >".zeroToBlank($rs['discount_percentage'])."</td>";
  echo "<td align='right' >".$rs['net_amount']."</td>";
  echo "<td align='right' >".$rs['gst_amount']."</td>";

  echo "<td align='right' >".$rs['bill_amount']."</td>";
?>
  <td>
      <?php


        if($rs['bill_upload']!="") { ?>
			<a href='<?php echo $web_path; ?>bill_entry/upload/<?php echo $rs['bill_upload']; ?>' target="_blank">Bill Copy</a>
     
		<?php 
		} else { ?>
		<?php 
		} ?>
   </td>
<?php
 // echo "<td align='right'>".$rs['bill_upload']." </td>";
	
	//echo "<td><a href='process_bill_entry.php?action=delete&bill_entry_id=$bill_entry_id' onclick='return confirm_delete($bill_num,\"$disp_supp_name\");'>Delete</a></td>";
	echo"</tr>";
}

?>
</table>
</td></tr></table><?php $_SESSION['uid']=77; ?>
                  </div>
                  </td></tr></table>
                  </td></tr>
                  <tr>
                  	<td> <?php include("../includes/footer.php"); ?></td>
                  </tr>
</table>
</form>
</body>
</html>
<?php 
release_connection($con);
?>
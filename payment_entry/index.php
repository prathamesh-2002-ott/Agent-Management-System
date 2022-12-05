<?php include("../includes/check_session.php");
include("../includes/config.php");
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




?>
<script type="text/javascript">
function confirm_delete()
{
	if(confirm("Do you want to delete"))
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
	font-size:12px;
}
</style>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Payment Entry</title>
<link rel="icon" type="image/x-icon" href="<?php echo $web_path; ?>images/dt-favicon.ico" />
<link href="<?php echo $web_path; ?>css/style.css" rel="stylesheet" type="text/css" />

<center>
<table width="100%" border="0" align="center" style="border:1px solid #e5f1f8;background-color:#FFFFFF">
<tr>
    <td><?php include("../includes/header.php"); ?></td>
  </tr>
  <tr>
    <td><?php include("../includes/menu.php"); ?></td>
  </tr>
  <tr>
    <td height="326" valign="top"><table width="100%" style="margin-top:0px" align="center" cellpadding="0" cellspacing="0" border="1">
                        <tr>
                            <td valign="top">
                            <div class="content_padding">
                            <div class="content-header">
                          
            <table width="100%"><tr><td valign="bottom" width="335" ><h3>Payment Entry :</h3> <h4>Dispalyed in order of last updated</h4></td>
             <td align="center" >
                    <?php
									if(isset($_SESSION['msg'])) {
										echo $_SESSION['msg'];
										$_SESSION['msg']='';
									}
								?></td>
            	<td align="right"> <button onclick="location.href='index.php'">Refresh</button> &nbsp; &nbsp; <button onClick="location.href='add_payment_entry.php'">Add Payment</button></td>
            </tr>
            </table>
            </div>
    
    <table cellpadding="0" cellspacing="0" border="0">
            <tr>
             <td  valign="top">
              

<table class="tbl_border">
             	
	<tr>
    	<th valign="top" >S.No.</th>
      <th valign="top" >Edit</th>
      <th valign="top" >View</th>      
        <th valign="top" >Payment <BR> Entry Id</th>
        <th valign="top" >Manual Voucher <BR> Number</th>
        <th valign="top" >Voucher Date</th>
        <th valign="top" >Buyer Name</th>
        <th valign="top" >Supplier Name</th>
        <th valign="top" >Payment Amount</th>
        <th valign="top" >Discount Amount</th>
        <th valign="top" >Goods Return <BR> Amount</th>
        <th valign="top" >Payment Type</th>


<!--        <th>Delete</th> -->

    </tr>
    
<?php
$sql_pay="select * from txt_payment_entry_main 
        where delete_tag='FALSE' 
        order by last_update_date desc,voucher_date DESC, payment_entry_id desc LIMIT 0,50";
        
$result=mysqli_query($con,$sql_pay);
$count=0;
while($rs=mysqli_fetch_array($result))
{
	$payment_entry_id=$rs[0];
	echo "<tr>";
  echo "<td>".++$count."</td>";
  echo "<td><a href='edit_payment_entry.php?payment_entry_id=$payment_entry_id'><img src='../images/noun_project_edit_1.png' height='16' width='16' border='0' title='Edit' /></a></td>";
  echo "<td><a href='view_payment_entry.php?payment_entry_id=$payment_entry_id'><img src='../images/noun_project_preview_1.png' height='16' width='16' border='0' title='View' /></a></td>";
  echo "<td align='left' >".$rs['payment_entry_id']."</td>";
	echo "<td  align='left' >".$rs['manual_vou_number']."</td>";
  echo "<td  align='center' >".rev_convert_date($rs['voucher_date'])."</td>";
  
    
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
  echo "<td  align='right' >".zeroToBlank($rs['payment_amount'])."</td>";
  echo "<td align='right' >".zeroToBlank($rs['discount_amount'])."</td>";
  echo "<td align='right' >".zeroToBlank($rs['gr_amount'])."</td>";
  echo "<td align='right' >".$rs['vou_type']."</td>";

	//echo "<td><a href='process_payment_entry.php?action=delete&payment_entry_id=$payment_entry_id' onclick='return confirm_delete();'>Delete</a></td>";
	
	echo"</tr>";
}
?>
</table>
</td></tr></table><?php $_SESSION['uid']=77; ?>
                  </div>
                  </td></tr></table>
                  </td></tr>
                  <tr>
                  	<td><?php include("../includes/footer.php"); ?></td>
                  </tr>
                  </table>
                  </html>
                  <?php 
release_connection($con);
?>
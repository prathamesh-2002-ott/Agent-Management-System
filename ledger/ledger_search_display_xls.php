<?php include("../includes/check_session.php");
include("../includes/config.php");
$con=get_connection();

$download='XLS';

$sql="select * from txt_company where delete_tag='FALSE' order by company_id ASC";
$result=mysqli_query($con,$sql);

$rowcount=0;
// Creating Company Array with reverse Key Value Pair 
// because array_search function searched value and returns key
// first value Dummy to show the position of details
$company_array=array("Value"=>"Key"); 
while($rs=mysqli_fetch_array($result))
{

  $com_array=array($rs['firm_name']=>$rs['company_id']);
  $company_array=array_merge($company_array,$com_array);


  $rowcount++;

}
?>

<?php

$supp_name=array_search($_REQUEST['supplier_account_code'],$company_array);
$buy_name=array_search($_REQUEST['buyer_account_code'],$company_array);


$time=time()+19800; // Timestamp is in GMT now converted to IST
$date=date('d_m_Y_H_i_s',$time);

//application/vnd.openxmlformats-officedocument.spreadsheetml.sheet
header ( "Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" );
header ( "Content-Disposition: attachment; filename=Ledger_".$supp_name."_".$buy_name."_".$date.".xls" );


?>

<?php  if($_REQUEST['report_disp']=='OK'){  $rep_print="" ;  $rep_xls="OK"; ?>   
<table ><tr><td>
<?php include("../includes/header_xls.php"); ?>    
</td></tr>
<tr><td>
<?php include("ledger_search_display.php"); ?>   
</td>
</tr>
</table>
<?php } ?>  
<?php 
release_connection($con);
?>
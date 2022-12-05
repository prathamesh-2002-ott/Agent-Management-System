<?php include("../includes/check_session_admin.php");
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

$rep_supplier_code=$_REQUEST['supplier_account_code'];
$disp_suppllier_code=array_search($rep_supplier_code,$company_array);
$start_date=$_REQUEST['start_date'];
$end_date=$_REQUEST['end_date'];


$time=time()+19800; // Timestamp is in GMT now converted to IST
//$date=date('d_m_Y_H_i_s',$time);
$date=date('Ymd',$time);

//application/vnd.openxmlformats-officedocument.spreadsheetml.sheet
header ( "Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" );
header ( "Content-Disposition: attachment; filename=".$disp_suppllier_code."_Commission_Detail_report_".$start_date."_To_".$end_date."_ason_".$date.".xls" );
?>

<?php  if($_REQUEST['bill_report_disp']=='OK'){ ?>      
<table><tr><td>
<?php include("../includes/header_xls.php"); ?>    
</td></tr>
<tr><td>         
<?php include("commission_detail_report_display.php"); ?>   
</td>
</tr>
</table>
<?php } ?>  
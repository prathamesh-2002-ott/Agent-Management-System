<?php include("../includes/check_session.php");
include("../includes/config.php");
$con=get_connection();
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Supplier Outstanding Report</title>
<link rel="icon" type="image/x-icon" href="<?php echo $web_path; ?>images/dt-favicon.ico" />
<link href="<?php echo $web_path; ?>css/style.css" rel="stylesheet" type="text/css" />
<meta charset="UTF-8" />

<style type="text/css" media="print">
  @page { size:A4 portrait; }
</style>

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
</head>

<body>

<table width="100%" border="0" align="center" style="background-color:#FFFFFF">
<tr> <td>
<?php

$time=time()+19800; // Timestamp is in GMT now converted to IST
$date=date('d_m_Y_H_i_s',$time);

//application/vnd.openxmlformats-officedocument.spreadsheetml.sheet 
//application/octet-stream


//header('Content-Type: application/pdf');
//header('Content-Type: application/octet-stream');
//header('Accept-Ranges: bytes');
//header('Accept-Charset: iso-8859-1,*,utf-8');

//header('Content-Transfer-Encoding: Binary');
//header ( "Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" );
//header ( "Content-Disposition: attachment; filename=Buyer_outstanding_report_".$date.".pdf" );
?>

<?php  if($_REQUEST['report_disp']=='OK'){  $rep_xls="" ; $download='';  $rep_print="OK"; ?>    
<table  border='0' ><tr><td>
<?php include("../includes/header_xls.php"); ?>    
</td></tr>
<tr><td>             
<?php include("supplier_outstanding_report_display.php"); ?>   
</td>
</tr>
</table>
<?php } ?>  
</td>
</tr>
</table>
<script>
    window.print();
</script>
</body>
</html>
<?php 
release_connection($con);
?>
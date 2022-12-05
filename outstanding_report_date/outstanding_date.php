<?php include("../includes/check_session.php");
include("../includes/config.php");
$con=get_connection();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Outstanding Report Firm (DW)</title>
<link rel="icon" type="image/x-icon" href="<?php echo $web_path; ?>images/dt-favicon.ico" />
<link href="<?php echo $web_path; ?>css/style.css" rel="stylesheet" type="text/css" />
	<meta charset="UTF-8" />

<script>
  function check(){
    if(document.getElementById('buyer_account_code').value==""){
      alert ('Please Select Buyer');
      document.getElementById('buyer_account_code').focus();
      return false;
    }
    return true;
  }
  function report_submit(){

    //if(check()){
      document.getElementById('report').action='outstanding_date.php';
      document.getElementById('report').target="_self";
      //document.getElementById('report').onsubmit="";
      document.getElementById('report').submit();
    //}
  }

  function excelDownLoad(){
    if(document.getElementById('download_lock').value=='OFF'){
        document.getElementById('report').action='outstanding_date_report_display_xls.php';
        document.getElementById('report').target="_self";
      //  document.getElementById('report').onsubmit="";
        document.getElementById('report').submit();
    }else{
      alert (' You have changed the Search Criteria Please Click Go First');
    }

  }

  function pdfDownLoad(){
    if(document.getElementById('download_lock').value=='OFF'){    
        document.getElementById('report').action='outstanding_date_report_display_print.php';
        document.getElementById('report').target="print_popup";
        window.open('','print_popup','menubar=no,addressbar=no, width=1000,height=800,resizable=yes,toolbar=no,status=no');
        document.getElementById('report').submit();
    }else{
      alert (' You have changed the Search Criteria Please Click Go First');
    }    

  }

  function downloadLock(){
    document.getElementById('download_lock').value='ON';
  }
</script>


<script>

function changeDates(){
  downloadLock();
  var today_date= new Date();
  cur_month=today_date.getMonth()+1;
  cur_year=today_date.getFullYear();
  next_year=cur_year+1;
  prev_year=cur_year-1;
  prev_prev_year=cur_year-2;

  if(cur_month>3){
    cur_year_start_date="01-04-"+cur_year;
    cur_year_end_date="31-03-"+next_year;

    prev_year_start_date="01-04-"+prev_year;
    prev_year_end_date="31-03-"+cur_year;

  }else{
    cur_year_start_date="01-04-"+prev_year;
    cur_year_end_date="31-03-"+cur_year;

    prev_year_start_date="01-04-"+prev_prev_year;
    prev_year_end_date="31-03-"+prev_year;

  }

  document.getElementById('changeDate').value
  if(document.getElementById('changeDate').value=="Previous Year End"){
    //document.getElementById('start_date').value=prev_year_start_date;
    document.getElementById('bill_end_date').value=prev_year_end_date;
    document.getElementById('changeDate').value="Current Year End"


  }else{
    //document.getElementById('start_date').value=cur_year_start_date;
    document.getElementById('bill_end_date').value=cur_year_end_date;
    document.getElementById('changeDate').value="Previous Year End"

  }
  document.getElementById('bill_end_date').focus();
  
}


function todayDates(){
  downloadLock();
  var today_date= new Date();
  cur_month=today_date.getMonth()+1;

  if(cur_month<10){
    cur_month="0"+cur_month;
  }
  cur_year=today_date.getFullYear();

  today_date=today_date.getDate();
  if(today_date<10){
    today_date="0"+today_date;
  }

  display_date=today_date+"-"+cur_month+"-"+cur_year


  document.getElementById('todayDate').value
  if(document.getElementById('todayDate').value=="Today"){
    //document.getElementById('start_date').value=prev_year_start_date;
    document.getElementById('bill_end_date').value=display_date;
    document.getElementById('todayDate').value="Clear"


  }else{
    //document.getElementById('start_date').value=cur_year_start_date;
    document.getElementById('bill_end_date').value="";
    document.getElementById('todayDate').value="Today"

  }
  document.getElementById('bill_end_date').focus();
  
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

<script type="text/javascript" src="../js/dateCheck.js"></script>
<?php include("../includes/jQDate.php"); ?>  

<?php 

$supplier_code="";
if(isset($_REQUEST['supplier_account_code'])){
  $supplier_code=$_REQUEST['supplier_account_code'];

}

$buyer_code="";
if(isset($_REQUEST['buyer_account_code'])){
  $buyer_code=$_REQUEST['buyer_account_code'];
}
//$bill_start_date=$_REQUEST['bill_start_date'];
$bill_end_date="";
if(isset($_REQUEST['bill_end_date'])){
  $bill_end_date=$_REQUEST['bill_end_date'];
}

$bill_report_disp="";
if(isset($_REQUEST['report_disp'])){
  $bill_report_disp=$_REQUEST['report_disp'];
}

$time=time()+19800; // Timestamp is in GMT now converted to IST
$date=date('d_m_Y_H_i_s',$time);

$month=date('n',$time);
$curr_year=date('Y',$time);
$next_year=$curr_year+1;
$prev_year=$curr_year-1;


if($month>3){
    $default_start_date="01-04-$curr_year";
    $default_end_date="31-03-$next_year";
}else{

    $default_start_date="01-04-$prev_year";
    $default_end_date="31-03-$curr_year";    
}

?>
</head>

<body>
<table width="100%" border="5" align="center" style="border:1px solid #e5f1f8;background-color:#FFFFFF">
  <tr>
    <td><?php include("../includes/header.php"); ?></td>
  </tr>
  <tr>
    <td><?php include("../includes/menu.php"); ?></td>
  </tr>
  <tr>
    <td height="326" valign="top">
      <table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
        <tr>
          <td valign="top">
            <div class="content_padding">
              <div class="content-header">
                <table width="100%" border='0'><tr><td><h3> Outstanding By Firm (Date Wise):</h3></td></tr></table>
              </div>
              <form method="post" id="report" onsubmit="" enctype="multipart/form-data" >              
              <table class="tbl_border">
                <tr>
                <th align="left">Buyer Name</th>
			
      <td>
          <select onchange='downloadLock()' name="buyer_account_code" id="buyer_account_code">
              <option value="">All</option>
                <?php
                  $s_sql="SELECT * FROM txt_company WHERE Firm_type='Buyer' AND delete_tag='FALSE' order by firm_name ASC";
                  $s_result=mysqli_query($con,$s_sql);
                  while($s_rs=mysqli_fetch_array($s_result))
                  {
                    $selected="";
                    if($buyer_code==$s_rs['company_id'])
                    {
                      $selected="selected";
                    }
                    echo "<option $selected value='".$s_rs['company_id']."'>".$s_rs['firm_name']."</option>";
                  }
                ?>
          </select>
      </td>                  
                  <th  align="left"> Supplier Name </th>
                  <td>
                    <select onchange='downloadLock()'  name="supplier_account_code" id="supplier_account_code">
                        <option value="">All</option>
                          <?php
                            $s_sql="SELECT * FROM txt_company WHERE Firm_type='Supplier' AND delete_tag='FALSE' order by firm_name ASC";
                            $s_result=mysqli_query($con,$s_sql);
                            while($s_rs=mysqli_fetch_array($s_result))
                            {
                              $selected="";
                              if($supplier_code==$s_rs['company_id'])
                              {
                                $selected="selected";
                              }
                              echo "<option $selected value='".$s_rs['company_id']."'>".$s_rs['firm_name']."</option>";
                            }
                          ?>
                    </select>
		              </td>


                </tr>
                <?php 
                  
                  
                  $disp_end_date=$default_end_date;
                  if($bill_report_disp=="OK" ){ 
                    
                    $disp_end_date=$bill_end_date;
                  }
                  //echo   $disp_end_date;
                ?>                 
                <tr>
                  <!--
                  <th  align="left"> Bill Start Date </th>
                  <td><input type="text"  onChange="validatedate_format(this)"  name="bill_start_date" class="datepick" size="8" id="bill_start_date" value="<?php //echo $bill_start_date ?>" /></td>
                          -->

                  <th align="left"> Till Date </th>
                  <td colspan='3'><input type="text"  onChange="validatedate_format(this);downloadLock()"  name="bill_end_date" class="datepick" size="8" id="bill_end_date" value="<?php echo $disp_end_date ?>" /> 
                  &nbsp;&nbsp; <input  type="button" class="date-button" onclick="changeDates()" name="changeDate" id="changeDate" value="Previous Year End" />
                  &nbsp;&nbsp; <input  type="button" class="date-button" onclick="todayDates()" name="todayDate" id="todayDate" value="Today" />
                </td>
                </tr>
                <tr><td colspan='4'> <span class="astrik">*</span> Report will be displayed in order of <b> Bill Date </b></td></tr>

                
              </table>
              <br>
              <table>
              <tr>
                <td>
                <input  type="button" class="form-button" onclick="report_submit()" name="my_btn" value="Go" />
                </td></tr>
              </table>
              <input type='hidden' name='report_disp' id='report_disp' value='OK' >
              <input type='hidden' name='download_lock' id='download_lock' value='OFF' >

              <br>
              <br>
              </form>
              <?php if(isset($_REQUEST['report_disp'])){ 
                    if($_REQUEST['report_disp']=='OK'){  $rep_print="" ; $rep_xls="" ; $download='';?>           
              <?php include("outstanding_date_report_display.php"); ?>   
              <?php }  }?>           
            </div>                                 
          </td>
        </tr>
        <tr>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>

    </td>
  </tr>
    <?php include("../includes/footer.php"); ?>

</table>
</body>
</html>
<?php 
release_connection($con);
?>


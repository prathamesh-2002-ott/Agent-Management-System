<?php include("../includes/check_session.php");
include("../includes/config.php");
$con=get_connection();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bill Report</title>
<link rel="icon" type="image/x-icon" href="<?php echo $web_path; ?>images/dt-favicon.ico" />
<link href="<?php echo $web_path; ?>css/style.css" rel="stylesheet" type="text/css" />
	<meta charset="UTF-8" />


<script>
  function bill_report_submit(){
    document.getElementById('bill_report').action='index.php';
    document.getElementById('bill_report').target="_self";
		document.getElementById('bill_report').submit();

  }

  function excelDownLoad(){
    if(document.getElementById('download_lock').value=='OFF'){    
      document.getElementById('bill_report').action='bill_report_display_xls.php';
      document.getElementById('bill_report').target="_self";
      document.getElementById('bill_report').submit();
    }else{
      alert (' You have changed the Search Criteria Please Click Go First');
    }    

  }
  function pdfDownLoad(){
    if(document.getElementById('download_lock').value=='OFF'){     
      document.getElementById('bill_report').action='bill_report_display_print.php';
      document.getElementById('bill_report').target="print_popup";
      window.open('','print_popup','titlebar=no,menubar=no,location=no,addressbar=no,width=1000,height=800,resizable=yes,toolbar=no,status=no');
      document.getElementById('bill_report').submit();
    }else{
      alert (' You have changed the Search Criteria Please Click Go First');
    }

  }  

  function downloadLock(){
    document.getElementById('download_lock').value='ON';
  }
</script>
<?php 
$download='NO';

$supplier_code="";
if(isset($_REQUEST['supplier_account_code'])){
  $supplier_code=$_REQUEST['supplier_account_code'];
}

$buyer_code="";
if(isset($_REQUEST['buyer_account_code'])){
  $buyer_code=$_REQUEST['buyer_account_code'];
}

$start_date="";
if(isset($_REQUEST['bill_start_date'])){
  $start_date=$_REQUEST['bill_start_date'];
}

$end_date="";
if(isset($_REQUEST['bill_end_date'])){
  $end_date=$_REQUEST['bill_end_date'];
}

$bill_report_disp="";
if(isset($_REQUEST['report_disp'])){
  $bill_report_disp=$_REQUEST['report_disp'];
}
/*
$supplier_code=$_REQUEST['supplier_account_code'];
$buyer_code=$_REQUEST['buyer_account_code'];
$start_date=$_REQUEST['bill_start_date'];
$end_date=$_REQUEST['bill_end_date'];
$bill_report_disp=$_REQUEST['report_disp'];
*/

$time=time()+19800; // Timestamp is in GMT now converted to IST
$date=date('d_m_Y_H_i_s',$time);

$month=date('n',$time);
$curr_year=date('Y',$time);
$next_year=$curr_year+1;
$prev_year=$curr_year-1;


if($month>3){
    $default_vou_start_date=$default_start_date="01-04-$curr_year";
    $default_vou_end_date=$default_end_date="31-03-$next_year";
    
    
}else{

    $default_vou_start_date=$default_start_date="01-04-$prev_year";
    $default_vou_end_date=$default_end_date="31-03-$curr_year";    
}

?>

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
  if(document.getElementById('changeDate').value=="Previous Year"){
    document.getElementById('bill_start_date').value=prev_year_start_date;
    document.getElementById('bill_end_date').value=prev_year_end_date;
    document.getElementById('changeDate').value="Current Year"


  }else{
    document.getElementById('bill_start_date').value=cur_year_start_date;
    document.getElementById('bill_end_date').value=cur_year_end_date;
    document.getElementById('changeDate').value="Previous Year"

  }
  document.getElementById('bill_start_date').focus();
  
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


function todayDatesVou(){
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


  document.getElementById('todayDateVou').value
  if(document.getElementById('todayDateVou').value=="Today"){
    //document.getElementById('start_date').value=prev_year_start_date;
    document.getElementById('vou_end_date').value=display_date;
    document.getElementById('todayDateVou').value="Clear"


  }else{
    //document.getElementById('start_date').value=cur_year_start_date;
    document.getElementById('vou_end_date').value="";
    document.getElementById('todayDateVou').value="Today"

  }
  document.getElementById('vou_end_date').focus();
  
}


function changeDatesVou(){
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

  document.getElementById('changeDateVou').value
  if(document.getElementById('changeDateVou').value=="Previous Year"){
    document.getElementById('vou_start_date').value=prev_year_start_date;
    document.getElementById('vou_end_date').value=prev_year_end_date;
    document.getElementById('changeDateVou').value="Current Year"


  }else{
    document.getElementById('vou_start_date').value=cur_year_start_date;
    document.getElementById('vou_end_date').value=cur_year_end_date;
    document.getElementById('changeDateVou').value="Previous Year"

  }
  document.getElementById('vou_start_date').focus();
  
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


$bill_report_disp="";
if (isset($_REQUEST['bill_report_disp']))
{
  $bill_report_disp=$_REQUEST['bill_report_disp'];
}


$supplier_code="";
if(isset($_REQUEST['supplier_account_code'])){
  $supplier_code=$_REQUEST['supplier_account_code'];
}


$buyer_code=="";
if (isset($_REQUEST['buyer_account_code']))
{
  $buyer_code=$_REQUEST['buyer_account_code'];
}

$bill_start_date="";
if(isset($_REQUEST['bill_start_date']))
{
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
  $vou_end_date=$_REQUEST['vou_end_date'];
}


$order='Entry Date'; // Default value
if(isset($_REQUEST['order'] ) ){
  if($_REQUEST['order'] != '' ){
    $order=$_REQUEST['order'];
  }
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
                <table width="100%" border='0'><tr><td><h3>Bill Reports :</h3></td></tr></table>
              </div>
              <form method="post" id="bill_report" enctype="multipart/form-data" >              
              <table class="tbl_border">
                <tr>
                  <th  align="left"> Supplier Name </th>
                  <td>
                    <select onchange='downloadLock()' name="supplier_account_code" id="supplier_account_code">
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
        
                </tr>
                <?php 
                  
                  $disp_start_date=$default_start_date;
                  $disp_end_date=$default_end_date;
                  $disp_vou_start_date=$default_vou_start_date;
                  $disp_vou_end_date=$default_vou_end_date;
                  if($bill_report_disp=="OK" ){ 
                    $disp_start_date=$bill_start_date;
                    $disp_end_date=$bill_end_date;
                    $disp_vou_start_date=$vou_start_date;
                    $disp_vou_end_date=$vou_end_date;                    
                  }
                    
                ?> 

                <tr>
                  <th  align="left"> Bill Start Date </th>
                  <td><input type="text"  onChange="validatedate_format(this);downloadLock()"  name="bill_start_date" class="datepick" size="8" id="bill_start_date" value="<?php echo $disp_start_date ?>" /></td>

                  <th align="left">Bill End Date </th>
                  <td><input type="text"  onChange="validatedate_format(this);downloadLock()" name="bill_end_date" class="datepick" size="8" id="bill_end_date" value="<?php echo $disp_end_date ?>" />
                  &nbsp;&nbsp; <input  type="button" class="date-button" onclick="changeDates()" name="changeDate" id="changeDate" value="Previous Year" />
                  &nbsp;&nbsp; <input  type="button" class="date-button" onclick="todayDates()" name="todayDate" id="todayDate" value="Today" />
                </td>
              
                </tr>
                <tr>
                  <th  align="left">Entry Start Date  </th>
                  <td><input type="text" onChange="validatedate_format(this);downloadLock()"  name="vou_start_date" class="datepick" size="8" id="vou_start_date" value="<?php echo $disp_vou_start_date ?>" /></td>

                  <th align="left">Entry End Date </th>
                  <td><input type="text" onChange="validatedate_format(this);downloadLock()"  name="vou_end_date" class="datepick" size="8" id="vou_end_date" value="<?php echo $disp_vou_end_date ?>" />
                  &nbsp;&nbsp; <input  type="button" class="date-button" onclick="changeDatesVou()" name="changeDateVou" id="changeDateVou" value="Previous Year" />
                  &nbsp;&nbsp; <input  type="button" class="date-button" onclick="todayDatesVou()" name="todayDateVou" id="todayDateVou" value="Today" />
                </td>
                
                </tr>
                <tr>
                  <th align='left'> Order By
                  </th>
                  <?php
                  $order_by= array('Entry Date','Bill Date'); 

                  ?>
                  <td>

                  <select onchange='downloadLock()' name='order' id='order' >
                  <?php 
                      foreach($order_by as $v)
                      {
                        $selected="";
                        if($v==$order){
                          $selected="selected";
                        }
                        echo "<option $selected >".$v."</option>";
                      }
                  ?>
                  </select>
                  </td>
                  <td colspan='2'>&nbsp;</td>  
                  </tr>
                               
                <tr><td colspan='4'> <span class="astrik">*</span> Report will be displayed in order of <b> <?php echo $order ?> </b></td></tr>
            
                
              </table>
              <br>
              <table>
              <tr>
                <td>
                <input  type="button" class="form-button" onclick="bill_report_submit()" name="my_btn" value="Go" />
                </td></tr>
              </table>
              <input type='hidden' name='bill_report_disp' id='bill_report_disp' value='OK' >
              <input type='hidden' name='download_lock' id='download_lock' value='OFF' >
              <br>
              <br>
              </form>
              <?php  if(isset($_REQUEST['bill_report_disp'])){ 
              
              if($_REQUEST['bill_report_disp']=='OK'){ $rep_print="" ; $rep_xls="" ; $download=''; ?>           
              <?php include("bill_report_display.php"); ?>   
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


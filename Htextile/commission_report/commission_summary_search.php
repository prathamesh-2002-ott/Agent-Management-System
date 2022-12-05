<?php include("../includes/check_session_admin.php");
include("../includes/config.php");
$con=get_connection();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Commission Summary Report</title>
<link rel="icon" type="image/x-icon" href="<?php echo $web_path; ?>images/dt-favicon.ico" />
<link href="<?php echo $web_path; ?>css/style.css" rel="stylesheet" type="text/css" />
	<meta charset="UTF-8" />


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

</script>  

<script>
  function comm_detail_report_submit(){
      
    document.getElementById('comm_detail_report').action='commission_summary_search.php';
    document.getElementById('comm_detail_report').target="_self";
		document.getElementById('comm_detail_report').submit();

  }

  function excelDownLoad(){
    if(document.getElementById('download_lock').value=='OFF'){
      document.getElementById('comm_detail_report').action='commission_summary_display_xls.php';
      document.getElementById('comm_detail_report').target="_self";
      document.getElementById('comm_detail_report').submit();
    }else{
      alert (' You have changed the Search Criteria Please Click Go First');
    }

  }


  function pdfDownLoad(){
    if(document.getElementById('download_lock').value=='OFF'){    
        document.getElementById('comm_detail_report').action='commission_summary_display_print.php';
        document.getElementById('comm_detail_report').target="print_popup";
        window.open('','print_popup','menubar=no,addressbar=no, width=1000,height=800,resizable=yes,toolbar=no,status=no');
        document.getElementById('comm_detail_report').submit();
    }else{
      alert (' You have changed the Search Criteria Please Click Go First');
    }    

  }
  function downloadLock(){
    document.getElementById('download_lock').value='ON';
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
if(isset($_REQUEST['supplier_group_code'])){
  $supplier_code=$_REQUEST['supplier_group_code'];
}

$comm_report_type="";
if(isset($_REQUEST['comm_report_type'])){
  $comm_report_type=$_REQUEST['comm_report_type'];
}

$start_date="";
if(isset($_REQUEST['start_date'])){
  $start_date=$_REQUEST['start_date'];
}

$end_date="";
if(isset($_REQUEST['end_date'])){
  $end_date=$_REQUEST['end_date'];
}

$bill_report_disp="";
if(isset($_REQUEST['bill_report_disp'])){
  $bill_report_disp=$_REQUEST['bill_report_disp'];
}


// Default GST is 5
$GST="5";
if(isset($_REQUEST['GST'])){
  $GST=$_REQUEST['GST'];
}

/*
$supplier_code=$_REQUEST['supplier_group_code'];
$comm_report_type=$_REQUEST['comm_report_type'];
$start_date=$_REQUEST['start_date'];
$end_date=$_REQUEST['end_date'];
$bill_report_disp=$_REQUEST['bill_report_disp'];
*/
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
                <table width="100%" border='0'><tr><td><h3>Commission Summary Report :</h3></td></tr></table>
              </div>
              <form method="post" id="comm_detail_report" enctype="multipart/form-data" >              
              <table class="tbl_border">
                <tr>
                  <th  align="left"> Supplier Group </th>
                  <td>
                    <select onchange='downloadLock()' name="supplier_group_code" id="supplier_group_code">
                        <option value="">All</option>
                          <?php
                            $s_sql="SELECT * FROM txt_group_master WHERE group_type='Supplier' AND delete_tag='FALSE' order by group_name ASC";
                            $s_result=mysqli_query($con,$s_sql);
                            while($s_rs=mysqli_fetch_array($s_result))
                            {
                              $selected="";
                              if($supplier_code==$s_rs['group_id'])
                              {
                                $selected="selected";
                              }
                              echo "<option $selected value='".$s_rs['group_id']."'>".$s_rs['group_name']."</option>";
                            }
                          ?>
                    </select>
		              </td>

                  <th align="left"> Report Type </th>
			
                  <td>
                      <select onchange='downloadLock()' name="comm_report_type" id="comm_report_type">
                            <?php
                                $arr=array('Bill Wise','Payment Wise','Both');

                                foreach($arr as $v)
                                {
                                    $selected="";
                                    if($v==$comm_report_type){
                                        $selected="selected";
                                    }
                                    echo "<option $selected >".$v."</option>";
                                } 
                            ?>
                      </select>
                  </td>
                </tr>
                <tr>
                  <th  align="left"> Start Date </th>
                  <?php if($bill_report_disp=="OK" ){ ?>
                    <td><input type="text"  onChange="validatedate_format(this)"  name="start_date" class="datepick" size="8" id="bill_start_date" value="<?php echo $start_date ?>" /></td>
                  <?php }else{ ?>
                  <td><input type="text"  onChange="validatedate_format(this)"  name="start_date" class="datepick" size="8" id="bill_start_date" value="<?php echo $default_start_date ?>" /></td>
                  <?php } ?>
                  <th align="left"> End Date </th>

                  <?php if($bill_report_disp=="OK"){ ?>

                  <td><input type="text"  onChange="validatedate_format(this);downloadLock()" name="end_date" class="datepick" size="8" id="bill_end_date" value="<?php echo $end_date ?>" />  &nbsp;&nbsp; <input  type="button" class="date-button" onclick="changeDates()" name="changeDate" id="changeDate" value="Previous Year" />
                </td>
                  <?php }else{ ?>
                    <td><input type="text"  onChange="validatedate_format(this);downloadLock()"  name="end_date" class="datepick" size="8" id="bill_end_date" value="<?php echo $default_end_date ?>" /> &nbsp;&nbsp; <input  type="button" class="date-button" onclick="changeDates()" name="changeDate" id="changeDate" value="Previous Year" />
                    </td>
                  <?php } ?>
                 
                
                
                </tr>
                <tr>                
                <th align="left"> GST % </th>
			
                <td>
                    <select onchange='downloadLock()' name="GST" id="GST">
                          <?php
                              $arr=array('0','5','12','18');

                              foreach($arr as $v)
                              {
                                  $selected="";
                                  if($v==$GST){
                                      $selected="selected";
                                  }
                                  echo "<option $selected >".$v."</option>";
                              } 
                          ?>
                    </select>
                </td>
                </tr>
                <tr><td colspan='4'> <span class="astrik">*</span> </td></tr>

                
              </table>
              <br>
              <table>
              <tr>
                <td>
                <input  type="button" class="form-button" onclick="comm_detail_report_submit()" name="my_btn" value="Go" />
                </td></tr>
              </table>
              <input type='hidden' name='bill_report_disp' id='bill_report_disp' value='OK' >
              <input type='hidden' name='download_lock' id='download_lock' value='OFF' >
              <br>
              <br>
              </form>
              <?php  if(isset($_REQUEST['bill_report_disp'])){  
                    if($_REQUEST['bill_report_disp']=='OK'){ $rep_print=""; ?>           
              <?php include("commission_summary_display.php"); ?>   
              <?php } } ?>           
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


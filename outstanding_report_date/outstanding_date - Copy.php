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
$supplier_code=$_REQUEST['supplier_account_code'];
$buyer_code=$_REQUEST['buyer_account_code'];
$bill_start_date=$_REQUEST['bill_start_date'];
$bill_end_date=$_REQUEST['bill_end_date'];

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
                <tr>
                  <!--
                  <th  align="left"> Bill Start Date </th>
                  <td><input type="text"  onChange="validatedate_format(this)"  name="bill_start_date" class="datepick" size="8" id="bill_start_date" value="<?php echo $bill_start_date ?>" /></td>
                          -->

                  <th align="left"> Till Date </th>
                  <td colspan='3'><input type="text"  onChange="validatedate_format(this);downloadLock()"  name="bill_end_date" class="datepick" size="8" id="bill_end_date" value="<?php echo $bill_end_date ?>" /></td>
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
              <?php  if($_REQUEST['report_disp']=='OK'){ ?>           
              <?php include("outstanding_date_report_display.php"); ?>   
              <?php } ?>           
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


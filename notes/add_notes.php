<?php include("../includes/check_session.php");
include("../includes/config.php");
$con=get_connection();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Notes Add</title>
<link rel="icon" type="image/x-icon" href="<?php echo $web_path; ?>images/dt-favicon.ico" />
<link href="<?php echo $web_path; ?>css/style.css" rel="stylesheet" type="text/css" />
	<meta charset="UTF-8" />


<script>

function check(){
    if(document.getElementById('buyer_group_code').value==""){
      alert ('Please Select Buyer Group');
      document.getElementById('buyer_group_code').focus();
      return false;
    }
    return true;
  }
  function report_submit(){
    if(check()){
      document.getElementById('notes').action='add_notes.php';
      document.getElementById('notes').target="_self";
      document.getElementById('notes').submit();
    }

  }

function check_save(){

  buyer_group= document.getElementById('buyer_group_code').value;
  supplier_group= document.getElementById('supplier_group_code').value;
  buyer_group_h= document.getElementById('buyer_group_code_h').value;
  supplier_group_h= document.getElementById('supplier_group_code_h').value;

  notes_data=document.getElementById('notes_data').value;

  open_date=document.getElementById('open_date').value;

  if(buyer_group!=buyer_group_h ){
    alert ('Buyer Group is Changed please Press Go to get the updated Buyer Name');
    return false;
  }

  if(supplier_group!=supplier_group_h ){
    alert ('Supplier Group is Changed please Press Go to get the updated Supplier Name');
    return false;
  }

  if(open_date==""){
    alert ("Open Date Can not be Empty");
    document.getElementById('open_date').focus();
    return false;
  }



  if(notes_data==""){
    alert ("Notes Can not be Empty");
    document.getElementById('notes_data').focus();
    return false;
  }





  return true;

}

function notes_save(){
  if(check_save()){
    document.getElementById('notes').action='process_notes.php?action=add';
		document.getElementById('notes').submit();

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
<script type="text/javascript" src="../js/dateCheck.js"></script>
<?php include("../includes/jQDate.php"); ?>  
<script type="text/javascript">
        window.onbeforeunload = function () {
            var inputs = document.getElementsByTagName("INPUT");
            for (var i = 0; i < inputs.length; i++) {
                if (inputs[i].type == "button" || inputs[i].type == "submit") {
                    inputs[i].disabled = true;
                }
            }
        };
	</script>

<?php 

$supplier_group_code="";
if(isset($_REQUEST['supplier_group_code'])){
  $supplier_group_code=$_REQUEST['supplier_group_code'];
}

$buyer_group_code="";
if(isset($_REQUEST['buyer_group_code'])){
  $buyer_group_code=$_REQUEST['buyer_group_code'];
}

$open_date="";
if(isset($_REQUEST['open_date'])){
  $open_date=$_REQUEST['open_date'];
}
//$open_till=$_REQUEST['open_till'];

$status_selected="";
if(isset($_REQUEST['status'])){
  $status_selected=$_REQUEST['status'];
}

$notes_part_two="";
if(isset($_REQUEST['notes_part_two'])){
  $notes_part_two=$_REQUEST['notes_part_two'];
}


$time=time()+19800; // Timestamp is in GMT now converted to IST
$date=date('d_m_Y_H_i_s',$time);
//echo $date;
$default_open_date=	date("d-m-Y",$time);
$disp_open_date=$default_open_date;
if($notes_part_two=="OK"){
  $disp_open_date=$open_date;
}



$status_arr=array('Open');
//$status_arr=array('Open','Close','Pending');


?>
</head>

<body>
<table width="100%"  align="center" style="border:1px solid #e5f1f8;background-color:#FFFFFF">
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
              <a href="index.php">Back</a>
                <table width="100%" border='0'><tr><td><h3>Notes :</h3></td></tr></table>
              </div>
              <form method="post" id="notes" enctype="multipart/form-data" >              
              <table class="tbl_border">
                <tr>
                <th align="left">Buyer Group Name</th>
			
      <td>
          <select   name="buyer_group_code" id="buyer_group_code">
              <option value="">All</option>
                <?php
                  $s_sql="SELECT * FROM txt_group_master WHERE group_type='Buyer' AND delete_tag='FALSE' order by group_name ASC";
                  $s_result=mysqli_query($con,$s_sql);
                  while($s_rs=mysqli_fetch_array($s_result))
                  {
                    $selected="";
                    if($buyer_group_code==$s_rs['group_id'])
                    {
                      $selected="selected";
                    }
                    echo "<option $selected value='".$s_rs['group_id']."'>".$s_rs['group_name']."</option>";
                  }
                ?>
          </select>
      </td>                  
                  <th  align="left"> Supplier Group Name </th>
                  <td>
                    <select  name="supplier_group_code" id="supplier_group_code">
                        <option value="">All</option>
                          <?php
                            $s_sql="SELECT * FROM txt_group_master WHERE group_type='Supplier' AND delete_tag='FALSE' order by group_name ASC";
                            $s_result=mysqli_query($con,$s_sql);
                            while($s_rs=mysqli_fetch_array($s_result))
                            {
                              $selected="";
                              if($supplier_group_code==$s_rs['group_id'])
                              {
                                $selected="selected";
                              }
                              echo "<option $selected value='".$s_rs['group_id']."'>".$s_rs['group_name']."</option>";
                            }
                          ?>
                    </select>
		              </td>


                </tr>

                <tr>
                  <th  align="left">Open Date </th>
                  <td><input type="text"  onChange="validatedate_format(this)"  name="open_date" class="datepick" size="8" id="open_date" value="<?php echo $disp_open_date ?>" /></td>
                  <th  align="left"> Status </th>
                  <td>
                    <select  name="status" id="status">

                        <?php

                              foreach($status_arr as $v)
                              {
                                $selected="";
                                if($v==$status_selected){
                                  $selected="selected";
                                }
                                echo "<option $selected value='".$v."' >".$v."</option>";
                              }
                          ?>
                    </select>
		              </td>  
                </tr>

                <tr>
                <td colspan='4'>
                <input  type="button" class="form-button" onclick="report_submit()" name="my_btn" value="Go" />
                </td></tr>    
         
                  <?php

                  if($notes_part_two=="OK"){

                  ?>
                <tr>
                <th align="left">Buyer Name</th>
			
      <td>
          <select   name="buyer_code" id="buyer_code">
              <option value="">All</option>
              <?php

                $buyer_condition="";
                if($buyer_group_code!=""){
                    $query_buyer =" and group_id='".$buyer_group_code."' ";
                }

                  $s_sql="SELECT * FROM txt_company WHERE Firm_type='Buyer' AND delete_tag='FALSE' ".$query_buyer." order by firm_name ASC";
                  echo $s_sql;
                  $s_result=mysqli_query($con,$s_sql);
                  while($s_rs=mysqli_fetch_array($s_result))
                  {
                    $selected="";
                    if($buyer_group_code==$s_rs['company_id'])
                    {
                      $selected="selected";
                    }
                    echo "<option $selected value='".$s_rs['company_id']."'>".$s_rs['firm_name']."</option>";
                  }
                ?>
          </select>
          <input type='hidden' name='buyer_group_code_h' id='buyer_group_code_h'  value='<?php echo $buyer_group_code ?>' />
      </td>                  
                  <th  align="left"> Supplier Name </th>
                  <td>
                    <select  name="supplier_code" id="supplier_code">
                        <option value="">All</option>
                        <?php

                            $query_supplier="";
                            if($supplier_group_code!=""){
                                $query_supplier =" and group_id='".$supplier_group_code."' ";
                            }

                            $s_sql="SELECT * FROM txt_company WHERE Firm_type='Supplier' AND delete_tag='FALSE' ".$query_supplier." order by firm_name ASC";
                            echo $s_sql;
                            $s_result=mysqli_query($con,$s_sql);
                            while($s_rs=mysqli_fetch_array($s_result))
                            {
                              $selected="";
                              if($supplier_group_code==$s_rs['company_id'])
                              {
                                $selected="selected";
                              }
                              echo "<option $selected value='".$s_rs['company_id']."'>".$s_rs['firm_name']."</option>";
                            }
                          ?>
                    </select>
                    <input type='hidden' name='supplier_group_code_h' id='supplier_group_code_h'  value='<?php echo $supplier_group_code ?>' />
		              </td>


                </tr>
                <tr>            
                  <th align="left" >Reminder For</th>      
                  <td >
                    <input type="text" name='reminder_for' id='reminder_for' placeholder='Name of Person' />
                  </td>
                  <th align="left" >Reference Bill No</th>      
                  <td >
                    <input type="text" name='ref_bill_number' id='ref_bill_number' placeholder='Bill Number Refence' />
                  </td>                  
              
                </tr>


                <tr>
                  <td colspan='4'>&nbsp;</td>
                </tr>

                <tr>            
                  <th align="left" >Notes</th>      
                  <td colspan='3'>
                    <textarea name='notes_data' id='notes_data' rows='5' cols='50' maxlength='250' placeholder="Please write notes up to 250 Characters" ></textarea>
                  </td>
              
                </tr>

              <tr>
                <td colspan='4'>
                <a href="index.php">Cancel</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input  type="button" class="form-button" onclick="notes_save()" name="save" value="Save" />
                </td></tr>
              </table>

              <?php

              }

              ?>
              

              <input type='hidden' name='notes_part_two' id='notes_part_two' value='OK' >
              <br>
              <br>
              </form>
                   
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
<?php 
			$_SESSION['uid']=77; 
			?>
</body>
</html>
<?php 
release_connection($con);
?>


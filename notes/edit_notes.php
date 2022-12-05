<?php include("../includes/check_session.php");
include("../includes/config.php");

?>

<?php 
$con=get_connection();


$sql="select * from txt_company where delete_tag='FALSE' order by company_id ASC";
$result=mysqli_query($con,$sql);


// Creating Company Array with reverse Key Value Pair 
// because array_search function searched value and returns key
// first value Dummy to show the position of details
$company_array=array("Value"=>"Key"); 
while($rs=mysqli_fetch_array($result))
{
  $com_array=array($rs['firm_name']=>$rs['company_id']);
  $company_array=array_merge($company_array,$com_array);
  


}

$result -> free_result();


$sql="select * from txt_group_master  order by group_id ASC";
$result=mysqli_query($con,$sql);


$group_array=array("Value"=>"Key"); 
while($rs=mysqli_fetch_array($result))
{

  $grp_array=array($rs['group_name']=>$rs['group_id']);
  $group_array=array_merge($group_array,$grp_array);

}
$result -> free_result();





?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Notes Edit</title>
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

function check_save(){



notes_data=document.getElementById('notes_data').value;






if(notes_data==""){
  alert ("Notes Can not be Empty");
  document.getElementById('notes_data').focus();
  return false;
}





return true;

}

function notes_save(){
  if(check_save()){
    document.getElementById('notes').action='process_notes.php?action=modify';
    document.getElementById('notes').target="_self";    
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
$notes_main_id=$_REQUEST['notes_main_id'];
//$supplier_group_code=$_REQUEST['supplier_group_code'];
//$buyer_group_code=$_REQUEST['buyer_group_code'];

//$open_date=$_REQUEST['open_date'];
//$open_till=$_REQUEST['open_till'];

//$status_selected=$_REQUEST['status'];

//$notes_part_two=$_REQUEST['notes_part_two'];


$time=time()+19800; // Timestamp is in GMT now converted to IST
$date=date('d_m_Y_H_i_s',$time);

/*
$default_open_date=	date("d-m-Y");
$disp_open_date=$default_open_date;
if($notes_part_two=="OK"){
  $disp_open_date=$open_date;
}
*/


//$status_arr=array('Open');
$status_arr=array('Open','Close','Pending');
//$status_arr=array('Testing','Open','Close','Pending');



$sql_notes ="select * from  notes_main where delete_tag='FALSE'  AND notes_main_id='".$notes_main_id."' ";
$result=mysqli_query($con,$sql_notes);
$rs=mysqli_fetch_array($result);
$buyer_group_code=$rs['buyer_group'];
$supplier_group_code=$rs['supplier_group'];
$buyer_code=$rs['buyer_code'];
$supplier_code=$rs['supplier_code'];

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
                <th align='left'>
                  Notes Id
                </th>
                <?php       echo "<td align='left' colspan='3' >".$rs['notes_main_id']."</td>"; ?>
                <input type='hidden' name='notes_main_id' id='notes_main_id' value='<?php echo $rs['notes_main_id'] ?>'>
              </tr>
                <tr>
                  <th  align="left">Open Date </th>
                  <?php       echo "<td>".rev_convert_date($rs['notes_open_date'])."</td>"; ?>
                  <th  align="left"> Status </th>
                  <?php       //echo "<td>".$rs['status']."</td>"; ?>
                  <td>
                    <select  name="status" id="status">

                        <?php

                              foreach($status_arr as $v)
                              {
                                $selected="";
                                if($v==$rs['status']){
                                  $selected="selected";
                                }
                                echo "<option $selected value='".$v."' >".$v."</option>";
                              }
                          ?>
                    </select>
                  </td>  
                                    
                </tr>
                <tr>
                <th align="left">Buyer Group Name</th>
			
        <?php       echo "<td>".array_search($rs['buyer_group'],$group_array)."</td>"; ?>
                  
                  <th  align="left"> Supplier Group Name </th>
                  <?php       echo "<td>".array_search($rs['supplier_group'],$group_array)."</td>"; ?>

                </tr>
 
         
                  <?php

                  //if($notes_part_two=="OK"){

                  ?>
                <tr>
                <th align="left">Buyer Name</th>
			


      <td>
          <select   name="buyer_code" id="buyer_code">
              <option value="">All</option>
              <?php

                $buyer_condition="";
                if($buyer_group_code!="" && $buyer_group_code!=0 ){
                    $query_buyer =" and group_id='".$buyer_group_code."' ";
                }

                  $s_sql="SELECT * FROM txt_company WHERE Firm_type='Buyer' AND delete_tag='FALSE' ".$query_buyer." order by firm_name ASC";
                  echo $s_sql;
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
                    <select  name="supplier_code" id="supplier_code">
                        <option value="">All</option>
                        <?php

                            $query_supplier ="";
                            if($supplier_group_code!="" && $supplier_group_code!=0 ){
                                $query_supplier =" and group_id='".$supplier_group_code."' ";
                            }

                            $s_sql="SELECT * FROM txt_company WHERE Firm_type='Supplier' AND delete_tag='FALSE' ".$query_supplier." order by firm_name ASC";
                            echo $s_sql;
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
                  <th align="left" >Reminder For</th>      

                  

                  <td >
                    <input type="text" name='reminder_for' id='reminder_for' placeholder='Name of Person' value='<?php  echo $rs['reminder_for']; ?>'' />
                  </td>

                  <th align="left" >Reference Bill No</th>      

                  
              
                  <td >
                    <input type="text" name='ref_bill_number' id='ref_bill_number' placeholder='Bill Number Refence'  value='<?php       echo $rs['ref_bill_number']; ?>'/>
                  </td> 
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
                <?php
                  $sql_notes ="select * from  notes_detail where delete_tag='FALSE'  AND notes_main_id='".$notes_main_id."' ";
                  $result=mysqli_query($con,$sql_notes);

                  while($rs=mysqli_fetch_array($result)) 
                  {
                      echo "<tr>";
                      echo "<th>"; 
                      echo "Notes";
                      echo "<br>";
                      echo "<br>";
                      echo rev_convert_date($rs['notes_date']);
                      echo "</th>";
                      echo "<td colspan='3' >";
                      echo $rs['notes'];                      
                      echo "</td>";

                      echo "</tr>";
                      echo "                <tr>
                      <td>&nbsp;</td>
                    </tr>";


                  }// while($rs=mysqli_fetch_array($result)) 

                ?>


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

              //} //if($notes_part_two=="OK"){

              ?>
              


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
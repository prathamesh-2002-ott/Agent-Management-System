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
<title>Notes </title>
<link rel="icon" type="image/x-icon" href="<?php echo $web_path; ?>images/dt-favicon.ico" />

<link href="<?php echo $web_path; ?>css/style.css" rel="stylesheet" type="text/css" />
  <meta charset="UTF-8" />
	<link type="text/css" href="<?php echo $web_path; ?>jqry/css/ui-lightness/jquery-ui-1.8.2.custom.css" rel="stylesheet" />	
	<script type="text/javascript" src="<?php echo $web_path; ?>jqry/js/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="<?php echo $web_path; ?>jqry/js/jquery-ui-1.8.2.custom.min.js"></script>  
  
	<script type="text/javascript">
		$(function() {
					// Accordion
					$("#accordion").accordion({ header: "h3",
					collapsible: true,
		autoHeight: false,
		navigation: true,
		clearStyle:true
		
							});
		});
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
	/*#table_scroll
	{
		overflow:auto;
		display:block;
	}*/
</style>  
       
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
            <table width="100%"><tr><td><h3>Notes :</h3></td>      <td>                     <?php
									if(isset($_SESSION['msg'])) {
										echo $_SESSION['msg'];
										$_SESSION['msg']='';
									}
									
					
									
									
                ?>
                </td>    
            </tr>
            </table>
            </div>

            </div>                                 
                          </td>
        </tr>
        <tr><td  >            
            <div id="accordion" style="background:none;  width:95%; display:inline-block; padding:20px;">
				   <?php 

						$arr=array('Open','Close','Pending');



					$arr_length=count($arr);
					
					for ($a=0;$a<$arr_length;$a++) {
				?>	
              		<div>
						<h3><a href="#"><?php echo $arr[$a]; ?></a></h3>
            	    	<div style="background:none; color:#000000">
                              

                                
                                
                                
                                 

        <table width="90%" align="center" class="tbl_border">
		<tr>
		<th>S. No.</th>

    <th>Edit</th>
    <th>View</th>		
    <th>Notes ID</th>
		<th>Buyer Group</th>
        <th>Buyer Name</th>
        <th>Supplier Group</th>
        <th>Supplier Name</th>
        <th>Ref Bill No</th>
        <th>Open Date</th>
		<th>Reminder For</th>
    </tr>

    <?php
    $sql="select * from notes_main where delete_tag='FALSE' AND status='".$arr[$a]."' order by notes_main_id ASC";
    $result=mysqli_query($con,$sql);


    //$result=mysqli_query($con,$sql);
    $count=0;
    while($rs=mysqli_fetch_array($result)) 
    {
      $notes_main_id=$rs['notes_main_id'];
      
      echo "<tr>";
      echo "<td>".++$count."</td>";
      echo "<td><a href='edit_notes.php?notes_main_id=$notes_main_id'><img src='../images/noun_project_edit_1.png' height='16' width='16' border='0' title='Edit' /></a></td>";
      echo "<td><a href='view_notes.php?notes_main_id=$notes_main_id'><img src='../images/noun_project_preview_1.png' height='16' width='16' border='0' title='View' /></a></td>";


      echo "<td>".$notes_main_id."</td>";
      echo "<td>".array_search($rs['buyer_group'],$group_array)."</td>";
      echo "<td>".array_search($rs['buyer_code'],$company_array)."</td>";

      echo "<td>".array_search($rs['supplier_group'],$group_array)."</td>";
      echo "<td>".array_search($rs['supplier_code'],$company_array)."</td>";      
      echo "<td>".$rs['ref_bill_number']."</td>";
      echo "<td>".$rs['notes_open_date']."</td>";
 
      echo "<td>".$rs['reminder_for']."</td>";
	
      echo "</tr>";
  
              
      }    
    ?>


        </table>
    </div>
    </div>

 <?php } ?>
 </div>
 <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <!--DWLayoutTable-->
                <tr>
                  <td width="518" height="138" valign="top">
                            
                  
                  
                  
                   </td>
                  </tr>
              </table> 
              </div>
        </td></tr>
    </table>
    </td>
  </tr>

 <?php include("../includes/footer.php"); ?>
  
</table>
<?php $_SESSION['uid']=77; ?>
</body>
</html>
<?php 
release_connection($con);
?>

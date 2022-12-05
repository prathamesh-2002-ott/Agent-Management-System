<?php 
include("../includes/check_session.php"); 
include("../includes/config.php"); 
include("../includes/settings.php"); 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Company</title>
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


<?php
$con=get_connection();

$sql="select * from txt_group_master  order by group_id ASC";
$result=mysqli_query($con,$sql);

$rowcount=0;

while($rs=mysqli_fetch_array($result))
{
  $groupRow[$rowcount][0]=$rs['group_id'];
  $groupRow[$rowcount][1]=$rs['group_name']."-".$rs['group_type'];

  
/*
  echo $companyRow[$rowcount][0];
  echo $companyRow[$rowcount][1];
*/
  $rowcount++;

}

$result -> free_result();


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

$result -> free_result();

?>
</head>

<body>
<table width="100%" border="0" align="center" style="border:1px solid #e5f1f8;background-color:#FFFFFF">
<tr>
    <td><?php include("../includes/header.php"); ?></td>
  </tr>
  <tr>
    <td><?php include("../includes/menu.php"); ?></td>
  </tr>
  <tr>
    <td height="326" valign="top"><table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td valign="top">
                          <div class="content_padding">
                              <?php
			  		if(isset($_SESSION['msg'])) {
						echo $_SESSION['msg'];
						$_SESSION['msg']='';
					}	
			  ?>
                             <div  class="content-header">
         
            <table width="100%">
            <tr><td><h3>Company :</h3></td>
            <td align="right"><button onClick="location.href='add_company.php'">Add Company</button></td>
              </tr>
              </table>
              </div>

               <div id="accordion" style="background:none;  width:95%; display:inline-block; padding:20px;">
				   <?php 
					if($_SESSION['ROLEID']=='admin'){
						$arr=array('Supplier','Buyer','Transport','Agent','Other');
					}else{
						$arr=array('Supplier','Buyer','Transport','Other');
					}


					$arr_length=count($arr);
					
					for ($a=0;$a<$arr_length;$a++) {
				?>	
              		<div>
						<h3><a href="#"><?php echo $arr[$a]; ?></a></h3>
            	    	<div style="background:none; color:#000000">
        	        		
<table class="tbl_border">
		<tr>
		<th>S. No.</th>
		<th>Edit</th>
		<th>View</th>		
		<th>Company <BR> ID</th>
        <th>Firm Name</th>
        <th>City</th>
		<?php if (($arr[$a]=="Agent")){?>
			<th>PAN</th>
			<?php }else{?>
        <th>GSTIN</th>
			<?php } ?>
        <th>Contact Person</th>
		<th>Contact Number</th>
	
	<?php if (($arr[$a]=="Supplier") && (($_SESSION['ROLEID']=='admin' || $_SESSION['ROLEID']=='master' ) ) ){ ?>
		<th>Agent </th>
		<th>Commission </th>
	<?php }else{ ?>
        <th>SMS Number</th>
        <th>Whatsaap Number</th>
	<?php } ?>
		
       	<th>Group Name</th>
       <!-- <th>Firm Type</th> -->
       <!--  <th>Delete</th> -->
   				</tr>
                
	<?php
	
	//and group_id='5'
	//$sql="select * from txt_company where firm_type='".$arr[$a]."' AND delete_tag='FALSE'  order by group_id ";
	$sql="select * from txt_company where firm_type='".$arr[$a]."' AND delete_tag='FALSE'  order by firm_name ";

	//$sql="select * from txt_company AS COM, txt_group_master AS GRP  where COM.group_id=GRP.group_id, COM.firm_type='".$arr[$a]."' AND COM.delete_tag='FALSE'  order by COM.firm_name ";
	//group_id
	//echo $sql;
	$result=mysqli_query($con,$sql);
	$count=0;
	while($rs=mysqli_fetch_array($result)) 
	{
		$company_id=$rs['company_id'];
		$firm_name=$rs['firm_name'];
		echo "<tr>";
		echo "<td>".++$count."</td>";
		echo "<td><a href='edit_company.php?company_id=$company_id'><img src='../images/noun_project_edit_1.png' height='16' width='16' border='0' title='Edit' /></a></td>";
		echo "<td><a href='view_company.php?company_id=$company_id'><img src='../images/noun_project_preview_1.png' height='16' width='16' border='0' title='View' /></a></td>";
		echo "<td>".$rs['company_id']."</td>";
		echo "<td>".$rs['firm_name']."</td>";
		echo "<td>".$rs['city']."</td>";
		if($arr[$a]=="Agent"){
			echo "<td>".$rs['pan_number']."</td>";
		}else{
			echo "<td>".$rs['gstin']."</td>";
		}
		echo "<td>".$rs['contact_person']."</td>";
		echo "<td>".$rs['contact_number']."</td>";
		//array_search($rs['transport_name'],$company_array)
	
		if (($arr[$a]=="Supplier") && (($_SESSION['ROLEID']=='admin' || $_SESSION['ROLEID']=='master' ) ) ){
	
			echo "<td>".array_search($rs['agent_id'],$company_array)."</td>";
			echo "<td>".$rs['commission_percentage']."</td>";
		}else {
			echo "<td>".$rs['sms_number']."</td>";
			echo "<td>".$rs['whatsapp_number']."</td>";
		}
	
		$grp_name="Not Found";
		for($b=0;$b<sizeof($groupRow);$b++){
			if($rs['group_id']==$groupRow[$b][0]){
			  $grp_name=$groupRow[$b][1];
			}
		}
		echo "<td>".$grp_name."</td>";
	//	echo "<td>".$rs['firm_type']."</td>";		
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
              
                           
              </td>
                        </tr>
                    </table></td>
  </tr>
  <?php include("../includes/footer.php"); ?>
  
</table>
</body>
</html>
<?php 
release_connection($con);
?>
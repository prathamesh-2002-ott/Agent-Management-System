<?php include("../includes/check_session.php");
include("../includes/config.php");
$con=get_connection(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Company</title>
<link rel="icon" type="image/x-icon" href="<?php echo $web_path; ?>images/dt-favicon.ico" />
<link href="<?php echo $web_path; ?>css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function confirm_delete($com_id,$com_name) {
	if(confirm("Are you sure to delete Company '"+$com_name+"' Id -"+$com_id ))	{
		return true;
	}
	else 	{
		return false;
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
	/*#table_scroll
	{
		overflow:auto;
		display:block;
	}*/
</style>
</head>
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

$result -> free_result();

?>
<body>

<table width="100%" border="0" align="center" style="border:1px solid #e5f1f8;background-color:#FFFFFF">
<tr>
    <td><?php include("../includes/header.php"); ?></td>
  </tr>
  <tr>
    <td><?php include("../includes/menu.php"); ?></td>
  </tr>
  <tr>
    <td height="326" valign="top"><table width="100%" style="margin-top:0px" align="center" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td valign="top">
                            <div class="content_padding">
                            <div class="content-header">
                          
            <table width="100%" border='0'><tr><td><h3>Company :</h3></td>
             <td align="center" width="135">
                    <?php
									if(isset($_SESSION['msg'])) {
										echo $_SESSION['msg'];
										$_SESSION['msg']='';
									}
								?></td>
            	<td align="right"><button onClick="location.href='add_company.php'">Add Company</button></td>
            </tr>
            </table>
            </div>
					


			

    <table cellpadding="0" cellspacing="0" width='100%' border="0">
	

	<?php
	$arr=array('Supplier','Buyer','Transport','Agent','Other');
	$arr_length=count($arr);
	
	for ($a=0;$a<$arr_length;$a++)
	{ ?>

	<tr>
	<td>
	<?php
		echo "<BR>";
		echo "<h3>".$arr[$a].":</h3>";
	?>
	</td>	
	</tr>
	<tr>
				 
    <td  valign="top" >		 
	<table  width='100%' class="tbl_border">   <!--id="table_scroll" height="410" width="1300"-->
	<tr>
    	<th>S. No.</th>
		<th>Edit</th>
		<th>View</th>		
		<th>Company <BR> ID</th>
        <th>Firm Name</th>
        <th>City</th>
        <th>GSTIN</th>
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
        <th>Firm Type</th>
       <!--  <th>Delete</th> -->
    </tr>
    
<?php



$sql="select * from txt_company where firm_type='".$arr[$a]."' AND delete_tag='FALSE' order by firm_name ";
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
	echo "<td>".$rs['gstin']."</td>";
	echo "<td>".$rs['contact_person']."</td>";
	echo "<td>".$rs['contact_number']."</td>";
	//array_search($rs['transport_name'],$company_array)

	if (($arr[$a]=="Supplier") && (($_SESSION['ROLEID']=='admin' || $_SESSION['ROLEID']=='master' ) ) ){

		echo "<td>".array_search($rs['agent_id'],$company_array)."</td>";
		echo "<td>".$rs['commission_percentage']."</td>";
	}else{
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
	echo "<td>".$rs['firm_type']."</td>";
/*
	if($rs['visiting_card']!="")
	{
		echo "<td><a href='$web_path/company/upload/$rs[visiting_card]'>Visiting Card</td>";
	}
	else
	{
		echo "<td></td>";
	}*/
	/*
	if($rs['photo_1']!="")
	{
		echo "<td><a href='$web_path/company/upload/$rs[photo_1]'>Photo-1</a></td>";
	}
	else
	{
		echo "<td></td>";
	}
	*/
	/*
	if($rs['photo_2']!="")
	{
		echo "<td><a href='$web_path/company/upload/$rs[photo_2]'>Photo-2</a></td>";
	}
	else
	{
		echo "<td></td>";
	}
	*/
	//echo "<td><a href='process_company.php?action=delete&company_id=$company_id' onclick='return confirm_delete($company_id,\"$firm_name\");'>Delete</a></td>";
	echo "</tr>";
}
?>



</table>

<?php
}
?>
</td></tr></table><?php $_SESSION['uid']=77; ?>
                  </div>
                  </td></tr></table>
                  </td></tr>
                  <tr>
                  	<td><?php include("../includes/footer.php"); ?></td>
                  </tr>
                  </table>
</body>
</html>                  
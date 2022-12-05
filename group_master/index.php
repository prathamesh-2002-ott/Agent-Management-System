<?php include("../includes/check_session.php");
include("../includes/config.php");
include("../includes/settings.php");  ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Group Master</title>
<link rel="icon" type="image/x-icon" href="<?php echo $web_path; ?>images/dt-favicon.ico" />
<link href="<?php echo $web_path; ?>css/style.css" rel="stylesheet" type="text/css" />
<meta charset="UTF-8" />


<link type="text/css" href="<?php echo $web_path; ?>jqry/css/ui-lightness/jquery-ui-1.8.2.custom.css" rel="stylesheet" />	
	<script type="text/javascript" src="<?php echo $web_path; ?>jqry/js/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="<?php echo $web_path; ?>jqry/js/jquery-ui-1.8.2.custom.min.js"></script>
<script type="text/javascript">

</script>
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
    <td height="326" valign="top"><table width="100%" style="margin-top:0px" align="center" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td valign="top">
                            <div class="content_padding">
                            <div class="content-header">
                          
            <table width="100%"><tr><td><h3>Group Master :</h3></td>
             <td align="center" width="135">
                    <?php
									if(isset($_SESSION['msg'])) {
										echo $_SESSION['msg'];
										$_SESSION['msg']='';
									}
								?></td>
            	<td align="right"><button onClick="location.href='add_group.php'">Add Group</button></td>
            </tr>
            </table>
            </div>
			<div id="accordion" style="background:none;  width:95%; display:inline-block; padding:20px;">
				   <?php 
					if($_SESSION['ROLEID']=='admin'){
						$arr=array('Buyer','Supplier','Transport','Agent','Other');
					}else{
						$arr=array('Supplier','Buyer','Transport','Other');
					}


					$arr_length=count($arr);
					
					for ($a=0;$a<$arr_length;$a++) {
				?>	
              		<div>
						<h3><a href="#"><?php echo $arr[$a]; ?></a></h3>
            	    	<div style="background:none; color:#000000">
        	   
              
<table  class="tbl_border">   <!--id="table_scroll" height="410" width="1300"-->
	<tr>
    	<th>S. No.</th>
		<th>Group Id</th>
		<th>Edit</th>
		<!-- <th>Group Type</th> -->
        <th>Group Name</th>
        <th>Group Description </th>
<!--        <th>Delete</th> -->
    </tr>
    
<?php
$con=get_connection();
$sql="select * from txt_group_master where group_type='".$arr[$a]."' order by group_type, group_name";
$result=mysqli_query($con,$sql);
$count=0;
while($rs=mysqli_fetch_array($result))
{
	$group_id=$rs[0];
	echo "<tr>";
	echo "<td>".++$count."</td>";
	echo "<td>".$group_id."</td>";
	
	echo "<td>";
	//echo "<a href='edit_group.php?group_id=$group_id'>Edit</a>";
	echo "<a href='edit_group.php?group_id=$group_id'><img src='../images/noun_project_edit_1.png' height='16' width='16' border='0' title='Edit' /></a>";
	echo "</td>";

	//echo "<td>".$rs['group_type']."</td>";
	echo "<td>".$rs['group_name']."</td>";
	echo "<td>".$rs['group_desc']."</td>";
//	echo "<td><a href='process_group.php?action=delete&group_id=$group_id' onclick='return confirm_delete();'>Delete</a></td>";
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
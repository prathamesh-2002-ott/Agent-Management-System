<?php 
include("../../includes/check_session_admin.php"); 
include("../../includes/config.php"); 
include("../../includes/settings.php"); 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>User</title>
<link rel="icon" type="image/x-icon" href="<?php echo $web_path; ?>images/dt-favicon.ico" />
<link href="<?php echo $web_path; ?>css/style.css" rel="stylesheet" type="text/css" />
<meta charset="UTF-8" />

	<link type="text/css" href="<?php echo $web_path; ?>jqry/css/ui-lightness/jquery-ui-1.8.2.custom.css" rel="stylesheet" />	
	<script type="text/javascript" src="<?php echo $web_path; ?>jqry/js/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="<?php echo $web_path; ?>jqry/js/jquery-ui-1.8.2.custom.min.js"></script>

	<script type="text/javascript">
	$(function() {
				// Accordion
				$("#accordion33").accordion({ header: "h3",
				collapsible: true,
    autoHeight: false,
    navigation: true 
    					});
	});
	</script>

<script type="text/javascript">
	function confirmDelete() {
		if(confirm("Are you sure to delete ")) {
			return true;
		} else {
			return false;
		}		
	}
</script>	

</head>

<body>
<table width="1000" border="0" align="center" style="border:1px solid #e5f1f8;background-color:#FFFFFF">
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
            <tr><td><h3>Users :</h3></td>
              <td align="right"><button onclick="location.href='add_user.php'">Add User</button></td>
              </tr>
              </table>
              </div>

              
        	        		
                            	<table class="tbl_border">
                                	 <tr>
    <th>S.no.</th>
    <th>Login Name/Code</th>
    <th>Login Password</th>
    <th>Login Type</th>
    <th>User Name</th>
    <th>Email</th>
    <th>Edit</th>
   <th>Delete</th>
   				</tr>
                
                <?php $sql="select * from login";
					  $result=mysql_query($sql);
					  	$count=0;
while($rs=mysql_fetch_array($result)) {
	?>

  <tr>
    <td><?php echo ++$count; ?></td>
    <td><?php echo $rs['login_name']; ?></td>
    <td><?php echo $rs['login_password']; ?></td>
    <td><?php echo $rs['login_type']; ?></td>
    <td><?php echo $rs['user_name']; ?></td>
    <td><?php echo $rs['email']; ?></td>
    <!--<td><?php if($rs['active']==0) {
				echo "<img src='".$web_path."images/success_msg_icon.gif' alt='Yes' title='Yes'>";
			} else {	
			echo "<img src='".$web_path."images/error_msg_icon.gif' alt='No' title='No'>"; 
            } ?>            </td>-->
    <td><a href="edit_user.php?login_id=<?php echo $rs[0]; ?>"><img src="<?php echo $web_path; ?>images/icoedit.png" border="0" title="Edit" /></a></td>
    <td><a href="process_user.php?action=delete&login_id=<?php echo $rs[0]; ?>"   onclick="return confirmDelete();"><img src="<?php echo $web_path; ?>images/icodelete.png" border="0" title="Delete" /></a></td>
  </tr>
  <?php
	          
		}
		
	?>
                
                
                                
                                </table>
                            
                            

              </div>
               <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <!--DWLayoutTable-->
                <tr>
                  <td width="518" height="138" valign="top">
                            
                  
                  
                  
                   </td>
                  </tr>
              </table> 
              
              </div>
              
                            </div>
              </td>
                        </tr>
                    </table></td>
  </tr>
  <?php include("../includes/footer.php"); ?>
  
</table>
</body>
</html>

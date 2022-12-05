<?php 
include("../../includes/check_session_admin.php"); 
include("../../includes/config.php"); 
include("../../includes/settings.php"); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add User</title>
\<link rel="icon" type="image/x-icon" href="<?php echo $web_path; ?>images/dt-favicon.ico" />
<link href="<?php echo $web_path; ?>css/style.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
	function check() {
		var login_name=document.getElementById("login_name").value;
		var login_password=document.getElementById("login_password").value;
		var login_type=document.getElementById("login_type").value;
		var user_name=document.getElementById("user_name").value;
		var email=document.getElementById("email").value;
		if(login_name=="") {
			alert("Please Enter Login Name/Code");
			document.getElementById("login_name").focus();
			return false;
		}	
		if(login_password=="") {
			alert("Please Enter Login Password");
			document.getElementById("login_password").focus();
			return false;
		}	
		if(login_type=="") {
			alert("Please Enter Login Type");
			document.getElementById("login_type").focus();
			return false;
		}	
		if(user_name=="") {
			alert("Please Enter User Name");
			document.getElementById("user_name").focus();
			return false;
		}	
		if(email=="") {
			alert("Please Enter Email");
			document.getElementById("email").focus();
			return false;
		}	
		return true;
	}
</script>


</head>

<body>
<table width="100%" border="0" align="center" style="border:1px solid #e5f1f8;background-color:#FFFFFF">
<tr>
    <td><?php include("../../includes/header.php"); ?></td>
  </tr>
  <tr>
    <td><?php include("../../includes/menu.php"); ?></td>
  </tr>
  <tr>
    <td height="326" valign="top"><table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td valign="top">
                            <div class="content_padding">
                            <div class="content-header">
            <table width="100%"><tr><td><h3>Add New User :</h3></td></tr>
            </table>
            </div> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <!--DWLayoutTable-->
                <tr>
                  <td width="518" height="138" valign="top">
                  
                <form action="process_user.php?action=add" method="post" onsubmit="return check()">
                  <table width="474" class="tbl_border">
                  	<tr>
                  	  <th width="180"><div align="left">Login Name/Code*:</div></th>
                  	  <td width="282"><input name="login_name" type="text" size="40" id="login_name" /></td>
                      </tr>
                  	<tr>
                  	  <th><div align="left">Login Password*:</div></th>
                  	  <td><input name="login_password" type="text" size="40" id="login_password" /></td>
                      </tr>

                  	<tr>
                  	  <th><div align="left">Login Type*:</div></th>
                  	  <td>
                      <select name="login_type" id="login_type">
                      	<option value="">--Select Login Type--</option>
                        	<?php 
								asort($user_type_ar);
								foreach($user_type_ar as $key=>$value){
									echo "<option value='$key'>$value</option>";
								}
							
							?>
                        </select>                        </td>
                      </tr>
                  	<tr>
                  	  <th><div align="left">User  Name*</div></th>
                  	  <td><input name="user_name" type="text" size="40" id="user_name" /></td>
                	  </tr>

                      
                      	<tr>
                  	  <th><div align="left">Email*</div></th>
                  	  <td><input name="email" type="text"  size="40" id="email" /></td>
                	  </tr>
                      
                  	</table>
  <br /><br />
              	 		<?php $_SESSION['uid']=77; ?>
                        <input type="submit" value="Save User" />                     
                  </form>
                  
                  
                  
                  
                   </td>
                </tr>
              </table> 
              
              </div>
              
              </td>
                        </tr>
                    </table></td>
  </tr>
  <?php include("../../includes/footer.php"); ?>
  
</table>
</body>
</html>

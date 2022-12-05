<?php 
include("../../includes/check_session_admin.php"); 
include("../../includes/config.php"); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit User</title>
<link rel="icon" type="image/x-icon" href="<?php echo $web_path; ?>images/dt-favicon.ico" />
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
		/*
		if(email=="") {
			alert("Please Enter Email");
			document.getElementById("email").focus();
			return false;
		}	
		*/
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
            <table width="100%"><tr><td><h3>Edit User :</h3></td></tr>
            </table>
			</div> 
			<a href="index.php">Back</a>
			<BR>
			<BR>
			<?php
					$con=get_connection();
					if(isset($_REQUEST['login_id'])) {
							$login_id=$_REQUEST['login_id'];
							$sql="Select * from txt_login where login_id='$login_id'";
							$result=mysqli_query($con,$sql);
							$rs=mysqli_fetch_assoc($result);
							 $rs_main=$rs;
			?>
            
            
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <!--DWLayoutTable-->
                <tr>
                  <td width="518" height="138" valign="top">
                  
                <form action="process_user.php?action=modify" method="post"  onsubmit="return check()">
                  <table width="488" class="tbl_border">
				  <tr>
                  	  <th width="156"><div align="left">Login Id</div></th>
                  	  <td width="320"><?php echo $rs['login_id']; ?></td>
                      </tr>					  
                  	<tr>
                  	  <th width="156"><div align="left">Login Name<span class="astrik">*</span></div></th>
                  	  <td width="320"><input name="login_name" type="text" value="<?php echo $rs['login_name']; ?>" id="login_name" /></td>
                      </tr>
                  	<tr>
                  	  <th><div align="left">Login Password<span class="astrik">*</span></div></th>
                  	  <td><input name="login_password" type="text" id="login_password" size="40" value="<?php echo $rs['login_password']; ?>" /></td>
                      </tr>

                  	<tr>
                  	  <th><div align="left">Login Type<span class="astrik">*</span></div></th>
                  	  <td>
                       <select name="login_type" id="login_type">
                      	<option value="">--Select Login Type--</option>
                        	<?php 
								$selected="";
								foreach($user_type_ar as $key=>$value){
									if($rs['login_type']==$key) {
										$selected="selected";
									} else {
										$selected="";
									}		
									echo "<option value='$key' $selected>$value</option>";
								}
							
							?>
                            
                        </select>   
                        	
                                   </td>
                      </tr>
                  	<tr>
                  	  <th><div align="left">User Name</div></th>
                  	  <td><input name="user_name" id="user_name" type="text" size="40" value="<?php echo $rs['user_name']; ?>" /></td>
                	  </tr>
                      
                      
                  	<tr>
                  	  <th><div align="left">Email</div></th>
                  	  <td><input name="email" type="text" id="email"  size="40" value="<?php echo $rs['email']; ?>" /></td>
                	  </tr>
                      
                      
                      
                      
                  	</table>
      <br /><br />
              	 		<?php $_SESSION['uid']=77; ?>
                        	<input type="hidden" name="login_id" value="<?php echo $login_id; ?>" />
							<a href="index.php">Cancel</a> &nbsp;&nbsp;&nbsp;&nbsp;
							<input type="submit" value="Update User" />                     
                  </form>
                  
                  
                  
                  
                   </td>
                </tr>
              </table> 
              
<?php

}

?>              
              
              </div>
              
              </td>
                        </tr>
                    </table></td>
  </tr>
  <?php include("../../includes/footer.php"); ?>
  
</table>
</body>
</html>
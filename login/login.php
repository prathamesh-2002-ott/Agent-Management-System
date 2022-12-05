<?php include("../includes/config.php"); 
include("../includes/settings.php"); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Agency Management System :  Login</title>
<img src="C:\wamp\www\Htextile\images\agencylogo.jpg" alt="Logo">
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
	function check() {
		var login_name=document.getElementById('login_name').value;
		var login_password=document.getElementById('login_password').value;
		var industry=document.getElementById('industry').value;
		if(login_name=="") {
			alert("Please Enter Login Name");
			document.getElementById("login_name").focus();
			return false;
		}	
		if(login_password=="") {
			alert("Please Enter Password");
			document.getElementById("login_password").focus();
			return false;
		}	
		if(industry=="") {
			alert("Please Select Industry");
			document.getElementById("industry").focus();
			return false;
		}	
		return true;
	}
</script>

<meta name="robots" content="noindex, nofollow">
<meta name="googlebot" content="noindex">
</head>

<body onload="setFocus()">
<table width="1000" border="0" align="center" style="border:1px solid #e5f1f8;background-color:#FFFFFF">
  <tr>
    <td><?php include("../includes/header_login.php"); ?></td>
  </tr>
  <tr>
    <td><?php include("../includes/menu.php"); ?></td>
  </tr>
  <tr>
    <td height="326" valign="top"><table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td valign="top">
							  <?php
								$con=get_connection();						  
							  if($_REQUEST['msg']) {
				  		  $msg=htmlspecialchars($_REQUEST['msg'],ENT_QUOTES);
						  $msg=trim($msg);	
						  $msg=mysqli_real_escape_string($con,$msg);

						  echo "<div class='error-message'>$msg</div>";
						}
						
						  $err=htmlspecialchars($_REQUEST['err'],ENT_QUOTES);
					  	  $err=trim($err);	
						  $err=mysqli_real_escape_string($con,$err);
						
						if($err==1) {
						  $msg="Session Expired";
						  echo "<div class='error-message'>$msg</div>";
						}
						if($err==2) {
						  $msg="Admin Login Required";
						  echo "<div class='error-message'>$msg</div>";
						}
						if($err==501) {
						  $msg="Login Required";
						  echo "<div class='error-message'>$msg</div>";
						}

						if($err==101) {
							echo "<div class='login_working' align='left'><span  style='padding-left:40px;'>You have been Successfully logged out</span></div>";
						}	
						if($err==201) {
						  $msg="Invalid User Name or Password";
						  echo "<div class='error-message'>$msg</div>";
						}
					?>	
                    
                    <div class="login_panel">
					<h1>AGENCY MANAGEMENT SYSTEM</h1>
            </div>
                    
                            <div class="content_padding">
                            
        
                            
      <form method="post" action="chk_login.php" onsubmit="return check()">
                  <table width="670" class="tbl_border">
                  	<tr>
                  	  <th width="188"><div align="left"><strong>Login ID</strong></div></th>
                  	  <td width="470"><input name="login_name" type="text" id="login_name" size="40" tabindex="1" /></td>
                  	<tr>
                  	  <th><div align="left"><strong>Password</strong></div></th>
                  	  <td><input name="login_password" type="password" id="login_password" size="40" tabindex="2" /></td>
                      </tr>
                       <tr>
       <td align="right"><div align="left">Type 3 <strong>black</strong> Characters.* <br><img src="captcha.php" alt="captcha image"> <br />
       </div>
       <a href="javascript:location.reload();">Refresh Image</a>
       </td>
       <td><input type="text" name="captcha" size="3" maxlength="3" tabindex="4"></td>
       </tr>
                	  <tr>
                	    <td><div align="left"></div></td>
              	        <td><input type="submit" name="button" id="button" value="Login" /></td>
           	        <tr>
                    
                     
                    
                  </table>
                  </form>      
					<p>
					  <?php $_SESSION['uid']=77; ?>
					</p>
					<p>&nbsp;</p>
					<p>&nbsp;</p>
					<p>&nbsp;</p>
					<p>&nbsp;</p>
					<p>&nbsp;</p>
                            </div>
                           
                        </td>
                        </tr>
                    </table></td>
  </tr>
  
</table>
</body>
</html>

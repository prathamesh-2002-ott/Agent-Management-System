<?php	require("includes/config.php"); 
session_start();
// check for correct captcha and execute further lines only when captcha are correct
if(isset($_POST["captcha"]))
if($_SESSION["captcha"]==$_POST["captcha"])
{
    //CAPTHCA is valid; proceed the message: save to database, send by e-mail ...
//    echo 'CAPTCHA is valid; proceed the message';
}
else
{
    echo 'Security Characters is not valid; Please fill form again';
	echo "<br>";
	echo "<a href='".$_SERVER['HTTP_REFERER']."'>Back</a>";
	exit();
}
// end of captcha code -- add by aj on 16-8-2014 to prevent auto login -- auto book insert.
session_destroy();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Update Password</title>
<link rel="icon" type="image/x-icon" href="<?php echo $web_path; ?>images/dt-favicon.ico" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
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
                            <td valign="top"><p>
                            <div class="content_padding">
                            
                            <div class="content-header">
            <table width="100%"><tr><td><h3>Change Password :</h3></td></tr>
            </table>
            </div>
            
                <?php if($_REQUEST['msg']) {
				  		echo "<font color=red>".$_REQUEST['msg']."</font><br />";
						}
					
        
                            
                           	$login_name = $_REQUEST['login_name'];
	$login_password_old = $_REQUEST['login_password_old'];
	$login_password_new=$_REQUEST['login_password_new'];
	$login_password_new2=$_REQUEST['login_password_new2'];
	
	$sql="select * from login where login_name ='".$login_name."' and login_password ='".$login_password_old."'" ;
//	echo $sql;
	
	$result = mysql_query ($sql)
		or die ("Invalid query");
    $rs=mysql_fetch_row($result);
	
	if(mysql_num_rows($result)>0)
	{
		$flag = '1' ;  // found
		// if found than update with new password 
		$update_sql="Update login SET login_password='$login_password_new' where login_name='$login_name'";
		$result=mysql_query($update_sql);
?>
    			<div align="center">
				<strong>Password Changed Successfully</strong>
				<br>
				<a href="login.php?msg=<div class=success-message>Password Updated Successfully</div>">Login here</a>
				</div>
<?php
	}
	else
	{
		$flag= '2';  // 2 not found
?>
  			<div align="center">
			<strong>User Name or Password Invalid</strong>
			<br>
			<a href="index.php">Login here</a>
			</div>
<?php		
	}
?>
                  </div>
                           </p>
                        </td>
                        </tr>
                    </table></td>
  </tr>
 <?php include("footer.php"); ?>
  
</table>
</body>
</html>




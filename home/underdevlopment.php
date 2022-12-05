<?php include("../includes/check_session.php"); 
	include("../includes/config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Under Devlopment</title>
<link rel="icon" type="image/x-icon" href="<?php echo $web_path; ?>images/dt-favicon.ico" />
<link href="<?php echo $web_path; ?>css/style.css" rel="stylesheet" type="text/css" />
	<meta charset="UTF-8" />
       
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
            <table width="100%"><tr><td><h3>Under Development :</h3></td>          
            </tr>
            </table>
            </div>
                              
                    <?php
									if(isset($_SESSION['msg'])) {
										echo $_SESSION['msg'];
										$_SESSION['msg']='';
									}
									
									// all the decision pending at ts ends are count as open
									
									
								?>
                                
                                
                                
                                 
</div>                                 
                          </td>
        </tr>
    </table></td>
  </tr>
 <?php include("../includes/footer.php"); ?>
  
</table>
</body>
</html>


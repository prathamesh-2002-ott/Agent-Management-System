<?php include("../includes/check_session.php"); 
	include("../includes/config.php");
?>

<?php
    //create a mysql connection 
    $con=get_connection();
    // Check connection

  $role_id="";
  if(isset($_SESSION['ROLEID'])){
    $role_id=$_SESSION['ROLEID'];
  }

  $menu_id='0';
  if(isset($_REQUEST['menu_id'])){
    $menu_id=$_REQUEST['menu_id'];
  }

  //echo $menu_id;
  $menu_name_sqlquery = " SELECT * FROM menu where status='1' and menu_id='$menu_id' and user_role='$role_id' ";


  $menu_item_sqlquery = " SELECT * FROM menu where status='1' and parent_id='$menu_id' and user_role='$role_id' ";
   //echo $menu_name_sqlquery;
	$res=mysqli_query($con,$menu_name_sqlquery);

    $menu_name = "Home Home";
    //echo "before While";
    while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)) 
	{
       //echo "In While";
        $menu_name=$row['menu_name'];
    }




?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $menu_name; ?></title>
<link rel="icon" type="image/x-icon" href="<?php echo $web_path; ?>images/dt-favicon.ico" />

<link href="<?php echo $web_path; ?>css/style.css" rel="stylesheet" type="text/css" />
	<meta charset="UTF-8" />
<style>
    .buttonLink {
  font: bold 11px Arial;
  text-decoration: none;
  background-color: #FFAC47;
  color: #333333;
  padding: 2px 6px 2px 6px;
  border-top: 1px solid #CCCCCC;
  border-right: 1px solid #333333;
  border-bottom: 1px solid #333333;
  border-left: 1px solid #CCCCCC;
}
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
            <table width="100%"><tr><td><h3>Home :</h3></td>          
            </tr>
            </table>
            </div>
                              
                    <?php

                   // $Message=$_SESSION['msg'];
									if(isset($_SESSION['msg'])) {
										echo $_SESSION['msg'];
										$_SESSION['msg']='';
									}
									
									// all the decision pending at ts ends are count as open
									
									
								?>


            <form method="post" id="navigation" onsubmit="" enctype="multipart/form-data" >              
              <table width='100%' class="tbl_border">     
                  
              <?php
              	$res=mysqli_query($con,$menu_item_sqlquery);

                  //$menu_name = "Home Home";
                  //echo "before While";
                
                  while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)) 
                  {
                     //echo "In While";
                     echo "<TR><TD align='center'><a href='".$web_path.$row['link']."?menu_id=".$row['menu_id']."' class='buttonLink'>";
                      $menu_name=$row['menu_name'];
                      echo $menu_name;

                      echo "</a></TD></TR>";
                      echo "<TR><TD align='center'> &nbsp;";
                      echo "</TD></TR>";
                  }
              

              
              ?>
 
              </table>
              </form> 
                                
                                
                                 
</div>                                 
                          </td>
        </tr>
    </table></td>
  </tr>
 <?php include("../includes/footer.php"); ?>
  
</table>
</body>
</html>


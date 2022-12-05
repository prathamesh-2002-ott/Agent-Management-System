<?php session_start();
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
// end of captcha code -- add by aj on prevent auto login -- auto book insert.
		require("../includes/config.php");
	$con=get_connection();
	$login_name = trim($_REQUEST['login_name']);
	$login_password = trim($_REQUEST['login_password']);

	
	$login_name=mysqli_real_escape_string($con,$login_name);         // updated on 31-07-2014 to prevent sql injection. 
	$login_password=mysqli_real_escape_string($con,$login_password);

	
	$sql="select * from txt_login  where login_name ='".$login_name."' and login_password ='".$login_password."'";
	$con=get_connection();
	$result = mysqli_query ($con,$sql)
		or die ("Invalid query");
    $rs=mysqli_fetch_array($result);
	
	
	// Store the Login ID to the Session.	
	$_SESSION['LOGID']=$rs['login_id'];
	//Store the Role to the Session.
	$_SESSION['ROLEID']=$rs['login_type'];
	// Store the login name to session
	$_SESSION['LOGIN_NAME']=$rs['login_name'];
	
	$_SESSION['USER_NAME']=$rs['user_name'];
	
	if(mysqli_num_rows($result)>0)
	{
		$flag = '1' ;
	}
	else
	{
		$flag= '2';  // 2 not found
	}

	

if($flag=='2') {
	//header("Location: login.php?msg=Invalid User Name or Password");
	echo "<script language='javascript'>";
	echo "location.href='../index.php?err=201'";
	echo "</script>";
}	

if ($flag=='1' && $rs['login_type']=='admin')
{
	echo "<script language='javascript'>";
	echo "location.href='../home/index.php'";
	echo "</script>";
} 

if ($flag=='1' && $rs['login_type']=='user')
{
	echo "<script language='javascript'>";
	echo "location.href='../home/index.php'";
	echo "</script>";
} 
?>
<?php 
release_connection($con);
?>
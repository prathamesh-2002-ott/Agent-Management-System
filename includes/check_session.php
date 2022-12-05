<?php session_start(); 
	include("settings.php");
if(isset($_SESSION["LOGID"]))
{
   // $username=$_SESSION['LOGID'];
	//echo "Welcome ".$username;
}
else
{
	echo "<script type='text/javascript'>";
	echo "location.href='$web_path"."login/login.php'";
	echo "</script>";
    }
?>
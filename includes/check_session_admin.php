<?php 	session_start(); 
include("settings.php"); 
if(isset($_SESSION["LOGID"]))
{
  // $username=$_SESSION['LOGID'];
	//	echo "Welcome 22 ".$username;
}
else
{
	echo "<script type='text/javascript'>";
	echo "location.href='$web_path"."login/login.php?err=1'";
	echo "</script>";
  }
if($_SESSION['ROLEID']=='admin' || $_SESSION['ROLEID']=='master' ) {
	// Left Blank as per logic
} else {
	echo 	"<script type='text/javascript'>";
	echo    "location.href='$web_path"."login/login.php?err=2'";
	echo    "</script>";
}	
?>
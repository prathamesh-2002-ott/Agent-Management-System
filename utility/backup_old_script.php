<?php include("../includes/check_session.php"); 
include("../includes/config.php"); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Backup </title>
<link rel="icon" type="image/x-icon" href="<?php echo $web_path; ?>images/dt-favicon.ico" />
<link href="<?php echo $web_path; ?>css/style.css" rel="stylesheet" type="text/css" />

</head>

<body>
<table width="100%" border="0" align="center" style="border:1px solid #e5f1f8;background-color:#FFFFFF">
<tr>
    <td><?php include("../includes/header.php"); ?></td>
  </tr>
  <tr>
    <td><?php include("../includes/menu.php"); ?></td>
  </tr>
</table>
<table width="100%">
  <tr><td style="font-size: 12px;color: #ffffff;background-color:#ffffff" align='center' width="100%">
<?php 
echo "<BR>";
echo "<BR>";
$command = "c:\AgencyMgmt\Task\backup.bat";
$backup_loc="c:\AgencyMgmt\backup";

$system_out=system($command,$ret_val) ;
echo $ret_val;
?>
</td>
</tr>
<tr><td style="background-color:#ffffff" align='center' width="100%">
<?php 
echo "<BR>";
echo "Data has been Backed up and saved @ $backup_loc With Current Date and Time ";
echo "<BR>";
?>
</td>
</tr>
<tr> <td style="background-color:#ffffff"> 
<BR>
</td>
</tr>
<tr> <td style="background-color:#ffffff">
<BR>
</td>
</tr>
<tr> <td style="background-color:#ffffff">
<BR>
</td>
</tr>
<tr> <td style="background-color:#ffffff">
<BR>
</td>
</tr>
<tr> <td>

<?php include("../includes/footer.php"); ?></td>
                  </tr>
</table>
</body>
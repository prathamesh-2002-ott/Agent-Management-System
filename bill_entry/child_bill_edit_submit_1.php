<?php include("../includes/check_session.php"); 
include("../includes/config.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit Bill Entry </title>
<link href="<?php echo $web_path; ?>css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    function closeWindow(){
        window.opener.report_submit();
        window.close();
    }
</script>
<style>
*
{
	margin:0;
	padding:0;
}

table,th,td
{
	border-collapse:collapse;
}
</style>
</head>

<body>


<table align="center" width='100%'>
    <tr>
    <td align="center" >
                    <?php
									if(isset($_SESSION['msg'])) {
                    echo $_SESSION['msg'];
                    $_SESSION['msg']='';
									}
								?></td>
    </tr>
    <tr>
        <td>
            <BR>
        </td>
    </tr>
    <tr>
        <td align='center'>
        <button onclick="closeWindow()">Close Window</button>
        </td>
    </tr>
</table>
</body>
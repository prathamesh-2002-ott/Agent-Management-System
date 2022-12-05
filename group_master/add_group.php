<?php include("../includes/check_session.php"); 
include("../includes/config.php");
$con=get_connection();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add Group</title>
<link rel="icon" type="image/x-icon" href="<?php echo $web_path; ?>images/dt-favicon.ico" />
<link href="<?php echo $web_path; ?>css/style.css" rel="stylesheet" type="text/css" />
<style>
*
{
	margin:0;
	padding:0;
}
</style>
<script type="text/javascript">
function check()
{
	var group_name=document.getElementById("group_name").value;
	if(group_name=="") {
		alert("Please Enter Group Name");
		document.getElementById("group_name").focus();
		return false;
	}
	
	return true;
}


function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    //if (charCode > 31 && (charCode < 48 || charCode > 57))
	if (charCode > 31 && (charCode != 46 &&(charCode < 48 || charCode > 57)))
        return false;
    return true;
}

function isSpaceKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    //if (charCode > 31 && (charCode < 48 || charCode > 57))
	if (charCode == 32)
        return false;
    return true;
}

function checkLength(len,ele){
  var fieldLength = ele.value.length;
  if(fieldLength <= len){
    return true;
  }
  else
  {
    var str = ele.value;
    str = str.substring(0, str.length - 1);
    ele.value = str;
  }
}


function isUpperCase(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    //if (charCode > 31 && (charCode < 48 || charCode > 57))
	if (charCode >= 65 && charCode <=90)
        return true;
    return false;
}

function ChangeCase(elem)  {
        elem.value = elem.value.toUpperCase();
}



function final_submit() {
			//alert("in final submit mode");
				if(check()) {
					document.getElementById('form-id').action='process_group.php?action=add';
					document.getElementById('form-id').submit();
				}
} // end of function final_submit
</script>


<table width="100%" border="0" align="center" style="border:1px solid #e5f1f8;background-color:#FFFFFF">
<tr>
    <td><?php include("../includes/header.php"); ?></td>
  </tr>
  <tr>
    <td><?php include("../includes/menu.php"); ?></td>
  </tr>
  <tr>
    <td height="326" valign="top"><table width="100%" style="margin-top:0px" align="center" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td valign="top">
                            <div class="content_padding">
                            <div class="content-header">
                            <a href="index.php">Back</a>
            <table width="100%"><tr><td><h3>Add Group :</h3></td>
            	<td align="right"></td>
            </tr>
            </table>
            </div>
    
    <table cellpadding="0" cellspacing="0" border="0">
            <tr>
             <td width="818" height="138" valign="top">
    <form method="post" id="form-id">
    
    <table width="764" class="tbl_border">	
    <tr>
    	<th align="left">Group Type</th>
        <td>
        	<select name="group_type" id="group_type">
        		
                <?php
				$arr=array('Other','Buyer','Supplier','Transport','Agent');
				foreach($arr as $v)
				{
					echo "<option>".$v."</option>";
				}
				?>
        	</select>
        </td>
    </tr>
    <tr>
    	<th width="226" align="left">Group Name <span class="astrik">*</span></th>
        <td width="526"><input name="group_name" type="text" id="group_name" size="60"></td>
    </tr>
    <tr>
    	<th align="left">Group Description </th>
        <td><input type="text" name="group_desc" id="group_desc" size="60"></td>
    </tr>
    </table>
     <br /><br />
				    <table width="324">
                	    <tr>
                    	    <td width="116">
                            <a href="index.php">Cancel</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                       		<input  type="button" class="form-button" onclick="final_submit()" name="my_btn" value="Save" />
                 			</td>
						</tr>
					</table>
                    </form>
                  </td></tr></table><?php $_SESSION['uid']=77; ?>
                  </div>
                  </td></tr></table>
                  </td></tr>
                  <tr>
                  	<td> <?php include("../includes/footer.php"); ?></td>
                  </tr>
                  </table>
</body>
</html>
<?php 
release_connection($con);
?>
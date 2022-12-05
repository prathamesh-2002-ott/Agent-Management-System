<?php include("../includes/check_session.php"); 
include("../includes/config.php");
$con=get_connection();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add Company</title>
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
	var firm_name=document.getElementById("firm_name").value;
	if(firm_name=="") {
		alert("Please Enter Firm Name");
		document.getElementById("firm_name").focus();
		return false;
	}
	
	var address=document.getElementById("address").value;
	if(address=="") {
		alert("Please Enter address");
		document.getElementById("address").focus();
		return false;
	}
	
	var city=document.getElementById("city").value;
	if(city=="") {
		alert("Please Enter city");
		document.getElementById("city").focus();
		return false;
	}
	
	var state=document.getElementById("state").value;
	if(state=="") {
		alert("Please Enter state");
		document.getElementById("state").focus();
		return false;
	}
	
	var pincode=document.getElementById("pincode").value;
	if(pincode=="") {
		alert("Please Enter pincode");
		document.getElementById("pincode").focus();
		return false;
	}
	
	var gstin=document.getElementById("gstin").value;
	if(gstin=="") {
		alert("Please Enter GSTIN");
		document.getElementById("gstin").focus();
		return false;
	}
	
/*	var contact_person=document.getElementById("contact_person").value;
	if(contact_person=="") {
		alert("Please Enter Contact Person");
		document.getElementById("contact_person").focus();
		return false;
	}
	
	var contact_number=document.getElementById("contact_number").value;
	if(contact_number=="") {
		alert("Please Enter Contact Number");
		document.getElementById("contact_number").focus();
		return false;
	}
	
	var sms_number=document.getElementById("sms_number").value;
	if(sms_number=="") {
		alert("Please Enter SMS Number");
		document.getElementById("sms_number").focus();
		return false;
	}
	
	var whatsapp_number=document.getElementById("whatsapp_number").value;
	if(whatsapp_number=="") {
		alert("Please Enter Whatsapp Number");
		document.getElementById("whatsapp_number").focus();
		return false;
	}
	
	var email=document.getElementById("email").value;
	if(email=="") {
		alert("Please Enter email");
		document.getElementById("email").focus();
		return false;
	}
	
	var email=document.getElementById('email');
	var filter = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

        if (filter.test(email.value) == false) 
        {
            alert('Invalid Email Address');
            return false;
        }
	
	var website=document.getElementById("website").value;
	if(website=="") {
		alert("Please Enter website");
		document.getElementById("website").focus();
		return false;
	}
	
	var group_type=document.getElementById("group_type").value;
	if(group_type=="") {
		alert("Please Enter Group Type");
		document.getElementById("group_type").focus();
		return false;
	}
	
	var commission_percentage=document.getElementById("commission_percentage").value;
	if(commission_percentage=="") {
		alert("Please Enter Commission Percentage");
		document.getElementById("commission_percentage").focus();
		return false;
	}
	
	var firm_type=document.getElementById("firm_type").value;
	if(firm_type=="") {
		alert("Please Enter Firm Type");
		document.getElementById("firm_type").focus();
		return false;
	}
	
	var reference=document.getElementById("reference").value;
	if(reference=="") {
		alert("Please Enter reference");
		document.getElementById("reference").focus();
		return false;
	}
	
	var remarks=document.getElementById("remarks").value;
	if(remarks=="") {
		alert("Please Enter remarks");
		document.getElementById("remarks").focus();
		return false;
	}
	
	var pan_number=document.getElementById("pan_number").value;
	if(pan_number=="") {
		alert("Please Enter PAN Number");
		document.getElementById("pan_number").focus();
		return false;
	}
	
	var visiting_card=document.getElementById("visiting_card").value;
	if(visiting_card=="") {
		alert("Please Enter Visiting Card");
		document.getElementById("visiting_card").focus();
		return false;
	}
	
	var photo_1=document.getElementById('photo_1').value;
	if(photo_1=="") {
		alert("Please Enter photo_1");
		document.getElementById("photo_1").focus();
		return false;
	}
	
	var photo_2=document.getElementById("photo_2").value;
	if(photo_2=="") {
		alert("Please Enter photo_2");
		document.getElementById("photo_2").focus();
		return false;
	}
*/	
	
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
					document.getElementById('form-id').action='process_company.php?action=add';
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
            <table width="100%"><tr><td><h3>Add Company :</h3></td>
            	<td align="right"></td>
            </tr>
            </table>
            </div>
    
    <table cellpadding="0" cellspacing="0" border="0">
            <tr>
             <td width="818" height="138" valign="top">
    <form method="post" id="form-id" enctype="multipart/form-data" >
    
    <table width="764" class="tbl_border">	
    <tr>
    	<th width="226" align="left">Firm Name <span class="astrik">*</span></th>
        <td width="526"><input name="firm_name" type="text" id="firm_name" size="60"></td>
    </tr>
    <tr>
    	<th align="left">Address <span class="astrik">*</span></th>
        <td><input type="text" name="address" id="address" size="60"></td>
    </tr>
    <tr>
    	<th align="left">City <span class="astrik">*</span></th>
        <td><input type="text" name="city" id="city"></td>
    </tr>
    <tr>
    	<th align="left">State <span class="astrik">*</span></th>
        <td>
        	<select name="state" id="state">
            	<option value="">--Select--</option>
                <?php
					$s_sql="select id,state from txt_states";
					$s_result=mysqli_query($con,$s_sql);
					while($s_rs=mysqli_fetch_array($s_result))
					{
						echo "<option>".$s_rs['state']."</option>";
					}
				?>
            </select>
        </td>
    </tr>
    <tr>
    	<th align="left">Pincode <span class="astrik">*</span></th>
        <td><input type="text" name="pincode" id="pincode" size="5" onkeypress="return isNumberKey(event)" onInput="checkLength(6,this)" ></td>
    </tr>
    <tr>
    	<th align="left">GSTIN <span class="astrik">*</span></th>
        <td><input type="text" name="gstin" id="gstin" size="20"></td>
	</tr>
	<tr>
    	<th align="left">Office Number</th>
        <td><input type="text" name="office_phone" id="office_phone" size="10"  onkeypress="return isNumberKey(event)" onInput="checkLength(10,this)" ></td>
    </tr>	
    <tr>
    	<th align="left">Contact Person</th>
        <td><input name="contact_person" type="text" id="contact_person" size="40"></td>
    </tr>
    <tr>
    	<th align="left">Contact Number</th>
        <td><input type="text" name="contact_number" id="contact_number" size="10" onkeypress="return isNumberKey(event)" onInput="checkLength(10,this)" ></td>
	</tr>
    <tr>
    	<th align="left">Contact Person</th>
        <td><input name="contact_person_2" type="text" id="contact_person_2" size="40"></td>
    </tr>
    <tr>
    	<th align="left">Contact Number</th>
        <td><input type="text" name="contact_number_2" id="contact_number_2" size="10" onkeypress="return isNumberKey(event)" onInput="checkLength(10,this)" ></td>
    </tr>	
    <tr>
    	<th align="left">SMS Number</th>
        <td><input type="text" name="sms_number" id="sms_number" size="10" onkeypress="return isNumberKey(event)" onInput="checkLength(10,this)" ></td>
    </tr>
    <tr>
    	<th align="left">Whatsaap Number</th>
        <td><input type="text" name="whatsapp_number" id="whatsapp_number" size="10" onkeypress="return isNumberKey(event)" onInput="checkLength(10,this)" ></td>
    </tr>
    <tr>
    	<th align="left">Email</th>
        <td><input type="text" name="email" id="email" size="30"></td>
    </tr>
    <tr>
    	<th align="left">Website</th>
        <td><input type="text" name="website" id="website" size="40"></td>
    </tr>
    <tr>
    	<th align="left">Group Name</th>
        <td><select name="group_name" id="group_name">
            	<option value="">--Select--</option>
                <?php
					$s_sql="select group_type,group_id,group_name from txt_group_master order by group_name";
					$s_result=mysqli_query($con,$s_sql);
					while($s_rs=mysqli_fetch_array($s_result))
					{
						echo "<option value='".$s_rs['group_id']."'>".$s_rs['group_name']."-".$s_rs['group_type']."</option>";
					}
				?>
            </select></td>
	</tr>
	<?php if ($_SESSION['ROLEID']=='admin' || $_SESSION['ROLEID']=='master' ){ ?>
    <tr>
    	<th align="left">Commission Percentage</th>
        <td><input type="text" name="commission_percentage" id="commission_percentage" size="5" onkeypress="return isNumberKey(event)" onInput="checkLength(6,this)" onblur="getChassis(this.value)"></td>
    </tr>
	<?php }else{ ?>
		<input type="hidden" name="commission_percentage" id="commission_percentage" value="" >
	<?php } ?>
	<tr>
    	<th align="left">Firm Type</th>
        <td>
        	<select name="firm_type" id="firm_type">

                <?php
				if($_SESSION['ROLEID']=='admin' || $_SESSION['ROLEID']=='master' ){
					$arr=array('Other','Buyer','Supplier','Transport','Agent');
				}else{
					$arr=array('Other','Buyer','Supplier','Transport');
				}
				

				foreach($arr as $v)
				{
					echo "<option>".$v."</option>";
				}
				?>
        	</select>
        </td>
    </tr>
	<?php if ($_SESSION['ROLEID']=='admin' || $_SESSION['ROLEID']=='master' ){ ?>
	<tr>
    	<th align="left">Agent (Supplier)</th>
        <td>
        	<select name="agent_id" id="agent_id">
        		<option value="">--Select--</option>
                <?php

					$a_sql="select company_id,firm_name from txt_company where firm_type='Agent' order by firm_name";
					$a_result=mysqli_query($con,$a_sql);
					while($a_rs=mysqli_fetch_array($a_result))
					{
						echo "<option value='".$a_rs['company_id']."'>".$a_rs['firm_name']."</option>";
					}

				?>
        	</select>
        </td>
    </tr>
	<?php }else{ ?>
		<input type='hidden' name="agent_id" id="agent_id" value=''>
	<?php } ?>

    <tr>
    	<th align="left">Reference</th>
        <td><input type="text" name="reference" id="reference"></td>
    </tr>
    <tr>
    	<th align="left">Remarks</th>
        <td><input name="remarks" type="text" id="remarks" size="80"></td>
    </tr>
    <tr>
    	<th align="left">PAN Number</th>
        <td><input type="text" name="pan_number" id="pan_number" size="20"></td>
	</tr>
    <tr>
    	<th align="left">Products</th>
        <td><input type="text" name="products" id="products" size="80"></td>
	</tr>
    <tr>
    	<th align="left">Brands</th>
        <td><input type="text" name="brands" id="brands" size="80"></td>
	</tr>
	

    <tr>
    	<th align="left">Visiting Card</th>
        <td><img src="../images/upload_2.png" alt="no image" id="prev0" style="width:25px;height:25px;" name="prev_img2[]" />
        <input type="file" name="visiting_card" id="visiting_card"></td>
    </tr>
    <tr>
    	<th align="left">Photo-1</th>
        <td><img src="../images/upload_2.png" alt="no image" id="prev0" style="width:25px;height:25px;" name="prev_img[]" />
        <input type="file" name="photo_1" id="photo_1"></td>
    </tr>
    <tr>
    	<th align="left">Photo-2</th>
        <td><img src="../images/upload_2.png" alt="no image" id="prev0" style="width:25px;height:25px;" name="prev_img1[]" />
        <input type="file" name="photo_2" id="photo_2"></td>
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
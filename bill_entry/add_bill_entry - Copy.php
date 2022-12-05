<?php include("../includes/check_session.php");
include("../includes/config.php");
$con=get_connection();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add Bill Entry</title>
<link rel="icon" type="image/x-icon" href="<?php echo $web_path; ?>images/dt-favicon.ico" />
<link href="<?php echo $web_path; ?>css/style.css" rel="stylesheet" type="text/css" />
<style>
*
{
	margin:0;
	padding:0;
}
</style>
<script type="text/javascript" src="../js/bill_entry.js"></script>
<script type="text/javascript" src="../js/dateCheck.js"></script>
<script type="text/javascript">
        window.onbeforeunload = function () {
            var inputs = document.getElementsByTagName("INPUT");
            for (var i = 0; i < inputs.length; i++) {
                if (inputs[i].type == "button" || inputs[i].type == "submit") {
                    inputs[i].disabled = true;
                }
            }
        };
	</script>
	
<script type="text/javascript">
function check()
{
	/*
	var voucher_number=document.getElementById("voucher_number").value;
		if(voucher_number=="") {
			alert("Please Enter Voucher Number");
			document.getElementById("voucher_number").focus();
			return false;
		}
		*/
	var voucher_date=document.getElementById("voucher_date").value;
		if(voucher_date=="") {
			alert("Please Enter Voucher Date");
			document.getElementById("voucher_date").focus();
			return false;
		}
	var bill_number=document.getElementById("bill_number").value;
		if(bill_number=="") {
			alert("Please Enter Bill Number");
			document.getElementById("bill_number").focus();
			return false;
		}
	var bill_date=document.getElementById("bill_date").value;
		if(bill_date=="") {
			alert("Please Enter Bill Date");
			document.getElementById("bill_date").focus();
			return false;
		}
	var lr_number=document.getElementById("lr_number").value;
		if(lr_number=="") {
			alert("Please Enter LR Number");
			document.getElementById("lr_number").focus();
			return false;
		}
	var transport_name=document.getElementById("transport_name").value;
		if(transport_name=="") {
			alert("Please Enter Transport Name");
			document.getElementById("transport_name").focus();
			return false;
		}
	var supplier_account_code=document.getElementById("supplier_account_code").value;
		if(supplier_account_code=="") {
			alert("Please Enter Supplier Account Code");
			document.getElementById("supplier_account_code").focus();
			return false;
		}
	var buyer_account_code=document.getElementById("buyer_account_code").value;
		if(buyer_account_code=="") {
			alert("Please Enter Buyer Account Code");
			document.getElementById("buyer_account_code").focus();
			return false;
		}
	var gross_amount=document.getElementById("gross_amount").value;
		if(gross_amount=="") {
			alert("Please Enter Gross Amount");
			document.getElementById("gross_amount").focus();
			return false;
		}
		/*
	var deduction_amount=document.getElementById("deduction_amount").value;
		if(deduction_amount=="") {
			alert("Please Enter Deduction Amount");
			document.getElementById("deduction_amount").focus();
			return false;
		}
		*/
		/*
	var additional_amount=document.getElementById("additional_amount").value;
		if(additional_amount=="") {
			alert("Please Enter Additional Amount");
			document.getElementById("additional_amount").focus();
			return false;
		}
		*/
		/*
	var net_amount=document.getElementById("net_amount").value;
		if(net_amount=="") {
			alert("Please Enter Net Amount");
			document.getElementById("net_amount").focus();
			return false;
		}
		*/

		/*
	var discount_percentage=document.getElementById("discount_percentage").value;
		if(discount_percentage=="") {
			alert("Please Enter Discount Percentage");
			document.getElementById("discount_percentage").focus();
			return false;
		}
		*/

		/*
	var discount_amount=document.getElementById("discount_amount").value;
		if(discount_amount=="") {
			alert("Please Enter Discount Amount");
			document.getElementById("discount_amount").focus();
			return false;
		}
		*/
	var bill_amount=document.getElementById("bill_amount").value;
		if(bill_amount=="") {
			alert("Please Enter Bill Amount");
			document.getElementById("bill_amount").focus();
			return false;
		}
		/*
	var remarks=document.getElementById("remarks").value;
		if(remarks=="") {
			alert("Please Enter Remarks");
			document.getElementById("remarks").focus();
			return false;
		}
		*/
	return true;
}


function final_submit() {
	if(check()) {
		document.getElementById("net_amount").disabled=false;
		document.getElementById("discount_amount").disabled=false;
		document.getElementById("gst_amount").disabled=false;
		document.getElementById("bill_amount").disabled=false;

		document.getElementById('form-id').action='process_bill_entry.php?action=add';
		document.getElementById('form-id').submit();
	}
}
</script>
<?php include("../includes/jQDate.php"); ?>
</head>
<body>

<table width="100%" border="4" align="center" style="border:1px solid #e5f1f8;background-color:#FFFFFF">
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
						<table width="100%" border='0'>
							<tr>
								<td width="25%" align='left'>
									<h3>Add Bill Entry :</h3>
								</td>
								<td align="center" width="30%">
                    				<?php
									if(isset($_SESSION['msg'])) {
                    					echo $_SESSION['msg'];
                    					$_SESSION['msg']='';
									}
									?>
								</td>								
								<td width="45%" align="right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								</td>
							</tr>
						</table>
					</div>
    
    <table cellpadding="0" cellspacing="0" border="0">
            <tr>
             <td width="818" height="138" valign="top">
    <form method="post" id="form-id" enctype="multipart/form-data" onsubmit="">
    
    <table width="776" height="370" class="tbl_border">	
	<tr>
    	<th width="223" align="left">Voucher Number </th>
        <td align="left" width="182"><input type="text" name="voucher_number" size="10" id="voucher_number"></td>
        <th width="247"  align="left">Voucher Date <span class="astrik">*</span></th>
    	<td width="104" align="left"><input type="text" onChange="validatedate_format(this)" class="datepick" name="voucher_date" size="8" id="voucher_date" value="<?php echo date("d-m-Y");?>" /></td>
    </tr>
    <tr>
    	
    </tr>
    <tr>
    	<th align="left">Bill Number <span class="astrik">*</span></th>
    	<td align="left"><input type="text" name="bill_number" size="10" id="bill_number" /></td>
        <th align="left">Bill Date <span class="astrik">*</span></th>
    	<td><input type="text" name="bill_date" onChange="validatedate_format(this)" class="datepick" size="8" id="bill_date" /></td>
    </tr>
    <tr>
    	
    </tr>
    <tr>
    	<th align="left">LR Number <span class="astrik">*</span></th>
    	<td><input type="text" name="lr_number" size="10" id="lr_number" /></td>
        <th align="left">LR Date</th>
    	<td><input type="text" onChange="validatedate_format(this)" name="lr_date" class="datepick" size="8" id="lr_date" /></td>
    </tr>
    <tr>
    	
    </tr>
    <tr>


    
		<th align="left">Supplier Name <span class="astrik">*</span></th>
		<td>
        	<select name="supplier_account_code" id="supplier_account_code">
            	<option value="">--Select--</option>
                <?php
					$s_sql="SELECT * FROM txt_company WHERE Firm_type='Supplier' AND delete_tag='FALSE' order by firm_name ASC";
					$s_result=mysqli_query($con,$s_sql);
					while($s_rs=mysqli_fetch_array($s_result))
					{
						echo "<option value='".$s_rs['company_id']."'>".$s_rs['firm_name']."</option>";
					}
				?>
            </select>
		</td>

		<th align="left">Buyer Name <span class="astrik">*</span></th>
			
			<td>
        	<select name="buyer_account_code" id="buyer_account_code">
            	<option value="">--Select--</option>
                <?php
					$s_sql="SELECT * FROM txt_company WHERE Firm_type='Buyer' AND delete_tag='FALSE' order by firm_name ASC";
					$s_result=mysqli_query($con,$s_sql);
					while($s_rs=mysqli_fetch_array($s_result))
					{
						echo "<option value='".$s_rs['company_id']."'>".$s_rs['firm_name']."</option>";
					}
				?>
            </select>
		</td>			

		

	</tr>
	<tr>
	</tr>
    <tr>		
	<th height="22" align="left">Transport Name <span class="astrik">*</span></th>
		
		<td>
        	<select name="transport_name" id="transport_name">
            	<option value="">--Select--</option>
                <?php
					$s_sql="SELECT * FROM txt_company WHERE Firm_type='Transport' AND delete_tag='FALSE' order by firm_name ASC";
					$s_result=mysqli_query($con,$s_sql);
					while($s_rs=mysqli_fetch_array($s_result))
					{
						echo "<option value='".$s_rs['company_id']."'>".$s_rs['firm_name']."</option>";
					}
				?>
            </select>
		</td>		


		<th align="left">Agent</th>
		<td>
        	<select name="agent" id="agent">
            	<option value="">--Select--</option>
                <?php
					$s_sql="SELECT * FROM txt_company WHERE Firm_type='Agent' AND delete_tag='FALSE' order by firm_name ASC";
					$s_result=mysqli_query($con,$s_sql);
					while($s_rs=mysqli_fetch_array($s_result))
					{
						$selected="";
						// For Default Hira Textiles
						if($s_rs['company_id']=='33')
						{	
							$selected="selected";							
						}
						echo "<option $selected value='".$s_rs['company_id']."'>".$s_rs['firm_name']."</option>";
					}
				?>
            </select>
		</td>		

	</tr>
	<tr>
	</tr>

    <tr>
    	<th align="left">Gross Amount <span class="astrik">*</span></th>
		<td>
			<table  cellpadding="0" cellspacing="0" border="0" style="border-collapse: collapse">
				<tr cellpadding="0" cellspacing="0" border="0">
					<td cellpadding="0" cellspacing="0" border="0">	
						<input type="text" name="gross_amount" size="6" id="gross_amount" onblur="grossAmountOnChange()" />
					</td>
					<td cellpadding="0" cellspacing="0" border="0">
						<p name="grs_msg" id="grs_msg" style="color: red" ></p>
					</td>
				</tr>
			</table>
		</td>
		<td colspan=2></td>
	</tr>
	
    <tr>
    	<th align="left">Discount % </th>
    	<td>
		<table  cellpadding="0" cellspacing="0" border="0" style="border-collapse: collapse">
				<tr cellpadding="0" cellspacing="0" border="0">
					<td cellpadding="0" cellspacing="0" border="0">			
						<input type="text" name="discount_percentage" size="6" onfocusout="discountCalculate()" id="discount_percentage" />

						</td>
					<td cellpadding="0" cellspacing="0" border="0">
						<p name="dis_msg" id="dis_msg" style="color: red" ></p>
					</td>
				</tr>
			</table>

					
		</td>

    	<th align="left">Discount Amount </th>
		<td><input disabled  type="text" name="discount_amount" size="6" id="discount_amount" /> (Calculated)</td>
	</tr>
	<tr>
    	<th align="left">Deduction Amount </th>
    	<td>
			<table  cellpadding="0" cellspacing="0" border="0" style="border-collapse: collapse">
				<tr cellpadding="0" cellspacing="0" border="0">
					<td cellpadding="0" cellspacing="0" border="0">	
						<input type="text" name="deduction_amount" size="6" id="deduction_amount" onblur="deductionCheck()" />
					</td>
					<td cellpadding="0" cellspacing="0" border="0">
						<p name="ded_msg" id="ded_msg" style="color: red" ></p>
					</td>
				</tr>
			</table>						
		
		</td>
		<td colspan=2 ></td>
    </tr>
    <tr>
    	<th align="left">Additional Amount </th>
    	<td>
		<table  cellpadding="0" cellspacing="0" border="0" style="border-collapse: collapse">
				<tr cellpadding="0" cellspacing="0" border="0">
					<td cellpadding="0" cellspacing="0" border="0">	
						<input type="text" name="additional_amount" size="6" id="additional_amount" onblur="additionCheck()"  />
						</td>
					<td cellpadding="0" cellspacing="0" border="0">
						<p name="adl_msg" id="adl_msg" style="color: red" ></p>
					</td>
				</tr>
			</table>						
		
		
		</td>

    	<th align="left">Net Amount <span class="astrik">*</span> </th>
		<td><input disabled type="text" name="net_amount" size="6" id="net_amount" /> (Calculated) </td>
	
	</tr>
    <tr>
		<th align="left">GST % <span class="astrik">*</span></th>
		<td>
			<table  cellpadding="0" cellspacing="0" border="0" style="border-collapse: collapse">
				<tr cellpadding="0" cellspacing="0" border="0">
					<td cellpadding="0" cellspacing="0" border="0">	

						<input type="text" value='5' name="gst_percent" size="6" id="gst_percent" onblur="gstCalculate()" />
					</td>
					<td cellpadding="0" cellspacing="0" border="0">
						<p name="gst_msg" id="gst_msg" style="color: red" ></p>
					</td>
				</tr>
			</table>
		</td>


    	<th align="left">GST Amount <span class="astrik">*</span></th>
		<td><input disabled type="text" name="gst_amount" size="6" id="gst_amount" /> (Calculated) </td>

	</tr>
    <tr>
    	<th align="left">Round Off </th>
		<td>
			<table  cellpadding="0" cellspacing="0" border="0" style="border-collapse: collapse">
				<tr cellpadding="0" cellspacing="0" border="0">
					<td cellpadding="0" cellspacing="0" border="0">	
						<input type="text" name="round_off" size="6" id="round_off" onblur="roundOffCheck()" />
						</td>
					<td cellpadding="0" cellspacing="0" border="0">
						<p name="rnd_msg" id="rnd_msg" style="color: red" ></p>
					</td>
				</tr>
			</table>

		
		
		</td>

    	<th align="left">Bill Amount <span class="astrik">*</span></th>
		<td><input disabled type="text" name="bill_amount" size="6" id="bill_amount" /> (Calculated)</td>

    </tr>
    <tr>
    	<th align="left">Remarks </th>
		<td><input type="text" name="remarks" id="remarks" /></td>
		<td colspan=2 >
		<input  type="button" class="form-button"  onclick="billAmountCalculate()" name="cal_btn" value="Bill Amount Calculate" />
		</td>
    </tr>
    <tr>
    	<th align="left">Bill Upload</th>
        <td><img src="../images/upload_2.png" alt="no image" id="prev0" style="width:25px;height:25px;" name="prev_img1[]" />
        <input type="file" name="bill_upload" id="bill_upload"></td>
    	<th align="left">Supporting Document</th>
        <td><img src="../images/upload_2.png" alt="no image" id="prev0" style="width:25px;height:25px;" name="prev_img1[]" />
        <input type="file" name="supporting_doc" id="supporting_doc"></td>		
    </tr>	
    </table>
     <br/><br/>
		<table width="324">
			<tr>
				<td width="116">
				<a href="index.php">Cancel</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input  type="button" class="form-button" onclick="final_submit()" name="my_btn" value="Save" />
				
				</td>
			</tr>
		</table>
      </form>
      </td>
	  </tr>
	  </table>
		<?php 
			$_SESSION['uid']=77; 
			?>
      </div>
      </td>
	  </tr>
	  </table>
      </td></tr>
	<tr>
	<td> <?php include("../includes/footer.php"); ?></td>
	</tr>
	</table>
</body>
<script>
document.getElementById("voucher_number").focus();
</script>
</html>
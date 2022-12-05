
function checkNumberValueMandatory(txtVal,dispMsg){
	

	var t_amount=(document.getElementById(txtVal).value);

		if(t_amount==""){
			document.getElementById(dispMsg).innerHTML="Field Mandatory";
			t_amount="";
			document.getElementById(txtVal).value=t_amount;
			document.getElementById(txtVal).focus();
		} else if(!isNaN(t_amount)){
			document.getElementById(dispMsg).innerHTML="Number";
			t_amount=(new Number(t_amount)).toFixed(2);
			document.getElementById(txtVal).value=t_amount;
			document.getElementById(dispMsg).innerHTML="";
		}else {
			document.getElementById(dispMsg).innerHTML="Should be Number";
			t_amount="";
			document.getElementById(txtVal).value=t_amount;
			document.getElementById(txtVal).focus();
		}
	return t_amount;	

}

function checkNumberValueNonMandatory(txtVal,dispMsg){

	var t_amount=(document.getElementById(txtVal).value);
	
		if(t_amount==""){
			// This Condition is Blank as "" is NaN 
			// Appropriate message are taken care of in above called Function
		
		} else if(!isNaN(t_amount)){
			document.getElementById(dispMsg).innerHTML="Number";
			t_amount=(new Number(t_amount)).toFixed(2);
			document.getElementById(txtVal).value=t_amount;
			document.getElementById(dispMsg).innerHTML="";
		}else {
			document.getElementById(dispMsg).innerHTML="Should be Number";
			t_amount="";
			document.getElementById(txtVal).value=t_amount;
			document.getElementById(txtVal).focus();
		}
	return t_amount;	

}


function grossAmountOnChange(){

	var grs_amt=checkNumberValueMandatory("gross_amount","grs_msg");

		if(grs_amt==""){
			// This Condition is Blank as "" is Less Then 0 
			// Appropriate message are taken care of in above called Function
		} else 	if(grs_amt<=0){
			document.getElementById("grs_msg").innerHTML="Should Be Greater Then 0";
			grs_amt=""
			document.getElementById('gross_amount').value=grs_amt;
			document.getElementById("gross_amount").focus();
		}
	billAmountCalculate();
	
}


function gstCalculate(){
	
	var gst_per=checkNumberValueMandatory("gst_percent","gst_msg");

		if(gst_per>=100){
			document.getElementById("gst_amount").disabled=false;
			document.getElementById("gst_amount").value="";
			document.getElementById("gst_amount").disabled=true;

			document.getElementById("gst_msg").innerHTML="Should be less then 100"+gst_per.value;
			document.getElementById("gst_percent").value="";
			document.getElementById("gst_percent").focus();
		} else if(gst_per>0){
			var gst_amt=((document.getElementById("net_amount").value*gst_per)/100).toFixed(2);

			document.getElementById("gst_amount").disabled=false;
			document.getElementById("gst_amount").value=gst_amt;
			document.getElementById("gst_amount").disabled=true;
		} else if(gst_per<0){
			document.getElementById("gst_amount").disabled=false;
			document.getElementById("gst_amount").value="";
			document.getElementById("gst_amount").disabled=true;

			document.getElementById("gst_msg").innerHTML="Should be greater then 0";
			document.getElementById("gst_percent").value="";
			document.getElementById("gst_percent").focus();			
		} else if(gst_per==0){
			document.getElementById("gst_msg").innerHTML="Should be greater then 0";

			document.getElementById("gst_amount").disabled=false;
			document.getElementById("gst_amount").value="";
			document.getElementById("gst_amount").disabled=true;

			document.getElementById("gst_percent").value="";
			document.getElementById("gst_percent").focus();	
		}

		billAmountCalculate();

	}

	function deductionCheck(){
		var dis_per=checkNumberValueNonMandatory("deduction_amount","ded_msg");
		billAmountCalculate();
	}
	function additionCheck(){
		var dis_per=checkNumberValueNonMandatory("additional_amount","adl_msg");
		billAmountCalculate();
	}
	function roundOffCheck(){
		var dis_per=checkNumberValueNonMandatory("round_off","rnd_msg");
		billAmountCalculate();
	}



	function discountCalculate(){
		var dis_per=checkNumberValueNonMandatory("discount_percentage","dis_msg");

		if(dis_per>=100){
			document.getElementById("discount_amount").disabled=false;
			document.getElementById("discount_amount").value="";
			document.getElementById("discount_amount").disabled=true;

			document.getElementById("dis_msg").innerHTML="Should be less then 100";
			document.getElementById("discount_percentage").value="";
			document.getElementById("discount_percentage").focus();
		} else if(dis_per>0){
			var dis_amt=((document.getElementById("gross_amount").value*dis_per)/100).toFixed(2);
			document.getElementById("discount_amount").disabled=false;
			document.getElementById("discount_amount").value=dis_amt;
			document.getElementById("discount_amount").disabled=true;

		} else if(dis_per<0){
			document.getElementById("discount_amount").disabled=false;
			document.getElementById("discount_amount").value="";
			document.getElementById("discount_amount").disabled=true;

			document.getElementById("dis_msg").innerHTML="Should be greater then 0";
			document.getElementById("discount_percentage").value="";
			document.getElementById("discount_percentage").focus();			
		} else {
			document.getElementById("discount_percentage").value="";
			document.getElementById("discount_amount").disabled=false;
			document.getElementById("discount_amount").value="";
			document.getElementById("discount_amount").disabled=true;
		}
		billAmountCalculate();
	}

	function processBlanktoZero(amtVal){

		if(amtVal=="" || isNaN(amtVal)){
			amtVal=0;
		} else {
			amtVal=(new Number(amtVal));
		}
		return amtVal;
	}

	function netAmountCalculate(){

		grs_amt=processBlanktoZero(document.getElementById("gross_amount").value);
		dis_amt=processBlanktoZero(document.getElementById("discount_amount").value);
		ded_amt=processBlanktoZero(document.getElementById("deduction_amount").value);
		add_amt=processBlanktoZero(document.getElementById("additional_amount").value);

		net_amt=(grs_amt-dis_amt-ded_amt+add_amt).toFixed(2);

		document.getElementById("net_amount").disabled=false;
		document.getElementById("net_amount").value=net_amt;
		document.getElementById("net_amount").disabled=true;

	}
	
	function discountCalc(){
		dis_per=processBlanktoZero(document.getElementById("discount_percentage").value);
		grs_amt=processBlanktoZero(document.getElementById("gross_amount").value);

		document.getElementById("discount_amount").value=((grs_amt*dis_per)/100).toFixed(2);

	}

	function gstCalc(){
		gst_per=processBlanktoZero(document.getElementById("gst_percent").value);
		net_amt=processBlanktoZero(document.getElementById("net_amount").value);

		document.getElementById("gst_amount").value=((net_amt*gst_per)/100).toFixed(2);


	}

	function billAmountCalculate(){
		discountCalc();
		
		netAmountCalculate();
		gstCalc();
	
		net_amt=processBlanktoZero(document.getElementById("net_amount").value);
		gst_amt=processBlanktoZero(document.getElementById("gst_amount").value);
		round_off=processBlanktoZero(document.getElementById("round_off").value);

		bill_amt=(net_amt+gst_amt+round_off).toFixed(2);

		document.getElementById("bill_amount").disabled=false;
		document.getElementById("bill_amount").value=bill_amt;
		document.getElementById("bill_amount").disabled=true;

	}


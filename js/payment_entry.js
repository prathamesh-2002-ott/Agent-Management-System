function processBlanktoZero(amtVal) {
    if (amtVal == "" || isNaN(amtVal)) {
        amtVal = 0;
    } else {
        amtVal = (new Number(amtVal));
    }
    return amtVal;
}


function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
        //if (charCode > 31 && (charCode < 48 || charCode > 57))
    if (charCode > 31 && (charCode != 46 && (charCode < 48 || charCode > 57)))
        return false;
    return true;
}

function billVouTypeChange() {
    var l_bill_payment_type_array = document.getElementsByName('bill_payment_type[]');

    var l_bill_discount_amt_array = document.getElementsByName('bill_discount_amt[]');
    var l_bill_deduction_amt_array = document.getElementsByName('bill_deduction_amt[]');
    var l_bill_goods_return_array = document.getElementsByName('bill_goods_return[]');
    var l_bill_received_amt_array = document.getElementsByName('bill_received_amt[]');

    l_size = l_bill_payment_type_array.length;
    for (a = 0; a < l_size; a++) {
        payment_type = l_bill_payment_type_array[a].value;
        //alert(payment_type);
        if (payment_type == "Select") {
            l_bill_discount_amt_array[a].value = "";
            l_bill_deduction_amt_array[a].value = "";
            l_bill_goods_return_array[a].value = "";
            l_bill_received_amt_array[a].value = "";

        }
    }

    // To test and the Implement
    calBillPayGRRecFull();

    calculateBillDisAmt();
    calculateBillReceivedAmount();
    calculateBillGRAmount();
    calBillBalAmt();
    calculateDifference();

}

function calBillPayGRRecFull() {

    //bill_payment_type[]
    var l_bill_pay_typ_arr = document.getElementsByName('bill_payment_type[]');
    // bill_bal_amt[]
    var l_bill_bal_amt_arr = document.getElementsByName('bill_bal_amt[]');

    //bill_amt[]
    //adj_amt[]
    //adj_dis[]
    //adj_gr[]

    var l_bill_amt_arr = document.getElementsByName('bill_amt[]');
    var l_adj_amt_arr = document.getElementsByName('adj_amt[]');
    var l_adj_dis_arr = document.getElementsByName('adj_dis[]');
    var l_adj_gr_arr = document.getElementsByName('adj_gr[]');


    l_count = l_bill_pay_typ_arr.length;

    for (x = 0; x < l_count; x++) {
        if (l_bill_pay_typ_arr[x].value == "Full") {
            //chq_lr_div
            var l_chq_lr_div_val = document.getElementById('chq_lr_div').value;

            //bill_goods_return[]
            l_bill_amt_arr[x].disabled = false;
            l_adj_amt_arr[x].disabled = false;
            l_adj_dis_arr[x].disabled = false;
            l_adj_gr_arr[x].disabled = false;

            l_cal_bill_bal = l_bill_amt_arr[x].value - (processBlanktoZero(l_adj_amt_arr[x].value) + processBlanktoZero(l_adj_dis_arr[x].value) + processBlanktoZero(l_adj_gr_arr[x].value));

            l_bill_amt_arr[x].disabled = true;
            l_adj_amt_arr[x].disabled = true;
            l_adj_dis_arr[x].disabled = true;
            l_adj_gr_arr[x].disabled = true;

            if (l_chq_lr_div_val == 'LR') {

                var l_bill_goods_return_arr = document.getElementsByName('bill_goods_return[]');
                l_bill_goods_return_arr[x].value = l_cal_bill_bal;
                calculateBillGRAmount();

            } else if (l_chq_lr_div_val == 'CHQ') {

                //bill_discount_percent[]
                var l_bill_discount_percent_arr = document.getElementsByName('bill_discount_percent[]');
                //bill_discount_amt[]
                var l_bill_discount_amt_arr = document.getElementsByName('bill_discount_amt[]');
                //bill_deduction_amt[]
                var l_bill_deduction_amt_arr = document.getElementsByName('bill_deduction_amt[]');
                //bill_received_amt[]
                var l_bill_received_amt_arr = document.getElementsByName('bill_received_amt[]');

                l_bill_rec_amt = l_cal_bill_bal - (processBlanktoZero(l_bill_discount_amt_arr[x].value) + processBlanktoZero(l_bill_deduction_amt_arr[x].value));

                l_bill_received_amt_arr[x].value = processBlanktoZero(l_bill_rec_amt).toFixed(2);


                calBillDisPer();
                calculateBillReceivedAmount();
            }
        }
    }
}

function payVouCalculateAmount(i_total_ele, i_array, i_amt) {
    var l_amount_array = document.getElementsByName(i_array);
    l_amount_cal = i_amt;
    l_size = l_amount_array.length;

    for (a = 0; a < l_size; a++) {
        l_amt = processBlanktoZero(l_amount_array[a].value).toFixed(2);

        if (l_amt > 0) {
            l_amount_array[a].value = l_amt;
        } else {
            l_amount_array[a].value = "";
        }

        l_amount_cal += processBlanktoZero(l_amt);
    }
    document.getElementById(i_total_ele).disabled = false;
    document.getElementById(i_total_ele).value = processBlanktoZero(l_amount_cal).toFixed(2);
    document.getElementById(i_total_ele).disabled = true;
    //alert("hi");
    calculateDifference();
}

function payVouClean(i_array) {
    var l_amount_array = document.getElementsByName(i_array);
    l_size = l_amount_array.length;
    for (a = 0; a < l_size; a++) {
        l_amount_array[a].value = "";
    }

}


function calculateChqAmount() {
    payVouCalculateAmount('total_amount', 'chq_amount[]', 0);
}

function calculateDiscountAmount() {
    payVouCalculateAmount('total_discount', 'discount_amt[]', 0);
}


function calculateGRAmount() {
    payVouCalculateAmount('total_goods_return', 'goods_return_amt[]', 0);
    //calBillBalAmt();
}


function calBillDisPer() {
    // Implemented Partially

    var l_bill_amount_array = document.getElementsByName('bill_amt[]');
    var l_bill_discount_amt_array = document.getElementsByName('bill_discount_amt[]');
    var l_bill_discount_percent_array = document.getElementsByName('bill_discount_percent[]');

    l_size = l_bill_amount_array.length;
    for (a = 0; a < l_size; a++) {

        // Bill Amount Taken as is its to be changed after Amount Adjusted is Implemented
        l_bill_amount_array.disabled = false;
        l_bill_amt = processBlanktoZero(l_bill_amount_array[a].value).toFixed(2);
        l_bill_amount_array.disabled = true;

        // Getting Amount
        l_bill_dis_amt = processBlanktoZero(l_bill_discount_amt_array[a].value).toFixed(2);
        l_bill_discount_amt_array[a].value = l_bill_dis_amt;

        // Calculating Percent
        l_dis_per = (l_bill_dis_amt / l_bill_amt) * 100;
        l_bill_discount_percent_array[a].value = processBlanktoZero(l_dis_per).toFixed(2);
    }
    calculateBillDisAmt();

}

function calculateBillDiscount() {

    l_chq_lr = document.getElementById('chq_lr_div').value;
    if (l_chq_lr == "LR") {

        payVouClean('bill_discount_percent[]');
    } else {
        calBillDis();
    }
    calBillPayGRRecFull();

}

function calBillDis() {
    // Implemented Partially

    var l_bill_amount_array = document.getElementsByName('bill_amt[]');
    var l_bill_discount_amt_array = document.getElementsByName('bill_discount_amt[]');
    var l_bill_discount_percent_array = document.getElementsByName('bill_discount_percent[]');

    l_size = l_bill_amount_array.length;
    for (a = 0; a < l_size; a++) {

        // Bill Amount Taken as is its to be changed after Amount Adjusted is Implemented
        l_bill_amount_array.disabled = false;
        l_bill_amt = processBlanktoZero(l_bill_amount_array[a].value).toFixed(2);
        l_bill_amount_array.disabled = true;

        // Getting Percent
        l_bill_dis_per = processBlanktoZero(l_bill_discount_percent_array[a].value).toFixed(2);
        l_bill_discount_percent_array[a].value = l_bill_dis_per;

        // Calculting Amount
        l_dis_amt = (l_bill_amt * l_bill_dis_per) / 100;
        l_bill_discount_amt_array[a].value = processBlanktoZero(l_dis_amt).toFixed(2);
    }
    calculateBillDisAmt();
}


function calBillBalAmt() {
    var l_bill_amount_array = document.getElementsByName('bill_amt[]');
    var l_adjusted_amount_array = document.getElementsByName('adj_amt[]');
    var l_adjusted_discount_array = document.getElementsByName('adj_dis[]');
    var l_adjusted_gr_array = document.getElementsByName('adj_gr[]');

    var l_bill_discount_amt_array = document.getElementsByName('bill_discount_amt[]');
    var l_bill_deduction_amt_array = document.getElementsByName('bill_deduction_amt[]');
    var l_bill_goods_return_array = document.getElementsByName('bill_goods_return[]');
    var l_bill_received_amt_array = document.getElementsByName('bill_received_amt[]');

    var l_bill_bal_amt_array = document.getElementsByName('bill_bal_amt[]');

    l_size = l_bill_amount_array.length;
    for (a = 0; a < l_size; a++) {
        l_bill_amount_array[a].disabled = false;
        l_bill_amt = processBlanktoZero(l_bill_amount_array[a].value).toFixed(2);
        l_bill_amount_array[a].disabled = true;

        l_adjusted_amount_array[a].disabled = false;
        l_adj_amt = processBlanktoZero(l_adjusted_amount_array[a].value).toFixed(2);
        l_adjusted_amount_array[a].disabled = true;

        l_adjusted_discount_array[a].disabled = false;
        l_adj_dis = processBlanktoZero(l_adjusted_discount_array[a].value).toFixed(2);
        l_adjusted_discount_array[a].disabled = true;

        l_adjusted_gr_array[a].disabled = false;
        l_adj_gr = processBlanktoZero(l_adjusted_gr_array[a].value).toFixed(2);
        l_adjusted_gr_array[a].disabled = true;


        l_bill_dis_amt = processBlanktoZero(l_bill_discount_amt_array[a].value).toFixed(2);
        l_bill_ded_amt = processBlanktoZero(l_bill_deduction_amt_array[a].value).toFixed(2);
        l_bill_gr_amt = processBlanktoZero(l_bill_goods_return_array[a].value).toFixed(2);
        l_bill_rec_amt = processBlanktoZero(l_bill_received_amt_array[a].value).toFixed(2);


        l_bill_bal = l_bill_amt - l_adj_amt - l_adj_dis - l_adj_gr - l_bill_dis_amt - l_bill_ded_amt - l_bill_gr_amt - l_bill_rec_amt;

        l_bill_bal_amt_array[a].disabled = false;
        l_bill_bal_amt_array[a].value = processBlanktoZero(l_bill_bal).toFixed(2);
        l_bill_bal_amt_array[a].disabled = true;
    }
}

function calculateBillReceivedAmount() {
    l_chq_lr = document.getElementById('chq_lr_div').value;
    if (l_chq_lr == "LR") {
        payVouClean('bill_received_amt[]');
    } else {
        payVouCalculateAmount('total_amount_received', 'bill_received_amt[]', 0);
        calBillBalAmt();
    }
    //calBillPayGRRecFull();
}

function calculateBillDisAmt() {
    payVouCalculateAmount('total_discount_received', 'bill_discount_amt[]', 0);
    l_dis = processBlanktoZero(document.getElementById('total_discount_received').value);
    payVouCalculateAmount('total_discount_received', 'bill_deduction_amt[]', l_dis);
    calBillBalAmt();
}

function calculateBillDiscountAmount() {
    l_chq_lr = document.getElementById('chq_lr_div').value;
    if (l_chq_lr == "LR") {
        payVouClean('bill_discount_amt[]');
        payVouClean('bill_discount_percent[]');
        payVouClean('bill_deduction_amt[]');
    } else {
        calBillDisPer();
        calculateBillDisAmt();
    }
    calBillPayGRRecFull();
}

function calculateBillGRAmount() {
    l_chq_lr = document.getElementById('chq_lr_div').value;
    if (l_chq_lr == "CHQ") {
        payVouClean('bill_goods_return[]');
    } else {
        payVouCalculateAmount('total_goods_return_received', 'bill_goods_return[]', 0);
        calBillBalAmt();
    }
    //calBillPayGRRecFull();
}


function buyerChange() {
    l_buyer_last = document.getElementById('buyer_last_value').value;
    l_buyer_selected = document.getElementById('buyer_account_code').value;
    if (l_buyer_last != "") {
        if (l_buyer_last != l_buyer_selected) {
            alert("You have Changed Buyer Please Click Next to continue");
            document.getElementById('buyer_tag').value = "FALSE";
        }
        if (l_buyer_last == l_buyer_selected) {
            document.getElementById('buyer_tag').value = "";
        }
    }
}

function supplierChange() {
    l_supplier_last = document.getElementById('supplier_last_value').value;
    l_supplier_selected = document.getElementById('supplier_account_code').value;
    if (l_supplier_last != "") {
        if (l_supplier_last != l_supplier_selected) {
            alert("You have Changed Supplier Please Click Next to continue");
            document.getElementById('supplier_tag').value = "FALSE";
        }
        if (l_supplier_last == l_supplier_selected) {
            document.getElementById('supplier_tag').value = "";
        }
    }
}


function voucherTypeChange() {
    l_vou_type_last = document.getElementById('voucher_type_last_value').value;
    l_vou_type_selected = document.getElementById('voucher_type').value;

    if (l_vou_type_last != "") {
        if (l_vou_type_last != l_vou_type_selected) {
            if (l_vou_type_last == "Payment" || l_vou_type_last == "Advance Payment" || l_vou_type_last == "Discount") {
                if (l_vou_type_selected == "Payment" || l_vou_type_selected == "Advance Payment" || l_vou_type_selected == "Discount") {
                    document.getElementById('voucher_type_tag').value = "";
                } else {
                    alert("You have Changed Voucher Type Please Click Next to continue");
                    document.getElementById('voucher_type_tag').value = "FALSE";
                }
            }

            if (l_vou_type_last == "Goods Return" || l_vou_type_last == "GR After Payment") {
                if (l_vou_type_selected == "Goods Return" || l_vou_type_selected == "GR After Payment") {
                    document.getElementById('voucher_type_tag').value = "";
                } else {
                    alert("You have Changed Voucher Type Please Click Next to continue");
                    document.getElementById('voucher_type_tag').value = "FALSE";
                }
            }
        }
        if (l_vou_type_last == l_vou_type_selected) {
            document.getElementById('voucher_type_tag').value = "";
        }
    }
}



function calculateDifference() {
    //total_amount
    //total_discount
    //total_goods_return

    document.getElementById('total_amount').disabled = false;
    val_total_amt = processBlanktoZero(document.getElementById('total_amount').value);
    document.getElementById('total_amount').disabled = true;

    document.getElementById('total_discount').disabled = false;
    val_total_dis = processBlanktoZero(document.getElementById('total_discount').value);
    document.getElementById('total_discount').disabled = true;

    document.getElementById('total_goods_return').disabled = false;
    val_total_gr = processBlanktoZero(document.getElementById('total_goods_return').value);
    document.getElementById('total_goods_return').disabled = true;

    //val_final_chq_gr=val_total_amt-val_total_dis-val_total_gr;

    //total_amount_received
    //total_discount_received
    //total_goods_return_received
    //amount_received_difference

    document.getElementById('total_amount_received').disabled = false;
    val_total_amt_rec = processBlanktoZero(document.getElementById('total_amount_received').value);
    document.getElementById('total_amount_received').disabled = true;

    document.getElementById('total_discount_received').disabled = false;
    val_total_dis_rec = processBlanktoZero(document.getElementById('total_discount_received').value);
    document.getElementById('total_discount_received').disabled = true;

    document.getElementById('total_goods_return_received').disabled = false;
    val_total_gr_rec = processBlanktoZero(document.getElementById('total_goods_return_received').value);
    document.getElementById('total_goods_return_received').disabled = true;

    //val_rec=val_total_amt_rec-val_total_dis_rec-val_total_gr_rec;


    val_amt_rec_diff = processBlanktoZero(val_total_amt - val_total_amt_rec).toFixed(2);

    document.getElementById('amount_received_difference').disabled = false;
    document.getElementById('amount_received_difference').value = val_amt_rec_diff;
    document.getElementById('amount_received_difference').disabled = true;


    val_dis_rec_diff = processBlanktoZero(val_total_dis - val_total_dis_rec).toFixed(2);

    document.getElementById('discount_received_difference').disabled = false;
    document.getElementById('discount_received_difference').value = val_dis_rec_diff;
    document.getElementById('discount_received_difference').disabled = true;


    val_gr_rec_diff = processBlanktoZero(val_total_gr - val_total_gr_rec).toFixed(2);

    document.getElementById('goods_return_received_difference').disabled = false;
    document.getElementById('goods_return_received_difference').value = val_gr_rec_diff;
    document.getElementById('goods_return_received_difference').disabled = true;


    //alert('hi');
}

// function unused as of now new shorter version is being developed
/*
function checkMinOneBillHasValue_1() {
	var l_chq_lr = document.getElementById('chq_lr_div').value;
	var l_vou_type_selected = document.getElementById('voucher_type').value;

	if (l_chq_lr == "CHQ") {
		// Check Rec Amount and Discount 
		var l_bill_discount_amt_array = document.getElementsByName('bill_discount_amt[]');
		var l_bill_deduction_amt_array = document.getElementsByName('bill_deduction_amt[]');
		var l_bill_received_amt_array = document.getElementsByName('bill_received_amt[]');

		l_tot_bill_dis_amt = 0;
		l_tot_bill_ded_amt = 0;
		l_tot_bill_rec_amt = 0;

		l_bill_dis_amt = 0;
		l_bill_ded_amt = 0;
		l_bill_rec_amt = 0;

		l_size = l_bill_received_amt_array.length;

		//if(l_vou_type_selected=="Payment" || l_vou_type_selected=="Advance Payment" || l_vou_type_selected=="Discount")
		if (l_vou_type_selected == "Payment") {
			for (a = 0; a < l_size; a++) {
				l_bill_rec_amt = processBlanktoZero(l_bill_received_amt_array[a].value);
				l_tot_bill_rec_amt += l_bill_rec_amt;
			}
			if (l_tot_bill_rec_amt > 0) {
				return true;
			} else {
				alert("Please Enter Received in Bill Section ")
				l_bill_received_amt_array[0].focus();
				return false;
			}

		} else if (l_vou_type_selected == "Discount") {
			for (a = 0; a < l_size; a++) {
				l_bill_dis_amt = processBlanktoZero(l_bill_discount_amt_array[a].value);
				l_bill_ded_amt = processBlanktoZero(l_bill_deduction_amt_array.value);
				l_tot_bill_dis_amt += l_bill_dis_amt;
				l_tot_bill_ded_amt += l_bill_ded_amt;
			}
			l_tot_bill_dis_amt += l_tot_bill_ded_amt;
			if (l_tot_bill_dis_amt > 0) {
				return true;
			} else {
				alert("Please Enter Discount or Deduction in Bill Section ")
				l_bill_discount_amt_array[0].focus();
				return false;
			}

		} else if (l_vou_type_selected == "Advance Payment") {
			return true;
		} else {
			// This is very unrealistic Scenario this will occur only when some of the predefined Item in Payment Type will change.
			alert('Please Enter the Required Details in Bill Section');
			return false;
		}

	} else if (l_chq_lr == "LR") {
		//Check for GR
		var l_bill_goods_return_array = document.getElementsByName('bill_goods_return[]');
		alert("in LR ");
		// if(l_vou_type_selected=="Goods Return" || l_vou_type_selected=="GR After Payment"  )
		if (l_vou_type_selected == "Goods Return" || l_vou_type_selected == "GR After Payment") {
			l_tot_bill_gr_amt = 0;

			l_bill_gr_amt = 0;

			l_size = l_bill_goods_return_array.length;
			alert("Array Size"+l_size);
			for (a = 0; a < l_size; a++) {
				l_bill_gr_amt = processBlanktoZero(l_bill_goods_return_array[a].value);
				l_tot_bill_gr_amt += l_bill_gr_amt;
			}
			alert("tot_gr"+l_tot_bill_gr_amt);
			if (l_tot_bill_gr_amt > 0) {
				return true;

			} else {
				alert("Please Enter Goods Return in Bill Section ")
				l_bill_goods_return_array[0].focus();
				return false;
			}

		} else {
			// This is very unrealistic Scenario this will occur only when some of the predefined Item in Payment Type will change.
			alert('Please Enter the Required Details in Bill Section 1 ');
			return false;
		}

	} else {
		// This is very unrealistic Scenario this will occur only when some of the predefined Item in Payment Type will change.
		alert('Please Enter the Required Details in Bill Section 2');
		return false;
	}

}
*/
function balanceLessThenZero() {
    //alert("Check Balance");
    var l_bill_bal_amt_array = document.getElementsByName('bill_bal_amt[]');
    var l_bill_received_amt_array = document.getElementsByName('bill_received_amt[]');
    var l_bill_goods_return_array = document.getElementsByName('bill_goods_return[]');
    var l_bill_payment_type_array = document.getElementsByName('bill_payment_type[]');

    var l_chq_lr = document.getElementById('chq_lr_div').value;

    l_size = l_bill_bal_amt_array.length;
    //alert(l_size);
    for (a = 0; a < l_size; a++) {

        bal_val = processBlanktoZero(l_bill_bal_amt_array[a].value)
            //alert (bal_val);
        if (bal_val < 0) {
            if (l_chq_lr == 'CHQ') {
                alert('Balance Amount can not be Less Then Zero');
                l_bill_received_amt_array[a].focus();
                return false;
            } else if (l_chq_lr == 'LR') {
                alert('Balance Amount can not be Less Then Zero');
                l_bill_goods_return_array[a].focus();
                return false;
            } else {
                // unlikely Scnerio
                alert('Balance Amount can not be Less Then Zero');
                l_bill_payment_type_array[a].focus();
                return false;
            }
        }

    }
    return true;

}


function checkMinOneBillHasValue() {
    //alert('Hello');
    var l_chq_lr = document.getElementById('chq_lr_div').value;
    var l_vou_type_selected = document.getElementById('voucher_type').value;

    if (l_chq_lr == "CHQ") {
        // Check Rec Amount and Discount 
        if (l_vou_type_selected == "Payment") {
            var l_total_amount_received_val = processBlanktoZero(document.getElementById('total_amount_received').value);
            if (l_total_amount_received_val > 0) {
                return true;
            } else {
                alert("Please Enter Received in Bill Section ");
                var l_bill_received_amt_array = document.getElementsByName('bill_received_amt[]');
                l_bill_received_amt_array[0].focus();
                return false;
            }

        } else if (l_vou_type_selected == "Discount") {
            var l_total_discount_received_val = processBlanktoZero(document.getElementById('total_discount_received').value);
            if (l_total_discount_received_val > 0) {
                return true;
            } else {
                alert("Please Enter Discount or Deduction in Bill Section ");
                var l_bill_discount_amt_array = document.getElementsByName('bill_discount_amt[]');
                l_bill_discount_amt_array[0].focus();
                return false;
            }

        } else if (l_vou_type_selected == "Advance Payment") {
            return true;
        } else {
            // This is very unrealistic Scenario this will occur only when some of the predefined Item in Payment Type will change.
            alert('Please Enter the Required Details in Bill Section');
            return false;
        }

    } else if (l_chq_lr == "LR") {
        //Check for GR
        if (l_vou_type_selected == "Goods Return" || l_vou_type_selected == "GR After Payment") {
            var l_total_goods_return_received_val = processBlanktoZero(document.getElementById('total_goods_return_received').value);

            if (l_total_goods_return_received_val > 0) {
                return true;
            } else {
                alert("Please Enter Goods Return in Bill Section ");
                var l_bill_goods_return_array = document.getElementsByName('bill_goods_return[]');
                l_bill_goods_return_array[0].focus();
                return false;
            }

        } else {
            // This is very unrealistic Scenario this will occur only when some of the predefined Item in Payment Type will change.
            alert('Please Enter the Required Details in Bill Section 1 ');
            return false;
        }

    } else {
        // This is very unrealistic Scenario this will occur only when some of the predefined Item in Payment Type will change.
        alert('Please Enter the Required Details in Bill Section 2');
        return false;
    }

}

function checkMinOneChqGRDetail() {
    //alert('Test');
    var l_chq_lr = document.getElementById('chq_lr_div').value;
    var l_vou_type_selected = document.getElementById('voucher_type').value;

    if (l_chq_lr == "CHQ") {
        if (l_vou_type_selected == "Payment" || l_vou_type_selected == "Advance Payment") {
            var l_total_amount_val = processBlanktoZero(document.getElementById('total_amount').value);

            if (l_total_amount_val > 0) {
                return true;
            } else {
                alert("Please Enter Amount in Cheque Details Section ");
                var l_chq_amount_amt_array = document.getElementsByName('chq_amount[]');
                l_chq_amount_amt_array[0].focus();
                return false;
            }
        } else if (l_vou_type_selected == "Discount") {
            var l_total_discount_val = processBlanktoZero(document.getElementById('total_discount').value);

            if (l_total_discount_val > 0) {
                return true;
            } else {
                alert("Please Enter Discount Amount Cheque Details Section ");
                var l_discount_amt_array = document.getElementsByName('discount_amt[]');
                l_discount_amt_array[0].focus();
                return false;
            }
        } else {
            // This is very unrealistic Scenario this will occur only when some of the predefined Item in Payment Type will change.
            alert('Please Enter the Required Details in Cheque Details Section');
            return false;
        }

    } else if (l_chq_lr == "LR") {
        var l_total_goods_return_val = processBlanktoZero(document.getElementById('total_goods_return').value);

        if (l_total_goods_return_val > 0) {
            return true;
        } else {
            alert("Please Enter Goods Return Amount in Goods Return Details Section ");
            var l_goods_return_amt_array = document.getElementsByName('goods_return_amt[]');
            l_goods_return_amt_array[0].focus();
            return false;
        }

    } else {
        // This is very unrealistic Scenario this will occur only when some of the predefined Item in Payment Type will change.
        alert('Cheque Section or Goods Return Section not Available');
        return false;
    }
}
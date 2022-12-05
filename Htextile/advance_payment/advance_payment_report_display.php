<table  class="tbl_border" >

<tr><td align='right'>
<?php if($rep_print!="OK" && $rep_xls!="OK") {?>  
<input  type="button" class="form-button" onclick="excelDownLoad()" name="ls_dnload" value="Download Excel" />
<input  type="button" class="form-button" onclick="pdfDownLoad()" name="ls_dnload" value="Print" /> 
<?php }?>
<br>
</td></tr>

<tr><td>

<table border='1'>
<?php
$con=get_connection();



$sql="select * from txt_company where delete_tag='FALSE' order by company_id ASC";
$result=mysqli_query($con,$sql);

$rowcount=0;
// Creating Company Array with reverse Key Value Pair 
// because array_search function searched value and returns key
// first value Dummy to show the position of details
$company_array=array("Value"=>"Key"); 
while($rs=mysqli_fetch_array($result))
{

  $com_array=array($rs['firm_name']=>$rs['company_id']);
  $company_array=array_merge($company_array,$com_array);


  $rowcount++;

}
?>
    
<?php


$rep_supplier_code=$_REQUEST['supplier_account_code'];
$rep_buyer_code=$_REQUEST['buyer_account_code'];
$rep_bill_start_date=convert_date($_REQUEST['start_date']);
$rep_bill_end_date=convert_date($_REQUEST['end_date']);


$sql_pay="SELECT payment_entry_id,
                 manual_vou_number,
                 vou_type,
                 voucher_date,
                 buyer_account_code,
                 buy_firm_name,
                 supplier_account_code,
                 supp_firm_name,
                 payment_amount,
                 gr_amount 
                 FROM  txt_payment_entry_main, 
                     ( SELECT supp.company_id AS supp_company_id,
                                supp.firm_name AS supp_firm_name 
                        FROM txt_company AS supp 
                        WHERE supp.delete_tag='FALSE' 
                        AND firm_type='Supplier' 
                        ORDER BY firm_name) AS Supplier ,
                
                     ( SELECT buy.company_id AS buy_company_id,
                                buy.firm_name AS buy_firm_name 
                        FROM txt_company AS buy 
                        WHERE buy.delete_tag='FALSE' 
                        AND firm_type='Buyer' 
                        ORDER BY firm_name) AS Buyer 
WHERE delete_tag='FALSE'     
AND supplier_account_code=supp_company_id
AND buyer_account_code=buy_company_id 
AND (vou_type='Advance Payment' OR vou_type='GR After Payment' ) ";

if($rep_buyer_code!=''){
  $sql_pay.=" AND buyer_account_code='$rep_buyer_code'";
}

if($rep_supplier_code!=''){
  $sql_pay.=" AND supplier_account_code='$rep_supplier_code'";
}

if($rep_bill_start_date!=''){
  $sql_pay.=" AND voucher_date>='$rep_bill_start_date'";
}

if($rep_bill_end_date!=''){
  $sql_pay.=" AND voucher_date<='$rep_bill_end_date'";
}


$sql_pay.= " ORDER by supp_firm_name,buy_firm_name,voucher_date ";
;


$disp_buyer_name=array_search($rs['buyer_account_code'],$company_array);
//echo $sql_pay;
$result=mysqli_query($con,$sql_pay);
//echo $sql_pay;
$count=0;




?>


<tr>

<th> Payment <BR> Entry id
</th>
<th>Manual Vou <BR> Number
</th>
<th>Voucher Type
</th>
<th>Voucher Date
</th>
<th>Buyer Name
</th>
<th>Supplier Name
</th>

<th align='right'>Payment <BR> Amount
</th>
<th align='right'>Goods Return <BR> Amount
</th>


</tr>

<?php


if($result){
    while($rs= mysqli_fetch_array($result)){

        echo "<tr>";

        echo "<td>";
        echo $rs['payment_entry_id'];
        echo "</td>";

        echo "<td>";
        echo $rs['manual_vou_number'];
        echo "</td>";

        echo "<td>";
        echo $rs['vou_type'];
        echo "</td>";        

        echo "<td>";
        echo rev_convert_date($rs['voucher_date']);
        echo "</td>";

        echo "<td>";
        echo trim($rs['buy_firm_name']);
        echo "</td>";


        echo "<td>";
        echo trim($rs['supp_firm_name']);
        echo "</td>";

        
        echo "<td align='Right'>";
        echo zeroToBlank(number_format($rs['payment_amount'],2,'.',''));
        echo "</td>";
        
        echo "<td align='Right'>";
        echo zeroToBlank(number_format($rs['gr_amount'],2,'.',''));
        echo "</td>";        

        echo "</tr>";

    }
  }
    
    

?>

</table>

</td></tr></table>
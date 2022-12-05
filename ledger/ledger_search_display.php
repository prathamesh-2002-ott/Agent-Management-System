<table align='center' width='100%'  border='0' >

<tr><td align='right'>
<?php if($rep_print!="OK") {?>  
<input  type="button" class="form-button" onclick="excelDownLoad()" name="ls_dnload" value="Download Excel" />
<input  type="button" class="form-button" onclick="pdfDownLoad()" name="ls_dnload" value="Print" /> 
<?php }?>
<br>
</td></tr>

<tr><td>
<table width='100%' class="tbl_border_0" border='1'>
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


$rep_start_date=convert_date($_REQUEST['start_date']);
$rep_end_date=convert_date($_REQUEST['end_date']);



$sql_pay="";
$buyer_condition="";
if($rep_buyer_code!=''){
  $buyer_condition=" AND buyer_account_code='$rep_buyer_code' ";
}

$supplier_condition="";
if($rep_supplier_code!=''){
  $supplier_condition=" AND supplier_account_code='$rep_supplier_code' ";
}

$start_date="";
if($rep_start_date!=''){
  $start_date=" AND vou_date>='$rep_start_date' ";
}

$end_date="";
if($rep_end_date!=''){
  $end_date=" AND vou_date<='$rep_end_date' ";
}

$sql_ledger=" SELECT entry_id ,
                     vou_type,
                     pay_type,
                     bill_vou_date,
                     vou_date,
                     bill_number,
                     vou_number,
                     buyer_account_code,
                     buy_firm_name,
                     supplier_account_code,
                     supp_firm_name,
                     bill_amount,
                     pay_amt
                FROM 
                ( SELECT payment_entry_id AS entry_id, 
                         vou_type AS vou_type,
                         '' AS pay_type,
                         '' AS bill_vou_date,
                         voucher_date AS vou_date,
                         '' AS bill_number,
                         manual_vou_number AS vou_number,
                         buyer_account_code,
                         supplier_account_code,
                         '' AS bill_amount,
                         payment_amount AS pay_amt
                    FROM txt_payment_entry_main 
                    WHERE delete_tag='FALSE'  
                    AND payment_amount>0
                    $buyer_condition 
                    $supplier_condition

                    UNION

                    SELECT  payment_entry_id AS entry_id, 
                            vou_type AS vou_type,
                            'Discount' AS pay_type,
                            '' AS bill_vou_date,
                            voucher_date AS vou_date,
                            '' AS bill_number,
                            manual_vou_number AS vou_number,
                            buyer_account_code,
                            supplier_account_code,
                            '' AS bill_amount,
                            discount_amount AS pay_amt

                    FROM txt_payment_entry_main 
                    WHERE delete_tag='FALSE' AND discount_amount>0
                    $buyer_condition 
                    $supplier_condition

                    UNION
                
                    SELECT  payment_entry_id AS entry_id, 
                            vou_type AS vou_type,
                            '' AS pay_type,
                            '' AS bill_vou_date,
                            voucher_date AS vou_date,
                            '' AS bill_number,
                            manual_vou_number AS vou_number,
                            buyer_account_code,
                            supplier_account_code,
                            '' AS bill_amount,
                            gr_amount  AS pay_amt
                    FROM txt_payment_entry_main 
                    WHERE delete_tag='FALSE' AND gr_amount>0
                    $buyer_condition 
                    $supplier_condition

                    UNION
                    SELECT  bill_entry_id AS entry_id,
                            'Bill' AS vou_type,
                            '' AS pay_type,
                            voucher_date AS bill_vou_date,
                            bill_date AS vou_date,
                            bill_number AS bill_number,
                            voucher_number AS vou_number,
                            buyer_account_code,
                            supplier_account_code,
                            bill_amount,
                            '' AS pay_amt
                    FROM txt_bill_entry 
                    WHERE delete_tag='FALSE' 

                    $buyer_condition 
                    $supplier_condition
                ) AS ledger ,
                ( SELECT supp.company_id AS supp_company_id,
                         supp.firm_name AS supp_firm_name 
                  FROM txt_company AS supp 
                  WHERE supp.delete_tag='FALSE' 
                  AND firm_type='Supplier' 
                  ORDER BY firm_name) AS Supplier,
                ( SELECT buy.company_id AS buy_company_id,
                         buy.firm_name AS buy_firm_name 
                  FROM txt_company AS buy 
                  WHERE buy.delete_tag='FALSE' 
                  AND firm_type='Buyer' 
                  ORDER BY firm_name) AS Buyer
                WHERE supplier_account_code=supp_company_id
                AND buyer_account_code=buy_company_id

                $end_date
                ORDER BY vou_date ,vou_type ASC";


//                $start_date



//$disp_buyer_name=array_search($rs['buyer_account_code'],$company_array);
//echo $sql_pay;
//$result=mysqli_query($con,$sql_pay);
//$count=0;

//echo $sql_ledger;
$result=mysqli_query($con,$sql_ledger);

$col_span=3;
if($rep_xls=="OK" || $rep_print=="OK" ){
  $col_span=2;
}

?>


<tr>
    <th> Ledger : </th>

    <th colspan='<?php echo $col_span;?>'>
        Supplier : <?php echo array_search($_REQUEST['supplier_account_code'],$company_array); ?>
    </th>
 
    <th colspan='<?php echo $col_span;?>'>      
        Buyer : <?php echo array_search($_REQUEST['buyer_account_code'],$company_array); ?>
    </th>
</tr>

<tr>

<td align='center' colspan='<?php echo ($col_span*2)+1;?>'> <strong>Starting From : <?php echo $_REQUEST['start_date']?>  To : <?php echo $_REQUEST['end_date']?></strong> </td>
<?php
$curr_time=time()+19800; // Timestamp is in GMT now converted to IST
$curr_date=date('d-m-Y',$curr_time);
?>
</tr>
<tr>
<td align='center' colspan='<?php echo ($col_span*2)+1;?>'> <strong>As On <?php echo $curr_date;?></strong></td>

</tr>

<tr>

<!-- <th> Entry id
</th> -->

<?php /*
<th>Date
</th>

<th> Particulars
</th>
<!--
<th>Payment <BR> Type
</th>

<th>Bill <BR> Number
</th>
<th >Payment<BR> Vou Number
</th> -->
<!--
<th>Buyer Name
</th>
<th>Supplier Name
</th>
-->
<th align='right' >Bill Amount
</th>
<th align='right'>Payment <BR>  Amount
</th>
<th align='right'>Balance <BR> Amount
</th>

</tr>
*/
?>
<?php

$row_count=2;
$page_size=48;
$next_page_row_count=1;

$s_no=0;
$page_number=1;


$curr_time=time()+19800; // Timestamp is in GMT now converted to IST
$curr_date=date('d-m-Y',$curr_time);


$next_page_header="<tr> <th> Ledger : </th>
<th align='center' colspan='".($col_span)."'>
Supplier : ".array_search($_REQUEST['supplier_account_code'],$company_array)." 
</th>
<th align='center' colspan='".($col_span)."'> 
Buyer : ".array_search($_REQUEST['buyer_account_code'],$company_array)."
 </th> </tr>
 
 <td align='center' colspan='".(($col_span*2)+1)."'> 
 Starting From : ".$_REQUEST['start_date']." To : ". $_REQUEST['end_date']."&nbsp;&nbsp; As On".$curr_date ."</td>";



$row_start="<tr> ";

$row_header_disp =" <th>Edit
</th>
<th>View
</th> ";



$row_header_print =" <th>Date
</th>

<th> Particulars
</th>
<!--
<th>Payment <BR> Type
</th>

<th>Bill <BR> Number
</th>
<th >Payment<BR> Vou Number
</th> -->
<!--
<th>Buyer Name
</th>
<th>Supplier Name
</th>
-->
<th align='right' >Bill Amount
</th>
<th align='right'>Payment <BR>  Amount
</th>
<th align='right'>Balance <BR> Amount
</th>

</tr>";

echo $row_start;

if($rep_xls!="OK" && $rep_print!="OK" ){
  echo $row_header_disp;
} 

echo $row_header_print;


$bal_amt=0;
$bal_amount=0;
$opening_bal_print='NO';
while($rs= mysqli_fetch_array($result)){


if($rep_start_date!="" && $rs['vou_date']< $rep_start_date )
{
    $bal_amount +=blankToZero($rs['bill_amount']);
    $bal_amount -=blankToZero($rs['pay_amt']);

    $opening_bal_print='YES';

}else{
    if($opening_bal_print=='YES'){

      $col_span_2=$col_span*2;
      echo "<tr> <td colspan='$col_span_2' align='center'> Opening Balance </td><td ALIGN='RIGHT'>";
      echo zeroToBlank(number_format($bal_amount,2,'.',''));
      echo "</td></tr>";

        $opening_bal_print='NO';
    }

        // For Paging  - its been applied for every row 
        if($row_count>$page_size && $rep_print=="OK"){
          echo "</table>";
          echo "<p style='page-break-before: always'>";
          $page_number++;
          echo "<table width='100%' border='0' class='tbl_border_0'> <tr><td align='right' colspan='".(($col_span*2)+1)."'>Page ".$page_number." </td></tr> <tr><td colspan='".(($col_span*2)+1)."'>"; ?>
          <?php include("../includes/header_xls_next.php"); ?>           
          <?php
          echo "</td></tr>";
          echo $next_page_header;
          echo $row_start;
          echo $row_header_print;
          $row_count=$next_page_row_count;
        }else{
          $row_count++;
        }



    echo "<tr>";
/*
    echo "<td>";  
    echo $rs['entry_id'];
    echo "</td>";  
    */
    $entry_id=$rs['entry_id'];

    if($rep_xls!="OK" && $rep_print!="OK" ){

      if($rs['vou_type']=="Bill"){
          echo "<td align='center' >"; 
          //<a href='edit_bill_entry.php?bill_entry_id=$bill_entry_id'>Edit</a> 
          echo "<a href='javascript:createPopBill($entry_id)'><img src='../images/noun_project_edit_1.png' height='16' width='16' border='0' title='Edit' /></a>";
          //echo $rs['vou_type'];
          echo "</td>";  
          
          echo "<td align='center' >";  
          echo "<a href='javascript:createPopBillView($entry_id)'><img src='../images/noun_project_preview_1.png' height='16' width='16' border='0' title='View' /></a>";
          echo "</td>";  
      } else{
          echo "<td align='center'>"; 
          //<a href='edit_bill_entry.php?bill_entry_id=$bill_entry_id'>Edit</a> 
          echo "<a href='javascript:createPopPay($entry_id)'><img src='../images/noun_project_edit_1.png' height='16' width='16' border='0' title='Edit' /></a>";
          //echo $rs['vou_type'];
          echo "</td>";  
          
          echo "<td align='center'>";  
          echo "<a href='javascript:createPopPayView($entry_id)'><img src='../images/noun_project_preview_1.png' height='16' width='16' border='0' title='View' /></a>";
          echo "</td>";  
      }    
    }

    echo "<td>&nbsp;";  
    echo rev_convert_date($rs['vou_date']);
    echo "&nbsp;</td>";  

    if($rs['vou_type']=="Bill"){
      echo "<td>&nbsp;";  
      echo $rs['vou_type'] . "---" .$rs['bill_number'];
      echo "&nbsp;</td>"; 
  

    } else {

      echo "<td>&nbsp;";  
      echo $rs['vou_type'] . "-" . $rs['pay_type'] . "--" . $rs['vou_number'] ;
      echo "&nbsp;</td>"; 
    }
    
/*
    echo "<td>";  
    echo $rs['vou_type'];
    echo "</td>";  

    echo "<td>";  
    echo $rs['pay_type'];
    echo "</td>";  



    echo "<td>";  
    echo $rs['bill_number'];
    echo "</td>";  

    echo "<td>";  
    echo $rs['vou_number'];
    echo "</td>";  
*/
    //echo "<td>";  
    //echo $rs['buy_firm_name'];
    //echo "</td>";  

    //echo "<td>";  
    //echo $rs['supp_firm_name'];
    //echo "</td>";  

    echo "<td ALIGN='RIGHT'>&nbsp;";  
    echo zeroToBlank(number_format(blankToZero($rs['bill_amount']),2,'.',''));
    echo "&nbsp;</td>";  

    echo "<td ALIGN='RIGHT'>&nbsp;";  
    echo zeroToBlank(number_format(blankToZero($rs['pay_amt']),2,'.',''));
    echo "&nbsp;</td>";  

    $bal_amount +=blankToZero($rs['bill_amount']);
    $bal_amount -=blankToZero($rs['pay_amt']);

    echo "<td ALIGN='RIGHT'>&nbsp;";  
    echo zeroToBlank(number_format($bal_amount,2,'.',''));
    echo "&nbsp;</td>";  

    echo "</tr>";
}

} // end While
if($opening_bal_print=='YES'){
    
    $col_span_2=$col_span*2;
    echo "<tr> <td colspan='$col_span_2' align='center'> Opening Balance </td><td ALIGN='RIGHT'>";
    echo zeroToBlank(number_format($bal_amount,2,'.',''));
    echo "</td></tr>";

  $opening_bal_print='NO';
}

  /*
    while($rs= mysqli_fetch_array($result)){

        if($old_bill_entry_id!=0 && $rs['bill_entry_id']!=$old_bill_entry_id){
          echo "<td align='Right'>";  
          echo $old_bal_amt;
          echo "</td>";
          echo "</tr>";
          $bal_sub_total+=$old_bal_amt;
          $bal_sub_page_total+=$old_bal_amt;
          $bal_page_total+=$old_bal_amt;

        }else if($old_bill_entry_id!=0){
          echo "<td>";  
          
          echo "</td>";
          echo "</tr>";
        } else if($old_bill_entry_id==0){

        }

        if($rs['buyer_account_code']!=$old_buyer_code && $old_bill_entry_id!=0){
          echo "<tr> <td  colspan='5' align='Right' >Buyer Sub Total</td> 
          <td align='Right' ><b>".zeroToBlank(number_format($bill_sub_total,2,'.',''))."</b></td>
          <td  align='Right'> </td>
          <td  align='Right'><b>".zeroToBlank(number_format($dis_sub_total,2,'.',''))."</b></td>
          <td  align='Right'><b>".zeroToBlank(number_format($gr_sub_total,2,'.',''))."</b> </td>
          <td  align='Right'><b>".zeroToBlank(number_format($payment_sub_total,2,'.',''))."</b> </td>
          <td align='Right'><b>".zeroToBlank(number_format($bal_sub_total,2,'.',''))."</b> </td>
          </tr>";
          $bal_sub_total=0;
          $bill_sub_total=0;
          $dis_sub_total=0;
          $gr_sub_total=0;
          $payment_sub_total=0;
        }
        if($rs['supplier_account_code']!=$old_supplier_code && $old_bill_entry_id!=0){
            echo "<tr> <td  colspan='5' align='Right' >Supplier Sub Total</td> 
            <td align='Right' ><b>".zeroToBlank(number_format($bill_sub_page_total,2,'.',''))."</b></td>
            <td  align='Right'> </td>
            <td  align='Right'><b>".zeroToBlank(number_format($dis_sub_page_total,2,'.',''))."</b></td>
            <td  align='Right'><b>".zeroToBlank(number_format($gr_sub_page_total,2,'.',''))."</b> </td>
            <td  align='Right'><b>".zeroToBlank(number_format($payment_sub_page_total,2,'.',''))."</b> </td>
            <td align='Right'><b>".zeroToBlank(number_format($bal_sub_page_total,2,'.',''))."</b> </td>
            </tr>";
            $bal_sub_page_total=0;
            $bill_sub_page_total=0;
            $dis_sub_page_total=0;
            $gr_sub_page_total=0;
            $payment_sub_page_total=0;
          }        

        echo "<tr>";

        

        echo "<td>";
        echo $rs['bill_entry_id'];
        echo "</td>";

        echo "<td>";
        echo $rs['bill_number'];
        echo "</td>";

        echo "<td>";
        echo rev_convert_date($rs['bill_date']);
        echo "</td>";

        echo "<td>";
        echo array_search($rs['supplier_account_code'],$company_array);
        echo "</td>";

        echo "<td>";
        echo array_search($rs['buyer_account_code'],$company_array);
        echo "</td>";
        
        echo "<td align='Right'>";
        if($rs['bill_entry_id']!=$old_bill_entry_id){
          echo zeroToBlank(number_format($rs['bill_amount'],2,'.',''));
          $bill_sub_total+=$rs['bill_amount'];
          $bill_sub_page_total+=$rs['bill_amount'];
          $bill_page_total+=$rs['bill_amount'];
        }
        echo "</td>";
        

        echo "<td>";
        echo rev_convert_date($rs['payment_entry_vou_date']);
        echo "</td>";        
        
        $disp_dis=$rs['dis_amount']+$rs['deduction_amount'];
        echo "<td align='Right'>";
        echo zeroToBlank(number_format($disp_dis,2,'.',''));
        echo "</td>";  
        $dis_sub_total+=$disp_dis;      
        $dis_sub_page_total+= $disp_dis;       
        $dis_page_total+=$disp_dis;        
        
        
        //echo "<td>";
        //echo $rs['deduction_amount'];
        //echo "</td>";   
        

        echo "<td align='Right'>";
        echo zeroToBlank(number_format($rs['bill_gr_amt'],2,'.',''));
        echo "</td>";   
        $gr_sub_total+=$rs['bill_gr_amt'];
        $gr_sub_page_total+=$rs['bill_gr_amt'];
        $gr_page_total+=$rs['bill_gr_amt'];

        echo "<td align='Right'>";
        echo zeroToBlank(number_format($rs['payment_received'],2,'.',''));
        echo "</td>";  
        $payment_sub_total+= $rs['payment_received'];
        $payment_sub_page_total+=$rs['payment_received'];
        $payment_page_total+= $rs['payment_received'];

        
        //if($old_bill_entry_id!=0){        
        //  echo "<td>";
        //  echo $rs['balance_amount'];
        //  echo "</td>";  
        //  echo "</tr>";
        //}
        
        if(is_null($rs['balance_amount'])){
          $old_bal_amt=$rs['bill_amount'];
        }else{
          $old_bal_amt=$rs['balance_amount'];
        }
        
        $old_bill_entry_id=$rs['bill_entry_id'];
        $old_buyer_code=$rs['buyer_account_code'];
        $old_supplier_code=$rs['supplier_account_code'];


    }
    
    echo "<td align='Right'>";  
    echo $old_bal_amt;
    echo "</td>";
    echo "</tr>";
    $bal_sub_total+=$old_bal_amt;
    $bal_sub_page_total+=$old_bal_amt;
    $bal_page_total+=$old_bal_amt;

    
    echo "<tr> <td  colspan='5' align='Right' >Buyer Sub Total</td> 
    <td align='Right' ><b>".zeroToBlank(number_format($bill_sub_total,2,'.',''))."</b></td>
    <td  align='Right'> </td>
    <td  align='Right'><b>".zeroToBlank(number_format($dis_sub_total,2,'.',''))."</b></td>
    <td  align='Right'><b>".zeroToBlank(number_format($gr_sub_total,2,'.',''))."</b> </td>
    <td  align='Right'><b>".zeroToBlank(number_format($payment_sub_total,2,'.',''))."</b> </td>
    <td align='Right'><b>".zeroToBlank(number_format($bal_sub_total,2,'.',''))."</b> </td>
    </tr>";

    echo "<tr> <td  colspan='5' align='Right' >Supplier Sub Total</td> 
    <td align='Right' ><b>".zeroToBlank(number_format($bill_sub_page_total,2,'.',''))."</b></td>
    <td  align='Right'> </td>
    <td  align='Right'><b>".zeroToBlank(number_format($dis_sub_page_total,2,'.',''))."</b></td>
    <td  align='Right'><b>".zeroToBlank(number_format($gr_sub_page_total,2,'.',''))."</b> </td>
    <td  align='Right'><b>".zeroToBlank(number_format($payment_sub_page_total,2,'.',''))."</b> </td>
    <td align='Right'><b>".zeroToBlank(number_format($bal_sub_page_total,2,'.',''))."</b> </td>
    </tr>";
    

    echo "<tr> <td  colspan='5' align='Right' ><b>Gross Total</b></td> 
    <td align='Right' ><b>".zeroToBlank(number_format($bill_page_total,2,'.',''))."</b></td>
    <td  align='Right'> </td>
    <td  align='Right'><b>".zeroToBlank(number_format($dis_page_total,2,'.',''))."</b></td>
    <td  align='Right'><b>".zeroToBlank(number_format($gr_page_total,2,'.',''))."</b> </td>
    <td  align='Right'><b>".zeroToBlank(number_format($payment_page_total,2,'.',''))."</b> </td>
    <td align='Right'><b>".zeroToBlank(number_format($bal_page_total,2,'.',''))."</b> </td>
    </tr>";

    */

/*
SELECT payment_entry_id AS entry_id, 
	vou_type AS vou_type,
	'' AS bill_vou_date,
	voucher_date AS vou_date,
	'' AS bill_number,
	manual_vou_number AS vou_number,
	buyer_account_code,
	supplier_account_code,
	'' AS bill_amount,
	payment_amount,
	discount_amount,
	gr_amount 
FROM txt_payment_entry_main
UNION
SELECT bill_entry_id AS entry_id,
	'Bill' AS vou_type,
	voucher_date AS bill_vou_date,
	bill_date AS vou_date,
	bill_number AS bill_number,
	voucher_number AS vou_number,
	buyer_account_code,
	supplier_account_code,
	bill_amount,
	'' AS payment_amount,
	'' AS iscount_amount,
	'' AS gr_amount
FROM txt_bill_entry

ORDER BY vou_date

*/


//	echo $rs[0];
  /*
  for($a=0;$a<sizeof($companyRow);$a++){

    if($rs['supplier_account_code']==$companyRow[$a][0]){
      $disp_supp_name=$companyRow[$a][1];
    }
    if($rs['buyer_account_code']==$companyRow[$a][0]){
      $disp_buyer_name=$companyRow[$a][1];
    }
*/
    


 // }


//}
?>

</table>

</td></tr></table>

<?php

        /*
SELECT * FROM 
	(SELECT voucher_date, 
		bill_entry_id, 
		bill_number, 
		bill_date, 
		supplier_account_code, 
		supp_firm_name,
		buyer_account_code, 
		buy_firm_name,
		bill_amount 
		FROM txt_bill_entry ,( SELECT supp.company_id AS supp_company_id,
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
		ORDER BY  supp_firm_name,buy_firm_name,bill_date ) AS t1 
LEFT JOIN (SELECT bill_entry_id AS t2_bill_entry_id , 
		payment_entry_id, 
		payment_entry_vou_date, 
		dis_amount, 
		deduction_amount, 
		bill_gr_amt, 
		payment_received, 
		balance_amount 
		FROM txt_payment_bill_entry 
		WHERE delete_tag='FALSE' ) AS t2 ON t1.bill_entry_id=t2.t2_bill_entry_id


        SELECT payment_entry_id AS entry_id, 
	vou_type AS vou_type,
	'' AS bill_vou_date,
	voucher_date AS vou_date,
	'' AS bill_number,
	manual_vou_number AS vou_number,
	buyer_account_code,
	supplier_account_code,
	'' AS bill_amount,
	payment_amount,
	discount_amount,
	gr_amount 
FROM txt_payment_entry_main
WHERE  buyer_account_code='52'AND supplier_account_code='8'
UNION
SELECT bill_entry_id AS entry_id,
	'Bill' AS vou_type,
	voucher_date AS bill_vou_date,
	bill_date AS vou_date,
	bill_number AS bill_number,
	voucher_number AS vou_number,
	buyer_account_code,
	supplier_account_code,
	bill_amount,
	'' AS payment_amount,
	'' AS iscount_amount,
	'' AS gr_amount
FROM txt_bill_entry
WHERE  buyer_account_code='52'AND supplier_account_code='8'

ORDER BY vou_date



SELECT payment_entry_id AS entry_id, 
	vou_type AS vou_type,
	'' AS bill_vou_date,
	voucher_date AS vou_date,
	'' AS bill_number,
	manual_vou_number AS vou_number,
	buyer_account_code,
	buy_firm_name,
	supplier_account_code,
	supp_firm_name,
	'' AS bill_amount,
	payment_amount,
	discount_amount,
	gr_amount 
FROM txt_payment_entry_main ,( SELECT supp.company_id AS supp_company_id,
						supp.firm_name AS supp_firm_name 
					FROM txt_company AS supp 
					WHERE supp.delete_tag='FALSE' 
					AND firm_type='Supplier' 
					ORDER BY firm_name) AS Supplier,
					( SELECT buy.company_id AS buy_company_id,
						buy.firm_name AS buy_firm_name 
					FROM txt_company AS buy 
					WHERE buy.delete_tag='FALSE' 
					AND firm_type='Buyer' 
					ORDER BY firm_name) AS Buyer
WHERE delete_tag='FALSE' 
    AND supplier_account_code=supp_company_id
    AND buyer_account_code=buy_company_id
AND  buyer_account_code='52'AND supplier_account_code='8'
UNION
SELECT bill_entry_id AS entry_id,
	'Bill' AS vou_type,
	voucher_date AS bill_vou_date,
	bill_date AS vou_date,
	bill_number AS bill_number,
	voucher_number AS vou_number,
	buyer_account_code,
	buy_firm_name,
	supplier_account_code,
	supp_firm_name,
	bill_amount,
	'' AS payment_amount,
	'' AS iscount_amount,
	'' AS gr_amount
FROM txt_bill_entry ,( SELECT supp.company_id AS supp_company_id,
						supp.firm_name AS supp_firm_name 
					FROM txt_company AS supp 
					WHERE supp.delete_tag='FALSE' 
					AND firm_type='Supplier' 
					ORDER BY firm_name) AS Supplier,
					( SELECT buy.company_id AS buy_company_id,
						buy.firm_name AS buy_firm_name 
					FROM txt_company AS buy 
					WHERE buy.delete_tag='FALSE' 
					AND firm_type='Buyer' 
					ORDER BY firm_name) AS Buyer
WHERE delete_tag='FALSE' 
AND supplier_account_code=supp_company_id
AND buyer_account_code=buy_company_id
AND   buyer_account_code='52'AND supplier_account_code='8'

ORDER BY vou_date

        */

        /*
        SELECT entry_id ,
	vou_type,
    pay_type,
	bill_vou_date,
	vou_date,
	bill_number,
	vou_number,
	buyer_account_code,
	buy_firm_name,
	supplier_account_code,
	supp_firm_name,
	bill_amount,
    pay_amt
 FROM 
(

SELECT payment_entry_id AS entry_id, 
	vou_type AS vou_type,
	'Payment' AS pay_type,
	'' AS bill_vou_date,
	voucher_date AS vou_date,
	'' AS bill_number,
	manual_vou_number AS vou_number,
	buyer_account_code,
	supplier_account_code,
	'' AS bill_amount,
	payment_amount AS pay_amt
FROM txt_payment_entry_main 
WHERE delete_tag='FALSE'  AND payment_amount>0

AND  buyer_account_code='52'AND supplier_account_code='8'

UNION


SELECT payment_entry_id AS entry_id, 
	vou_type AS vou_type,
	'Discount' AS pay_type,
	'' AS bill_vou_date,
	voucher_date AS vou_date,
	'' AS bill_number,
	manual_vou_number AS vou_number,
	buyer_account_code,
	supplier_account_code,
	'' AS bill_amount,
	discount_amount AS pay_amt

FROM txt_payment_entry_main 
WHERE delete_tag='FALSE' AND discount_amount>0

AND  buyer_account_code='52'AND supplier_account_code='8'

 UNION
SELECT payment_entry_id AS entry_id, 
	vou_type AS vou_type,
	'Goods Return' AS pay_type,
	'' AS bill_vou_date,
	voucher_date AS vou_date,
	'' AS bill_number,
	manual_vou_number AS vou_number,
	buyer_account_code,
	supplier_account_code,
	'' AS bill_amount,
	gr_amount  AS pay_amt
FROM txt_payment_entry_main 
WHERE delete_tag='FALSE' AND gr_amount>0

AND  buyer_account_code='52'AND supplier_account_code='8'

UNION
SELECT bill_entry_id AS entry_id,
	'Bill' AS vou_type,
	'' AS pay_type,
	voucher_date AS bill_vou_date,
	bill_date AS vou_date,
	bill_number AS bill_number,
	voucher_number AS vou_number,
	buyer_account_code,
	supplier_account_code,
	bill_amount,
	'' AS pay_amt
FROM txt_bill_entry 
WHERE delete_tag='FALSE' 

AND   buyer_account_code='52'AND supplier_account_code='8'



) AS ledger ,
( SELECT supp.company_id AS supp_company_id,
						supp.firm_name AS supp_firm_name 
					FROM txt_company AS supp 
					WHERE supp.delete_tag='FALSE' 
					AND firm_type='Supplier' 
					ORDER BY firm_name) AS Supplier,
					( SELECT buy.company_id AS buy_company_id,
						buy.firm_name AS buy_firm_name 
					FROM txt_company AS buy 
					WHERE buy.delete_tag='FALSE' 
					AND firm_type='Buyer' 
					ORDER BY firm_name) AS Buyer
WHERE 
supplier_account_code=supp_company_id
AND buyer_account_code=buy_company_id

ORDER BY vou_date
        */


?>
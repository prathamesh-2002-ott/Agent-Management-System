<table   border='0'  >

<tr><td align='right'>
<?php if($rep_print!="OK" && $rep_xls!="OK") {?>
<input  type="button" class="form-button" onclick="excelDownLoad()" name="ls_dnload" value="Download Excel" />
<input  type="button" class="form-button" onclick="pdfDownLoad()" name="ls_dnload" value="Print" /> 
<?php }?>
<br>
</td></tr>

<tr><td>
<table  width='100%' class="tbl_border_0" border='1' >
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

$report_type=$_REQUEST['report_type'];

if($report_type=="FIRM"){
  $rep_supplier_code=$_REQUEST['supplier_account_code'];
  $rep_buyer_code=$_REQUEST['buyer_account_code'];
}
if($report_type=="GROUP"){
    $rep_supplier_code=$_REQUEST['supplier_group_code'];
    $rep_buyer_code=$_REQUEST['buyer_group_code'];
}


$rep_bill_start_date=convert_date($_REQUEST['bill_start_date']);
$rep_bill_end_date=convert_date($_REQUEST['bill_end_date']);


$sql_pay="SELECT * FROM 
(SELECT voucher_date, bill_entry_id,
  bill_number,
  bill_date,
  supplier_account_code,
  Supplier.firm_name AS supp_firm_name,
  buyer_account_code,
  Buyer.firm_name AS buy_firm_name,
  bill_amount 
FROM txt_bill_entry ,view_supplier AS Supplier ,
					
					view_buyer AS Buyer
    WHERE txt_bill_entry.delete_tag='FALSE'
    AND supplier_account_code=Supplier.company_id
    AND buyer_account_code=Buyer.company_id ";

if($report_type=="FIRM"){

    if($rep_buyer_code!=''){
      $sql_pay.=" AND buyer_account_code='$rep_buyer_code'";
    }

    if($rep_supplier_code!=''){
      $sql_pay.=" AND supplier_account_code='$rep_supplier_code'";
    }
}

if($report_type=="GROUP"){
    if($rep_buyer_code!=''){
      $sql_pay.=" AND Buyer.group_id='$rep_buyer_code'";
    }

    if($rep_supplier_code!=''){
      $sql_pay.=" AND Supplier.group_id='$rep_supplier_code'";
    }
}



/*
if($rep_bill_start_date!=''){
  $sql_pay.=" AND bill_date>='$rep_bill_start_date'";
}
if($rep_bill_end_date!=''){
  $sql_pay.=" AND bill_date<='$rep_bill_end_date'";
}
*/

$sql_pay.= " ORDER by supp_firm_name,buy_firm_name,bill_number,bill_date ) AS t1
        JOIN 
        (SELECT bill_entry_id AS t2_bill_entry_id ,
        payment_entry_id,
        payment_entry_vou_date,
        dis_amount,
        deduction_amount,
        bill_gr_amt,
        payment_received,
        balance_amount 
        FROM txt_payment_bill_entry 
        WHERE delete_tag='FALSE' ";
        if($rep_bill_start_date!=''){
          $sql_pay.=" AND payment_entry_vou_date>='$rep_bill_start_date'";
        }
        if($rep_bill_end_date!=''){
          $sql_pay.=" AND payment_entry_vou_date<='$rep_bill_end_date'";
        }

$sql_pay.= " ) AS t2 
        ON t1.bill_entry_id=t2.t2_bill_entry_id";
//AND bill_gr_amt =0
$sql_pay.=" UNION

            SELECT voucher_date,
                    '-1' AS bill_entry_id, 
                    '' AS bill_number,
                    '' AS bill_date,
                    supplier_account_code,
                    supp_firm_name,
                    buyer_account_code,
                    buy_firm_name,
                    '' AS bill_amount,
                    '' AS t2_bill_entry_id,
                    payment_entry_id,
                    voucher_date AS payment_entry_vou_date,
                    discount_amount AS dis_amount,
                    '' AS deduction_amount,
                    gr_amount AS bill_gr_amt,
                    payment_amount AS payment_received,
                    '' AS balance_amount
                
                    FROM (
            SELECT payment_entry_id,
                    manual_vou_number,
                    voucher_date,
                    buyer_account_code,
                    supplier_account_code,
                    vou_type,
                    payment_amount,
                    discount_amount,
                    gr_amount,
                    Supplier.firm_name AS supp_firm_name,
                    Buyer.firm_name AS buy_firm_name
            FROM txt_payment_entry_main ,view_supplier AS Supplier ,
                                
                                view_buyer AS Buyer					
                    WHERE txt_payment_entry_main.delete_tag='FALSE' 
                    AND vou_type IN('Advance Payment','GR After Payment')
                    AND supplier_account_code=Supplier.company_id
                    AND buyer_account_code=Buyer.company_id ";

    if($report_type=="FIRM"){                    
        
        if($rep_buyer_code!=''){
            $sql_pay.=" AND buyer_account_code='$rep_buyer_code'";
          }
          
          if($rep_supplier_code!=''){
            $sql_pay.=" AND supplier_account_code='$rep_supplier_code'";
          }
    }
    if($report_type=="GROUP"){
      if($rep_buyer_code!=''){
        $sql_pay.=" AND Buyer.group_id='$rep_buyer_code'";
      }
  
      if($rep_supplier_code!=''){
        $sql_pay.=" AND Supplier.group_id='$rep_supplier_code'";
      }
  }

          if($rep_bill_start_date!=''){
            $sql_pay.=" AND voucher_date>='$rep_bill_start_date'";
          }
          if($rep_bill_end_date!=''){
            $sql_pay.=" AND voucher_date<='$rep_bill_end_date'";
          }          


$sql_pay.="ORDER BY  supp_firm_name,buy_firm_name 
    ) AS t3  
    ORDER by payment_entry_vou_date,supp_firm_name,buy_firm_name , bill_number";

$disp_buyer_name=array_search($rs['buyer_account_code'],$company_array);
//echo $sql_pay;
$result=mysqli_query($con,$sql_pay);
$count=0;



        /*
SELECT voucher_date, 
		bill_entry_id, 
		bill_number, 
		bill_date, 
		supplier_account_code, 
		supp_firm_name,
		buyer_account_code, 
		buy_firm_name,
		bill_amount ,
		t2_bill_entry_id , 
		payment_entry_id, 
		payment_entry_vou_date, 
		dis_amount, 
		deduction_amount, 
		bill_gr_amt, 
		payment_received, 
		balance_amount 
		FROM 
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
JOIN (SELECT bill_entry_id AS t2_bill_entry_id , 
		payment_entry_id, 
		payment_entry_vou_date, 
		dis_amount, 
		deduction_amount, 
		bill_gr_amt, 
		payment_received, 
		balance_amount 
		FROM txt_payment_bill_entry 
		WHERE delete_tag='FALSE' AND bill_gr_amt =0  ) AS t2 ON t1.bill_entry_id=t2.t2_bill_entry_id
		
UNION

SELECT voucher_date,
		'' AS bill_entry_id, 
		'' AS bill_number,
		'' AS bill_number,
		supplier_account_code,
		supp_firm_name,
		buyer_account_code,
		buy_firm_name,
		'' AS bill_amount,
		'' AS t2_bill_entry_id,
		payment_entry_id,
		voucher_date AS payment_entry_vou_date,
		discount_amount AS dis_amount,
		'' AS deduction_amount,
		gr_amount AS bill_gr_amt,
		payment_amount AS payment_received,
		'' AS balance_amount
	
		FROM (
SELECT payment_entry_id,
		manual_vou_number,
		voucher_date,
		buyer_account_code,
		supplier_account_code,
		vou_type,
		payment_amount,
		discount_amount,
		gr_amount,
		supp_firm_name,
		buy_firm_name
 FROM txt_payment_entry_main ,( SELECT supp.company_id AS supp_company_id,
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
		AND vou_type='Advance Payment' 
		AND supplier_account_code=supp_company_id
		AND buyer_account_code=buy_company_id
		ORDER BY  supp_firm_name,buy_firm_name
		) AS t3

        */

?>
<?php
$next_page_header ="
<tr>
  <td colspan='11' align='center'><h3> Payment & GR Report </h3></td>
    </tr>

";

$row_header=" <tr>
<td> Bill <BR> Entry id
</td>
<td>Bill <BR> Number
</td>
<td width='75'>Bill Date
</td>
<td width='200'>Supplier Name
</td>
<td width='200' >Buyer Name
</td>
<td align='right'>Bill <BR> Amount
</td>
<td width='75'>Payment Date
</td>
<td>Discount
</td>
<td align='right' >Goods <BR> Return
</td>
<td align='right'>Payment <BR> Amount
</td>
<td align='right'>Balance <BR> Amount
</td>

</tr>
";

$header=$next_page_header . $row_header;
echo $header;
?>
<?php



    $old_bill_entry_id=0;
    $old_bal_amt=0;

    $old_buyer_code=0;
    $old_supplier_code=0;
    
    $bill_sub_total=0;
    $bill_sub_page_total=0;
    $bill_page_total=0;
    
    $bal_sub_total=0;
    $bal_sub_page_total=0;
    $bal_page_total=0;

    $dis_sub_total=0;
    $dis_sub_page_total=0;
    $dis_page_total=0;

    $gr_sub_total=0;
    $gr_sub_page_total=0;
    $gr_page_total=0;

    $payment_sub_total=0;
    $payment_sub_page_total=0;
    $payment_page_total=0;


    $row_count=2;
    $page_size=34;
    $next_page_row_count=2;

    $s_no=0;
    $page_number=1;

    $string_disp=25;
      if($download=='XLS'){
        $string_disp=100;
      }

    while($rs= mysqli_fetch_array($result)){

        if(($old_bill_entry_id!=0 && $rs['bill_entry_id']!=$old_bill_entry_id) || $rs['bill_entry_id']=="-1" ){
          echo "<td align='Right'>";  
          echo number_format($old_bal_amt,2,'.','');
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

        // For Paging  - its been applied for every row 
        if($row_count>$page_size && $rep_print=="OK"){
          echo "</table>";
          echo "<p style='page-break-before: always'>";
          $page_number++;
          echo "<table width='100%' border='0' class='tbl_border_0'> <tr><td align='right' colspan='11'>Page ".$page_number." </td></tr> <tr><td colspan='11'>"; ?>
          <?php include("../includes/header_xls_next.php"); ?>           
          <?php
          echo "</td></tr>";
          echo $next_page_header;
          echo $row_header;
          $row_count=$next_page_row_count;
        }else{
          $row_count++;
        } 

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

        // For Paging  - its been applied for every row 
        if($row_count>$page_size && $rep_print=="OK"){
          echo "</table>";
          echo "<p style='page-break-before: always'>";
          $page_number++;
          echo "<table width='100%' border='0' class='tbl_border_0'> <tr><td align='right' colspan='11'>Page ".$page_number." </td></tr> <tr><td colspan='11'>"; ?>
          <?php include("../includes/header_xls_next.php"); ?>           
          <?php
          echo "</td></tr>";
          echo $next_page_header;
          echo $row_header;
          $row_count=$next_page_row_count;
        }else{
          $row_count++;
        }           


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
          
          
        // For Paging  - its been applied for every row 
        if($row_count>$page_size && $rep_print=="OK"){
          echo "</table>";
          echo "<p style='page-break-before: always'>";
          $page_number++;
          echo "<table width='100%' border='0' class='tbl_border_0'> <tr><td align='right' colspan='11'>Page ".$page_number." </td></tr> <tr><td colspan='11'>"; ?>
          <?php include("../includes/header_xls_next.php"); ?>           
          <?php
          echo "</td></tr>";
          echo $next_page_header;
          echo $row_header;
          $row_count=$next_page_row_count;
        }else{
          $row_count++;
        }          

        echo "<tr>";

        echo "<td>";
        if($rs['bill_entry_id']=='-1'){
            echo "Adv";
        }else{
            echo $rs['bill_entry_id'];
        }
        echo "</td>";        

        echo "<td>";
        echo $rs['bill_number'];
        echo "</td>";

        echo "<td>";
        echo rev_convert_date($rs['bill_date']);
        echo "</td>";

        //substr(trim($rs['supp_firm_name']),0,$string_disp);
        echo "<td>";
        echo substr(trim($rs['supp_firm_name']),0,$string_disp);
        echo "</td>";

        echo "<td>";
        echo substr(trim($rs['buy_firm_name']),0,$string_disp);
        echo "</td>";
        
        echo "<td align='Right'>";
        if($rs['bill_entry_id']!=$old_bill_entry_id){
          echo zeroToBlank(number_format((int)$rs['bill_amount'],2,'.',''));
          $bill_sub_total+=(int)$rs['bill_amount'];
          $bill_sub_page_total+=(int)$rs['bill_amount'];
          $bill_page_total+=(int)$rs['bill_amount'];
        }
        echo "</td>";
        

        echo "<td>";
        echo rev_convert_date($rs['payment_entry_vou_date']);
        echo "</td>";        
        
        $disp_dis=(int)$rs['dis_amount']+(int)$rs['deduction_amount'];
        echo "<td align='Right'>";
        echo zeroToBlank(number_format($disp_dis,2,'.',''));
        echo "</td>";  
        $dis_sub_total+=$disp_dis;      
        $dis_sub_page_total+= $disp_dis;       
        $dis_page_total+=$disp_dis;        
        
        /*
        echo "<td>";
        echo $rs['deduction_amount'];
        echo "</td>";   
        */

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

        /*
        if($old_bill_entry_id!=0){        
          echo "<td>";
          echo $rs['balance_amount'];
          echo "</td>";  
          echo "</tr>";
        }
        */
        if(is_null($rs['balance_amount'])){
          $old_bal_amt=$rs['bill_amount'];
        }else{
          $old_bal_amt=$rs['balance_amount'];
        }
        if($rs['bill_amount']==""){
            if($rs['payment_received']==0){
                $old_bal_amt= zeroToBlank(number_format(($rs['bill_gr_amt'] * -1),2,'.',''));;           
            }else{
                $old_bal_amt= zeroToBlank(number_format(($rs['payment_received'] * -1),2,'.',''));;           
            }

        }
        
        $old_bill_entry_id=$rs['bill_entry_id'];
        $old_buyer_code=$rs['buyer_account_code'];
        $old_supplier_code=$rs['supplier_account_code'];


    }
    
    echo "<td align='Right'>";  
    echo number_format($old_bal_amt,2,'.','');
    echo "</td>";
    echo "</tr>";
    $bal_sub_total+=$old_bal_amt;
    $bal_sub_page_total+=$old_bal_amt;
    $bal_page_total+=$old_bal_amt;


            // For Paging  - its been applied for every row 
            if($row_count>$page_size && $rep_print=="OK"){
              echo "</table>";
              echo "<p style='page-break-before: always'>";
              $page_number++;
              echo "<table width='100%' border='0' class='tbl_border_0'> <tr><td align='right' colspan='11'>Page ".$page_number." </td></tr> <tr><td colspan='11'>"; ?>
              <?php include("../includes/header_xls_next.php"); ?>           
              <?php
              echo "</td></tr>";
              echo $next_page_header;
              echo $row_header;
              $row_count=$next_page_row_count;
            }else{
              $row_count++;
            } 
    
    echo "<tr> <td  colspan='5' align='Right' >Buyer Sub Total</td> 
    <td align='Right' ><b>".zeroToBlank(number_format($bill_sub_total,2,'.',''))."</b></td>
    <td  align='Right'> </td>
    <td  align='Right'><b>".zeroToBlank(number_format($dis_sub_total,2,'.',''))."</b></td>
    <td  align='Right'><b>".zeroToBlank(number_format($gr_sub_total,2,'.',''))."</b> </td>
    <td  align='Right'><b>".zeroToBlank(number_format($payment_sub_total,2,'.',''))."</b> </td>
    <td align='Right'><b>".zeroToBlank(number_format($bal_sub_total,2,'.',''))."</b> </td>
    </tr>";

        // For Paging  - its been applied for every row 
        if($row_count>$page_size && $rep_print=="OK"){
          echo "</table>";
          echo "<p style='page-break-before: always'>";
          $page_number++;
          echo "<table width='100%' border='0' class='tbl_border_0'> <tr><td align='right' colspan='11'>Page ".$page_number." </td></tr> <tr><td colspan='11'>"; ?>
          <?php include("../includes/header_xls_next.php"); ?>           
          <?php
          echo "</td></tr>";
          echo $next_page_header;
          echo $row_header;
          $row_count=$next_page_row_count;
        }else{
          $row_count++;
        } 

    echo "<tr> <td  colspan='5' align='Right' >Supplier Sub Total</td> 
    <td align='Right' ><b>".zeroToBlank(number_format($bill_sub_page_total,2,'.',''))."</b></td>
    <td  align='Right'> </td>
    <td  align='Right'><b>".zeroToBlank(number_format($dis_sub_page_total,2,'.',''))."</b></td>
    <td  align='Right'><b>".zeroToBlank(number_format($gr_sub_page_total,2,'.',''))."</b> </td>
    <td  align='Right'><b>".zeroToBlank(number_format($payment_sub_page_total,2,'.',''))."</b> </td>
    <td align='Right'><b>".zeroToBlank(number_format($bal_sub_page_total,2,'.',''))."</b> </td>
    </tr>";
    

        // For Paging  - its been applied for every row 
        if($row_count>$page_size && $rep_print=="OK"){
          echo "</table>";
          echo "<p style='page-break-before: always'>";
          $page_number++;
          echo "<table width='100%' border='0' class='tbl_border_0'> <tr><td align='right' colspan='11'>Page ".$page_number." </td></tr> <tr><td colspan='11'>"; ?>
          <?php include("../includes/header_xls_next.php"); ?>           
          <?php
          echo "</td></tr>";
          echo $next_page_header;
          echo $row_header;
          $row_count=$next_page_row_count;
        }else{
          $row_count++;
        } 

    echo "<tr> <td  colspan='5' align='Right' ><b>Gross Total</b></td> 
    <td align='Right' ><b>".zeroToBlank(number_format($bill_page_total,2,'.',''))."</b></td>
    <td  align='Right'> </td>
    <td  align='Right'><b>".zeroToBlank(number_format($dis_page_total,2,'.',''))."</b></td>
    <td  align='Right'><b>".zeroToBlank(number_format($gr_page_total,2,'.',''))."</b> </td>
    <td  align='Right'><b>".zeroToBlank(number_format($payment_page_total,2,'.',''))."</b> </td>
    <td align='Right'><b>".zeroToBlank(number_format($bal_page_total,2,'.',''))."</b> </td>
    </tr>";




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
<table  border='0' >

<tr><td align='right'>
<?php if($rep_print!="OK") {?>
<input  type="button" class="form-button" onclick="excelDownLoad()" name="ls_dnload" value="Download Excel" />
<input  type="button" class="form-button" onclick="pdfDownLoad()" name="ls_dnload" value="Print" /> 
<?php }?>
<br>
</td></tr>

<tr><td>
<table  class="tbl_border_0" border='1'>
<?php
$con=get_connection();



$sql="select * from txt_company where delete_tag='FALSE' order by company_id ASC";
$result=mysqli_query($con,$sql);

$rowcount=0;
// Creating Company Array with reverse Key Value Pair 
// because array_search function searched value and returns key
// first value Dummy to show the position of details
$company_array=array("Value"=>"Key"); 
$company_array=array("All"=>""); 
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
  bill_amount, 
  DATEDIFF(CURDATE(),bill_date) AS days
  FROM txt_bill_entry ,view_supplier AS Supplier , view_buyer AS Buyer
    WHERE txt_bill_entry.delete_tag='FALSE'";
    if($rep_supplier_code!=''){
      $sql_pay.=" AND Supplier.company_id='$rep_supplier_code' ";
    } 
    if($rep_buyer_code!=''){          
      $sql_pay.=" AND Buyer.company_id='$rep_buyer_code' ";
    }
$sql_pay.=" AND supplier_account_code=Supplier.company_id
    AND buyer_account_code=Buyer.company_id 
    and bill_entry_id NOT IN (SELECT bill_entry_id
				  FROM txt_payment_bill_entry 
				  WHERE delete_tag='FALSE' 
				  AND bill_payment_type='Full') ";

if($rep_buyer_code!=''){
  $sql_pay.=" AND buyer_account_code='$rep_buyer_code'";
}

if($rep_supplier_code!=''){
  $sql_pay.=" AND supplier_account_code='$rep_supplier_code'";
}

if($rep_bill_start_date!=''){
  $sql_pay.=" AND bill_date>='$rep_bill_start_date'";
}
if($rep_bill_end_date!=''){
  $sql_pay.=" AND bill_date<='$rep_bill_end_date'";
}


$sql_pay.= " ORDER by supp_firm_name,buy_firm_name,bill_date ) AS t1
        LEFT JOIN 
        (SELECT bill_entry_id AS t2_bill_entry_id ,
        payment_entry_id,
        payment_entry_vou_date,
        dis_amount,
        deduction_amount,
        bill_gr_amt,
        payment_received,
        balance_amount 
        FROM txt_payment_bill_entry 
        WHERE delete_tag='FALSE' order by payment_entry_vou_date ASC, payment_entry_id ASC  ) AS t2 
        ON t1.bill_entry_id=t2.t2_bill_entry_id";


$disp_buyer_name=array_search($rs['buyer_account_code'],$company_array);
//echo $sql_pay;
$result=mysqli_query($con,$sql_pay);
$count=0;



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

        */


        $col_span=5;
        if($download=='XLS'){
          $col_span=5;
        }
      

?>

<tr>
    <th colspan='<?php echo $col_span*2;?>' > Supplier Outstanding by Firm </th>
      </tr>
      <tr>
        <th colspan='<?php echo $col_span;?>'>
            Supplier : <?php echo array_search($_REQUEST['supplier_account_code'],$company_array); ?>
        </th>
        <th colspan='<?php echo $col_span;?>'>      
            Buyer : <?php echo array_search($_REQUEST['buyer_account_code'],$company_array); ?>
        </th>
    </tr>
<?php
$curr_time=time()+19800; // Timestamp is in GMT now converted to IST
$curr_date=date('d-m-Y',$curr_time);
?>

<tr>

<th align='center' colspan='<?php echo ($col_span);?>'><strong> Till : <?php echo $_REQUEST['bill_end_date']?></strong> </th>
<th align='center' colspan='<?php echo ($col_span);?>'> <strong>As On :<?php echo $curr_date;?></strong></th>

</tr>
<?php /*


<tr>

<td valign='top' > Bill <BR> Entry id
</td>
<td valign='top' >Bill <BR> Number
</td>
<td width='80' valign='top' >Bill Date
</td>
<!--
<td valign='top' >Supplier Name
</td>
<td valign='top' >Buyer Name
</td>
-->
<td align='right'>Bill <BR> Amount
</td>
<td width='80' valign='top' >Payment Date
</td>
<td>Discount
</td>
<td valign='top' align='right' >Goods <BR> Return
</td>
<td valign='top' align='right'>Payment <BR> Amount
</td>
<td valign='top' align='right'>Balance <BR> Amount
</td>
<td valign='top' align='right'>Days
</td>

</tr>
*/
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
    $old_days=0;

    $row_count=2;
    $page_size=50;
    $next_page_row_count=1;

    $s_no=0;
    $page_number=1;

    
    $next_page_header="<tr>
    <td align='center' colspan='".($col_span*2)."'>
    <strong> Supplier Outstanding Report Till : ".$_REQUEST['bill_end_date']."</strong> 
    &nbsp;&nbsp;&nbsp;&nbsp; <strong>As On :".$curr_date."</strong></td></tr>
    <tr><td align='center' colspan='".($col_span*2)."'>&nbsp;</td></tr>";


    $row_header ="           <tr>

    <td  valign='top'> <b>S.No.</b>
    </td>
    <td  valign='top'><b>Bill Number</b>
    </td>
    <td  width='80' valign='top'><b>Bill Date</b>
    </td>
    <!--
    <td valign='top' >Buyer Name
    </td>
    <td valign='top' >Supplier Name
    </td>
    -->
    <td align='right'  valign='top'><b>Bill Amount</b>
    </td>
    <td  width='80' valign='top'><b>Payment Date</b>
    </td>
    <td valign='top'><b>Discount</b>
    </td>
    <td align='right' valign='top' ><b>Goods Return</b>
    </td>
    <td align='right' valign='top'><b>Payment Amount</b>
    </td>
    <td align='right' valign='top'><b>Balance Amount</b>
    </td>
    <td align='right' valign='top'><b>Days</b>
    </td>

    </tr> ";

    while($rs= mysqli_fetch_array($result)){
      $s_no++;

      if( $old_bill_entry_id==0){



        // For Paging  - its been applied for every row 
        if($row_count>$page_size && $rep_print=="OK"){
          echo "</table>";
          echo "<p style='page-break-before: always'>";
          $page_number++;
          echo "<table border='0' class='tbl_border_0'> <tr><td align='right' colspan='".($col_span*2)."'>Page ".$page_number." </td></tr> <tr><td colspan='".($col_span*2)."'>"; ?>
          <?php include("../includes/header_xls_next.php"); ?>           
          <?php
          echo "</td></tr>";
          echo $next_page_header;
          echo $row_header;
          $row_count=$next_page_row_count;
        }else{
          $row_count++;
        }    
        
        
        // Supplier
        echo "<tr> <td  colspan='".($col_span*2)."' align='center' ><h3><b>".trim($rs['supp_firm_name'])."</b></h3></td> 
        </tr>"; 

                // For Paging  - its been applied for every row 
                if($row_count>$page_size && $rep_print=="OK"){
                  echo "</table>";
                  echo "<p style='page-break-before: always'>";
                  $page_number++;
                  echo "<table border='0' class='tbl_border_0'> <tr><td align='right' colspan='".($col_span*2)."'>Page ".$page_number." </td></tr> <tr><td colspan='".($col_span*2)."'>"; ?>
                  <?php include("../includes/header_xls_next.php"); ?>           
                  <?php
                  echo "</td></tr>";
                  echo $next_page_header;
                  echo $row_header;
                  $row_count=$next_page_row_count;
                }else{
                  $row_count++;
                }

        // Buyer
        echo "<tr> <td  colspan='".($col_span*2)."' align='left' ><b>".trim($rs['buy_firm_name'])."</b></td> 
        </tr>";

        // For Paging  - its been applied for every row 
        if($row_count>$page_size && $rep_print=="OK"){
          echo "</table>";
          echo "<p style='page-break-before: always'>";
          $page_number++;
          echo "<table border='0' class='tbl_border_0'> <tr><td align='right' colspan='".($col_span*2)."'>Page ".$page_number." </td></tr> <tr><td colspan='".($col_span*2)."'>"; ?>
          <?php include("../includes/header_xls_next.php"); ?>           
          <?php
          echo "</td></tr>";
          echo $next_page_header;
          echo $row_header;
          $row_count=$next_page_row_count;
        }else{
          $row_count++;
        }        

        echo $row_header;

      } 




        if($old_bill_entry_id!=0 && $rs['bill_entry_id']!=$old_bill_entry_id){
          echo "<td align='Right'>";  
          echo $old_bal_amt;
          echo "</td>";
          echo "<td align='Right'>";  
          echo $old_days;
          echo "</td>";           
          echo "</tr>";
          $bal_sub_total+=$old_bal_amt;
          $bal_sub_page_total+=$old_bal_amt;
          $bal_page_total+=$old_bal_amt;

        }else if($old_bill_entry_id!=0){
          echo "<td>";  
          
          echo "</td>";
          echo "<td>";  
          echo $rs['days'];
          echo "</td>";           
          echo "</tr>";
        } else if($old_bill_entry_id==0){

        }
        $buyer_subtotal='NO';

        if($rs['buyer_account_code']!=$old_buyer_code && $old_bill_entry_id!=0){

        // For Paging  - its been applied for every row 
        if($row_count>$page_size && $rep_print=="OK"){
          echo "</table>";
          echo "<p style='page-break-before: always'>";
          $page_number++;
          echo "<table border='0' class='tbl_border_0'> <tr><td align='right' colspan='".($col_span*2)."'>Page ".$page_number." </td></tr> <tr><td colspan='".($col_span*2)."'>"; ?>
          <?php include("../includes/header_xls_next.php"); ?>           
          <?php
          echo "</td></tr>";
          echo $next_page_header;
          echo $row_header;
          $row_count=$next_page_row_count;;
        }else{
          $row_count++;
        }
          

          echo "<tr> <td  colspan='".($col_span-2)."' align='Right' ><b>Sub Total</b></td> 
          <td align='Right' ><b>".zeroToBlank(number_format($bill_sub_total,2,'.',''))."</b></td>
          <td  align='Right'> </td>
          <td  align='Right'><b>".zeroToBlank(number_format($dis_sub_total,2,'.',''))."</b></td>
          <td  align='Right'><b>".zeroToBlank(number_format($gr_sub_total,2,'.',''))."</b> </td>
          <td  align='Right'><b>".zeroToBlank(number_format($payment_sub_total,2,'.',''))."</b> </td>
          <td align='Right'><b>".zeroToBlank(number_format($bal_sub_total,2,'.',''))."</b> </td>
          <td></td>
          </tr>";
          $bal_sub_total=0;
          $bill_sub_total=0;
          $dis_sub_total=0;
          $gr_sub_total=0;
          $payment_sub_total=0;
          $buyer_subtotal='YES';
        }
        if($rs['supplier_account_code']!=$old_supplier_code && $old_bill_entry_id!=0){

          if($buyer_subtotal=='NO'){

            // For Paging  - its been applied for every row 
            if($row_count>$page_size && $rep_print=="OK"){
              echo "</table>";
              echo "<p style='page-break-before: always'>";
              $page_number++;
              echo "<table border='0' class='tbl_border_0'> <tr><td align='right' colspan='".($col_span*2)."'>Page ".$page_number." </td></tr> <tr><td colspan='".($col_span*2)."'>"; ?>
              <?php include("../includes/header_xls_next.php"); ?>           
              <?php
              echo "</td></tr>";
              echo $next_page_header;
              echo $row_header;
              $row_count=$next_page_row_count;;
            }else{
              $row_count++;
            }

            echo "<tr> <td  colspan='".($col_span-2)."' align='Right' ><b>Sub Total</b></td> 
            <td align='Right' ><b>".zeroToBlank(number_format($bill_sub_total,2,'.',''))."</b></td>
            <td  align='Right'> </td>
            <td  align='Right'><b>".zeroToBlank(number_format($dis_sub_total,2,'.',''))."</b></td>
            <td  align='Right'><b>".zeroToBlank(number_format($gr_sub_total,2,'.',''))."</b> </td>
            <td  align='Right'><b>".zeroToBlank(number_format($payment_sub_total,2,'.',''))."</b> </td>
            <td align='Right'><b>".zeroToBlank(number_format($bal_sub_total,2,'.',''))."</b> </td>
            <td></td>
            </tr>";
            $bal_sub_total=0;
            $bill_sub_total=0;
            $dis_sub_total=0;
            $gr_sub_total=0;
            $payment_sub_total=0;
          }

        // For Paging  - its been applied for every row 
        if($row_count>$page_size && $rep_print=="OK"){
          echo "</table>";
          echo "<p style='page-break-before: always'>";
          $page_number++;
          echo "<table border='0' class='tbl_border_0'> <tr><td align='right' colspan='".($col_span*2)."'>Page ".$page_number." </td></tr> <tr><td colspan='".($col_span*2)."'>"; ?>
          <?php include("../includes/header_xls_next.php"); ?>           
          <?php
          echo "</td></tr>";
          echo $next_page_header;
          echo $row_header;
          $row_count=$next_page_row_count;;
        }else{
          $row_count++;
        }          
            echo "<tr> <td  colspan='".($col_span-2)."' align='Right' ><b>Total</b></td> 
            <td align='Right' ><b>".zeroToBlank(number_format($bill_sub_page_total,2,'.',''))."</b></td>
            <td  align='Right'> </td>
            <td  align='Right'><b>".zeroToBlank(number_format($dis_sub_page_total,2,'.',''))."</b></td>
            <td  align='Right'><b>".zeroToBlank(number_format($gr_sub_page_total,2,'.',''))."</b> </td>
            <td  align='Right'><b>".zeroToBlank(number_format($payment_sub_page_total,2,'.',''))."</b> </td>
            <td align='Right'><b>".zeroToBlank(number_format($bal_sub_page_total,2,'.',''))."</b> </td>
            <td></td>
            </tr>";
            $bal_sub_page_total=0;
            $bill_sub_page_total=0;
            $dis_sub_page_total=0;
            $gr_sub_page_total=0;
            $payment_sub_page_total=0;
          }   
          $supplier_subtotal='YES';

          if($rs['supplier_account_code']!=$old_supplier_code && $old_bill_entry_id!=0){

        // For Paging  - its been applied for every row 
        if($row_count>$page_size && $rep_print=="OK"){
          echo "</table>";
          echo "<p style='page-break-before: always'>";
          $page_number++;
          echo "<table border='0' class='tbl_border_0'> <tr><td align='right' colspan='".($col_span*2)."'>Page ".$page_number." </td></tr> <tr><td colspan='".($col_span*2)."'>"; ?>
          <?php include("../includes/header_xls_next.php"); ?>           
          <?php
          echo "</td></tr>";
          echo $next_page_header;
          echo $row_header;
          $row_count=$next_page_row_count;;
        }else{
          $row_count++;
        }   
        
        
        if($rep_xls!="OK"){
          echo "<tr><td colspan='".($col_span*2)."' ><hr><br><hr></td></tr>";
        }else{
          echo "<tr><td colspan='".($col_span*2)."' >&nbsp;</td></tr>";
        }

              // For Paging  - its been applied for every row 
              if($row_count>$page_size && $rep_print=="OK"){
                echo "</table>";
                echo "<p style='page-break-before: always'>";
                $page_number++;
                echo "<table border='0' class='tbl_border_0'> <tr><td align='right' colspan='".($col_span*2)."'>Page ".$page_number." </td></tr> <tr><td colspan='".($col_span*2)."'>"; ?>
                <?php include("../includes/header_xls_next.php"); ?>           
                <?php
                echo "</td></tr>";
                echo $next_page_header;
                echo $row_header;
                $row_count=$next_page_row_count;
              }else{
                $row_count++;
              }

            echo "<tr> <td  colspan='".($col_span*2)."' align='center' ><h3><b>".trim($rs['supp_firm_name'])."</b></h3></td> 
            </tr>";      ?>
          <?php   
            $s_no=1; 
            $supplier_header="NEW";
          }
          if(($rs['buyer_account_code']!=$old_buyer_code && $old_bill_entry_id!=0) || $supplier_header=="NEW"){
            if( $supplier_header!="NEW"){


                // For Paging  - its been applied for every row 
                if($row_count>$page_size && $rep_print=="OK"){
                  echo "</table>";
                  echo "<p style='page-break-before: always'>";
                  $page_number++;
                  echo "<table border='0' class='tbl_border_0'> <tr><td align='right' colspan='".($col_span*2)."'>Page ".$page_number." </td></tr> <tr><td colspan='".($col_span*2)."'>"; ?>
                  <?php include("../includes/header_xls_next.php"); ?>           
                  <?php
                  echo "</td></tr>";
                  echo $next_page_header;
                  echo $row_header;
                  $row_count=$next_page_row_count;
                }else{
                  $row_count++;
                }

                if($rep_xls!="OK"){
                  echo "<tr><td colspan='".($col_span*2)."' ><hr><br><hr></td></tr>";
                }else{
                  echo "<tr><td colspan='".($col_span*2)."' >&nbsp;</td></tr>";
                }


            }  
            
        // For Paging  - its been applied for every row 
        if($row_count>$page_size && $rep_print=="OK"){
          echo "</table>";
          echo "<p style='page-break-before: always'>";
          $page_number++;
          echo "<table border='0' class='tbl_border_0'> <tr><td align='right' colspan='".($col_span*2)."'>Page ".$page_number." </td></tr> <tr><td colspan='".($col_span*2)."'>"; ?>
          <?php include("../includes/header_xls_next.php"); ?>           
          <?php
          echo "</td></tr>";
          echo $next_page_header;
          echo $row_header;
          $row_count=$next_page_row_count;
        }else{
          $row_count++;
        }
            
            echo "<tr> <td  colspan='".($col_span*2)."' align='left' ><b>".trim($rs['buy_firm_name'])."</b></td> 
            </tr>";



            $s_no=1;
          } 
          $supplier_header="OLD";     
          
        // For Paging  - its been applied for every row 
        if($row_count>$page_size && $rep_print=="OK"){
          echo "</table>";
          echo "<p style='page-break-before: always'>";
          $page_number++;
          echo "<table border='0' class='tbl_border_0'> <tr><td align='right' colspan='".($col_span*2)."'>Page ".$page_number." </td></tr> <tr><td colspan='".($col_span*2)."'>"; ?>
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
        //echo $rs['bill_entry_id'];
        echo $s_no;
        echo "</td>";

        echo "<td>";
        echo $rs['bill_number'];
        echo "</td>";

        echo "<td>";
        echo rev_convert_date($rs['bill_date']);
        echo "</td>";
/*
        echo "<td>";
        echo trim($rs['supp_firm_name']);
        echo "</td>";

        echo "<td>";
        echo trim($rs['buy_firm_name']);
        echo "</td>";
        */
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
        
        $old_days=$rs['days'];
        $old_bill_entry_id=$rs['bill_entry_id'];
        $old_buyer_code=$rs['buyer_account_code'];
        $old_supplier_code=$rs['supplier_account_code'];


    }
    
    echo "<td align='Right'>";  
    echo $old_bal_amt;
    echo "</td>";
    echo "<td align='Right'>";  
    echo $old_days;
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
          echo "<table border='0' class='tbl_border_0'> <tr><td align='right' colspan='".($col_span*2)."'>Page ".$page_number." </td></tr> <tr><td colspan='".($col_span*2)."'>"; ?>
          <?php include("../includes/header_xls_next.php"); ?>           
          <?php
          echo "</td></tr>";
          echo $next_page_header;
          echo $row_header;
          $row_count=$next_page_row_count;
        }else{
          $row_count++;
        }

    
    echo "<tr> <td  colspan='".($col_span-2)."' align='Right' ><b>Sub Total</b></td> 
    <td align='Right' ><b>".zeroToBlank(number_format($bill_sub_total,2,'.',''))."</b></td>
    <td  align='Right'> </td>
    <td  align='Right'><b>".zeroToBlank(number_format($dis_sub_total,2,'.',''))."</b></td>
    <td  align='Right'><b>".zeroToBlank(number_format($gr_sub_total,2,'.',''))."</b> </td>
    <td  align='Right'><b>".zeroToBlank(number_format($payment_sub_total,2,'.',''))."</b> </td>
    <td align='Right'><b>".zeroToBlank(number_format($bal_sub_total,2,'.',''))."</b> </td>
    <td></td>
    </tr>";

        // For Paging  - its been applied for every row 
        if($row_count>$page_size && $rep_print=="OK"){
          echo "</table>";
          echo "<p style='page-break-before: always'>";
          $page_number++;
          echo "<table border='0' class='tbl_border_0'> <tr><td align='right' colspan='".($col_span*2)."'>Page ".$page_number." </td></tr> <tr><td colspan='".($col_span*2)."'>"; ?>
          <?php include("../includes/header_xls_next.php"); ?>           
          <?php
          echo "</td></tr>";
          echo $next_page_header;
          echo $row_header;
          $row_count=$next_page_row_count;
        }else{
          $row_count++;
        }    

    echo "<tr> <td  colspan='".($col_span-2)."' align='Right' ><b>Total</b></td> 
    <td align='Right' ><b>".zeroToBlank(number_format($bill_sub_page_total,2,'.',''))."</b></td>
    <td  align='Right'> </td>
    <td  align='Right'><b>".zeroToBlank(number_format($dis_sub_page_total,2,'.',''))."</b></td>
    <td  align='Right'><b>".zeroToBlank(number_format($gr_sub_page_total,2,'.',''))."</b> </td>
    <td  align='Right'><b>".zeroToBlank(number_format($payment_sub_page_total,2,'.',''))."</b> </td>
    <td align='Right'><b>".zeroToBlank(number_format($bal_sub_page_total,2,'.',''))."</b> </td>
    <td></td>
    </tr>";
    
/*
    echo "<tr> <td  colspan='5' align='Right' ><b>Gross Total</b></td> 
    <td align='Right' ><b>".zeroToBlank(number_format($bill_page_total,2,'.',''))."</b></td>
    <td  align='Right'> </td>
    <td  align='Right'><b>".zeroToBlank(number_format($dis_page_total,2,'.',''))."</b></td>
    <td  align='Right'><b>".zeroToBlank(number_format($gr_page_total,2,'.',''))."</b> </td>
    <td  align='Right'><b>".zeroToBlank(number_format($payment_page_total,2,'.',''))."</b> </td>
    <td align='Right'><b>".zeroToBlank(number_format($bal_page_total,2,'.',''))."</b> </td>
    <td></td>
    </tr>";
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
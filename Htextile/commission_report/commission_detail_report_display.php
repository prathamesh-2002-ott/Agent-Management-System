<?php 
if(isset($rep_print)){

if($rep_print=="OK"){ ?>
  <table  class="tbl_border" >
<?php }else{?>
  <table  class="tbl_border" >
<?php } 
}else {?>
  <table  class="tbl_border" >
<?php }?>



<?php 
if(isset($rep_print)){
if($rep_print!="OK") {?>	
<tr><td align='right'>
<input  type="button" class="form-button" onclick="excelDownLoad()" name="ls_dnload" value="Download Excel" />
<input  type="button" class="form-button" onclick="pdfDownLoad()" name="ls_dnload" value="Print" /> 
<br>
</td></tr>
<?php }?>
<?php }?>


<tr><td>

<table width="100%" border='1'>

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
  $companyRow[$rowcount][0]=$rs['company_id'];
  $companyRow[$rowcount][1]=$rs['firm_name'];
  $com_array=array($rs['firm_name']=>$rs['company_id']);
  $company_array=array_merge($company_array,$com_array);

/*
  echo $companyRow[$rowcount][0];
  echo $companyRow[$rowcount][1];
*/
  $rowcount++;

}
?>
    
<?php

//echo array_search(8,$company_array);

$key='name';
$val='Pritesh Shah';

$a1=array('id'=>5678);
$a2=array('first'=>'Pritesh');
$a3=array($key=>$val);
$a10=array_merge($a1,$a2,$a3);

//echo "--";
//print_r( $a10);
//echo "--";
//echo array_search($val,$a10);
//echo "--";

$rep_supplier_code=$_REQUEST['supplier_account_code'];
$disp_suppllier_code=array_search($rep_supplier_code,$company_array);

$comm_report_type=$_REQUEST['comm_report_type'];
$rep_start_date=convert_date($_REQUEST['start_date']);
$rep_end_date=convert_date($_REQUEST['end_date']);
$start_date=$_REQUEST['start_date'];
$end_date=$_REQUEST['end_date'];
$GST_DISP=$_REQUEST['GST'];






$sql_pay="SELECT * FROM 
(SELECT voucher_date, bill_entry_id,
  bill_number,
  bill_date,
  supplier_account_code,
  buyer_account_code,
  bill_amount 
FROM txt_bill_entry 
WHERE delete_tag='FALSE' ";



if($rep_supplier_code!=''){
  $sql_pay.=" AND supplier_account_code='$rep_supplier_code'";
}

if($comm_report_type=="Bill Wise"){
    if($rep_start_date!=''){
    $sql_pay.=" AND bill_date>='$rep_start_date'";
    }
    if($rep_end_date!=''){
    $sql_pay.=" AND bill_date<='$rep_end_date'";
    }

}

$query_join='LEFT JOIN' ;
if($comm_report_type=="Payment Wise"){
    $query_join='JOIN' ;  
}


 $sql_pay.= " ORDER by bill_date ) AS t1
         $query_join 
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
if($comm_report_type=="Payment Wise"){
    if($rep_start_date!=''){
    $sql_pay.=" AND payment_entry_vou_date>='$rep_start_date'";
    }
    if($rep_end_date!=''){
    $sql_pay.=" AND payment_entry_vou_date<='$rep_end_date'";
    }

}

/*
//last_update_date DESC

$sql_pay.=" order by last_update_date DESC  ) AS t2 
        ON t1.bill_entry_id=t2.t2_bill_entry_id";
*/
$sql_pay.=" order by payment_entry_vou_date ASC, payment_entry_id ASC  ) AS t2 
        ON t1.bill_entry_id=t2.t2_bill_entry_id order by bill_number ASC, bill_date ASC, t2.payment_entry_vou_date ASC ";

/*
$sql_pay="SELECT * FROM 
(SELECT bill_entry_id,
  bill_number,
  bill_date,
  supplier_account_code,
  buyer_account_code,
  bill_amount 
FROM txt_bill_entry 
WHERE delete_tag='FALSE' 
AND supplier_account_code='8' 
AND buyer_account_code='52' ) AS t1
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
WHERE delete_tag='FALSE' ) AS t2 
ON t1.bill_entry_id=t2.t2_bill_entry_id";
*/
//$disp_buyer_name=array_search($rs['buyer_account_code'],$company_array);
//echo $sql_pay;
$result=mysqli_query($con,$sql_pay);
$count=0;
//$rs=mysqli_fetch_field($result);
//while($rs=mysqli_fetch_fields($result))
//{

  /*
echo "<tr> <td colspan='11'>";
echo "--";
echo $rep_supplier_code;
echo "--";
echo $rep_buyer_code;
echo "--";
echo $rep_bill_start_date;
echo "--";
echo $rep_bill_end_date;
echo "--";
echo $rep_vou_start_date;
echo "--";
echo $rep_vou_end_date;
echo "--";
echo $sql_pay;


echo "</td></tr>";
*/

$last_page_header="<tr><th colspan='9'><h3>Commission Report Summary (".$comm_report_type.")</h3></th></tr>
<tr><th colspan='9'><b> From ".$start_date." To ".$end_date ."</b></th></tr>
<tr><th colspan='9'><h3>". $disp_suppllier_code . "</h3></th></tr>
";

$next_page_header=$page_header="<tr><th colspan='9'><h3>Commission Report (".$comm_report_type.")</h3></th></tr>
<tr><th colspan='9'><b> From ".$start_date." To ".$end_date ."</b></th></tr>
<tr><th colspan='9'><h3>". $disp_suppllier_code . "</h3></th></tr>

<tr>
<td>Bill <BR> Number
</td>
<td>Bill Date
</td>
<!-- <td>Supplier Name</td> -->
<td>Buyer Name
</td>
<td align='right'>Bill <BR> Amount
</td>
<td>Payment Date
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

?>

<tr><th colspan='9'><h3>Commission Report (<?php echo $comm_report_type ?>)</h3></th></tr>
<tr><th colspan='9'><b><?php echo " From ".$start_date." To ".$end_date ?></b></th></tr>
<tr><th colspan='9'><h3><?php echo $disp_suppllier_code  ?></h3></th></tr>
<tr>

<td>Bill <BR> Number
</td>
<td>Bill Date
</td>
<!-- <td>Supplier Name</td> -->
<td>Buyer Name
</td>
<td align='right'>Bill <BR> Amount
</td>
<td>Payment Date
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

<?php




    $old_bill_entry_id=0;
    $old_bal_amt=0;
    $old_buyer_code=0;
    
    $bill_page_total=0;
    $bill_sub_total=0;
    
    $bal_sub_total=0;
    $bal_page_total=0;

    $dis_sub_total=0;
    $dis_page_total=0;

    $gr_sub_total=0;
    $gr_page_total=0;

    $payment_sub_total=0;
    $payment_page_total=0;


    // Paging 
    $row_count=1;
    $page_size=32;
    $next_page_row_count=1;

    $s_no=0;
    $page_number=1;


    while($rs= mysqli_fetch_array($result)){



        if($old_bill_entry_id!=0 && $rs['bill_entry_id']!=$old_bill_entry_id){
          echo "<td align='Right'>";  
          echo $old_bal_amt;
          echo "</td>";
          echo "</tr>";
          $bal_sub_total+=$old_bal_amt;
          $bal_page_total+=$old_bal_amt;

        }else if($old_bill_entry_id!=0){
          echo "<td>";  
          
          echo "</td>";
          echo "</tr>";
        } else if($old_bill_entry_id==0){

        }
/*
        if($rs['buyer_account_code']!=$old_buyer_code && $old_bill_entry_id!=0){
          echo "<tr> <td  colspan='5' align='Right' >Sub Total</td> 
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
*/

        // For Paging  - its been applied for every row 
        if($row_count>$page_size && $rep_print=="OK"){
          echo "</table>";
          
          echo "</td></tr></table>";

          
          echo "<p style='page-break-before: always'>";
          echo "<table  class='tbl_border' > <tr><td>";

          $page_number++;
          echo "<table  width='100%' class='tbl_border'> <tr><td align='right' colspan='9'>Page ".$page_number." </td></tr> " ?>
                 
          <?php
         
          echo $next_page_header;
          //echo $row_header;
          $row_count=$next_page_row_count;
        }else{
          $row_count++;
        }

        echo "<tr>";

        echo "<td>";
        echo $rs['bill_number'];
        echo "</td>";

        echo "<td>";
        echo rev_convert_date($rs['bill_date']);
        echo "</td>";

        /*
        echo "<td>";
        echo array_search($rs['supplier_account_code'],$company_array);
        echo "</td>";
        */

        echo "<td>";
        echo array_search($rs['buyer_account_code'],$company_array);
        echo "</td>";
        
        echo "<td align='Right'>";
        if($rs['bill_entry_id']!=$old_bill_entry_id){
          echo zeroToBlank(number_format($rs['bill_amount'],2,'.',''));
          $bill_sub_total+=$rs['bill_amount'];
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
        $gr_page_total+=$rs['bill_gr_amt'];

        echo "<td align='Right'>";
        echo zeroToBlank(number_format($rs['payment_received'],2,'.',''));
        echo "</td>";  
        $payment_sub_total+= $rs['payment_received'];
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
        
        $old_bill_entry_id=$rs['bill_entry_id'];
        $old_buyer_code=$rs['buyer_account_code'];


    }
    
    echo "<td align='Right'>";  
    echo $old_bal_amt;
    echo "</td>";
    echo "</tr>";
    $bal_sub_total+=$old_bal_amt;
    $bal_page_total+=$old_bal_amt;

    /*
    echo "<tr> <td  colspan='5' align='Right' >Sub Total</td> 
    <td align='Right' ><b>".zeroToBlank(number_format($bill_sub_total,2,'.',''))."</b></td>
    <td  align='Right'> </td>
    <td  align='Right'><b>".zeroToBlank(number_format($dis_sub_total,2,'.',''))."</b></td>
    <td  align='Right'><b>".zeroToBlank(number_format($gr_sub_total,2,'.',''))."</b> </td>
    <td  align='Right'><b>".zeroToBlank(number_format($payment_sub_total,2,'.',''))."</b> </td>
    <td align='Right'><b>".zeroToBlank(number_format($bal_sub_total,2,'.',''))."</b> </td>
    </tr>";
    */

    echo "<tr> <td  colspan='3' align='Right' ><b>Gross Total</b></td> 
    <td align='Right' ><b>".zeroToBlank(number_format($bill_page_total,2,'.',''))."</b></td>
    <td  align='Right'> </td>
    <td  align='Right'><b>".zeroToBlank(number_format($dis_page_total,2,'.',''))."</b></td>
    <td  align='Right'><b>".zeroToBlank(number_format($gr_page_total,2,'.',''))."</b> </td>
    <td  align='Right'><b>".zeroToBlank(number_format($payment_page_total,2,'.',''))."</b> </td>
    <td align='Right'><b>".zeroToBlank(number_format($bal_page_total,2,'.',''))."</b> </td>
    </tr>";

    echo "<tr><td colspan='9'><BR></td></tr>";
    if(isset($rep_print)){
      if(  $rep_print=="OK") {
        echo "</table> </td></tr> </table>";
        echo "<p style='page-break-before: always'>";

        echo "<br><br>";

        echo "<table width='100%'><tr><td>";
        echo "<table width='100%' class='tbl_border' > ";
        
      }
    }
      echo $last_page_header;   
    

    $sql_agent="SELECT firm_name,pan_number,contact_person FROM txt_company WHERE delete_tag='FALSE' AND company_id IN (SELECT agent_id FROM txt_company WHERE delete_tag='FALSE' AND company_id='$rep_supplier_code')";

    $res_agent=mysqli_query($con,$sql_agent);
    $row_agt=mysqli_fetch_array($res_agent);
    $agent_name=$row_agt['firm_name'];
    $pan_num=$row_agt['pan_number'];
    $contact_person=$row_agt['contact_person'];

    $sql_comm="SELECT commission_percentage FROM txt_company WHERE delete_tag='FALSE' AND company_id='$rep_supplier_code'";

    $res_comm=mysqli_query($con,$sql_comm);
    $row= mysqli_fetch_array($res_comm);
    $commission=$row['commission_percentage'];

    if($commission<=.5){
      $commission=2;
    }
    //echo $sql_comm;
    //echo $commission;
    //echo "<tr> <td colspan='9'> <table border='1'>";

    echo "<tr><td colspan='3'><BR></td><td><BR></td><td>&nbsp;</td><td colspan='4' align='center' ></td></tr>";

    if($comm_report_type=="Bill Wise"){
      echo "<tr> <td colspan='3'  align='Right' ><b>Bill Amount</b></td> <td align='Right' >".zeroToBlank(number_format($bill_page_total,2,'.',''))."</td><td>&nbsp;</td> <td colspan='4' align='center' >PAN Number</td> </tr>";
      //if($dis_page_total>0){
        echo "<tr> <td colspan='3'  align='Right' ><b>Less : Discount</b></td> <td align='Right' >".zeroToBlank(number_format($dis_page_total,2,'.',''))."</td><td>&nbsp;</td> <td colspan='4' align='center' ><b> $pan_num </b></td></tr>";
      //}
      
      //if($gr_page_total>0){
        echo "<tr> <td colspan='3'  align='Right' ><b>Less : Goods Return</b></td> <td align='Right' >".zeroToBlank(number_format($gr_page_total,2,'.',''))."</td><td>&nbsp;</td><td colspan='4' align='center' ></td> </tr>";
      //}
      echo "<tr> <td  colspan='3' align='Right' ></td> <td align='Right' >------------------</td><td>&nbsp;</td><td colspan='4' align='center' >  Firm Name </td> </tr>";
      $total_amt=($bill_page_total-$dis_page_total-$gr_page_total);
      echo "<tr> <td  colspan='3' align='Right' ><b> Total Amount </b></td> <td align='Right' >".zeroToBlank(number_format($total_amt,2,'.',''))."</td><td>&nbsp;</td><td colspan='4' align='center' ><b>$agent_name </b></td> </tr>";
      $GST_AMT=$total_amt*($GST_DISP/(100+$GST_DISP));
      echo "<tr> <td  colspan='3' align='Right' ><b> Less GST &nbsp;$GST_DISP%&nbsp; </b></td> </td> <td align='Right' >-".zeroToBlank(number_format($GST_AMT,2,'.','')). "</td><td>&nbsp;</td> <td colspan='4' align='center' >($contact_person)</td></tr>";
      echo "<tr> <td  colspan='3' align='Right' ></td> <td align='Right' >------------------</td><td>&nbsp;</td> <td colspan='4' align='center' ></td></tr>";
      $total_amt_less_GST=$total_amt-$GST_AMT;
      echo "<tr> <td colspan='3'  align='Right' ><b>Amount( Less &nbsp;GST $GST_DISP%&nbsp;) </b></td> <td align='Right' >".zeroToBlank(number_format($total_amt_less_GST,2,'.',''))."</td><td>&nbsp;</td><td colspan='4' align='center' ></td> </tr>";      
      echo "<tr> <td  colspan='3' align='Right' ></td> <td align='Right' >------------------</td><td>&nbsp;</td> <td colspan='4' align='center' ></td></tr>";
      $commission_amt=($total_amt_less_GST/100)*$commission;
 
      echo "<tr><td colspan='3'><BR></td><td><BR></td><td>&nbsp;</td><td colspan='4' align='center' ></td></tr>";
      //echo "<tr> <td colspan='3'  align='Right' ><b>Commission(&nbsp;$commission%&nbsp;) </b></td> <td align='Right' >".zeroToBlank(number_format((($bill_page_total-$dis_page_total-$gr_page_total)/100)*$commission,2,'.',''))."</td><td>&nbsp;</td><td colspan='4' align='center' ></td> </tr>";
      echo "<tr> <td colspan='3'  align='Right' ><b>Commission(&nbsp;$commission%&nbsp; of &nbsp; ".zeroToBlank(number_format($total_amt_less_GST,2,'.','')).") </b></td> <td align='Right' >".zeroToBlank(number_format($commission_amt,2,'.',''))."</td><td>&nbsp;</td><td colspan='4' align='center' ></td> </tr>";

      //$comm_amt_less_GST=$commission_amt*((100-$GST_DISP)/100);
      //echo "<tr> <td colspan='3'  align='Right' ><b>Commission(&nbsp;$commission%&nbsp;) </b></td> <td align='Right' >".zeroToBlank(number_format($comm_amt_less_GST,2,'.',''))."</td><td>&nbsp;</td><td colspan='4' align='center' ></td> </tr>";
    }else if($comm_report_type=="Payment Wise"){

      echo "<tr> <td colspan='3'  align='Right' ><b>Payment Amount</b></td> <td align='Right' >".zeroToBlank(number_format($payment_page_total,2,'.',''))."</td><td>&nbsp;</td> <td colspan='4' align='center' >PAN Number</td> </tr>";

      //if($dis_page_total>0){
        $GST_AMT=$payment_page_total*($GST_DISP/(100+$GST_DISP));
        echo "<tr> <td colspan='3'  align='Right' ><b>Less GST &nbsp;$GST_DISP%&nbsp; </b></td> <td align='Right' >".zeroToBlank(number_format($GST_AMT,2,'.',''))." </td> <td>&nbsp;</td><td colspan='4' align='center' ><b> $pan_num </b></td></tr>";
      //}

      

      $payment_page_total_Less_GST=$payment_page_total-$GST_AMT;

      $commission_amt=($payment_page_total_Less_GST/100)*$commission;
      
      //if($gr_page_total>0){
        echo "<tr> <td colspan='3'  align='Right' ><b> </b></td> <td align='Right' >------------------</td><td>&nbsp;</td><td colspan='4' align='center' ></td> </tr>";
      //}
      echo "<tr> <td  colspan='3' align='Right' ><b> Payment Amount (Less GST &nbsp;GST $GST_DISP%&nbsp;) </b></td> <td align='Right' >".zeroToBlank(number_format($payment_page_total_Less_GST,2,'.',''))." </td><td>&nbsp;</td><td colspan='4' align='center' >  Firm Name </td> </tr>";
      echo "<tr> <td  colspan='3' align='Right' ></td> <td align='Right' >------------------</td><td>&nbsp;</td><td colspan='4' align='center' ><b>$agent_name </b></td> </tr>";
      echo "<tr> <td colspan='3'  align='Right' ><b> </b></td> <td align='Right' ></td><td>&nbsp;</td><td colspan='4' align='center' >($contact_person)</td> </tr>";

      echo "<tr> <td  colspan='3' align='Right' ><b>Commission(&nbsp;$commission%&nbsp; of ".zeroToBlank(number_format($payment_page_total_Less_GST,2,'.','')).") </b></td> <td align='Right' >".zeroToBlank(number_format($commission_amt,2,'.',''))."</td> <td>&nbsp;</td><td colspan='4' align='center' ></td></tr>";
  
  
      echo "<tr> <td colspan='3'  align='Right' ></td> <td align='Right' ></td><td>&nbsp;</td><td colspan='4' align='center' ></td> </tr>";  

    }

    echo "<tr><td colspan='3'><BR></td><td><BR></td><td>&nbsp;</td><td colspan='4' align='center' ></td></tr>";
    echo "<tr><td colspan='9' align='center'> For any queries please contact Hemant Chhajed - 9425062020 </td></tr>";
    echo "<tr><td colspan='3'><BR></td><td><BR></td><td>&nbsp;</td><td colspan='4' align='center' ></td></tr>";
    //echo "</table></td></tr>";
    //echo "<tr> <td colspan='9'> <table border='1'>";
   // echo "<tr> <td  colspan='2' align='Right' >PAN Number :</td> <td align='Right' ><b> $pan_num </b></td> </tr>";
    //echo "<tr> <td  colspan='2' align='Right' >Firm Name :</td> <td align='Right' ><b> $agent_name ($contact_person) </b> </td> </tr>";

    


    //echo "</table></td></tr>";







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
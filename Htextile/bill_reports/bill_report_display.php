<table   border='0' >

<tr><td align='right'>
<?php if($rep_print!="OK") {?>
<input  type="button" class="form-button" onclick="excelDownLoad()" name="ls_dnload" value="Download Excel" />
<input  type="button" class="form-button" onclick="pdfDownLoad()" name="ls_dnload" value="Print" /> 
<?php }?>
<br>
</td></tr>
<?php
$head_col_span=12;
//if($rep_xls=="OK" && $role_id=="admin"){
if($rep_xls=="OK" ){  
  $head_col_span=17;
}

?>
<tr><td>
<table class="tbl_border_0" border='1' width='100%'>
  <tr>
    <th colspan='<?php echo $head_col_span;?>' align='center' > Bill Report 
    </th>
  </tr>
  <?php 
    $supplier_code=$_REQUEST['supplier_account_code'];
    $buyer_code=$_REQUEST['buyer_account_code'];
    $bill_start_date=$_REQUEST['bill_start_date'];
    $bill_end_date=$_REQUEST['bill_end_date'];
    $vou_start_date=$_REQUEST['vou_start_date'];
    $vou_end_date=$_REQUEST['vou_end_date'];
?>
  <?php 
    if($bill_start_date!="" ){
      $display_bill_start_date= "Bill Start Date : ".$bill_start_date."   ";
    }

    if($bill_end_date!="" ){
      $display_bill_end_date= "Bill End Date : ".$bill_end_date;
    }

    if($vou_start_date!="" ){
      $display_billentry_start_date= "Entry Start Date : ".$vou_start_date."   ";
    }

    if($vou_end_date!="" ){
      $display_billentry_end_date= "Entry End Date : ".$vou_end_date;
    }    



  ?>
  <tr>
    <td colspan='<?php echo $head_col_span;?>' align='center' > <?php echo $display_bill_start_date ?> &nbsp;&nbsp;&nbsp; <?php echo $display_bill_end_date ?>
    </td>
  </tr>

  <tr>
    <td colspan='<?php echo $head_col_span;?>' align='center' > <?php echo $display_billentry_start_date ?> &nbsp;&nbsp;&nbsp;  <?php echo $display_billentry_end_date ?>
    </td>
  </tr>

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

$con=get_connection();



$sql="SELECT comp.group_id AS GROUP_ID,grp.group_name AS GROUP_NAME,comp.firm_name AS FIRM_NAME,comp.company_id AS comp_id ,comp.city AS CITY FROM txt_group_master AS grp, txt_company AS comp WHERE comp.delete_tag='FALSE' AND grp.delete_tag='FALSE' AND comp.group_id=grp.group_id 

ORDER BY comp.company_id ASC";
$result=mysqli_query($con,$sql);

$rowcount=0;
// Creating Group Array with reverse Key Value Pair 
// because array_search function searched value and returns key
// first value Dummy to show the position of details
$group_array=array("Value"=>"Key"); 
while($rs=mysqli_fetch_array($result))
{
  //$groupRow[$rowcount][0]=$rs['comp_id'];
  //$groupRow[$rowcount][1]=$rs['GROUP_NAME'];
  $grp_com_name=$rs['GROUP_NAME'].",".$rs['CITY'].",".$rs['FIRM_NAME'];
  $grp_array=array($grp_com_name=>trim($rs['comp_id']));
  $group_array=array_merge($group_array,$grp_array);
  //xls_report_log($rs['GROUP_NAME']);
  //xls_report_log($rs['comp_id']);

//  echo $companyRow[$rowcount][0];
//  echo $companyRow[$rowcount][1];

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
$rep_buyer_code=$_REQUEST['buyer_account_code'];
$rep_bill_start_date=convert_date($_REQUEST['bill_start_date']);
$rep_bill_end_date=convert_date($_REQUEST['bill_end_date']);
$rep_vou_start_date=convert_date($_REQUEST['vou_start_date']);
$rep_vou_end_date=convert_date($_REQUEST['vou_end_date']);
$order=$_REQUEST['order'];

$sql_pay="SELECT * FROM 
(SELECT month(voucher_date) as vou_month, voucher_date, bill_entry_id,
  bill_number,
  month(bill_date) as bill_month,
  bill_date,
  supplier_account_code,
  buyer_account_code,
  bill_amount 
FROM txt_bill_entry 
WHERE delete_tag='FALSE' ";

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

if($rep_vou_start_date!=''){
  $sql_pay.=" AND voucher_date>='$rep_vou_start_date'";
}
if($rep_vou_end_date!=''){
  $sql_pay.=" AND voucher_date<='$rep_vou_end_date'";
}

// Entry Date
$sql_order_by=' voucher_date,bill_entry_id ';
if($order=='Bill Date'){
  $sql_order_by=' bill_date,bill_number ';
}
//ORDER by bill_date,bill_number 
 $sql_pay.= " ORDER by $sql_order_by ) AS t1
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
        ON t1.bill_entry_id=t2.t2_bill_entry_id 
        ORDER BY voucher_date,bill_entry_id , payment_entry_vou_date ASC, payment_entry_id ASC";

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
$disp_buyer_name=array_search($rs['buyer_account_code'],$company_array);
//echo $sql_pay;

$result=mysqli_query($con,$sql_pay);
//echo $sql_pay;
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

//if ($rep_xls=="OK" && $role_id=="admin"){
if ($rep_xls=="OK" ){  
?>

<tr>
<td valign='top' width='64' > Entry Month
</td>
<td valign='top' width='64' > Entry  Date
</td>
<td valign='top' > Bill  Entry id
</td>
<td valign='top' >Bill Number
</td>
<td valign='top' width='64' >Bill Month
</td>
<td valign='top' width='64' >Bill Date
</td>
<td valign='top'  >Supplier City
</td>
<td valign='top'  >Supplier Group
</td>
<td valign='top'  >Supplier Name
</td>
<td valign='top'  >Buyer Group
</td>
<td valign='top'  >Buyer Name
</td>
<td valign='top' align='right'>Bill Amount
</td>
<td valign='top' width='64' >Payment  Date
</td>
<td valign='top' >Discount
</td>
<td valign='top' align='right' >Goods  Return
</td>
<td valign='top' align='right'>Payment  Amount
</td>
<td valign='top' align='right'>Balance  Amount
</td>

</tr>

<?php

}else{
?>


<tr>
<td valign='top' width='64' > Entry <BR> Date
</td>
<td valign='top' > Bill <BR> Entry id
</td>
<td valign='top' >Bill <BR> Number
</td>
<td valign='top' width='64' >Bill Date
</td>
<td valign='top'  >Supplier Name
</td>
<td valign='top'  >Buyer Name
</td>
<td valign='top' align='right'>Bill <BR> Amount
</td>
<td valign='top' width='64' >Payment <BR> Date
</td>
<td valign='top' >Discount
</td>
<td valign='top' align='right' >Goods <BR> Return
</td>
<td valign='top' align='right'>Payment <BR> Amount
</td>
<td valign='top' align='right'>Balance <BR> Amount
</td>

</tr>

<?php
}


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

    // Calculating Bal Amount Dynamically
    $bill_amt_temp=0;
    $bal_amt_temp=0;
    $bill_amt_counted='NO';

    $row_count=2;
    $page_size=30;
    $next_page_row_count=2;

    $s_no=0;
    $page_number=1;    

    $payment_sub_total=0;
    $payment_page_total=0;

    $string_disp=20;
    if($rep_xls=="OK" ){
      $string_disp=100;
    }

    $next_page_header= " <tr>
    <th colspan='12' align='center' > Bill Report 
    </th>
  </tr>
  <tr>
  <td colspan='12' align='center' > $display_bill_start_date  &nbsp;&nbsp;&nbsp;  $display_bill_end_date 
  </td>
</tr>

<tr>
  <td colspan='12' align='center' >  $display_billentry_start_date  &nbsp;&nbsp;&nbsp;   $display_billentry_end_date 
  </td>
</tr>
  ";


    $row_header="<tr>

    <td valign='top' width='64' > Entry <BR> Date
    </td>
    <td valign='top' > Bill <BR> Entry id
    </td>
    <td valign='top' >Bill <BR> Number
    </td>
    <td valign='top' width='64' >Bill Date
    </td>
    <td valign='top' width='160' >Supplier Name
    </td>
    <td valign='top' width='165' >Buyer Name
    </td>
    <td valign='top' align='right'>Bill <BR> Amount
    </td>
    <td valign='top' width='64' >Payment <BR> Date
    </td>
    <td valign='top' >Discount
    </td>
    <td valign='top' align='right' >Goods <BR> Return
    </td>
    <td valign='top' align='right'>Payment <BR> Amount
    </td>
    <td valign='top' align='right'>Balance <BR> Amount
    </td>
    
    </tr>";

    while($rs= mysqli_fetch_array($result)){

        if($old_bill_entry_id!=0 && $rs['bill_entry_id']!=$old_bill_entry_id){
          echo "<td align='Right'>";  
          echo number_format($old_bal_amt,2,'.','');
          echo "</td>";
          echo "</tr>";
          $bal_sub_total+=$old_bal_amt;
          $bal_page_total+=$old_bal_amt;

          $bill_amt_temp=0;
          $bal_amt_temp=0;
          $old_bal_amt=0;
          $bill_amt_counted='NO';          

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

        if($bill_amt_counted=='NO'){
          $bill_amt_counted='YES';
          $bal_amt_temp=($rs['bill_amount']-($rs['dis_amount']+$rs['deduction_amount']+$rs['bill_gr_amt']+$rs['payment_received']));
          $old_bal_amt=$bal_amt_temp;
        }else{
          $bal_amt_temp=$bal_amt_temp-($rs['dis_amount']+$rs['deduction_amount']+$rs['bill_gr_amt']+$rs['payment_received']);
          $old_bal_amt=$bal_amt_temp;
        }

        // For Paging  - its been applied for every row 
        if($row_count>$page_size && $rep_print=="OK"){
          echo "</table>";
          echo "<p style='page-break-before: always'>";
          $page_number++;
          echo "<table width='100%' border='0' class='tbl_border_0'> <tr><td align='right' colspan='12'>Page ".$page_number." </td></tr> <tr><td colspan='12'>"; ?>
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
        //if( $rep_xls=="OK" && $role_id=="admin"){
        if( $rep_xls=="OK" ){  
          echo "<td valign='top'  >";
         // echo rev_convert_date($rs['vou_month']);
         echo $rs['vou_month'];
          echo "</td>";       
        } 


        echo "<td valign='top'  >";
        echo rev_convert_date($rs['voucher_date']);
        echo "</td>";        

        echo "<td>";
        echo $rs['bill_entry_id'];
        echo "</td>";

        echo "<td>";
        echo $rs['bill_number'];
        echo "</td>";

        //if( $rep_xls=="OK" && $role_id=="admin"){
        if( $rep_xls=="OK" ){  
          echo "<td valign='top'  >";
          //echo rev_convert_date($rs['bill_month']);
          echo $rs['bill_month'];
          echo "</td>";       
        } 


        echo "<td valign='top'  >";
        echo rev_convert_date($rs['bill_date']);
        echo "</td>";
//group_array
        //if( $rep_xls=="OK" && $role_id=="admin"){
        if( $rep_xls=="OK" ){
          $supp_group_arr= explode(",",array_search(trim($rs['supplier_account_code']),$group_array));
          // Supplier City
          echo "<td valign='top'  >";
          echo substr(trim($supp_group_arr[1]),0,$string_disp);
          echo "</td>";       

          // Supplier Group
          echo "<td valign='top'  >";
          echo substr(trim($supp_group_arr[0]),0,$string_disp);
          echo "</td>";       
        } 

        echo "<td>";
        echo substr(trim(array_search($rs['supplier_account_code'],$company_array)),0,$string_disp);
        echo "</td>";

        //if( $rep_xls=="OK" && $role_id=="admin"){
        if( $rep_xls=="OK" ){
          $buyer_group_arr= explode(",",array_search(trim($rs['buyer_account_code']),$group_array));

          // Buyer Group
          echo "<td valign='top'  >";
          echo substr(trim($buyer_group_arr[0]),0,$string_disp);
          echo "</td>";       
        }         

        echo "<td>";
        echo substr(trim(array_search($rs['buyer_account_code'],$company_array)),0,$string_disp);
        echo "</td>";
        
        echo "<td align='Right'>";
        if($rs['bill_entry_id']!=$old_bill_entry_id){
          echo zeroToBlank(number_format($rs['bill_amount'],2,'.',''));
          $bill_sub_total+=$rs['bill_amount'];
          $bill_page_total+=$rs['bill_amount'];
        }
        echo "</td>";
        

        echo "<td valign='top'  >";
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
        /*
        if(is_null($rs['balance_amount'])){
          $old_bal_amt=$rs['bill_amount'];
        }else{
          $old_bal_amt=$rs['balance_amount'];
        }
        */
        $old_bill_entry_id=$rs['bill_entry_id'];
        $old_buyer_code=$rs['buyer_account_code'];


    }
    
    echo "<td align='Right'>";  
    echo number_format($old_bal_amt,2,'.','');
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

    $colspan_gross=6;
    //if( $rep_xls=="OK" && $role_id=="admin"){
    if( $rep_xls=="OK" ){
      $colspan_gross=11;
    }


    echo "<tr> <td  colspan='".$colspan_gross."' align='Right' ><b>Gross Total</b></td> 
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
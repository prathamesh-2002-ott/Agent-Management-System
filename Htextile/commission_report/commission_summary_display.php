<table  class="tbl_border" >

<tr><td align='right'>
<?php if(isset($rep_print)){
		if($rep_print!="OK") {?>	
<input  type="button" class="form-button" onclick="excelDownLoad()" name="ls_dnload" value="Download Excel" />
<input  type="button" class="form-button" onclick="pdfDownLoad()" name="ls_dnload" value="Print" /> 
<?php } 
}?>
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

$rep_supplier_code=$_REQUEST['supplier_group_code'];
$disp_suppllier_code=array_search($rep_supplier_code,$company_array);

$comm_report_type=$_REQUEST['comm_report_type'];
$rep_start_date=convert_date($_REQUEST['start_date']);
$rep_end_date=convert_date($_REQUEST['end_date']);
$start_date=$_REQUEST['start_date'];
$end_date=$_REQUEST['end_date'];
$GST_DISP=$_REQUEST['GST'];

if($comm_report_type=="Bill Wise"){

	/* New Query
	

SELECT  bill_supplier_name, 
		bill_supp_group_name,
		bill_supp_company_id,
		total_bill_amount, 
		total_discount, 
		total_gr, 
		total_payment AS total_bill_payment, 
		pay_supp_company_id,
		supp_comm 
FROM (SELECT supp_firm_name AS bill_supplier_name , 
			 supp_group_name AS bill_supp_group_name,
			 supp_company_id AS bill_supp_company_id,
			 SUM(bill_amount ) AS total_bill_amount, 
			 AVG(comm_per) AS supp_comm 
	  FROM txt_bill_entry ,( SELECT supp.company_id AS supp_company_id, 
									supp.firm_name AS supp_firm_name , 
									supp.commission_percentage AS comm_per ,
									grp.group_name AS supp_group_name
							 FROM txt_company AS supp ,txt_group_master AS grp
							 WHERE supp.delete_tag='FALSE' 
							 AND firm_type='Supplier' 
							 AND grp.group_id=supp.group_id
							 ORDER BY firm_name) AS Supplier 
	  WHERE delete_tag='FALSE' 
	  AND supp_company_id=supplier_account_code 
	  AND bill_date>='2019-04-01' 
	  AND bill_date<='2021-03-31' 
	  GROUP BY supp_firm_name ,supp_company_id,supp_group_name
	  ORDER BY supp_firm_name ,supp_company_id,supp_group_name ) AS t1 

LEFT JOIN (SELECT SUM(discount_amount) AS total_discount, 
				  SUM(gr_amount) AS total_gr, 
				  SUM(payment_amount) AS total_payment, 
				  supplier_account_code AS pay_supp_company_id
		   FROM txt_payment_entry_main 
		   WHERE delete_tag='FALSE' 
		   GROUP BY supplier_account_code 
		   ORDER BY supplier_account_code ) AS t2 
ON bill_supp_company_id=pay_supp_company_id


	*/
	/*  Old Query

	SELECT bill_supplier_name,
		total_bill_amount,
		total_discount,
		total_gr,
		total_payment,
		pay_supplier_name 
	FROM 
		(SELECT supp_firm_name AS bill_supplier_name , 
				sum(bill_amount ) AS total_bill_amount
		FROM txt_bill_entry ,( SELECT supp.company_id AS supp_company_id,
							supp.firm_name AS supp_firm_name 
						FROM txt_company AS supp 
						WHERE supp.delete_tag='FALSE' 
						AND firm_type='Supplier' 
						ORDER BY firm_name) AS Supplier 
		WHERE delete_tag='FALSE' AND  supplier_account_code IN ( SELECT company_id 
												from txt_company 
												Where delete_tag='FALSE' 
												and firm_type='Supplier'
												and group_id='$rep_supplier_code')
		AND supp_company_id=supplier_account_code 
		AND bill_date>='2019-04-01' 
		AND bill_date<='2020-03-31' 
		GROUP BY supp_firm_name 
		ORDER BY supp_firm_name  ) AS t1 
		
		LEFT JOIN 
		(SELECT sum(discount_amount) AS total_discount, 
				sum(gr_amount) AS total_gr, 
				sum(payment_amount) AS total_payment, 
				supp_firm_name  AS pay_supplier_name
		FROM txt_payment_entry_main ,( SELECT supp.company_id AS supp_company_id,
							supp.firm_name AS supp_firm_name 
						FROM txt_company AS supp 
						WHERE supp.delete_tag='FALSE' 
						AND firm_type='Supplier' 
						ORDER BY firm_name) AS Supplier
		WHERE delete_tag='FALSE' AND
		supp_company_id=supplier_account_code
		GROUP BY supp_firm_name
		ORDER BY supp_firm_name  ) AS t2 
		
		ON bill_supplier_name=pay_supplier_name

	*/
	$sql_comm_bill=" SELECT bill_supplier_name,
							bill_supp_group_name,
							bill_supp_company_id,
							total_bill_amount,
							total_discount,
							total_gr,
							total_payment AS total_bill_payment,
							pay_supp_company_id,
							supp_comm,agent_id,city
					FROM 
					(SELECT supp_firm_name AS bill_supplier_name , 
							supp_group_name AS bill_supp_group_name,
							supp_company_id AS bill_supp_company_id,
							sum(bill_amount ) AS total_bill_amount,
							AVG(comm_per) AS supp_comm ,
							agent_id,city
					FROM txt_bill_entry ,( SELECT supp.company_id AS supp_company_id,
												  supp.firm_name AS supp_firm_name ,
												  supp.agent_id AS agent_id, city,
												  supp.commission_percentage AS comm_per,
												  grp.group_name AS supp_group_name
											FROM txt_company AS supp ,txt_group_master AS grp
											WHERE supp.delete_tag='FALSE' 
											AND firm_type='Supplier'
											AND grp.group_id=supp.group_id ";
											if($rep_supplier_code!='') {
												$sql_comm_bill.= " and supp.group_id='$rep_supplier_code' ";
											}

							$sql_comm_bill.= " ORDER BY firm_name) AS Supplier 
					WHERE delete_tag='FALSE' ";
/*					
		if($rep_supplier_code!='') {
					$sql_comm_bill.=" AND  supplier_account_code IN ( SELECT company_id 
												from txt_company 
												Where delete_tag='FALSE' 
												and firm_type='Supplier'
												and group_id='$rep_supplier_code') ";
		}  
*/		
	$sql_comm_bill.= " AND supp_company_id=supplier_account_code ";
		if($start_date!=''){
			$sql_comm_bill.=" AND bill_date>='$rep_start_date' ";
		}
		if($end_date!=''){
			$sql_comm_bill.=" AND bill_date<='$rep_end_date' ";
		}
	$sql_comm_bill.=" GROUP BY supp_firm_name ,supp_company_id,supp_group_name 
					ORDER BY supp_firm_name ,supp_company_id,supp_group_name  ) AS t1 

					LEFT JOIN 
					(SELECT SUM(PAY_BILL.dis_amount) AS total_discount, 
					SUM(PAY_BILL.bill_gr_amt) AS total_gr, 
					SUM(PAY_BILL.payment_received) AS total_payment, 
					supplier_account_code AS pay_supp_company_id
			FROM txt_payment_entry_main AS MAIN ,txt_payment_bill_entry AS PAY_BILL
			
			WHERE MAIN.delete_tag='FALSE'   AND PAY_BILL.delete_tag='FALSE'   
			AND MAIN.payment_entry_id=PAY_BILL.payment_entry_id ";

			if($start_date!=''){
				$sql_comm_bill.=" AND bill_date>='$rep_start_date' ";
			}
			if($end_date!=''){
				$sql_comm_bill.=" AND bill_date<='$rep_end_date' ";
			}
			
			
			  
	  
/*					
					if($rep_supplier_code!='') {
						$sql_comm_bill.=" AND  supplier_account_code IN ( SELECT company_id 
													from txt_company 
													Where delete_tag='FALSE' 
													and firm_type='Supplier'
													and group_id='$rep_supplier_code') ";
					}  				  
*/					
		$sql_comm_bill.=" GROUP BY MAIN.supplier_account_code  
		ORDER BY MAIN.supplier_account_code  ) AS t2 

					ON bill_supp_company_id=pay_supp_company_id ";

	//echo $sql_comm_bill;
	$result=mysqli_query($con,$sql_comm_bill);
	comm_log("SQL COMM BILL");
	comm_log($sql_comm_bill);
	$count=0;

	?>

	<tr><th colspan='13'><h3>Commission Summary Report (Bill Wise)</h3></th></tr>
	<tr><th colspan='13'><b><?php echo " From ".$start_date." To ".$end_date ?></b></th></tr>

	<tr>

	<td>S.No.
	</td>
	<td>Agent</td>
	<td> City</td>
	<td>Group</td>
	<td>Supplier Name</td>

	<td align='right'>Total Bill Amount
	</td>

	<td align='right' >Total Discount
	</td>
	<td align='right' >Total GR 
	</td>
	<td align='right'>Total Payment
	</td>

	<td align='right'>Commision %
	</td>

	<td align='right'>Net Bill Amount
	</td>

	<td align='right'>Commission Amount
	</td>

	<td align='right'>Commission Amount (Less GST <?php echo $GST_DISP ;?> %)
	</td>	

	</tr>

	<?php
	$sno=0;
	$page_total_bill_amt=$page_total_discount=$page_total_bill_payment=0;
	$page_total_comm_less_gst=$page_total_comm_amt=$page_total_gr=$page_total_net_bill_amt=0;
	$page_bill_total_payment=0;
	

	while($rs= mysqli_fetch_array($result)){

		$sno++;

		echo "<tr>";

		echo "<td>";
		echo $sno;
		echo "</td>";


		////echo array_search(8,$company_array); 
		echo "<td>";
	
		echo array_search($rs['agent_id'],$company_array);
		echo "</td>";

		echo "<td>";
		echo $rs['city'];

		echo "</td>";

		
		echo "<td>";
		echo $rs['bill_supp_group_name'];
		echo "</td>";

		echo "<td>";
		echo $rs['bill_supplier_name'];
		echo "</td>";

		echo "<td align='right' >";
		echo zeroToBlank(number_format($rs['total_bill_amount'],2,'.',''));
		echo "</td>";	
		$page_total_bill_amt +=$rs['total_bill_amount'];

		echo "<td align='right' >";
		echo zeroToBlank(number_format($rs['total_discount'],2,'.',''));
		echo "</td>";	
		$page_total_discount+=$rs['total_discount'];

		echo "<td align='right' >";
		echo zeroToBlank(number_format($rs['total_gr'],2,'.',''));
		echo "</td>";	
		$page_total_gr+=$rs['total_gr'];

		echo "<td align='right' >";
		echo zeroToBlank(number_format($rs['total_bill_payment'],2,'.',''));
		echo "</td>";	
		$page_bill_total_payment+=$rs['total_bill_payment'];

		echo "<td align='right' >";
		echo zeroToBlank(number_format($rs['supp_comm'],2,'.',''));
		echo "</td>";

		$net_bill_amount=($rs['total_bill_amount']-$rs['total_discount']-$rs['total_gr']);
		echo "<td align='right' >";
		echo zeroToBlank(number_format($net_bill_amount,2,'.',''));
		echo "</td>";
		$page_total_net_bill_amt+=$net_bill_amount;


		$comm_amt=(($net_bill_amount*$rs['supp_comm'])/100);
		echo "<td align='right' >";
		echo zeroToBlank(number_format($comm_amt,2,'.',''));
		echo "</td>";
		$page_total_comm_amt+=$comm_amt;


		$comm_amt_less_gst=(($comm_amt/(100+$GST_DISP))*100);
		//$comm_amt_less_gst=$comm_amt*((100-$GST_DISP)/100);
		echo "<td align='right' >";
		echo zeroToBlank(number_format($comm_amt_less_gst,2,'.',''));
		echo "</td>";
		$page_total_comm_less_gst+=$comm_amt_less_gst;

		echo "</tr>";

	} //end While

	echo "<tr>";
	echo "<td align='right' colspan='5'> Total </td>";
	echo "<td align='right' >".zeroToBlank(number_format( $page_total_bill_amt,2,'.',''))." </td>";
	echo "<td align='right' > ".zeroToBlank(number_format($page_total_discount,2,'.',''))." </td>";
	echo "<td align='right' >".zeroToBlank(number_format($page_total_gr,2,'.',''))." </td>";
	echo "<td align='right' >".zeroToBlank(number_format( $page_bill_total_payment,2,'.','')) ."</td>";
	echo "<td align='right' > </td>";
	echo "<td align='right' > ".zeroToBlank(number_format($page_total_net_bill_amt,2,'.',''))." </td>";
	echo "<td align='right' >". zeroToBlank(number_format($page_total_comm_amt,2,'.',''))." </td>";
	echo "<td align='right' >". zeroToBlank(number_format($page_total_comm_less_gst,2,'.',''))." </td>";
	echo "</tr>";
	
} // End if($comm_report_type=="Bill Wise")


// For Payment Wise Report
if($comm_report_type=="Payment Wise"){

	/*
			SELECT  sum(discount_amount) AS total_discount, 
					sum(gr_amount) AS total_gr, 
					sum(payment_amount) AS total_payment, 
					AVG(comm_per) AS supp_comm, 
					supp_firm_name AS pay_supplier_name ,
					supp_group_name AS pay_group_name
					
			FROM txt_payment_entry_main ,( SELECT supp.company_id AS supp_company_id, 
												supp.firm_name AS supp_firm_name , 
												supp.commission_percentage AS comm_per ,
												grp.group_name AS supp_group_name
										FROM txt_company AS supp ,txt_group_master AS grp
										WHERE supp.delete_tag='FALSE' 
										AND firm_type='Supplier' 
										AND grp.group_id=supp.group_id 
										ORDER BY firm_name) AS Supplier 
			WHERE delete_tag='FALSE' 
			AND supp_company_id=supplier_account_code 
			AND voucher_date>='2020-04-01' 
			AND voucher_date<='2021-03-31' 
			GROUP BY supp_firm_name,supp_group_name 
			ORDER BY supp_firm_name,supp_group_name
	*/

	$sql_comm_pay=" SELECT sum(discount_amount) AS total_discount, 
						  sum(gr_amount) AS total_gr, 
						  sum(payment_amount) AS total_payment, 
						  AVG(comm_per) AS supp_comm,
						  supp_firm_name  AS pay_supplier_name,
						  supp_group_name AS pay_group_name ,agent_id ,city
					FROM txt_payment_entry_main ,( SELECT supp.company_id AS supp_company_id,
														  supp.firm_name AS supp_firm_name ,
														  supp.commission_percentage AS comm_per ,
														  grp.group_name AS supp_group_name,supp.agent_id AS agent_id ,city
													FROM txt_company AS supp ,txt_group_master AS grp
													WHERE supp.delete_tag='FALSE' 
													AND firm_type='Supplier' 
													AND grp.group_id=supp.group_id  ";
													if($rep_supplier_code!='') {
														$sql_comm_pay.=" and supp.group_id='$rep_supplier_code' ";
													}

									$sql_comm_pay.=" ORDER BY firm_name) AS Supplier
					WHERE delete_tag='FALSE' ";
/*
	if($rep_supplier_code!='') {
		$sql_comm_pay.=" AND  supplier_account_code IN ( SELECT company_id 
									from txt_company 
									Where delete_tag='FALSE' 
									and firm_type='Supplier'
									and group_id='$rep_supplier_code') ";
	} 
*/

		$sql_comm_pay.=" AND supp_company_id=supplier_account_code ";

	if($start_date!=''){
		$sql_comm_pay.=" AND voucher_date>='$rep_start_date' ";
	}
	if($end_date!=''){
		$sql_comm_pay.=" AND voucher_date<='$rep_end_date' ";
	}

	$sql_comm_pay.=" GROUP BY supp_firm_name,supp_group_name
					ORDER BY supp_firm_name,supp_group_name ";


	//echo $sql_comm_pay;	
	
	$result=mysqli_query($con,$sql_comm_pay);
	comm_log("SQL COMM PAY");
	comm_log($sql_comm_pay);
	$count=0;
?>
<tr><th colspan='12'><h3>Commission Summary Report (Payment Wise)</h3></th></tr>
<tr><th colspan='12'><b><?php echo " From ".$start_date." To ".$end_date ?></b></th></tr>

<tr>

<td>S.No.
</td>
<td>Agent</td>
<td> City</td>

<td>Group</td>

<td>Supplier Name</td>


<td align='right'>Total Payment
</td>

<td align='right'>Commision %
</td>


<td align='right'>Commission Amount
</td>

<td align='right'>Commission Amount (Less GST <?php echo $GST_DISP ;?> %)
	</td>

</tr>

<?php 

	$sno=0;

	while($rs= mysqli_fetch_array($result)){

		$sno++;

		echo "<tr>";

		echo "<td>";
		echo $sno;
		echo "</td>";

		////echo array_search(8,$company_array); 
		echo "<td>";

		echo array_search($rs['agent_id'],$company_array);
		echo "</td>";

		echo "<td>";
		echo $rs['city'];

		echo "</td>";

		echo "<td>";
		echo $rs['pay_group_name'];
		echo "</td>";

		echo "<td>";
		echo $rs['pay_supplier_name'];
		echo "</td>";

		echo "<td align='right' >";
		echo zeroToBlank(number_format($rs['total_payment'],2,'.',''));
		echo "</td>";	
		$page_total_payment+=$rs['total_payment'];

		echo "<td align='right' >";
		echo zeroToBlank(number_format($rs['supp_comm'],2,'.',''));
		echo "</td>";

		$comm_amt=(($rs['total_payment']*$rs['supp_comm'])/100);
		echo "<td align='right' >";
		echo zeroToBlank(number_format($comm_amt,2,'.',''));
		echo "</td>";
		$page_total_comm_amt+=$comm_amt;



		$comm_amt_less_gst=(($comm_amt/(100+$GST_DISP))*100);
		//$comm_amt_less_gst=$comm_amt*((100-$GST_DISP)/100);
		echo "<td align='right' >";
		echo zeroToBlank(number_format($comm_amt_less_gst,2,'.',''));
		echo "</td>";
		$page_total_comm_less_gst+=$comm_amt_less_gst;



		echo "</tr>";

	} // End While

	echo "<tr>";
	echo "<td align='right' colspan='5'> Total </td>";
	echo "<td align='right' >".zeroToBlank(number_format($page_total_payment,2,'.',''))." </td>";
	echo "<td align='right' > </td>";
	echo "<td align='right' > ".zeroToBlank(number_format($page_total_comm_amt,2,'.',''))." </td>";
	echo "<td align='right' > ".zeroToBlank(number_format($page_total_comm_less_gst,2,'.',''))." </td>";	
	echo "</tr>";


} // End if($comm_report_type=="Payment Wise")


if($comm_report_type=="Both"){


/* New Query


SELECT 	SUM(total_bill_amount_bill) AS total_bill_amount_bill, 
		SUM(total_discount_bill) AS total_discount_bill, 
		SUM(total_gr_bill) AS total_gr_bill, 
		SUM(total_bill_payment_bill) AS total_bill_payment_bill, 
		AVG(supp_comm_bill) AS supp_comm_bill, 
		SUM(total_discount_pay) AS total_discount_pay, 
		SUM(total_gr_pay) AS total_gr_pay, 
		SUM(total_payment_pay) AS total_payment_pay, 
		AVG(supp_comm_pay) AS supp_comm_pay, 
		pay_supplier_name ,
		pay_group_name
FROM ( SELECT 	total_bill_amount AS total_bill_amount_bill, 
				total_discount AS total_discount_bill, 
				total_gr AS total_gr_bill, 
				total_payment AS total_bill_payment_bill, 
				supp_comm AS supp_comm_bill, 
				'0' AS total_discount_pay, 
				'0' AS total_gr_pay, 
				'0' AS total_payment_pay, 
				supp_comm AS supp_comm_pay, 
				bill_supplier_name AS pay_supplier_name ,
				bill_supp_group_name As pay_group_name
				
	   FROM (SELECT supp_firm_name AS bill_supplier_name , 
					supp_group_name AS bill_supp_group_name,
					supp_company_id AS bill_supp_company_id,	   
					sum(bill_amount ) AS total_bill_amount, 
					AVG(comm_per) AS supp_comm 
			 FROM txt_bill_entry ,( SELECT 	supp.company_id AS supp_company_id, 
											supp.firm_name AS supp_firm_name , 
											supp.commission_percentage AS comm_per ,
											grp.group_name AS supp_group_name
									FROM txt_company AS supp   ,txt_group_master AS grp
									WHERE supp.delete_tag='FALSE' 
									AND firm_type='Supplier' 
									AND grp.group_id=supp.group_id
									ORDER BY firm_name) AS Supplier 
			 WHERE delete_tag='FALSE' 
			 AND supp_company_id=supplier_account_code 
			 AND bill_date>='2020-04-01' 
			 AND bill_date<='2021-03-31' 
			 GROUP BY bill_supplier_name 
			 ORDER BY bill_supplier_name ) AS t1 

	   LEFT JOIN 

		(SELECT sum(discount_amount) AS total_discount, 
				sum(gr_amount) AS total_gr, 
				sum(payment_amount) AS total_payment, 

				supplier_account_code AS pay_supp_company_id
		 FROM txt_payment_entry_main 
		 WHERE delete_tag='FALSE' 
 
		 GROUP BY supplier_account_code 
		 ORDER BY supplier_account_code) AS t2 
		 
		 ON bill_supp_company_id=pay_supp_company_id 
		 
		 UNION SELECT 	'0' AS total_bill_amount_bill, 
						'0' AS total_discount_bill, 
						'0' AS total_gr_bill, 
						'0' AS total_bill_payment_bill, 
						AVG(comm_per) AS supp_comm_bill, 
						sum(discount_amount) AS total_discount_pay, 
						sum(gr_amount) AS total_gr_pay, 
						sum(payment_amount) AS total_payment_pay, 
						AVG(comm_per) AS supp_comm_pay, 
						supp_firm_name AS pay_supplier_name ,
						supp_group_name AS pay_group_name
			   FROM txt_payment_entry_main ,( SELECT supp.company_id AS supp_company_id, 
													 supp.firm_name AS supp_firm_name , 
													 supp.commission_percentage AS comm_per ,
													 grp.group_name AS supp_group_name
											  FROM txt_company AS supp ,txt_group_master AS grp
											  WHERE supp.delete_tag='FALSE' 
											  AND firm_type='Supplier' 
											  AND grp.group_id=supp.group_id 
											  ORDER BY firm_name) AS Supplier 
			   WHERE delete_tag='FALSE' 
			   AND supp_company_id=supplier_account_code 
			   AND voucher_date>='2020-04-01' 
			   AND voucher_date<='2021-03-31' 
			   GROUP BY supp_firm_name ,supp_group_name ) U1 
GROUP BY pay_supplier_name ,pay_group_name
ORDER BY pay_supplier_name ,pay_group_name
*/

			/* Old Query

			SELECT  SUM(total_bill_amount_bill) AS total_bill_amount_bill, 
				SUM(total_discount_bill) AS total_discount_bill, 
				SUM(total_gr_bill) AS total_gr_bill, 
				SUM(total_bill_payment_bill) AS total_bill_payment_bill, 
				AVG(supp_comm_bill) AS supp_comm_bill, 
				SUM(total_discount_pay) AS total_discount_pay, 
				SUM(total_gr_pay) AS total_gr_pay, 
				SUM(total_payment_pay) AS total_payment_pay, 
				AVG(supp_comm_pay) AS supp_comm_pay, 
				pay_supplier_name  
				FROM 

		(

		SELECT total_bill_amount AS total_bill_amount_bill, 
				total_discount AS total_discount_bill, 
				total_gr AS total_gr_bill, 
				total_payment AS total_bill_payment_bill, 
				supp_comm AS supp_comm_bill, 
				'0' AS total_discount_pay, 
				'0' AS total_gr_pay, 
				'0' AS total_payment_pay, 
				supp_comm AS supp_comm_pay, 
				bill_supplier_name AS pay_supplier_name 
		FROM (SELECT supp_firm_name AS bill_supplier_name , 
					SUM(bill_amount ) AS total_bill_amount, 
					AVG(comm_per) AS supp_comm 
			FROM txt_bill_entry ,( SELECT supp.company_id AS supp_company_id, 
											supp.firm_name AS supp_firm_name , 
											supp.commission_percentage AS comm_per 
									FROM txt_company AS supp 
									WHERE supp.delete_tag='FALSE' 
									AND firm_type='Supplier' 
									ORDER BY firm_name) AS Supplier 
			WHERE delete_tag='FALSE' 
			AND supp_company_id=supplier_account_code 
			AND bill_date>='2019-04-01' 
			AND bill_date<='2021-03-31' 
			GROUP BY bill_supplier_name 
			ORDER BY bill_supplier_name ) AS t1 
		LEFT JOIN (SELECT SUM(discount_amount) AS total_discount, 
							SUM(gr_amount) AS total_gr, 
							SUM(payment_amount) AS total_payment, 
							supp_firm_name AS pay_supplier_name 
					FROM txt_payment_entry_main ,( SELECT supp.company_id AS supp_company_id, 
															supp.firm_name AS supp_firm_name 
												FROM txt_company AS supp 
												WHERE supp.delete_tag='FALSE' 
												AND firm_type='Supplier' 
												ORDER BY firm_name) AS Supplier 
					WHERE delete_tag='FALSE' 
					AND supp_company_id=supplier_account_code 
					GROUP BY supp_firm_name 
					ORDER BY supp_firm_name ) AS t2 
		ON bill_supplier_name=pay_supplier_name 

		UNION 
		
		SELECT '0' AS total_bill_amount_bill, 
				'0' AS total_discount_bill, 
				'0' AS total_gr_bill, 
				'0' AS total_bill_payment_bill, 
				AVG(comm_per) AS supp_comm_bill, 
				SUM(discount_amount) AS total_discount_pay, 
				SUM(gr_amount) AS total_gr_pay, 
				SUM(payment_amount) AS total_payment_pay, 
				AVG(comm_per) AS supp_comm_pay, 
				supp_firm_name AS pay_supplier_name 
		FROM txt_payment_entry_main ,( SELECT supp.company_id AS supp_company_id, 
												supp.firm_name AS supp_firm_name , 
												supp.commission_percentage AS comm_per 
										FROM txt_company AS supp 
										WHERE supp.delete_tag='FALSE' 
										AND firm_type='Supplier' 
										ORDER BY firm_name) AS Supplier 
		WHERE delete_tag='FALSE' 
		AND supp_company_id=supplier_account_code 
		AND voucher_date>='2019-04-01' 
		AND voucher_date<='2021-03-31' 
		GROUP BY supp_firm_name 

		) U1 

		GROUP BY pay_supplier_name
		ORDER BY pay_supplier_name



			*/

			$sql_comm_bill_both=" SELECT total_bill_amount AS total_bill_amount_bill,
			total_discount AS total_discount_bill,
			total_gr AS total_gr_bill,
			total_payment AS total_bill_payment_bill,
			supp_comm AS supp_comm_bill,
			'0' AS total_discount_pay,
			'0' AS total_gr_pay,
			'0' AS total_payment_pay,
			supp_comm  AS supp_comm_pay,
			bill_supplier_name AS pay_supplier_name,
			bill_supp_group_name As pay_group_name ,agent_id,city
		FROM 
		(SELECT supp_firm_name AS bill_supplier_name , 
				supp_group_name AS bill_supp_group_name,
				supp_company_id AS bill_supp_company_id,
				sum(bill_amount ) AS total_bill_amount,
				AVG(comm_per) AS supp_comm ,agent_id,city
		FROM txt_bill_entry ,( SELECT supp.company_id AS supp_company_id,
									supp.firm_name AS supp_firm_name ,
									supp.commission_percentage AS comm_per,
									grp.group_name AS supp_group_name ,supp.agent_id AS agent_id,city
							FROM txt_company AS supp   ,txt_group_master AS grp
							WHERE supp.delete_tag='FALSE' 
							AND firm_type='Supplier' 
							AND grp.group_id=supp.group_id ";
							if($rep_supplier_code!='') {
								$sql_comm_bill_both.=" and supp.group_id='$rep_supplier_code'";
							}
	$sql_comm_bill_both.=" ORDER BY firm_name) AS Supplier 
		WHERE delete_tag='FALSE' ";
		/*
		if($rep_supplier_code!='') {
		$sql_comm_bill_both.=" AND  supplier_account_code IN ( SELECT company_id 
								from txt_company 
								Where delete_tag='FALSE' 
								and firm_type='Supplier'
								and group_id='$rep_supplier_code') ";
		} 
		*/ 
		$sql_comm_bill_both.= "AND supp_company_id=supplier_account_code ";
		if($start_date!=''){
		$sql_comm_bill_both.=" AND bill_date>='$rep_start_date' ";
		}
		if($end_date!=''){
		$sql_comm_bill_both.="AND bill_date<='$rep_end_date' ";
		}
		$sql_comm_bill_both.=" GROUP BY bill_supplier_name 
		ORDER BY bill_supplier_name  ) AS t1 

		LEFT JOIN 
		(SELECT SUM(PAY_BILL.dis_amount) AS total_discount, 
		SUM(PAY_BILL.bill_gr_amt) AS total_gr, 
		SUM(PAY_BILL.payment_received) AS total_payment, 
		supplier_account_code AS pay_supp_company_id
FROM txt_payment_entry_main AS MAIN ,txt_payment_bill_entry AS PAY_BILL

WHERE MAIN.delete_tag='FALSE'   AND PAY_BILL.delete_tag='FALSE'   
AND MAIN.payment_entry_id=PAY_BILL.payment_entry_id ";

if($start_date!=''){
	$sql_comm_bill_both.=" AND bill_date>='$rep_start_date' ";
}
if($end_date!=''){
	$sql_comm_bill_both.=" AND bill_date<='$rep_end_date' ";
}  
		/*
		if($rep_supplier_code!='') {
		$sql_comm_bill_both.=" AND  supplier_account_code IN ( SELECT company_id 
									from txt_company 
									Where delete_tag='FALSE' 
									and firm_type='Supplier'
									and group_id='$rep_supplier_code') ";
		}  	
		*/			  
		//AND supp_company_id=supplier_account_code  

		$sql_comm_bill_both.=" 
		GROUP BY MAIN.supplier_account_code 
		ORDER BY MAIN.supplier_account_code  ) AS t2 

		ON bill_supp_company_id=pay_supp_company_id  ";


		// Query for Payment with date range

		$sql_comm_pay_both=" SELECT 

		'0' AS total_bill_amount_bill,
		'0' AS total_discount_bill,
		'0' AS total_gr_bill,
		'0' AS total_bill_payment_bill,
		AVG(comm_per) AS supp_comm_bill,
		sum(discount_amount) AS total_discount_pay, 
		sum(gr_amount) AS total_gr_pay, 
		sum(payment_amount) AS total_payment_pay, 
		AVG(comm_per) AS supp_comm_pay,
		supp_firm_name  AS pay_supplier_name,
		supp_group_name AS pay_group_name ,agent_id,city
		FROM txt_payment_entry_main ,( SELECT supp.company_id AS supp_company_id,
										supp.firm_name AS supp_firm_name ,
										supp.commission_percentage AS comm_per,
										grp.group_name AS supp_group_name ,supp.agent_id AS agent_id,city
								FROM txt_company AS supp ,txt_group_master AS grp
								WHERE supp.delete_tag='FALSE' 
								AND firm_type='Supplier' 
								AND grp.group_id=supp.group_id  ";
								if($rep_supplier_code!='') {
									$sql_comm_pay_both.=" and supp.group_id='$rep_supplier_code' ";
								}

		 $sql_comm_pay_both.=" ORDER BY firm_name) AS Supplier
		WHERE delete_tag='FALSE' ";
/*								
		if($rep_supplier_code!='') {
		$sql_comm_pay_both.=" AND  supplier_account_code IN ( SELECT company_id 
				from txt_company 
				Where delete_tag='FALSE' 
				and firm_type='Supplier'
				and group_id='$rep_supplier_code') ";
		} 

*/
		$sql_comm_pay_both.=" AND supp_company_id=supplier_account_code ";

		if($start_date!=''){
		$sql_comm_pay_both.=" AND voucher_date>='$rep_start_date' ";
		}
		if($end_date!=''){
		$sql_comm_pay_both.=" AND voucher_date<='$rep_end_date' ";
		}

		$sql_comm_pay_both.=" GROUP BY supp_firm_name ,supp_group_name 
		";

		$sql_comm_both= "	SELECT 
		pay_group_name,
		pay_supplier_name  ,
		SUM(total_bill_amount_bill) AS total_bill_amount_bill, 
		SUM(total_discount_bill) AS total_discount_bill, 
		SUM(total_gr_bill) AS total_gr_bill, 
		SUM(total_bill_payment_bill) AS total_bill_payment_bill, 
		AVG(supp_comm_bill) AS supp_comm_bill, 
		SUM(total_discount_pay) AS total_discount_pay, 
		SUM(total_gr_pay) AS total_gr_pay, 
		SUM(total_payment_pay) AS total_payment_pay, 
		AVG(supp_comm_pay) AS supp_comm_pay 
		,agent_id,city
		FROM 

		( ";

		$sql_comm_both.=$sql_comm_bill_both. " UNION ".$sql_comm_pay_both;
		$sql_comm_both.= " ) U1 
		GROUP BY pay_supplier_name ,pay_group_name
		ORDER BY pay_supplier_name ,pay_group_name ";

		//echo $sql_comm_both;
		$result=mysqli_query($con,$sql_comm_both);
		comm_log(" SQL COMM BOTH");
		comm_log($sql_comm_both);
		$count=0;
?>
		<tr><th colspan='16'><h3>Commission Summary Report (Bill Wise & Payment Wise)</h3></th></tr>
		<tr><th colspan='16'><b><?php echo " From ".$start_date." To ".$end_date ?></b></th></tr>
	
		<tr>
		<td>S.No.
		</td>
		<td>Agent</td>
		<td> City</td>

		<td>Group </td>
		<td>Supplier Name</td>
		<td align='right'>Commision %
		</td>		
		<td align='right'>Total Bill Amount
		</td>
		<td align='right' >Total Discount
		</td>
		<td align='right' >Total GR 
		</td>

		<td align='right'>Net Bill Amount
		</td>
		<td align='right'>Commission Amount  (Bill Wise)
		</td>
		<td align='right'>Commission Amount  (Bill Wise) (Less GST <?php echo $GST_DISP ;?> %)
		</td>
		<td align='right'>&nbsp;
		</td>		

		<td align='right'>Payment Amount 
		</td>
		<td align='right'>Commission Amount  (Payment Wise)
		</td>
		<td align='right'>Commission Amount  (Payment Wise) (Less GST <?php echo $GST_DISP ;?> %)
	</td>
		</tr>

<?php
$page_total_comm_amt_pay_less_gst=$page_total_comm_amt_ill_less_gst=0;
$sno=0;
while($rs= mysqli_fetch_array($result)){

	$sno++;

	echo "<tr>";

	echo "<td>";
	echo $sno;
	echo "</td>";

	////echo array_search(8,$company_array); 
	echo "<td>";

	echo array_search($rs['agent_id'],$company_array);
	echo "</td>";

	echo "<td>";
	echo $rs['city'];

	echo "</td>";


	echo "<td>";
	echo $rs['pay_group_name'];
	echo "</td>";

	echo "<td>";
	echo $rs['pay_supplier_name'];
	echo "</td>";

	echo "<td align='right' >";
	echo zeroToBlank(number_format($rs['supp_comm_bill'],2,'.',''));
	echo "</td>";

	echo "<td align='right' >";
	echo zeroToBlank(number_format($rs['total_bill_amount_bill'],2,'.',''));
	echo "</td>";	
	$page_total_bill_amt +=$rs['total_bill_amount_bill'];

	echo "<td align='right' >";
	echo zeroToBlank(number_format($rs['total_discount_bill'],2,'.',''));
	echo "</td>";	
	$page_total_discount+=$rs['total_discount_bill'];

	echo "<td align='right' >";
	echo zeroToBlank(number_format($rs['total_gr_bill'],2,'.',''));
	echo "</td>";	
	$page_total_gr+=$rs['total_gr_bill'];

	$net_bill_amount=($rs['total_bill_amount_bill']-$rs['total_discount_bill']-$rs['total_gr_bill']);
	echo "<td align='right' >";
	echo zeroToBlank(number_format($net_bill_amount,2,'.',''));
	echo "</td>";
	$page_total_net_bill_amt+=$net_bill_amount;


	$comm_amt_bill=(($net_bill_amount*$rs['supp_comm_bill'])/100);
	echo "<td align='right' >";
	echo zeroToBlank(number_format($comm_amt_bill,2,'.',''));
	echo "</td>";
	$page_total_comm_amt_bill+=$comm_amt_bill;


	//$comm_amt_less_gst=(($comm_amt/(100+$GST_DISP))*100);
	$comm_amt_bill_less_gst=(($comm_amt_bill/(100+$GST_DISP))*100);
	echo "<td align='right' >";
	echo zeroToBlank(number_format($comm_amt_bill_less_gst,2,'.',''));
	echo "</td>";

	$page_total_comm_amt_bill_less_gst+=$comm_amt_bill_less_gst;

	echo "<td align='right' >";
	echo "&nbsp;";
	echo "</td>";	

	echo "<td align='right' >";
	echo zeroToBlank(number_format($rs['total_payment_pay'],2,'.',''));
	echo "</td>";	
	$page_total_payment_pay+=$rs['total_payment_pay'];

	$comm_amt_pay=(($rs['total_payment_pay']*$rs['supp_comm_pay'])/100);
	echo "<td align='right' >";
	echo zeroToBlank(number_format($comm_amt_pay,2,'.',''));
	echo "</td>";
	$page_total_comm_amt_pay+=$comm_amt_pay;

	//$comm_amt_less_gst=(($comm_amt/(100+$GST_DISP))*100);
	$comm_amt_pay_less_gst=(($comm_amt_pay/(100+$GST_DISP))*100);
	echo "<td align='right' >";
	echo zeroToBlank(number_format($comm_amt_pay_less_gst,2,'.',''));
	echo "</td>";

	$page_total_comm_amt_pay_less_gst+=$comm_amt_pay_less_gst;	



	echo "</tr>";

} //end While
echo "<tr>";
echo "<td align='right' colspan='5'> Total </td>";
echo "<td align='right' > </td>";
echo "<td align='right' >".zeroToBlank(number_format($page_total_bill_amt,2,'.',''))."</td>";
echo "<td align='right' > ".zeroToBlank(number_format($page_total_discount,2,'.',''))." </td>";
echo "<td align='right' >".zeroToBlank(number_format($page_total_gr,2,'.',''))." </td>";

echo "<td align='right' >". zeroToBlank(number_format($page_total_net_bill_amt,2,'.',''))." </td>";
echo "<td align='right' >". zeroToBlank(number_format($page_total_comm_amt_bill,2,'.',''))." </td>";
echo "<td align='right' >". zeroToBlank(number_format($page_total_comm_amt_bill_less_gst,2,'.',''))." </td>";
echo "<td align='right' > </td>";
echo "<td align='right' >". zeroToBlank(number_format($page_total_payment_pay,2,'.',''))." </td>";
echo "<td align='right' >". zeroToBlank(number_format($page_total_comm_amt_pay,2,'.',''))." </td>";
echo "<td align='right' >". zeroToBlank(number_format($page_total_comm_amt_pay_less_gst,2,'.',''))." </td>";
echo "</tr>";











} //if($comm_report_type=="Both")


?>

</table>

</td></tr></table>
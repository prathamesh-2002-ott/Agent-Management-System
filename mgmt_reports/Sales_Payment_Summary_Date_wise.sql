SELECT *
							
					FROM 
					(SELECT  
							bill_date AS bill_date,
	
							SUM(bill_amount ) AS total_bill_amount
							
					FROM txt_bill_entry 
					WHERE delete_tag='FALSE'   AND bill_date>='2020-04-01'  AND bill_date<='2021-03-31'  GROUP BY bill_date 
					ORDER BY bill_date  ) AS t1 

					LEFT JOIN 
					(SELECT SUM(discount_amount) AS total_discount, 
					SUM(gr_amount) AS total_gr, 
					SUM(payment_amount) AS total_payment, 
					voucher_date AS pay_date
			FROM txt_payment_entry_main  
			
			WHERE delete_tag='FALSE'     
			  AND voucher_date>='2020-04-01'  AND voucher_date<='2021-03-31'  GROUP BY  pay_date  
		ORDER BY  pay_date  ) AS t2 

					ON bill_date=pay_date 

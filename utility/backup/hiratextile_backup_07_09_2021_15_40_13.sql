

  DROP TABLE IF EXISTS `menu`; 



CREATE TABLE `menu` (
  `menu_id` int(11) NOT NULL auto_increment,
  `menu_name` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL default '0' COMMENT '0 if menu is root level or menuid if this is child on any menu',
  `link` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL default '1' COMMENT '0 for disabled menu or 1 for enabled menu',
  `user_role` varchar(20) NOT NULL default '',
  PRIMARY KEY  (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11707 DEFAULT CHARSET=latin1;

INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("1","Home","0","home/index.php","1","admin");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("2","Master Data","0","home/navigation.php","1","admin");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("3","Transaction","0","home/navigation.php","1","admin");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("4","Reports","0","home/navigation.php","1","admin");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("5","Commission Reports","0","home/navigation.php","1","admin");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("6","Search","0","home/navigation.php","1","admin");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("7","Utility","0","home/navigation.php","1","admin");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("8","Management Reports","0","home/navigation.php","1","admin");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("201","Group Master","2","group_master/index.php","1","admin");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("202","Company Master","2","company/index.php","1","admin");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("203","User Master","2","admin/user/index.php","1","admin");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("301","Bill Entry","3","bill_entry/index.php","1","admin");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("302","Payment Entry","3","payment_entry/index.php","1","admin");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("303","Notes","3","notes/index.php","1","admin");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("311","Add Bill","301","bill_entry/add_bill_entry.php","1","admin");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("312","Add Payment","302","payment_entry/add_payment_entry.php","1","admin");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("313","Add Notes","303","notes/add_notes.php","1","admin");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("401","Buyers Outstanding","4","home/navigation.php","1","admin");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("402","Supplier Outstanding","4","home/navigation.php","1","admin");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("403","Date Wise Outstanding","4","home/navigation.php","1","admin");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("404","Advance Payment & GR","4","advance_payment/advance_payment.php","1","admin");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("405","Payment & GR Report","4","home/navigation.php","1","admin");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("406","Ledger","4","ledger/ledger_search.php","1","admin");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("408","Bill Reports","4","bill_reports/index.php","1","admin");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("411","BO By Firm","401","outstanding_report/buyer_outstanding.php","1","admin");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("412","SO By Firm","402","outstanding_report/supplier_outstanding.php","1","admin");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("413","DWO By Firm","403","outstanding_report_date/outstanding_date.php","1","admin");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("415","PR By Firm","405","payment_reports/payment_report.php","1","admin");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("421","BO By Group","401","outstanding_report_grp/buyer_outstanding_grp.php","1","admin");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("422","SO By Group","402","outstanding_report_grp/supplier_outstanding_grp.php","1","admin");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("423","DWO By Group","403","outstanding_report_date/outstanding_grp_date.php","1","admin");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("425","PR By Group","405","payment_reports/payment_report_grp.php","1","admin");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("431","Buyer O/S By Firm Copy","401","outstanding_report/buyer_outstanding_copy.php","1","admin_1");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("501","Commission Summary","5","commission_report/commission_summary_search.php","1","admin");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("502","Commission Detail Report","5","commission_report/commission_detail_search.php","1","admin");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("601","Company Search","6","home/navigation.php","1","admin_1");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("602","Group Search","6","home/navigation.php","1","admin_1");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("603","Bill Search","6","bill_entry/bill_search.php","1","admin");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("604","Payment Search","6","payment_entry/payment_search.php","1","admin");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("701","Data Backup","7","utility/backup.php","1","admin");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("702","ZipBill","7","utility/createZipForBill_Payment_upload.php","1","admin");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("801","Sales Summary","8","mgmt_reports/mgmt_sales_summary_selection.php","1","admin");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("11100","Home","0","home/navigation.php","1","user");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("11200","Master Data","0","home/navigation.php","1","user");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("11201","Group Master","11200","group_master/index.php","1","user");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("11202","Company Master","11200","company/index.php","1","user");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("11300","Transaction","0","home/navigation.php","1","user");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("11301","Bill Entry","11300","bill_entry/index.php","1","user");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("11302","Payment Entry","11300","payment_entry/index.php","1","user");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("11303","Notes","11300","notes/index.php","1","user");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("11313","Add Notes","11303","notes/add_notes.php","1","user");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("11400","Reports","0","home/navigation.php","1","user");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("11401","Buyers Outstanding","11400","home/navigation.php","1","user");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("11402","Supplier Outstanding","11400","home/navigation.php","1","user");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("11403","Date Wise outstanding","11400","home/navigation.php","1","user");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("11406","Advance Payment & GR","11400","advance_payment/advance_payment.php","1","user");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("11407","Payment & GR Report","11400","payment_reports/payment_report.php","1","user");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("11408","Ledger","11400","ledger/ledger_search.php","1","user");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("11411","Buyer Outstanding By Firm","11401","outstanding_report/buyer_outstanding.php","1","user");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("11412","Supplier Outstanding By Firm","11402","outstanding_report/supplier_outstanding.php","1","user");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("11413","Selection by Firm","11403","outstanding_report_date/outstanding_date.php","1","user");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("11421","Buyer Outstanding By Group","11401","outstanding_report_grp/buyer_outstanding_grp.php","1","user");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("11422","Supplier Outstanding By Group","11402","outstanding_report_grp/supplier_outstanding_grp.php","1","user");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("11423","Selection by Group","11403","outstanding_report_date/outstanding_grp_date.php","1","user");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("11600","Search","0","home/navigation.php","1","user");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("11601","Company Search","11600","home/navigation.php","1","user_1");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("11602","Group Search","11600","home/navigation.php","1","user_1");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("11603","Bill Search","11600","bill_entry/bill_search.php","1","user");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("11604","Payment Search","11600","payment_entry/payment_search.php","1","user");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("11700","Utility","0","home/navigation.php","1","user");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("11701","Data Backup","11700","utility/backup.php","1","user");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("11704","Add Bill","11301","bill_entry/add_bill_entry.php","1","user");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("11705","Add Payment","11302","payment_entry/add_payment_entry.php","1","user");
INSERT INTO menu (menu_id,menu_name,parent_id,link,status,user_role) VALUES("11706","Upload Multiple Bill","7","bill_entry/upload_multiple_bill_img.php","1","admin");



  DROP TABLE IF EXISTS `notes_detail`; 



CREATE TABLE `notes_detail` (
  `notes_detail_id` bigint(20) NOT NULL auto_increment,
  `notes_main_id` bigint(20) NOT NULL default '0',
  `notes` varchar(250) NOT NULL default '',
  `notes_date` date NOT NULL default '1970-01-01',
  `delete_tag` varchar(10) default 'FALSE',
  `create_user` varchar(20) NOT NULL,
  `create_date` datetime NOT NULL default '1970-01-01 00:00:00',
  `last_update_user` varchar(20) NOT NULL,
  `last_update_date` datetime NOT NULL default '1970-01-01 00:00:00',
  `delete_user` varchar(20) NOT NULL default '',
  `delete_date` datetime NOT NULL default '1970-01-01 00:00:00',
  PRIMARY KEY  (`notes_detail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




  DROP TABLE IF EXISTS `notes_main`; 



CREATE TABLE `notes_main` (
  `notes_main_id` bigint(20) NOT NULL auto_increment,
  `notes_open_date` date NOT NULL default '1970-01-01',
  `notes_open_till` date NOT NULL default '2030-01-01',
  `notes_close_date` date NOT NULL default '2030-01-01',
  `reminder_for` varchar(20) NOT NULL default '',
  `supplier_group` int(10) NOT NULL default '0',
  `buyer_group` int(10) NOT NULL default '0',
  `supplier_code` int(10) NOT NULL default '0',
  `buyer_code` int(10) NOT NULL default '0',
  `ref_bill_number` varchar(10) NOT NULL default '',
  `status` varchar(10) NOT NULL default '',
  `delete_tag` varchar(10) default 'FALSE',
  `create_user` varchar(20) NOT NULL default '',
  `create_date` datetime NOT NULL default '1970-01-01 00:00:00',
  `last_update_user` varchar(20) NOT NULL default '',
  `last_update_date` datetime NOT NULL default '1970-01-01 00:00:00',
  `delete_user` varchar(20) NOT NULL default '',
  `delete_date` datetime NOT NULL default '1970-01-01 00:00:00',
  PRIMARY KEY  (`notes_main_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




  DROP TABLE IF EXISTS `txt_bill_entry`; 



CREATE TABLE `txt_bill_entry` (
  `bill_entry_id` bigint(20) NOT NULL auto_increment,
  `voucher_number` varchar(20) NOT NULL,
  `voucher_date` date NOT NULL default '1970-01-01',
  `bill_number` varchar(20) NOT NULL,
  `bill_date` date NOT NULL default '1970-01-01',
  `lr_number` varchar(20) NOT NULL,
  `lr_date` date NOT NULL default '1970-01-01',
  `transport_name` varchar(20) NOT NULL,
  `supplier_account_code` varchar(20) NOT NULL,
  `buyer_account_code` varchar(20) NOT NULL,
  `agent` varchar(20) NOT NULL,
  `gross_amount` decimal(15,2) NOT NULL default '0.00',
  `discount_percentage` decimal(15,2) NOT NULL default '0.00',
  `discount_amount` decimal(15,2) NOT NULL default '0.00',
  `deduction_amount` decimal(15,2) NOT NULL default '0.00',
  `additional_amount` decimal(15,2) NOT NULL default '0.00',
  `net_amount` decimal(15,2) NOT NULL default '0.00',
  `gst_percent` decimal(15,2) NOT NULL default '0.00',
  `gst_amount` decimal(15,2) NOT NULL default '0.00',
  `round_off` decimal(5,2) NOT NULL default '0.00',
  `bill_amount` decimal(15,2) NOT NULL default '0.00',
  `remarks` varchar(100) NOT NULL default '0',
  `bill_upload` varchar(200) NOT NULL default '',
  `supporting_doc` varchar(200) NOT NULL default '',
  `create_user` varchar(20) NOT NULL default '',
  `create_date` datetime NOT NULL default '1970-01-01 00:00:00',
  `last_update_user` varchar(20) NOT NULL default '',
  `last_update_date` datetime NOT NULL default '1970-01-01 00:00:00',
  `delete_tag` varchar(10) NOT NULL default 'FALSE',
  `delete_user` varchar(20) NOT NULL default '',
  `delete_date` datetime NOT NULL default '1970-01-01 00:00:00',
  PRIMARY KEY  (`bill_entry_id`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=latin1;

INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("1","","2021-09-04","15","2021-09-01","548","1970-01-01","3","1","2","33","52000.00","3.00","1560.00","1.50","0.00","50438.50","5.00","2521.93","0.57","52961.00","","","","1","2021-09-04 19:58:09","1","2021-09-04 19:58:09","TRUE","1","2021-09-06 10:53:59");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("2","","2021-09-06","263","2021-03-26","12943","1970-01-01","3","6","19","33","41085.20","0.00","0.00","0.00","399.80","41485.00","5.00","2074.25","0.00","43559.25","","","","1","2021-09-06 16:50:59","1","2021-09-06 16:50:59","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("3","","2021-09-06","2003","2021-02-10","10385","1970-01-01","3","4","19","33","43835.00","0.00","0.00","0.00","200.00","44035.00","5.00","2201.75","0.25","46237.00","","","","1","2021-09-06 17:02:16","1","2021-09-06 17:02:16","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("4","","2021-09-06","0784","2021-03-30","13064","1970-01-01","34","33","19","33","109756.70","0.00","0.00","0.00","700.00","110456.70","5.00","5522.84","0.46","115980.00","","","","1","2021-09-06 17:27:52","1","2021-09-06 17:27:52","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("5","","2021-09-06","1688","2021-02-10","10415","1970-01-01","3","35","19","33","23068.50","0.00","0.00","0.40","330.00","23398.10","5.00","1169.90","0.00","24568.00","","","","1","2021-09-06 17:44:08","1","2021-09-06 17:44:08","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("6","","2021-09-06","2297","2021-03-27","12985","1970-01-01","3","35","19","33","54575.60","0.00","0.00","0.00","330.00","54905.60","5.00","2745.28","0.12","57651.00","","","","1","2021-09-06 17:55:18","1","2021-09-06 17:55:18","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("7","","2021-09-06","2082","2021-03-11","12152","1970-01-01","3","35","19","33","50645.40","0.00","0.00","0.00","330.00","50975.40","5.00","2548.77","-0.17","53524.00","","","","1","2021-09-06 17:59:37","1","2021-09-06 17:59:37","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("8","","2021-09-06","320","2021-02-19","10904","1970-01-01","3","8","19","33","69806.80","0.00","0.00","0.00","400.00","70206.80","5.00","3510.34","-0.14","73717.00","","","","1","2021-09-06 23:41:46","1","2021-09-06 23:41:46","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("9","","2021-09-06","1136","2020-12-15","6820","1970-01-01","3","35","19","33","16951.55","0.00","0.00","0.00","220.00","17171.55","5.00","858.58","-0.13","18030.00","","","","1","2021-09-06 23:46:16","1","2021-09-06 23:46:16","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("10","","2021-09-06","1135","2020-12-15","6821","1970-01-01","3","35","19","33","22199.10","0.00","0.00","0.00","330.00","22529.10","5.00","1126.45","0.45","23656.00","","","","1","2021-09-06 23:48:56","1","2021-09-06 23:48:56","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("11","","2021-09-06","85","2020-06-29","1000383","1970-01-01","36","8","19","33","18943.50","0.00","0.00","0.00","15.15","18958.65","5.00","947.93","0.42","19907.00","","","","1","2021-09-07 00:29:57","1","2021-09-07 00:29:57","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("12","","2021-09-06","86","2020-06-29","1000384","1970-01-01","36","8","19","33","18208.25","0.00","0.00","0.00","14.57","18222.82","5.00","911.14","0.04","19134.00","","","","1","2021-09-07 00:32:49","1","2021-09-07 00:32:49","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("13","","2021-09-06","587","2021-08-30","1056670","1970-01-01","28","1","37","33","55174.00","0.00","0.00","0.00","0.00","55174.00","5.00","2758.70","0.30","57933.00","","","","1","2021-09-07 00:40:43","1","2021-09-07 00:42:56","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("14","","2021-09-06","0938","2021-08-31","3707","1970-01-01","3","4","24","33","37380.00","0.00","0.00","0.00","650.00","38030.00","5.00","1901.50","0.50","39932.00","","","","1","2021-09-07 00:45:02","1","2021-09-07 00:45:02","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("15","","2021-09-06","34","2021-08-06","2597","1970-01-01","3","8","24","33","139165.20","0.00","0.00","0.00","1461.33","140626.53","5.00","7031.33","0.14","147658.00","","","","1","2021-09-07 00:48:38","1","2021-09-07 00:48:38","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("16","","2021-09-06","0230","2021-07-16","1703","1970-01-01","3","7","24","33","30324.63","0.00","0.00","0.00","260.00","30584.63","5.00","1529.23","0.14","32114.00","","","","1","2021-09-07 00:51:19","1","2021-09-07 00:51:19","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("17","","2021-09-06","21","2021-07-16","1707","1970-01-01","3","8","24","33","13640.00","0.00","0.00","0.00","160.91","13800.91","5.00","690.05","0.04","14491.00","","","","1","2021-09-07 00:55:32","1","2021-09-07 00:55:32","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("18","","2021-09-06","530","2020-10-24","1059790","1970-01-01","28","1","37","33","24366.00","5.00","1218.30","0.00","0.00","23147.70","5.00","1157.38","-0.08","24305.00","","","","1","2021-09-07 00:58:24","1","2021-09-07 01:00:17","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("19","","2021-09-06","490","2020-10-14","1058985","1970-01-01","28","1","37","33","17225.00","5.00","861.25","0.00","0.00","16363.75","5.00","818.19","0.06","17182.00","","","","1","2021-09-07 01:03:22","1","2021-09-07 01:03:22","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("20","","2021-09-06","1493","2021-03-11","1071627","1970-01-01","28","1","37","33","63759.00","5.00","3187.95","0.00","0.00","60571.05","5.00","3028.55","0.40","63600.00","","","","1","2021-09-07 01:07:04","1","2021-09-07 01:07:04","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("21","","2021-09-06","2243","2021-03-03","11645","1970-01-01","3","4","24","33","30917.50","0.00","0.00","0.00","400.00","31317.50","5.00","1565.88","-0.38","32883.00","","","","1","2021-09-07 01:12:13","1","2021-09-07 01:16:01","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("22","","2021-09-06","2242","2021-03-03","11646","1970-01-01","3","4","24","33","31726.75","0.00","0.00","0.00","400.00","32126.75","5.00","1606.34","-0.09","33733.00","","","","1","2021-09-07 01:18:19","1","2021-09-07 01:18:19","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("23","","2021-09-06","2252","2021-03-03","11643","1970-01-01","3","4","24","33","26087.00","0.00","0.00","0.00","300.00","26387.00","5.00","1319.35","-0.35","27706.00","","","","1","2021-09-07 01:21:23","1","2021-09-07 01:21:23","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("24","","2021-09-06","1376","2021-03-03","1070761","1970-01-01","28","1","37","33","20683.25","5.00","1034.16","0.00","0.00","19649.09","5.00","982.45","0.46","20632.00","","","","1","2021-09-07 01:24:12","1","2021-09-07 01:24:12","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("25","","2021-09-06","1374","2021-03-03","1070763","1970-01-01","28","1","37","33","20471.25","5.00","1023.56","0.00","0.00","19447.69","5.00","972.38","-0.07","20420.00","","","","1","2021-09-07 01:27:31","1","2021-09-07 01:27:31","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("26","","2021-09-06","1375","2021-03-03","1070762","1970-01-01","28","1","37","33","20683.25","5.00","1034.16","0.00","0.00","19649.09","5.00","982.45","0.46","20632.00","","","","1","2021-09-07 01:30:53","1","2021-09-07 01:30:53","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("27","","2021-09-06","1373","2021-03-04","1070764","1970-01-01","28","1","37","33","15317.00","5.00","765.85","0.00","0.00","14551.15","5.00","727.56","0.29","15279.00","","","","1","2021-09-07 01:35:56","1","2021-09-07 01:35:56","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("28","","2021-09-06","2305","2021-03-08","11992","1970-01-01","3","4","24","33","45297.25","0.00","0.00","0.00","500.00","45797.25","5.00","2289.86","-0.11","48087.00","","","","1","2021-09-07 01:40:50","1","2021-09-07 01:40:50","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("29","","2021-09-06","2304","2021-03-08","11991","1970-01-01","3","4","24","33","41271.75","0.00","0.00","0.00","500.00","41771.75","5.00","2088.59","-0.34","43860.00","","","","1","2021-09-07 01:44:45","1","2021-09-07 01:44:45","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("30","","2021-09-06","1358","2021-03-01","1070296","1970-01-01","28","1","37","33","20219.50","5.00","1010.98","0.00","0.00","19208.52","5.00","960.43","0.05","20169.00","","","","1","2021-09-07 01:47:08","1","2021-09-07 01:47:08","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("31","","2021-09-06","1357","2021-03-01","1070295","1970-01-01","28","1","37","33","20365.25","5.00","1018.26","0.00","0.00","19346.99","5.00","967.35","-0.34","20314.00","","","","1","2021-09-07 01:50:17","1","2021-09-07 01:50:17","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("32","","2021-09-06","1356","2021-03-01","1070294","1970-01-01","28","1","37","33","20073.75","5.00","1003.69","0.00","0.00","19070.06","5.00","953.50","0.44","20024.00","","","","1","2021-09-07 01:53:00","1","2021-09-07 01:53:00","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("33","","2021-09-06","1355","2021-03-01","1070293","1970-01-01","28","1","37","33","19596.75","5.00","979.84","0.00","0.00","18616.91","5.00","930.85","0.24","19548.00","","","","1","2021-09-07 01:56:11","1","2021-09-07 01:56:11","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("34","","2021-09-06","2169","2021-02-23","11134","1970-01-01","3","4","24","33","38146.50","0.00","0.00","0.00","200.00","38346.50","5.00","1917.33","0.17","40264.00","","","","1","2021-09-07 02:00:56","1","2021-09-07 02:00:56","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("35","","2021-09-06","2029","2021-02-12","10651","1970-01-01","3","4","24","33","22601.50","0.00","0.00","0.00","200.00","22801.50","5.00","1140.08","0.42","23942.00","","","","1","2021-09-07 02:06:58","1","2021-09-07 02:06:58","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("36","","2021-09-06","2004","2021-02-10","0386","1970-01-01","3","4","24","33","64162.50","0.00","0.00","0.00","500.00","64662.50","5.00","3233.13","0.37","67896.00","","","","1","2021-09-07 02:27:25","1","2021-09-07 02:27:25","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("37","","2021-09-07","2005","2021-02-10","10387","1970-01-01","3","4","24","33","75136.50","0.00","0.00","0.00","500.00","75636.50","5.00","3781.82","-0.32","79418.00","","","","1","2021-09-07 10:41:34","1","2021-09-07 10:41:34","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("38","","2021-09-07","2009","2021-02-10","10425","1970-01-01","3","4","24","33","39279.75","0.00","0.00","0.00","400.00","39679.75","5.00","1983.99","0.26","41664.00","","","","1","2021-09-07 10:42:51","1","2021-09-07 10:42:51","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("39","","2021-09-07","1973","2021-02-08","10250","1970-01-01","3","4","24","33","29216.00","0.00","0.00","0.00","400.00","29616.00","5.00","1480.80","0.20","31097.00","","","","1","2021-09-07 10:44:00","1","2021-09-07 10:44:00","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("40","","2021-09-07","1974","2021-02-08","10249","1970-01-01","3","4","24","33","38034.75","0.00","0.00","0.00","400.00","38434.75","5.00","1921.74","-0.49","40356.00","","","","1","2021-09-07 10:45:03","1","2021-09-07 10:45:03","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("41","","2021-09-07","1972","2021-02-08","10251","1970-01-01","3","4","24","33","39466.50","0.00","0.00","0.00","400.00","39866.50","5.00","1993.33","0.17","41860.00","","","","1","2021-09-07 10:46:35","1","2021-09-07 10:46:35","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("42","","2021-09-07","1748","2020-12-31","7854","1970-01-01","3","4","24","33","41890.10","0.00","0.00","0.00","300.00","42190.10","5.00","2109.51","0.39","44300.00","","","","1","2021-09-07 10:50:56","1","2021-09-07 10:50:56","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("43","","2021-09-07","1742","2020-12-30","7858","1970-01-01","3","4","24","33","38835.70","0.00","0.00","0.00","300.00","39135.70","5.00","1956.79","-0.49","41092.00","","","","1","2021-09-07 10:53:29","1","2021-09-07 10:53:29","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("44","","2021-09-07","1738","2020-12-30","7807","1970-01-01","3","4","24","33","178930.00","0.00","0.00","0.00","1100.00","180030.00","5.00","9001.50","0.50","189032.00","","","","1","2021-09-07 10:56:01","1","2021-09-07 10:56:01","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("45","","2021-09-07","1737","2020-12-30","7806","1970-01-01","3","4","24","33","160660.00","0.00","0.00","0.00","1000.00","161660.00","5.00","8083.00","0.00","169743.00","","","","1","2021-09-07 10:59:02","1","2021-09-07 10:59:02","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("46","","2021-09-07","1736","2020-12-30","7805","1970-01-01","3","4","24","33","195223.00","0.00","0.00","0.00","900.00","196123.00","5.00","9806.15","-0.15","205929.00","","","","1","2021-09-07 11:00:32","1","2021-09-07 11:00:32","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("47","","2021-09-07","1702","2020-12-29","7727","1970-01-01","3","4","24","33","36221.50","0.00","0.00","0.00","400.00","36621.50","5.00","1831.08","0.42","38453.00","","","","1","2021-09-07 11:01:50","1","2021-09-07 11:01:50","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("48","","2021-09-07","1701","2020-12-29","7728","1970-01-01","3","4","24","33","35668.50","0.00","0.00","0.00","400.00","36068.50","5.00","1803.42","0.08","37872.00","","","","1","2021-09-07 11:03:52","1","2021-09-07 11:03:52","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("49","","2021-09-07","1687","2020-12-29","7731","1970-01-01","3","4","24","33","40223.70","0.00","0.00","0.00","200.00","40423.70","5.00","2021.18","0.12","42445.00","","","","1","2021-09-07 11:08:58","1","2021-09-07 11:08:58","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("50","","2021-09-07","1686","2020-12-29","7732","1970-01-01","3","4","24","33","55152.90","0.00","0.00","0.00","300.00","55452.90","5.00","2772.64","0.46","58226.00","","","","1","2021-09-07 11:10:35","1","2021-09-07 11:10:35","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("51","","2021-09-07","1677","2020-12-28","7733","1970-01-01","3","4","24","33","21015.00","0.00","0.00","0.00","200.00","21215.00","5.00","1060.75","0.25","22276.00","","","","1","2021-09-07 11:17:41","1","2021-09-07 11:17:41","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("52","","2021-09-07","1556","2020-12-22","17222","1970-01-01","3","4","24","33","90857.00","0.00","0.00","0.00","600.00","91457.00","5.00","4572.85","0.15","96030.00","","","","1","2021-09-07 11:23:00","1","2021-09-07 11:23:00","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("53","","2021-09-07","1607","2020-12-25","7440","1970-01-01","3","4","24","33","39217.50","0.00","0.00","0.00","300.00","39517.50","5.00","1975.88","-0.38","41493.00","","","","1","2021-09-07 11:24:28","1","2021-09-07 11:24:28","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("54","","2021-09-07","1223","2021-02-14","1068951","1970-01-01","28","1","37","33","19000.50","0.00","0.00","0.00","0.00","19000.50","5.00","950.02","0.48","19951.00","","","","1","2021-09-07 11:26:02","1","2021-09-07 11:26:02","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("55","","2021-09-07","1222","2021-02-14","1068950","1970-01-01","28","1","37","33","18536.75","0.00","0.00","0.00","0.00","18536.75","5.00","926.84","0.41","19464.00","","","","1","2021-09-07 11:27:15","1","2021-09-07 11:27:15","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("56","","2021-09-07","1448","2021-03-07","1071029","1970-01-01","28","1","38","33","14280.00","0.00","0.00","0.00","0.00","14280.00","5.00","714.00","0.00","14994.00","","","","1","2021-09-07 13:13:30","1","2021-09-07 13:13:30","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("57","","2021-09-07","1447","2021-03-07","1071028","1970-01-01","28","1","38","33","14343.00","0.00","0.00","0.00","0.00","14343.00","5.00","717.15","-0.15","15060.00","","","","1","2021-09-07 13:14:31","1","2021-09-07 13:14:31","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("58","","2021-09-07","1445","2021-03-07","1071026","1970-01-01","28","1","38","33","14049.00","0.00","0.00","0.00","0.00","14049.00","5.00","702.45","-0.45","14751.00","","","","1","2021-09-07 13:15:36","1","2021-09-07 13:15:36","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("59","","2021-09-07","1446","2021-03-07","1071027","1970-01-01","28","1","38","33","14406.00","0.00","0.00","0.00","0.00","14406.00","5.00","720.30","-0.30","15126.00","","","","1","2021-09-07 13:17:16","1","2021-09-07 13:17:16","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("60","","2021-09-07","214","2021-02-27","11437","1970-01-01","3","5","38","33","49680.00","0.00","0.00","0.00","300.00","49980.00","5.00","2499.00","0.00","52479.00","","","","1","2021-09-07 13:18:57","1","2021-09-07 13:18:57","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("61","","2021-09-07","1297","2021-02-20","1069701","1970-01-01","28","1","38","33","6909.00","0.00","0.00","0.00","0.00","6909.00","5.00","345.45","-0.45","7254.00","","","","1","2021-09-07 13:20:08","1","2021-09-07 13:20:08","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("62","","2021-09-07","197","2021-02-16","10750","1970-01-01","3","5","38","33","20530.00","0.00","0.00","0.00","100.00","20630.00","5.00","1031.50","0.50","21662.00","","","","1","2021-09-07 13:21:09","1","2021-09-07 13:21:09","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("63","","2021-09-07","0227","2020-08-07","nil","1970-01-01","3","4","38","33","228.00","0.00","0.00","0.00","0.00","228.00","5.00","11.40","-0.40","239.00","","","","1","2021-09-07 13:22:22","1","2021-09-07 13:22:22","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("64","","2021-09-07","157","2020-09-03","704","1970-01-01","3","8","39","33","27379.20","0.00","0.00","0.00","221.90","27601.10","5.00","1380.06","-0.16","28981.00","","","","1","2021-09-07 13:32:15","1","2021-09-07 13:32:15","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("65","","2021-09-07","261","2020-12-25","7518","1970-01-01","3","8","39","33","14464.80","0.00","0.00","0.00","111.57","14576.37","5.00","728.82","-0.19","15305.00","","","","1","2021-09-07 13:33:56","1","2021-09-07 13:33:56","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("66","","2021-09-07","0844","2021-08-13","2955","1970-01-01","3","4","21","33","52896.00","0.00","0.00","0.00","260.00","53156.00","5.00","2657.80","0.20","55814.00","","","","1","2021-09-07 14:10:16","1","2021-09-07 14:10:16","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("67","","2021-09-07","0845","2021-08-13","2954","1970-01-01","3","4","21","33","56364.40","0.00","0.00","0.00","260.00","56624.40","5.00","2831.22","0.38","59456.00","","","","1","2021-09-07 14:12:11","1","2021-09-07 14:12:11","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("68","","2021-09-07","0843","2021-08-13","2956","1970-01-01","3","4","21","33","46840.80","0.00","0.00","0.00","260.00","47100.80","5.00","2355.04","0.16","49456.00","","","","1","2021-09-07 14:16:38","1","2021-09-07 14:16:38","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("69","","2021-09-07","0362","2021-07-02","02-07-2021","1970-01-01","3","4","21","33","52085.00","0.00","0.00","0.00","260.00","52345.00","5.00","2617.25","-0.25","54962.00","","","","1","2021-09-07 14:22:11","1","2021-09-07 14:22:11","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("70","","2021-09-07","0377","2021-07-03","1201","1970-01-01","3","4","21","33","41624.00","0.00","0.00","0.00","390.00","42014.00","5.00","2100.70","0.30","44115.00","","","","1","2021-09-07 14:26:17","1","2021-09-07 14:26:17","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("71","","2021-09-07","0363","2021-07-02","1199","1970-01-01","3","4","21","33","33784.80","0.00","0.00","0.00","260.00","34044.80","5.00","1702.24","-0.04","35747.00","","","","1","2021-09-07 14:28:10","1","2021-09-07 14:28:10","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("72","","2021-09-07","0127","2020-09-16","nil","1970-01-01","3","44","21","33","1970.00","0.00","0.00","0.00","0.00","1970.00","5.00","98.50","0.50","2069.00","","","","1","2021-09-07 14:29:47","1","2021-09-07 14:29:47","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("73","","2021-09-07","0305","2020-08-25","1349","1970-01-01","3","10","21","33","14850.00","0.00","0.00","0.00","100.00","14950.00","5.00","747.50","0.50","15698.00","","","","1","2021-09-07 14:33:15","1","2021-09-07 14:33:15","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("74","","2021-09-07","0260","2020-08-12","nil","1970-01-01","45","4","21","33","70673.60","0.00","0.00","0.00","400.00","71073.60","5.00","3553.68","-0.28","74627.00","","","","1","2021-09-07 14:36:39","1","2021-09-07 14:36:39","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("75","","2021-09-07","0261","2020-08-12","nil","1970-01-01","45","4","21","33","30488.60","0.00","0.00","0.00","200.00","30688.60","5.00","1534.43","-0.03","32223.00","","","","1","2021-09-07 14:38:04","1","2021-09-07 14:38:04","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("76","","2021-09-07","1377","2021-03-03","1070760","1970-01-01","28","1","40","33","16857.75","3.00","505.73","0.00","0.00","16352.02","5.00","817.60","0.38","17170.00","","","","1","2021-09-07 15:16:07","1","2021-09-07 15:16:07","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("77","","2021-09-07","1378","2021-03-03","1070759","1970-01-01","28","1","40","33","17790.50","3.00","533.72","0.00","0.00","17256.78","5.00","862.84","0.38","18120.00","","","","1","2021-09-07 15:17:16","1","2021-09-07 15:17:16","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("78","","2021-09-07","1379","2021-03-03","1070758","1970-01-01","28","1","40","33","17017.00","3.00","510.51","0.00","0.00","16506.49","5.00","825.32","0.19","17332.00","","","","1","2021-09-07 15:18:22","1","2021-09-07 15:18:22","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("79","","2021-09-07","1237","2021-02-15","1069034","1970-01-01","28","1","40","33","17790.50","3.00","533.72","0.00","0.00","17256.78","5.00","862.84","0.38","18120.00","","","","1","2021-09-07 15:19:53","1","2021-09-07 15:19:53","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("80","","2021-09-07","1238","2021-02-15","1069035","1970-01-01","28","1","40","33","18564.00","3.00","556.92","0.00","0.00","18007.08","5.00","900.35","-0.43","18907.00","","","","1","2021-09-07 15:21:27","1","2021-09-07 15:21:27","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("81","","2021-09-07","300","2021-02-02","9840","1970-01-01","3","8","42","33","48000.00","0.00","0.00","0.00","338.40","48338.40","5.00","2416.92","-0.32","50755.00","","","","1","2021-09-07 15:29:07","1","2021-09-07 15:29:07","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("82","","2021-09-07","306","2021-02-09","10304","1970-01-01","3","8","42","33","190617.60","0.00","0.00","0.00","1252.49","191870.09","5.00","9593.50","0.41","201464.00","","","","1","2021-09-07 15:31:01","1","2021-09-07 15:31:01","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("83","","2021-09-07","1945","2021-02-06","10190","1970-01-01","3","4","43","33","24500.00","0.00","0.00","0.00","100.00","24600.00","5.00","1230.00","0.00","25830.00","","","","1","2021-09-07 15:33:32","1","2021-09-07 15:33:32","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("84","","2021-09-07","1949","2021-02-08","10224","1970-01-01","3","4","43","33","28125.90","0.00","0.00","0.00","200.00","28325.90","5.00","1416.30","-0.20","29742.00","","","","1","2021-09-07 15:35:41","1","2021-09-07 15:35:41","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_bill_entry (bill_entry_id,voucher_number,voucher_date,bill_number,bill_date,lr_number,lr_date,transport_name,supplier_account_code,buyer_account_code,agent,gross_amount,discount_percentage,discount_amount,deduction_amount,additional_amount,net_amount,gst_percent,gst_amount,round_off,bill_amount,remarks,bill_upload,supporting_doc,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("85","","2021-09-07","0489","2021-08-18","nil","1970-01-01","3","10","15","33","416.00","0.00","0.00","0.00","0.00","416.00","5.00","20.80","0.20","437.00","","","","1","2021-09-07 15:39:25","1","2021-09-07 15:39:25","FALSE","","1970-01-01 00:00:00");



  DROP TABLE IF EXISTS `txt_company`; 



CREATE TABLE `txt_company` (
  `company_id` int(10) NOT NULL auto_increment,
  `firm_name` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(20) NOT NULL,
  `state` varchar(50) NOT NULL default '',
  `pincode` varchar(10) NOT NULL,
  `gstin` varchar(20) NOT NULL default '',
  `office_phone` varchar(12) NOT NULL default '',
  `contact_person` varchar(50) NOT NULL default '',
  `contact_person_2` varchar(50) NOT NULL default '',
  `contact_number` varchar(12) NOT NULL default '',
  `contact_number_2` varchar(12) NOT NULL default '',
  `sms_number` varchar(12) NOT NULL default '',
  `whatsapp_number` varchar(12) NOT NULL default '',
  `email` varchar(50) NOT NULL default '',
  `website` varchar(50) NOT NULL default '',
  `group_id` int(10) default NULL,
  `group_name` varchar(20) NOT NULL,
  `commission_percentage` decimal(5,2) NOT NULL default '0.00',
  `firm_type` varchar(20) NOT NULL,
  `agent_id` int(10) default NULL,
  `reference` varchar(20) NOT NULL,
  `remarks` varchar(20) NOT NULL,
  `pan_number` varchar(20) NOT NULL,
  `visiting_card` varchar(200) NOT NULL default '',
  `photo_1` varchar(200) default NULL,
  `photo_2` varchar(200) default NULL,
  `create_user` varchar(20) NOT NULL default '',
  `create_date` datetime NOT NULL default '1970-01-01 00:00:00',
  `last_update_user` varchar(20) NOT NULL default '',
  `last_update_date` datetime NOT NULL default '1970-01-01 00:00:00',
  `delete_tag` varchar(10) NOT NULL default 'FALSE',
  `delete_user` varchar(20) default '',
  `delete_date` datetime NOT NULL default '1970-01-01 00:00:00',
  `products` varchar(100) NOT NULL default '',
  `brands` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`company_id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

INSERT INTO txt_company (company_id,firm_name,address,city,state,pincode,gstin,office_phone,contact_person,contact_person_2,contact_number,contact_number_2,sms_number,whatsapp_number,email,website,group_id,group_name,commission_percentage,firm_type,agent_id,reference,remarks,pan_number,visiting_card,photo_1,photo_2,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date,products,brands) VALUES("1","PUSPA SYNTHETICS","Balotra","Balotra","RAJASTHAN","344200","GSTIN","","","","","","","","","","0","","2.00","Supplier","0","","","","","","","1","2021-09-04 19:55:00","1","2021-09-04 20:58:26","FALSE","","1970-01-01 00:00:00","","");
INSERT INTO txt_company (company_id,firm_name,address,city,state,pincode,gstin,office_phone,contact_person,contact_person_2,contact_number,contact_number_2,sms_number,whatsapp_number,email,website,group_id,group_name,commission_percentage,firm_type,agent_id,reference,remarks,pan_number,visiting_card,photo_1,photo_2,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date,products,brands) VALUES("2","PJ DRESSES","Indore","Indore","MADHYA PRADESH","452001","GSTIN","","","","","","","","","","0","","0.00","Buyer","0","","","","","","","1","2021-09-04 19:55:48","1","2021-09-06 10:52:52","FALSE","","1970-01-01 00:00:00","","");
INSERT INTO txt_company (company_id,firm_name,address,city,state,pincode,gstin,office_phone,contact_person,contact_person_2,contact_number,contact_number_2,sms_number,whatsapp_number,email,website,group_id,group_name,commission_percentage,firm_type,agent_id,reference,remarks,pan_number,visiting_card,photo_1,photo_2,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date,products,brands) VALUES("3","JANGID CARGO","Indore","Indore","MADHYA PRADESH","452001","GSTIN","","","","","","","","","","0","","0.00","Transport","0","","","","","","","1","2021-09-04 19:56:32","1","2021-09-04 23:03:09","FALSE","","1970-01-01 00:00:00","","");
INSERT INTO txt_company (company_id,firm_name,address,city,state,pincode,gstin,office_phone,contact_person,contact_person_2,contact_number,contact_number_2,sms_number,whatsapp_number,email,website,group_id,group_name,commission_percentage,firm_type,agent_id,reference,remarks,pan_number,visiting_card,photo_1,photo_2,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date,products,brands) VALUES("4","SANYAM TEX FAB","Bhilwara","Bhilwara","RAJASTHAN","311402","GSTIN","","","","","","","","","","0","","2.00","Supplier","0","","","","","","","1","2021-09-04 20:56:24","1","2021-09-04 20:58:37","FALSE","","1970-01-01 00:00:00","","");
INSERT INTO txt_company (company_id,firm_name,address,city,state,pincode,gstin,office_phone,contact_person,contact_person_2,contact_number,contact_number_2,sms_number,whatsapp_number,email,website,group_id,group_name,commission_percentage,firm_type,agent_id,reference,remarks,pan_number,visiting_card,photo_1,photo_2,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date,products,brands) VALUES("5","ABHI TEXTILE","Bhilwara","Bhilwara","RAJASTHAN","311402","GSTIN","","","","","","","","","","0","","2.00","Supplier","0","","","","","","","1","2021-09-04 20:57:28","1","2021-09-04 20:58:13","FALSE","","1970-01-01 00:00:00","","");
INSERT INTO txt_company (company_id,firm_name,address,city,state,pincode,gstin,office_phone,contact_person,contact_person_2,contact_number,contact_number_2,sms_number,whatsapp_number,email,website,group_id,group_name,commission_percentage,firm_type,agent_id,reference,remarks,pan_number,visiting_card,photo_1,photo_2,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date,products,brands) VALUES("6","VEENA SYNTHETICS","Bhilwara","Bhilwara","RAJASTHAN","311402","GSTIN","","","","","","","","","","0","","2.00","Supplier","0","","","","","","","1","2021-09-04 21:01:28","1","2021-09-04 21:01:28","FALSE","","1970-01-01 00:00:00","","");
INSERT INTO txt_company (company_id,firm_name,address,city,state,pincode,gstin,office_phone,contact_person,contact_person_2,contact_number,contact_number_2,sms_number,whatsapp_number,email,website,group_id,group_name,commission_percentage,firm_type,agent_id,reference,remarks,pan_number,visiting_card,photo_1,photo_2,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date,products,brands) VALUES("7","VRUNDAVAN SYNTHETICS","Bhilwara","Bhilwara","RAJASTHAN","311402","GSTIN","","","","","","","","","","0","","2.00","Supplier","0","","","","","","","1","2021-09-04 21:02:08","1","2021-09-04 21:02:08","FALSE","","1970-01-01 00:00:00","","");
INSERT INTO txt_company (company_id,firm_name,address,city,state,pincode,gstin,office_phone,contact_person,contact_person_2,contact_number,contact_number_2,sms_number,whatsapp_number,email,website,group_id,group_name,commission_percentage,firm_type,agent_id,reference,remarks,pan_number,visiting_card,photo_1,photo_2,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date,products,brands) VALUES("8","SANKALP SUITINGS","Bhilwara","Bhilwara","RAJASTHAN","311402","GSTIN","","","","","","","","","","0","","2.00","Supplier","0","","","","","","","1","2021-09-04 21:06:06","1","2021-09-04 21:06:06","FALSE","","1970-01-01 00:00:00","","");
INSERT INTO txt_company (company_id,firm_name,address,city,state,pincode,gstin,office_phone,contact_person,contact_person_2,contact_number,contact_number_2,sms_number,whatsapp_number,email,website,group_id,group_name,commission_percentage,firm_type,agent_id,reference,remarks,pan_number,visiting_card,photo_1,photo_2,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date,products,brands) VALUES("9","SHREE GOVINDAM","Bhilwara","Bhilwara","RAJASTHAN","311402","GSTIN","","","","","","","","","","0","","2.00","Supplier","0","","","","","","","1","2021-09-04 21:09:11","1","2021-09-04 21:09:11","FALSE","","1970-01-01 00:00:00","","");
INSERT INTO txt_company (company_id,firm_name,address,city,state,pincode,gstin,office_phone,contact_person,contact_person_2,contact_number,contact_number_2,sms_number,whatsapp_number,email,website,group_id,group_name,commission_percentage,firm_type,agent_id,reference,remarks,pan_number,visiting_card,photo_1,photo_2,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date,products,brands) VALUES("10","CHHABRA SYNCOTEX PVT.LTD","Bhilwara","Bhilwara","RAJASTHAN","311402","GSTIN","","","","","","","","","","0","","2.00","Supplier","0","","","","","","","1","2021-09-04 21:10:51","1","2021-09-04 21:10:51","FALSE","","1970-01-01 00:00:00","","");
INSERT INTO txt_company (company_id,firm_name,address,city,state,pincode,gstin,office_phone,contact_person,contact_person_2,contact_number,contact_number_2,sms_number,whatsapp_number,email,website,group_id,group_name,commission_percentage,firm_type,agent_id,reference,remarks,pan_number,visiting_card,photo_1,photo_2,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date,products,brands) VALUES("11","AIRTEX (INDIA) PVT.LTD","Bhilwara","Bhilwara","RAJASTHAN","311402","GSTIN","","","","","","","","","","0","","2.00","Supplier","0","","","","","","","1","2021-09-04 21:12:47","1","2021-09-04 21:12:47","FALSE","","1970-01-01 00:00:00","","");
INSERT INTO txt_company (company_id,firm_name,address,city,state,pincode,gstin,office_phone,contact_person,contact_person_2,contact_number,contact_number_2,sms_number,whatsapp_number,email,website,group_id,group_name,commission_percentage,firm_type,agent_id,reference,remarks,pan_number,visiting_card,photo_1,photo_2,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date,products,brands) VALUES("12","ROHAN FABRICS","Bhilwara","Bhilwara","RAJASTHAN","311402","GSTIN","","","","","","","","","","0","","2.00","Supplier","0","","","","","","","1","2021-09-04 21:13:54","1","2021-09-04 21:57:54","FALSE","","1970-01-01 00:00:00","","");
INSERT INTO txt_company (company_id,firm_name,address,city,state,pincode,gstin,office_phone,contact_person,contact_person_2,contact_number,contact_number_2,sms_number,whatsapp_number,email,website,group_id,group_name,commission_percentage,firm_type,agent_id,reference,remarks,pan_number,visiting_card,photo_1,photo_2,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date,products,brands) VALUES("13","RANJEETA TRADERS","Indore","Indore","MADHYA PRADESH","452001","GSTIN","","","","","","","","","","0","","0.00","Buyer","0","","","","","","","1","2021-09-04 21:27:54","1","2021-09-04 21:27:54","FALSE","","1970-01-01 00:00:00","","");
INSERT INTO txt_company (company_id,firm_name,address,city,state,pincode,gstin,office_phone,contact_person,contact_person_2,contact_number,contact_number_2,sms_number,whatsapp_number,email,website,group_id,group_name,commission_percentage,firm_type,agent_id,reference,remarks,pan_number,visiting_card,photo_1,photo_2,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date,products,brands) VALUES("14","JAI LAXMI TRADING CO.","Indore","Indore","MADHYA PRADESH","452001","GSTIN","","","","","","","","","","0","","0.00","Buyer","0","","","","","","","1","2021-09-04 21:29:33","1","2021-09-04 21:29:33","FALSE","","1970-01-01 00:00:00","","");
INSERT INTO txt_company (company_id,firm_name,address,city,state,pincode,gstin,office_phone,contact_person,contact_person_2,contact_number,contact_number_2,sms_number,whatsapp_number,email,website,group_id,group_name,commission_percentage,firm_type,agent_id,reference,remarks,pan_number,visiting_card,photo_1,photo_2,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date,products,brands) VALUES("15","AKASH APPRAELS","Indore","Indore","MADHYA PRADESH","452001","GSTIN","","","","","","","","","","0","","0.00","Buyer","0","","","","","","","1","2021-09-04 21:31:36","1","2021-09-04 21:31:36","FALSE","","1970-01-01 00:00:00","","");
INSERT INTO txt_company (company_id,firm_name,address,city,state,pincode,gstin,office_phone,contact_person,contact_person_2,contact_number,contact_number_2,sms_number,whatsapp_number,email,website,group_id,group_name,commission_percentage,firm_type,agent_id,reference,remarks,pan_number,visiting_card,photo_1,photo_2,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date,products,brands) VALUES("16","SHRI BALAJI ENTERPRISES","Indore","Indore","MADHYA PRADESH","452001","GSTIN","","","","","","","","","","0","","0.00","Buyer","0","","","","","","","1","2021-09-04 21:55:55","1","2021-09-04 22:43:55","FALSE","","1970-01-01 00:00:00","","");
INSERT INTO txt_company (company_id,firm_name,address,city,state,pincode,gstin,office_phone,contact_person,contact_person_2,contact_number,contact_number_2,sms_number,whatsapp_number,email,website,group_id,group_name,commission_percentage,firm_type,agent_id,reference,remarks,pan_number,visiting_card,photo_1,photo_2,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date,products,brands) VALUES("17","NEW AVTAR DRESSES","Indore","Indore","MADHYA PRADESH","452001","GSTIN","","","","","","","","","","0","","0.00","Buyer","0","","","","","","","1","2021-09-04 21:57:14","1","2021-09-04 21:57:14","FALSE","","1970-01-01 00:00:00","","");
INSERT INTO txt_company (company_id,firm_name,address,city,state,pincode,gstin,office_phone,contact_person,contact_person_2,contact_number,contact_number_2,sms_number,whatsapp_number,email,website,group_id,group_name,commission_percentage,firm_type,agent_id,reference,remarks,pan_number,visiting_card,photo_1,photo_2,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date,products,brands) VALUES("18","SONA TAILORING MATERIAL","Indore","Indore","MADHYA PRADESH","452001","GSTIN","","","","","","","","","","0","","0.00","Buyer","0","","","","","","","1","2021-09-04 21:59:06","1","2021-09-04 21:59:06","FALSE","","1970-01-01 00:00:00","","");
INSERT INTO txt_company (company_id,firm_name,address,city,state,pincode,gstin,office_phone,contact_person,contact_person_2,contact_number,contact_number_2,sms_number,whatsapp_number,email,website,group_id,group_name,commission_percentage,firm_type,agent_id,reference,remarks,pan_number,visiting_card,photo_1,photo_2,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date,products,brands) VALUES("19","TOPSON TROUSERS","Indore","Indore","MADHYA PRADESH","452001","GSTIN","","","","","","","","","","0","","0.00","Buyer","0","","","","","","","1","2021-09-04 21:59:55","1","2021-09-04 21:59:55","FALSE","","1970-01-01 00:00:00","","");
INSERT INTO txt_company (company_id,firm_name,address,city,state,pincode,gstin,office_phone,contact_person,contact_person_2,contact_number,contact_number_2,sms_number,whatsapp_number,email,website,group_id,group_name,commission_percentage,firm_type,agent_id,reference,remarks,pan_number,visiting_card,photo_1,photo_2,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date,products,brands) VALUES("20","NEW KAMAL DRESSES","Indore","Indore","MADHYA PRADESH","452001","GSTIN","","","","","","","","","","0","","0.00","Buyer","0","","","","","","","1","2021-09-04 22:00:46","1","2021-09-04 22:00:46","FALSE","","1970-01-01 00:00:00","","");
INSERT INTO txt_company (company_id,firm_name,address,city,state,pincode,gstin,office_phone,contact_person,contact_person_2,contact_number,contact_number_2,sms_number,whatsapp_number,email,website,group_id,group_name,commission_percentage,firm_type,agent_id,reference,remarks,pan_number,visiting_card,photo_1,photo_2,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date,products,brands) VALUES("21","BADHKUL APPARELS","Indore","Indore","MADHYA PRADESH","452001","GSTIN","","","","","","","","","","0","","0.00","Buyer","0","","","","","","","1","2021-09-04 22:43:10","1","2021-09-04 22:43:10","FALSE","","1970-01-01 00:00:00","","");
INSERT INTO txt_company (company_id,firm_name,address,city,state,pincode,gstin,office_phone,contact_person,contact_person_2,contact_number,contact_number_2,sms_number,whatsapp_number,email,website,group_id,group_name,commission_percentage,firm_type,agent_id,reference,remarks,pan_number,visiting_card,photo_1,photo_2,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date,products,brands) VALUES("22","KALASH ENTERPRISES","Indore","Indore","MADHYA PRADESH","452001","GSTIN","","","","","","","","","","0","","0.00","Buyer","0","","","","","","","1","2021-09-04 22:45:48","1","2021-09-04 22:45:48","FALSE","","1970-01-01 00:00:00","","");
INSERT INTO txt_company (company_id,firm_name,address,city,state,pincode,gstin,office_phone,contact_person,contact_person_2,contact_number,contact_number_2,sms_number,whatsapp_number,email,website,group_id,group_name,commission_percentage,firm_type,agent_id,reference,remarks,pan_number,visiting_card,photo_1,photo_2,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date,products,brands) VALUES("23","KP TRADERS","Indore","Indore","MADHYA PRADESH","452001","GSTIN","","","","","","","","","","0","","0.00","Buyer","0","","","","","","","1","2021-09-04 22:46:32","1","2021-09-04 22:46:32","FALSE","","1970-01-01 00:00:00","","");
INSERT INTO txt_company (company_id,firm_name,address,city,state,pincode,gstin,office_phone,contact_person,contact_person_2,contact_number,contact_number_2,sms_number,whatsapp_number,email,website,group_id,group_name,commission_percentage,firm_type,agent_id,reference,remarks,pan_number,visiting_card,photo_1,photo_2,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date,products,brands) VALUES("24","JD APPARELS","Indore","Indore","MADHYA PRADESH","452001","GSTIN","","","","","","","","","","0","","0.00","Buyer","0","","","","","","","1","2021-09-04 22:49:02","1","2021-09-04 22:49:02","FALSE","","1970-01-01 00:00:00","","");
INSERT INTO txt_company (company_id,firm_name,address,city,state,pincode,gstin,office_phone,contact_person,contact_person_2,contact_number,contact_number_2,sms_number,whatsapp_number,email,website,group_id,group_name,commission_percentage,firm_type,agent_id,reference,remarks,pan_number,visiting_card,photo_1,photo_2,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date,products,brands) VALUES("25","PREM SONS","Indore","Indore","MADHYA PRADESH","452001","GSTIN","","","","","","","","","","0","","0.00","Buyer","0","","","","","","","1","2021-09-04 22:50:45","1","2021-09-04 22:50:45","FALSE","","1970-01-01 00:00:00","","");
INSERT INTO txt_company (company_id,firm_name,address,city,state,pincode,gstin,office_phone,contact_person,contact_person_2,contact_number,contact_number_2,sms_number,whatsapp_number,email,website,group_id,group_name,commission_percentage,firm_type,agent_id,reference,remarks,pan_number,visiting_card,photo_1,photo_2,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date,products,brands) VALUES("26","CHHAGAN LAL NAVIN KUMAR","Indore","Indore","MADHYA PRADESH","452001","GSTIN","","","","","","","","","","0","","0.00","Buyer","0","","","","","","","1","2021-09-04 22:52:29","1","2021-09-04 22:52:29","FALSE","","1970-01-01 00:00:00","","");
INSERT INTO txt_company (company_id,firm_name,address,city,state,pincode,gstin,office_phone,contact_person,contact_person_2,contact_number,contact_number_2,sms_number,whatsapp_number,email,website,group_id,group_name,commission_percentage,firm_type,agent_id,reference,remarks,pan_number,visiting_card,photo_1,photo_2,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date,products,brands) VALUES("27","SURUCHI CREATION","Indore","Indore","MADHYA PRADESH","452001","GSTIN","","","","","","","","","","0","","0.00","Buyer","0","","","","","","","1","2021-09-04 22:53:03","1","2021-09-04 22:53:03","FALSE","","1970-01-01 00:00:00","","");
INSERT INTO txt_company (company_id,firm_name,address,city,state,pincode,gstin,office_phone,contact_person,contact_person_2,contact_number,contact_number_2,sms_number,whatsapp_number,email,website,group_id,group_name,commission_percentage,firm_type,agent_id,reference,remarks,pan_number,visiting_card,photo_1,photo_2,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date,products,brands) VALUES("28","GL","Indore","Indore","MADHYA PRADESH","452001","GSTIN","","","","","","","","","","0","","0.00","Transport","0","","","","","","","1","2021-09-04 23:03:41","1","2021-09-07 00:42:16","FALSE","","1970-01-01 00:00:00","","");
INSERT INTO txt_company (company_id,firm_name,address,city,state,pincode,gstin,office_phone,contact_person,contact_person_2,contact_number,contact_number_2,sms_number,whatsapp_number,email,website,group_id,group_name,commission_percentage,firm_type,agent_id,reference,remarks,pan_number,visiting_card,photo_1,photo_2,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date,products,brands) VALUES("29","UC ","Indore","Indore","MADHYA PRADESH","452001","GSTIN","","","","","","","","","","0","","0.00","Transport","0","","","","","","","1","2021-09-04 23:04:45","1","2021-09-04 23:04:45","FALSE","","1970-01-01 00:00:00","","");
INSERT INTO txt_company (company_id,firm_name,address,city,state,pincode,gstin,office_phone,contact_person,contact_person_2,contact_number,contact_number_2,sms_number,whatsapp_number,email,website,group_id,group_name,commission_percentage,firm_type,agent_id,reference,remarks,pan_number,visiting_card,photo_1,photo_2,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date,products,brands) VALUES("30","RL","Indore","Indore","MADHYA PRADESH","452001","GSTIN","","","","","","","","","","0","","0.00","Transport","0","","","","","","","1","2021-09-04 23:05:57","1","2021-09-04 23:05:57","FALSE","","1970-01-01 00:00:00","","");
INSERT INTO txt_company (company_id,firm_name,address,city,state,pincode,gstin,office_phone,contact_person,contact_person_2,contact_number,contact_number_2,sms_number,whatsapp_number,email,website,group_id,group_name,commission_percentage,firm_type,agent_id,reference,remarks,pan_number,visiting_card,photo_1,photo_2,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date,products,brands) VALUES("31","GR","Indore","Indore","MADHYA PRADESH","452001","GSTIN","","","","","","","","","","0","","0.00","Transport","0","","","","","","","1","2021-09-04 23:07:14","1","2021-09-04 23:07:14","FALSE","","1970-01-01 00:00:00","","");
INSERT INTO txt_company (company_id,firm_name,address,city,state,pincode,gstin,office_phone,contact_person,contact_person_2,contact_number,contact_number_2,sms_number,whatsapp_number,email,website,group_id,group_name,commission_percentage,firm_type,agent_id,reference,remarks,pan_number,visiting_card,photo_1,photo_2,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date,products,brands) VALUES("32","ROSHAN TEXTILE","Bhilwara","Bhilwara","RAJASTHAN","311402","08AEZPB0307G1ZN","","","","","","","","","","0","","2.00","Other","0","","","","","","","1","2021-09-06 17:16:42","1","2021-09-06 17:16:42","FALSE","","1970-01-01 00:00:00","","");
INSERT INTO txt_company (company_id,firm_name,address,city,state,pincode,gstin,office_phone,contact_person,contact_person_2,contact_number,contact_number_2,sms_number,whatsapp_number,email,website,group_id,group_name,commission_percentage,firm_type,agent_id,reference,remarks,pan_number,visiting_card,photo_1,photo_2,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date,products,brands) VALUES("33","ROSHAN TEXTILE","Bhilwara","Bhilwara","RAJASTHAN","311402","08AEZPB0307G1ZN","","","","","","","","","","0","","2.00","Supplier","0","","","","","","","1","2021-09-06 17:19:45","1","2021-09-06 17:24:59","FALSE","","1970-01-01 00:00:00","","");
INSERT INTO txt_company (company_id,firm_name,address,city,state,pincode,gstin,office_phone,contact_person,contact_person_2,contact_number,contact_number_2,sms_number,whatsapp_number,email,website,group_id,group_name,commission_percentage,firm_type,agent_id,reference,remarks,pan_number,visiting_card,photo_1,photo_2,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date,products,brands) VALUES("34","JAGDISH TRANSPORT","Indore","Indore","MADHYA PRADESH","452001","GSTIN","","","","","","","","","","0","","0.00","Transport","0","","","","","","","1","2021-09-06 17:22:38","1","2021-09-06 17:22:38","FALSE","","1970-01-01 00:00:00","","");
INSERT INTO txt_company (company_id,firm_name,address,city,state,pincode,gstin,office_phone,contact_person,contact_person_2,contact_number,contact_number_2,sms_number,whatsapp_number,email,website,group_id,group_name,commission_percentage,firm_type,agent_id,reference,remarks,pan_number,visiting_card,photo_1,photo_2,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date,products,brands) VALUES("35","S K INDIA","Bhilwara","Bhilwara","RAJASTHAN","311402","08AATPC1215A1ZB","","","","","","","","","","0","","2.00","Supplier","0","","","","","","","1","2021-09-06 17:24:47","1","2021-09-06 17:24:47","FALSE","","1970-01-01 00:00:00","","");
INSERT INTO txt_company (company_id,firm_name,address,city,state,pincode,gstin,office_phone,contact_person,contact_person_2,contact_number,contact_number_2,sms_number,whatsapp_number,email,website,group_id,group_name,commission_percentage,firm_type,agent_id,reference,remarks,pan_number,visiting_card,photo_1,photo_2,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date,products,brands) VALUES("36","MRL TRANSPORT","Indore","Indore","MADHYA PRADESH","452001","GSTIN","","","","","","","","","","0","","0.00","Transport","0","","","","","","","1","2021-09-06 23:52:20","1","2021-09-06 23:52:20","FALSE","","1970-01-01 00:00:00","","");
INSERT INTO txt_company (company_id,firm_name,address,city,state,pincode,gstin,office_phone,contact_person,contact_person_2,contact_number,contact_number_2,sms_number,whatsapp_number,email,website,group_id,group_name,commission_percentage,firm_type,agent_id,reference,remarks,pan_number,visiting_card,photo_1,photo_2,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date,products,brands) VALUES("37","MANIDHARI GARMENTS","Indore","Indore","MADHYA PRADESH","452001","GSTIN","","","","","","","","","","0","","0.00","Buyer","0","","","","","","","1","2021-09-07 00:37:00","1","2021-09-07 00:37:00","FALSE","","1970-01-01 00:00:00","","");
INSERT INTO txt_company (company_id,firm_name,address,city,state,pincode,gstin,office_phone,contact_person,contact_person_2,contact_number,contact_number_2,sms_number,whatsapp_number,email,website,group_id,group_name,commission_percentage,firm_type,agent_id,reference,remarks,pan_number,visiting_card,photo_1,photo_2,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date,products,brands) VALUES("38","SHREE RAM GARMENTS","Indore","Indore","MADHYA PRADESH","452001","GSTIN","","","","","","","","","","0","","0.00","Buyer","0","","","","","","","1","2021-09-07 13:04:48","1","2021-09-07 13:04:48","FALSE","","1970-01-01 00:00:00","","");
INSERT INTO txt_company (company_id,firm_name,address,city,state,pincode,gstin,office_phone,contact_person,contact_person_2,contact_number,contact_number_2,sms_number,whatsapp_number,email,website,group_id,group_name,commission_percentage,firm_type,agent_id,reference,remarks,pan_number,visiting_card,photo_1,photo_2,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date,products,brands) VALUES("39","SAJAN SHREE GARMENTS","Indore","Indore","MADHYA PRADESH","452001","GSTIN","","","","","","","","","","0","","0.00","Buyer","0","","","","","","","1","2021-09-07 13:05:21","1","2021-09-07 13:05:21","FALSE","","1970-01-01 00:00:00","","");
INSERT INTO txt_company (company_id,firm_name,address,city,state,pincode,gstin,office_phone,contact_person,contact_person_2,contact_number,contact_number_2,sms_number,whatsapp_number,email,website,group_id,group_name,commission_percentage,firm_type,agent_id,reference,remarks,pan_number,visiting_card,photo_1,photo_2,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date,products,brands) VALUES("40","MEHTA APPARELS","Indore","Indore","MADHYA PRADESH","452001","GSTIN","","","","","","","","","","0","","0.00","Buyer","0","","","","","","","1","2021-09-07 13:06:05","1","2021-09-07 13:06:05","FALSE","","1970-01-01 00:00:00","","");
INSERT INTO txt_company (company_id,firm_name,address,city,state,pincode,gstin,office_phone,contact_person,contact_person_2,contact_number,contact_number_2,sms_number,whatsapp_number,email,website,group_id,group_name,commission_percentage,firm_type,agent_id,reference,remarks,pan_number,visiting_card,photo_1,photo_2,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date,products,brands) VALUES("41","KAMAL CUTPIECE CENTER","Ujjain","Ujjain","MADHYA PRADESH","456001","GSTIN","","","","","","","","","","0","","0.00","Buyer","0","","","","","","","1","2021-09-07 13:09:32","1","2021-09-07 13:09:32","FALSE","","1970-01-01 00:00:00","","");
INSERT INTO txt_company (company_id,firm_name,address,city,state,pincode,gstin,office_phone,contact_person,contact_person_2,contact_number,contact_number_2,sms_number,whatsapp_number,email,website,group_id,group_name,commission_percentage,firm_type,agent_id,reference,remarks,pan_number,visiting_card,photo_1,photo_2,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date,products,brands) VALUES("42","KRISHNA ENTERPRISES","Indore","Indore","MADHYA PRADESH","452001","GSTIN","","","","","","","","","","0","","0.00","Buyer","0","","","","","","","1","2021-09-07 13:10:33","1","2021-09-07 13:10:33","FALSE","","1970-01-01 00:00:00","","");
INSERT INTO txt_company (company_id,firm_name,address,city,state,pincode,gstin,office_phone,contact_person,contact_person_2,contact_number,contact_number_2,sms_number,whatsapp_number,email,website,group_id,group_name,commission_percentage,firm_type,agent_id,reference,remarks,pan_number,visiting_card,photo_1,photo_2,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date,products,brands) VALUES("43","MANISH KUMAR VIPIN KUMAR","Indore","Indore","MADHYA PRADESH","452001","GSTIN","","","","","","","","","","0","","0.00","Buyer","0","","","","","","","1","2021-09-07 13:11:01","1","2021-09-07 13:11:01","FALSE","","1970-01-01 00:00:00","","");
INSERT INTO txt_company (company_id,firm_name,address,city,state,pincode,gstin,office_phone,contact_person,contact_person_2,contact_number,contact_number_2,sms_number,whatsapp_number,email,website,group_id,group_name,commission_percentage,firm_type,agent_id,reference,remarks,pan_number,visiting_card,photo_1,photo_2,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date,products,brands) VALUES("44","SHRI KALYAN TEXTILE MILL","Bhilwara","Bhilwara","RAJASTHAN","311402","GSTIN","","","","","","","","","","0","","2.00","Supplier","0","","","","","","","1","2021-09-07 14:24:25","1","2021-09-07 14:24:56","FALSE","","1970-01-01 00:00:00","","");
INSERT INTO txt_company (company_id,firm_name,address,city,state,pincode,gstin,office_phone,contact_person,contact_person_2,contact_number,contact_number_2,sms_number,whatsapp_number,email,website,group_id,group_name,commission_percentage,firm_type,agent_id,reference,remarks,pan_number,visiting_card,photo_1,photo_2,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date,products,brands) VALUES("45","HATH LORRY","Indore","Indore","MADHYA PRADESH","452001","GSTIN","","","","","","","","","","0","","0.00","Transport","0","","","","","","","1","2021-09-07 14:34:44","1","2021-09-07 14:34:44","FALSE","","1970-01-01 00:00:00","","");
INSERT INTO txt_company (company_id,firm_name,address,city,state,pincode,gstin,office_phone,contact_person,contact_person_2,contact_number,contact_number_2,sms_number,whatsapp_number,email,website,group_id,group_name,commission_percentage,firm_type,agent_id,reference,remarks,pan_number,visiting_card,photo_1,photo_2,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date,products,brands) VALUES("46","ADORE SUITINGS PVT. LTD","Bhilwara","Bhilwara","RAJASTHAN","311402","08AAECA4089J1ZE","","","","","","","","","","0","","2.00","Supplier","0","","","","","","","1","2021-09-07 15:23:32","1","2021-09-07 15:23:32","FALSE","","1970-01-01 00:00:00","","");



  DROP TABLE IF EXISTS `txt_group_master`; 



CREATE TABLE `txt_group_master` (
  `group_id` int(10) unsigned NOT NULL auto_increment,
  `group_name` varchar(100) default NULL,
  `group_desc` varchar(200) default NULL,
  `create_user` varchar(20) NOT NULL default '',
  `create_date` datetime NOT NULL default '1970-01-01 00:00:00',
  `last_update_user` varchar(20) NOT NULL default '',
  `last_update_date` datetime NOT NULL default '1970-01-01 00:00:00',
  `delete_tag` varchar(10) NOT NULL default 'FALSE',
  `delete_user` varchar(20) default '',
  `delete_date` datetime NOT NULL default '1970-01-01 00:00:00',
  `group_type` varchar(20) NOT NULL default '',
  PRIMARY KEY  (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




  DROP TABLE IF EXISTS `txt_login`; 



CREATE TABLE `txt_login` (
  `login_id` int(11) NOT NULL auto_increment,
  `login_name` varchar(30) default NULL,
  `login_password` varchar(30) default NULL,
  `login_type` varchar(30) default NULL,
  `user_name` varchar(50) default NULL,
  `region` varchar(50) default NULL,
  `email` varchar(50) default NULL,
  `active` tinyint(4) default '0' COMMENT '0=active 1=non active',
  `show_hide` varchar(2000) default NULL,
  `create_user` varchar(20) NOT NULL default '',
  `create_date` datetime NOT NULL default '1970-01-01 00:00:00',
  `last_update_user` varchar(20) NOT NULL default '',
  `last_update_date` datetime NOT NULL default '1970-01-01 00:00:00',
  `delete_tag` varchar(10) NOT NULL default 'FALSE',
  `delete_user` varchar(20) default '',
  `delete_date` datetime NOT NULL default '1970-01-01 00:00:00',
  PRIMARY KEY  (`login_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO txt_login (login_id,login_name,login_password,login_type,user_name,region,email,active,show_hide,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("1","admin","admin","admin","Administrator","","","0","","","1970-01-01 00:00:00","","1970-01-01 00:00:00","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_login (login_id,login_name,login_password,login_type,user_name,region,email,active,show_hide,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("2","test","test123","admin","Testing","","1","0","","","1970-01-01 00:00:00","","1970-01-01 00:00:00","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_login (login_id,login_name,login_password,login_type,user_name,region,email,active,show_hide,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("4","pritesh","pritesh123","user","Pritesh","","pritsneh1@gmail.com","0","","","1970-01-01 00:00:00","","1970-01-01 00:00:00","FALSE","","1970-01-01 00:00:00");
INSERT INTO txt_login (login_id,login_name,login_password,login_type,user_name,region,email,active,show_hide,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("6","PriteshShah","pritesh@28Jun","admin","Pritesh Shah","","priteshdshah@gmail.com","0","","","1970-01-01 00:00:00","","1970-01-01 00:00:00","FALSE","","1970-01-01 00:00:00");



  DROP TABLE IF EXISTS `txt_menus`; 



CREATE TABLE `txt_menus` (
  `menu_id` int(11) NOT NULL auto_increment,
  `menutype` varchar(30) default NULL COMMENT 'topmenu,leftmenu',
  `name` varchar(30) default NULL,
  `link` varchar(100) default NULL,
  `menu_for` varchar(20) default NULL COMMENT 'login role',
  `menu_order` int(11) default NULL,
  `create_user` varchar(20) NOT NULL default '',
  `create_date` datetime NOT NULL default '1970-01-01 00:00:00',
  `last_update_user` varchar(20) NOT NULL default '',
  `last_update_date` datetime NOT NULL default '1970-01-01 00:00:00',
  `delete_tag` varchar(10) NOT NULL default 'FALSE',
  `delete_user` varchar(20) default '',
  `delete_date` datetime NOT NULL default '1970-01-01 00:00:00',
  PRIMARY KEY  (`menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




  DROP TABLE IF EXISTS `txt_payment_bill_entry`; 



CREATE TABLE `txt_payment_bill_entry` (
  `payment_bill_entry_id` bigint(20) NOT NULL auto_increment,
  `payment_entry_id` bigint(20) NOT NULL default '0',
  `payment_entry_vou_date` date NOT NULL default '1970-01-01',
  `bill_entry_id` bigint(20) NOT NULL,
  `bill_number` varchar(20) NOT NULL default '''',
  `bill_date` date NOT NULL default '1970-01-01',
  `bill_amount` decimal(15,2) NOT NULL default '0.00',
  `amount_adjusted` decimal(15,2) NOT NULL default '0.00',
  `gr_adjusted` decimal(15,2) NOT NULL default '0.00',
  `discount_adjusted` decimal(15,2) NOT NULL default '0.00',
  `bill_payment_type` varchar(20) NOT NULL default '',
  `dis_percent` decimal(15,2) NOT NULL default '0.00',
  `dis_amount` decimal(15,2) NOT NULL default '0.00',
  `deduction_amount` decimal(15,2) NOT NULL default '0.00',
  `bill_gr_amt` decimal(15,2) NOT NULL default '0.00',
  `payment_received` decimal(15,2) NOT NULL default '0.00',
  `balance_amount` decimal(15,2) NOT NULL,
  `remark` varchar(50) NOT NULL default '',
  `create_user` varchar(20) NOT NULL default '',
  `create_date` datetime NOT NULL default '1970-01-01 00:00:00',
  `last_update_user` varchar(20) NOT NULL default '',
  `last_update_date` datetime NOT NULL default '1970-01-01 00:00:00',
  `delete_tag` varchar(10) NOT NULL default 'FALSE',
  `delete_user` varchar(20) NOT NULL default '',
  `delete_date` datetime NOT NULL default '1970-01-01 00:00:00',
  `bill_discount` decimal(15,2) NOT NULL default '0.00',
  PRIMARY KEY  (`payment_bill_entry_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO txt_payment_bill_entry (payment_bill_entry_id,payment_entry_id,payment_entry_vou_date,bill_entry_id,bill_number,bill_date,bill_amount,amount_adjusted,gr_adjusted,discount_adjusted,bill_payment_type,dis_percent,dis_amount,deduction_amount,bill_gr_amt,payment_received,balance_amount,remark,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date,bill_discount) VALUES("1","1","2021-09-04","1","15","2021-09-01","52961.00","0.00","0.00","0.00","Full","3.00","1588.83","1372.17","0.00","50000.00","0.00","","1","2021-09-04 20:00:10","","1970-01-01 00:00:00","TRUE","1","2021-09-04 23:16:45","0.00");
INSERT INTO txt_payment_bill_entry (payment_bill_entry_id,payment_entry_id,payment_entry_vou_date,bill_entry_id,bill_number,bill_date,bill_amount,amount_adjusted,gr_adjusted,discount_adjusted,bill_payment_type,dis_percent,dis_amount,deduction_amount,bill_gr_amt,payment_received,balance_amount,remark,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date,bill_discount) VALUES("2","2","2021-09-06","3","2003","2021-02-10","46237.00","0.00","0.00","0.00","Full","0.00","0.00","0.00","0.00","46237.00","0.00","","1","2021-09-06 17:05:28","","1970-01-01 00:00:00","TRUE","1","2021-09-07 02:24:57","0.00");



  DROP TABLE IF EXISTS `txt_payment_cheque_entry`; 



CREATE TABLE `txt_payment_cheque_entry` (
  `payment_chq_entry_id` bigint(20) NOT NULL auto_increment,
  `payment_entry_id` bigint(20) NOT NULL,
  `chq_number` varchar(20) NOT NULL default '''''',
  `chq_date` date NOT NULL default '1970-01-01',
  `bank` varchar(20) NOT NULL default '''''',
  `chq_amt` decimal(15,2) NOT NULL default '0.00',
  `dis_amt` decimal(15,2) NOT NULL default '0.00',
  `remark` varchar(50) NOT NULL default '''''',
  `create_user` varchar(20) NOT NULL default '''''',
  `create_date` datetime NOT NULL default '1970-01-01 00:00:00',
  `last_update_user` varchar(20) NOT NULL default '''''',
  `last_update_date` datetime NOT NULL default '1970-01-01 00:00:00',
  `delete_tag` varchar(10) NOT NULL default 'FALSE',
  `delete_user` varchar(20) NOT NULL default '''''',
  `delete_date` datetime NOT NULL default '1970-01-01 00:00:00',
  PRIMARY KEY  (`payment_chq_entry_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO txt_payment_cheque_entry (payment_chq_entry_id,payment_entry_id,chq_number,chq_date,bank,chq_amt,dis_amt,remark,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("1","1","","1970-01-01","direct","50000.00","2961.00","","1","2021-09-04 20:00:10","''","1970-01-01 00:00:00","TRUE","1","2021-09-04 23:16:45");
INSERT INTO txt_payment_cheque_entry (payment_chq_entry_id,payment_entry_id,chq_number,chq_date,bank,chq_amt,dis_amt,remark,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("2","2","001077","2021-07-29","ICICI","46237.00","0.00","","1","2021-09-06 17:05:28","''","1970-01-01 00:00:00","TRUE","1","2021-09-07 02:24:57");



  DROP TABLE IF EXISTS `txt_payment_entry_main`; 



CREATE TABLE `txt_payment_entry_main` (
  `payment_entry_id` bigint(20) NOT NULL auto_increment,
  `manual_vou_number` varchar(20) NOT NULL default '',
  `old_system_vou_number` varchar(20) NOT NULL default '',
  `voucher_date` date NOT NULL default '1970-01-01',
  `buyer_account_code` varchar(20) NOT NULL default '',
  `supplier_account_code` varchar(20) NOT NULL default '',
  `vou_type` varchar(20) NOT NULL default '',
  `payment_amount` decimal(15,2) NOT NULL default '0.00',
  `discount_amount` decimal(15,2) NOT NULL default '0.00',
  `gr_amount` decimal(15,2) NOT NULL default '0.00',
  `narration` varchar(100) NOT NULL default '',
  `supporting_doc_1` varchar(200) NOT NULL default '',
  `supporting_doc_2` varchar(200) NOT NULL default '',
  `create_user` varchar(20) NOT NULL default '',
  `create_date` datetime NOT NULL default '1970-01-01 00:00:00',
  `last_update_user` varchar(20) NOT NULL default '',
  `last_update_date` datetime NOT NULL default '1970-01-01 00:00:00',
  `delete_tag` varchar(10) NOT NULL default 'FALSE',
  `delete_user` varchar(20) NOT NULL default '',
  `delete_date` datetime NOT NULL default '1970-01-01 00:00:00',
  PRIMARY KEY  (`payment_entry_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO txt_payment_entry_main (payment_entry_id,manual_vou_number,old_system_vou_number,voucher_date,buyer_account_code,supplier_account_code,vou_type,payment_amount,discount_amount,gr_amount,narration,supporting_doc_1,supporting_doc_2,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("1","45","","2021-09-04","2","1","Payment","50000.00","2961.00","0.00","","","","1","2021-09-04 20:00:10","1","2021-09-04 20:00:10","TRUE","1","2021-09-04 23:16:45");
INSERT INTO txt_payment_entry_main (payment_entry_id,manual_vou_number,old_system_vou_number,voucher_date,buyer_account_code,supplier_account_code,vou_type,payment_amount,discount_amount,gr_amount,narration,supporting_doc_1,supporting_doc_2,create_user,create_date,last_update_user,last_update_date,delete_tag,delete_user,delete_date) VALUES("2","27511","","2021-09-06","19","4","Payment","46237.00","0.00","0.00","","","","1","2021-09-06 17:05:28","1","2021-09-06 17:05:28","TRUE","1","2021-09-07 02:24:57");



  DROP TABLE IF EXISTS `txt_payment_gr_entry`; 



CREATE TABLE `txt_payment_gr_entry` (
  `payment_gr_entry_id` bigint(20) NOT NULL auto_increment,
  `payment_entry_id` bigint(20) NOT NULL default '0',
  `lr_number` varchar(20) NOT NULL default '',
  `lr_date` date NOT NULL default '1970-01-01',
  `transport` varchar(20) NOT NULL default '',
  `booked_to` varchar(20) NOT NULL default '',
  `number_of_bales` varchar(20) NOT NULL default '',
  `total_weight` varchar(20) NOT NULL default '',
  `gr_amount` decimal(15,2) NOT NULL default '0.00',
  `remark` varchar(50) NOT NULL default '',
  `create_user` varchar(20) NOT NULL default '',
  `create_date` datetime NOT NULL default '1970-01-01 00:00:00',
  `last_update_user` varchar(20) NOT NULL default '',
  `last_update_date` datetime NOT NULL default '1970-01-01 00:00:00',
  `delete_tag` varchar(10) NOT NULL default 'FALSE',
  `delete_user` varchar(20) NOT NULL default '',
  `delete_date` datetime NOT NULL default '1970-01-01 00:00:00',
  PRIMARY KEY  (`payment_gr_entry_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




  DROP TABLE IF EXISTS `txt_states`; 



CREATE TABLE `txt_states` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `state` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

INSERT INTO txt_states (id,state) VALUES("1","ANDAMAN AND NICOBAR ISLANDS");
INSERT INTO txt_states (id,state) VALUES("2","ANDHRA PRADESH");
INSERT INTO txt_states (id,state) VALUES("3","ARUNACHAL PRADESH");
INSERT INTO txt_states (id,state) VALUES("4","ASSAM");
INSERT INTO txt_states (id,state) VALUES("5","BIHAR");
INSERT INTO txt_states (id,state) VALUES("6","CHATTISGARH");
INSERT INTO txt_states (id,state) VALUES("7","CHANDIGARH");
INSERT INTO txt_states (id,state) VALUES("8","DAMAN AND DIU");
INSERT INTO txt_states (id,state) VALUES("9","DELHI");
INSERT INTO txt_states (id,state) VALUES("10","DADRA AND NAGAR HAVELI");
INSERT INTO txt_states (id,state) VALUES("11","GOA");
INSERT INTO txt_states (id,state) VALUES("12","GUJARAT");
INSERT INTO txt_states (id,state) VALUES("13","HIMACHAL PRADESH");
INSERT INTO txt_states (id,state) VALUES("14","HARYANA");
INSERT INTO txt_states (id,state) VALUES("15","JAMMU AND KASHMIR");
INSERT INTO txt_states (id,state) VALUES("16","JHARKHAND");
INSERT INTO txt_states (id,state) VALUES("17","KERALA");
INSERT INTO txt_states (id,state) VALUES("18","KARNATAKA");
INSERT INTO txt_states (id,state) VALUES("19","LAKSHADWEEP");
INSERT INTO txt_states (id,state) VALUES("20","MEGHALAYA");
INSERT INTO txt_states (id,state) VALUES("21","MAHARASHTRA");
INSERT INTO txt_states (id,state) VALUES("22","MANIPUR");
INSERT INTO txt_states (id,state) VALUES("23","MADHYA PRADESH");
INSERT INTO txt_states (id,state) VALUES("24","MIZORAM");
INSERT INTO txt_states (id,state) VALUES("25","NAGALAND");
INSERT INTO txt_states (id,state) VALUES("26","ORISSA");
INSERT INTO txt_states (id,state) VALUES("27","PUNJAB");
INSERT INTO txt_states (id,state) VALUES("28","PONDICHERRY");
INSERT INTO txt_states (id,state) VALUES("29","RAJASTHAN");
INSERT INTO txt_states (id,state) VALUES("30","SIKKIM");
INSERT INTO txt_states (id,state) VALUES("31","TAMIL NADU");
INSERT INTO txt_states (id,state) VALUES("32","TRIPURA");
INSERT INTO txt_states (id,state) VALUES("33","UTTARAKHAND");
INSERT INTO txt_states (id,state) VALUES("34","UTTAR PRADESH");
INSERT INTO txt_states (id,state) VALUES("35","WEST BENGAL");
INSERT INTO txt_states (id,state) VALUES("36","TELANGANA");



  DROP VIEW IF EXISTS `view_active_company`; 



CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_active_company` AS (select `txt_company`.`company_id` AS `company_id`,`txt_company`.`firm_name` AS `firm_name`,`txt_company`.`address` AS `address`,`txt_company`.`city` AS `city`,`txt_company`.`state` AS `state`,`txt_company`.`pincode` AS `pincode`,`txt_company`.`gstin` AS `gstin`,`txt_company`.`contact_person` AS `contact_person`,`txt_company`.`contact_number` AS `contact_number`,`txt_company`.`sms_number` AS `sms_number`,`txt_company`.`whatsapp_number` AS `whatsapp_number`,`txt_company`.`email` AS `email`,`txt_company`.`website` AS `website`,`txt_company`.`group_id` AS `group_id`,`txt_company`.`group_name` AS `group_name`,`txt_company`.`commission_percentage` AS `commission_percentage`,`txt_company`.`firm_type` AS `firm_type`,`txt_company`.`agent_id` AS `agent_id`,`txt_company`.`reference` AS `reference`,`txt_company`.`remarks` AS `remarks`,`txt_company`.`pan_number` AS `pan_number`,`txt_company`.`visiting_card` AS `visiting_card`,`txt_company`.`photo_1` AS `photo_1`,`txt_company`.`photo_2` AS `photo_2`,`txt_company`.`create_user` AS `create_user`,`txt_company`.`create_date` AS `create_date`,`txt_company`.`last_update_user` AS `last_update_user`,`txt_company`.`last_update_date` AS `last_update_date`,`txt_company`.`delete_tag` AS `delete_tag`,`txt_company`.`delete_user` AS `delete_user`,`txt_company`.`delete_date` AS `delete_date`,`txt_company`.`products` AS `products`,`txt_company`.`brands` AS `brands` from `txt_company` where (`txt_company`.`delete_tag` = _latin1'FALSE'));




  DROP VIEW IF EXISTS `view_bill_entry_id_full`; 



CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_bill_entry_id_full` AS (select `txt_payment_bill_entry`.`bill_entry_id` AS `bill_entry_id` from `txt_payment_bill_entry` where ((`txt_payment_bill_entry`.`delete_tag` = _latin1'FALSE') and (`txt_payment_bill_entry`.`bill_payment_type` = _latin1'Full')));




  DROP VIEW IF EXISTS `view_buyer`; 



CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_buyer` AS (select `txt_company`.`company_id` AS `company_id`,`txt_company`.`firm_name` AS `firm_name`,`txt_company`.`address` AS `address`,`txt_company`.`city` AS `city`,`txt_company`.`state` AS `state`,`txt_company`.`pincode` AS `pincode`,`txt_company`.`gstin` AS `gstin`,`txt_company`.`contact_person` AS `contact_person`,`txt_company`.`contact_number` AS `contact_number`,`txt_company`.`sms_number` AS `sms_number`,`txt_company`.`whatsapp_number` AS `whatsapp_number`,`txt_company`.`email` AS `email`,`txt_company`.`website` AS `website`,`txt_company`.`group_id` AS `group_id`,`txt_company`.`group_name` AS `group_name`,`txt_company`.`commission_percentage` AS `commission_percentage`,`txt_company`.`firm_type` AS `firm_type`,`txt_company`.`agent_id` AS `agent_id`,`txt_company`.`reference` AS `reference`,`txt_company`.`remarks` AS `remarks`,`txt_company`.`pan_number` AS `pan_number`,`txt_company`.`visiting_card` AS `visiting_card`,`txt_company`.`photo_1` AS `photo_1`,`txt_company`.`photo_2` AS `photo_2`,`txt_company`.`create_user` AS `create_user`,`txt_company`.`create_date` AS `create_date`,`txt_company`.`last_update_user` AS `last_update_user`,`txt_company`.`last_update_date` AS `last_update_date`,`txt_company`.`delete_tag` AS `delete_tag`,`txt_company`.`delete_user` AS `delete_user`,`txt_company`.`delete_date` AS `delete_date`,`txt_company`.`products` AS `products`,`txt_company`.`brands` AS `brands` from `txt_company` where ((`txt_company`.`delete_tag` = _latin1'FALSE') and (`txt_company`.`firm_type` = _latin1'Buyer')));




  DROP VIEW IF EXISTS `view_supplier`; 



CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_supplier` AS (select `txt_company`.`company_id` AS `company_id`,`txt_company`.`firm_name` AS `firm_name`,`txt_company`.`address` AS `address`,`txt_company`.`city` AS `city`,`txt_company`.`state` AS `state`,`txt_company`.`pincode` AS `pincode`,`txt_company`.`gstin` AS `gstin`,`txt_company`.`contact_person` AS `contact_person`,`txt_company`.`contact_number` AS `contact_number`,`txt_company`.`sms_number` AS `sms_number`,`txt_company`.`whatsapp_number` AS `whatsapp_number`,`txt_company`.`email` AS `email`,`txt_company`.`website` AS `website`,`txt_company`.`group_id` AS `group_id`,`txt_company`.`group_name` AS `group_name`,`txt_company`.`commission_percentage` AS `commission_percentage`,`txt_company`.`firm_type` AS `firm_type`,`txt_company`.`agent_id` AS `agent_id`,`txt_company`.`reference` AS `reference`,`txt_company`.`remarks` AS `remarks`,`txt_company`.`pan_number` AS `pan_number`,`txt_company`.`visiting_card` AS `visiting_card`,`txt_company`.`photo_1` AS `photo_1`,`txt_company`.`photo_2` AS `photo_2`,`txt_company`.`create_user` AS `create_user`,`txt_company`.`create_date` AS `create_date`,`txt_company`.`last_update_user` AS `last_update_user`,`txt_company`.`last_update_date` AS `last_update_date`,`txt_company`.`delete_tag` AS `delete_tag`,`txt_company`.`delete_user` AS `delete_user`,`txt_company`.`delete_date` AS `delete_date`,`txt_company`.`products` AS `products`,`txt_company`.`brands` AS `brands` from `txt_company` where ((`txt_company`.`delete_tag` = _latin1'FALSE') and (`txt_company`.`firm_type` = _latin1'Supplier')));



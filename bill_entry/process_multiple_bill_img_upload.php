<?php include("../includes/check_session.php");
include("../includes/config.php"); ?>

<?php 

$search_supplier_code="";
if(isset($_REQUEST['search_supplier_account_code'])){
  $search_supplier_code=$_REQUEST['search_supplier_account_code'];
}
$search_buyer_code="";
if(isset($_REQUEST['search_buyer_account_code'])){
  $search_buyer_code=$_REQUEST['search_buyer_account_code'];
}


$vou_start_date="";
if(isset($_REQUEST['vou_start_date'])){
  $vou_start_date=$_REQUEST['vou_start_date'];
 // echo $vou_start_date;
}

$vou_end_date="";
if(isset($_REQUEST['vou_end_date'])){
  $vou_end_date=$_REQUEST['vou_end_date'];
  //echo $vou_end_date;
}

?>

<form  name='process_multiple' method="post" id="process_multiple" enctype="multipart/form-data" action='upload_multiple_bill_img.php' onsubmit="">

<input type='hidden' name='search_supplier_code' id='search_supplier_code' value='<?php echo $search_supplier_code ?>' >
<input type='hidden' name='search_buyer_code' id='search_buyer_code' value='<?php echo $search_buyer_code ?>' >
<input type='hidden' name='vou_start_date' id='vou_start_date' value='<?php echo $vou_start_date ?>' >
<input type='hidden' name='vou_end_date' id='vou_end_date' value='<?php echo $vou_end_date ?>' >

<input type='hidden' name='bill_report_disp' id='bill_report_disp' value='OK' >

<?php

//bill_entry_id

$bill_entry_id_array = array();
if(isset($_REQUEST['bill_entry_id'])){
    $bill_entry_id_array=$_REQUEST['bill_entry_id'];
    //echo $bill_entry_id_array;
}
$bill_entry_id_array_size=sizeof($bill_entry_id_array);


//bill_upload

//$bill_upload_array = array();
//if(isset($_REQUEST['bill_upload'])){
   // $bill_upload_array=$_REQUEST['bill_upload'];
//}
//$bill_upload_array_size=sizeof($bill_upload_array);

$con=get_connection();

for($b=0;$b<$bill_entry_id_array_size;$b++){

    //echo "Pritesh -- <BR>";
    $bill_entry_id= $bill_entry_id_array[$b];
    //echo $bill_entry_id;
    //echo "!--";

    //$_FILES['bill_upload']['name']
    $bill_upload_element=$_FILES['bill_upload_'.$bill_entry_id]['name'];
    //echo $bill_upload_element;
    //echo $bill_upload_array[$b]['name'];
    //echo "!--";
    //echo "!-- <BR>";

    $bill_upload="";
    if($_FILES['bill_upload_'.$bill_entry_id]['name']!="") { // only if files are selected -- to pevent blank entry in table
        $file_name_bill_upload = $_FILES['bill_upload_'.$bill_entry_id]['name'];
        $file_size_bill_upload =$_FILES['bill_upload_'.$bill_entry_id]['size'];
        $file_tmp_bill_upload =$_FILES['bill_upload_'.$bill_entry_id]['tmp_name'];
        $file_type_bill_upload=$_FILES['bill_upload_'.$bill_entry_id]['type'];	
        if($file_size_bill_upload > 10485760){  // 2097152  
            $errors[]='File size must be less than 2 MB';
        }		
            $random_digit=time()+3;
            $file_name_bill_upload = str_replace(' ', '_', $file_name_bill_upload);
            $file_name_bill_upload = $random_digit."_".$file_name_bill_upload;
            move_uploaded_file($file_tmp_bill_upload,"upload/".$file_name_bill_upload); //echo $file_name1;
            $bill_upload=$file_name_bill_upload;
    }


    




    if($bill_upload != "") {
        $last_update_user=$_SESSION['LOGID'];
        $sql =" update txt_bill_entry set ";
        $sql .= " bill_upload='$bill_upload' ";
        $sql .= " ,
                 last_update_user='$last_update_user',
                last_update_date=NOW()       
                where bill_entry_id='$bill_entry_id' ";
        //echo $sql;
        $result=mysqli_query($con,$sql);
    }


    
}




?>

</form>
<script>
document.getElementById('process_multiple').submit();
</script>
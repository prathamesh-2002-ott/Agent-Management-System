<?php include("../includes/check_session.php");
include("../includes/config.php");
//error_reporting(0);
?>

<?php
$action = isset($_GET['action']) ? $_GET['action'] : '';

switch($action) {
	case 'add':
		save();
		break;
	case 'modify':
		update();
		break;
	case 'delete' :
		delete(); 
		break;	
	case 'remfile' :
		removeFile();
		break;		
}

echo "<script language='javascript'>";
echo "location.href='index.php'";
echo "</script>";

function save() 
{
	$con=get_connection();
	if(($_REQUEST['group_name']) && ($_SESSION['uid']==77)) {
		$group_name=trim($_REQUEST['group_name']); 
		$group_desc=trim($_REQUEST['group_desc']);
		$group_type=trim($_REQUEST['group_type']);
		
		$sql="insert into 	txt_group_master(group_type,group_name,group_desc) values('$group_type','$group_name','$group_desc')";
		//echo $sql; 
		$result=mysqli_query($con,$sql); //echo $result;
		
		
				if(mysqli_errno($con)==0) { 
					$_SESSION['msg']="<div class='success-message'>Group $group_name Successfully Added</div>";
				} 
				else 	{
					$_SESSION['msg']="<div class='error-message'>Group Not Addedd</div>";
					//$_SESSION['msg']=$msg; 
					
				}
				$_SESSION['uid']=11;
	}

	release_connection($con);

}

function update() {
	
	if(($_REQUEST['group_name']) && ($_SESSION['uid']==77)) {
		$con=get_connection();
		
		$group_id=$_REQUEST['group_id'];
		$group_name=trim($_REQUEST['group_name']);
		$group_desc=$_REQUEST['group_desc'];
		$group_type=trim($_REQUEST['group_type']);

		$sql  = " update txt_group_master set ";
		$sql .= " group_type='$group_type',";
		$sql .= " group_name='$group_name',";
		$sql .= " group_desc='$group_desc'";
		$sql .= " where group_id='$group_id' limit 1";
		$result=mysqli_query($con,$sql); //echo $sql;
		//echo $result;
		
		if(mysqli_errno($con)==0) 	{ 
			$_SESSION['msg']="<div class='success-message'>Group $group_name Successfully Updated</div>";
		} 
		else 	{
			$_SESSION['msg']="<div class='error-message'>Group Not Updated</div>";
			//$_SESSION['msg']=$msg;
			
		}
		$_SESSION['uid']=11;

		release_connection($con);

	}
}


function delete() {
	if(($_REQUEST['group_id']) && ($_SESSION['uid']=77)) 	{
		$con=get_connection();
		$group_id=$_REQUEST['group_id'];
		$sql="delete from txt_group_master where group_id='$group_id' limit 1";
		$result=mysqli_query($con,$sql);	
		if(mysqli_error($con)==0)  	{ 
			$_SESSION['msg']="<div class='success-message'>Group Id :$group_id Successfully Deleted</div>";
		} 
		else  	{
			$msg=getSqlMessage(mysqli_error($con),"Group Not Deleted");
			$_SESSION['msg']="<div class='error-message'>$msg</div>";
		}	
		
		release_connection($con);
	
	}
}
?>
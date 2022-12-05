<?php 
include("../../includes/check_session_admin.php"); 
include("../../includes/config.php"); 
?>
<?php

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch($action) {
	case 'add':
		saveUser();
		break;
	case 'modify' :
		updateUser();
		break;
	case 'delete' :
		deleteUser();
		break;	
}		

	echo "<script language='javascript'>";
	echo "location.href='index.php'";
	echo "</script>";


function saveUser() {
		// get data 
		if(($_REQUEST['login_name']) && ($_SESSION['uid']==77)) {
				$login_name=trim($_REQUEST['login_name']);
				$login_password=trim($_REQUEST['login_password']);
				$login_type=$_REQUEST['login_type'];		
				$user_name=$_REQUEST['user_name'];		
				$email=$_REQUEST['email'];		

				$con=get_connection();
				// first check the presence of category name in table to avoid duplicate entry
				$sql="Select * from txt_login where login_name='$login_name'";
				$result=mysqli_query($con,$sql);
				$num=mysqli_num_rows($result);
				if($num>0) {
					$_SESSION['msg']="<div class='error-message'>Login Name Already Present -- Select another Login Name </div>";
					$_SESSION['uid']=11;
					return;
				}
				
				$sql="Insert into txt_login(login_name,login_password,login_type,user_name,email) ";
				$sql .= " VALUES (";
				$sql .= "'".$login_name ."',";
				$sql .= "'".$login_password ."',";
				$sql .= "'".$login_type ."',";
				$sql .= "'".$user_name."',";								
				$sql .= "'".$email."'";								
				$sql .= ")";
	//	echo $sql;
				$result=mysqli_query($con,$sql);
				
				
		
				if(mysqli_errno($con)==0) { 
					$_SESSION['msg']="<div class='success-message'>User Successfully Added</div>";
				} else {
					$msg=getSqlMessage(mysqli_errno($con),"User ");
					$_SESSION['msg']=$msg;
				}

				$_SESSION['uid']=11;

				release_connection($con);
				
		}
		
}		



function updateUser() {
	
		// get data 
		if(($_REQUEST['login_id']) && ($_SESSION['uid']==77)) {
		
				$login_id=$_REQUEST['login_id'];
				$login_name=trim($_REQUEST['login_name']);
				$login_password=trim($_REQUEST['login_password']);
				$login_type=$_REQUEST['login_type'];		
				$user_name=$_REQUEST['user_name'];		
				$email=$_REQUEST['email'];		

				
				$con=get_connection();	
				$sql="Update txt_login set login_name='$login_name',
					login_password='$login_password',
					 login_type='$login_type' ,
					 user_name='$user_name' ,
					email='$email'	where login_id='$login_id'";
					
	//		echo $sql;	
			$result=mysqli_query($con,$sql);	

				if(mysqli_errno($con)==0) { 
					$_SESSION['msg']="<div class='success-message'>User : $login_id Successfully Updated</div>";
				} else {
					$msg=getSqlMessage(mysqli_errno($con),"User ");
					$_SESSION['msg']="<div class='error-message'>$msg</div>";
				}

				$_SESSION['uid']=11;
				release_connection($con);
				
		}

}	


function deleteUser() {

		// get data 
		if($_REQUEST['login_id']) {
			$login_id=$_REQUEST['login_id'];
			$con=get_connection();
			$sql="delete from txt_login where login_id='$login_id'";
//			echo $sql;
			$result=mysqli_query($con,$sql);	

				if(mysqli_errno($con)==0) { 
					$_SESSION['msg']="<div class='success-message'>User : $login_id Successfully Deleted</div>";
				} else {
					$msg=getSqlMessage(mysqli_errno($con),"User ");
					$_SESSION['msg']="<div class='success-message'>$msg</div>";
				}
				release_connection($con);
		}
}
	
?> 
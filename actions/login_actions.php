<?php
include "../includes/database.php";
 
$uemail=$_REQUEST["userEmail"];
$register_sql=mysqli_query($conn,"select * from  tbl_users where userEmail='".$uemail."'");
$numrows=mysqli_num_rows($register_sql);
if($numrows>0){
	$userPassword=$_POST["userPassword"];
	$hashing = md5($userPassword);
	$userLogin=mysqli_query($conn,"select * from  tbl_users where userEmail='".$uemail."' and userPassword='".$hashing."'");
	$loginchecked=mysqli_num_rows($userLogin);
	if($loginchecked>0){
		session_start();
		$_SESSION['email'] = $uemail;
		// alert($_SESSION['email']);
		echo 1;
	}	
}
else
{ 
   echo 0;
}				
	
?>
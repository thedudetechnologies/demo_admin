<?php
include "../includes/database.php";
 
$uemail=$_REQUEST["userEmail"];
$register_sql=mysqli_query($conn,"select * from  tbl_users where userEmail='".$uemail."'");
$numrows=mysqli_num_rows($register_sql);
if($numrows>0){
	echo 0;
}
else
{
		$firstName=$_POST["firstName"];
		$lastName=$_POST["lastName"];
		$userEmail=$_POST["userEmail"];
		$city_id = $_POST["city_id"];
		$userPassword=$_POST["userPassword"];
		$hashing = md5($userPassword);
		$sql = "insert into tbl_users (city_id, firstName, lastName, userEmail, userPassword, status) VALUES ($city_id,'$firstName', '$lastName', '$userEmail', '$hashing', 1)";
		$insertq=mysqli_query($conn, $sql);
  
   echo 1;
}				
	
?>
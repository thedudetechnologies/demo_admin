<?php
	include '../includes/database.php';
	$userEmail=$_POST["userEmail"];
	$userEmail;
	$sqle= "SELECT * FROM tbl_users where userEmail= '$userEmail'";
	$email = mysqli_query($conn, $sqle);

	if(mysqli_num_rows($email) > 0 ){
		if(isset($_POST['login'])){
			echo 'true'
		}
		
		echo 'false';
	}
	else{
		echo 'true';
	}

?>

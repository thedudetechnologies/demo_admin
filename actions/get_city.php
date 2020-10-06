<?php
	include '../includes/database.php';
	$state_id=$_POST["state_id"];
	$city = mysqli_query($conn,"SELECT * FROM tbl_cities where state_id=$state_id");
?>
<option value="" disabled selected>Choose your State</option>
<?php
while($row = mysqli_fetch_array($city)) {
?>
	<option value="<?php echo $row["id"];?>"><?php echo $row["name"];?></option>
<?php
}
?>
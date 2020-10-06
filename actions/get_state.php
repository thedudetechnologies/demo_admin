<?php
	include '../includes/database.php';
	$country_id=$_POST["country_id"];
	$state = mysqli_query($conn,"SELECT * FROM tbl_states where country_id=$country_id");
?>
<option value="" disabled selected>Choose your State</option>
<?php
while($row = mysqli_fetch_array($state)) {
?>
	<option value="<?php echo $row["id"];?>"><?php echo $row["name"];?></option>
<?php
}
?>
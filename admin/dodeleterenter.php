<?php
include("config.php");
$pid = $_POST['id'];

$sql = "DELETE FROM renter WHERE id = {$pid}";
$result = mysqli_query($con, $sql);
$sql = "DELETE FROM allocation WHERE renterid = {$pid}";
$result = mysqli_query($con, $sql);
if($result == true)
{
	// $msg="<p class='alert alert-success'>Property Deleted</p>";
	// header("Location:propertyview.php?msg=$msg");
	echo "ok";
}
else{
	// $msg="<p class='alert alert-warning'>Property Not Deleted</p>";
	// header("Location:propertyview.php?msg=$msg");
	echo "not ok";
}
mysqli_close($con);
?>
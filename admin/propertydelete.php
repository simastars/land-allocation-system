<?php
include("config.php");
$pid = $_POST['id'];

$sql = "DELETE FROM allocation WHERE propertyid = {$pid}";
$result = mysqli_query($con, $sql);
$sql = "DELETE FROM property WHERE pid = {$pid}";
$result = mysqli_query($con, $sql);
if($result == true)
{
	$msg="<p class='alert alert-success'>Property Deleted</p>";
	// header("Location:propertyview.php?msg=$msg");
	echo $msg;
}
else{
	$msg="<p class='alert alert-warning'>Property Not Deleted</p>";
	// header("Location:propertyview.php?msg=$msg");
	echo $msg;
}
mysqli_close($con);
?>
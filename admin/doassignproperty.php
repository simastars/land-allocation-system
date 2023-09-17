<?php
require_once("config.php");
sleep(2);
$msg = "";
$sql="";
if (isset($_POST['userid'])) {

	$userid = $_POST['userid'];
	$propid = $_POST['propid'];

	$sql = "SELECT * FROM allocation WHERE renterid='' AND property";


	$yearsToAdd = $_POST['duration'];
	$currentDate = date('Y-m-d');
	if($yearsToAdd =="0"){
		// echo "00";
		$sql = "INSERT INTO allocation VALUES(null,'$userid','$propid','$currentDate', 'Permanant')";
	}else{
	// Calculate the new date
		$newDate = date('Y-m-d', strtotime("+$yearsToAdd years", strtotime($currentDate)));
		$sql = "INSERT INTO allocation VALUES(null,'$userid','$propid','$currentDate', '$newDate')";
	}
	
	$result = $con->query($sql);
	if ($result) {
		$msg = "Property has been assigned Successfully!";
	} else {
		$msg = $con->error;
		// $error="<p class='alert alert-warning'>Something went wrong. Please try again</p>";
	}
	echo $msg;
}


?>
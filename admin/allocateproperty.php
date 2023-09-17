<?php
session_start();
require("config.php");
////code
function getStates($con, $table)
{
	$sql = "SELECT * FROM $table";
	$label = "";
	if ($table == "state") {
		$label = "sname";
	} else {
		$label = "cname";
	}
	$query = $con->query($sql);
	$states = "";
	if ($query) {
		if ($query->num_rows > 0) {
			// $row = ;
			while ($row = $query->fetch_assoc()) {
				$states .= "<option value='" . $row[$label] . "'>" . $row[$label] . "</option>";
			}
		} else {
			$states .= "<option value=''>No Entries Added</option>";
		}
	} else {
		echo $con->error;
	}
	echo $states;
}
if (!isset($_SESSION['auser'])) {
	header("location:index.php");
}

//// code insert
//// add code
$error = "";
$msg = "";
if (isset($_POST['add'])) {

	$title = $_POST['title'];
	$desc = $_POST['desc'];
	$ptype = $_POST['ptype'];
	$bhk = $_POST['bhk'];
	$bed = $_POST['bed'];

	$stype = $_POST['stype'];

	$price = $_POST['price'];
	$city = $_POST['city'];
	$asize = $_POST['asize'];
	$loc = $_POST['loc'];
	$state = $_POST['state'];



	$aimage = $_FILES['aimage']['name'];
	$aimage1 = $_FILES['aimage1']['name'];
	$aimage2 = $_FILES['aimage2']['name'];
	$aimage3 = $_FILES['aimage3']['name'];
	$aimage4 = $_FILES['aimage4']['name'];


	$isFeatured = $_POST['isFeatured'];

	$temp_name  = $_FILES['aimage']['tmp_name'];
	$temp_name1 = $_FILES['aimage1']['tmp_name'];
	$temp_name2 = $_FILES['aimage2']['tmp_name'];
	$temp_name3 = $_FILES['aimage3']['tmp_name'];
	$temp_name4 = $_FILES['aimage4']['tmp_name'];


	move_uploaded_file($temp_name, "property/$aimage");
	move_uploaded_file($temp_name1, "property/$aimage1");
	move_uploaded_file($temp_name2, "property/$aimage2");
	move_uploaded_file($temp_name3, "property/$aimage3");
	move_uploaded_file($temp_name4, "property/$aimage4");


	$sql = "INSERT INTO property (title,pcontent,type,bhk,stype,bedroom,bathroom,balcony,kitchen,hall,floor,size,price,location,city,state,feature,pimage,pimage1,pimage2,pimage3,pimage4,uid,status,mapimage,topmapimage,groundmapimage,totalfloor,isFeatured)
	VALUES('$title','$desc','$ptype','$bhk','$stype','$bed','0','0','0','0','0','$asize','$price',
	'$loc','$city','$state',' ','$aimage','$aimage1','$aimage2','$aimage3','0','0','$status','0','0','0','0','$isFeatured')";
	$result = $con->query($sql);
	if ($result) {
		$msg = "<p class='alert alert-success'>Property Inserted Successfully</p>";
	} else {
		$error = $con->error;
		// $error="<p class='alert alert-warning'>Something went wrong. Please try again</p>";
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<title>LM HOMES | Property</title>

	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">

	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">

	<!-- Feathericon CSS -->
	<link rel="stylesheet" href="assets/css/feathericon.min.css">

	<!-- Main CSS -->
	<link rel="stylesheet" href="assets/css/style.css">

	<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
</head>

<body>


	<!-- Header -->
	<?php include("header.php"); ?>
	<!-- /Sidebar -->

	<!-- Page Wrapper -->
	<div class="page-wrapper">
		<div class="content container-fluid">

			<!-- Page Header -->
			<div class="page-header">
				<div class="row">
					<div class="col">
						<h3 class="page-title">Allocation</h3>
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
							<li class="breadcrumb-item active">Renter</li>
						</ul>
					</div>
				</div>
			</div>
			<!-- /Page Header -->

			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<h4 class="card-title">Allocate Property</h4>
						</div>
						<form method="post" enctype="multipart/form-data">
							<div class="card-body">
								<h5 class="card-title">Allocate</h5>
								<?php echo $error; ?>
								<?php echo $msg; ?>

								<div class="row">
									<div class="col-xl-12">
										<div class="form-group row">
											<label class="col-lg-2 col-form-label">Renter Email/Phone</label>
											<div class="col-lg-9">
												<input type="text" class="form-control email" name="title" required placeholder="Enter Email or Phone Number">
											</div>
										</div>
										<div class="form-group row">
											<table id="datatable-button" class="table table-striped dt-responsive nowrap">
												<thead class="result">

												</thead>


												<tbody>

												</tbody>
											</table>


										</div>

									</div>
								</div>

								<hr>
							</div>
						</form>
					</div>
				</div>
			</div>

		</div>
	</div>
	<!-- /Main Wrapper -->


	<!-- jQuery -->
	<script src="assets/js/jquery-3.2.1.min.js"></script>
	<script src="assets/plugins/tinymce/tinymce.min.js"></script>
	<script src="assets/plugins/tinymce/init-tinymce.min.js"></script>
	<!-- Bootstrap Core JS -->
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>

	<!-- Slimscroll JS -->
	<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

	<!-- Custom JS -->
	<script src="assets/js/script.js"></script>

</body>

</html>
<script>
	$(document).ready(function() {
		$(".email").keyup(function() {
			let id = $(this).val();
			$.ajax({
				url: "fetchrenter.php",
				method: "POST",
				type: "text",
				data: {
					userid: id
				},
				beforeSend: function() {
					$(".result").html("<span class='text-success'>Loading..</span>");
				},
				success: function(data) {
					console.log(data)
					$(".result").html(data);
				}
			})
		})

	})
</script>
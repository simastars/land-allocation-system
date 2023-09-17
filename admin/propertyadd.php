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
						<h3 class="page-title">Property</h3>
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
							<li class="breadcrumb-item active">Property</li>
						</ul>
					</div>
				</div>
			</div>
			<!-- /Page Header -->

			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<h4 class="card-title">Add Property Details</h4>
						</div>
						<form method="post" enctype="multipart/form-data">
							<div class="card-body">
								<h5 class="card-title">Property Detail</h5>
								<?php echo $error; ?>
								<?php echo $msg; ?>

								<div class="row">
									<div class="col-xl-12">
										<div class="form-group row">
											<label class="col-lg-2 col-form-label">Title</label>
											<div class="col-lg-9">
												<input type="text" class="form-control" name="title" required placeholder="Enter Title">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-lg-2 col-form-label">Description</label>
											<div class="col-lg-9">
												<textarea class="tinymce form-control" name="desc" rows="10" cols="30"></textarea>
											</div>
										</div>

									</div>
									<div class="col-xl-6">
										<div class="form-group row">
											<label class="col-lg-3 col-form-label">Property Type</label>
											<div class="col-lg-9">
												<select class="form-control" required name="ptype">
													<option value="">Select Type</option>
													<option value="apartment">Apartment</option>
													<option value="flat">Flat</option>
													<option value="building">Building</option>
													<option value="house">House</option>
													<option value="shop">Shop</option>
													<option value="office">Office</option>
													<option value="plaza">Plaza</option>
												</select>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-lg-3 col-form-label">Selling Type</label>
											<div class="col-lg-9">
												<select class="form-control" required name="stype">
													<option value="">Select Status</option>
													<option value="allocation">Allocation</option>
													<option value="rent">Rent</option>
													<option value="sale">Sale</option>
												</select>
											</div>
										</div>
									</div>
									<div class="col-xl-6">
										<div class="form-group row mb-3">
											<label class="col-lg-3 col-form-label">BHK</label>
											<div class="col-lg-9">
												<select class="form-control" required name="bhk">
													<option value="">Select BHK</option>
													<option value="1 BHK">1 BHK</option>
													<option value="2 BHK">2 BHK</option>
													<option value="3 BHK">3 BHK</option>
													<option value="4 BHK">4 BHK</option>
													<option value="5 BHK">5 BHK</option>
													<option value="1,2 BHK">1,2 BHK</option>
													<option value="2,3 BHK">2,3 BHK</option>
													<option value="2,3,4 BHK">2,3,4 BHK</option>
												</select>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-lg-3 col-form-label">Bedroom</label>
											<div class="col-lg-9">
												<input type="text" class="form-control" name="bed" required placeholder="Enter Bedroom  (only no 1 to 10)">
											</div>
										</div>


									</div>
								</div>
								<h4 class="card-title">Price & Location</h4>
								<div class="row">
									<div class="col-xl-6">
										<div class="form-group row">
											<label class="col-lg-3 col-form-label">Price</label>
											<div class="col-lg-9">
												<input type="text" class="form-control" name="price" required placeholder="Enter Price">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-lg-3 col-form-label">City</label>
											<div class="col-lg-9">
												<select class="form-control" required name="city">
													<?php getStates($con, "city") ?>
												</select>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-lg-3 col-form-label">State</label>
											<div class="col-lg-9">
												<select class="form-control" required name="state">
													<?php getStates($con, "state") ?>
												</select>
											</div>
										</div>
									</div>
									<div class="col-xl-6">
										<div class="form-group row">
											<label class="col-lg-3 col-form-label">Area Size</label>
											<div class="col-lg-9">
												<input type="text" class="form-control" name="asize" required placeholder="Enter Area Size (in sqrt)">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-lg-3 col-form-label">Address</label>
											<div class="col-lg-9">
												<input type="text" class="form-control" name="loc" required placeholder="Enter Address">
											</div>
										</div>

									</div>
								</div>

								<div class="form-group row">
									<label class="col-lg-2 col-form-label">Feature</label>
									<div class="col-lg-9">
										<p class="alert alert-danger">* Important Please Do Not Remove Below Content Only Change <b>Yes</b> Or <b>No</b> or Details and Do Not Add More Details</p>

										<textarea class="tinymce form-control" name="feature" rows="10" cols="30">
												<!---feature area start--->
												<div class="col-md-4">
														<ul>
														<li class="mb-3"><span class="text-secondary font-weight-bold">Property Age : </span>10 Years</li>
														<li class="mb-3"><span class="text-secondary font-weight-bold">Swiming Pool : </span>Yes</li>
														<li class="mb-3"><span class="text-secondary font-weight-bold">Parking : </span>Yes</li>
														<li class="mb-3"><span class="text-secondary font-weight-bold">GYM : </span>Yes</li>
														</ul>
													</div>
													<div class="col-md-4">
														<ul>
														<li class="mb-3"><span class="text-secondary font-weight-bold">Type : </span>Apartment</li>
														<li class="mb-3"><span class="text-secondary font-weight-bold">Security : </span>Yes</li>
														<li class="mb-3"><span class="text-secondary font-weight-bold">Dining Capacity : </span>10 People</li>
														<li class="mb-3"><span class="text-secondary font-weight-bold">Church/Temple  : </span>No</li>
														
														</ul>
													</div>
													<div class="col-md-4">
														<ul>
														<li class="mb-3"><span class="text-secondary font-weight-bold">3rd Party : </span>No</li>
														<li class="mb-3"><span class="text-secondary font-weight-bold">Alivator : </span>Yes</li>
														<li class="mb-3"><span class="text-secondary font-weight-bold">CCTV : </span>Yes</li>
														<li class="mb-3"><span class="text-secondary font-weight-bold">Water Supply : </span>Ground Water / Tank</li>
														</ul>
													</div>
												<!---feature area end---->
											</textarea>
									</div>
								</div>

								<h4 class="card-title">Image & Status</h4>
								<div class="row">
									<div class="col-xl-6">

										<div class="form-group row">
											<label class="col-lg-3 col-form-label">Image</label>
											<div class="col-lg-9">
												<input class="form-control" name="aimage" type="file" required="">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-lg-3 col-form-label">Image 2</label>
											<div class="col-lg-9">
												<input class="form-control" name="aimage2" type="file" required="">
											</div>
										</div>

									</div>
									<div class="col-xl-6">

										<div class="form-group row">
											<label class="col-lg-3 col-form-label">Image 1</label>
											<div class="col-lg-9">
												<input class="form-control" name="aimage1" type="file" required="">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-lg-3 col-form-label">image 3</label>
											<div class="col-lg-9">
												<input class="form-control" name="aimage3" type="file" required="">
											</div>
										</div>
									</div>
								</div>

								<hr>

								<div class="row">
									<div class="col-md-6">
										<div class="form-group row">
											<label class="col-lg-3 col-form-label"><b>Is Featured?</b></label>
											<div class="col-lg-9">
												<select class="form-control" required name="isFeatured">
													<option value="">Select...</option>
													<option value="0">No</option>
													<option value="1">Yes</option>
												</select>
											</div>
										</div>
									</div>
								</div>


								<input type="submit" value="Submit" class="btn btn-primary" name="add" style="margin-left:200px;">

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
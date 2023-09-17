<?php
session_start();
require("config.php");
////code
function getStates($con, $table){
$sql = "SELECT * FROM $table"; 
$label="";
if($table=="state"){
	$label = "sname";
}else{
	$label = "cname";
}
$query=$con->query($sql);
$states="";
if($query){
	if($query->num_rows>0){
		// $row = ;
		while($row = $query->fetch_assoc()){
			$states .="<option value='".$row[$label]."'>".$row[$label]."</option>";
		}
	}else{
		$states .="<option value=''>No Entries Added</option>";
	}
}else{
	echo $con->error;
}
echo $states;
}
if(!isset($_SESSION['auser']))
{
	header("location:index.php");
}

//// code insert
//// add code
$error="";
$msg="";
if(isset($_POST['add']))
{
	
	$title=$_POST['title'];
	$fname=$_POST['fname'];
	$oname=$_POST['oname'];
	$email=$_POST['email'];
	$dob=$_POST['dob'];
	$phone=$_POST['phone'];

	$city=$_POST['city'];

	$state=$_POST['state'];
	$gender=$_POST['gender'];
	$address=$_POST['address'];



	
	$aimage=$_FILES['aimage']['name'];



	$isFeatured=$_POST['category'];
	
	$temp_name  =$_FILES['aimage']['tmp_name'];

	

	move_uploaded_file($temp_name,"user/$aimage");


	$sql="INSERT INTO renter VALUES(null, '$title','$fname','$oname','$email','$phone','$dob','$gender','$state','$city','$address','$aimage')";
	$result=$con->query($sql);
	if($result)
		{
			$msg="<p class='alert alert-success'>Details Inserted Successfully</p>";
					
		}
		else
		{
			$error= $con->error;
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
									<h4 class="card-title">Add Person Details</h4>
								</div>
								<form method="post" enctype="multipart/form-data">
								<div class="card-body">
									<h5 class="card-title">Personal Detail</h5>
									<?php echo $error; ?>
									<?php echo $msg; ?>
									
										<div class="row">
											<div class="col-xl-12">
												<div class="form-group row">
													<label class="col-lg-2 col-form-label">Title</label>
													<div class="col-lg-10">
														<select class="form-control" required name="title">
															<option value="">Select Title</option>
															<option value="Mr">Mr</option>
															<option value="Mrs">Mrs.</option>
															<option value="Miss">Miss</option>
															<option value="Mal.">Mal.</option>
                                                            <option value="Alh.">Alh.</option>
                                                            <option value="Dr.">Dr.</option>
                                                            <option value="Prof.">Prof.</option>
														</select>
													</div>
												</div>
											</div>   
									
										</div>
										
										<div class="row">
											<div class="col-xl-6">
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">First Name</label>
													<div class="col-lg-9">
														<input type="text" class="form-control" name="fname" required placeholder="Enter First Name">
													</div>
												</div>
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Email</label>
													<div class="col-lg-9">
														<input type="text" class="form-control" name="email" required placeholder="Enter Email">
													</div>
												</div>
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Date of Birth</label>
													<div class="col-lg-9">
														<input type="date" class="form-control" name="dob" required placeholder="01-01-1998">
													</div>
												</div>
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">City</label>
													<div class="col-lg-9">
														<select class="form-control" required name="city">
															<?php getStates($con, "city")?>
														</select>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">State</label>
													<div class="col-lg-9">
														<select class="form-control" required name="state">
															<?php getStates($con, "state")?>
														</select>
													</div>
												</div>
											</div>
											<div class="col-xl-6">
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Other Name(s)</label>
													<div class="col-lg-9">
														<input type="text" class="form-control" name="oname" required placeholder="Other Name(s)">
													</div>
												</div>
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Phone Number</label>
													<div class="col-lg-9">
														<input type="tel" class="form-control" name="phone" required placeholder="Enter Phone Number">
													</div>
												</div>
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Gender</label>
													<div class="col-lg-9">
														<select class="form-control" name="gender"> 
															<option value="">Select</option>
															<option value="male">Male</option>
															<option value="female">Female</option>
														</select>	
													</div>
												</div>
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Address</label>
													<div class="col-lg-9">
														<input type="text" class="form-control" name="address" required placeholder="Enter Address">
													</div>
												</div>
												
											</div>
										</div>
										
										<h4 class="card-title">Image</h4>
										<div class="row">
											<div class="col-xl-6">
												
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Image</label>
													<div class="col-lg-9">
														<input class="form-control" name="aimage" type="file" required="">
													</div>
												</div>
											</div>
										</div>

										<hr>

										<div class="row">
											<div class="col-md-6">
												<div class="form-group row">
													<label class="col-lg-3 col-form-label"><b>Purpose?</b></label>
													<div class="col-lg-9">
														<select class="form-control"  required name="isFeatured">
															<option value="">Select...</option>
															<option value="buyer">Buyer</option>
															<option value="renter">Renter</option>
															<option value="both">Both</option>
														</select>
													</div>
												</div>
											</div>
										</div>

										
											<input type="submit" value="Submit" class="btn btn-primary"name="add" style="margin-left:200px;">
										
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
		<script  src="assets/js/script.js"></script>
		
    </body>

</html>
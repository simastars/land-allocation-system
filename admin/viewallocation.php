<?php
require_once("config.php");
$userid = $_GET['user'];

// echo $propid;
// $row = array();
$output = "";
$sql = "SELECT * FROM allocation a INNER JOIN property p ON a.propertyid=p.pid INNER JOIN renter r ON a.renterid=r.id ORDER BY a.sn DESC LIMIT 10";
$query = $con->query($sql);

// Define two date strings
$date1 = "2023-09-16";
$date2 = "2023-12-31";



// Output the results

if ($query) {
    while ($row = $query->fetch_assoc()) {
        $timeleft = "";
        // Create DateTime objects from the date strings
        if ($row['duration'] == "Permanant") {
            $timeleft = "Permanant";
        } else {
            $datetime1 = new DateTime($row['dategiven']);
            $datetime2 = new DateTime($row['duration']);

            // Calculate the difference
            $interval = $datetime1->diff($datetime2);

            // Get the difference in days, months, and years
            $days = $interval->days;
            $months = $interval->m;
            $years = $interval->y;
            $timeleft =  $years . " Year(s) " . $months . " Month(s) " . $days . " Days";
        }

        $output .= '<section class="h-100 gradient-custom-2">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-lg-9 col-xl-7">
              <div class="card">
                <div class="rounded-top text-white d-flex flex-row" style="background-color: #000; height:200px;">
                  <div class="ms-4 mt-5 d-flex flex-column" style="width: 150px;">
                    <img src="./user/' . $row['image'] . '"
                      alt="Generic placeholder image" class="img-fluid img-thumbnail mt-4 mb-2"
                      style="width: 150px; z-index: 1">
                    
                  </div>
                  <div class="ms-3" style="margin-top: 130px;">
                    <h5>' . ucfirst($row['rentertitle']) . " " . ucfirst($row['fname']) . " " . ucfirst($row['oname']) . '</h5>
                    <p>' . ucfirst($row['renterstate']) . ", " . ucfirst($row['rentercity']) . '</p>
                  </div>
                </div>
                <div class="p-4 text-black" style="background-color: #f8f9fa;">
                  <div class="d-flex justify-content-end text-center py-1">
                    <div>
                      <p class="mb-1 h5">' . $row['email'] . '</p>
                      <p class="small text-muted mb-0">Email</p>
                    </div>
                    <div class="px-3">
                      <p class="mb-1 h5">' . $row['phone'] . '</p>
                      <p class="small text-muted mb-0">Phone</p>
                    </div>
                    <div>
                      <p class="mb-1 h5">' . $row['dob'] . '</p>
                      <p class="small text-muted mb-0">DOB</p>
                    </div>
                  </div>
                </div>
                <div class="p-4 text-black" style="background-color: #f8f9fa;">
                  <div class="d-flex justify-content-end text-center py-1">
                    <div>
                      <p class="mb-1 h5">' . $row['dategiven'] . '</p>
                      <p class="small text-muted mb-0">Date Given</p>
                    </div>
                    <div class="px-3">
                      <p class="mb-1 h5">' . $timeleft . '</p>
                      <p class="small text-muted mb-0">Period Left</p>
                    </div>
                    <div>
                      <p class="mb-1 h5">' . $row['stype'] . '</p>
                      <p class="small text-muted mb-0">Rent Type</p>
                    </div>
                  </div>
                </div>
                <div class="card-body p-4 text-black">
                  <div class="mb-5">
                    <p class="lead fw-normal mb-1">Property Details</p>
                    <div class="p-4" style="background-color: #f8f9fa;">
                      <p class="font-italic mb-1"><h4>Property Name:</h4>' . ucfirst($row['title']) . '</p>
                      <p class="font-italic mb-1"><h4>Property Type: </h4>' . ucfirst($row['type']) . '</p>
                      <p class="font-italic mb-0"><h4>Property Description:</h4>' . ucfirst($row['pcontent']) . '</p>
                      <p class="font-italic mb-0"><h4>Location, City and State:</h4>' . ucfirst($row['location']) . ", " . ucfirst($row['city']) . " " . ucfirst($row['state']) . '</p>
                    </div>
                  </div>
                  <div class="d-flex justify-content-between align-items-center mb-4">
                    <p class="lead fw-normal mb-0">Property Images</p>
                    <p class="mb-0"><a href="#!" class="text-muted">Show all</a></p>
                  </div>
                  <div class="row g-2">
                    <div class="col mb-2">
                      <img src="./property/' . $row['pimage'] . '"
                        alt="image 1" class="w-100 rounded-3">
                    </div>
                    <div class="col mb-2">
                      <img src="./property/' . $row['pimage1'] . '"
                        alt="image 1" class="w-100 rounded-3">
                    </div>
                  </div>
                  <div class="row g-2">
                    <div class="col">
                      <img src="./property/' . $row['pimage2'] . '"
                        alt="image 1" class="w-100 rounded-3">
                    </div>
                    <div class="col">
                      <img src="./property/' . $row['pimage3'] . '"
                        alt="image 1" class="w-100 rounded-3">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>';
    }
} else {
    $output = "error";
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Ventura - Data Tables</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">

    <!-- Feathericon CSS -->
    <link rel="stylesheet" href="assets/css/feathericon.min.css">

    <!-- Datatables CSS -->
    <link rel="stylesheet" href="assets/plugins/datatables/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/plugins/datatables/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/plugins/datatables/select.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/plugins/datatables/buttons.bootstrap4.min.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .gradient-custom-2 {
            /* fallback for old browsers */
            background: #fbc2eb;

            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(to right, rgba(251, 194, 235, 1), rgba(166, 193, 238, 1));

            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: linear-gradient(to right, rgba(251, 194, 235, 1), rgba(166, 193, 238, 1))
        }

        h4 {
            display: inline;
        }
    </style>
    <!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
</head>

<body>

    <!-- Main Wrapper -->


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
                        <h3 class="page-title">Property Details</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Property Details</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <?php
            echo $output;
            ?>
            <!-- end row-->

        </div>
    </div>
    <!-- /Main Wrapper -->


    <!-- jQuery -->
    <script src="assets/js/jquery-3.2.1.min.js"></script>

    <!-- Bootstrap Core JS -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Slimscroll JS -->
    <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Datatables JS -->
    <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="assets/plugins/datatables/dataTables.responsive.min.js"></script>
    <script src="assets/plugins/datatables/responsive.bootstrap4.min.js"></script>

    <script src="assets/plugins/datatables/dataTables.select.min.js"></script>

    <script src="assets/plugins/datatables/dataTables.buttons.min.js"></script>
    <script src="assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
    <script src="assets/plugins/datatables/buttons.html5.min.js"></script>
    <script src="assets/plugins/datatables/buttons.flash.min.js"></script>
    <script src="assets/plugins/datatables/buttons.print.min.js"></script>

    <!-- Custom JS -->
    <script src="assets/js/script.js"></script>

</body>

</html>
<script>
    $(document).ready(function(e) {
        $(document).on("click", ".assign-this", function() {

        })
    })
</script>
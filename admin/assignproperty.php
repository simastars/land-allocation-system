<?php
require_once("config.php");
$userid = $_GET['user'];

// echo $propid;
// $row = array();
$output = "";
$sql = "SELECT * FROM property ORDER BY pid DESC LIMIT 10";
$query = $con->query($sql);
if ($query) {
    while ($row = $query->fetch_assoc()) {
        $output .= '<div class="cards">
<div class="image-grid-container">
    <img src="' . "./property/" . $row['pimage'] . '">
    <img src="' . "./property/" . $row['pimage1'] . '">
    <img src="' . "./property/" . $row['pimage2'] . '">
    <img src="' . "./property/" . $row['pimage3'] . '">
</div>
  
<div class="card-body">
    <h4 class="card-title">' . strtoupper($row['title'])
            . '</h4>
      
    <div class="d-flex justify-content-start rounded-3 p-3 mb-1"
                                style="background-color: #efefef;">
                                <div>
                                  <p class="small text-muted mb-1">Type</p>
                                  <p class="mb-0">' . ucfirst($row['type']) . '</p>
                                </div>
                                <div class="px-3">
                                  <p class="small text-muted mb-1">Selling Type</p>
                                  <p class="mb-0">' . ucfirst($row['stype']) . '</p>
                                </div>
                                <div>
                                  <p class="small text-muted mb-1">Price</p>
                                  <p class="mb-0">' . number_format($row['price'], 2) . '</p>
                                </div>
                              </div>
                              <div class="d-flex justify-content-start rounded-3 p-3 mb-1"
                                style="background-color: #efefef;">
                                <div>
                                  <p class="small text-muted mb-1">Location</p>
                                  <p class="mb-0">' . ucfirst($row['location']) . '</p>
                                </div>
                                <div class="px-3">
                                  <p class="small text-muted mb-1">City</p>
                                  <p class="mb-0">' . ucfirst($row['city']) . '</p>
                                </div>
                                <div>
                                  <p class="small text-muted mb-1">State</p>
                                  <p class="mb-0">' . ucfirst($row['state']) . '</p>
                                </div>
                              </div>
                              <div class="d-flex justify-content-start rounded-3 p-3 mb-1"
                                style="background-color: #efefef;">
                                <div>
                                  <p class="small text-muted mb-1">Description</p>
                                  <p class="mb-0">' . ucfirst($row['pcontent']) . '</p>
                                </div>
                               
                              </div>
                              <div class="d-flex justify-content-start rounded-3 p-3 mb-1"
                                style="background-color: #efefef;">
                                <div>
                                  <p class="small text-muted mb-1">Select Duration</p>
                                  <p class="mb-0">' . ucfirst($row['pcontent']) . '</p>
                                 
                                </div>
                                
                              </div>
                              <div class="d-flex justify-content-start  p-3 mb-1"
                                style="background-color: #efefef;">
                                <div class="form-group">
                                <label>Duration</label>
                                <input class="form-control duration" type="number" placeholder="Year(s) Or 0 for Permanant" title="Enter 0 for Permanant" min="0">
                                <span class="loading"></span>
                                </div>
                                </div>
                            <button type="submit" class="btn btn-success assign-this" data-user-id="' . $userid . '" data-prop-id="' . $row['pid'] . '">
                              Assign
                          </button>
    <a href="./propertydetails.php?id=' . $row['pid'] . '" class="btn btn-primary">
        View More Details
    </a>
</div>
</div>';
    }
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
        /* span {
            padding-left: 10px;
        } */
        .cards {
            width: 40rem;
            margin: 2rem;
        }

        .image-grid-container {
            display: grid;

            /* For 2 columns */
            grid-template-columns: auto auto;
        }

        img {
            width: 100%;
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




            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="header-title mt-0 mb-4">Choose Property to Assign</h4>
                            <?php
                            if (isset($_GET['msg']))
                                echo $_GET['msg'];
                            ?>
                            <table id="datatable-button" class="table table-striped dt-responsive nowrap">
                                <thead>

                                </thead>

                                <?php echo $output; ?>
                                <tbody>

                                </tbody>
                            </table>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
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
        $(document).on("click", ".assign-this", function(e) {
            e.preventDefault(); // Prevent the default form submission

            const userid = $(this).attr("data-user-id");
            const propid = $(this).attr("data-prop-id");
            const duration = $(this).closest('.cards').find('.duration').val();

            const loadingElement = $(this).closest('.cards').find('.loading');

            if (duration === "") {
                alert("Please enter a duration");
                return false; // Stop the AJAX request if duration is empty
            } else {
                // Update the relevant element to show the loading message
                loadingElement.html(`<div class="spinner-grow text-success" role="status">
  <span class="sr-only">Loading...</span>
</div>`);

                $.ajax({
                    url: "doassignproperty.php",
                    method: "POST",
                    data: {
                        userid: userid,
                        propid: propid,
                        duration: duration
                    },
                    success: function(data) {
                        loadingElement.html(`<h3 class="text-success"><i class="bi bi-check2-circle"></i>Success<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
  <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z"/>
  <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"/>
</svg></h3>`)
                        alert(data);
                    }
                });
            }
        });

    })
</script>
<?php
require_once("config.php");
$propid = $_GET['id'];

// echo $propid;
$output = "";
$row = array();
$sql = "SELECT * FROM property WHERE pid='$propid'";
$query = $con->query($sql);
if ($query) {
    while ($row = $query->fetch_assoc()) {
        $output .= '<tr><th>Title:<span>' . strtoupper($row['title']) . '</span></th>
<th>Type: <span>' . strtoupper($row['type']) . '</span></th>
<th>Sell Type: <span>' . strtoupper($row['stype']) . '</span></th>
<th>Description:
<td colspan="3">' . strtoupper($row['pcontent']) . '</td></th></tr>
<tr>
<th>Size: <span>' . $row['size'] . '</span></th>
<th>Price: <span>' . number_format($row['price'], 2) . '</span></th>
<th>Location: <span>' . strtoupper($row['location']) . '</span></th>
<th>City: <span>' . strtoupper($row['city']) . '</span></th>
<th>State: <span>' . strtoupper($row['state']) . '</span></th>
</tr>
<tr>
<th colspan="10">Picture 1:</th>
</tr>
<tr>
<th colspan="10"> <img src="' . "./property/" . $row['pimage'] . '" height="700px" width="80%" max-height="700px" style="background-size: cover;" /></th>
</tr>
<tr>
<th colspan="10">Picture 2:</th>
</tr>
<tr>
<th colspan="10"> <img src="' . "./property/" . $row['pimage1'] . '" height="700px" width="80%" max-height="700px" style="background-size: cover;" /></th>
</tr>
<tr>
<th colspan="10">Picture 3:</th>
</tr>
<tr>
<th colspan="10"> <img src="' . "./property/" . $row['pimage2'] . '" height="700px" width="80%" max-height="700px" style="background-size: cover;" /></th>
</tr>
<tr>
<th colspan="10">Picture 4:</th>
</tr>
<tr>
<th colspan="10"> <img src="' . "./property/" . $row['pimage3'] . '" height="700px" width="80%" max-height="700px" style="background-size: cover;" /></th>
</tr>';
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
        span {
            padding-left: 10px;
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

                            <h4 class="header-title mt-0 mb-4">Property View</h4>
                            <?php
                            if (isset($_GET['msg']))
                                echo $_GET['msg'];
                            ?>
                            <table id="datatable-button" class="table table-striped dt-responsive nowrap">
                                <thead>
                                    <?php echo $output;?>
                                </thead>
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
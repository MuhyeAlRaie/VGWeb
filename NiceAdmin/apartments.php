<?php
include('../classes/database.php');

session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to the login page
    header("Location: ../user.php");
    exit();
}

// Fetch project details
$projectQuery = "SELECT * FROM apartment";
$projectResult = $con->query($projectQuery);

// Initialize $features as an empty array
$Apartments = [];

// Check if query was successful
if ($projectResult) {
    // Fetch all rows as an associative array
    while ($row = $projectResult->fetch_assoc()) {
        $Apartments[] = $row;
    }
} else {
    // Error handling if query fails
    $error_message = "Error fetching features: " . $con->error;
}

$con->close();

$error_message = isset($_GET['error']) ? $_GET['error'] : '';
$success_message = isset($_GET['message']) ? $_GET['message'] : '';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Dashboard - NiceAdmin Bootstrap Template</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->


    <?php require_once(__DIR__."/includes/header.php"); ?>
    <?php require_once(__DIR__."/includes/sidebar.php"); ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Apartments</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Apartments</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <div class="w-100 d-flex flex-row-reverse mb-4 add-button-wrapper">
            <a href='add-apartment.php' class='btn btn-primary'>ADD</a>
        </div>

        <div class="card">
            <div class="card-body">
                <?php
        if (!empty($Apartments)) {
            echo "<h1>Listing Page</h1>";
            echo "<table class='table'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th scope='col'>#</th>";
            echo "<th scope='col'>Name</th>";
            echo "<th scope='col'>Price</th>";
            echo "<th scope='col'>surface</th>";
            echo "<th scope='col'>Availability</th>";
            echo "<th scope='col'>Bedroom</th>";
            echo "<th scope='col'>Bathroom</th>";
            echo "<th scope='col'>Edit</th>";
            echo "<th scope='col'>Delete</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            
            // Output each record as a table row with edit and delete buttons
            foreach ($Apartments as $index => $Apartment) {

                echo "<tr>";
                echo "<td>{$Apartment['ID']}</td>";
                echo "<td>{$Apartment['Name']}</td>";
                echo "<td>{$Apartment['price']}</td>";
                echo "<td>{$Apartment['surface']}</td>";
                // Use a conditional statement to print "Yes" or "No" based on availability
                if ($Apartment['availability'] == 1) {
                    echo "<td>Available </td>";
                } else {
                    echo "<td>Reserved</td>";
                }
                echo "<td>{$Apartment['bedroom']}</td>";
                echo "<td>{$Apartment['bathroom']}</td>";

                echo "<td><a href='apartment-edit.php?id={$Apartment['ID']}' class ='btn btn-primary'>Edit</a></td>";
                echo "<td><button type='button' class='btn btn-danger deleteBtn' data-bs-toggle='modal' data-bs-target='#deleteModal' data-feature-id='{$Apartment['ID']}'>Delete</button></td>";
                echo "</tr>";
            }
            
            echo "</tbody>";
            echo "</table>";
        } else {
            echo "No items found.";
        }
      ?>

                <?php if (!empty($error_message)): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error_message; ?>
                </div>
                <?php elseif (!empty($success_message)): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo $success_message; ?>
                </div>
                <?php endif; ?>

            </div>
        </div>

    </main><!-- End #main -->

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this item?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const deleteButtons = document.querySelectorAll(".deleteBtn");
        const confirmDeleteBtn = document.getElementById("confirmDeleteBtn");
        let deleteId = null;

        deleteButtons.forEach(button => {
            button.addEventListener("click", function() {
                deleteId = this.getAttribute("data-feature-id");
            });
        });

        confirmDeleteBtn.addEventListener("click", function() {
            if (deleteId) {
                window.location.href = `../classes/apartment/apartment-delete.php?id=${deleteId}`;
            }
        });
    });
    </script>



    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>
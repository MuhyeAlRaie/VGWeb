<?php
include('../classes/database.php');

session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to the login page
    header("Location: ../user.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $new_feature_name = mysqli_real_escape_string($con, $_POST['new_feature_name']);
    $new_link = mysqli_real_escape_string($con, $_POST['new_link']);

    // Construct the INSERT query to add a new feature
    $insert_query = "INSERT INTO features (Feature, Link) VALUES ('$new_feature_name', '$new_link')";

    // Execute the INSERT query
    if(mysqli_query($con, $insert_query)) {
        // If insertion is successful, redirect back to the listing page with success message
        header("Location: features.php?message=Feature added successfully");
        exit();
    } else {
        // If insertion fails, display error message
        $error_message = "Failed to add feature: " . mysqli_error($con);
    }
}
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

    <?php require_once(__DIR__."/includes/header.php"); ?>
    <?php require_once(__DIR__."/includes/sidebar.php"); ?>


    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Basic info</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Basic info</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <div class="card">
            <div class="card-body">

                <?php if (!empty($error_message)): ?>
                <div><?php echo $error_message; ?></div>
                <?php endif; ?>

                <form class="row g-3" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="col-12">
                        <label for="new_feature_name" class="form-label">Title</label>
                        <input type="text" class="form-control" id="new_feature_name" name="new_feature_name"
                            value="<?php if(isset($_POST['new_feature_name'])) echo htmlspecialchars($_POST['new_feature_name']); ?>">
                    </div>
                    <div class="col-12">
                        <label for="new_link" class="form-label">Link</label>
                        <input type="text" class="form-control" id="new_link" name="new_link"
                            value="<?php if(isset($_POST['new_link'])) echo htmlspecialchars($_POST['new_link']); ?>">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Add Feature</button>
                    </div>
                </form>
                
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
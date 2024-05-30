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
$projectQuery = "SELECT * FROM basic_info ORDER BY ID DESC LIMIT 1";


$projectResult = $con->query($projectQuery);
$basic_info = $projectResult->fetch_assoc();
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
                <!-- Vertical Form -->
                <form class="row g-3" method="post" action="forms/Basic-info-handler.php" novalidate>
                    <div class="col-12">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" id="title"
                            value="<?php echo $basic_info['Title']; ?>">
                    </div>
                    <div class="col-12">
                        <label for="description" class="form-label">description</label>
                        <textarea class="form-control" name="description" id="description" style="height: 100px"
                            value="<?php echo $basic_info['Description']; ?>"
                            required> <?php echo $basic_info['Description']; ?></textarea>

                    </div>
                    <div class="col-6">
                        <label for="Statistic_title_1" class="form-label">Statistic title 1</label>
                        <input type="text" name="Statistic_title_1" class="form-control" id="Statistic_title_1"
                            value="<?php echo $basic_info['statistic_title_1']; ?>" required>
                    </div>
                    <div class="col-6">
                        <label for="Statistic_value_1" class="form-label">Statistic value 1</label>
                        <input type="text" name="Statistic_value_1" class="form-control" id="Statistic_value_1"
                            value="<?php echo $basic_info['statistic_value_1']; ?>" required>
                    </div>
                    <div class="col-6">
                        <label for="Statistic_title_2" class="form-label">Statistic title 2</label>
                        <input type="text" name="Statistic_title_2" class="form-control" id="Statistic_title_2"
                            value="<?php echo $basic_info['statistic_title_2']; ?>" required>
                    </div>
                    <div class="col-6">
                        <label for="Statistic_value_2" class="form-label">Statistic value 2</label>
                        <input type="text" name="Statistic_value_2" class="form-control" id="Statistic_value_2"
                            value="<?php echo $basic_info['statistic_value_2']; ?>" required>
                    </div>
                    <div class="col-6">
                        <label for="Statistic_title_3" class="form-label">Statistic title 3</label>
                        <input type="text" name="Statistic_title_3" class="form-control" id="Statistic_title_3"
                            value="<?php echo $basic_info['statistic_title_3']; ?>" required>
                    </div>
                    <div class="col-6">
                        <label for="Statistic_value_3" class="form-label">Statistic value 3</label>
                        <input type="text" name="Statistic_value_3" class="form-control" id="Statistic_value_3"
                            value="<?php echo $basic_info['statistic_value_3']; ?>" required>
                    </div>
                    <div class="col-12">
                        <label for="Location" class="form-label">Location</label>
                        <input type="text" name="Location" class="form-control" id="Location"
                            value="<?php echo $basic_info['Location']; ?>" required>
                    </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
            </form><!-- Vertical Form -->

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
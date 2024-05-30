<?php
include('../classes/database.php');

session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to the login page
    header("Location: ../user.php");
    exit();
}

// Check if ID parameter is set in the URL
if(isset($_GET['id'])) {
    // Sanitize the ID parameter to prevent SQL injection
    $id = mysqli_real_escape_string($con, $_GET['id']);

    // Construct the SELECT query to retrieve the feature details
    $query = "SELECT * FROM apartment WHERE ID = $id";

    // Execute the SELECT query
    $result = mysqli_query($con, $query);

    // Check if the feature with the specified ID exists
    if(mysqli_num_rows($result) == 1) {
        // Fetch the feature details as an associative array
        $apartment = mysqli_fetch_assoc($result);
    }
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $new_apartment_name = mysqli_real_escape_string($con, $_POST['new_apartment_name']);
    $new_price = mysqli_real_escape_string($con, $_POST['price']);
    $new_surface = mysqli_real_escape_string($con, $_POST['surface']);
    $new_availability = isset($_POST['availability']) ? (int)$_POST['availability'] : 0; // Assuming availability is a boolean field
    $new_bedroom = mysqli_real_escape_string($con, $_POST['bedroom']);
    $new_bathroom = mysqli_real_escape_string($con, $_POST['bathroom']);
    $new_iframeSrc = mysqli_real_escape_string($con, $_POST['iframeSrc']);

    // Check if an image was uploaded
    if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['image']['tmp_name'];
        $imgContent = addslashes(file_get_contents($image));
    
        // Move uploaded file to a directory on your server
        $target_dir = __DIR__ . "/uploads/"; // Set the target directory path relative to the current PHP script
        $target_file = $target_dir . basename($_FILES["image"]["name"]);


        // Construct the UPDATE query to update apartment details with image path
        $update_query = "UPDATE apartment SET 
                            Name = '$new_apartment_name', 
                            price = '$new_price', 
                            surface = '$new_surface', 
                            availability = '$new_availability', 
                            bedroom = '$new_bedroom', 
                            bathroom = '$new_bathroom', 
                            iframeSrc = '$new_iframeSrc', 
                            image = '$target_file' 
                        WHERE ID = $id";
    } else {
        // Construct the UPDATE query to update apartment details without image
        $update_query = "UPDATE apartment SET 
                            Name = '$new_apartment_name', 
                            price = '$new_price', 
                            surface = '$new_surface', 
                            availability = '$new_availability', 
                            bedroom = '$new_bedroom', 
                            bathroom = '$new_bathroom', 
                            iframeSrc = '$new_iframeSrc' 
                        WHERE ID = $id";
    }

    // Execute the UPDATE query
    if(mysqli_query($con, $update_query)) {
        // If update is successful, redirect back to the listing page with success message
        header("Location: apartments.php?message=Apartment updated successfully");
        exit();
    } else {
        // If update fails, display error message
        $error_message = "Failed to update apartment: " . mysqli_error($con);
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
            <h1>Apartment</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Apartment</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <div class="card">
            <div class="card-body">

                <?php if (!empty($error_message)): ?>
                <div><?php echo $error_message; ?></div>
                <?php endif; ?>

                <form class="row g-3" method="post" enctype="multipart/form-data"
                    action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=" . $id; ?>">
                    <div class="col-12">
                        <label for="new_feature_name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="new_apartment_name" name="new_apartment_name"
                            value="<?php echo htmlspecialchars($apartment['Name']); ?>">
                    </div>
                    <div class="col-6">
                        <label for="Link" class="form-label">price</label>
                        <input type="text" class="form-control" id="price" name="price"
                            value="<?php echo htmlspecialchars($apartment['price']); ?>">
                    </div>
                    <div class="col-6">
                        <label for="Link" class="form-label">Surface</label>
                        <input type="text" class="form-control" id="surface" name="surface"
                            value="<?php echo htmlspecialchars($apartment['surface']); ?>">
                    </div>
                    <div class="col-6">
                        <label class="form-label">Availability</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="availability" id="available" value="1"
                                <?php if ($apartment['availability'] == 1) echo "checked"; ?>>
                            <label class="form-check-label" for="available">
                                Available
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="availability" id="not_available"
                                value="0" <?php if ($apartment['availability'] == 0) echo "checked"; ?>>
                            <label class="form-check-label" for="not_available">
                                Not Available
                            </label>
                        </div>
                    </div>

                    <div class="col-6">
                        <label for="bedroom" class="form-label">bedroom</label>
                        <input type="text" class="form-control" id="bedroom" name="bedroom"
                            value="<?php echo htmlspecialchars($apartment['bedroom']); ?>">
                    </div>
                    <div class="col-6">
                        <label for="bathroom" class="form-label">bathroom</label>
                        <input type="text" class="form-control" id="bathroom" name="bathroom"
                            value="<?php echo htmlspecialchars($apartment['bathroom']); ?>">
                    </div>

                    <div class="col-6">
                        <label for="image" class="form-label">Image</label>
                        <input class="form-control" type="file" id="image" name="image">
                        <?php if (!empty($apartment['image'])): ?>
                        <img src="<?php echo 'uploads/' . $apartment['image']; ?>" alt="Apartment Image">
                        <?php endif; ?>
                    </div>

                    <div class="col-12">
                        <label for="inputPassword" class="col-sm-2 col-form-label">iframeSrc</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="iframeSrc" name="iframeSrc"
                                style="height: 100px"><?php echo htmlspecialchars($apartment['iframeSrc']); ?></textarea>
                        </div>
                    </div>


                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Update</button>
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
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

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo d-flex align-items-center">
                <img src="assets/img/logo.png" alt="">
                <span class="d-none d-lg-block">NiceAdmin</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <div class="search-bar">
            <form class="search-form d-flex align-items-center" method="POST" action="#">
                <input type="text" name="query" placeholder="Search" title="Enter search keyword">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
            </form>
        </div><!-- End Search Bar -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li><!-- End Search Icon-->

                <li class="nav-item dropdown">

                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-bell"></i>
                        <span class="badge bg-primary badge-number">4</span>
                    </a><!-- End Notification Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                        <li class="dropdown-header">
                            You have 4 new notifications
                            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-exclamation-circle text-warning"></i>
                            <div>
                                <h4>Lorem Ipsum</h4>
                                <p>Quae dolorem earum veritatis oditseno</p>
                                <p>30 min. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-x-circle text-danger"></i>
                            <div>
                                <h4>Atque rerum nesciunt</h4>
                                <p>Quae dolorem earum veritatis oditseno</p>
                                <p>1 hr. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-check-circle text-success"></i>
                            <div>
                                <h4>Sit rerum fuga</h4>
                                <p>Quae dolorem earum veritatis oditseno</p>
                                <p>2 hrs. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-info-circle text-primary"></i>
                            <div>
                                <h4>Dicta reprehenderit</h4>
                                <p>Quae dolorem earum veritatis oditseno</p>
                                <p>4 hrs. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li class="dropdown-footer">
                            <a href="#">Show all notifications</a>
                        </li>

                    </ul><!-- End Notification Dropdown Items -->

                </li><!-- End Notification Nav -->

                <li class="nav-item dropdown">

                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-chat-left-text"></i>
                        <span class="badge bg-success badge-number">3</span>
                    </a><!-- End Messages Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
                        <li class="dropdown-header">
                            You have 3 new messages
                            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="message-item">
                            <a href="#">
                                <img src="assets/img/messages-1.jpg" alt="" class="rounded-circle">
                                <div>
                                    <h4>Maria Hudson</h4>
                                    <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                    <p>4 hrs. ago</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="message-item">
                            <a href="#">
                                <img src="assets/img/messages-2.jpg" alt="" class="rounded-circle">
                                <div>
                                    <h4>Anna Nelson</h4>
                                    <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                    <p>6 hrs. ago</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="message-item">
                            <a href="#">
                                <img src="assets/img/messages-3.jpg" alt="" class="rounded-circle">
                                <div>
                                    <h4>David Muldon</h4>
                                    <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                    <p>8 hrs. ago</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="dropdown-footer">
                            <a href="#">Show all messages</a>
                        </li>

                    </ul><!-- End Messages Dropdown Items -->

                </li><!-- End Messages Nav -->

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2">K. Anderson</span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>Kevin Anderson</h6>
                            <span>Web Designer</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                <i class="bi bi-gear"></i>
                                <span>Account Settings</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                                <i class="bi bi-question-circle"></i>
                                <span>Need Help?</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->



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

                <form class="row g-3" method="post"  enctype="multipart/form-data"
                    action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=" . $id; ?>" >
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
                        <img src="<?php echo 'uploads/' . $apartment['image']; ?>" alt="Apartment Image">

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
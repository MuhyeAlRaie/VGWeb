<?php
    include('database.php');

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Sanitize user inputs to prevent SQL injection
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $password = mysqli_real_escape_string($con, $_POST['password']);

        // Prepare SQL query to fetch user from database
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($con, $sql);

        if ($result) {
            // Check if a user with the given username exists
            $row = mysqli_fetch_assoc($result);
            if ($row) {
                // Verify the password
                if ($row['password'] == $password) { // Comparing plain-text passwords
                    // Start session and store user information
                    session_start();
                    $_SESSION['username'] = $username; // Set session variable for username
                    $_SESSION['user_id'] = $row['id'];
                    header("Location: ../NiceAdmin/index.php");
                    exit();
                } else {
                    $error_message = "Login failed. Invalid username or password.";
                }
            } else {
                $error_message = "Login failed. User does not exist.";
            }
        } else {
            $error_message = "Database error. Please try again later.";
        }

        // Redirect back to login page with error message
        header("Location: ../user.php?error=" . urlencode($error_message));
        exit();
    } else {
        // If someone tries to access this script directly, redirect them
        header("Location: ../user.php");
        exit();
    }
?>

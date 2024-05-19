<?php
include('../../classes/database.php');  

// Check if ID parameter is set in the URL
if(isset($_GET['id'])) {
    // Sanitize the ID parameter to prevent SQL injection
    $id = mysqli_real_escape_string($con, $_GET['id']);

    // Construct the DELETE query
    $query = "DELETE FROM features WHERE ID = $id";

    // Execute the DELETE query
    if(mysqli_query($con, $query)) {
        // If deletion is successful, redirect back to the listing page with success message
        header("Location: ../features.php?message=Item deleted successfully");
        exit();
    } else {
        // If deletion fails, redirect back to the listing page with error message
        header("Location: ../features.php?error=Failed to delete item: " . mysqli_error($con));
        exit();
    }
} else {
    // If ID parameter is not set, redirect back to the listing page with error message
    header("Location: ../features.php?error=Invalid request");
    exit();
}

// Close database connection
mysqli_close($con);
?>

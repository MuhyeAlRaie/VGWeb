<?php
include('../../classes/database.php');  

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form values
    $title = $_POST['title'];
    $description = $_POST['description'];
    $statistic_title_1 = $_POST['Statistic_title_1'];
    $statistic_value_1 = $_POST['Statistic_value_1'];
    $statistic_title_2 = $_POST['Statistic_title_2'];
    $statistic_value_2 = $_POST['Statistic_value_2'];
    $statistic_title_3 = $_POST['Statistic_title_3'];
    $statistic_value_3 = $_POST['Statistic_value_3'];
    $location = $_POST['Location'];

    // Prepare SQL statement to update the last created record
    $sql = "UPDATE basic_info 
            SET description='$description', 
                title='$title',
                statistic_title_1='$statistic_title_1', 
                statistic_value_1='$statistic_value_1', 
                statistic_title_2='$statistic_title_2', 
                statistic_value_2='$statistic_value_2', 
                statistic_title_3='$statistic_title_3', 
                statistic_value_3='$statistic_value_3', 
                location='$location' 
            ORDER BY id DESC
            LIMIT 1";

    // Execute SQL statement
    if ($con->query($sql) === TRUE) {
        $success_message = "Information updated successfully!";
        header("Location: ../basic-info.php?message=" . urlencode($success_message));
        exit();    
    } else {
        $error_message = "Oops something wrong happened";
        header("Location: ../basic-info.php?error=" . urlencode($error_message));
        exit();
    }

    // Close connection
    $con->close();
}
?>

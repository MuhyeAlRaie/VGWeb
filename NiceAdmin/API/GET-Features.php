<?php
// Include database connection
include('../../classes/database.php');

// Check if the request method is GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Prepare SQL statement
    $sql = "SELECT * FROM features";

    // Execute SQL statement
    $result = $con->query($sql);

    // Check if any rows were returned
    if ($result->num_rows > 0) {
        // Initialize an empty array to store data
        $data = array();

        // Loop through each row in the result set
        while ($row = $result->fetch_assoc()) {
            // Add each row to the data array
            $data[] = $row;
        }

        // Return JSON response
        header('Content-Type: application/json');
        echo json_encode($data);
    } else {
        // If no rows were returned, return an empty array
        header('Content-Type: application/json');
        echo json_encode(array());
    }
} else {
    // If the request method is not GET, return an error message
    header('Content-Type: application/json');
    echo json_encode(array('error' => 'Invalid request method'));
}

// Close connection
$con->close();
?>

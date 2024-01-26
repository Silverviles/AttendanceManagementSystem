<?php

include_once 'config.php';

// Check if the degree_id parameter is provided
if (isset($_POST['degree_id'])) {
    $degree_id = $_POST['degree_id'];

    // Prepare and execute the SQL statement to delete the record
    $sql = "DELETE FROM degree WHERE degree_id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("s", $degree_id);
        $stmt->execute();

        // Check if the delete was successful
        if ($stmt->affected_rows > 0) {
            echo "Record deleted successfully";
        } else {
            echo "Error: Record not found or couldn't be deleted";
        }

        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }
} else if(1) {
    
}

// Close the database connection
$conn->close();
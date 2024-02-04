<?php
include_once '../Login/session_error.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include the database connection file
    require_once "config.php";
    
    // Prepare and bind the parameters
    $stmt = $conn->prepare("INSERT INTO classes (duration, locations, module, lecturer, batch, date) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $duration, $locations, $module, $lecturer, $batch, $date);
    
    // Set parameters from the form
    $duration = $_POST['duration'];
    $locations = $_POST['locations'];
    $module = $_POST['module'];
    $lecturer = $_POST['lecturer'];
    $batch = $_POST['batch'];
    $date = $_POST['date'];
    
    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to a success page or show a success message
        header("Location: ../Lecturer/lecturerBase.php");
        exit();
    } else {
        // Handle error
        echo "Error: " . $stmt->error;
    }
    
    // Close the statement
    $stmt->close();
    
    // Close the database connection
    $conn->close();
}
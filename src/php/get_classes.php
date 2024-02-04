<?php
// Include the database connection file
require_once "config.php"; // Update with your actual database connection file

// Define an array to store class details
$classesData = array();

// Fetch class details from the database
$stmt = $conn->prepare("SELECT duration, locations, module, lecturer, batch, date FROM classes");
$stmt->execute();
$result = $stmt->get_result();

// Fetch each row and add it to the classes data array
while ($row = $result->fetch_assoc()) {
    $classesData[] = $row;
}

// Close the database connection
$stmt->close();
$conn->close();

// Return class details as JSON
header('Content-Type: application/json');
echo json_encode($classesData);
<?php
include_once 'config.php';

// Fetch faculty details from the database
$sql = "SELECT faculty_id, faculty_name FROM faculty";
$result = $conn->query($sql);

$facultyArray = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $facultyArray[] = $row;
    }
}

echo json_encode($facultyArray);

$conn->close();

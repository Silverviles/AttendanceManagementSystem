<?php
include_once 'config.php';

// Fetch degree details from the database
$sql = "SELECT * FROM degree";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $degrees = array();
    while ($row = $result->fetch_assoc()) {
        $degrees[] = $row;
    }
    echo json_encode($degrees);
} else {
    echo "No degrees found";
}

$conn->close();
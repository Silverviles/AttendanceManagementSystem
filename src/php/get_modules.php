<?php
include_once 'config.php';

$sql = "SELECT * FROM module";
$result = $conn->query($sql);

if ($result) {
    $moduleDetails = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($moduleDetails);
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
<?php
include_once 'config.php';

if(isset($_GET['param']) && !empty($_GET['param'])) {
    // Use the parameter to filter the query, for example, filtering by faculty
    $param = $_GET['param'];
    $sql = "SELECT * FROM degree WHERE degree_id = '$param'";
} else {
    // Fetch all degree details from the database
    $sql = "SELECT * FROM degree";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $degrees = array();
    while ($row = $result->fetch_assoc()) {
        $degrees[] = $row;
    }
    echo json_encode($degrees);
} else {
    echo "No degrees";
}

$conn->close();
?>

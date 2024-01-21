<?php
include_once 'config.php';

$sql = "SELECT user_id, lecturer_id, faculty FROM lecturer";
$result = $conn->query($sql);

$lecturers = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $lecturer = array(
            "user_id" => $row["user_id"],
            "lecturer_id" => $row["lecturer_id"],
            "faculty" => $row["faculty"]
        );

        $sql2 = "SELECT u.first_name, u.last_name
        FROM users u
        JOIN lecturer l ON u.id = l.user_id
        WHERE l.user_id = {$lecturer["user_id"]}";

        $result2 = $conn->query($sql2);

        if ($result2->num_rows > 0) {
            // Fetch the result as an associative array
            $row2 = $result2->fetch_assoc();

            // Get the lecturer name
            $lecturer_name = $row2['first_name'] . ' ' . $row2['last_name'];
            
            // Output the result
            $lecturer["lecturer_name"] = $lecturer_name;
        } else {
            echo "Lecturer not found.";
        }
        
        array_push($lecturers, $lecturer);
    }
}

$conn->close();

// Return the data as JSON
header('Content-Type: application/json');
echo json_encode($lecturers);
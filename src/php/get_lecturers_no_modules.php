<?php
include_once 'config.php';

$sql = "SELECT l.user_id, l.lecturer_id, l.faculty, u.first_name, u.last_name
        FROM lecturer l
        JOIN users u ON l.user_id = u.id
        WHERE NOT EXISTS (
            SELECT 1
            FROM module m
            WHERE m.module_owner = l.user_id
        )";

$result = $conn->query($sql);

$lecturers = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $lecturer = array(
            "user_id" => $row["user_id"],
            "lecturer_id" => $row["lecturer_id"]
        );

        array_push($lecturers, $lecturer);
    }
}

$conn->close();

// Return the data as JSON
header('Content-Type: application/json');
echo json_encode($lecturers);
<?php
include_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Retrieve form data
    $course_id = $_POST['course_id'];
    $course_name = $_POST['course_name'];
    $faculty = $_POST['faculty'];

    // Validate and sanitize input as needed

    // Insert data into the degree table
    $sql = "INSERT INTO degree (degree_id, degree_name, faculty) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $course_id, $course_name, $faculty);

    if ($stmt->execute()) {
        echo "Course added successfully!";
    } else {
        echo "Error adding course: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method!";
}
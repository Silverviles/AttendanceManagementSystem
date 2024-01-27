<?php
include_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $course_id = $_POST['course_id'];
    $course_name = $_POST['course_name'];
    $faculty = $_POST['faculty'];

    // Validate and sanitize input as needed

    if (isset($_POST['add_course_done'])) {
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
    } else if (isset($_POST['edit_course_done'])) {
        // Update existing record in the degree table
        $sql = "UPDATE degree SET degree_name = ?, faculty = ? WHERE degree_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $course_name, $faculty, $course_id);

        if ($stmt->execute()) {
            echo "Course edited successfully!";
        } else {
            echo "Error editing course: " . $stmt->error;
        }

        $stmt->close();
    } else {
        foreach ($_POST as $key => $value) {
            echo $key . ': ' . $value . '<br>';
        }
    }

    $conn->close();
} else {
    echo "Invalid request method!";
}
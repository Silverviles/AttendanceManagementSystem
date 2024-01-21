<?php
include_once 'config.php';

$sql = "SELECT user_id, student_id, faculty, degree, batch FROM student";
$result = $conn->query($sql);

$students = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $student = array(
            "user_id" => $row["user_id"],
            "student_id" => $row["student_id"],
            "faculty" => $row["faculty"],
            "degree" => $row["degree"],
            "batch" => $row["batch"]
        );

        $sql2 = "SELECT first_name, last_name FROM users WHERE id = {$student["user_id"]}";

        $result2 = $conn->query($sql2);

        if ($result2->num_rows > 0) {
            // Fetch the result as an associative array
            $row2 = $result2->fetch_assoc();

            // Get the student name
            $student_name = $row2['first_name'] . ' ' . $row2['last_name'];

            // Output the result
            $student["student_name"] = $student_name;
        } else {
            echo "Student not found.";
        }

        array_push($students, $student);
    }
}

$conn->close();

// Return the data as JSON
header('Content-Type: application/json');
echo json_encode($students);
<?php
include_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $password = $_POST["password"];
    $firstName = $_POST["first_name"];
    $lastName = $_POST["last_name"];
    $email = $_POST["email"];
    $contactNo = $_POST["contact_no"];
    $lecturerId = $_POST["lecturer_id"];
    $faculty = $_POST["faculty"];

    // You may want to perform additional validation on the data

    if (isset($_POST['add_lecturer_done'])) {
        // Insert data into the lecturer table
        $sql = "INSERT INTO lecturer (username, password, first_name, last_name, email, contact_no, lecturer_id, faculty) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssss", $username, $password, $firstName, $lastName, $email, $contactNo, $lecturerId, $faculty);

        if ($stmt->execute()) {
            echo "Lecturer added successfully!";
        } else {
            echo "Error adding lecturer: " . $stmt->error;
        }

        $stmt->close();
    } else if (isset($_POST['edit_lecturer_done'])) {
        // Update existing record in the lecturer table
        $sql = "UPDATE lecturer SET username = ?, password = ?, first_name = ?, last_name = ?, email = ?, contact_no = ?, faculty = ? WHERE lecturer_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssss", $username, $password, $firstName, $lastName, $email, $contactNo, $faculty, $lecturerId);

        if ($stmt->execute()) {
            echo "Lecturer edited successfully!";
        } else {
            echo "Error editing lecturer: " . $stmt->error;
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
?>

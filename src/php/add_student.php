<?php
include_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $contact_no = $_POST['contact_no'];
    $account_type = 'student'; // Set account type explicitly for student
    $student_id = $_POST['student_id'];
    $faculty = $_POST['faculty'];
    $degree = $_POST['degree'];
    $batch = $_POST['batch'];

    // Validate and sanitize input as needed

    // Start a transaction to ensure data consistency
    $conn->begin_transaction();

    try {
        // Use the stored procedure InsertOrUpdateUserAndStudent
        $stmt = $conn->prepare("CALL InsertOrUpdateUserAndStudent(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssssss", $username, $password, $first_name, $last_name, $email, $contact_no, $account_type, $student_id, $faculty, $degree, $batch);

        // Execute the stored procedure
        $stmt->execute();

        // Commit the transaction
        $conn->commit();
        echo "Student added or updated successfully!";
    } catch (Exception $e) {
        // Rollback the transaction in case of an error
        $conn->rollback();
        echo "Error adding or updating student: " . $e->getMessage();
        header("Location: ".$e->getMessage());
    } finally {
        // Close the statement
        $stmt->close();
        // Close the connection
        $conn->close();
    }
} else {
    echo "Invalid request method!";
}
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
    $account_type = 'lecturer'; // Set account type explicitly for lecturer
    $lecturer_id = $_POST['lecturer_id'];
    $faculty = $_POST['faculty'];

    // Validate and sanitize input as needed

    // Start a transaction to ensure data consistency
    $conn->begin_transaction();

    try {
        // Use the stored procedure InsertUserAndLecturer
        $stmt = $conn->prepare("CALL InsertUserAndLecturer(?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssss", $username, $password, $first_name, $last_name, $email, $contact_no, $account_type, $lecturer_id, $faculty);

        // Execute the stored procedure
        $stmt->execute();

        // Commit the transaction
        $conn->commit();
        echo "Lecturer added successfully!";
    } catch (Exception $e) {
        // Rollback the transaction in case of an error
        $conn->rollback();
        echo "Error adding lecturer: " . $e->getMessage();
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
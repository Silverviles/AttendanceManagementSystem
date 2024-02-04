<?php
session_start();

include_once 'config.php';

// Get the user ID and student ID from session variables
$userID = $_SESSION['user_id'];
$studentID = $_SESSION['student_id'];

// Combine the input fields into one number
$combinedNumber = $_POST['no1'] . $_POST['no2'] . $_POST['no3'] . $_POST['no4'];

function checkOTP($otp, $conn)
{
    $sql = "SELECT COUNT(*) as count FROM otp_table WHERE otp = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $otp);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['count'] > 0;
}

if (checkOTP($combinedNumber, $conn)) {
    // Prepare SQL statement to check if the record already exists
    $sql_check = "SELECT COUNT(*) AS count FROM attendance WHERE user_id = ? AND student_id = ? AND otp = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("iis", $userID, $studentID, $combinedNumber);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();
    $row_check = $result_check->fetch_assoc();

    if ($row_check['count'] > 0) {
        // Record already exists
        echo "Record already exists";
        header("Location: ../Student/index.php?success=3");
    } else {
        // Prepare SQL statement to insert data into the attendance table
        $sql_insert = "INSERT INTO attendance (user_id, student_id, otp) VALUES (?, ?, ?)";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param("ssi", $userID, $studentID, $combinedNumber);

        // Execute the SQL statement
        if ($stmt_insert->execute() === TRUE) {
            echo "OTP verified and saved successfully.";
            header("Location: ../Student/index.php?success=1");
        } else {
            echo "Error: " . $sql_insert . "<br>" . $conn->error;
            header("Location: ../Student/index.php?success=-1");
        }
    }

} else {
    // Return 2 (Invalid OTP)
    header("Location: ../Student/index.php?success=2");
}

// Close the database connection
$conn->close();
exit();
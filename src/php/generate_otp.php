<?php
include_once 'config.php';

// Check if the form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Extract data from the URL parameters
    $duration = $_GET['duration'];
    $locations = $_GET['locations'];
    $module = $_GET['module'];
    $lecturer = $_GET['lecturer'];
    $batch = $_GET['batch'];
    $date = $_GET['date'];

    // Prepare the query to check if the OTP already exists
    $query_check = "SELECT otp FROM otp_table WHERE duration = ? AND locations = ? AND module = ? AND lecturer = ? AND batch = ? AND date = ?";
    $stmt_check = $conn->prepare($query_check);
    $stmt_check->bind_param("ssssss", $duration, $locations, $module, $lecturer, $batch, $date);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        // If an OTP already exists for the provided data, return that OTP
        $row = $result_check->fetch_assoc();
        $otp = $row['otp'];
    } else {
        // Extract the time from the date string
        $start_time = new DateTime($date);

        list($hours, $minutes, $seconds) = explode(':', $duration);

        $start_time->add(new DateInterval('PT' . $hours . 'H' . $minutes . 'M' . $seconds . 'S'));

        $expiration = $start_time->format('Y-m-d H:i:s');

        // If no OTP exists for the provided data, generate a new one
        $otp = mt_rand(1000, 9999); // Generate a random 4-digit OTP
        // Prepare and execute the query to save OTP details to the table
        $query_insert = "INSERT INTO otp_table (duration, locations, module, lecturer, batch, date, otp, expiration) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt_insert = $conn->prepare($query_insert);
        $stmt_insert->bind_param("ssssssis", $duration, $locations, $module, $lecturer, $batch, $date, $otp, $expiration);
        $stmt_insert->execute();
    }

    // Redirect to otp.php with OTP as a query parameter
    header("Location: ../Lecturer/lecturerBase.php?otp=$otp");
    exit();
}

// If the form is not submitted through GET method, redirect to an error page or handle accordingly
header("Location: error.php");
exit();

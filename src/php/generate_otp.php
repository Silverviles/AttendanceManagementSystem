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

    // Extract the time from the date string
    $start_time = new DateTime($date);

    list($hours, $minutes, $seconds) = explode(':', $duration);

    $start_time->add(new DateInterval('PT'.$hours.'H'.$minutes.'M'.$seconds.'S'));

    $expiration = $start_time->format('Y-m-d H:i:s');

    // Generate a random OTP of 6 numbers
    $otp = mt_rand(0000, 9999);

    // Prepare and execute the query to save OTP details to the table
    $query = "INSERT INTO otp_table (duration, locations, module, lecturer, batch, date, otp, expiration) 
              VALUES ('$duration', '$locations', '$module', '$lecturer', '$batch', '$date', '$otp', '$expiration')";
    mysqli_query($conn, $query);

    // Redirect to otp.php with OTP as a query parameter
    header("Location: ../Lecturer/otp.php?otp=$otp");
    exit();
}

// If the form is not submitted through GET method, redirect to an error page or handle accordingly
header("Location: error.php");
exit();

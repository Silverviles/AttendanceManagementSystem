<?php
include_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $moduleCode = $_POST["module_code"];
    $moduleName = $_POST["module_name"];
    $moduleOwner = $_POST["module_owner"];
    $facultyId = $_POST["faculty"];
    $degreeId = $_POST["degree"];

    // You may want to perform additional validation on the data

    // Insert data into the database
    $sql = "INSERT INTO module (module_code, module_name, module_owner, faculty, degree) VALUES ('$moduleCode', '$moduleName', '$moduleOwner', '$facultyId', '$degreeId')";

    if ($conn->query($sql) === TRUE) {
        echo "Module added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
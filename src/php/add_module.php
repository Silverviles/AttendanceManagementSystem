<?php
include_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $moduleCode = $_POST["module_code"];
    $moduleName = $_POST["module_name"];
    $moduleOwner = $_POST["module_owner"];
    $facultyId = $_POST["faculty"];
    $degreeId = $_POST["degree"];

    // You may want to perform additional validation on the data

    if (isset($_POST['add_module_done'])) {
        // Insert data into the module table
        $sql = "INSERT INTO module (module_code, module_name, module_owner, faculty, degree) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $moduleCode, $moduleName, $moduleOwner, $facultyId, $degreeId);

        if ($stmt->execute()) {
            echo "Module added successfully!";
        } else {
            echo "Error adding module: " . $stmt->error;
        }

        $stmt->close();
    } else if (isset($_POST['edit_module_done'])) {
        // Update existing record in the module table
        $sql = "UPDATE module SET module_name = ?, module_owner = ?, faculty = ?, degree = ? WHERE module_code = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $moduleName, $moduleOwner, $facultyId, $degreeId, $moduleCode);

        if ($stmt->execute()) {
            echo "Module edited successfully!";
        } else {
            echo "Error editing module: " . $stmt->error;
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
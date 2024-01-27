<?php

include_once 'config.php';

// Check if the degree_id parameter is provided
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["degree_id"])) {
        $degree_id = $_POST['degree_id'];
    
        // Prepare and execute the SQL statement to delete the record from the degree table
        $sql = "DELETE FROM degree WHERE degree_id = ?";
        $stmt = $conn->prepare($sql);
    
        if ($stmt) {
            $stmt->bind_param("s", $degree_id);
            $stmt->execute();
    
            // Check if the delete was successful
            if ($stmt->affected_rows > 0) {
                echo "Record deleted successfully from degree table";
            } else {
                echo "Error: Record not found or couldn't be deleted from degree table";
            }
    
            $stmt->close();
        } else {
            echo "Error: " . $conn->error;
        }
    } elseif (isset($_POST["module_code"])) {
        $module_code = $_POST['module_code'];
    
        // Prepare and execute the SQL statement to delete the record from the module table
        $sql = "DELETE FROM module WHERE module_code = ?";
        $stmt = $conn->prepare($sql);
    
        if ($stmt) {
            $stmt->bind_param("s", $module_code);
            $stmt->execute();
    
            // Check if the delete was successful
            if ($stmt->affected_rows > 0) {
                echo "Record deleted successfully from module table";
            } else {
                echo "Error: Record not found or couldn't be deleted from module table";
            }
    
            $stmt->close();
        } else {
            echo "Error: " . $conn->error;
        }
    } elseif (isset($_POST["student_id"])) {
        $student_id = $_POST['student_id'];
    
        // Prepare and execute the SQL statement to delete the record from the student table
        $sql = "DELETE FROM student WHERE student_id = ?";
        $stmt = $conn->prepare($sql);
    
        if ($stmt) {
            $stmt->bind_param("s", $student_id);
            $stmt->execute();
    
            // Check if the delete was successful
            if ($stmt->affected_rows > 0) {
                echo "Record deleted successfully from student table";
            } else {
                echo "Error: Record not found or couldn't be deleted from student table";
            }
    
            $stmt->close();
        } else {
            echo "Error: " . $conn->error;
        }
    } elseif (isset($_POST["lecturer_id"])) {
        $lecturer_id = $_POST['lecturer_id'];
    
        // Prepare and execute the SQL statement to delete the record from the lecturer table
        $sql = "DELETE FROM lecturer WHERE lecturer_id = ?";
        $stmt = $conn->prepare($sql);
    
        if ($stmt) {
            $stmt->bind_param("s", $lecturer_id);
            $stmt->execute();
    
            // Check if the delete was successful
            if ($stmt->affected_rows > 0) {
                echo "Record deleted successfully from lecturer table";
            } else {
                echo "Error: Record not found or couldn't be deleted from lecturer table";
            }
    
            $stmt->close();
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "No valid parameters provided for deletion";
    }    
} else if (1) {

}

// Close the database connection
$conn->close();
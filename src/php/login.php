<?php
include_once 'config.php';

session_start();

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $remember = isset($_POST['remember']) ? 1 : 0;

    // Perform a query to retrieve user data
    $sql = "SELECT id, username, password, account_type FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User exists, fetch data
        $row = $result->fetch_assoc();
        $storedPassword = $row['password'];
        $userType = $row['account_type'];
        $userID = $row['id'];

        // Check if the input password matches the stored password
        if ($password == $storedPassword) {
            // Passwords match, login successful
            echo "Login successful! Welcome, $username. Your account type is: $userType";

            // Optionally, you may set session variables or perform other actions after a successful login.
            $_SESSION['user'] = $username;
            $_SESSION['accountType'] = $userType;
            $_SESSION['user_id'] = $userID;

            if ($remember) {
                // Set a cookie or perform other actions for "Remember Me" functionality
                setcookie("remember_me", $username, time() + (86400 * 30), "/");
            }

            if ($userType == 'admin') {
                $_SESSION['admin_id'] = getCode('admin', $conn);
                header("Location: ../Admin/adminBase.php");
            } else if ($userType == 'student') {
                $_SESSION['student_id'] = getCode('student', $conn);
                header("Location: ../Student/index.php");
            } else if ($userType == 'lecturer') {
                $_SESSION['lecturer_id'] = getCode('lecturer', $conn);
                header("Location: ../Lecturer/lecturerBase.php");
            }
        } else {
            // Incorrect password
            echo "Login failed. Incorrect password.";
        }
    } else {
        // User not found
        echo "Login failed. Invalid user.";
    }
}

// Close the connection
$conn->close();

function getCode($table, $conn){
    // Assuming $_SESSION['user'] is properly sanitized or validated
    $userID = $conn->real_escape_string($_SESSION['user_id']);
    
    // Concatenate the table name with "_id" to dynamically select the primary key column
    $primaryKeyColumn = $table . "_id";
    
    // Prepare the SQL statement with a placeholder
    $sql = "SELECT $primaryKeyColumn FROM $table WHERE user_id = ?";
    
    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $userID);
    
    // Execute the query
    $stmt->execute();
    
    // Get the result
    $result = $stmt->get_result();
    
    $row = $result->fetch_assoc();
    // Return the result (or handle it as needed)
    return $row[$primaryKeyColumn];
}

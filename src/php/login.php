<?php
include_once 'config.php';

session_start();

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $remember = isset($_POST['remember']) ? 1 : 0;

    // Perform a query to retrieve user data
    $sql = "SELECT username, password, account_type FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User exists, fetch data
        $row = $result->fetch_assoc();
        $storedPassword = $row['password'];
        $userType = $row['account_type'];

        // Check if the input password matches the stored password
        if ($password == $storedPassword) {
            // Passwords match, login successful
            echo "Login successful! Welcome, $username. Your account type is: $userType";

            // Optionally, you may set session variables or perform other actions after a successful login.
            $_SESSION['user'] = $username;
            $_SESSION['accountType'] = $userType;

            if ($remember) {
                // Set a cookie or perform other actions for "Remember Me" functionality
                setcookie("remember_me", $username, time() + (86400 * 30), "/");
            }

            if ($userType == 'admin') {
                getCode('admin', $conn);
                header("Location: ../Admin/adminBase.php");
            } else if ($userType == 'student') {
                getCode('student', $conn);
                header("Location: ../Student/index.php");
            } else if ($userType == 'lecturer') {
                getCode('lecturer', $conn);
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
    $username = $conn->real_escape_string($_SESSION['user']);
    
    // Concatenate the table name with "_id" to dynamically select the primary key column
    $primaryKeyColumn = $table . "_id";
    
    // Prepare the SQL statement with a placeholder
    $sql = "SELECT $primaryKeyColumn FROM $table WHERE username = ?";
    
    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    
    // Execute the query
    $stmt->execute();
    
    // Get the result
    $result = $stmt->get_result();
    
    // Return the result (or handle it as needed)
    return $result;
}

<?php
function getCount($conn, $tableName, $studentId = null) {
    // Base query to get user count
    $baseQuery = "SELECT COUNT(*) as count FROM ";

    switch ($tableName) {
        case 'users':
            $query = $baseQuery . "users";
            break;
        case 'student':
            $query = $baseQuery . "student";
            break;
        case 'lecturer':
            $query = $baseQuery . "lecturer";
            break;
        case 'module':
            $query = $baseQuery . "module";
            break;
        case 'degree':
            $query = $baseQuery . "degree";
            break;
        case 'faculty':
            $query = $baseQuery . "faculty";
            break;
        case 'student_to_module':
            $query = $baseQuery . "student_to_module";
            break;
        default:
            die("Invalid data type");
    }

    // If $userId is not null and data type is 'student_to_module', search for the number of modules the student is registered to
    if ($studentId !== null && $tableName === 'student_to_module') {
        $query .= " WHERE student_id = " . $studentId;
    }

    // Execute the query
    $result = $conn->query($query);

    if ($result) {
        // Fetch the result
        $row = $result->fetch_assoc();

        // Get the user count
        $userCount = $row['count'];

        // Free result set
        $result->free_result();

        return $userCount;
    } else {
        // Handle error
        echo "Error executing query: " . $conn->error;
        return false;
    }
}
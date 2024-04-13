<div class="lecturer_content" id="lecturer_attendance_history">
<?php
include_once '../php/config.php';
// Assuming $conn is your database connection

// Retrieve data for each module
$sql = "SELECT
    m.module_code,
    m.module_name,
    COUNT(s2m.student_id) AS num_students,
    COALESCE(c.num_classes, 0) AS num_classes,
    COALESCE(a.attendance_count, 0) AS attendance_count,
    IF(COALESCE(a.attendance_count, 0) > 0, 
        ROUND((COALESCE(a.attendance_count, 0) / (COUNT(s2m.student_id) * COALESCE(c.num_classes, 0))) * 100, 2),
        0
    ) AS overall_attendance_percentage
    FROM
    module m
    LEFT JOIN student_to_module s2m ON m.module_code = s2m.module_code
    LEFT JOIN (
        SELECT module_code, COUNT(module_code) AS attendance_count
        FROM attendance
        GROUP BY module_code
    ) a ON m.module_code = a.module_code
    LEFT JOIN (
        SELECT module, COUNT(module) AS num_classes
        FROM classes
        GROUP BY module
    ) c ON m.module_code = c.module
    WHERE m.module_owner = {$_SESSION['user_id']}
    GROUP BY m.module_code;";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1' class='details_t'>
            <tr>
                <th>Module Code</th>
                <th>Module Name</th>
                <th>Number of Students</th>
                <th>Number of Classes</th>
                <th>Overall Attendance</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["module_code"] . "</td>
                <td>" . $row["module_name"] . "</td>
                <td>" . $row["num_students"] . "</td>
                <td>" . $row["num_classes"] . "</td>
                <td>" . $row["overall_attendance_percentage"] . "%</td>
            </tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>


</div>
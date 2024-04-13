<?php
include_once '../php/config.php';

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
    GROUP BY m.module_code;";

$result = $conn->query($sql);

$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

echo json_encode($data);

$conn->close();

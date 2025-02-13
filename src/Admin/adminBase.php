<?php include_once '../Login/session_error.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="../styles/header.css" />
    <link rel="stylesheet" type="text/css" href="../styles/admin.css" />
    <link rel="stylesheet" type="text/css" href="../styles/calendar.css" />
    <link rel="stylesheet" type="text/css" href="../styles/popup.css" />
    <link rel="stylesheet" href="../styles/table.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <?php include_once '../Common/header.php'; ?>
    <main>
        <?php include_once './navBar.php'; ?>
        <?php include_once './dashboard.php'; ?>
        <?php include_once './faculties.php'; ?>
        <?php include_once './courses.php'; ?>
        <?php include_once './modules.php'; ?>
        <?php include_once './lecturers.php'; ?>
        <?php include_once './students.php'; ?>
        <?php include_once './analytics.php'; ?>
    </main>
    <?php include_once '../Common/popup.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../scripts/navBar.js"></script>
    <script src="../scripts/calendar.js"></script>
    <script src="../scripts/courses.js"></script>
    <script src="../scripts/modules.js"></script>
    <script src="../scripts/lecturers.js"></script>
    <script src="../scripts/students.js"></script>
    <script src="../scripts/popup.js"></script>
</body>
</html>
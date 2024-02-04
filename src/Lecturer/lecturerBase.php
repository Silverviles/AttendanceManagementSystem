<?php include_once '../Login/session_error.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="../styles/header.css" />
    <link rel="stylesheet" type="text/css" href="../styles/admin.css" />
    <link rel="stylesheet" type="text/css" href="../styles/lecturer.css" />
    <link rel="stylesheet" type="text/css" href="../styles/calendar.css" />
    <link rel="stylesheet" href="../styles/table.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />
</head>

<body>
    <?php include_once '../Common/header.php'; ?>
    <main>
        <?php include_once './navBar.php'; ?>
        <?php include_once './dashboard.php'; ?>
        <?php include_once './create_session.php'; ?>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="../scripts/lec-navBar.js"></script>
    <script src="../scripts/today-classes.js"></script>
</body>
</html>
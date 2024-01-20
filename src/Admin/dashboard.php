<?php
    include_once '../php/config.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="../styles/header.css" />
    <link rel="stylesheet" type="text/css" href="../styles/dashboard.css" />
    <link rel="stylesheet" type="text/css" href="../styles/calendar.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />
</head>

<body>
    <header>
        <div id="navbar-animmenu">
            <ul class="show-dropdown main-navbar">
                <div class="hori-selector">
                    <div class="left"></div>
                    <div class="right"></div>
                </div>
                <li>
                    <a href="#"><b>Dashboard</b></a>
                </li>
            </ul>
        </div>
    </header>
    <main>
        <div class="l-navbar" id="nav-bar">
            <nav class="nav">
                <div>
                    <div class="nav_list">
                        <a href="#" class="nav_link active">
                            <i class='bx bx-grid-alt nav_icon'></i>
                            <span class="nav_name">Dashboard</span>
                        </a>
                        <a href="#" class="nav_link">
                            <i class='bx bx-user nav_icon'></i>
                            <span class="nav_name">Faculties</span>
                        </a>
                        <a href="#" class="nav_link">
                            <i class='bx bx-message-square-detail nav_icon'></i>
                            <span class="nav_name">Courses</span>
                        </a>
                        <a href="#" class="nav_link">
                            <i class='bx bx-bookmark nav_icon'></i>
                            <span class="nav_name">Modules</span>
                        </a>
                        <a href="#" class="nav_link">
                            <i class='bx bx-folder nav_icon'></i>
                            <span class="nav_name">Lectures</span>
                        </a>
                        <a href="#" class="nav_link">
                            <i class='bx bx-bar-chart-alt-2 nav_icon'></i>
                            <span class="nav_name">Students</span>
                        </a>
                        <a href="#" class="nav_link">
                            <i class='bx bx-bar-chart-alt-2 nav_icon'></i>
                            <span class="nav_name">Analysis</span>
                        </a>
                    </div>
                </div> <a href="#" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span
                        class="nav_name">SignOut</span> </a>
            </nav>
        </div>
        <div class="admin_content" id="admin_dashboard">
            <div id="stat-buttons">
                <button class="button-17">Student</button>
                <button class="button-17">Lecturer</button>
                <button class="button-17">Module</button>
            </div>
            <div id="calendar_logo">
                <div class="calendar" id="admin_calendar"></div>
                <div class="big_logo">
                    <img src="../images/logo.jpg" alt="logo">
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="../scripts/dashboard.js"></script>
    <script src="../scripts/calendar.js"></script>
</body>

</html>
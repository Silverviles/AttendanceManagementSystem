<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendify</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <div class="container">
        <nav>
            <ul>
                <li><a href="#" class="logo">
                    <img src="logo.png" >
                    <span class="nav-item">Student</span>
                </a></li>
                <li><a href="index.php">
                    <i class="fa-solid fa-house"></i>
                    <span class="nav-item dashboard">Dashboard</span>
                </a></li>
                <li><a href="st_attendance.php">
                    <i class="fa-solid fa-chart-simple"></i>
                    <span class="nav-item">Attendance</span>
                </a></li>
                <li><a href="#">
                    <i class="fa-solid fa-database"></i>
                    <span class="nav-item">Attendance History</span>
                </a></li>
                <li><a href="st_absent_application.php">
                    <i class="fa-solid fa-users-slash"></i>
                    <span class="nav-item">Absent Application</span>
                </a></li>
                <li><a href="#" class="logout">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span class="nav-item">Log Out</span>
                </a></li>
            </ul>
        </nav>
        <section class="main">
            <div class="main-top">
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="Attendance">
                <div class="attendance-list">
                    <h1>Attendance History</h1>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Session Start</th>
                                <th>Attendance Marked At</th>
                                <th>Module Name</th>
                                <th>Module Owner</th>
                                <th>Lecture Room</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>2024/01/01 13:00</td>
                                <td>2024/01/01 14:10</td>
                                <td>Project Management</td>
                                <td>Dr.Damith Gangodawilage</td>
                                <td>A5</td>
                            </tr>
                            <tr>
                                <td>2023/12/31 14:00</td>
                                <td>2023/12/31 15:40</td>
                                <td>Technology Challenge Competition 1</td>
                                <td>Ms.Kasunika Guruge</td>
                                <td>GF5</td>
                            </tr>
                            <tr>
                                <td>2023/12/30 10:00</td>
                                <td>2023/12/30 11:25</td>                                   
                                <td>Linear Algebra</td>
                                <td>Dr.Chandani Dissanayake</td>
                                <td>FF1</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</body>
</html>
<?php include_once '../Login/session_error.php'; ?>
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
                <li><a href="#">
                    <i class="fa-solid fa-house"></i>
                    <span class="nav-item dashboard">Dashboard</span>
                </a></li>
                <li><a href="st_attendance.php">
                    <i class="fa-solid fa-chart-simple"></i>
                    <span class="nav-item">Attendance</span>
                </a></li>
                <li><a href="st_attendance_history.php">
                    <i class="fa-solid fa-database"></i>
                    <span class="nav-item">Attendance History</span>
                </a></li>
                <li><a href="st_absent_application.php">
                    <i class="fa-solid fa-users-slash"></i>
                    <span class="nav-item">Absent Application</span>
                </a></li>
                <li><a href="../Login/logout.php" class="logout">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span class="nav-item">Log Out</span>
                </a></li>
            </ul>
        </nav>
        <section class="main">
            <div class="main-top">
                <h1>Course Menu</h1>
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="modules">
                <div class="card">
                    <h4>CCS2313</h4>
                    <p>Project Management</p>
                    <div class="per">
                        <table>
                            <tr>
                                <td><span>85%</span></td>
                                <td><span>90%</span></td>
                            </tr>
                            <tr>
                                <td>Month</td>
                                <td>Year</td>
                            </tr>
                        </table>
                    </div>
                    <button>View</button>
                </div>
                <div class="card">
                    <h4>SMA2301</h4>
                    <p>Linear Algebra</p>
                    <div class="per">
                        <table>
                            <tr>
                                <td><span>75%</span></td>
                                <td><span>80%</span></td>
                            </tr>
                            <tr>
                                <td>Month</td>
                                <td>Year</td>
                            </tr>
                        </table>
                    </div>
                    <button>View</button>
                </div>
                <div class="card">
                    <h4>CCS2360</h4>
                    <p>Technology Challenge Competition 1</p>
                    <div class="per">
                        <table>
                            <tr>
                                <td><span>65%</span></td>
                                <td><span>70%</span></td>
                            </tr>
                            <tr>
                                <td>Month</td>
                                <td>Year</td>
                            </tr>
                        </table>
                    </div>
                    <button>View</button> 
                </div>
            </div>
            <div class="modules">
                <div class="card">
                    <h4>SMA2306</h4>
                    <p>Probability and Statistics</p>
                    <div class="per">
                        <table>
                            <tr>
                                <td><span>84%</span></td>
                                <td><span>89%</span></td>
                            </tr>
                            <tr>
                                <td>Month</td>
                                <td>Year</td>
                            </tr>
                        </table>
                    </div>
                    <button>View</button>
                </div>
                <div class="card">
                    <h4>CCS2311</h4>
                    <p>Human Factors in Computer Systems</p>
                    <div class="per">
                        <table>
                            <tr>
                                <td><span>77%</span></td>
                                <td><span>88%</span></td>
                            </tr>
                            <tr>
                                <td>Month</td>
                                <td>Year</td>
                            </tr>
                        </table>
                    </div>
                    <button>View</button>
                </div>
                <div class="card">
                    <h4>CCS2303</h4>
                    <p>Operating Systems and Platforms</p>
                    <div class="per">
                        <table>
                            <tr>
                                <td><span>66%</span></td>
                                <td><span>79%</span></td>
                            </tr>
                            <tr>
                                <td>Month</td>
                                <td>Year</td>
                            </tr>
                        </table>
                    </div>
                    <button>View</button>
                </div>
            </div>
            <div class="upcoming-class">
                <div class="class-list">
                    <h1>Today Classes</h1>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Time</th>
                                <th>Location</th>
                                <th>Module Name</th>
                                <th>Module Owner</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>8.00am-10.00am</td>
                                <td>FF2</td>
                                <td>Project Management</td>
                                <td>Dr.Damith Gangodawilage</td>
                            </tr>
                            <tr>
                                <td>11.00am-1.00pm</td>
                                <td>Mentoring</td>
                                <td>Technology Challenge Competition 1</td>
                                <td>Ms.Kasunika Guruge</td>
                            </tr>
                            <tr>
                                <td>4.00pm-5.00pm</td>
                                <td>GF3</td>
                                <td>Linear Algebra</td>
                                <td>Dr.Chandani Dissanayake</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</body>
</html>
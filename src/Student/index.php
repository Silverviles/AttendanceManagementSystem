<?php include_once '../Login/session_error.php'; ?>
<?php include_once '../php/config.php'; ?>
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
                        <img src="logo.png">
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
            <?php
            // Dummy dataset
            
            $sql = "SELECT
                m.module_code,
                m.module_name,
                (a.times * 100.0 / COUNT(c.module)) AS attendance_percentage
            FROM
                student_to_module stm
                JOIN module m ON stm.module_code = m.module_code
                LEFT JOIN classes c ON stm.module_code = c.module
                JOIN (SELECT module_code, COUNT(id) AS times FROM attendance GROUP BY module_code) a ON m.module_code = a.module_code
            WHERE
                stm.student_id = 'ST123456'
            GROUP BY
                m.module_code,
                m.module_name,
                a.times";

            $result = $conn->query($sql);

            // Number of modules per row
            $modulesPerRow = 3;
            $module = 0;

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    if ($module % 3 == 0) {
                        echo '<div class="modules">';
                    }

                    echo '<div class="card">';
                    echo '<h4>' . $row["module_code"] . '</h4>';
                    echo '<p>' . $row["module_name"] . '</p>';
                    echo '<div class="per">';
                    echo '<table>';
                    echo '<tr><td><span id="module_' . $module . '">' . number_format($row["attendance_percentage"], 1) . '</span>%</td></tr>';
                    echo '<tr><td>Attendance</td></tr>';
                    echo '</table>';
                    echo '</div>';
                    echo '<button>View</button>';
                    echo '</div>';

                    if ($module % 3 == 2) {
                        echo '</div>';
                    }

                    $module++;
                }

                if ($module % 3 != 0) {
                    echo '</div>';
                }
            } else {
                echo 'No Registered Modules';
            }
            ?>

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
    <script>
        window.onload = function () {
            // Function to parse URL parameters
            function getUrlParams() {
                var params = {};
                var queryString = window.location.search;
                var urlParams = new URLSearchParams(queryString);
                for (const [key, value] of urlParams) {
                    params[key] = value;
                }
                return params;
            }

            // Get URL parameters
            var params = getUrlParams();

            // Check if the "success" parameter is set to 1
            if (params.success === "1") {
                // Alert success
                alert("Success!");
            } else if (params.success === '2') {
                alert("Invalid OTP!");
            } else if (params.success === '3') {
                alert("Attendance already marked.");
            } else if (params.success === '-1') {
                alert("Error, Contact administration");
            }

            // Clear the "success" parameter from the URL
            history.replaceState({}, document.title, window.location.pathname);

            // Get all module cards
            const moduleCards = document.querySelectorAll('.card');

            // Iterate over each module card
            moduleCards.forEach(card => {
                // Get the attendance percentage
                const attendance = parseInt(card.querySelector('.per span').innerText);
                // Check if attendance is below 40%
                if (attendance < 40) {
                    // Get module details
                    const moduleCode = card.querySelector('h4').innerText;
                    const moduleName = card.querySelector('p').innerText;
                    // Show alert with module details
                    alert(`Low Attendance Alert!\nModule Code: ${moduleCode}\nModule Name: ${moduleName}\nAttendance: ${attendance}%`);
                }
            });
        }
    </script>
</body>

</html>
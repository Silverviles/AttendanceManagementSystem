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
                <li><a href="index.php">
                    <i class="fa-solid fa-house"></i>
                    <span class="nav-item dashboard">Dashboard</span>
                </a></li>
                <li><a href="st_attendance.php">
                    <i class="fa-solid fa-chart-simple"></i>
                    <span class="nav-item">Attendance</span>
                </a></li>
                <li><a href="#">
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
                <i class="fa-solid fa-user"></i>
                <h1>Absent Application</h1>
            </div>
            <div id="absent-application">
                <form id="absentForm">
                    <label for="date">Date:</label>
                    <input type="date" id="date" name="date" required>
            
                    <label for="numberOfDays">Number of Days:</label>
                    <input type="number" id="numberOfDays" name="numberOfDays" required>
            
                    <label for="studentName">Student Name:</label>
                    <input type="text" id="studentName" name="studentName" required>
            
                    <label for="indexNumber">Student Index Number:</label>
                    <input type="text" id="indexNumber" name="indexNumber" required>
            
                    <label for="reason">Reason:</label>
                    <textarea id="reason" name="reason" rows="4" required></textarea>
            
                    <button type="submit">Submit</button>
                    <button type="reset">Reset</button>
                </form>
            
                <script>
                    document.getElementById("absentForm").addEventListener("submit", function(event) {
                        event.preventDefault();
                        // Add your form submission logic here
                        // You can use JavaScript to handle the form data (e.g., send it to a server)
                        console.log("Form submitted!");
                    });
                </script>
            </div>
        </section>
    </div>
</body>
</html>
<?php include_once '../Login/session_error.php'; ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendify</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="script.js"></script>
</head>

<body>
    <div class="container">
        <nav>
            <ul>
                <li><a href="#" class="logo">
                        <img src="logo.png">
                        <span class="nav-item">Student</span>
                    </a></li>
                <li><a href="index.php">
                        <i class="fa-solid fa-house"></i>
                        <span class="nav-item dashboard">Dashboard</span>
                    </a></li>
                <li><a href="#">
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
                <h1>Make New Attendance</h1>
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="mark-attendance">
                <header>
                    <i class="bx bxs-check-shield"></i>
                </header>
                <h4>Enter OTP Code</h4>
                <form action="../php/mark_attendance.php" method="post">
                    <div class="input-field">
                        <input name="no1" type="number" maxlength="1" oninput="limitToOneCharacter(this)"
                            onkeyup="focusNext(this, 'no2')">
                        <input name="no2" type="number" maxlength="1" oninput="limitToOneCharacter(this)"
                            onkeyup="focusNext(this, 'no3')">
                        <input name="no3" type="number" maxlength="1" oninput="limitToOneCharacter(this)"
                            onkeyup="focusNext(this, 'no4')">
                        <input name="no4" type="number" maxlength="1" oninput="limitToOneCharacter(this)">
                    </div>
                    <button type="submit" class="submit-otp">Verify OTP</button>
                </form>
            </div>
        </section>
    </div>
    <script>
        function focusNext(currentInput, nextInputName) {
            var maxLength = parseInt(currentInput.getAttribute('maxlength'));
            var currentLength = currentInput.value.length;
            if (currentLength >= maxLength) {
                var nextInput = document.getElementsByName(nextInputName)[0];
                if (nextInput) {
                    nextInput.focus();
                }
            }
        }

        function limitToOneCharacter(input) {
            // Get the value of the input
            let value = input.value;

            // If the value has more than one character, truncate it to one character
            if (value.length > 1) {
                input.value = value.slice(0, 1);
            }
        }
    </script>
</body>

</html>
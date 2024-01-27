<?php
    include_once '../php/config.php';
    include_once '../php/userData.php';
?>
<div class="admin_content" id="admin_dashboard">
    <div id="stat-buttons">
        <button id="student_button" class="button-17">
            <div style="color: grey"><b><?php echo getCount($conn, "student") ?><b></div>
            <div><b>Students<b></div>
        </button>
        <button id="lecturer_button" class="button-17">
            <div style="color: grey"><b><?php echo getCount($conn, "lecturer") ?><b></div>
            <div><b>Lecturers<b></div>
        </button>
        <button id="module_button" class="button-17">
            <div style="color: grey"><b><?php echo getCount($conn, "module") ?><b></div>
            <div><b>Modules<b></div>
        </button>
    </div>
    <div id="calendar_logo">
        <div class="calendar" id="admin_calendar"></div>
        <div class="big_logo">
            <img src="../images/logo.jpg" alt="logo">
        </div>
    </div>
</div>
<?php $conn->close(); ?>
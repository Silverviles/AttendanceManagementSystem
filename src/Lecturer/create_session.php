<?php include_once '../php/config.php'; ?>
<?php include_once '../php/config.php'; ?>
<div class="lecturer_content" id="lecturer_session">
    <h2>Add Class</h2>
    <form action="../php/insert_class.php" method="post">
        <label for="duration">Duration (0:00 - 6:00):</label>
        <input type="time" id="duration" name="duration" min="00:00" max="06:00" value="01:00" required><br><br>


        <label for="locations">Locations:</label>
        <input type="text" id="locations" name="locations" required><br><br>

        <!-- Dropdown for Lecturer -->
        <label for="lecturer">Lecturer:</label>
        <select id="lecturer" name="lecturer" required>
            <?php

            // Fetch lecturer data from the database
            $query = "SELECT user_id, lecturer_id FROM lecturer";
            $result = mysqli_query($conn, $query);

            // Populate dropdown options
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='" . $row['lecturer_id'] . "'>" . $row['lecturer_id'] . "</option>";
            }
            ?>
        </select><br><br>

        <!-- Dropdown for Module -->
        <label for="module">Module:</label>
        <select id="module" name="module" required>
            <?php

            // Fetch module data from the database
            $query = "SELECT module_code, module_name FROM module";
            $result = mysqli_query($conn, $query);

            // Populate dropdown options
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='" . $row['module_code'] . "'>" . $row['module_name'] . "</option>";
            }
            ?>
        </select><br><br>

        <label for="batch">Batch:</label>
        <input type="text" id="batch" name="batch" required><br><br>

        <label for="date">Date and Time:</label>
        <input type="datetime-local" id="date" name="date" required><br><br>

        <input type="submit" value="Submit">
    </form>
</div>
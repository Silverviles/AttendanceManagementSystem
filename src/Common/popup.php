<dialog id="dialog_faculty" class="dialog">
    <div style="display: flex; justify-content: center;">
        <h2>Add New Course</h2>
        <button class="close_popup" style="float: right;">X</button>
    </div>
    <form id="courseForm">
        <label for="course_id">Course Code</label><br>
        <input type="text" name="course_id" id="course_id" required><br>

        <label for="course_name">Course Name</label><br>
        <input type="text" name="course_name" id="course_name" required><br>

        <label for="faculty_course">Faculty</label><br>
        <select name="faculty" id="faculty_course"></select><br>

        <input type="submit" value="Add Course" id="add_course_done">
    </form>
</dialog>

<dialog id="dialog_module" class="dialog">
    <div style="display: flex; justify-content: center;">
        <h2>Add New Module</h2>
        <button class="close_popup" style="float: right;">X</button>
    </div>
    <form id="moduleForm">
        <label for="module_code">Module Code</label><br>
        <input type="text" name="module_code" id="module_code" required><br>

        <label for="module_name">Module Name</label><br>
        <input type="text" name="module_name" id="module_name" required><br>

        <label for="faculty_module">Faculty</label><br>
        <select name="faculty" id="faculty_module"></select><br>

        <label for="module_owner_module">Module Owner</label><br>
        <select name="module_owner" id="module_owner_module"></select><br>

        <label for="degree_module">Degree</label><br>
        <select name="degree" id="degree_module"></select><br>

        <input type="submit" value="Add Module" id="add_module_done">
    </form>
</dialog>

<dialog id="dialog_lecturer" class="dialog">
    <div style="display: flex; justify-content: center;">
        <h2>Add New Lecturer</h2>
        <button class="close_popup" style="float: right;">X</button>
    </div>
    <form id="lecturerForm">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" required><br>

        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <label for="contact_no">Contact Number:</label>
        <input type="text" name="contact_no" required><br>

        <label for="lecturer_id">Lecturer ID:</label>
        <input type="text" name="lecturer_id" required><br>

        <label for="faculty_lecturer">Faculty</label><br>
        <select name="faculty" id="faculty_lecturer"></select><br>

        <input type="submit" value="Add Lecturer" id="add_lecturer_done">
    </form>
</dialog>

<dialog id="dialog_student" class="dialog">
    <div style="display: flex; justify-content: center;">
        <h2>Add New Student</h2>
        <button class="close_popup" style="float: right;">X</button>
    </div>
    <form id="studentForm">
        <label for="username">Username</label><br>
        <input type="text" name="username" id="username" required><br>

        <label for="password">Password</label><br>
        <input type="password" name="password" id="password" required><br>

        <label for="first_name">First Name</label><br>
        <input type="text" name="first_name" id="first_name" required><br>

        <label for="last_name">Last Name</label><br>
        <input type="text" name="last_name" id="last_name" required><br>

        <label for="email">Email</label><br>
        <input type="email" name="email" id="email" required><br>

        <label for="contact_no">Contact Number</label><br>
        <input type="text" name="contact_no" id="contact_no" required><br>

        <label for="student_id">Student ID</label><br>
        <input type="text" name="student_id" id="student_id" required><br>

        <label for="faculty_student">Faculty</label><br>
        <select name="faculty" id="faculty_student"></select><br>

        <label for="degree_student">Degree</label><br>
        <select name="degree" id="degree_student"></select><br>

        <label for="batch">Batch</label><br>
        <input type="text" name="batch" id="batch" required><br>

        <input type="submit" value="Add Student" id="add_student_done">
    </form>
</dialog>
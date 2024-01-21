<div class="admin_content" id="admin_students">
    <div class="flex-container">
        <div>
            <label for="studentFilter">Students</label>
        </div>
        <div class="filter-container" style="padding-bottom: 10px">
            <label for="studentCodeFilter">Filter by Student Code:</label>
            <input type="text" id="studentCodeFilter" oninput="filterStudents()">
        </div>
    </div>
    <div style="display: flex; justify-content: right; margin-bottom: 2%;">
        <button class="button-65" id="add_student_btn">Add Student</button>
    </div>
    <div id="studentDetails"></div>
</div>

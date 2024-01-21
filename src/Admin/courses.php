<div class="admin_content" id="admin_courses">
    <div class="flex-container">
        <div>
            <label for="facultyFilter">All Courses</label>
        </div>
        <div classs="filter-container" style="padding-bottom: 10px">
            <label for="facultyFilter">Filter by Faculty:</label>
            <input type="text" id="facultyFilter" oninput="filterDegrees()">
        </div>
    </div>
    <div style="display: flex; justify-content: right; margin-bottom: 2%;">

        <button class="button-65" id="add_course_btn">Add Course</button>
    </div>
    <div class="details_t" id="degreeDetails"></div>
</div>
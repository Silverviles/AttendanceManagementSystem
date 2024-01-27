<div class="admin_content" id="admin_lecturers">
    <div class="flex-container">
        <div>
            <label for="lecturerFilter">Lecturers</label>
        </div>
        <div class="filter-container" style="padding-bottom: 10px">
            <label for="lecturerCodeFilter">Filter by Lecturer Code:</label>
            <input type="text" id="lecturerCodeFilter" oninput="filterLecturers()">
        </div>
    </div>
    <div style="display: flex; justify-content: right; margin-bottom: 2%;">
        <button class="button-65" id="add_lecturer_btn">Add Lecturer</button>
    </div>
    <div id="lecturerDetails"></div>
</div>

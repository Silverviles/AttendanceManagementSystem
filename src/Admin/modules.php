<div class="admin_content" id="admin_modules">
    <div class="flex-container">
        <div>
            <label for="moduleFilter">Modules</label>
        </div>
        <div classs="filter-container" style="padding-bottom: 10px">
            <label for="moduleCodeFilter">Filter by Module Code:</label>
            <input type="text" id="moduleCodeFilter" oninput="filterModules()">
        </div>
    </div>
    <div style="display: flex; justify-content: right; margin-bottom: 2%;">

        <button class="button-65" id="add_module_btn">Add Module</button>
    </div>
    <div id="moduleDetails"></div>
</div>
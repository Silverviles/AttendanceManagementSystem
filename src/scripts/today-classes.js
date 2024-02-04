// Function to make an XHR request to fetch class details
function fetchClassesData(callback) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var classesData = JSON.parse(xhr.responseText);
                callback(classesData);
            } else {
                console.error('Failed to fetch classes data: ' + xhr.status);
            }
        }
    };
    xhr.open('GET', '../php/get_classes.php', true);
    xhr.send();
}

// Function to populate the div with today's classes
function populateTodayClasses(classesData) {
    var divTodayClasses = document.querySelector('.today_classes');
    divTodayClasses.innerHTML = ''; // Clear previous content

    // Create a table element
    var table = document.createElement('table');
    table.className = 'details_t';

    // Create table header
    var thead = document.createElement('thead');
    var headerRow = document.createElement('tr');
    var headers = ['Duration', 'Location', 'Module', 'Lecturer', 'Batch', 'Attendance'];
    var action = document.createElement('th');
    action.textContent = 'Action';
    headers.forEach(function (headerText) {
        var th = document.createElement('th');
        th.textContent = headerText;
        headerRow.appendChild(th);
    });
    action.className = 'action-column';
    headerRow.appendChild(action);
    thead.appendChild(headerRow);
    table.appendChild(thead);

    // Create table body
    var tbody = document.createElement('tbody');
    classesData.forEach(function (classInfo) {
        // Check if the class is scheduled for today
        if (isToday(classInfo.date)) {
            var row = document.createElement('tr');

            // Populate table row with class details
            Object.keys(classInfo).forEach(function (key) {
                var cell = document.createElement('td');
                cell.textContent = classInfo[key];
                cell.className = key;
                row.appendChild(cell);
            });

            // Create attendance button cell
            var attendanceCell = document.createElement('td');
            var attendanceButton = document.createElement('button');
            attendanceButton.className = 'action-buttons';
            attendanceButton.textContent = 'Attendance';
            attendanceButton.className = 'attendance-btn';
            attendanceButton.type = 'button';
            attendanceCell.appendChild(attendanceButton);
            row.appendChild(attendanceCell);

            // Append the row to the table body
            tbody.appendChild(row);
        }
    });
    table.appendChild(tbody);

    // Append the table to the div
    divTodayClasses.appendChild(table);
}

// Function to check if a date is today
function isToday(dateString) {
    var today = new Date();
    var date = new Date(dateString);
    return date.getDate() === today.getDate() &&
        date.getMonth() === today.getMonth() &&
        date.getFullYear() === today.getFullYear();
}

document.addEventListener('DOMContentLoaded', function () {
    // Fetch classes data and populate the div when the page is loaded
    fetchClassesData(populateTodayClasses);
});

// Add click event listener to the document and listen for clicks on elements with the class "attendance-btn"
document.addEventListener("click", function (event) {
    if (event.target.classList.contains("attendance-btn")) {
        var button = event.target;
        var row = button.closest('tr'); // Find the closest <tr> element

        // Extract the values from the relevant row
        var duration = row.querySelector('.duration').textContent;
        var locations = row.querySelector('.locations').textContent;
        var module = row.querySelector('.module').textContent;
        var lecturer = row.querySelector('.lecturer').textContent;
        var batch = row.querySelector('.batch').textContent;
        var date = row.querySelector('.date').textContent;

        // Construct the URL with data parameters
        var url = "../php/generate_otp.php?duration=" + duration + "&locations=" + locations + "&module=" + module + "&lecturer=" + lecturer + "&batch=" + batch + "&date=" + date;

        // Redirect to the "otp.php" page with the data parameters
        window.location.href = url;
    }
});

function getLecturerDetails() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '../php/get_lecturers.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                
                var lecturers = JSON.parse(xhr.responseText);
                displayLecturerDetails(lecturers);
            } else {
                console.error('Error fetching lecturer details:', xhr.statusText);
            }
        }
    };

    xhr.send();
}

function getLecturersWithNoModules(){
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '../php/get_lecturers_no_modules.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                
                var lecturers = JSON.parse(xhr.responseText);
                displayLecturerDetails(lecturers);
            } else {
                console.error('Error fetching lecturer details:', xhr.statusText);
            }
        }
    };

    xhr.send();
}

function displayLecturerDetails(lecturers) {
    var html = '<table border="1" class="details_t" id="lecturer_details_t"><thead><tr><th>Lecturer Code</th><th>Lecturer Name</th><th>Faculty</th></tr></thead><tbody>';

    lecturers.forEach(function (lecturer) {
        html += '<tr><td>' + lecturer.lecturer_id + '</td><td>' + lecturer.lecturer_name + '</td><td>' + lecturer.faculty + '</td></tr>';
    });

    html += '</tbody></table>';

    document.getElementById('lecturerDetails').innerHTML = html;
}

function filterLecturers() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("lecturerCodeFilter");
    filter = input.value.toUpperCase();
    table = document.getElementById("lecturer_details_t");
    tr = table.getElementsByTagName("tr");

    // Loop through all table rows, and hide those that don't match the filter
    for (i = 1; i < tr.length; i++) { // Start from 1 to skip the header row
        td = tr[i].getElementsByTagName("td")[0]; // Assuming lecturer_code is in the first column (index 0)
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

document.addEventListener('DOMContentLoaded', getLecturerDetails);

document.getElementById("add_lecturer_btn").addEventListener('click', function () {
    document.getElementById("dialog_lecturer").style.display = "block";
});

document.getElementById("add_lecturer_done").addEventListener('click', function () {
    document.getElementById("dialog_lecturer").style.display = "none";
    getLecturerDetails();
});

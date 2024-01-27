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

function getLecturersWithNoModules() {
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
    if (lecturers !== null && lecturers.length > 0) {
        var html = '<table border="1" class="details_t" id="lecturer_details_t"><thead><tr><th>Lecturer Code</th><th>Lecturer Name</th><th>Faculty</th><th class="action-column">Action</th></tr></thead><tbody>';

        lecturers.forEach(function (lecturer) {
            html += '<tr><td>' + lecturer.lecturer_id + '</td><td>' + lecturer.lecturer_name + '</td><td>' + lecturer.faculty + '</td>';

            // Edit and Delete buttons within the same column
            html += '<td class="action-buttons">';

            // Edit button form
            html += '<button class="button-65 edit-button-lecturer" data-lecturer-id="' + lecturer.lecturer_id + '">Edit</button>';

            // Delete button form with JavaScript click event
            html += '<button class="button-65 delete-button-lecturer" data-lecturer-id="' + lecturer.lecturer_id + '">Delete</button></td></tr>';
        });

        html += '</tbody></table>';
    } else {
        var html = "<p>No lecturers found.</p>";
    }

    // Display the lecturer details in the #lecturerDetails div
    document.getElementById('lecturerDetails').innerHTML = html;

    // Add click event listeners to Delete buttons
    var deleteButtons = document.querySelectorAll('.delete-button-lecturer');
    deleteButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            var lecturerId = this.getAttribute('data-lecturer-id');
            confirmAndDeleteLecturer(lecturerId);
        });
    });

    // Add click event listeners to Edit buttons for lecturers
    var editButtons = document.querySelectorAll('.edit-button-lecturer');

    editButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            var lecturerId = this.getAttribute('data-lecturer-id');
            openEditLecturerPopup(lecturerId);
        });
    });

}

function confirmAndDeleteLecturer(lecturerId) {
    if (confirm('Are you sure you want to delete?')) {
        // Perform AJAX request to delete.php
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../php/delete.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Handle the response if needed
                console.log(xhr.responseText);
                getLecturerDetails();
            }
        };
        xhr.send('lecturer_id=' + lecturerId);
    }
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

document.addEventListener('DOMContentLoaded', function () {
    document.getElementById("add_lecturer_btn").addEventListener('click', function () {
        document.getElementById("dialog_lecturer").style.display = "block";
        var addLecturerDoneButton = document.getElementById('edit_lecturer_done');
        // Check if the element exists
        if (addLecturerDoneButton) {
            // Update the ID attribute
            addLecturerDoneButton.id = 'add_lecturer_done';
            addLecturerDoneButton.value = "Add Lecturer";
            addLecturerDoneButton.name = 'add_lecturer_done';
        }
    });

    document.getElementById("add_lecturer_done").addEventListener('click', function () {
        document.getElementById("dialog_lecturer").style.display = "none";
        getLecturerDetails();
    });
});

function openEditLecturerPopup(lecturerId) {
    // Fetch lecturer details using lecturerId
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '../php/get_lecturers.php?lecturer_id=' + lecturerId, true);
    xhr.setRequestHeader('Content-Type', 'application/json');

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var lecturerDetails = JSON.parse(xhr.responseText);
                populateLecturerPopup(lecturerDetails);
            } else {
                console.error('Error fetching lecturer details:', xhr.statusText);
            }
        }
    };

    xhr.send();
}

function populateLecturerPopup(lecturerDetails) {
    // Populate the dialog form with lecturer details
    var dialog = document.getElementById('dialog_lecturer');
    var lecturerForm = document.getElementById('lecturerForm');

    // Show the dialog
    dialog.style.display = "block";

    // Set form fields with lecturer details
    lecturerForm.elements['username'].value = lecturerDetails[0].username;
    lecturerForm.elements['password'].value = lecturerDetails[0].password;
    lecturerForm.elements['first_name'].value = lecturerDetails[0].first_name;
    lecturerForm.elements['last_name'].value = lecturerDetails[0].last_name;
    lecturerForm.elements['email'].value = lecturerDetails[0].email;
    lecturerForm.elements['contact_no'].value = lecturerDetails[0].contact_no;
    lecturerForm.elements['lecturer_id'].value = lecturerDetails[0].lecturer_id;

    // Update the ID, value, and name attributes of the submit button
    var addLecturerDoneButton = document.getElementById('add_lecturer_done');
    if (addLecturerDoneButton) {
        addLecturerDoneButton.id = 'edit_lecturer_done';
        addLecturerDoneButton.value = 'Edit Lecturer';
        addLecturerDoneButton.name = 'edit_lecturer_done';
    }
}

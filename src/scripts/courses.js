function getDegreeDetails() {
    var url = '../php/get_degrees.php';

    var xhr = new XMLHttpRequest();
    xhr.open('GET', url, true);
    xhr.setRequestHeader('Content-Type', 'application/json');

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                if (xhr.responseText.trim() !== "No degrees") {
                    var response = JSON.parse(xhr.responseText);
                    displayDegreeDetails(response);
                } else {
                    displayDegreeDetails(null);
                }
            } else {
                console.error('Error fetching degree details:', xhr.statusText);
            }
        }
    };

    xhr.send();
}


function displayDegreeDetails(degrees) {
    if (degrees !== null) {
        var html = '<table border="1" class="details_t" id="degree_details_t"><thead><tr><th>Degree ID</th><th>Degree Name</th><th>Faculty</th><th class="action-column">Action</th></tr></thead><tbody>';

        degrees.forEach(function (degree) {
            html += '<tr><td>' + degree.degree_id + '</td><td>' + degree.degree_name + '</td><td>' + degree.faculty + '</td>';

            // Edit and Delete buttons within the same column
            html += '<td class="action-buttons">';

            // Edit button form
            html += '<input type="hidden" name="degree_id" value="' + degree.degree_id + '">';
            // Inside displayDegreeDetails function
            html += '<button class="button-65 edit-button-degree" data-degree-id="' + degree.degree_id + '">Edit</button>';


            // Delete button form with JavaScript click event
            html += '<button class="button-65 delete-button-degree" data-degree-id="' + degree.degree_id + '">Delete</button></td></tr>';
        });

        html += '</tbody></table>';
    } else {
        var html = "<p>No degrees found.</p>";
    }

    // Display the degree details in the #degreeDetails div
    document.getElementById('degreeDetails').innerHTML = html;

    // Add click event listeners to Delete buttons
    var deleteButtons = document.querySelectorAll('.delete-button-degree');
    deleteButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            var degreeId = this.getAttribute('data-degree-id');
            confirmAndDelete(degreeId);
        });
    });

    // Add click event listeners to Edit buttons
    var editButtons = document.querySelectorAll('.edit-button-degree');

    editButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            var degreeId = this.getAttribute('data-degree-id');
            openEditPopup(degreeId);
        });
    });
}

function confirmAndDelete(degreeId) {
    if (confirm('Are you sure you want to delete?')) {
        // Perform AJAX request to delete.php
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../php/delete.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Handle the response if needed
                console.log(xhr.responseText);
                getDegreeDetails();
                getModuleDetails();
            }
        };
        xhr.send('degree_id=' + degreeId);
    }
}


function filterDegrees() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("facultyFilter");
    filter = input.value.toUpperCase();
    table = document.getElementById("degree_details_t");
    tr = table.getElementsByTagName("tr");

    // Loop through all table rows, and hide those that don't match the filter
    for (i = 1; i < tr.length; i++) { // Start from 1 to skip the header row
        td = tr[i].getElementsByTagName("td")[2]; // Assuming faculty is in the third column (index 2)
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
    document.getElementById("add_course_btn").addEventListener('click', function () {
        document.getElementById("dialog_faculty").style.display = "block";
        var addCourseDoneButton = document.getElementById('edit_course_done');
        // Check if the element exists
        if (addCourseDoneButton) {
            // Update the ID attribute
            addCourseDoneButton.id = 'add_course_done';
            addCourseDoneButton.value = "Add Course";
            addCourseDoneButton.name = 'add_course_done';
        }
    });

    document.getElementById("add_course_done").addEventListener('click', function () {
        document.getElementById("dialog_faculty").style.display = "none";
        getDegreeDetails();
    });
});


function openEditPopup(degreeId) {
    // Fetch degree details using degreeId
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '../php/get_degrees.php?degree_id=' + degreeId, true);
    xhr.setRequestHeader('Content-Type', 'application/json');

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var degreeDetails = JSON.parse(xhr.responseText);
                populatePopup(degreeDetails);
            } else {
                console.error('Error fetching degree details:', xhr.statusText);
            }
        }
    };

    xhr.send();
}

function populatePopup(degreeDetails) {
    // Populate the dialog form with degree details
    var dialog = document.getElementById('dialog_faculty');
    var courseForm = document.getElementById('courseForm');

    // Show the dialog
    dialog.style.display = "block";

    // Set form fields with degree details
    courseForm.elements['course_id'].value = degreeDetails[0].degree_id;
    courseForm.elements['course_name'].value = degreeDetails[0].degree_name;
    var addCourseDoneButton = document.getElementById('add_course_done');
    // Check if the element exists
    if (addCourseDoneButton) {
        // Update the ID attribute
        addCourseDoneButton.id = 'edit_course_done';
        addCourseDoneButton.value = 'Edit Course';
        addCourseDoneButton.name = 'edit_course_done';
    }
}



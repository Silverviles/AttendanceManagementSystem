function getDegreeDetails() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '../php/get_degrees.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                displayDegreeDetails(response);
            } else {
                console.error('Error fetching degree details:', xhr.statusText);
            }
        }
    };

    xhr.send();
}

function displayDegreeDetails(degrees) {
    var html = '<table border="1" class="details_t" id="degree_details_t"><thead><tr><th>Degree ID</th><th>Degree Name</th><th>Faculty</th><th class="action-column">Action</th></tr></thead><tbody>';

    degrees.forEach(function (degree) {
        html += '<tr><td>' + degree.degree_id + '</td><td>' + degree.degree_name + '</td><td>' + degree.faculty + '</td>';

        // Edit and Delete buttons within the same column
        html += '<td class="action-buttons">';
        
        // Edit button form
        html += '<form action="/edit-degree" method="post">';
        html += '<input type="hidden" name="degree_id" value="' + degree.degree_id + '">';
        html += '<button class="button-65" type="submit">Edit</button></form>';

        // Delete button form with JavaScript click event
        html += '<button class="button-65 delete-button" data-degree-id="' + degree.degree_id + '">Delete</button></td></tr>';
    });

    html += '</tbody></table>';

    // Display the degree details in the #degreeDetails div
    document.getElementById('degreeDetails').innerHTML = html;

    // Add click event listeners to Delete buttons
    var deleteButtons = document.querySelectorAll('.delete-button');
    deleteButtons.forEach(function (button) {
        button.addEventListener('click', function() {
            var degreeId = this.getAttribute('data-degree-id');
            confirmAndDelete(degreeId);
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
    });

    document.getElementById("add_course_done").addEventListener('click', function () {
        document.getElementById("dialog_faculty").style.display = "none";
        getDegreeDetails();
    });
});
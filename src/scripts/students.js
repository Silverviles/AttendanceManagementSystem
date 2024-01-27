function getStudentDetails() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '../php/get_students.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var students = JSON.parse(xhr.responseText);
                displayStudentDetails(students);
            } else {
                console.error('Error fetching student details:', xhr.statusText);
            }
        }
    };

    xhr.send();
}

function confirmAndDeleteStudent(studentId) {
    if (confirm('Are you sure you want to delete?')) {
        // Perform AJAX request to delete.php or any appropriate endpoint
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../php/delete.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Handle the response if needed
                console.log(xhr.responseText);
                getStudentDetails(); // Update student details after deletion
            }
        };
        xhr.send('student_id=' + studentId);
    }
}

function displayStudentDetails(students) {
    var html = '<table border="1" class="details_t" id="student_details_t"><thead><tr><th>Student ID</th><th>Student Name</th><th>Faculty</th><th class="action-column">Action</th></tr></thead><tbody>';

    students.forEach(function (student) {
        html += '<tr><td>' + student.student_id + '</td><td>' + student.student_name + '</td><td>' + student.faculty + '</td>';

        // Edit and Delete buttons within the same column
        html += '<td class="action-buttons"><form action="/edit-student" method="post">';
        html += '<input type="hidden" name="student_id" value="' + student.student_id + '">';
        html += '<button class="button-65" type="submit">Edit</button></form>';

        html += '<button class="button-65 delete-button-student" data-student-id="' + student.student_id + '">Delete</button></td></tr>';
    });

    html += '</tbody></table>';

    document.getElementById('studentDetails').innerHTML = html;

    // Add click event listeners to Delete buttons
    var deleteButtons = document.querySelectorAll('.delete-button-student');
    deleteButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            var studentId = this.getAttribute('data-student-id');
            confirmAndDeleteStudent(studentId);
        });
    });
}


function filterStudents() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("studentCodeFilter");
    filter = input.value.toUpperCase();
    table = document.getElementById("student_details_t");
    tr = table.getElementsByTagName("tr");

    // Loop through all table rows, and hide those that don't match the filter
    for (i = 1; i < tr.length; i++) { // Start from 1 to skip the header row
        td = tr[i].getElementsByTagName("td")[0]; // Assuming student_id is in the first column (index 0)
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

document.getElementById("add_student_btn").addEventListener('click', function () {
    document.getElementById("dialog_student").style.display = "block";
});

document.getElementById("add_student_done").addEventListener('click', function () {
    document.getElementById("dialog_student").style.display = "none";
    getStudentDetails();
});

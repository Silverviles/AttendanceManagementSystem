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

function displayStudentDetails(students) {
    var html = '<table border="1" class="details_t" id="student_details_t"><thead><tr><th>Student ID</th><th>Student Name</th><th>Faculty</th></tr></thead><tbody>';

    students.forEach(function (student) {
        html += '<tr><td>' + student.student_id + '</td><td>' + student.student_name + '</td><td>' + student.faculty + '</td></tr>';
    });

    html += '</tbody></table>';

    document.getElementById('studentDetails').innerHTML = html;
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

document.addEventListener('DOMContentLoaded', getStudentDetails);

document.getElementById("add_student_btn").addEventListener('click', function () {
    document.getElementById("dialog_student").style.display = "block";
});

document.getElementById("add_student_done").addEventListener('click', function () {
    document.getElementById("dialog_student").style.display = "none";
    getStudentDetails();
});

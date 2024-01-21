function fetchAndPopulateDropdown(url, dropdownId, dropdownExtend = null) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', url, true);
    xhr.setRequestHeader('Content-Type', 'application/json');

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var data = JSON.parse(xhr.responseText);
                // Populate the dropdown menu
                var dropdown = dropdownExtend != null ? document.getElementById(dropdownId + "_" + dropdownExtend) : document.getElementById(dropdownId);
                data.forEach(function (item) {
                    var option = document.createElement('option');
                    switch (dropdownId) {
                        case "faculty": option.value = item.faculty_id;
                            option.textContent = item.faculty_name;
                            break;
                        case "degree": option.value = item.degree_id;
                            option.textContent = item.degree_name;
                            break;
                        case "module_owner" : option.value = item.user_id;
                            option.textContent = item.lecturer_id;
                            break;
                    }
                    dropdown.appendChild(option);
                });
            } else {
                console.error('Error fetching data:', xhr.statusText);
            }
        }
    };

    xhr.send();
}

document.addEventListener('DOMContentLoaded', function () {
    // Fetch and populate faculty dropdown on document load
    fetchAndPopulateDropdown('../php/get_faculties.php', 'faculty', 'course');
    fetchAndPopulateDropdown('../php/get_faculties.php', 'faculty', 'module');
    fetchAndPopulateDropdown('../php/get_faculties.php', 'faculty', 'lecturer');
    fetchAndPopulateDropdown('../php/get_faculties.php', 'faculty', 'student');

    // Fetch and populate degree dropdown on document load
    fetchAndPopulateDropdown('../php/get_degrees.php', 'degree', 'module');
    fetchAndPopulateDropdown('../php/get_degrees.php', 'degree', 'student');

    fetchAndPopulateDropdown('../php/get_lecturers_no_modules.php', 'module_owner', 'module');

    getDegreeDetails();
    getModuleDetails();
    getLecturerDetails();
    getStudentDetails();
});

function handleFormSubmission(formId, url, callback) {
    document.getElementById(formId).addEventListener('submit', function (event) {
        event.preventDefault();

        // Gather form data
        var formData = new FormData(this);

        // Send AJAX request
        var xhr = new XMLHttpRequest();
        xhr.open('POST', url, true);
        xhr.setRequestHeader('Accept', 'application/json');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    console.log(xhr.responseText);

                    // You can handle the response as needed
                    if (typeof callback === 'function') {
                        console.log(callback);
                        callback(); // Invoke the callback function if provided
                    }
                } else {
                    console.error('Error:', xhr.statusText);
                }
            }
        };

        xhr.send(formData);
    });
}

// Handle course form submission
handleFormSubmission('courseForm', '../php/add_degree.php', getDegreeDetails);

// Handle module form submission
handleFormSubmission('moduleForm', '../php/add_module.php', getModuleDetails);

// Handle lecturer form submission
handleFormSubmission('lecturerForm', '../php/add_lecturer.php', getLecturerDetails);

// Handle student form submission
handleFormSubmission('studentForm', '../php/add_student.php', getStudentDetails);
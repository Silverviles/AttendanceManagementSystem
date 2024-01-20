<dialog id="dialog">
    <h2>Add New Course</h2>
    <form id="courseForm">
        <label for="course_id">Course Code</label>
        <input type="text" name="course_id" id="course_id" required><br>

        <label for="course_name">Course Name</label>
        <input type="text" name="course_name" id="course_name" required><br>

        <label for="faculty">Faculty</label>
        <select name="faculty" id="faculty"></select><br>

        <input type="submit" value="Add Course" id="add_course_done">
    </form>

    <script>
        // Send AJAX request when the DOM is ready
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '../php/get_faculties.php', true);
        xhr.setRequestHeader('Content-Type', 'application/json');

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    var facultyData = JSON.parse(xhr.responseText);
                    console.log(facultyData);

                    // Populate the faculty dropdown menu
                    var facultyDropdown = document.getElementById('faculty');
                    facultyData.forEach(function (faculty) {
                        var option = document.createElement('option');
                        option.value = faculty.faculty_id;
                        option.textContent = faculty.faculty_name;
                        facultyDropdown.appendChild(option);
                    });

                    // Optional: Add an event listener to update the course name based on the selected faculty
                    facultyDropdown.addEventListener('change', function () {
                        var selectedFacultyId = this.value;
                        // Implement logic to fetch and set the corresponding course name based on the selected faculty
                        // For simplicity, you may consider making another AJAX request to get the course name.
                        // Update the #course_name field accordingly.
                    });
                } else {
                    console.error('Error fetching faculty data:', xhr.statusText);
                }
            }
        };

        xhr.send();

        // Prevent the default form submission and implement your own logic to handle the data
        document.getElementById('courseForm').addEventListener('submit', function (event) {
            event.preventDefault();
            // Send AJAX request when the form is submitted
            event.preventDefault(); // Prevent default form submission

            // Gather form data
            var formData = new FormData(this);

            // Send AJAX request
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '../php/add_degree.php', true);
            xhr.setRequestHeader('Accept', 'application/json');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        console.log(xhr.responseText);

                        // You can handle the response as needed
                    } else {
                        console.error('Error:', xhr.statusText);
                    }
                }
            };

            xhr.send(formData);

            getDegreeDetails();
        });
    </script>
    <script src="../scripts/courses.js"></script>
</dialog>


<style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap");

    :root {
        --vs-primary: 29 92 255;
    }

    /*Dialog Styles*/
    dialog {
        padding: 1rem 3rem;
        background: white;
        width: 40%;
        top: 25%;
        left: 30%;
        padding-top: 2rem;
        border-radius: 20px;
        border: 0;
        box-shadow: 0 5px 30px 0 rgb(0 0 0 / 10%);
        animation: fadeIn 1s ease both;
        z-index: 1000;

        &::backdrop {
            animation: fadeIn 1s ease both;
            background: rgb(255 255 255 / 40%);
            z-index: 2;
            backdrop-filter: blur(20px);
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }
</style>
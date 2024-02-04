document.addEventListener("DOMContentLoaded", function (event) {
    // Hide all elements with the class 'admin_content' by default
    var lecturerContents = document.getElementsByClassName('lecturer_content');
    for (var i = 0; i < lecturerContents.length; i++) {
        lecturerContents[i].style.display = 'none';
    }

    // Display the default lecturer dashboard
    document.getElementById("lecturer_dashboard").style.display = "block"

    // Function to toggle the navbar
    const showNavbar = (toggleId, navId, bodyId, headerId) => {
        const toggle = document.getElementById(toggleId),
            nav = document.getElementById(navId),
            bodypd = document.getElementById(bodyId),
            headerpd = document.getElementById(headerId)

        // Validate that all variables exist
        if (toggle && nav && bodypd && headerpd) {
            toggle.addEventListener('click', () => {
                // show navbar
                nav.classList.toggle('show')
                // change icon
                toggle.classList.toggle('bx-x')
                // add padding to body
                bodypd.classList.toggle('body-pd')
                // add padding to header
                headerpd.classList.toggle('body-pd')
            })
        }
    }

    // Call the showNavbar function with appropriate IDs for lecturer navbar
    showNavbar('header-toggle', 'nav-bar', 'body-pd', 'header')

    // Function to handle link color
    const linkColor = document.querySelectorAll('.nav_link')

    function colorLink() {
        if (linkColor) {
            linkColor.forEach(l => l.classList.remove('active'))
            this.classList.add('active')
        }
    }
    linkColor.forEach(l => l.addEventListener('click', colorLink));

    // Update header text and display corresponding content on link click
    var headerText = document.getElementById("header_text");

    // Iterate through each navigation link and attach a click event listener
    for (var i = 0; i < linkColor.length; i++) {
        linkColor[i].addEventListener('click', function (event) {
            // Prevent the default behavior of the anchor tag
            event.preventDefault();

            var dialogs = document.querySelectorAll("dialog");

            dialogs.forEach(function (dialog) {
                dialog.style.display = "none";
            });

            // Hide all elements with the class 'lecturer_content'
            var lecturerContents = document.getElementsByClassName('lecturer_content');
            for (var j = 0; j < lecturerContents.length; j++) {
                lecturerContents[j].style.display = 'none';
            }

            // Determine which content to display based on the clicked link's ID
            switch (this.id) {
                case "dashboard_nav":
                    document.getElementById("lecturer_dashboard").style.display = "block";
                    headerText.textContent = "Dashboard";
                    break;
                case "attendance_history_nav":
                    document.getElementById("lecturer_attendance_history").style.display = "block";
                    headerText.textContent = "Attendance History";
                    break;
                case "session_create_nav":
                    document.getElementById("lecturer_session").style.display = "block";
                    headerText.textContent = "Create Session";
                    break;
            }
        });
    }
});

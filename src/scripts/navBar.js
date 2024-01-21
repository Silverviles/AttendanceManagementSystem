document.addEventListener("DOMContentLoaded", function (event) {

    var adminContents = document.getElementsByClassName('admin_content');
    for (var i = 0; i < adminContents.length; i++) {
        adminContents[i].style.display = 'none';
    }

    document.getElementById("admin_dashboard").style.display = "block"

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

    showNavbar('header-toggle', 'nav-bar', 'body-pd', 'header')

    const linkColor = document.querySelectorAll('.nav_link')

    function colorLink() {
        if (linkColor) {
            linkColor.forEach(l => l.classList.remove('active'))
            this.classList.add('active')
        }
    }
    linkColor.forEach(l => l.addEventListener('click', colorLink));

    // Iterate through each element and attach a click event listener
    for (var i = 0; i < linkColor.length; i++) {
        linkColor[i].addEventListener('click', function (event) {
            // Prevent the default behavior of the anchor tag
            event.preventDefault();

            var dialogs = document.querySelectorAll("dialog");

            dialogs.forEach(function(dialog) {
                dialog.style.display = "none";
            });

            // Hide all elements with the class 'admin_content'
            var adminContents = document.getElementsByClassName('admin_content');
            for (var i = 0; i < adminContents.length; i++) {
                adminContents[i].style.display = 'none';
            }

            switch (this.id) {
                case "dashboard_nav": document.getElementById("admin_dashboard").style.display = "block";
                    break;
                case "faculties_nav": document.getElementById("admin_faculties").style.display = "block";
                    break;
                case "courses_nav": document.getElementById("admin_courses").style.display = "block";
                    break;
                case "modules_nav": document.getElementById("admin_modules").style.display = "block";
                    break;
                case "lecturers_nav": document.getElementById("admin_lecturers").style.display = "block";
                    break;
                case "students_nav": document.getElementById("admin_students").style.display = "block";
                    break;
                case "analysis_nav": document.getElementById("admin_analysis").style.display = "block";
                    break;
            }
        });
    }
});
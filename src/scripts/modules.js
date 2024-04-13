function getModuleDetails() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '../php/get_modules.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var modules = JSON.parse(xhr.responseText);
                displayModuleDetails(modules);
            } else {
                console.error('Error fetching module details:', xhr.statusText);
            }
        }
    };

    xhr.send();
}

function displayModuleDetails(modules) {
    var html = "";
    if (modules !== null && modules.length > 0) {
        html = '<table border="1" class="details_t" id="module_details_t"><thead><tr><th>Module Code</th><th>Module Name</th><th>Faculty</th><th>Degree</th><th class="action-column">Action</th></tr></thead><tbody>';

        modules.forEach(function (module) {
            html += '<tr><td>' + module.module_code + '</td><td>' + module.module_name + '</td><td>' + module.faculty + '</td><td>' + module.degree + '</td>';

            // Edit and Delete buttons within the same column
            html += '<td class="action-buttons">';
            html += '<input type="hidden" name="module_code" value="' + module.module_code + '">';
            html += '<button class="button-65 edit-button-module" data-module-code="' + module.module_code + '">Edit</button>';

            html += '<button class="button-65 delete-button" data-module-code="' + module.module_code + '">Delete</button></td></tr>';
        });

        html += '</tbody></table>';
    } else {
        html = "<p>No modules found.</p>";
    }

    document.getElementById('moduleDetails').innerHTML = html;

    // Add click event listeners to Delete buttons
    var deleteButtons = document.querySelectorAll('.delete-button');
    deleteButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            var moduleCode = this.getAttribute('data-module-code');
            confirmAndDeleteModule(moduleCode);
        });
    });

    // Add click event listeners to Edit buttons
    var editButtons = document.querySelectorAll('.edit-button-module');
    editButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            var moduleCode = this.getAttribute('data-module-code');
            openEditModulePopup(moduleCode);
        });
    });
}

function confirmAndDeleteModule(moduleCode) {
    if (confirm('Are you sure you want to delete this module?')) {
        // Perform AJAX request to delete.php
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../php/delete.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Handle the response if needed
                console.log(xhr.responseText);
                getModuleDetails(); // Update module details after deletion
            }
        };
        xhr.send('module_code=' + moduleCode);
    }
}


function filterModules() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("moduleCodeFilter");
    filter = input.value.toUpperCase();
    table = document.getElementById("module_details_t");
    tr = table.getElementsByTagName("tr");

    // Loop through all table rows, and hide those that don't match the filter
    for (i = 1; i < tr.length; i++) { // Start from 1 to skip the header row
        td = tr[i].getElementsByTagName("td")[0]; // Assuming module_code is in the first column (index 0)
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
    document.getElementById("add_module_btn").addEventListener('click', function () {
        document.getElementById("dialog_module").style.display = "block";
        var addModuleDoneButton = document.getElementById('edit_module_done');
        // Check if the element exists
        if (addModuleDoneButton) {
            // Update the ID attribute
            addModuleDoneButton.id = 'add_module_done';
            addModuleDoneButton.value = "Add Module";
            addModuleDoneButton.name = 'add_module_done';
        }
    });

    document.getElementById("add_module_done").addEventListener('click', function () {
        document.getElementById("dialog_module").style.display = "none";
        getModuleDetails();
    });
});

function openEditModulePopup(moduleCode) {
    // Fetch module details using moduleCode
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '../php/get_modules.php?module_code=' + moduleCode, true);
    xhr.setRequestHeader('Content-Type', 'application/json');

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var moduleDetails = JSON.parse(xhr.responseText);
                populateModulePopup(moduleDetails);
            } else {
                console.error('Error fetching module details:', xhr.statusText);
            }
        }
    };

    xhr.send();
}

function populateModulePopup(moduleDetails) {
    // Populate the dialog form with module details
    var dialog = document.getElementById('dialog_module');
    var moduleForm = document.getElementById('moduleForm');

    // Show the dialog
    dialog.style.display = "block";

    // Set form fields with module details
    moduleForm.elements['module_code'].value = moduleDetails[0].module_code;
    moduleForm.elements['module_name'].value = moduleDetails[0].module_name;
    // Update the ID, value, and name attributes of the submit button
    var addModuleDoneButton = document.getElementById('add_module_done');
    if (addModuleDoneButton) {
        addModuleDoneButton.id = 'edit_module_done';
        addModuleDoneButton.value = 'Edit Module';
        addModuleDoneButton.name = 'edit_module_done';
    }
}

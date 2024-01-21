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
    var html = '<table border="1" class="details_t" id="module_details_t"><thead><tr><th>Module Code</th><th>Module Name</th><th>Faculty</th><th>Degree</th></tr></thead><tbody>';

    modules.forEach(function (module) {
        html += '<tr><td>' + module.module_code + '</td><td>' + module.module_name + '</td><td>' + module.faculty + '</td><td>' + module.degree + '</td></tr>';
    });

    html += '</tbody></table>';

    document.getElementById('moduleDetails').innerHTML = html;
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


document.addEventListener('DOMContentLoaded', getModuleDetails);

document.getElementById("add_module_btn").addEventListener('click', function () {
    document.getElementById("dialog_module").style.display = "block";
});

document.getElementById("add_module_done").addEventListener('click', function () {
    document.getElementById("dialog_module").style.display = "none";
    getModuleDetails();
});

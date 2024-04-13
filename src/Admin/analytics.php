<div class="admin_content" id="admin_analysis">
    <div class="flex-container">
        <div>
            <label for="moduleFilter">Analytics</label>
        </div>
    </div>
    <div id="analyticsDetails">
        <div id="table-container">
            <table id="attendance-table" class="details_t">
                <tr>
                    <th>Module Code</th>
                    <th>Module Name</th>
                    <th>Number of Students</th>
                    <th>Number of Classes</th>
                    <th>Overall Attendance</th>
                </tr>
            </table>
        </div>
        <script>
            $(document).ready(function () {
                $.ajax({
                    url: '../php/get_analysis.php',
                    type: 'GET',
                    success: function (response) {
                        var data = JSON.parse(response);
                        var table = $('#attendance-table');
                        $.each(data, function (index, row) {
                            var tr = $('<tr>');
                            tr.append('<td>' + row.module_code + '</td>');
                            tr.append('<td>' + row.module_name + '</td>');
                            tr.append('<td>' + row.num_students + '</td>');
                            tr.append('<td>' + row.num_classes + '</td>');
                            tr.append('<td>' + row.overall_attendance_percentage + '%</td>');
                            table.append(tr);
                        });
                    },
                    error: function (xhr, status, error) {
                        console.error('Error fetching data:', error);
                    }
                });
            });
        </script>
    </div>
</div>
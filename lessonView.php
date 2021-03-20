<html>
    <head>
        <link rel="stylesheet" href="pryvate.css">
        <title>Pryvate System</title>

        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
        <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

        <style>
            tr.centered-data {
                text-align: center;
            }
        </style>
    </head>
    <body>
        <?php
            require_once('config.php');
            include 'addLessonFunc.php';

//add new lesson info
        ?>
        <h1>Scheduled Lessons</h1>
        <br><br>

        <div style="text-align: center; border: 2px solid lightgrey; padding: 12px;">
            Between : <input type="date" id="date1" value="<?php echo date('Y-m-d') ?>" onchange="dateShift();"/>
            &ensp;and : <input type="date" id="date2" onchange="dateShift();"/>
            <input id="supp" class="btn btn-outline-danger btn-sm" type="button" value="&times;" 
            onclick="dateOmit(), this.blur();"/>

            &emsp;

            <input type="radio" name="type" id="all" checked/><label for="all">All</label>
            <input type="radio" name="type" id="ski"/><label for="ski">Ski</label>
            <input type="radio" name="type" id="snb"/><label for="snb">Snowboard</label>

            &emsp;

            <input type="checkbox" name="ticked_fields" id="r"/><label for="r">R</label>
            <input type="checkbox" name="ticked_fields" id="p"/><label for="p">P</label>
            <input type="checkbox" name="ticked_fields" id="ci"/><label for="ci">CI</label>
            <input type="checkbox" name="ticked_fields" id="f"/><label for="f">F</label>
            <input id="tfdel" class="btn btn-outline-danger btn-sm" type="button" value="&times;" 
            onclick="uncheckAll(), this.blur();"/>
        </div>


        <br>

        <table id="tabl" class="stripe">
            <thead>
                <tr>
                    <th>Res. Number</th>
                    <th style="width: 100px;">Lesson Date</th>
                    <th>Type</th>
                    <th>Duration</th>
                    <th>Student(s)</th>
                    <th>Instructor</th>
                    <th>Req.</th>
                    <th>Paid</th>
                    <th>Checked In</th>
                    <th>Finalized</th>
                </tr>
            <thead>
            <tbody>
                <?php
                    // Unless we can use the variable from config.php
                    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

                    $query = mysqli_query($conn, "SELECT * FROM Lesson")
                    or die (mysqli_error($conn));

                    while ($row = mysqli_fetch_array($query)) {
                        echo
                            "<tr class='centered-data'>
                                <td>{$row['reservation_number']}</td>
                                <td>" . (date_format(date_create($row['date_of_lesson']), 'm-d-Y')) . " at " . (date_format(date_create($row['time_of_lesson']), 'H:i')) . "</td>
                                <td>" . ($row['ski_or_snowboard'] == 0 ? 'Ski' : 'SB') . "</td>
                                <td>{$row['length']} h</td>
                                <td>{$row['client1_id']}</td>
                                <td>{$row['instructor']}</td>
                                <td>" . ($row['desk_or_request'] == 0 ? '' : '&#10004;') . "</td>
                                <td>" . ($row['paid'] == 0 ? '' : '&#10004;') . "</td>
                                <td>" . ($row['checked_in'] == 0 ? '' : '&#10004;') . "</td>
                                <td>" . ($row['finalized_in_sales'] == 0 ? '' : '&#10004;') . "</td>
                            </tr>";
                    }
                ?>
            <tbody>
        </table>
        
        <script type="text/javascript" defer>
            $(document).ready(function() {
                var table = $('#tabl').DataTable({
                    language: {
                        paginate: {
                            first:      "«",
                            previous:   "‹",
                            next:       "›",
                            last:       "»"
                        }
                    }
                });
            });

            function dateShift() {
                var date1 = document.getElementById("date1");
                var min = new Date(date1.value).getTime();
                var date2 = document.getElementById("date2");
                var max = new Date(date2.value).getTime();
                if (!min || !max) return false;

                // Note : min > max and max < min are equivalent
                // This piece of code makes it so that the first date will not be greater than the second (and vice versa)
                if (min > max && input.id == "date1") date2.value = date1.value;
                if (max < min && input.id == "date2") date1.value = date2.value;

                refreshTable(date1, date2);
            }

            const diff_ms = 604800000; // nombre de millisecondes dans une semaine (intervalle par defaut dans l'interface)
            const one_day = diff_ms / 7;
            var curr_regex = "";

            function refreshTable(d1, d2) {
                curr_regex = "^.*(";
                var i = new Date(d1.value).getTime();
                var k = new Date(d2.value).getTime();
                
                for (i; i <= k; i += one_day) {
                    const my_day = new Date(i);
                    const ye = new Intl.DateTimeFormat('default', { year: 'numeric' }).format(my_day);
                    const mo = new Intl.DateTimeFormat('default', { month: '2-digit' }).format(my_day);
                    const da = new Intl.DateTimeFormat('default', { day: '2-digit' }).format(my_day);
                    curr_regex += `${mo}-${da}-${ye}` + "|";
                }
                curr_regex = curr_regex.substr(0, curr_regex.length-1) + ").*$";

                $('#tabl').DataTable().columns().search('').draw(); // reset
                // Line below is what applies the date filter
                $('#tabl').DataTable().column(1).search(curr_regex, true, false).draw();
            }

            function dateOmit() {
                $('#tabl').DataTable().columns().search('').draw();
            }


            // When a radio button from the "lesson type" filter is "changed" (clicked)
            $(document).on("click", "input[name='type']", function() {
                const rad_all = document.getElementById("all");
                const rad_ski = document.getElementById("ski");
                const rad_snb = document.getElementById("snb");

                if (rad_all.checked) {
                    $('#tabl').DataTable().columns().search('').draw();
                }
                if (rad_ski.checked) {
                    $("#tabl").DataTable().column(2).search('Ski').draw();
                }
                if (rad_snb.checked) {
                    $("#tabl").DataTable().column(2).search('SB').draw();
                }
            });


            $(document).on("click", "input[name='ticked_fields'], input[id='tfdel']", function() {
                const r = document.getElementById("r");
                const p = document.getElementById("p");
                const ci = document.getElementById("ci");
                const f = document.getElementById("f");

                $("#tabl").DataTable().column(6).search(r.checked ? '✔' : '')
                                    .column(7).search(p.checked ? '✔' : '')
                                    .column(8).search(ci.checked ? '✔' : '')
                                    .column(9).search(f.checked ? '✔' : '')
                                    .draw();
            });

            function uncheckAll() {
                document.getElementById("r").checked = false;
                document.getElementById("p").checked = false;
                document.getElementById("ci").checked = false;
                document.getElementById("f").checked = false;
            }
        </script>
    </body>
</html>

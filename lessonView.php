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

            table tr td {
                padding: 5px;
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
        <br>

        <div style="text-align: center; border: 2px solid lightgrey;">
            <table style="margin: auto;">
                <tr class="centered-data">
                    <td style="padding-right: 50px;">
                        On the: <input type="date" id="date1" value="" onchange="applyAllFilters(this), changeColorIndicationDATE(this, 'honeydew');"/>
                        <!-- &ensp;and : <input type="date" id="date2" onchange="applyAllFilters(this);"/> -->
                        <input id="supp" class="btn btn-outline-danger btn-sm" type="button" value="&times;" 
                        onclick="dateOmit(), this.blur(), changeColorIndicationDATE(this, 'initial');"/>
                    </td>  
                    <td style="background-color: honeydew;">
                        <input type="radio" name="type" id="all" checked/><label for="all">All</label>
                        <input type="radio" name="type" id="ski"/><label for="ski">Ski</label>
                        <input type="radio" name="type" id="snb"/><label for="snb">Snowboard</label>
                    </td>
                    <td>
                        <table style="float: left; border-collapse: collapse; margin-left: 40px;">
                            <tr>
                                <td colspan="2" style="text-align: center">
                                    Include records that:
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="includes" title="Shows records that have these particular fields checked.">Are</label><input 
                                    type="radio" id="includes" name="method" onchange="changeColorIndicationCHECKS(this, 'honeydew')" title="Shows records that have these particular fields checked." checked/>
                                    <label for="excludes" title="Shows records that do not have these particular fields checked.">Are not</label><input 
                                    type="radio" id="excludes" name="method" onchange="changeColorIndicationCHECKS(this, 'honeydew')" title="Shows records that do not have these particular fields checked."/>
                                    <label for="strict" title="Only shows records that have this exact combination of checkmarks for all four fields.">Exact</label><input 
                                    type="checkbox" id="strict" name="method" onchange="changeColorIndicationCHECKS(this, 'honeydew')" title="Only shows records that have this exact combination of checkmarks for all four fields."/>
                                </td>
                            </tr>
                            <tr>
                                <!-- <td style="text-align: right; padding-left: 40px;">
                                    <label for="includes" title="Shows records that have these particular fields checked.">Are</label>
                                    <input type="radio" id="includes" name="method" onchange="changeColorIndicationSP(this, 'honeydew')" title="Shows records that have these particular fields checked." checked/><br>
                                    <label for="excludes" title="Shows records that do not have these particular fields checked.">Are not</label>
                                    <input type="radio" id="excludes" name="method" onchange="changeColorIndicationSP(this, 'honeydew')" title="Shows records that do not have these particular fields checked."/><br>
                                    <label for="strict" title="Only shows records that have this exact combination of checkmarks for all four fields.">Exact</label>
                                    <input type="checkbox" id="strict" name="method" onchange="changeColorIndicationSP(this, 'honeydew')" title="Only shows records that have this exact combination of checkmarks for all four fields."/>
                                </td> -->
                                <td id="checks">
                                    <div style="float: left; vertical-align: middle;">
                                        <input type="checkbox" name="ticked_fields" id="r" onchange="changeColorIndicationCHECKS(this, 'honeydew');"/><label for="r">R</label>
                                        <input type="checkbox" name="ticked_fields" id="p" onchange="changeColorIndicationCHECKS(this, 'honeydew');"/><label for="p">P</label>
                                        <input type="checkbox" name="ticked_fields" id="ci" onchange="changeColorIndicationCHECKS(this, 'honeydew');"/><label for="ci">CI</label>
                                        <input type="checkbox" name="ticked_fields" id="f" onchange="changeColorIndicationCHECKS(this, 'honeydew');"/><label for="f">F</label>
                                        <input id="tfdel" class="btn btn-outline-danger btn-sm" type="button" value="&times;" 
                                        onclick="uncheckAll(), this.blur(), changeColorIndicationCHECKS(this, 'initial');"/>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>


        <br>

        <table id="tabl" class="stripe">
            <thead>
                <tr>
                    <th>Res. Number</th>
                    <th style="width: 100px;">Lesson Date</th>
                    <th>Type</th>
                    <th>Duration</th>
                    <th>Student(s)' Name & Age</th>
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
                        
                        $client_str = "";
                        $title_str = "";
                        
                        for ($i = 1; $i <= 3; $i++) {
                            $client_query = "SELECT first_name, last_name, age, phone_number FROM Client WHERE id = " . $row['client' . $i . '_id'] . " LIMIT 1";
                            $client_rec = $conn->query($client_query);

                            if ($client_rec->num_rows > 0) {
                                $fetch_assoc = $client_rec->fetch_assoc();
                                $client_fname = $fetch_assoc['first_name'];
                                $client_lname = $fetch_assoc['last_name'];
                                $client_age = $fetch_assoc['age'];
                                $client_phone = $fetch_assoc['phone_number'];

                                $client_str = $client_str . ($i == 1 ? "" : ", ") 
                                . $client_fname . " " . substr($client_lname, 0, 1) . ". (" . $client_age . ")";
                                // Explanatory, more detailed; displays on hover on the lesson students
                                $title_str = $title_str . ($i == 1 ? "" : ", ")
                                . $client_fname . " " . $client_lname . " (" . $client_phone . ")";
                            }
                        }

                        echo
                            "<tr class='centered-data'>
                                <td>{$row['reservation_number']}</td>
                                <td><span style='display: none'>" . date('U') . "</span>"
                                . (date_format(date_create($row['date_of_lesson']), 'm-d-Y')) . " at " . (date_format(date_create($row['time_of_lesson']), 'h:ia')) . "</td>
                                <td>" . ($row['ski_or_snowboard'] == 0 ? 'Ski' : 'SB') . "</td>
                                <td>{$row['length']} hrs</td>
                                <td><span title='" . $title_str . "'>" . $client_str . "</td>
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

            function dateShift(input) {

                var date1 = document.getElementById("date1");
                var min = new Date(date1.value).getTime();
                // var date2 = document.getElementById("date2");
                // var max = new Date(date2.value).getTime();
                if (!min/* || !max*/) return false;

                // // Note : min > max and max < min are equivalent
                // // This piece of code makes it so that the first date will not be greater than the second (and vice versa)
                // if (min > max && input.id == "date1") date2.value = date1.value;
                // if (max < min && input.id == "date2") date1.value = date2.value;

                refreshTable(date1/*, date2*/);
            }

            const diff_ms = 604800000; // nombre de millisecondes dans une semaine (intervalle par defaut dans l'interface)
            const one_day = diff_ms / 7;
            var curr_regex = "";

            function refreshTable(d1/*, d2*/) {
                curr_regex = "^.*(";
                var i = new Date(d1.value).getTime();
                // var k = new Date(d2.value).getTime();
                
                // for (i; i <= k; i += one_day) {
                const my_day = new Date(i);
                const ye = new Intl.DateTimeFormat('default', { year: 'numeric' }).format(my_day);
                const mo = new Intl.DateTimeFormat('default', { month: '2-digit' }).format(my_day);
                const da = new Intl.DateTimeFormat('default', { day: '2-digit' }).format(my_day);
                curr_regex += `${mo}-${da}-${ye}`/* + "|"*/;
                // }
                curr_regex = curr_regex.substr(0, curr_regex.length-1) + ").*$";

                // Line below is what applies the date filter
                $('#tabl').DataTable().column(1).search(curr_regex, true, false);
            }

            function dateOmit() {
                document.getElementById("date1").value = "";
                $('#tabl').DataTable().column(1).search('').draw();
            }

            const active_filter_color = 'honeydew';

            function applyAllFilters(input_if_date) {
                dateShift(input_if_date);
                
                const rad_all = document.getElementById("all");
                const rad_ski = document.getElementById("ski");
                const rad_snb = document.getElementById("snb");

                if (rad_all.checked) {
                    $('#tabl').DataTable().column(2).search('');
                }
                if (rad_ski.checked) {
                    $("#tabl").DataTable().column(2).search('Ski');
                }
                if (rad_snb.checked) {
                    $("#tabl").DataTable().column(2).search('SB');
                }


                const r = document.getElementById("r");
                const p = document.getElementById("p");
                const ci = document.getElementById("ci");
                const f = document.getElementById("f");

                // Only applies the checkmark filters if the background color is honeydew,
                // which visually indicates that the filter is active (and supposed to be)
                if (document.getElementById("checks").style.backgroundColor === active_filter_color) {
                    const incl = document.getElementById("includes").checked;
                    const excl = document.getElementById("excludes").checked;

                    const strict = document.getElementById("strict").checked;

                    if (incl && !strict) {
                        $("#tabl").DataTable().column(6).search(r.checked ? '✔' : '')
                                            .column(7).search(p.checked ? '✔' : '')
                                            .column(8).search(ci.checked ? '✔' : '')
                                            .column(9).search(f.checked ? '✔' : '');
                    }
                    if (excl && !strict) {
                        // ^.{0}$ looks for a field with exacty nothing
                        $("#tabl").DataTable().column(6).search(r.checked ? '^.{0}$' : '^.{0,3}$', regex=true)
                                            .column(7).search(p.checked ? '^.{0}$' : '^.{0,3}$', regex=true)
                                            .column(8).search(ci.checked ? '^.{0}$' : '^.{0,3}$', regex=true)
                                            .column(9).search(f.checked ? '^.{0}$' : '^.{0,3}$', regex=true);
                    }
                    if (incl && strict) {
                        $("#tabl").DataTable().column(6).search(r.checked ? '✔' : '^.{0}$', regex=!r.checked)
                                            .column(7).search(p.checked ? '✔' : '^.{0}$', regex=!p.checked)
                                            .column(8).search(ci.checked ? '✔' : '^.{0}$', regex=!ci.checked)
                                            .column(9).search(f.checked ? '✔' : '^.{0}$', regex=!f.checked);
                    }
                    if (excl && strict) {
                        $("#tabl").DataTable().column(6).search(r.checked ? '^.{0}$' : '✔', regex=r.checked)
                                            .column(7).search(p.checked ? '^.{0}$' : '✔', regex=p.checked)
                                            .column(8).search(ci.checked ? '^.{0}$' : '✔', regex=ci.checked)
                                            .column(9).search(f.checked ? '^.{0}$' : '✔', regex=f.checked);
                    }
                }

                $("#tabl").DataTable().draw(); // The only draw in the function, so that all filters cumulate beforehand
            }

            // When a radio button from the "lesson type" filter is changed/clicked
            // or when a checkmark filter is changed/clicked
            $(document).on("click", "input[name='type'], input[name='ticked_fields'], input[name='method']", {date_input: null}, applyAllFilters);

            function uncheckAll() {
                document.getElementById("r").checked = false;
                document.getElementById("p").checked = false;
                document.getElementById("ci").checked = false;
                document.getElementById("f").checked = false;

                $("#tabl").DataTable().column(6).search('', regex=false)
                                    .column(7).search('', regex=false)
                                    .column(8).search('', regex=false)
                                    .column(9).search('', regex=false)
                                    .draw();
            }

            function changeColorIndicationDATE(el, color) {
                $(el).closest('td').css({'background-color': color});
            }

            // Special: for the checkmark filtering method only
            function changeColorIndicationCHECKS(el, color) {
                $("#checks").css({'background-color': color});
                $("#checks").parent().parent().css({'background-color': color});
            }
        </script>
    </body>
</html>

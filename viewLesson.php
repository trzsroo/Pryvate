<html>
    <head>
        <link rel="stylesheet" href="pryvate.css">
        <title>View Lesson</title>

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

            .hidden {
                display: none;
            }
        </style>
    </head>
    <body>
        <?php
            require_once('config.php');
            $urlLink = (string) htmlspecialchars($_SERVER["PHP_SELF"]);
            $urlLink = str_replace("viewLesson.php", "", $urlLink);
            $addLessonURL = $urlLink."addLesson.php";
        ?>
        <h1>Scheduled Lessons</h1>
        <a style="float: right;" href="<?php echo $addLessonURL; ?>"><label class="boldLabel">Add Lesson</label><button id="addLessonPlusBtn">+</button></a>
        <br/><br/><br/>
        <div style="text-align: center; border: 2px solid lightgrey;">
            <table style="margin: auto;">
                <tr class="centered-data">
                    <td style="padding-right: 50px;">
                        <div style="padding: 8px;">
                            On the: <input type="date" id="date1" value="" onchange="applyAllFilters(this), changeColorIndicationDATE(this, 'honeydew');"/>
                            <!-- &ensp;and : <input type="date" id="date2" onchange="applyAllFilters(this);"/> -->
                            <input id="supp" class="btn btn-outline-danger btn-sm" type="button" value="&times;" 
                            onclick="dateOmit(), this.blur(), changeColorIndicationDATE(this, 'initial');"/>
                        </div>
                    </td>  
                    <td>
                        <div style="padding: 8px; margin-right: 20px; background-color: honeydew; text-align: left;">
                            <input type="radio" name="type" id="all" checked/><label for="all">All</label><br>
                            <input type="radio" name="type" id="ski"/><label for="ski">Ski</label><br>
                            <input type="radio" name="type" id="snb"/><label for="snb">Snowboard</label>
                        </div>
                    </td>
                    <td>
                        <div style="padding: 8px; margin-left: 20px; background-color: honeydew; text-align: left">
                            <input type="radio" name="students" id="private" onchange="applyAllFilters(this);"/><label for="private">Private</label><br>
                            <input type="radio" name="students" id="semiprivate" onchange="applyAllFilters(this);"/><label for="semiprivate">Semi-private</label><br>  
                            <input type="radio" name="students" id="anynum" onchange="applyAllFilters(this);" checked/><label for="anynum">Both</label>                  
                        </div>
                    </td>
                    <td>
                        <table style="float: left; border-collapse: collapse; margin-left: 20px;">
                            <tr>
                                <td colspan="2" style="text-align: center">
                                    Include records that:
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: center">
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
                                        <input type="checkbox" name="ticked_fields" id="r" onchange="changeColorIndicationCHECKS(this, 'honeydew')"/><label for="r">Req.</label>
                                        <input type="checkbox" name="ticked_fields" id="p" onchange="changeColorIndicationCHECKS(this, 'honeydew')"/><label for="p">Paid</label>
                                        <input type="checkbox" name="ticked_fields" id="ci" onchange="changeColorIndicationCHECKS(this, 'honeydew')"/><label for="ci">Ch. In</label>
                                        <input type="checkbox" name="ticked_fields" id="f" onchange="changeColorIndicationCHECKS(this, 'honeydew')"/><label for="f">Fin.</label>
                                        <input id="tfdel" class="btn btn-outline-danger btn-sm" type="button" value="&times;" 
                                        onclick="changeColorIndicationCHECKS(this, 'initial'), uncheckAll(), this.blur();"/>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>

        <br>

        <form id="form" action="modifyLesson.php" method="post">
            <table id="tabl" class="stripe">
                <thead>
                    <tr>
                        <th></th>
                        <th style="width: 100px;">Lesson Date</th>
                        <th>Level</th>
                        <th>Type</th>
                        <th>Duration</th>
                        <th>Student(s)' Name & Age</th>
                        <th>Instructor</th>
                        <th>Req.</th>
                        <th>Paid</th>
                        <th>Checked In</th>
                        <th>Finalized</th>
                        <th></th> <!-- Edit button -->
                        <th class="hidden"></th> <!-- Number of students -->
                        <th class="hidden"></th> <!-- Lesson ID -->
                        <th class="hidden"></th> <!-- Date created -->
                        <th class="hidden"></th> <!-- Reservation number -->
                        <th class="hidden"></th> <!-- Clerk name -->
                        <th class="hidden"></th> <!-- Notes -->
                    </tr>
                <thead>
                <tbody>
                    <?php
                        // Unless we can use the variable from config.php
                        $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

                        $query = mysqli_query($conn, 
                        "SELECT * FROM Lesson 
                        -- WHERE cast(date_of_lesson as DATE) >= cast(curdate() as DATE)
                        ")
                        or die (mysqli_error($conn));

                        while ($row = mysqli_fetch_array($query)) {
                            
                            $client_str = "";
                            $title_str = "";
                            $num_of_students = 1;
                            
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

                                    $num_of_students = $i; // If this additional student exists, update number of students
                                }
                            }

                            echo
                                "<tr class='centered-data'>
                                    <td><input type='button' style='font-size: 6pt;' 
                                    onclick=\"this.value = this.value === '▼' ? '▲' : '▼';\" value='▼'/></td>
                                    <td><span class='hidden'>" . date_format(date_create($row['date_of_lesson']), 'U') . "</span>"
                                    . (date_format(date_create($row['date_of_lesson']), 'm-d-Y')) . " at " . (date_format(date_create($row['time_of_lesson']), 'h:ia')) . "</td>
                                    <td>{$row['level']}</td>
                                    <td>" . ($row['ski_or_snowboard'] == 0 ? 'Ski' : 'SB') . "</td>
                                    <td>{$row['length']} hrs</td>
                                    <td><span title='" . $title_str . "'>" . $client_str . "</td>
                                    <td>{$row['instructor']}</td>
                                    <td>" . ($row['desk_or_request'] == 0 ? '' : '&#10004;') . "</td>
                                    <td>" . ($row['paid'] == 0 ? '<em>Pending</em>' : '&#10004;') . "</td>
                                    <td>" . ($row['checked_in'] == 0 ? '' : '&#10004;') . "</td>
                                    <td>" . ($row['finalized_in_sales'] == 0 ? '' : '&#10004;') . "</td>
                                    <td><input type='button' value='✎'/></td>
                                    <td class='hidden'>{$num_of_students}</td>
                                    <td class='hidden' name='lessonids'>{$row['id']}</td>
                                    <td class='hidden'>{$row['date_created']}</td>
                                    <td class='hidden'>{$row['reservation_number']}</td>
                                    <td class='hidden'>{$row['clerk_name']}</td>
                                    <td class='hidden'>{$row['notes']}</td>
                                </tr>";
                        }
                    ?>
                <tbody>
            </table>
            <input type="hidden" id="lessonToModify" name="lessonId"/>
        </form>
        
        <script type="text/javascript" defer>
            // `data` is the original data object for the row
            function twoDigitZerofill(num) {
                return ('0' + num).slice(-2);
            }

            function formatDateMMDDYYYY(sqlDate) {
                //sqlDate in SQL DATETIME format ("yyyy-mm-dd hh:mm:ss.ms")
                const sqlDateArr = sqlDate.split(" ")[0].split("-");
                const sMonth = sqlDateArr[1] - 1;
                const sDay = sqlDateArr[2];
                const sYear = sqlDateArr[0];

                const usDateFormat = new Intl.DateTimeFormat('en-us');
                    
                return usDateFormat.format(new Date(sYear,sMonth,sDay));
            }

            function format(data) {

                return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
                    '<tr>' +
                        '<td><b>Date created:</b></td>' +
                        '<td>' + (data.dateCreated ? formatDateMMDDYYYY(data.dateCreated) : '-') + '</td>' +
                    '</tr>' +
                    '<tr>' +
                        '<td><b>Res. number:</b></td>' +
                        '<td>' + (data.reservationNumber ? data.reservationNumber : '-') + '</td>' +
                    '</tr>' +
                    '<tr>' +
                        '<td><b>Clerk:</b></td>' +
                        '<td>' + (data.clerk ? data.clerk : '-') + '</td>' +
                    '</tr>' +
                    '<tr>' +
                        '<td><b>Notes:</b></td>' +
                        '<td>' + (data.notes ? data.notes : '-') + '</td>' +
                    '</tr>' +
                '</table>';
            }

            $(document).ready(function() {
                var table = $('#tabl').DataTable({
                    "columns": [
                        {
                            "className": 'details-control',
                            "orderable": false
                        },
                        {"data": "lessonDate"},
                        {"data": "level"},
                        {"data": "type"},
                        {"data": "duration"},
                        {"data": "studentsNameAndAge"},
                        {"data": "instructor"},
                        {"data": "required"},
                        {"data": "paid"},
                        {"data": "checkedIn"},
                        {"data": "finalized"},
                        {
                            "data": "edit",
                            "orderable": false
                        },
                        {"data": "numberOfStudents"}, // Hidden
                        {"data": "lessonId"}, // Hidden
                        {"data": "dateCreated"}, // Hidden
                        {"data": "reservationNumber"}, // Hidden
                        {"data": "clerk"}, // Hidden
                        {"data": "notes"} // Hidden
                    ],
                    language: {
                        paginate: {
                            first:      "«",
                            previous:   "‹",
                            next:       "›",
                            last:       "»"
                        }
                    },
                    "deferRender": true
                });

                // Add event listener for opening and closing details
                $('#tabl tbody').on('click', 'td.details-control input', function () {
                    var tr = $(this).closest('tr');
                    var row = table.row(tr);
                    
                    if (row.child.isShown()) {
                        // This row is already open - close it
                        row.child.hide();
                        tr.removeClass('shown');
                    }
                    else {
                        // Open this row
                        row.child(format(row.data()).replace(/(?:\r\n|\r|\n)/g, '<br>')).show();
                        tr.addClass('shown');
                    }
                });

                var date_input = document.getElementById("date1");

                const today = new Date();
                const yyyy = today.getFullYear();
                const dd = twoDigitZerofill(today.getDate());
                const mm = twoDigitZerofill(today.getMonth() + 1);

                date_input.value = yyyy + '-' + mm + '-' + dd;
                applyAllFilters(date_input);
                date_input.parentElement.style.backgroundColor = 'honeydew';
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
                var i = new Date(d1.value).getTime() + one_day/2;
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
                    $('#tabl').DataTable().column(3).search('');
                }
                if (rad_ski.checked) {
                    $("#tabl").DataTable().column(3).search('Ski');
                }
                if (rad_snb.checked) {
                    $("#tabl").DataTable().column(3).search('SB');
                }

                const rad_13 = document.getElementById("anynum");
                const rad_11 = document.getElementById("private");
                const rad_23 = document.getElementById("semiprivate");

                if (rad_13.checked) {
                    $('#tabl').DataTable().column(12).search('');
                }
                if (rad_11.checked) {
                    $("#tabl").DataTable().column(12).search('1');
                }
                if (rad_23.checked) {
                    $("#tabl").DataTable().column(12).search('^[23]{1}$', regex=true);
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
                        // .search('') does not search exactly nothing when performed as a smart search,
                        // but rather does not make the field a search criterion (it "does not search"
                        // rather than "searches for exactly nothing")
                        $("#tabl").DataTable().column(7).search(r.checked ? '✔' : '')
                                            .column(8).search(p.checked ? '✔' : '')
                                            .column(9).search(ci.checked ? '✔' : '')
                                            .column(10).search(f.checked ? '✔' : '');
                    }
                    if (excl && !strict) {
                        // ^.{0}$ looks for a field with exactly nothing;
                        // ^.{0,3}$ looks for a field with any number of characters (up to 3; in our
                        // case, a checkmark)
                        $("#tabl").DataTable().column(7).search(r.checked ? '^.{0}$' : '^.{0,3}$', regex=true)
                                            .column(8).search(p.checked ? 'Pending' : '^.{0,3}$', regex=true)
                                            .column(9).search(ci.checked ? '^.{0}$' : '^.{0,3}$', regex=true)
                                            .column(10).search(f.checked ? '^.{0}$' : '^.{0,3}$', regex=true);
                    }
                    if (incl && strict) {
                        $("#tabl").DataTable().column(7).search(r.checked ? '✔' : '^.{0}$', regex=!r.checked)
                                            .column(8).search(p.checked ? '✔' : 'Pending', regex=!p.checked)
                                            .column(9).search(ci.checked ? '✔' : '^.{0}$', regex=!ci.checked)
                                            .column(10).search(f.checked ? '✔' : '^.{0}$', regex=!f.checked);
                    }
                    if (excl && strict) {
                        $("#tabl").DataTable().column(7).search(r.checked ? '^.{0}$' : '✔', regex=r.checked)
                                            .column(8).search(p.checked ? 'Pending' : '✔', regex=p.checked)
                                            .column(9).search(ci.checked ? '^.{0}$' : '✔', regex=ci.checked)
                                            .column(10).search(f.checked ? '^.{0}$' : '✔', regex=f.checked);
                    }
                }

                $("#tabl").DataTable().draw(); // The only draw in the function, so that all filters cumulate beforehand
            }

            // When a radio button from the "lesson type" filter is changed/clicked
            // or when a checkmark filter is changed/clicked
            $(document).on("change", "input[name='type'], input[name='ticked_fields'], input[name='method']", {date_input: null}, applyAllFilters);

            function uncheckAll() {
                document.getElementById("r").checked = false;
                document.getElementById("p").checked = false;
                document.getElementById("ci").checked = false;
                document.getElementById("f").checked = false;

                $("#tabl").DataTable().column(7).search('', regex=false)
                                    .column(8).search('', regex=false)
                                    .column(9).search('', regex=false)
                                    .column(10).search('', regex=false)
                                    .draw();
            }

            function changeColorIndicationDATE(el, color) {
                $(el).closest('div').css({'background-color': color});
            }

            // Special: for the checkmark filtering method only
            function changeColorIndicationCHECKS(el, color) {
                $("#checks").css({'background-color': color});
                $("#checks").parent().parent().css({'background-color': color});
            }

            $(document).on("click", "input[value='✎']", function() {
                var row = this.parentElement.parentElement;
                var lesson_id = row.querySelector("td[name='lessonids']").innerHTML;
                var hidden_id_input = document.getElementById("lessonToModify");

                hidden_id_input.value = lesson_id;

                $("#form").submit();
            });
        </script>
    </body>
</html>

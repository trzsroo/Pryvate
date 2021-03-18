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

        <table id="tabl" class="stripe">
            <thead>
                <tr>
                    <th>Res. Number</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Type</th>
                    <th>Duration</th>
                    <th>Student(s)</th>
                    <th>Instructor</th>
                    <th>Req.</th>
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
                                <td>{$row['date_of_lesson']}</td>
                                <td>{$row['time_of_lesson']}</td>
                                <td>" . ($row['ski_or_snowboard'] == 0 ? 'Ski' : 'SB') . "</td>
                                <td>{$row['length']} h</td>
                                <td>{$row['client1_id']}<br/>{$row['client2_id']}<br/>{$row['client3_id']}</td>
                                <td>{$row['instructor']}</td>
                                <td>" . ($row['desk_or_request'] == 0 ? '' : '&#10004;') . "</td>
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
        </script>
    </body>
</html>
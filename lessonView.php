<html>
    <head>
        <link rel="stylesheet" href="pryvate.css">
        <title>Add Private Lesson</title>
    </head>
    <body>
        <?php
            require_once('config.php');
            include 'addLessonFunc.php';

//add new lesson info
        ?>

        <table>
            <tr>
                <th>Date & Time</th>
                <th>Type</th>
                <th>Duration</th>
                <th>Student(s)</th>
                <th>Instructor</th>
                <th>Req.</th>
                <th>Checked In</th>
                <th>Finalized</th>
            </tr>
            <?php
                // Unless we can use the variable from config.php
                $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

                $query = mysqli_query($conn, "SELECT * FROM Lesson")
                or die (mysqli_error($conn));

                while ($row = mysqli_fetch_array($query)) {
                    echo
                        "<tr>
                            <td>{$row['date_time_of_lesson']}</td>
                            <td>{$row['ski_or_snowboard']}</td>
                            <td>{$row['length']} hour(s)</td>
                            <td>{$row['client1_id']}</td>
                            <td>{$row['instructor']}</td>
                            <td>{$row['desk_or_request']}</td>
                            <td>{$row['checked_in']}</td>
                            <td>{$row['finalized_in_sales']}</td>
                        </tr>";
                }
            ?>
        </table>
        
        <script>
            
        </script>
    </body>
</html>

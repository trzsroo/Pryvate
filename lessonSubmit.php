<?php
    $servername = "dbpryvate.c8yniitkbcyt.us-east-2.rds.amazonaws.com";
    $username = "admin";
    $password = "wentworth123";
    $dbname = "dbpryvate";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // values to feed into all lesson table columns
    $date = mysqli_real_escape_string($conn, $_POST['dateOfLesson']);
    $time = mysqli_real_escape_string($conn, $_POST['timeOfLesson']);
    $date_time = date('Y-m-d H:i:s', strtotime("$date $time"));
    $ski_or_sb = mysqli_real_escape_string($conn, $_POST['lessonType']);
    $client1_id = mysqli_real_escape_string($conn, $_POST['clientId1']);
    // $client2_id = $_POST['clientId2'] ? mysqli_real_escape_string($conn, $_POST['clientId2']) : "";
    // $client3_id = $_POST['clientId3'] ? mysqli_real_escape_string($conn, $_POST['clientId3']) : "";
    $level = mysqli_real_escape_string($conn, $_POST['lessonLvl']);
    $res_num = mysqli_real_escape_string($conn, $_POST['reservationNumber']);
    $clk_name = mysqli_real_escape_string($conn, $_POST['clerkName']);
    $date_created = mysqli_real_escape_string($conn, $_POST['dateCreated']);
    $length = mysqli_real_escape_string($conn, $_POST['lenOfLesson']);
    $instructor = mysqli_real_escape_string($conn, $_POST['instructor']);
    $desk_or_request = mysqli_real_escape_string($conn, $_POST['requested']) == false ? 0 : 1;
    $paid = 0; //mysqli_real_escape_string($conn, $_POST['paid']);
    $checked_in = mysqli_real_escape_string($conn, $_POST['checkedIn']);
    $fin_in_sales = mysqli_real_escape_string($conn, $_POST['finalizedInSales']);
    $notes = mysqli_real_escape_string($conn, $_POST['notes']);

    // SQL injection-safe query. ?'s are wildcards/slots in which to insert the values
    $lesson_creation_query = "INSERT INTO Lesson (date_time_of_lesson, ski_or_snowboard, client1_id, 
                                                level, reservation_number, clerk_name, 
                                                date_created, length, instructor, 
                                                desk_or_request, paid, checked_in, 
                                                finalized_in_sales, notes)
                            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)"; // 14

    // Prepare the query (probably the step that removes malicious user input)
    $secure_query = mysqli_prepare($lesson_creation_query);
    // Insertion of the values in the slots. First bind_param argument is the first letter of the type (string/integer/double)
    $secure_query->bind_param("siiiissdsiiiis", $date_time, intval($ski_or_sb), intval($client_id),
                                            intval($level), intval($res_num), $clk_name,
                                            $date_created, intval($length), $instructor,
                                            intval($desk_or_request), intval($paid), intval($checked_in),
                                            intval($fin_in_sales), $notes);

    // $sql = "INSERT INTO Test (fname, lname, email)
    //         VALUES ('John', 'Doe', 'john@example.com')";

    if ($secure_query->execute() === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
?>
<?php
session_start();
$addedClientID = '';
$minDate = date("Y-m-d", strtotime("-1 days"));


function getLessonID() {
    if (isset($_SESSION['lessonId'])) {
        echo $_SESSION['lessonId'];
    }
}

function setLessonID() {
    if(isset($_POST['lessonId'])) {
        $_SESSION['lessonId'] = $_POST['lessonId'];
    } if(isset($_POST['lessonId2'])) {
        $_SESSION['lessonId'] = $_POST['lessonId2'];
    }
}

//function to see if at least one person is added to either show or hid add lesson btn
function getTotNumInLesson() {
    if (isset($_SESSION['totalNumOfClientsInThisLesson'])) {
        echo $_SESSION['totalNumOfClientsInThisLesson'];
    } else {
        echo 0;
    }
}

function setTotNumInLesson() {
    if (isset($_POST['totalNumOfClientsInThisLesson'])) {
        $_SESSION['totalNumOfClientsInThisLesson'] = $_POST['totalNumOfClientsInThisLesson'];
    }
    if (isset($_POST['totalNumOfClientsInThisLesson2'])) {
        $_SESSION['totalNumOfClientsInThisLesson'] = $_POST['totalNumOfClientsInThisLesson2'];
    }
}

function getLessonType() {
    if (isset($_SESSION['lessonType'])) {
        echo $_SESSION['lessonType'];
    }
}

function setLessonType() {
    if(isset($_POST['lessonType'])) {
        $_SESSION['lessonType'] = $_POST['lessonType'];
    }
}

function lessonTypeChecked(String $lessonType) {
    if (isset($_SESSION['lessonType'])) {
        if ($_SESSION['lessonType'] == $lessonType) {
            echo 'checked="checked"';
        } else {
            echo '';
        }
    }
}

function setDateOfLesson() {
    if (isset($_POST['dateOfLesson'])) {
        $_SESSION['dateOfLesson'] = $_POST['dateOfLesson'];
    }
}

function getDateOfLesson() {
    if (isset($_SESSION['dateOfLesson'])) {
        echo $_SESSION['dateOfLesson'];
    }
}

function setTimeOfLesson() {
    if (isset($_POST['timeOfLesson'])) {
        $_SESSION['timeOfLesson'] = $_POST['timeOfLesson'];
    }
}

function getTimeOfLesson() {
    if (isset($_SESSION['timeOfLesson'])) {
        echo $_SESSION['timeOfLesson'];
    }
}

function setLenOfLesson() {
    if (isset($_POST['lenOfLesson'])){
        $_SESSION['lenOfLesson'] = $_POST['lenOfLesson'];
    }
}

function getLenOfLesson() {
    if (isset($_SESSION['lenOfLesson'])) {
        echo $_SESSION['lenOfLesson'];
    }
}

function setLessonLvl() {
    if (isset($_POST['lessonLvl'])) {
        $_SESSION['lessonLvl'] = $_POST['lessonLvl'];
    }
}

function getLessonLvl() {
    if (isset($_SESSION['lessonLvl'])) {
        echo $_SESSION['lessonLvl'];
    }
}

function setInstructor() {
    if (isset($_POST['instructor'])) {
        $_SESSION['instructor'] = $_POST['instructor'];
    }
}

function getInstructor() {
    if (isset($_SESSION['instructor'])) {
        echo $_SESSION['instructor'];
    }
}

function setRequested() {
    if (isset($_POST['requested'])) {
        $_SESSION['requested'] =  $_POST['requested'];
    }

}

function getRequested() {
    if (isset($_SESSION['requested'])) {
        if ($_SESSION['requested'] == 'requested') {
            // for radio button on addLesson.php
            echo 'checked=True';
        }
    }
}

function setLessonNotes() {
    if (isset($_POST['lessonNotes'])) {
        $_SESSION['lessonNotes'] = $_POST['lessonNotes'];
    }
}

function getLessonNotes() {
    if (isset($_SESSION['lessonNotes'])) {
        echo $_SESSION['lessonNotes'];
    }
}

function setClerkName() {
    if (isset($_POST['clerkName']))
    $_SESSION['clerkName'] = $_POST['clerkName'];
}

function getClerkName() {
    if (isset($_SESSION['clerkName'])) {
        echo $_SESSION['clerkName'];
    }
}

function setPaid() {
    if (isset($_POST['paid'])) {
        $_SESSION['paid'] =  $_POST['paid'];
    }

}

function getpaid() {
    if (isset($_SESSION['paid'])) {
        if ($_SESSION['paid'] == 'paid') {
            // for radio button on addLesson.php
            echo 'checked=True';
        }
    }
}

function setCheckIn() {
    if (isset($_POST['checkIn'])) {
        $_SESSION['checkIn'] =  $_POST['checkIn'];
    }

}

function getCheckIn() {
    if (isset($_SESSION['checkIn'])) {
        if ($_SESSION['checkIn'] == 'checkIn') {
            // for radio button on addLesson.php
            echo 'checked=True';
        }
    }
}

function setFinalize() {
    if (isset($_POST['finalize'])) {
        $_SESSION['finalize'] =  $_POST['finalize'];
    }

}

function getFinalize() {
    if (isset($_SESSION['finalize'])) {
        if ($_SESSION['finalize'] == 'finalize') {
            // for radio button on addLesson.php
            echo 'checked=True';
        }
    }
}

function setLessonFields() {
    setLessonType();
    setDateOfLesson();
    setTimeOfLesson();
    setLenOfLesson();
    setLessonLvl();
    setInstructor();
    setRequested();
    setClerkName();
    setLessonNotes();
    setPaid();
    setCheckIn();
    setFinalize();
}

function queryLessonType($lessId) {
    if ($lessId != "") {
        $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $db_table = "mydb.Lesson";


        $sql = "SELECT ski_or_snowboard FROM ".$db_table." WHERE id=".$lessId.";";

        $result = mysqli_query($link, $sql);

        while($row = mysqli_fetch_array($result) ) {
            echo $row['ski_or_snowboard'];
        }

        mysqli_close($link);
    }

}

function queryLessonDate($lessId) {
    if ($lessId != "") {
        $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $db_table = "mydb.Lesson";


        $sql = "SELECT date_of_lesson FROM ".$db_table." WHERE id=".$lessId.";";

        $result = mysqli_query($link, $sql);

        while($row = mysqli_fetch_array($result) ) {
            echo $row['date_of_lesson'];
        }

        mysqli_close($link);
    }

}

function queryLessonTime($lessId) {
    if ($lessId != "") {
        $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $db_table = "mydb.Lesson";


        $sql = "SELECT time_of_lesson FROM ".$db_table." WHERE id=".$lessId.";";

        $result = mysqli_query($link, $sql);

        while($row = mysqli_fetch_array($result) ) {
            echo $row['time_of_lesson'];
        }

        mysqli_close($link);
    }

}

function queryLessonLen($lessId) {
    if ($lessId != "") {
        $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $db_table = "mydb.Lesson";


        $sql = "SELECT length FROM ".$db_table." WHERE id=".$lessId.";";

        $result = mysqli_query($link, $sql);

        while($row = mysqli_fetch_array($result) ) {
            echo $row['length'];
        }

        mysqli_close($link);
    }

}

function queryLessonLvl($lessId) {
    if ($lessId != "") {
        $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $db_table = "mydb.Lesson";


        $sql = "SELECT level FROM ".$db_table." WHERE id=".$lessId.";";

        $result = mysqli_query($link, $sql);

        while($row = mysqli_fetch_array($result) ) {
            echo $row['level'];
        }

        mysqli_close($link);
    }
}

function queryLessonInstr($lessId) {
    if ($lessId != "") {
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $db_table = "mydb.Lesson";


        $sql = "SELECT instructor FROM ".$db_table." WHERE id=".$lessId.";";

        $result = mysqli_query($link, $sql);

        while($row = mysqli_fetch_array($result) ) {
            echo $row['instructor'];
        }

        mysqli_close($link);
    }
}

function queryLessonRequ($lessId) {
    if ($lessId != "") {
        $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $db_table = "mydb.Lesson";


        $sql = "SELECT desk_or_request FROM ".$db_table." WHERE id=".$lessId.";";

        $result = mysqli_query($link, $sql);

        while($row = mysqli_fetch_array($result) ) {
            echo $row['desk_or_request'];
        }

        mysqli_close($link);
    }
}

function queryLessonNotes($lessId) {
    if ($lessId != "") {
        $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $db_table = "mydb.Lesson";


        $sql = "SELECT notes FROM ".$db_table." WHERE id=".$lessId.";";

        $result = mysqli_query($link, $sql);

        while($row = mysqli_fetch_array($result) ) {
            echo $row['notes'];
        }

        mysqli_close($link);
    }
}

function queryLessonClerk($lessId) {
    if ($lessId != "") {
        $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $db_table = "mydb.Lesson";


        $sql = "SELECT clerk_name FROM ".$db_table." WHERE id=".$lessId.";";

        $result = mysqli_query($link, $sql);

        while($row = mysqli_fetch_array($result) ) {
            echo $row['clerk_name'];
        }

        mysqli_close($link);
    }
}

function queryLessonPaid($lessId) {
    if ($lessId != "") {
        $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $db_table = "mydb.Lesson";


        $sql = "SELECT paid FROM ".$db_table." WHERE id=".$lessId.";";

        $result = mysqli_query($link, $sql);

        while($row = mysqli_fetch_array($result) ) {
            echo $row['paid'];
        }

        mysqli_close($link);
    }
}

function queryLessonChIn($lessId) {
    if ($lessId != "") {
        $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $db_table = "mydb.Lesson";


        $sql = "SELECT checked_in FROM ".$db_table." WHERE id=".$lessId.";";

        $result = mysqli_query($link, $sql);

        while($row = mysqli_fetch_array($result) ) {
            echo $row['checked_in'];
        }

        mysqli_close($link);
    }
}

function queryLessonFin($lessId) {
    if ($lessId != "") {
        $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $db_table = "mydb.Lesson";


        $sql = "SELECT finalized_in_sales FROM ".$db_table." WHERE id=".$lessId.";";

        $result = mysqli_query($link, $sql);

        while($row = mysqli_fetch_array($result) ) {
            echo $row['finalized_in_sales'];
        }

        mysqli_close($link);
    }
}

function queryEmailRecptBool($lessId) {
    if ($lessId != "") {
        $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $db_table = "mydb.Lesson";


        $sql = "SELECT receipt_emailed FROM ".$db_table." WHERE id=".$lessId.";";

        $result = mysqli_query($link, $sql);

        while($row = mysqli_fetch_array($result) ) {
            echo $row['receipt_emailed'];
        }

        mysqli_close($link);
    }

}

function getClientID($stuNum) {
    if ($stuNum != "") {
        $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $db_table = "mydb.Lesson";
        $clientNum = "client".$stuNum."_id";
        // selects all clients in DB
        if (isset($_SESSION['lessonId'])) {
            $sql = "SELECT ".$clientNum." FROM ".$db_table." WHERE id=".$_SESSION['lessonId'].";";
        }
        else {
            $sql = "SELECT ".$clientNum." FROM ".$db_table." WHERE id=".$_POST['lessonId'].";";
            setLessonID();
        }

        $result = mysqli_query($link, $sql);

        while($row = mysqli_fetch_array($result) ) {
            if ($row[$clientNum] > 0) {
                echo $row[$clientNum];
                $_SESSION['hidClient'.$stuNum] = $row[$clientNum];
            }
        }

        mysqli_close($link);
    }
}

function deleteLessonFromDB() {
  if (isset($_POST['deleteLessonBtn'])) {
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $db_table = "mydb.Lesson";
    $sql = "DELETE FROM ".$db_table." WHERE ID=".$_POST['lessonId'].";";
    $result = mysqli_query($link, $sql);
    mysqli_close($link);
    closeSession();
    header('Location: viewLesson.php');
}
}

function saveLessonToDB() {
    if (isset($_POST['saveLessonBtn'])) {
        setClientIDs();
        setLessonFields();
        setTotNumInLesson();
        if (isset($_POST['Lessontype'])) {
            $lessonType = $_POST['lessonType'];
        } else  {
            $lessonType = '';
        }

        $lessonTypeInput = 0;
        if ($lessonType = 'SB') {
            $lessonTypeInput = 1;
        }
        $dateOfLesson = $_POST['dateOfLesson'];
        $timeOfLesson = $_POST['timeOfLesson'];
        $client1ID = $_POST['hidClient1'];
        $client2ID = $_POST['hidClient2'];
        $client3ID = $_POST['hidClient3'];
        $lenOfLesson = $_POST['lenOfLesson'];
        $lessonLvl = $_POST['lessonLvl'];
        $instructor = $_POST['instructor'];
        if (isset($_POST['requested'])) {
            $req = $_POST['requested'];
        } else {
            $req = '';
        }
        $reqInput = 0;
        if ($req == 'requested') {
            $reqInput = 1;
        }
        $lessonNotes = $_POST['lessonNotes'];
        $clerkName = $_POST['clerkName'];
        $paid = 0;
        if (isset($_POST['paid'])) {
            $paid = 1;
        }
        $chIn = 0;
        if (isset($_POST['checkIn'])) {
            $chIn = 1;
        }
        $fin = 0;
        if (isset($_POST['finalize'])) {
            $fin = 1;
        }

        $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

        $db_table = "mydb.Lesson";
        if ($client1ID != "" && $dateOfLesson != "" && $timeOfLesson != "" && $lessonType != "" && $clerkName != "") {
            $sql_result = mysqli_query($link, "SELECT * FROM ".$db_table." WHERE id='".$_POST['lessonId']."';");

            if(mysqli_num_rows($sql_result) == 1) {
                // inserts into DB if an instance doesn't exist
                $sql = "UPDATE ".$db_table." SET date_of_lesson='$dateOfLesson', time_of_lesson='$timeOfLesson', ski_or_snowboard='$lessonTypeInput',".
                    " client1_id='$client1ID', client2_id='$client2ID', client3_id='$client3ID', ".
                    "level='$lessonLvl', clerk_name='$clerkName', length='$lenOfLesson', instructor='$instructor',".
                    " desk_or_request='$reqInput', notes='$lessonNotes', paid='$paid', checked_in='$chIn', finalized_in_sales='$fin' ".
                    "WHERE id='".$_POST['lessonId']."';";
                // $sql = "UPDATE ".$db_table." SET ".
                //     "client1_id='$client1ID', client2_id='$client2ID', client3_id='$client3ID' ".
                //     "WHERE id='".$_POST['lessonId']."';";
                mysqli_query($link, $sql);
                closeSession();
                header('Location: viewLesson.php');
            }

        }

        mysqli_close($link);
    }
}

function getClientNames() {
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $db_table = "mydb.Client";

    // selects all clients in DB
    $sql = "SELECT * FROM ".$db_table." ORDER BY last_name;";

    $result = mysqli_query($link, $sql);

    while($row = mysqli_fetch_array($result) ) {
        echo "<option value='".$row['id']."'>".$row['last_name'].", ".$row['first_name']." - ".$row['phone_number']."</option>";
    }

    mysqli_close($link);
}

function addOrSaveClick() {
    // to save client info in case page reload
    if (isset($_POST['addPersonBtn'])) {
        setClientIDs();
        switch($_POST['addPersonBtn']) {
            case "Add":
                $fullNameDd = $_POST['fullName'];
                $stuFName = $_POST['fname'];
                $stuLName = $_POST['lname'];
                $stuAge = $_POST['age'];
                $stuParent = $_POST['parent'];
                $stuPhoneNum = $_POST['phone'];
                $stuNotes = $_POST['notes'];
                global $addedClientID;
                resetClientID();
                setTotNumInLesson();

                $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

                $db_table = "mydb.Client";
                // checks to make sure the first name, last name, and phone number are
                // set to check if an instance already exists
                if ($fullNameDd == 0 && $stuFName != "" && $stuLName != "" && $stuPhoneNum != "") {
                    $sql_result = mysqli_query($link, "SELECT * FROM ".$db_table." WHERE first_name='".$stuFName."' AND last_name='".$stuLName."' AND phone_number='".$stuPhoneNum."';");

                    if(mysqli_num_rows($sql_result) == 0) {
                        // inserts into DB if an instance doesn't exist
                        $sql = "INSERT INTO ".$db_table." (first_name, last_name, age, parent, phone_number, notes) VALUES ('$stuFName', '$stuLName', '$stuAge', '$stuParent', '$stuPhoneNum', '$stuNotes');";
                        mysqli_query($link, $sql);

                        //used to add new client in the front-end (addLesson.php)
                        $addedClientID = $link->insert_id;
                        $num = $_SESSION['totalNumOfClientsInThisLesson'] + 1;
                        if ($num <= 3) {
                            $clientIdHid = 'hidClient'.$num;
                            $_SESSION[$clientIdHid] = $addedClientID;
                        }

                    }
                }
                mysqli_close($link);
                break;
            case "Save":
                $stuFName = $_POST['fname'];
                $stuLName = $_POST['lname'];
                $stuAge = $_POST['age'];
                $stuParent = $_POST['parent'];
                $stuPhoneNum = $_POST['phone'];
                $stuEmail = $_POST['email'];
                $stuNotes = $_POST['notes'];
                $currID = $_POST['currClientEditing'];
                resetClientID();
                setTotNumInLesson();

                $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

                $db_table = "mydb.Client";
                // checks to make sure the first name, last name, and phone number are
                // set to check if an instance already exists
                if ($stuFName != "" && $stuLName != "" && $stuPhoneNum != "") {
                    $sql = "UPDATE ".$db_table." SET first_name='$stuFName', last_name='$stuLName', age='$stuAge', parent='$stuParent', email='$stuEmail', phone_number='$stuPhoneNum', notes='$stuNotes' WHERE id='$currID';";
                    mysqli_query($link, $sql);
                }
                mysqli_close($link);
                break;
            default:
            // do nothing
        }
    }
}

function getClientFirstName($stuID) {
    if ($stuID != "") {
        $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $db_table = "mydb.Client";

        // selects all clients in DB
        $sql = "SELECT first_name FROM ".$db_table." WHERE id=".$stuID.";";

        $result = mysqli_query($link, $sql);

        while($row = mysqli_fetch_array($result) ) {
            echo $row['first_name'];
        }

        mysqli_close($link);
    }

}

function getClientLastName($stuID) {
    if ($stuID != "") {
        $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $db_table = "mydb.Client";

        // selects all clients in DB
        $sql = "SELECT last_name FROM ".$db_table." WHERE id=".$stuID.";";

        $result = mysqli_query($link, $sql);

        while($row = mysqli_fetch_array($result) ) {
            echo $row['last_name'];
        }

        mysqli_close($link);
    }
}

function getClientAge($stuID) {
    if ($stuID != "") {
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $db_table = "mydb.Client";

        // selects all clients in DB
        $sql = "SELECT age FROM ".$db_table." WHERE id=".$stuID.";";

        $result = mysqli_query($link, $sql);

        while($row = mysqli_fetch_array($result) ) {
            echo $row['age'];
        }

        mysqli_close($link);
    }
}

function getClientParent($stuID) {
    if ($stuID != "") {
        $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $db_table = "mydb.Client";

        // selects all clients in DB
        $sql = "SELECT parent FROM ".$db_table." WHERE id=".$stuID.";";

        $result = mysqli_query($link, $sql);

        while($row = mysqli_fetch_array($result) ) {
            echo $row['parent'];
        }

        mysqli_close($link);
    }
}

function getClientEmail($stuID) {
    if ($stuID != "") {
        $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $db_table = "mydb.Client";

        // selects all clients in DB
        $sql = "SELECT email FROM ".$db_table." WHERE id=".$stuID.";";

        $result = mysqli_query($link, $sql);

        while($row = mysqli_fetch_array($result) ) {
            echo $row['email'];
        }

        mysqli_close($link);
    }
}

function getClientPhoneNum($stuID) {
    if ($stuID != "") {
        $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $db_table = "mydb.Client";

        // selects all clients in DB
        $sql = "SELECT phone_number FROM ".$db_table." WHERE id=".$stuID.";";

        $result = mysqli_query($link, $sql);

        while($row = mysqli_fetch_array($result) ) {
            echo $row['phone_number'];
        }

        mysqli_close($link);
    }
}

function getClientNotes($stuID) {
    if ($stuID != "") {
        $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $db_table = "mydb.Client";

        // selects all clients in DB
        $sql = "SELECT notes FROM ".$db_table." WHERE id=".$stuID.";";

        $result = mysqli_query($link, $sql);

        while($row = mysqli_fetch_array($result) ) {
            echo $row['notes'];
        }

        mysqli_close($link);
    }
}

function resetClientID() {
    global $addedClientID;
    $addedClientID = '';
}

function setClientIDs() {
    if (isset($_POST['addPersonBtn'])) {
        $_SESSION['hidClient1'] = $_POST['hidClient1AddClientForm'];
        $_SESSION['hidClient2'] = $_POST['hidClient2AddClientForm'];
        $_SESSION['hidClient3'] = $_POST['hidClient3AddClientForm'];
    }
    if (isset($_POST['saveLessonBtn'])) {
        $_SESSION['hidClient1'] = $_POST['hidClient1'];
        $_SESSION['hidClient2'] = $_POST['hidClient2'];
        $_SESSION['hidClient3'] = $_POST['hidClient3'];
    }

}

function getClientIDInput($num) {
    $clientIdHid = 'hidClient'.$num;
    if (isset($_SESSION[$clientIdHid])) {
        echo $_SESSION[$clientIdHid];
    } else {
        echo "";
    }
}

function clearClientIDs() {
    // clears hidden client id data
    unset($_SESSION['hidClient1']);
    unset($_SESSION['hidClient2']);
    unset($_SESSION['hidClient3']);
}

function getClientInfo($id) {
    // makes sure there is a client id sent
    if ($id != "") {
        $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

        $db_table = "mydb.Client";
        $sql_result = mysqli_query($link, "SELECT * FROM ".$db_table." WHERE id='".$id."';");

        //if client instance exists
        if(mysqli_num_rows($sql_result) > 0) {
            $row = mysqli_fetch_array($sql_result);
            echo $row['last_name'].", ".$row['first_name']." - ".$row['phone_number'];
        } else {
            echo "";
        }

        mysqli_close($link);
    } else {
        echo "";
    }
}

function closeSession(){
    session_unset();
    session_destroy();
}

?>
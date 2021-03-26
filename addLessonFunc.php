<?php 
session_start();
$addedClientID = '';
$minDate = date("Y-m-d", strtotime("-1 days"));

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
}

function addLessonToDB() {
    if (isset($_POST['addLessonBtn'])) {
        setLessonFields();
        setClientIDs();
        setTotNumInLesson();
        if (isset($_POST['lessonType'])) {
            $lessonType = $_POST['lessonType'];
        } else  {
            $lessonType = '';
        }
        
        $lessonTypeInput = 0;
        if ($lessonType == 'SB') {
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

        
        $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

        $db_table = "mydb.Lesson";
        if ( $client1ID != "" && $dateOfLesson != "" && $timeOfLesson != "" && $lessonType != "" && $clerkName != "") {
            $sql_result = mysqli_query($link, "SELECT * FROM ".$db_table." WHERE date_of_lesson='".$dateOfLesson."' AND time_of_lesson='".$timeOfLesson."' AND".
                " client1_id='".$client1ID."' AND client2_id='".$client2ID."' AND client3_id='".$client3ID."';");

            if(mysqli_num_rows($sql_result) == 0) {
                // inserts into DB if an instance doesn't exist
                $sql = "INSERT INTO ".$db_table." (date_of_lesson, time_of_lesson, ski_or_snowboard, client1_id, client2_id, client3_id, ".
                    "level, clerk_name, length, instructor, desk_or_request, notes) ".
                    "VALUES ('$dateOfLesson', '$timeOfLesson', '$lessonTypeInput', '$client1ID', '$client2ID', '$client3ID','$lessonLvl', '$clerkName', '$lenOfLesson', '$instructor', '$reqInput', '$lessonNotes');";
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

function addClientToDB() {
    setClientIDs();
    
    // to save client info in case page reload
    if (isset($_POST['addPersonBtn'])) {
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
    if (isset($_POST['addLessonBtn'])) {
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
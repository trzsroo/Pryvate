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
    } else {
        $_SESSION['totalNumOfClientsInThisLesson'] = 0;
    }
}

function clearTotNumInLesson() {
   unset($_SESSION['totalNumOfClientsInThisLesson']);
}

function getLessonType() {
    if (isset($_SESSION['lessonType'])) {
        echo $_SESSION['lessonType'];
    }
}

function setLessonType() {
    $_SESSION['lessonType'] = $_POST['lessonType'];
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

function clearLessonType() {
    unset($_SESSION['lessonType']);
}

function setDateOfLesson() {
    $_SESSION['dateOfLesson'] = $_POST['dateOfLesson'];
}

function getDateOfLesson() {
    if (isset($_SESSION['dateOfLesson'])) {
        echo $_SESSION['dateOfLesson'];
    }
}

function clearDateOfLesson(){
    unset($_SESSION['dateOfLesson']);
}

function setTimeOfLesson() {
    $_SESSION['timeOfLesson'] = $_POST['timeOfLesson'];
}

function getTimeOfLesson() {
    if (isset($_SESSION['timeOfLesson'])) {
        echo $_SESSION['timeOfLesson'];
    }
}

function clearTimeOfLesson() {
    unset($_SESSION['timeOfLesson']);
}

function setLenOfLesson() {
    $_SESSION['lenOfLesson'] = $_POST['lenOfLesson'];
}

function getLenOfLesson() {
    if (isset($_SESSION['lenOfLesson'])) {
        echo $_SESSION['lenOfLesson'];
    }
}

function clearLenOfLesson() {
    unset($_SESSION['lenOfLesson']);
}

function setLessonLvl() {
    $_SESSION['lessonLvl'] = $_POST['lessonLvl'];
}

function getLessonLvl() {
    if (isset($_SESSION['lessonLvl'])) {
        echo $_SESSION['lessonLvl'];
    }
}

function clearLessonLvl() {
    unset($_SESSION['lessonLvl']);
}

function setInstructor() {
    $_SESSION['instructor'] = $_POST['instructor'];
}

function getInstructor() {
    if (isset($_SESSION['instructor'])) {
        echo $_SESSION['instructor'];
    }
}

function clearInstructor() {
    unset($_SESSION['instructor']);
}

function setRequested() {
    $_SESSION['requested'] =  $_POST['requested'];
}

function getRequested() {
    if (isset($_SESSION['requested'])) {
        if ($_SESSION['requested'] == 'requested') {
            echo 'checked=True';
        }
    }
}

function clearRequested() {
    unset($_SESSION['requested']);
}

function setLessonNotes() {
    $_SESSION['lessonNotes'] = $_POST['lessonNotes'];
}

function getLessonNotes() {
    if (isset($_SESSION['lessonNotes'])) {
        echo $_SESSION['lessonNotes'];
    }
}

function clearLessonNotes() {
    unset($_SESSION['lessonNotes']);
}

function setClerkName() {
    $_SESSION['clerkNotes'] = $_POST['clerkNotes'];
}

function getClerkName() {
    if (isset($_SESSION['clerkName'])) {
        echo $_SESSION['clerkName'];
    }
}

function clearClerkName() {
    unset($_SESSION['clerkName']);
}

function resetFields() {
    clearLessonType();
    clearDateOfLesson();
    clearTimeOfLesson();
    clearLenOfLesson();
    clearLessonLvl();
    clearInstructor();
    clearRequested();
    clearClerkName();
    clearLessonNotes();
    clearClientIDs();
    clearTotNumInLesson();
    closeSession();
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
    $lessonType = getLessonType();
    $dateOLesson = getDateOfLesson();
    $timeOfLesson = getTimeOfLesson();
    $lenOfLesson = getLenOfLesson();
    $lessonLvl = getLessonLvl();
    $instructor = getInstructor();
    $req = getRequested();
    $lessonNotes = getLessonNotes();

    //code to add lesson to datebase

    resetFields();
    closeSession();
}

function getClientNames() {
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $db_table = "mydb.Client";
                                
    $sql = "SELECT * FROM ".$db_table." ORDER BY last_name;";
                                            
    $result = mysqli_query($link, $sql);

    while($row = mysqli_fetch_array($result) ) {
        echo "<option value='".$row['id']."'>".$row['last_name'].", ".$row['first_name']." - ".$row['phone_number']."</option>";
    }

    mysqli_close($link); 
}

function addClientToDB() {
    $fullNameDd = $_POST['fullName'];
    $stuFName = $_POST['fname'];
    $stuLName = $_POST['lname'];
    $stuAge = $_POST['age'];
    $stuParent = $_POST['parent'];
    $stuPhoneNum = $_POST['phone'];
    $stuNotes = $_POST['notes'];
    global $addedClientID;
    global $client1ID;

    $_SESSION['hidClient1'] = $_POST['hidClient1AddClientForm'];
    $_SESSION['hidClient2'] = $_POST['hidClient2AddClientForm'];
    $_SESSION['hidClient3'] = $_POST['hidClient3AddClientForm'];
    setTotNumInLesson();

    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    
    $db_table = "mydb.Client";

    if ($fullNameDd == 0) {
        $sql_result = mysqli_query($link, "SELECT * FROM ".$db_table." WHERE first_name='".$stuFName."' AND last_name='".$stuLName."' AND phone_number='".$stuPhoneNum."';");

        if(mysqli_num_rows($sql_result) == 0) {
            $sql = "INSERT INTO ".$db_table." (first_name, last_name, age, parent, phone_number, notes) VALUES ('$stuFName', '$stuLName', '$stuAge', '$stuParent', '$stuPhoneNum', '$stuNotes');";
            mysqli_query($link, $sql);
            $addedClientID = $link->insert_id;
        } 
    }
    mysqli_close($link);

}

function resetClientID() {
    global $addedClientID;
    $addedClientID = '';
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
    unset($_SESSION['hidClient1']);
    unset($_SESSION['hidClient2']);
}

function getClientInfo($id) {
    if ($id != "") {
        $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    
        $db_table = "mydb.Client";
        $sql_result = mysqli_query($link, "SELECT * FROM ".$db_table." WHERE id='".$id."';");

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
    session_destroy();
}

//USed to test some stuff
// if ($_SERVER["REQUEST_METHOD"] == "GET") {
//     $db_table = "Lesson";

//     $type = $_POST['lessonLvl'];
//     echo $type;
//     // $dateOfLesson = $_POST['dateOfLesson'];
//     // $email = $_POST['email'];
//     // $password = $_POST['password'];
//     // $DOB = $_POST['dob'];
//     // $Genre = $_POST['Genre'];

//     // $sql = "INSERT INTO " .$db_table. " (name, user_name, user_email, dob, genre, user_password)
//     //     VALUES ('$name','$username','$email','$DOB','$Genre','$password');";

//     // mysqli_query($connection, $sql);

//     // header("Location:{location of view private lesson}.php"); 

//     // mysqli_close($connection);
// }

?>
<?php 
// session_starst();
$addedClientID = '';
$minDate = date("Y-m-d", strtotime("-1 days"));

//function to see if at least one person is added to either show or hid add lesson btn
function getTotNumInLesson() {
    if (isset($_POST['totalNumOfClientsInThisLesson'])) {
        echo $_POST['totalNumOfClientsInThisLesson'];
    } else {
        echo 0;
    }
}

function clearTotNumInLesson() {
    $_POST['totalNumOfClientsInThisLesson'] = 0;
}

function getLessonType() {
    if (isset($_POST['lessonType'])) {
        echo $_POST['lessonType'];
    }
}

function lessonTypeChecked(String $lessonType) {
    if (isset($_POST['lessonType'])) {
        if ($_POST['lessonType'] == $lessonType) {
            echo 'checked="checked"';
        } else {
            echo '';
        }
    }
}

function clearLessonType() {
    $_POST['lessonType'] = '';
}

function getDateOfLesson() {
    if (isset($_POST['dateOfLesson'])) {
        echo $_POST['dateOfLesson'];
    }
}

function clearDateOfLesson(){
    $_POST['dateOfLesson'] = '';
}

function getTimeOfLesson() {
    if (isset($_POST['timeOfLesson'])) {
        echo $_POST['timeOfLesson'];
    }
}

function clearTimeOfLesson() {
    $_POST['timeOfLesson'] = '';
}

function getLenOfLesson() {
    if (isset($_POST['lenOfLesson'])) {
        echo $_POST['lenOfLesson'];
    }
}

function clearLenOfLesson() {
    $_POST['lenOfLesson'] = '';
}

function getLessonLvl() {
    if (isset($_POST['lessonLvl'])) {
        echo $_POST['lessonLvl'];
    }
}

function clearLessonLvl() {
    $_POST['lessonLvl'] = '';
}

function getInstructor() {
    if (isset($_POST['instructor'])) {
        echo $_POST['instructor'];
    }
}

function clearInstructor() {
    $_POST['instructor'] = '';
}

function getRequested() {
    if (isset($_POST['requested'])) {
        if ($_POST['requested'] == 'requested') {
            echo 'checked=True';
        }
    }
}

function clearRequested() {
    $_POST['requested'] = '';
}

function getLessonNotes() {
    if (isset($_POST['lessonNotes'])) {
        echo $_POST['lessonNotes'];
    }
}

function clearLessonNotes() {
    $_POST['lessonNotes'] = '';
}

function getClerkName() {
    if (isset($_POST['clerkName'])) {
        echo $_POST['clerkName'];
    }
}

function clearClerkName() {
    $_POST['clerkName'] = '';
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
    global $addedClientID, $numInLesson;

    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    
    $db_table = "mydb.Client";

    if ($fullNameDd == 0) {
        $sql_result = mysqli_query($link, "SELECT * FROM ".$db_table." WHERE first_name='".$stuFName."' AND last_name='".$stuLName."' AND phone_number='".$stuPhoneNum."';");

        if(mysqli_num_rows($sql_result) == 0) {
            $sql = "INSERT INTO ".$db_table." (first_name, last_name, age, parent, phone_number, notes) VALUES ('$stuFName', '$stuLName', '$stuAge', '$stuParent', '$stuPhoneNum', '$stuNotes');";
            mysqli_query($link, $sql);
            $addedClientID = $link->insert_id;
        } else {
            //clear fields
        $_POST['fname'] = '';
        $_POST['lname'] = '';
        $_POST['age'] = '';
        $_POST['parent'] = '';
        $_POST['phone'] = '';
        $_POST['notes'] = '';
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
    if (isset($_POST[$clientIdHid])) {
        echo $_POST[$clientIdHid];
    } else {
        echo "";
    }
}

function clearClientIDs() {
    $_POST['hidClient1'] = '';
    $_POST['hidClient2'] = '';
}

function getClientInfo($id) {
    if ($id != "") {
        $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    
        $db_table = "mydb.Client";
        $sql_result = mysqli_query($link, "SELECT * FROM ".$db_table." WHERE id='".$id."';");

        if(mysqli_num_rows($sql_result) > 0) {
            $row = mysqli_fetch_array($sql_result);
            echo '"'.$row['last_name'].", ".$row['first_name']." - ".$row['phone_number'].'"';
        } 

        mysqli_close($link);
    }
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
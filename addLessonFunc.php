<?php 
$added = False;
$minDate = date("Y-m-d", strtotime("-1 days"));

//function to see if at least one person is added to either show or hid add lesson btn


function getLessonType() {
    echo $_POST['lessonType'];
}

function lessonTypeChecked(String $lessonType) {
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
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
        echo $_POST['dateOfLesson'];
}

function clearDateOfLesson(){
    $_POST['dateOfLesson'] = '';
}

function getTimeOfLesson() {
    echo $_POST['timeOfLesson'];
}

function clearTimeOfLesson() {
    $_POST['timeOfLesson'] = '';
}

function getLenOfLesson() {
    echo $_POST['lenOfLesson'];
}

function clearLenOfLesson() {
    $_POST['lenOfLesson'] = '';
}

function getLessonLvl() {
    echo $_POST['lessonLvl'];
}

function clearLessonLvl() {
    $_POST['lessonLvl'] = '';
}

function getInstructor() {
    echo $_POST['instructor'];
}

function clearInstructor() {
    $_POST['instructor'] = '';
}

function getRequested() {
    if ($_POST['requested'] != '') {
        echo 'checked="check"';
    }
}

function clearRequested() {
    $_POST['requested'] = '';
}

function getLessonNotes() {
    echo $_POST['lessonNotes'];
}

function clearLessonNotes() {
    $_POST['lessonNotes'] = '';
}

function resetFields() {
    clearLessonType();
    clearDateOfLesson();
    clearTimeOfLesson();
    clearLenOfLesson();
    clearLessonLvl();
    clearInstructor();
    clearRequested();
    clearLessonNotes();
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
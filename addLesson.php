<html>
    <head>
        <link rel="stylesheet" href="pryvateStyle.css">
        <title>Add Private Lesson</title>
    </head>
    <body>
        <?php 
            require_once('config.php');
            include 'addLessonFunc.php';
            
        ?>
        <h1>Add New Private Lesson</h1>
        <div class="lessonInfo">
        <h2>General Lesson Information</h2>
        <form id="lessonInfo" method="POST" autocomplete="true" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label class="boldLabel">Type of Lesson: </label>
            <input type="radio" id="lessonTypeSki" name="lessonType" value="ski" <?php lessonTypeChecked('ski'); ?>>
            <label for="ski">Ski </label>
            <input type="radio" id="lessonTypeSB" name="lessonType" value="SB" <?php lessonTypeChecked('SB'); ?>>
            <label for="SB">Snowboard </label>
            <br/><br/>
            <label class="boldLabel">Date of Lesson: </label>
            <input type="date" name="dateOfLesson" id="dateOfLesson" min=<?php echo $minDate;?> value=<?php getDateOfLesson(); ?>>
            <br/><br/>
            <label class="boldLabel">Time of Lesson: </label>
            <input type="time" name="timeOfLesson" id="timeOfLesson" min="07:00" max="21:00" value=<?php getTimeOfLesson(); ?>>
            <br/><br/>
            <label class="boldLabel">Length of Lesson: </label>
            <input type="number" name="lenOfLesson" id="lenOfLesson" step="0.5" value=<?php getLenOfLesson(); ?>>
            <label> hour(s)</label>
            <br/><br/>
            <label class="boldLabel">Lesson Level: </label>
            <input type="text" name="lessonLvl" id="lessonLvl" size="3" maxlength="3" value=<?php getLessonLvl(); ?>>
            <br/><br/>
            <label class="boldLabel">Instructor: </label>
            <input type="text" name="instructor" id="instructor" value=<?php getInstructor(); ?>>
            <label class="boldLabel">&nbsp;Requested? </label>
            <input type="checkbox" name="requested" id="requested" value=<?php getRequested(); ?>>
            <br/><br/>
            <label class="boldLabel">Notes: </label>
            <input type="text" name="lessonNotes" id="lessonNotes" width="50" value=<?php getLessonNotes(); ?>>
            <br/><br>
            <input type="submit" value="Add Lesson">
        </form>
        </div>
        <div class="popUp">
        <!--Popup to add student(s)-->
        <h2>Student(s)</h2>
        <label class="boldLabel" id="addPersonLabel">Add Person</label>
        <button id="addClientBtn">+</button>
        </div>
    </body>
</html>
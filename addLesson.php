<html>
    <head>
        <link rel="stylesheet" href="pryvate.css">
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
            <input type="checkbox" name="requested" id="requested" value="requested" <?php getRequested(); ?>>
            <br/><br/>
            <label class="boldLabel">Notes: </label>
            <input type="text" name="lessonNotes" id="lessonNotes" width="50" value=<?php getLessonNotes(); ?>>
            <br/><br>
            <label class="boldLabel">Clerk: </label>
            <input type="text" name="clerkName" id="clerkName" maxlength="3" value=<?php getClerkName(); ?>>
            <br /><br />
            <input type="submit" value="Add Lesson">
        </form>
        </div>


        <h2>Student(s)</h2>
        <label id="client1Lbl" class="clientLabel"></label>
        <input type="hidden" id="client1Hid">
        <button id="client1Dlt" class="delBtn" onclick="delClientFromLesson(1);">Delete</button>
        <!-- <br/>
        <label id="client2Lbl" class="clientLabel"></label>
        <input type="hidden" id="client2Hid">
        <button id="client2Dlt" class="delBtn" onclick="delClientFromLesson(1);">Delete</button>
        <input type="hidden" id="totalNumOfClientsInThisLesson" /> -->
        <br /><br />
        <label class="boldLabel" id="addPersonLabel">Add Client</label>
        <button id="addClientBtn" onclick="openForm();">+</button>


        <div class="form-popup" id="clientInfo">
          <!-- database integration -->
          <form class="form-container" method="POST" id="clientForm">
            <h3>Add New Client</h3>

            <label for="fullName" id="fullNameLbl"><b>*Name:</b></label>
            <select name="fullName" id="fullNamedd" onchange="exists();">
                <option value="-1"> </option>
                <?php getClientNames(); ?>
                <option value="0">&lt;Add New Client&gt;</option>
            </select>

            <label for="fname" id="firstNameLbl"><b>*First Name:</b></label>
            <input type="text" name="fname" id="fname">

            <label for="lname" id="lastNameLbl"><b>*Last Name:</b></label>
            <input type="text" name="lname" id="lname">

            <label for="age"><b>*Age:</b></label>
            <input type="text" name="age" required>

            <label for="parent"><b>Parent:</b></label>
            <input type="text" name="parent">

            <label for="phone"><b>*Phone:</b></label>
            <input type="text" name="phone" required>

            <label for="notes"><b>Notes:</b></label>
            <input type="text" name="notes">

            <input type="submit" id="addPersonBtn" name="addPersonBtn" class="btn" value="Add Client" onclick="<?php addClientToDB(); ?>">
            <input type="button" id="cancelBtn" name="cancelBtn" class="btn cancel" onclick="closeForm()" value="Close">
          </form>
        </div>

        <script>
            var fullNameLbl = document.getElementById("fullNameLbl");
            var fullNameDd = document.getElementById("fullNamedd");
            var firstNameLbl = document.getElementById("firstNameLbl");
            var firstNameBox = document.getElementById("fname");
            var lastNameLbl = document.getElementById("lastNameLbl");
            var lastNameBox = document.getElementById("lname");
            var client1Lbl = document.getElementById("client1Lbl");
            var client1Hid = document.getElementById("client1Hid");
            var client1DelBtn = document.getElementById('client1Dlt');
            client1DelBtn.style.display = "none";
            var totNumOfClients = document.getElementById('totalNumOfClientsInThisLesson');
    
            window.onload = closeForm();

            function openForm() {
                document.getElementById("clientInfo").style.display = "block";
            }

            function closeForm() {
                document.getElementById("clientInfo").style.display = "none";
                fullNameDd.value = -1;
                exists();
            }

            window.onload = function addToStudentView() {
                $id = <?php if($addedClientID != '') {echo $addedClientID;} else { echo -1;} ?>;
                if ($id != -1) {
                    $str = <?php echo "client1Lbl.innerHTML = '".$_POST['lname'].", ".$_POST['fname']." - ".$_POST['phone']."';"; ?>;
                    addClientToStuView($id, $str);
                }
            }

            function exists() {
                if (fullNameDd.value == -1) {
                    fullNameDd.style.display = "block";
                    fullNameLbl.style.display = "block";
                    firstNameLbl.style.display = "none";
                    firstNameBox.style.display = "none";
                    lastNameLbl.style.display = "none";
                    lastNameBox.style.display = "none";
                } 
                else {
                    fullNameDd.style.display = "none";
                    fullNameLbl.style.display = "none";
                    firstNameLbl.style.display = "block";
                    firstNameBox.style.display = "block";
                    lastNameLbl.style.display = "block";
                    lastNameBox.style.display = "block";
                    if (fullNameDd.value > 0) {
                        var selVal = fullNameDd.value;
                        closeForm();
                        for (i = 0; i < fullNameDd.length; i++) {
                            var currOpt = fullNameDd.options[i].value;
                            if (selVal == currOpt) {
                                addClientToStuView(currOpt, fullNameDd.options[i].text)
                            }
                        }
                    }
                }
            }

            function addClientToStuView(id, str) {
                client1Lbl.innerHTML = str;
                client1DelBtn.style.display = '';
                client1Hid.value = id;
            }

            function delClientFromLesson(num) {
                if (parseInt(num) == 1) {}
                    client1Lbl.innerHTML = '';
                    client1Hid.value = '';
                    client1DelBtn.style.display = "none";
            }
        </script>
    </body>
</html>
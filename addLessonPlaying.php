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
        <button id="cancelAddingLesson" onclick="<?php resetFields(); ?>">x</button>
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
            <input type="hidden" id="client1Hid" name="hidClient1" value="<?php getClientIDInput('1');?>">
            <input type="hidden" id="client2Hid" name="hidClient2" value="<?php getClientIDInput('2');?>">
            <input type="hidden" id="totalNumOfClientsInThisLesson" name="totalNumOfClientsInThisLesson" value="<?php getTotNumInLesson(); ?>" >
            <input type="submit" value="Add Lesson" id="addLessonBtn">
        </form>
        </div>


        <h2>Student(s)</h2>
        <label id="client1Lbl" class="clientLabel"></label>
        <button id="client1Dlt" class="delBtn" onclick="delClientFromLesson(1);">Delete</button>
        <br/>
        <label id="client2Lbl" class="clientLabel"></label>
        <button id="client2Dlt" class="delBtn" onclick="delClientFromLesson(2);">Delete</button>
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
            <input type="button" id="cancelBtn" name="cancelBtn" class="btn cancel" onclick="closeForm();" value="Close">
            <input type="hidden" id="hidClient1" name="hidClient1" >
            <input type="hidden" id="hidClient2" name="hidClient2" >
            <input type="hidden" id="totalNumOfClientsInThisLesson2" name="totalNumOfClientsInThisLesson" value="<?php getTotNumInLesson(); ?>" >
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
            var client1HidGenLess = document.getElementById("client1Hid");
            var client1DelBtn = document.getElementById('client1Dlt');
            client1DelBtn.style.display = "none";
            var client2Lbl = document.getElementById("client2Lbl");
            var client2HidGenLess = document.getElementById("client2Hid");
            var client2DelBtn = document.getElementById('client2Dlt');
            client2DelBtn.style.display = "none";
            var totNumOfClients = document.getElementById('totalNumOfClientsInThisLesson');
            var totNumOfClients2 = document.getElementById('totalNumOfClientsInThisLesson2');
            var addLessonBtn = document.getElementById('addLessonBtn');
            var client1HidClientForm = document.getElementById("hidClient1");
            var client2HidClientForm = document.getElementById("hidClient2");

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
                id = <?php if($addedClientID != '') {echo $addedClientID;} else { echo -1;} ?>;
                if (id != -1) {
                    totNumOfClients.value = parseInt(totNumOfClients.value) + 1;
                    totNumOfClients2.value = totNumOfClients.value;
                    str = <?php echo '"'.$_POST['lname'].", ".$_POST['fname']." - ".$_POST['phone'].'"'; ?>;
                    addClientToStuView(id, str, totNumOfClients.value);
                    <?php resetClientID(); ?>
                } 
                (parseInt(totNumOfClients.value) == 0) ? addLessonBtn.style.display = "none": addLessonBtn.style.display = "";
            }

            function movStudentView(id, str, num) {
                addClientToStuView(id, str, num);
                clearClient(totNumOfClients.value);
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
                                totNumOfClients.value = parseInt(totNumOfClients.value) + 1;
                                totNumOfClients2.value = totNumOfClients.value;
                                (parseInt(totNumOfClients.value) == 0) ? addLessonBtn.style.display = "none": addLessonBtn.style.display = "";
                                addClientToStuView(selVal, fullNameDd.options[i].text, totNumOfClients.value);
                            }
                        }
                    }
                }
            }

            function addClientToStuView(id, str, num) {
                if (parseInt(num) == 1) {
                    client1Lbl.innerHTML = str;
                    client1DelBtn.style.display = "";
                    client1HidGenLess.value = id;
                    client1HidClientForm.value = id;
                } if (parseInt(num) == 2) {
                    client2Lbl.innerHTML = str;
                    client2DelBtn.style.display = "";
                    client2HidGenLess.value = id;
                    client2HidClientForm.value = id;
                }
            }

            function clearClient(num) {
                if (parseInt(num) == 1) {
                    client1Lbl.innerHTML = '';
                    client1HidGenLess.value = '';
                    client1HidClientForm.value = ""
                    client1DelBtn.style.display = "none";
                } 
                if (parseInt(num) == 2) {
                    client2Lbl.innerHTML = '';
                    client2HidGenLess.value = '';
                    client2HidClientForm.value = '';
                    client2DelBtn.style.display = "none";
                } 
                // if (parseInt(num) == 3) {
                //     client3Lbl.innerHTML = '';
                //     client3Hid.value = '';
                //     client3DelBtn.style.display = "none";
                // } 
            }

            function delClientFromLesson(num) {
                if (parseInt(num) == 1) {
                    var numPeople = totNumOfClients.value;
                    clearClient(1);
                    if (parseInt(numPeople) > 1) {
                        movStudentView(client2HidGenLess.value, client2Lbl.innerHTML, 1);
                    }
                }
                if (parseInt(num) == 2) {
                    // var numPeople = totNumOfClients.value;
                    clearClient(2);
                    // if (parseInt(numPeople) > 1) {
                    //     movStudentView(client1HidGenLess.value, client2Lbl.innerHTML, 1);
                    // }
                }
                totNumOfClients.value = parseInt(totNumOfClients.value) - 1;
                totNumOfClients2.value = totNumOfClients.value;
            }
        </script>
    </body>
</html>
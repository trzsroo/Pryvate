  
<html>
    <head>
        <link rel="stylesheet" href="pryvate.css">
        <title>Modify Private Lesson</title>
    </head>
    <body>
        <?php
            require_once('config.php');
            include 'modifyLessonFunc.php';
        ?>
        <h1>Modify Private Lesson</h1>
        <div class="lessonInfo">
            <button id="cancelAddingLesson" style="float: right;" title="Cancel editing lesson">x</button>
            <h2>General Lesson Information</h2>
            <form id="lessonInfo" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <label class="boldLabel">*Type of Lesson: </label>
                <input type="radio" id="lessonTypeSki" name="lessonType" value="ski" >
                <label for="ski">Ski </label>
                <input type="radio" id="lessonTypeSB" name="lessonType" value="SB" >
                <label for="SB">Snowboard </label>
                <br/><br/>
                <label class="boldLabel">*Date of Lesson: </label>
                <input type="date" name="dateOfLesson" id="dateOfLesson">
                <br/><br/>
                <label class="boldLabel">*Time of Lesson: </label>
                <input type="time" name="timeOfLesson" id="timeOfLesson" min="07:00" max="21:00" >
                <br/><br/>
                <label class="boldLabel">Length of Lesson: </label>
                <input type="number" name="lenOfLesson" id="lenOfLesson" step="0.5" >
                <label> hour(s)</label>
                <br/><br/>
                <label class="boldLabel">Lesson Level: </label>
                <input type="text" name="lessonLvl" id="lessonLvl" size="3" maxlength="3" >
                <br/><br/>
                <label class="boldLabel">Instructor: </label>
                <input type="text" name="instructor" id="instructor" >
                <label class="boldLabel">&nbsp;Requested? </label>
                <input type="checkbox" name="requested" id="requested" value="requested" >
                <br/><br/>
                <label class="boldLabel">Notes: </label>
                <input type="text" name="lessonNotes" id="lessonNotes" width="50" >
                <br/><br>
                <label class="boldLabel">*Clerk: </label>
                <input type="text" name="clerkName" id="clerkName" maxlength="3" >
                <br /><br />
                <label class="boldLabel">&nbsp;Paid? </label>
                <input type="checkbox" name="paid" id="paid" value="paid">
                <label class="boldLabel">&nbsp;Checked in? </label>
                <input type="checkbox" name="checkIn" id="checkIn" value="checkIn" >
                <label class="boldLabel">&nbsp;Finalized? </label>
                <input type="checkbox" name="finalize" id="finalize" value="finalize" >
                <br/><br/>
                <input type="hidden" id="client1Hid" name="hidClient1" >
                <input type="hidden" id="client2Hid" name="hidClient2" >
                <input type="hidden" id="client3Hid" name="hidClient3" >
                <input type="hidden" id="totalNumOfClientsInThisLesson" name="totalNumOfClientsInThisLesson" >
                <input type="hidden" id="lessonId" name="lessonId" >
                <!-- lesson buttons -->
                <input type="submit" value="Save Lesson" name="saveLessonBtn" id="saveLessonBtn" onclick="<?php saveLessonToDB(); ?>">
                <button id="deleteLessonBtn" style="float: right;" onclick="<?php delLessonFromDB(); ?>">Delete Lesson</button>
            </form>
        </div>

<!-- add and delete students from lesson buttons and label -->
        <h2 title="At least one student required to enter lesson">*Student(s)</h2>
        <label id="client1Lbl" class="clientLabel"></label>
        <button id="client1Edit" class="editBtn" onclick="editClientInfo(1);">Edit</button>
        <button id="client1Dlt" class="delBtn" onclick="delClientFromLesson(1);">Delete</button>
        <br/>
        <label id="client2Lbl" class="clientLabel"></label>
        <button id="client2Edit" class="editBtn" onclick="editClientInfo(2);">Edit</button>
        <button id="client2Dlt" class="delBtn" onclick="delClientFromLesson(2);">Delete</button>
        <br />
        <label id="client3Lbl" class="clientLabel"></label>
        <button id="client3Edit" class="editBtn" onclick="editClientInfo(3);">Edit</button>
        <button id="client3Dlt" class="delBtn" onclick="delClientFromLesson(3);">Delete</button>
        <br />

<!-- add client button -->
        <label class="boldLabel" id="addPersonLabel">Add Student</label>
        <button id="addClientBtn" onclick="openForm();">+</button>

<!-- add new client info -->
        <div class="form-popup" id="clientInfo">
          <!-- database integration -->
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="form-container" method="POST" id="clientForm">
            <h3>Add New Client</h3>
            <label for="fullName" id="fullNameLbl"><b>*Name:</b></label>
            <select name="fullName" id="fullNamedd" onchange="exists();">
                <option value="0">&lt;Add New Student&gt;</option>
                <?php getClientNames(); ?>
                <option value="-1"> </option>
            </select>

            <label for="fname" id="firstNameLbl"><b>*First Name:</b></label>
            <input type="text" name="fname" id="fname">

            <label for="lname" id="lastNameLbl"><b>*Last Name:</b></label>
            <input type="text" name="lname" id="lname">

            <label for="age"><b>*Age:</b></label>
            <input type="text" name="age" id="age" required>

            <label for="parent"><b>Parent:</b></label>
            <input type="text" name="parent" id="parent">

            <label for="phone"><b>*Phone:</b></label>
            <input type="text" name="phone" id="phone" required>

            <label for="notes"><b>Notes:</b></label>
            <input type="text" name="notes" id="notes">


<!-- hidden client info -->
            <input type="submit" id="addPersonBtn" name="addPersonBtn" class="btn" value="Add" onclick="<?php addOrSaveClick(); ?>">
            <input type="button" id="cancelBtn" name="cancelBtn" class="btnCancel" onclick="closeForm();" value="Close">
            <input type="hidden" id="currClientEditing" name="currClientEditing" >
            <input type="hidden" id="hidClient1" name="hidClient1AddClientForm" >
            <input type="hidden" id="hidClient2" name="hidClient2AddClientForm" >
            <input type="hidden" id="hidClient3" name="hidClient3AddClientForm" >
            <input type="hidden" id="totalNumOfClientsInThisLesson2" name="totalNumOfClientsInThisLesson2" >
                <input type="hidden" id="lessonId2" name="lessonId2" >
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
            var client1EditBtn = document.getElementById('client1Edit');
            var client1DelBtn = document.getElementById('client1Dlt');
            client1EditBtn.style.display = "none";
            client1DelBtn.style.display = "none";
            var client1HidClientForm = document.getElementById("hidClient1");
            var client2Lbl = document.getElementById("client2Lbl");
            var client2HidGenLess = document.getElementById("client2Hid");
            var client2EditBtn = document.getElementById('client2Edit');
            var client2DelBtn = document.getElementById('client2Dlt');
            client2EditBtn.style.display = "none";
            client2DelBtn.style.display = "none";
            var client2HidClientForm = document.getElementById("hidClient2");
            var client3Lbl = document.getElementById("client3Lbl");
            var client3HidGenLess = document.getElementById("client3Hid");
            var client3EditBtn = document.getElementById('client3Edit');
            var client3DelBtn = document.getElementById('client3Dlt');
            client3EditBtn.style.display = "none";
            client3DelBtn.style.display = "none";
            var client3HidClientForm = document.getElementById("hidClient3");
            var saveLessonBtn = document.getElementById('saveLessonBtn');
            var totNumOfClients = document.getElementById('totalNumOfClientsInThisLesson');
            var totNumOfClients2 = document.getElementById('totalNumOfClientsInThisLesson2');
            var currClientEdit = document.getElementById('currClientEditing');

            var addOrSaveBtn = document.getElementById('addPersonBtn');

            var lRadioSki = document.getElementById('lessonTypeSki');
            var lRadioSB = document.getElementById('lessonTypeSB');
            var lDate = document.getElementById('dateOfLesson');
            var lTime = document.getElementById('timeOfLesson');
            var lLen = document.getElementById('lenOfLesson');
            var lLevel = document.getElementById('lessonLvl');
            var lInstr = document.getElementById('instructor');
            var lRequ = document.getElementById('requested');
            var lNotes = document.getElementById('lessonNotes');
            var lClerk = document.getElementById('clerkName');
            var lPaid = document.getElementById('paid');
            var lChIn = document.getElementById('checkIn');
            var lFin = document.getElementById('finalize');

            var clientFirstName = document.getElementById('fname');
            var clientLastName = document.getElementById('lname');
            var clientAge = document.getElementById('age');
            var clientParent = document.getElementById('parent');
            var clientPhone = document.getElementById('phone');
            var clientNotes = document.getElementById('notes');

            var genLessonHidLessonId = document.getElementById('lessonId');
            var addStudHidLessonId = document.getElementById('lessonId2');

//open and close form
            function openForm() {
                document.getElementById("clientInfo").style.display = "block";
            }

            function closeForm() {
                document.getElementById("clientInfo").style.display = "none";
                fullNameDd.value = -1;
                clientFirstName.value = "";
                clientLastName.value = "";
                clientAge.value = "";
                clientParent.value = "";
                clientPhone.value = "";
                clientNotes.value = "";
                currClientEdit.value = ""
                addOrSaveBtn.value = "Add"
                exists();
            }

          //hide delete button if lesson was paid for
          function delLessonHide() {
            var delLess = document.getElementById("deleteLessonBtn");
            delLess.style.display = "none";}
          
            window.onload = function reloadExistingData() {
                // reloadFormInfo();
                getLessonInfo();
                genLessonHidLessonId.value = "<?php setLessonID(); getLessonID(); ?>";
                addStudHidLessonId.value = "<?php getLessonID(); ?>";
                totNumOfClients.value = parseInt(0);
                totNumOfClients2.value = totNumOfClients.value;
                //add exisiting 
                var clientID1 = "<?php getClientID("1"); ?>";
                var clientID2 = "<?php getClientID("2"); ?>";
                var clientID3 = "<?php getClientID("3"); ?>";
                if (clientID1 != "") {
                    addClientToStuView(clientID1, "<?php  if (isset($_SESSION['hidClient1'])) { getClientInfo($_SESSION['hidClient1']); } ?>", 1);
                    totNumOfClients.value = parseInt(totNumOfClients.value) + 1;
                    totNumOfClients2.value = totNumOfClients.value;
                }
                if (clientID2 != "") {
                    addClientToStuView(clientID2, "<?php  if (isset($_SESSION['hidClient2'])) { getClientInfo($_SESSION['hidClient2']); } ?>", 2);
                    totNumOfClients.value = parseInt(totNumOfClients.value) + 1;
                    totNumOfClients2.value = totNumOfClients.value;
                }
                if (clientID3 != ""){
                    addClientToStuView(clientID3, "<?php  if (isset($_SESSION['hidClient3'])) { getClientInfo($_SESSION['hidClient3']); } ?>", 3);
                    totNumOfClients.value = parseInt(totNumOfClients.value) + 1;
                    totNumOfClients2.value = totNumOfClients.value;
                }
                addToStudentView();
            }
          
            //query lesson id and add Information
            function getLessonInfo() {
                var modType = "<?php queryLessonType($_SESSION['lessonId'])?>";
                switch (modType) {
                    case "0":
                        lRadioSki.checked = true;
                        break;
                    case "1":
                        lRadioSB.checked = true;
                        break;
                    default:
                        //do nothing
                }

                var modDate = "<?php queryLessonDate($_SESSION['lessonId']); ?>";
                lDate.value = modDate;

                var modTime = "<?php queryLessonTime($_SESSION['lessonId']); ?>";
                lTime.value = modTime;

                var modLen = "<?php queryLessonLen($_SESSION['lessonId']); ?>";
                lLen.value = modLen;

                var modLevel = "<?php queryLessonLvl($_SESSION['lessonId']); ?>";
                lLevel.value = modLevel;

                var modInstr = "<?php queryLessonInstr($_SESSION['lessonId']); ?>";
                lInstr.value = modInstr

                var modRequ = "<?php queryLessonRequ($_SESSION['lessonId']); ?>";
                switch (modRequ) {
                    case "0":
                        lRequ.checked = false;
                        break;
                    case "1":
                        lRequ.checked = true;
                        break;
                    default:
                        //do nothing
                }

                var modNotes = "<?php queryLessonNotes($_SESSION['lessonId']); ?>";
                lNotes.value = modNotes;

                var modClerk = "<?php queryLessonClerk($_SESSION['lessonId']); ?>";
                lClerk.value = modClerk;

                var modPaid = "<?php queryLessonPaid($_SESSION['lessonId']); ?>";
                switch (modPaid) {
                    case "0":
                        lPaid.checked = false;
                        break;
                    case "1":
                        lPaid.checked = true;
                        delLessonHide();
                        break;
                    default:
                        //do nothing
                }

                var modChIn = "<?php queryLessonChIn($_SESSION['lessonId']); ?>";
                switch (modChIn) {
                    case "0":
                        lChIn.checked = false;
                        break;
                    case "1":
                        lChIn.checked = true;
                        break;
                    default:
                        //do nothing
                }

                var modFin = "<?php queryLessonFin($_SESSION['lessonId']); ?>";
                switch (modFin) {
                    case "0":
                        lFin.checked = false;
                        break;
                    case "1":
                        lFin.checked = true;
                        break;
                    default:
                        //do nothing
                }

                }

//add client to student view
            function addToStudentView() {
                closeForm();
                var id = "<?php if(isset($addedClientID)) {echo $addedClientID;}?>";
                var ifAdded = (parseInt(<?php getTotNumInLesson(); ?>) + 1).toString();
                if(ifAdded <= 3 && id != ""){
                    showExistingClients(ifAdded);
                    totNumOfClients.value = ifAdded;
                    totNumOfClients2.value - totNumOfClients.value;
                } else {
                    showExistingClients(totNumOfClients.value);
                }
                if (id != ""){
                    <?php resetClientID(); ?>
                }
                (parseInt(totNumOfClients.value) == 0) ? saveLessonBtn.style.display = "none": saveLessonBtn.style.display = "";
            }

            function showExistingClients(numInLesson) {
                if (numInLesson > 0) {
                    switch(numInLesson) {
                        case '1':
                            var id1 = "<?php if(isset($_SESSION['hidClient1'])) {echo $_SESSION['hidClient1'];} else { echo -1;} ?>";
                            var str1 = "<?php if (isset($_SESSION['hidClient1'])) { getClientInfo($_SESSION['hidClient1']); } ?>";
                            addClientToStuView(id1, str1, 1);
                            break;
                        case '2':
                            var id1 = "<?php if(isset($_SESSION['hidClient1'])) {echo $_SESSION['hidClient1'];} else { echo -1;} ?>";
                            var str1 = "<?php if (isset($_SESSION['hidClient1'])) { getClientInfo($_SESSION['hidClient1']); } ?>";
                            addClientToStuView(id1, str1, 1);
                            var id2 = "<?php if(isset($_SESSION['hidClient2'])) {echo $_SESSION['hidClient2'];} else { echo -1;} ?>";
                            var str2 = "<?php if (isset($_SESSION['hidClient2'])) { getClientInfo($_SESSION['hidClient2']);  }?>";
                            addClientToStuView(id2, str2, 2);
                            break;
                        case '3':
                            var id1 = "<?php if(isset($_SESSION['hidClient1'])) {echo $_SESSION['hidClient1'];} else { echo -1;} ?>";
                            var str1 = "<?php if (isset($_SESSION['hidClient1'])) { getClientInfo($_SESSION['hidClient1']); } ?>";
                            addClientToStuView(id1, str1, 1);
                            var id2 = "<?php if(isset($_SESSION['hidClient2'])) {echo $_SESSION['hidClient2'];} else { echo -1;} ?>";
                            var str2 = "<?php if (isset($_SESSION['hidClient2'])) { getClientInfo($_SESSION['hidClient2']);  }?>";
                            addClientToStuView(id2, str2, 2);
                            var id3 = "<?php if(isset($_SESSION['hidClient3'])) {echo $_SESSION['hidClient3'];} else { echo -1;} ?>";
                            var str3 = "<?php if (isset($_SESSION['hidClient3'])) { getClientInfo($_SESSION['hidClient3']);  }?>";
                            addClientToStuView(id3, str3, 3);
                            break;
                        default:
                            //shouldn't go in here
                    }
                }
            }

            function editClientInfo(num) {
                switch(num) {
                    case 1:
                        openForm();
                        fullNameDd.style.display = "none";
                        fullNameLbl.style.display = "none";
                        firstNameLbl.style.display = "block";
                        firstNameBox.style.display = "block";
                        lastNameLbl.style.display = "block";
                        lastNameBox.style.display = "block";
                        currClientEdit.value = "<?php if(isset($_SESSION['hidClient1'])) { echo $_SESSION['hidClient1']; } ?>"
                        addOrSaveBtn.value = "Save"
                        clientFirstName.value = "<?php if(isset($_SESSION['hidClient1'])) { getClientFirstName($_SESSION['hidClient1']); } ?>";
                        clientLastName.value = "<?php if(isset($_SESSION['hidClient1'])) { getClientLastName($_SESSION['hidClient1']); }?>";
                        clientAge.value = "<?php if(isset($_SESSION['hidClient1'])) { getClientAge($_SESSION['hidClient1']); } ?>";
                        clientParent.value = "<?php if(isset($_SESSION['hidClient1'])) { getClientParent($_SESSION['hidClient1']); } ?>";
                        clientPhone.value = "<?php if(isset($_SESSION['hidClient1'])) { getClientPhoneNum($_SESSION['hidClient1']); } ?>";
                        clientNotes.value = "<?php if(isset($_SESSION['hidClient1'])) { getClientNotes($_SESSION['hidClient1']); } ?>";
                        break;
                    case 2:
                        openForm();
                        fullNameDd.style.display = "none";
                        fullNameLbl.style.display = "none";
                        firstNameLbl.style.display = "block";
                        firstNameBox.style.display = "block";
                        lastNameLbl.style.display = "block";
                        lastNameBox.style.display = "block";
                        currClientEdit.value = "<?php if(isset($_SESSION['hidClient2'])) { echo $_SESSION['hidClient2']; } ?>"
                        addOrSaveBtn.value = "Save"
                        clientFirstName.value = "<?php if(isset($_SESSION['hidClient2'])) { getClientFirstName($_SESSION['hidClient2']); } ?>";
                        clientLastName.value = "<?php if(isset($_SESSION['hidClient2'])) { getClientLastName($_SESSION['hidClient2']); }?>";
                        clientAge.value = "<?php if(isset($_SESSION['hidClient2'])) { getClientAge($_SESSION['hidClient2']); } ?>";
                        clientParent.value = "<?php if(isset($_SESSION['hidClient2'])) { getClientParent($_SESSION['hidClient2']); } ?>";
                        clientPhone.value = "<?php if(isset($_SESSION['hidClient2'])) { getClientPhoneNum($_SESSION['hidClient2']); } ?>";
                        clientNotes.value = "<?php if(isset($_SESSION['hidClient2'])) { getClientNotes($_SESSION['hidClient2']); } ?>";
                        break;
                    case 3:
                        openForm();
                        fullNameDd.style.display = "none";
                        fullNameLbl.style.display = "none";
                        firstNameLbl.style.display = "block";
                        firstNameBox.style.display = "block";
                        lastNameLbl.style.display = "block";
                        lastNameBox.style.display = "block";
                        currClientEdit.value = "<?php if(isset($_SESSION['hidClient3'])) { echo $_SESSION['hidClient3']; } ?>"
                        addOrSaveBtn.value = "Save"
                        clientFirstName.value = "<?php if(isset($_SESSION['hidClient3'])) { getClientFirstName($_SESSION['hidClient3']); } ?>";
                        clientLastName.value = "<?php if(isset($_SESSION['hidClient3'])) { getClientLastName($_SESSION['hidClient3']); }?>";
                        clientAge.value = "<?php if(isset($_SESSION['hidClient3'])) { getClientAge($_SESSION['hidClient3']); } ?>";
                        clientParent.value = "<?php if(isset($_SESSION['hidClient3'])) { getClientParent($_SESSION['hidClient3']); } ?>";
                        clientPhone.value = "<?php if(isset($_SESSION['hidClient3'])) { getClientPhoneNum($_SESSION['hidClient3']); } ?>";
                        clientNotes.value = "<?php if(isset($_SESSION['hidClient3'])) { getClientNotes($_SESSION['hidClient3']); } ?>";
                        break;
                    default:
                        //shouldn't go in here
                }
            }

            function movStudentView(id, str, num) {
                addClientToStuView(id, str, num);
                clearClient(num + 1);
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
                                if (totNumOfClients.value < 3) {
                                    totNumOfClients.value = parseInt(totNumOfClients.value) + 1;
                                    totNumOfClients2.value = totNumOfClients.value;
                                    saveLessonBtn.style.display = "";
                                    addClientToStuView(selVal, fullNameDd.options[i].text, totNumOfClients.value);
                                }
                            }
                        }
                    }
                }
            }

//add client to lesson list
            function addClientToStuView(id, str, num) {
                if (parseInt(num) == 1) {
                    client1Lbl.innerHTML = str;
                    client1EditBtn.style.display = "";
                    client1DelBtn.style.display = "";
                    client1HidGenLess.value = id;
                    client1HidClientForm.value = id;
                }
                if (parseInt(num) == 2) {
                    client2Lbl.innerHTML = str;
                    client2EditBtn.style.display = "";
                    client2DelBtn.style.display = "";
                    client2HidGenLess.value = id;
                    client2HidClientForm.value = id;
                }
                if (parseInt(num) == 3) {
                    client3Lbl.innerHTML = str;
                    client3EditBtn.style.display = "";
                    client3DelBtn.style.display = "";
                    client3HidGenLess.value = id;
                    client3HidClientForm.value = id;
                }
                saveLessonBtn.style.display = "";
            }

//clear client
            function clearClient(num) {
                if (parseInt(num) == 1) {
                    client1Lbl.innerHTML = '';
                    client1HidGenLess.value = '';
                    client1HidClientForm.value = ""
                    client1EditBtn.style.display = "none";
                    client1DelBtn.style.display = "none";
                }
                if (parseInt(num) == 2) {
                    client2Lbl.innerHTML = '';
                    client2HidGenLess.value = '';
                    client2HidClientForm.value = '';
                    client2EditBtn.style.display = "none";
                    client2DelBtn.style.display = "none";
                }
                if (parseInt(num) == 3) {
                    client3Lbl.innerHTML = '';
                    client3HidGenLess.value = '';
                    client3HidClientForm.value = '';
                    client3EditBtn.style.display = "none";
                    client3DelBtn.style.display = "none";
                }
            }

//clear all clients
            document.getElementById('cancelAddingLesson').onclick = function clearSession() {
                <?php session_unset();
                 $urlLink = (string) htmlspecialchars($_SERVER["PHP_SELF"]);
                 $urlLink = str_replace("modifyLesson.php", "", $urlLink);
                 $viewLessonURL = $urlLink."viewLesson.php";
                 //cancelAddingLesson
                ?>
                location.href = "<?php echo $viewLessonURL?>"
            }

// delete single client from lesson
            function delClientFromLesson(num) {
                if (parseInt(num) == 1) {
                    var numPeople = totNumOfClients.value;
                    clearClient(1);
                    if (parseInt(numPeople) == 2) {
                        movStudentView(client2HidGenLess.value, client2Lbl.innerHTML, 1);
                    }
                    if (parseInt(numPeople) == 3) {
                        movStudentView(client2HidGenLess.value, client2Lbl.innerHTML, 1);
                        movStudentView(client3HidGenLess.value, client3Lbl.innerHTML, 2);
                    }
                }
                if (parseInt(num) == 2) {
                    var numPeople = totNumOfClients.value;
                    clearClient(2);
                    if (parseInt(numPeople) == 3) {
                        movStudentView(client3HidGenLess.value, client3Lbl.innerHTML, 2);
                    }
                }
                if (parseInt(num) == 3) {
                    clearClient(3);
                }
                totNumOfClients.value = parseInt(totNumOfClients.value) - 1;
                totNumOfClients2.value = totNumOfClients.value;
                if (totNumOfClients.value == 0) {
                    saveLessonBtn.style.display = "none";
                }
            }
        </script>
    </body>
</html>

<?php

session_start();
include_once '../includes/connection.php';
if (isset($_GET['SID'])) {
    $surveyID = $_GET['SID'];
}

if (isset($_SESSION["email"])) {
    $email = $_SESSION["email"];
}else{
    echo "<script>window.location.href='../Login';</script>";
    
}


$sql_query = mysqli_query($conn, "SELECT Name, account_type from userstb WHERE Email='$email'");
$fetch = mysqli_fetch_assoc($sql_query);
$db_name = ucfirst($fetch['Name']);
$db_account_type = $fetch['account_type'];
$db_email = $email;

if ($db_account_type == 2) {
    $account_type = "Data Processor/Encoder";
    
}else{
    echo "<script>window.location.href='../Login';</script>";
    
}

$currentpwerr = $newpwerr = $confirmpwerr = "";
$currentpw = $newpw = $confirmpw = "";

if (isset($_POST['cancel_btn'])) {
    $encrypted = md5(rand(1,9));
    if ($db_account_type != 1) {
        echo "<script>window.location.href='Questionnaire?$encrypted&&SID=$surveyID';</script>";
    }else{
        echo "<script>window.location.href='./Login?$encrypted';</script>";
    }
}


?>



<script>

//**************************Add Checkbox Function */
                var checkcounter=0;
                function addCheckboxes(){
                    var mainContCheckbox = document.getElementById('checkbox-containers');
                    const inputValueCheckbox = document.getElementById('inputCheckbox');
                    let myNewValueCheckbox = inputValueCheckbox.value;
                    inputValueCheckbox.focus();
                    if (myNewValueCheckbox == "") {
                        alert("Empty Input");
                    }else{
                        if (checkcounter > 10) {
                            alert("too many choices");
                        }else{
                    
                    var newDivCheckbox = document.createElement('div');

                //Create dynamic checkbox button
                    var newCheckbox = document.createElement('input');
                    newCheckbox.setAttribute("type","Checkbox");
                    newCheckbox.setAttribute("class","radiobtn");
                    
                //Create dynamic text field
                    var newTextCheckbox = document.createElement('input');
                    newTextCheckbox.setAttribute("type","text");
                    newTextCheckbox.setAttribute("class","addedtext");
                    newTextCheckbox.setAttribute("name","CheckOpt[]");
                    newTextCheckbox.setAttribute("value", myNewValueCheckbox);
                    

                //Create dynamic Delete button
                    var newDelButtonCheckbox = document.createElement('input');
                    newDelButtonCheckbox.setAttribute("type","button");
                    newDelButtonCheckbox.setAttribute("class","delete");
                    newDelButtonCheckbox.setAttribute("value","-");
                   
                //append all created elements 
                    newDivCheckbox.appendChild(newCheckbox);
                    newDivCheckbox.appendChild(newTextCheckbox);
                    newDivCheckbox.appendChild(newDelButtonCheckbox);
                    mainContCheckbox.appendChild(newDivCheckbox);
                    checkcounter++;
                    inputValueCheckbox.value = "";
                    
                    newDelButtonCheckbox.onclick = function() {
                        mainContCheckbox.removeChild(newDivCheckbox);
                        checkcounter--;
                    }
                        }
                    }
                }

 //**************************Add Radio Function */
        var counter=0;
                function addRadio(){
                    var mainCont = document.getElementById('choices-containers');
                    const inputValue = document.getElementById('inputAdds');
                    let myNewValue = inputValue.value;
                    inputValue.focus();
                    if (myNewValue == "") {
                        alert("Empty Input");
                    }else{
                        if (counter > 10) {
                            alert("too many choices");
                        }else{
                    
                    var newDiv = document.createElement('div');

                //Create dynamic radio button
                    var newRadio = document.createElement('input');
                    newRadio.setAttribute("type","radio");
                    newRadio.setAttribute("class","radiobtn");
                    
                //Create dynamic text field
                    var newText = document.createElement('input');
                    newText.setAttribute("type","text");
                    newText.setAttribute("class","addedtext");
                    newText.setAttribute("name","options[]");
                    newText.setAttribute("value", myNewValue);
                    

                //Create dynamic Delete button
                    var newDelButton = document.createElement('input');
                    newDelButton.setAttribute("type","button");
                    newDelButton.setAttribute("class","delete");
                    newDelButton.setAttribute("value","-");
                   
                //append all the elements 
                    newDiv.appendChild(newRadio);
                    newDiv.appendChild(newText);
                    newDiv.appendChild(newDelButton);
                    mainCont.appendChild(newDiv);
                    counter++;
                    inputValue.value = "";

                    newDelButton.onclick = function() {
                        mainCont.removeChild(newDiv);
                        counter--;
                    }
                        }
                    }
                }


/********************Show Questions Function */
 function ShowQuestion() {
    var selectbox = document.getElementById('question-type');
    var userInput = selectbox.options[selectbox.selectedIndex].value;
    if (userInput == "Select Question Type") {
        document.getElementById('Select Question Type').style.display = 'block';
    }else{
        document.getElementById('Select Question Type').style.display = 'none';
    }
    if (userInput == "ShortAnswer") {
        document.getElementById('ShortAnswer').style.display = 'block';AddLongbtn
        document.getElementById('AddShortbtn').style.display = 'inline';
    }else{
        document.getElementById('ShortAnswer').style.display = 'none';
        document.getElementById('AddShortbtn').style.display = 'none';
    }
    if (userInput == "LongAnswer") {
        document.getElementById('AddLongbtn').style.display = 'inline';
        document.getElementById('LongAnswer').style.display = 'block';
    }else{
        document.getElementById('AddLongbtn').style.display = 'none';
        document.getElementById('LongAnswer').style.display = 'none';
    }
    if (userInput == "MultipleChoice") {
        document.getElementById('AddRadiobtn').style.display = 'inline';
        document.getElementById('MultipleChoice').style.display = 'block';
    }else{
        document.getElementById('AddRadiobtn').style.display = 'none';
        document.getElementById('MultipleChoice').style.display = 'none';
    }
    if (userInput == "Checkboxes") {
        document.getElementById('AddCheckboxbtn').style.display = 'inline';
        document.getElementById('Checkboxes').style.display = 'block';
    }else{
        document.getElementById('AddCheckboxbtn').style.display = 'none';
        document.getElementById('Checkboxes').style.display = 'none';
    }
    if (userInput == "Date") {
        document.getElementById('AddDatebtn').style.display = 'inline';
        document.getElementById('DateAnswer').style.display = 'block';
    }else{
        document.getElementById('AddDatebtn').style.display = 'none';
        document.getElementById('DateAnswer').style.display = 'none';
    }
    return true;
    }

</script>

<?php 

include '../includes/connection.php';

// Add Multiplechoice question button
if (isset($_POST['AddRadiobtn'])) {
    $currentpwerr = "";
    $newpwerr = "";
        if (empty($_POST['questionn'])) {
        
            $currentpwerr = "Field Required!";

        }else{

            if (empty($_POST['options'])) {
             
                $newpwerr = "Please Enter Choices!";
            
                    }else{

                        if (!empty($_POST['req_switch'])) {
                           $required = "yes";
                        }else{
                            $required = "no";
                        }
                        if (!empty($_POST['other_switch'])) {
                            $other = "yes";
                         }else{
                             $other = "no";
                         }

                        $question = $_POST['questionn'];
                        $choices = $_POST['options'];
                            mysqli_query($conn, "INSERT INTO questiontbl(Survey_ID,QuestionType,Question,Required,Others) VALUES('$surveyID','Multiplechoice','$question','$required','$other')");
                            $insertedID = $conn-> insert_id;

                        foreach ($choices as $choice) {

                            $conns = mysqli_connect($host, $username, $pword, $db);
                                if ($conns-> connect_error) {
                                        die("connection failed:". $conns-> connect_error);
                                }

                            mysqli_query($conns, "INSERT INTO answertbl(Question_ID,Answer) VALUES('$insertedID','$choice')");
                        
                        }
                        
                        echo "<script>window.location.href='Add_Questionnaire?SID=$surveyID&&notify=Question($question) Added Successfully!';</script>";
                        }
            }
    
    }

// Add Checkbox question button
if (isset($_POST['AddCheckboxbtn'])) {
    $currentpwerr = "";
    $newpwerr = "";
        if (empty($_POST['inputchecktext']) && empty($_POST['CheckOpt'])) {
            $currentpwerr = "Field Required!";
            $newpwerr = "Field Required!";
            
        }else{
            if (!empty($_POST['req_switch'])) {
                $required = "yes";
             }else{
                 $required = "no";
             }
             if (!empty($_POST['other_switch'])) {
                 $other = "yes";
              }else{
                  $other = "no";
              }
            $question = $_POST['inputchecktext'];
            $checkopts = $_POST['CheckOpt'];
                mysqli_query($conn, "INSERT INTO questiontbl(Survey_ID,QuestionType,Question,Required,Others) VALUES('$surveyID','Checkbox','$question','$required','$other')");
                $insertedID = $conn-> insert_id;

            foreach ($checkopts as $checkopt) {

                $conns = mysqli_connect($host, $username, $pword, $db);
                    if ($conns-> connect_error) {
                            die("connection failed:". $conns-> connect_error);
                    }

                mysqli_query($conns, "INSERT INTO answertbl(Question_ID,Answer) VALUES('$insertedID','$checkopt')");
            
            }
           
            echo "<script>window.location.href='Add_Questionnaire?SID=$surveyID&&notify=Question[$question] Added Successfully!';</script>";
        }
        
    }


    
// Add Short Answer question button
    if (isset($_POST['AddShortbtn'])) {
        if (empty($_POST['ShortTextQuestion'])) {
            echo "<script>alert('Empty Input');</script>";
        }else{
            if (!empty($_POST['req_switch'])) {
                $required = "yes";
             }else{
                 $required = "no";
             }
             if (!empty($_POST['other_switch'])) {
                 $other = "yes";
              }else{
                  $other = "no";
              }
        $inputShortText = $_POST['ShortTextQuestion'];
        mysqli_query($conn, "INSERT INTO questiontbl(Survey_ID,QuestionType,Question,Required,Others) VALUES('$surveyID','ShortAnswer','$inputShortText','$required','$other')");
        echo "<script>window.location.href='Add_Questionnaire?SID=$surveyID&&notify=Question[$inputShortText] Added Successfully!';</script>";
        }

    }
// Add Long Answer question button
    if (isset($_POST['AddLongbtn'])) {
        if (empty($_POST['LongTextQuestion'])) {
            echo "<script>alert('Empty Input');</script>";
        }else{
            if (!empty($_POST['req_switch'])) {
                $required = "yes";
             }else{
                 $required = "no";
             }
             if (!empty($_POST['other_switch'])) {
                 $other = "yes";
              }else{
                  $other = "no";
              }
        $inputLongText = $_POST['LongTextQuestion'];
        mysqli_query($conn, "INSERT INTO questiontbl(Survey_ID,QuestionType,Question,Required,Others) VALUES('$surveyID','LongAnswer','$inputLongText','$required','$other')");
        echo "<script>window.location.href='Add_Questionnaire?SID=$surveyID&&notify=Question[$inputLongText] Added Successfully!';</script>";
        }

    }

 
// Add Date button
    if (isset($_POST['AddDatebtn'])) {
        if (empty($_POST['questionforDate'])) {
            echo "<script>alert('Empty Input');</script>";
        }else{
            if (!empty($_POST['req_switch'])) {
                $required = "yes";
             }else{
                 $required = "no";
             }
             if (!empty($_POST['other_switch'])) {
                 $other = "yes";
              }else{
                  $other = "no";
              }
        $inputDateText = $_POST['questionforDate'];
        mysqli_query($conn, "INSERT INTO questiontbl(Survey_ID,QuestionType,Question,Required,Others) VALUES('$surveyID','Date','$inputDateText','$required','$other')");
        echo "<script>window.location.href='Add_Questionnaire?SID=$surveyID&&notify=Question[$inputDateText] Added Successfully!';</script>";
        }

    }

?>

<style>
.emailphoto{
    width: 298px;
    height: 159px;
    position:absolute;
    box-shadow: 0 5px 15px #5a5c5f;
    
}
.accphoto{
    position:relative;
}
.emailacc{
    position:relative;
}
.cpasspanel{
    width: 90%;
    height: 311px;
    overflow-y:scroll;
    margin-left:60px;
}
.questions{
    font-family: "roboto", sans-serif;
    outline: 1;
    background: aliceblue; 
    border:1px solid rgba(0,0,0,0.250);
    width: 500px;
    border-radius: 5px 5px 5px 5px;
    margin: 0 0 15px;
    padding: 15px;
    box-sizing: border-box;
    font-size: 16px;
    font-weight: 500;
}
.ShortAnswer{
    color:rgba(0,0,0,0.705);
    background:transparent;
    border: 0;
    border-bottom: 2px solid lightblue;
    outline:none;
    font-size: 1em;
    font-weight: 500;
    width:250;
}
.ShortAnswer:focus{
    border-bottom: 2px solid blue;
   
}
.LongAnswer{
    color:rgba(0,0,0,0.705);
    background:transparent;
    border: 0;
    border-bottom: 2px solid lightblue;
    outline:none;
    font-size: 1.2em;
    font-weight: 500;
    width:400;
}
.cinput, .ninput, .rinput{
    font-family: "roboto", sans-serif;
    outline: 1;
    background: aliceblue; 
    border:1px solid rgba(0,0,0,0.250);
    width: 500px;
    border-radius: 5px 5px 5px 5px;
    margin: 0 0 15px;
    padding: 15px;
    box-sizing: border-box;
    font-size: 15px;
    
    
}
.submit-btn{
    border-radius:3px;
    font-family: "roboto", sans-serif;
    outline: 0;
    height: 25px;
    width: 80px;
    background: #2e68aa;
    color: #fff;
    font-size: 14px;
    cursor: pointer;
    border: none;
    margin-top: 3.1px;
}
.navpanel {
    overflow-y:hidden;
}
.cancel-btn{
    border-radius:3px;
    font-family: "roboto", sans-serif;
    outline: 0;
    width: 70px;
    background: aliceblue;
    color: #2e68aa;
    font-size: 14px;
    cursor: pointer;
    border: 1px solid #2e68aa;
    font-weight:600;
}

.submit-btn:hover{
    opacity:0.7;
}
.cancel-btn:hover{
    opacity:0.7;
}

.error{
    color:red;
}
.tag{
   color: #6f797e;

}
.datapanel{
    border-radius: 5px 5px 5px 5px;
}
.choices{
    border-radius: 5px 5px 5px 5px;
    background: #fff;
    color: #0c1c22 ;
    font-weight: bold;
    width:250px;
    height:40;
    padding:0;
    margin:0;
}
.choice{
    margin-left: 4;
    margin-top: 15px;
}

.addedtext{
    margin-top: 5px;
    border-radius: 5px 5px 5px 5px;
    background: lightgrey;
    border:none;
    padding: 0;
    list-style: none;
    text-decoration: none;
    color: #0c1c22 ;
    font-weight: 400;
    width:250px;
    height:40;
    padding-left: 3;
    line-height: 2;
    
}
div .delete{
    color:#fff;
    border-radius:0px 5px 5px 0;
    border:none;

    margin-right:0px;
    background:red;
    padding: 12 10 12 10;
    cursor:pointer;
}
.addbtn{
    color:#fff;
    border-radius:0px 5px 5px 0;
    border:none;
    background:#1166b1;
    padding: 12 12 12 12;
}
.addbtn:hover{
    opacity: 0.7;
}
.delete:hover{
    background:red;
    opacity: 0.7
}
.question-type{
    width:250px;
    padding:5px;
    background: aliceblue;
    border-radius: 3px 3px 3px 3px;
    border-bottom: 1px solid #CFD8DC;
    margin-left:20px;
    font-size: 16px;
    font-weight: 500;
    font-family: sans-serif;
}
.question-type:hover{
    cursor:pointer;
    box-shadow: 0 2px 5px #86878a;
}
.question-type option{
    
    background: aliceblue;
    font-size: 16px;
    font-weight: 500;
    font-family: sans-serif;
}
.hnoti{
    margin:0;
    padding:0;
}
.switch{
    position:relative;
    display:inline-block;
    padding:0;
    width: 30px;
    height: 19px;
    
}
.slider{
    position:absolute;
    cursor:pointer;
    top: 0;
    right: 0;
    left: 0;
    bottom: 0;
    background-color: #ccc;
    transition: .4s;
    border-radius: 14px;
}
.switch input{display:none}
.slider:before {
    position:absolute;
    content: "";
    height: 17px;
    width: 17px;
    left:2px;
    bottom: 1px;
    background-color: white;
    transition: 0.4s;
    border-radius: 14px;
}
input:checked + .slider{
    background-color: #ff278c;
}
input:checked + .slider:before{
    transform: translateX(10px);
}
.btn-container{
    background:lightgrey;
    
    margin-top:40px;
    height:30px;
    width:100%;
    justify:bottom;
}
.div-tab{
    height:430px;
    margin-top:8px;
    border-radius:0 0  5px 5px;
    background:rgba(0,0,0,0.03);
    width:775px;
    border:1px solid rgba(0,0,0,0.120);
}
.title-tab{
    border-radius:5px 5px 0 0;
    color:rgba(16, 94, 238, 0.500);
    border:1px solid rgba(0,0,0,0.120);
    background:#e0edf5ea;
    padding:10px;
    margin:none;
    font-weight: 400;
    border-bottom:1px solid #e0edf5ea;
}
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/main.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GETSysytem | Welcome</title>
</head>
<body>
    <header>
        <div class="container">
            <div id="title">
                <h2><span class="highlights">G</span>raduates <span class="highlights">E</span>mployability <span class="highlights">T</span>racer <span class="highlights">S</span>ystem</h2>
            </div>
            <nav>
                <ul>
                   <li class="current"><a href="../logout">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    
        <div class="navbox">

                <div class="sidepanel">
                    <img src="../img/images 7.jpeg" class="emailphoto">
                        <div class="photo">
                            <img src="../img/photo10.png" class="accphoto">
                            <label for="" class="fullname"><?php echo $db_name; ?></label>

                        </div>

                        <div class="emailacc">
                        
                            <p class="email-user"><b><?php echo $email; ?></b><br>
                            <i><font color="#ffffff"><?php echo $account_type; ?></font></i>
                            
                            
                           
                            </p>
                            
                          
                        </div>
                            
                    </div>
            
                    
                          
            <div class="navpanel">

                <div class="multi-level">
                    
                </div>

                <div class="item">
                    <input type="checkbox" id="B">
                    <img src="../img/emaildropdown5.png" class="arrow"><label for="B">SURVEYS</label>
                    <ul>
                        <li><a href="add_usersurvey">Add Survey</a></li>
                        <li><a href="user_survey">My Surveys</a></li>
                    </ul>
                </div>

                
                
            </div>
         </div>
         <div class="dropdownnav">
         <input type="checkbox" id="D">
         <label for="D"><img class="emaildropdown" src="../img/emaildropdown5.png"></label>
                            <ul>
                                <li><a href="change_userpass">Change password</a></li>
                                <li><a href="change_useremail">Update Email</a></li>
                                <li><a href="change_usercontact">Update Contact</a></li>
                            </ul>

                            </ul>
        </div>

         <div class="mainpanel">
         <div class="statuspanel">
         <?php
         

         
                    
                        if (empty($_GET['notify'])) {
                        
                            echo "";
                        } else {
                            echo "<br><h5 class='hnoti'><font color='green'>". $_GET['notify'] ."</font></h5>";
                           unset($_GET['notify']);
                        }
                        ?>
            </div>
           <div class="datapanel">
           <form action="" method="POST" autocomplete="off">
           <span class="title-tab">Add Question</span>
           <span style="margin-left:580px;"><input type="submit" name="cancel_btn" class="cancel-btn" Value="Back"></span><br>
           <div class="div-tab">
           
            
            <br>

           
                    <select name="question-type" id="question-type" onLoad="onL()" class="question-type" onClick ="ShowQuestion()">
                    <option value="Select Question Type">Select Question Type</option>
                    <option value="ShortAnswer">Short Answer Text</option>
                    <option value="LongAnswer">Long Answer Text</option>
                    <option value="MultipleChoice">Multiple Choice</option>
                    <option value="Checkboxes">Checkboxes</option>
                    <option value="Date">Date</option>
                
                </select>
                <div class="cpasspanel"  id="Select Question Type">
                </div>

        <!--======------------------------------- Showing Short Answer Text-->


                <div class="cpasspanel" style="display: none;"  id="ShortAnswer">
                    
                    <br>
                    <span class="tag">Question*</span><br>
                    <input type="Text" name="ShortTextQuestion" class="questions" placeholder="Enter Question here.." >
                    <span class="error"><?php echo $currentpwerr; ?></span>
                    <br>
                    
                    <label class="switch"><input type="checkbox" name="req_switch" value="required"><span class="slider"></span>
                    <span style="position:absolute; left:35px; bottom:0; top:-15px; right:0; color:rgba(0,0,0,0.750);" >Required</span></label>
                    
                    
                    <br><br>
                    <span class="tag">Answer</span><br>
                    <input type="text" name="new" class="ShortAnswer" placeholder="Short Answer Text" >
                    <span class="error"><?php echo $newpwerr; ?></span>
                    
                    <br><br>
                    
                    

                    
                </div>

        <!--======------------------------------- Showing Long Answer Text-->

                <div class="cpasspanel" style="display: none;" id="LongAnswer">
                
                    <br>
                    <span class="tag">Question*</span><br>
                    <input type="Text" name="LongTextQuestion" class="questions" placeholder="Enter Question here.." value="<?php echo $currentpw; ?>">
                    <span class="error"><?php echo $currentpwerr; ?></span>
                    <br>
                    <label class="switch"><input type="checkbox" name="req_switch" value="required"><span class="slider"></span>
                    <span style="position:absolute; left:35px; bottom:0; top:-15px; right:0; color:rgba(0,0,0,0.750);" >Required</span></label>
                    
                    
                    <br><br>
                    <span class="tag">Answer</span><br>
                    <Textarea type="password" name="new" class="LongAnswer" placeholder="Long Answer Text" value="<?php echo $newpw; ?>"></textarea>
                    <span class="error"><?php echo $newpwerr; ?></span>
                    <br><br>
                    
                    
                    

                
                </div>

        <!--======------------------------------- Showing Multiple Choice-->

                <div class="cpasspanel" style="display: none;"   id="MultipleChoice">
                
                    <br>
                    <span class="tag">Question*</span><br>
                    <input type="Text" name="questionn" class="questions" placeholder="Enter Question here.." value="<?php echo $currentpw; ?>">
                    <span class="error"><?php echo $currentpwerr; ?></span>
                    <br>
                    <label class="switch"><input type="checkbox" name="req_switch" value="required"><span class="slider"></span>
                    <span style="position:absolute; left:35px; bottom:0; top:-15px; right:0; color:rgba(0,0,0,0.750);" >Required</span></label>
                    <br>
                    <label class="switch"><input type="checkbox" name="other_switch" value="other"><span class="slider"></span>
                    <span style="position:absolute; left:35px; bottom:0; top:-15px; right:0; color:rgba(0,0,0,0.750);" >Add'Other'option</span></label>
                    
                    <br><br>

                    <span class="tag">Choices</span>
                    <br>

                    <div id="choices-containers" class="ccontainer">

                        <input type="text" class="choices" id="inputAdds" placeholder="Enter Choices here..">
                        <input type="button" class="addbtn" id="addbtn" value="+" onClick="addRadio()">
                        <span class="error"><?php echo $newpwerr; ?></span>
                    </div>
                    <br><br>
                    
                  
                   

                
                </div>

        <!--======------------------------------- Showing Checkboxes Choice-->

                <div class="cpasspanel" style="display: none;"  id="Checkboxes">
                
                    <br>
                    <span class="tag">Question*</span><br>
                    <input type="Text" name="inputchecktext" class="questions" placeholder="Enter Question here.." >
                    <span class="error"><?php echo $currentpwerr; ?></span>
                    <br>
                    <label class="switch"><input type="checkbox" name="req_switch" value="required"><span class="slider"></span>
                    <span style="position:absolute; left:35px; bottom:0; top:-15px; right:0; color:rgba(0,0,0,0.750);" >Required</span></label>
                    <br>
                    <label class="switch"><input type="checkbox" name="other_switch" value="other"><span class="slider"></span>
                    <span style="position:absolute; left:35px; bottom:0; top:-15px; right:0; color:rgba(0,0,0,0.750);" >Add'Other'option</span></label>
                    <br><br>
                    <span class="tag">Choices</span>
                    <br>

                    <div id="checkbox-containers" class="ccontainer">

                        <input type="text" class="choices" id="inputCheckbox" placeholder="Enter Choices here..">
                        <input type="button" class="addbtn" id="addCheckbox" value="+" onClick="addCheckboxes()">
                        <span class="error"><?php echo $newpwerr; ?></span>
                    </div>
                    <br><br>
                    
                    
                    

                
                </div>


    <!--======------------------------------- Showing Date Answer-->

                <div class="cpasspanel" style="display: none;"  id="DateAnswer">
                        
                        <br>
                        <span class="tag">Question*</span><br>
                        <input type="Text" name="questionforDate" class="questions" placeholder="Enter Question here.." >
                        <span class="error"><?php echo $currentpwerr; ?></span>
                        <br>
                        <label class="switch"><input type="checkbox" name="req_switch" value="required"><span class="slider"></span>
                        <span style="position:absolute; left:35px; bottom:0; top:-15px; right:0; color:rgba(0,0,0,0.750);" >Required</span></label>
                        <br><br>
                        <span class="tag">Answer</span><br>
                        <input type="date" name="new" class="ShortAnswer">
                        <span class="error"><?php echo $newpwerr; ?></span>
                        <br>
                        
                </div>
                <div class="btn-container">
                    <span style="margin-left:670px;">
                    <input style="display: none;" type="submit" name="AddShortbtn" class="submit-btn" value="Add" id="AddShortbtn">
                    <input style="display: none;" type="submit" name="AddLongbtn" class="submit-btn" value="ADD" id="AddLongbtn">
                    <input style="display: none;" type="submit" name="AddRadiobtn" class="submit-btn" value="ADD" id="AddRadiobtn">
                    <input style="display: none;" type="submit" name="AddCheckboxbtn" class="submit-btn" value="ADD" id="AddCheckboxbtn">
                    <input style="display: none;" type="submit" name="AddDatebtn" class="submit-btn" value="Add" id="AddDatebtn">
                    
                    </form>
                </div>
                
            </div>
            
           </div>
         </div>

</body>
</html>
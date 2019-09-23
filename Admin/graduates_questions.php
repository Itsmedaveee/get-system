<?php
$encrypted = md5(rand(1,9));
session_start();


if (isset($_SESSION["email"])) {
    $email = $_SESSION["email"];
}else{
    echo "<script>window.location.href='../Login';</script>";
}
include_once '../includes/connection.php';

   

$sql_query = mysqli_query($conn, "SELECT Name, account_type from userstb WHERE Email='$email'");
$fetch = mysqli_fetch_assoc($sql_query);
$db_name = ucfirst($fetch['Name']);
$db_account_type = $fetch['account_type'];
$db_email = $email;
if ($db_account_type == 1) {
    $account_type = "Administrator";
}else{
    echo "<script>window.location.href='../Login';</script>";
}  



if(!empty($_GET['SID']))
            {
            $surveyID = $_GET['SID'];
            
            
            $sql_query = mysqli_query($conn, "SELECT Title, Description from mysurveytbl WHERE Survey_ID='$surveyID'");
            $fetch = mysqli_fetch_assoc($sql_query);
            $SurveyTitle = $fetch['Title'];
            $Description = $fetch['Description'];
            }

             if (isset($_POST['Submit_btn'])) {
            
                echo "<script>window.location.href='Questionnaire?notify=Saved Successfully && SID=$surveyID && ID=$userID';</script>";
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
.hnoti{
    margin:0;
    padding:0;
}
.datapanel{
   
   min-width: 850px;
   max-width: 850px;
   
}
.headcontainer{
    border-radius: 5px 5px 0px 0;
    min-width:800px;
    max-width:800px;
    background: #1166b1c2;
    padding: 14 2 14 0;
    
}
.headcontainer span{
    letter-spacing: 1px;
    font-size: 1em;
    color:rgba(0,0,0,0.705);
    padding-left: 7px;
    font-weight: 800;
}
.bodycontainer{
    padding-bottom: 9px;
    padding-top: 9px;
    padding-left: 2px;
    min-width:800px;
    max-width:800px;
   
    
    border-bottom:2px solid #1167b1;
}
.bodycontainer span{
    font-size: 0.8em;
    letter-spacing: 1px;
    padding-left: 5px;
    color:rgba(0,0,0,0.705);
    
}
.labelhead {
    text-align:center;
    color: grey;  
}

.question-row{
    padding: 10 10 10 10;
    background: #1166b1a2;
    max-width: 782px;
    margin-top: 10px;
    color:rgba(0,0,0,0.705);
    border-radius: 5px 5px 0 0;
    
    
}
.question-row .MainQuestion{
    outline:none;
    background:transparent;
    border:0;
    color:rgba(0,0,0,0.705);
    font-size:1em;
    font-weight:600;
    width:790;
    text-overflow:ellipsis;
    overflow:hidden;
}
.question-row label{
    padding:0;
    margin:0;
    line-height:0;
    text-overflow: ellipsis;
   
}
.input-type{
    padding-top:20px;
}
#SubQs .SubQuestion-text{
    
    margin-top: 15px;
    color:rgba(0,0,0,0.705);
    background:transparent;
    border: 0;
    border-bottom: 1px solid grey;
    outline:none;
    font-size: 1em;
    font-weight: bold;
    width:350;
    
}

.question-text:focus {
    border-bottom: 2px solid grey;
    
}

.questionnaires input{
    margin-left:10;
    font-size: 0.96em;
    letter-spacing: 1px;
    padding-left: 5px;
    color:rgba(0,0,0,0.705);
    font-weight:500;
   
    
}
.questionnaires{
    border-bottom:2px solid #1166b1a2;
    max-width: 782px;
    padding: 20 10 20 10;
    
}
.questionnaires .optionlbl{
    color:rgba(0,0,0,0.705);

}
.questionnaires .Answer-text{
    margin-left:30px;
    color:rgba(0,0,0,0.705);
    background:transparent;
    border: 0;
    border-bottom: 2px solid lightblue;
    outline:none;
    font-size: 1.1em;
    font-weight: 500;
    width:250;   
}
.questionnaires .Answer-text:focus{
    border-bottom:2px solid #562af4de;
}
.questionnaires .LongAnswer-text{
    margin-left:5px;
    color:rgba(0,0,0,0.705);
    background:transparent;
    border: 0;
    border-bottom: 2px solid lightblue;
    outline:none;
    font-size: 1.3em;
    font-weight: 500;
    min-width:400;
    max-width:400;
    min-height:80;
    max-height:80;  

}
.questionnaires .LongAnswer-text:focus{
    border-bottom:2px solid #562af4de;
}
#SubQs .subanswer-text{
    color:rgba(0,0,0,0.705);
    background:transparent;
    border: 0;
    border-bottom: 2px solid lightblue;
    outline:none;
    font-size: 1.1em;
    font-weight: 500;
    width:250;
   
    margin-left: 15px;
}
#SubQs .subanswer-text:focus {
    border-bottom: 2px solid #562af4de;
    
}

.divNote{
    text-align:center;
    min-width:802px;
    max-width:802px;
    background:#ffb649;
    border-radius: 0px 0px 5px 5px;
}
.NoteText{
    margin:0;
    padding:0;
    color:rgba(0,0,0,0.705); 
    font-size: .9em;
    font-weight: 800; 
    font-style:italic;
    margin-left:40px;
}
.addbtn{
    border-radius: 5px 5px 5px 5px;
    border:solid aliceblue;
    background: orange;
    cursor:pointer;
}
.shadowbox{
    max-width:802px;
    border-radius: 5px 5px 0 0;
}
.shadowbox:hover{
    box-shadow: 0 0 3px rgba(0,0,0,0.705);
}
.actionbtn{
    float:right; 
    
}
.actionbtn .btnedit:hover{
    opacity:0.7;
    cursor:pointer;
}
.actionbtn .btndelete:hover{
    opacity:0.7;
    cursor:pointer;
}
.btnedit{
 
    margin-right:5;
    padding-right:3;
}
.divider{
    color:#1166b1a2;
    font-size:35px;
    font-weight:300;
}
.NoteText img{
    transform: rotateY(-180deg);
}
.divFooter{
    align:center;
    margin-top:10;
    Height:45px;
    text-align:center;
    min-width:802px;
    max-width:802px;
    background:#ffb649;
    border-radius: 0px 0px 5px 5px;
}
.addbtn a{
    line-height:1.5; 
    color:aliceblue;
    text-decoration:none;
    padding: 10;
}
.addbtn a img{
    padding-top:4;
}
.addbtn:hover{
    opacity:0.5;
}
label{
    max-width:700px;
}
.scroller{
    overflow-y:scroll;
    height:295px;
}
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../fonts/fontawesome/css/all.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>GETSysytem | Welcome</title>
 <style>
 
 
 </style>

</head>
<body>
    <header>
        <div class="container">
            <div id="title">
                <h2><span class="highlights">G</span>raduates <span class="highlights">E</span>mployability <span class="highlights">T</span>racer <span class="highlights">S</span>ystem</h2>
            </div>
            <nav>
                <ul>
                   <li class="current"><a href="../logout"><i class="fa fa-sign-out-alt"></i> Logout</a></li>
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
                    
                    <div class="item">
                        <input type="checkbox"  id="A">
                        <img src="../img/emaildropdown5.png" class="arrow"><label for="A">Users</label>
                        <ul>
                            <li><a style="padding-top:20px; padding-bottom:20px;" href="account_request"><i class="fa fa-user-plus"></i> Account Request</a></li>
                            <li><a style="padding-top:20px; padding-bottom:20px;" href="manageusers"><i class="fa fa-users-cog"></i> Manage Users</a></li>
                            <li><a style="padding-top:20px; padding-bottom:20px;" href="Manage_enumerator"><i class="fa fa-users"></i> Enumerators</a></li>
                        </ul>
                    </div>
                </div>

                <div class="item">
                    <input type="checkbox" id="B">
                    <img src="../img/emaildropdown5.png" class="arrow"><label for="B">Data Encoders</label>
                    <ul>
                    <li><a style="padding-top:20px; padding-bottom:20px;" href="Allsurveys"><i class="fa fa-pen"></i> Surveys</a></li>
                    <li><a style="padding-top:20px; padding-bottom:20px;" href="Logs"><i class="fa fa-history"></i> Logs</a></li>
                    </ul>
                </div>

                <div class="item">
                    <input type="checkbox" id="c">
                    <img src="../img/emaildropdown5.png" class="arrow"><label for="c">Graduates</label>
                    <ul>
                    <li><a style="padding-top:20px; padding-bottom:20px;" href="graduates_survey"><i class="fa fa-pen"></i> Surveys</a></li>
                    <li><a style="padding-top:20px; padding-bottom:20px;" href="List_graduates"><i class="fa fa-user-graduate"></i> List of Graduates</a></li>
                    <li><a style="padding-top:20px; padding-bottom:20px;" href="admin_reports"><i class="fa fa-chart-bar"></i> Reports</a></li>
                    </ul>
                </div>

                <div class="item">
                    <input type="checkbox" id="f">
                    <img src="../img/emaildropdown5.png" class="arrow"><label for="f">Employers</label>
                    <ul>
                    <li><a style="padding-top:20px; padding-bottom:20px;" href="Allsurveys"><i class="fa fa-pen"></i> Surveys</a></li>
                    <li><a style="padding-top:20px; padding-bottom:20px;" href="Logs"><i class="fa fa-comment"></i> Feedback</a></li>
                    </ul>
                </div>
                <div class="item">
                    <input type="checkbox" id="j">
                    <img src="../img/emaildropdown5.png" class="arrow"><label for="j">Job Offerings</label>
                    <ul>
                    <li><a style="padding-top:20px; padding-bottom:20px;" href="add_jobs"><i class="fa fa-briefcase-medical"></i> Post Jobs</a></li>
                    <li><a style="padding-top:20px; padding-bottom:20px;" href="job_offerings"><i class="fa fa-briefcase"></i> Job Offerings</a></li>
                    </ul>
                </div>
            </div>
         </div>
         <div class="dropdownnav">
         <input type="checkbox" id="E">
         <label for="E"><img class="emaildropdown" src="../img/emaildropdown5.png"></label>
                            <ul>
                                <li><a href="change_adminpass"><i class="fa fa-lock"></i> Change password</a></li>
                                <li><a href="change_adminemail"><i class="fa fa-at"></i> Update Email</a></li>
                                <li><a href="change_admincontact"><i class="fa fa-phone"></i> Update Contact</a></li>
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
           <div class="headcontainer">
                    <CAPTION><span><?php if(!empty($surveyID)){ echo ucfirst($SurveyTitle);}?></span></CAPTION>
                </div>

                <div class="bodycontainer">
                    <CAPTION><span><?php if(!empty($surveyID)){ echo ucfirst($Description);}?></span></CAPTION>
                </div>
               
                    <?php 

                            $sql1 = "SELECT * FROM questiontbl WHERE Survey_ID='$surveyID'";
                            $result1 = $conn-> query($sql1);
                            $count = $result1-> num_rows;
                            $r1 = $result1-> fetch_assoc();
                            $QueID = $r1['QuestionID'];
                            if ($count == 0) {
                        
                      echo  "<div class='divNote'>
                                        
                                    <label class='NoteText' ><img src='../img/note1.png'> Oops.. No Questionnaires</label>

                                    <button name='addQbtn' class='addbtn'><a href='add_grad_question?$encrypted&&SID=$surveyID'><img src='../img/addQ.png' alt=''> Add Questionnaires</a></button>
 
                            </div>";


                    }else{
                        $querys = mysqli_query($conn, "SELECT * FROM admin_responsetbl where Question_ID=$QueID");
                        $results = mysqli_num_rows($querys);
                        if ($results == 0) {
                            $hide = "";
                        }else{
                            $hide = "style='display:none;'";
                        }
                    ?>
                                 
                                <div class='divNote'>
                                        
                                    <label class='NoteText' ><img src='../img/note1.png'> Important Note: You cannot Modify Questionnaires when its already has a Response(s).</label>
                                    <button <?php echo $hide; ?> name='addQbtn' class='addbtn' for="add">
                                    <a id="add" href='Add_grad_question?SID=<?php echo $surveyID; ?>'><img src="../img/addQ.png" alt=""> Add Questionnaires</a>
                                    </button>                                   
                                </div>

                            <div class="question-box">

                                    <form action="" method="POST">


                        <div class="scroller">
                          <?php              

                            $sql = "SELECT * FROM questiontbl WHERE Survey_ID='$surveyID'";
                            $result = $conn-> query($sql);
                            
                            if ($result-> num_rows > 0){
                                    $count = 0;
                                    while ($row = $result-> fetch_assoc()){
                                            $QID = $row['QuestionID'];
                                            $QType = $row['QuestionType'];
                                            $Question = $row['Question'];
                                            $Required = $row['Required'];
                                            $other = $row['Others'];
                                            $count = $count + 1;
                                       if ($QType == "ShortAnswer") {
                                        if ($Required == "yes") {
                                            $style = "style='border-bottom:2px solid #ff4949;'";
                                            $hideme="";
                                        }else{
                                            $style= "";
                                            $hideme="hidden";
                                        }
                                       
                            ?> 


                        <!---================================== Question No. 1 Short Answer =============================--->
                            <div style="position:relative;" class="shadowbox">

                            <div <?php echo $style; ?> class="question-row">
                                    
                            <input readonly class="MainQuestion" type="text" name="Question[<?php echo $count; ?>]" value="<?php echo "Q".$count.".) ". $Question; ?>">
                            <span <?php echo $hideme; ?> style="position:absolute; margin-left:737px; margin-top:12px; color:aliceblue; background:#ff4949; font-weight:500; font-size:12px; border-radius:0 0 0 3px; padding:3px;">Required</span>                                                                              
                            </div>

                            <div class="questionnaires">
                                                
                                <input type="text" class="Answer-text" name="Q1" placeholder="Short Text" ><br>
                            
                            <span <?php echo $hide; ?> class="actionbtn">
                                <!-- <span class="btnedit"><img  src="../img/update.png" alt=""></span> -->
                            <span class="divider">|</span>    
                                <span class="btndelete" onClick="deleteme(<?php echo $QID;?>)"><img src="../img/delete.png" alt=""></span>  
                            </span><br>
                            
                            </div>

                            

                            </div>
                            <?php 
                            }
                            if ($QType == "LongAnswer") {
                                if ($Required == "yes") {
                                    $style = "style='border-bottom:2px solid #ff4949;'";
                                    $hideme="";
                                }else{
                                    $style= "";
                                    $hideme="hidden";
                                }
                            ?>

                        <!---================================== Question No. 2 Long Answer =============================--->
                            <div style="position:relative;" class="shadowbox">

                                    <div <?php echo $style; ?> class="question-row">
                                            
                                    <input readonly class="MainQuestion" type="text" name="Question[<?php echo $count; ?>]" value="<?php echo "Q".$count.".) ". $Question; ?>">
                                    <span <?php echo $hideme; ?> style="position:absolute; margin-left:737px; margin-top:12px; color:aliceblue; background:#ff4949; font-weight:500; font-size:12px; border-radius:0 0 0 3px; padding:3px;">Required</span>                                                                           
                                    </div>

                                    <div class="questionnaires">
                                                    
                                        <label>
                                        <textarea type="text" class="LongAnswer-text" name="Q1" placeholder="Long Text" value=""></textarea>
                                        </label><br>
                                    <span <?php echo $hide; ?> class="actionbtn">
                                        <!-- <span class="btnedit"><img  src="../img/update.png" alt=""></span> -->
                                    <span class="divider">|</span>    
                                        <span class="btndelete" onClick="deleteme(<?php echo $QID;?>)"><img src="../img/delete.png" alt=""></span>  
                                    </span><br>
                                    
                                    </div>

                            

                            </div>
                            <?php 
                            }
                            if ($QType == "Multiplechoice") {
                                if ($Required == "yes") {
                                    $style = "style='border-bottom:2px solid #ff4949;'";
                                    $hideme="";
                                }else{
                                    $style= "";
                                    $hideme="hidden";
                                }
                                if ($other == "no") {
                                    $oth = "style='display:none;'";  
                                }else{
                                    $oth = "";
                                }
                            ?>

                        <!---================================== Question No. 3 Multiplechoice =============================--->
                            <div style="position:relative;" class="shadowbox">

                            <div <?php echo $style; ?> class="question-row">
                                    
                            <input readonly class="MainQuestion" type="text" name="Question[<?php echo $count; ?>]" value="<?php echo "Q".$count.".) ". $Question; ?>">
                            <span <?php echo $hideme; ?> style="position:absolute; margin-left:737px; margin-top:12px; color:aliceblue; background:#ff4949; font-weight:500; font-size:12px; border-radius:0 0 0 3px; padding:3px;">Required</span>                                                                              
                            </div>

                            <div class="questionnaires">
                            <?php 
                            $sql1 = "SELECT Answer FROM answertbl WHERE Question_ID='$QID'";
                            $result1 = $conn-> query($sql1);

                            if ($result1-> num_rows > 0){
                                    
                                    while ($row1 = $result1-> fetch_assoc()){
                                            $Answer = $row1['Answer'];
                                            
                            
                            ?>
                            <label class="optionlbl" ><input type="radio" class="radiobtn" name="option<?php echo $count; ?>" > <?php echo $Answer; ?></label>
                            <?php } }?>

                            <label <?php echo $oth; ?> class="optionlbl">
                            <input type="radio" class="radiobtn" name="option<?php echo $count; ?>" id="multi" value="others">  Other, Please specify:
                            <input type="text" class="Answer-text" name="option<?php echo $count; ?>" id="multi" > 
                            </label>
                            
                            <span <?php echo $hide; ?> class="actionbtn">
                                <!-- <span class="btnedit"><img  src="../img/update.png" alt=""></span> -->
                            <span class="divider">|</span>    
                                <span class="btndelete" onClick="deleteme(<?php echo $QID;?>)"><img src="../img/delete.png" alt=""></span>  
                            </span><br>
                            
                            </div>

                            </div>
                            <?php 
                            }
                            if ($QType == "Checkbox") {
                                if ($Required == "yes") {
                                    $style = "style='border-bottom:2px solid red;'";
                                    $hideme="";
                                }else{
                                    $style= "";
                                    $hideme="hidden";
                                }
                                if ($other == "no") {
                                    $oth = "style='display:none;'";  
                                }else{
                                    $oth = "";
                                }
                            ?>
                            <!---================================== Question No. 4 Checkbox =============================--->
                            <div style="position:relative;" class="shadowbox">

                            <div <?php echo $style; ?> class="question-row">
                                    
                            <input readonly class="MainQuestion" type="text" name="Question[<?php echo $count; ?>]" value="<?php echo "Q".$count.".) ". $Question; ?>">
                            <span <?php echo $hideme; ?> style="position:absolute; margin-left:737px; margin-top:13px; color:aliceblue; background:#ff4949; font-weight:500; font-size:12px; border-radius:0 0 0 3px; padding:3px;">Required</span>                                                                              
                            </div>

                            <div class="questionnaires">
                            <?php 
                            $sql1 = "SELECT Answer FROM answertbl WHERE Question_ID='$QID'";
                            $result1 = $conn-> query($sql1);

                            if ($result1-> num_rows > 0){
                                    
                                    while ($row1 = $result1-> fetch_assoc()){
                                            $Answer = $row1['Answer'];
                                            
                            
                            ?>
                            <label class="optionlbl"><input type="Checkbox" class="radiobtn" name="option<?php echo $count; ?>" > <?php echo $Answer; ?></label>
                            <?php } }?>

                            <label  <?php echo $oth; ?> class="optionlbl">
                            <input type="checkbox" class="radiobtn" name="OthersChoiceforQ<?php echo $count; ?>" id="multi" value="others">  Other, Please specify:
                            <input type="text" class="Answer-text" name="OtherAnswerforQ<?php echo $count; ?>" id="multi" > 
                            </label>
                            
                            <span <?php echo $hide; ?> class="actionbtn">
                                <!-- <span class="btnedit"><img  src="../img/update.png" alt=""></span> -->
                            <span class="divider">|</span>    
                                <span class="btndelete" onClick="deleteme(<?php echo $QID;?>)"><img src="../img/delete.png" alt=""></span>  
                            </span><br>
                            
                            </div>

                            </div>
                        <?php 
                            }
                            if ($QType == "Date") {
                                if ($Required == "yes") {
                                    $style = "style='border-bottom:2px solid #ff4949;'";
                                    $hideme="";
                                }else{
                                    $style= "";
                                    $hideme="hidden";
                                }
                        ?>
                    <!---================================== Question No. 5 Date =============================--->
                        <div style="position:relative;" class="shadowbox">

                            <div <?php echo $style; ?> class="question-row">
                                    
                            <input readonly class="MainQuestion" type="text" name="Question[<?php echo $count; ?>]" value="<?php echo "Q".$count.".) ". $Question; ?>">
                            <span <?php echo $hideme; ?> style="position:absolute; margin-left:737px; margin-top:13px; color:aliceblue; background:#ff4949; font-weight:500; font-size:12px; border-radius:0 0 0 3px; padding:3px;">Required</span>                                                                               
                            </div>

                            <div class="questionnaires">
                                                
                                <input type="date" class="Answer-text" name="Answer[<?php echo $count; ?>]"><br>
                            
                            <span <?php echo $hide; ?> class="actionbtn">
                                <!-- <span class="btnedit"><img  src="../img/update.png" alt=""></span> -->
                            <span class="divider">|</span>    
                                <span class="btndelete" onClick="deleteme(<?php echo $QID;?>)"><img src="../img/delete.png" alt=""></span>  
                            </span><br>
                            
                            </div>

                            

                        </div>


                  <!--  end of loop =>      
                            <?php 
                            }

                    }
                }
            
                            ?>


                <!-=====================Footer Done button ------>
                            <div class='divFooter'>
                                        
                                    
                                    <button name='addQbtn' class='addbtn'><a href='graduates_survey?SID=<?php echo $surveyID;?>'>Done</a></button>
                               
                            </div>
                            </div>
        <?php } ?>
            </div>

            </div>
                
         </div>
         <script language="javascript">

                function deleteme(qid){

                    if (confirm("Youre about to delete Questionnaire, continue?")) {

                                window.location.href='delete_question?QID='+qid+'';
            return true;
            }
        }

</script>

  

</body>
</html>
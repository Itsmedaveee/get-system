<?php
$encrypted = md5(rand(1,9));
session_start();
if (isset($_SESSION["email"])) {
    $email = $_SESSION["email"];
}else{
    echo "<script>window.location.href='../Login';</script>";
    
}

include_once '../includes/connection.php';

$sql_query = mysqli_query($conn, "SELECT ID, Name, account_type from userstb WHERE Email='$email'");
$fetch = mysqli_fetch_assoc($sql_query);
$db_name = ucfirst($fetch['Name']);
$db_account_type = $fetch['account_type'];
$UID = $fetch['ID'];
$db_email = $email;
$sql = mysqli_query($conn, "SELECT Stud_No, GID from graduates_infotbl WHERE UID='$UID'");
$fetchSN = mysqli_fetch_assoc($sql);
$SN = $fetchSN['Stud_No'];
$GID = $fetchSN['GID'];
if ($db_account_type == 3) {
    $account_type = "Alumni / ".$SN;
    
}else{
    echo "<script>window.location.href='../Login';</script>";
    
}
if (isset($_POST['cancelbtn'])) {
    echo "<script>window.location.href='alumni_surveys';</script>";
}
if(!empty($_GET['SID']))
            {
            $surveyID = $_GET['SID'];
            
            
            $sql_query = mysqli_query($conn, "SELECT Title, Description from mysurveytbl WHERE Survey_ID='$surveyID'");
            $fetch = mysqli_fetch_assoc($sql_query);
            $SurveyTitle = $fetch['Title'];
            $Description = $fetch['Description'];
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
label a:hover{
    opacity:0.7;
    
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

.question-row:hover{
    font-size: 1.02em;
    
}

.question-row:hover label{
    font-size: 1.02em;
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
    display:flex;
    justify-content: space-between;
    
    min-width:802px;
    max-width:802px;
    background:#ffb649;
    border-radius: 0px 0px 5px 5px;
}
.NoteText{
    margin-left:250px;
    margin-top:10px;
    padding:0;
    color:rgba(0,0,0,0.705); 
    font-size: .8em;
    font-weight: 600; 
    font-style:italic;
    
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
.divNote .prev img{
    border-radius: 4px 4px 4xp 4px;
    padding:3px;
    background: rgba(0,0,0,.5);
    transform: rotate(90deg);
}
.divNote .next img:hover{
    opacity:0.8;
}
.divNote .next img{
    border-radius: 4px 4px 4xp 4px;
    padding:3px;
    background: rgba(0,0,0,.5);
    transform: rotate(-90deg);
}
.divNote .prev img:hover{
    opacity:0.8;
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
.Answerlabel{
    margin:0;
    padding:0;
    padding-left: 40px;
    line-height: 1;
    color:rgba(0,0,0,0.6);
    font-weight:600;
    font-size:.95em;
}
.question-box{
    overflow-y: scroll;
    max-height:340px;
}
.MainQuestion{
    outline:none;
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
    
</head>
<body>
    <header>
        <div class="container">
            <div id="title">
                <h2><span class="highlights">G</span>raduates <span class="highlights">E</span>mployability <span class="highlights">T</span>racer <span class="highlights">S</span>ystem</h2>
            </div>
            <nav>
                <ul>
                   <li class="current"><a href="../logout.php"><i class="fa fa-sign-out-alt"></i> Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    
        <div class="navbox">

                <div class="sidepanel">
                <img src="../img/images 7.jpeg" class="emailphoto">
                        <div class="photo">
                            <img src="../img/photo10.png" class="accphoto">
                            <label for="" class="fullname"><?php echo ucfirst($db_name); ?></label>
                            
                        </div>

                        <div class="emailacc">
                            
                            <p class="email-user" ><b><?php echo $email; ?></b><br><i><font color="#ffffff"><?php echo $account_type; ?></font></i></p>
                          
                        </div>
                            
                    </div>
            
        
            <div class="navpanel">

            <div class="multi-level">
                <div class="item">
                    
                    <label for="E" style="margin:0; padding:0;"><a href="alumni_page" style="text-decoration:none; color:#0c1c22; padding:200px 150px 15px 30px;"><i class="fa fa-home"></i> Dashboard</a></label> 
                 
                  </div>
                </div>

                <div class="item">
                    <input type="checkbox" id="A">
                    <img src="../img/emaildropdown5.png" class="arrow"><label for="A">Surveys</label>
                    <ul>
                        <li><a style="padding-top:20px; padding-bottom:20px;" href="alumni_surveys"><i class="fa fa-pen"></i> Surveys</a></li>
                    </ul>
                </div>
                <div class="item">
                    <input type="checkbox" id="B">
                    <img src="../img/emaildropdown5.png" class="arrow"><label for="B">Jobs</label>
                    <ul>
                        <li><a style="padding-top:20px; padding-bottom:20px;" href="alumni_add_job"><i class="fa fa-briefcase-medical"></i> Post Jobs</a></li>
                        <li><a style="padding-top:20px; padding-bottom:20px;" href="alumni_job_offerings"><i class="fa fa-briefcase"></i> Job Offerings</a></li>
                    </ul>
                </div>
               
                
            </div>
         </div>

         <div class="dropdownnav">
         <input type="checkbox" id="D">
         <label for="D"><img class="emaildropdown" src="../img/emaildropdown5.png"></label>
                            <ul>
                                <li><a href="alumni_changepass"><i class="fa fa-user-lock"></i> Change password</a></li>
                                <li><a href="alumni_personal_info"><i class="fa fa-user-cog"></i> Personal Info</a></li>
                                
                            </ul>

        </div>

         <div class="mainpanel">
            <div class="statuspanel">
            <?php 
            if (empty($_GET['notify'])) {
                        
                echo "";
            } else {
                echo "<br><h5 class='hnoti'><font color='green'><i class='fa fa-check-circle'></i> ". $_GET['notify'] ."</font></h5>";
                unset($_GET['notify']);
            }
            ?>
            </div>
           <div class="datapanel">
           

           <div class="headcontainer">
                    <CAPTION><span><?php if(!empty($surveyID)){ echo ucfirst($SurveyTitle); }?></span></CAPTION>
                </div>

                <div class="bodycontainer">
                    <CAPTION><span><?php if(!empty($surveyID)){ echo ucfirst($Description);} ?></span></CAPTION>
                </div>
               
                    <?php 
                            $encrypt = md5(rand(1,9));
                            $encrypt1 = md5(rand(1,9));
                            $encrypt2 = md5(rand(1,9));

                            $query = mysqli_query($conn, "SELECT * FROM admin_respondenttbl where Survey_ID=$surveyID");
                            $result = mysqli_num_rows($query);
                            $fetchss = mysqli_fetch_assoc($query);
                            $date = $fetchss['date']." @ ".$fetchss['time'];
                            
                            if ($result > 0) {
                        
                      echo  "<div class='divNote'>
                                        
                                    <label class='NoteText' >Date Answered: $date </label>

                            </div>";


                    }
                    
                    ?>
                            <div class="question-box">

                                    <form action="" method="POST">
                                 
                        
                          <?php 

    
                            
                            $sql = "SELECT * FROM questiontbl WHERE Survey_ID='$surveyID'";
                            $result = $conn-> query($sql);
                            
                            if ($result-> num_rows > 0){
                                    $count = 0;
                                    while ($row = $result-> fetch_assoc()){
                                            $QID = $row['QuestionID'];
                                            $QType = $row['QuestionType'];
                                            $Question = $row['Question'];
                                            $count = $count + 1;
                                            $query_res = mysqli_query($conn, "SELECT * FROM admin_respondenttbl where Survey_ID='$surveyID' AND GID = '$GID'");
                                            $fetching = mysqli_fetch_assoc($query_res);
                                            $ARID = $fetching['AR_ID'];
                                       if ($QType == "ShortAnswer") {

                                       
                    
                             
                            ?> 


                        <!---================================== Question No. 1 Short Answer =============================--->
                            <div class="shadowbox">

                            <div class="question-row">
                                    
                            <input readonly class="MainQuestion" type="text" name="Question[<?php echo $count; ?>]" value="<?php echo "Q".$count.".) ". $Question; ?>">
                                                                                                           
                            </div>

                            <div class="questionnaires">
                            <span class="Answerlabel" style="margin-left:-15px;">Answer(s):</span><br>
                                        <?php 
                                        $sql1 = "SELECT * FROM admin_responsetbl WHERE Question_ID='$QID' AND AR_ID='$ARID'";
                                        $result1 = $conn-> query($sql1);
                                        
                                        if ($result1-> num_rows > 0){
                                                
                                            while ($row1 = $result1-> fetch_assoc()){
                                                        $Response = $row1['Response'];
                                                        if ($Response == "Not Answered") {
                                                            $color = "style='color:red'";
                                                        }else{
                                                            $color = "";
                                                        }                          
                                                    ?>

                                <label  class="Answerlabel" <?php echo $color ?>>- <?php echo $Response; ?></label>


                                    <?php }  } ?>                                        
                            </div>

                            

                            </div>
                            <?php 
                            }
                            if ($QType == "LongAnswer") {
                            ?>

                        <!---================================== Question No. 2 Long Answer =============================--->
                            <div class="shadowbox">

                                    <div class="question-row">
                                            
                                    <input readonly class="MainQuestion" type="text" name="Question[]" value="<?php echo "Q".$count.".) ". $Question; ?>">
                                                                                                                
                                    </div>

                                    <div class="questionnaires">
                                    <span class="Answerlabel" style="margin-left:-15px;">Answer(s):</span>          
                                        
                                        <?php 
                                        $sql1 = "SELECT * FROM admin_responsetbl WHERE Question_ID='$QID' AND AR_ID='$ARID'";
                                        $result1 = $conn-> query($sql1);

                                        if ($result1-> num_rows > 0){
                                                
                                            while ($row1 = $result1-> fetch_assoc()){
                                                $Response = $row1['Response'];
                                                
                                                if ($Response == "Not Answered") {
                                                    $color = "style='color:red'";
                                                }else{
                                                    $color ="";
                                                }                                     
                                                    ?>

                                        <label  class="Answerlabel" <?php echo $color ?>>- <?php echo $Response; ?></label>
                                        
                                        <?php } } ?>

                                        
                                    
                                    
                                    </div>

                            

                            </div>
                            <?php 
                            }
                            if ($QType == "Multiplechoice") {
                            ?>

                        <!---================================== Question No. 3 Multiplechoice =============================--->
                            <div class="shadowbox">

                            <div class="question-row">
                                    
                            <input readonly class="MainQuestion" type="text" name="Question[]" value="<?php echo "Q".$count.".) ". $Question; ?>">
                                                                                                           
                            </div>

                            <div class="questionnaires">
                               
                                <span class="Answerlabel" style="margin-left:-15px;">Answer(s):</span>
                                      
                            <?php 
                                        $sql1 = "SELECT * FROM admin_responsetbl WHERE Question_ID='$QID' AND AR_ID='$ARID'";
                                        $result1 = $conn-> query($sql1);
                                        
                                        if ($result1-> num_rows > 0){
                                                
                                                while ($row1 = $result1-> fetch_assoc()){
                                                        $Response = $row1['Response'];
                                                        
                                                        if ($Response == "Not Answered") {
                                                            $color = "style='color:red;'";
                                                        }else{
                                                            $color = "";
                                                        }                                      
                                                    ?>
                            <label  class="Answerlabel" <?php echo $color ?>>- <?php echo $Response; ?></label>
                            <?php } }?>
                            
                            
                            
                            </div>

                            </div>
                            <?php 
                            }
                            if ($QType == "Checkbox") {
                            ?>
                            <!---================================== Question No. 4 Checkbox =============================--->
                            <div class="shadowbox">

                            <div class="question-row">
                                    
                            <input readonly class="MainQuestion" type="text" name="Question[]" value="<?php echo "Q".$count.".) ". $Question; ?>">
                                                                                                           
                            </div>

                            <div class="questionnaires">
                            <span class="Answerlabel" style="margin-left:-15px;">Answer(s):</span>
                            <?php 

                            $queryother = mysqli_query($conn, "SELECT * FROM admin_otherrestbl WHERE AR_ID=$ARID AND Question_ID=$QID");
                                    $othercount = mysqli_num_rows($queryother);
                                    if ($othercount > 0) {
                                        $otherresult = mysqli_fetch_assoc($queryother);
                                        $other = $otherresult['Response'];
                                    }
                                    if ($othercount > 0) {
                                        echo "<label  class='Answerlabel'>$other</label> <br>";
                                    }
                                    
                                        $sql1 = "SELECT * FROM admin_responsetbl WHERE Question_ID='$QID' AND RespondentID=$RID";
                                        $result1 = $conn-> query($sql1);
                                        
                                        if ($result1-> num_rows > 0){
                                                
                                                while ($row1 = $result1-> fetch_assoc()){
                                                        $Response = $row1['Response'];
                                                        
                                                        if ($Response == "Not Answered") {
                                                            $color = "style='color:red;'";
                                                        }else{
                                                            $color = "";
                                                        }                                        
                                                    ?>
                            <label  class="Answerlabel" <?php echo $color ?>>- <?php echo $Response; ?></label> <br>
                            <?php } }?>
                            
                            
                            
                            </div>

                            </div>
                        <?php 
                            }
                            if ($QType == "Date") {
                        ?>
                    <!---================================== Question No. 6 Date =============================--->
                        <div class="shadowbox">

                            <div class="question-row">
                                    
                            <input readonly class="MainQuestion" type="text" name="Question[]" value="<?php echo "Q".$count.".) ". $Question; ?>">
                                                                                                           
                            </div>

                            <div class="questionnaires">
                            <span class="Answerlabel" style="margin-left:-15px;">Answer(s):</span>
                            <?php 
                                        $sql1 = "SELECT * FROM admin_responsetbl WHERE Question_ID='$QID' AND AR_ID='$ARID'";
                                        $result1 = $conn-> query($sql1);
                                        
                                        if ($result1-> num_rows > 0){
                                                
                                                while ($row1 = $result1-> fetch_assoc()){
                                                        $Response = $row1['Response'];
                                                        
                                                        if ($Response == "Not Answered") {
                                                            $color = "style='color:red;'";
                                                        }else{
                                                            $color = "";
                                                        }                                        
                                                    ?>


                                <label  class="Answerlabel"<?php echo $color ?>>- <?php echo $Response; ?></label>
                            

                                                <?php } } ?>


    
                            </div>

                        </div>


                  <!--  end of loop =>      
                            <?php 
                                    
                                    
                                
                            
                        }

                    }
                
            
        
            
                            ?>


                <!-=====================Footer Done button ------>
                            <div class='divFooter'>
                                        
                                    <button name='addQbtn' class='addbtn'><a href='alumni_surveys?<?php echo $encrypted;?>&&SID=<?php echo $surveyID;?>'>BACK</a></button>
 
                            </div>

        <?php } ?>
            </div>



                
            </div>
                
         </div>
  

</body>
</html>
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
$userID = $fetch['ID'];
$db_email = $email;
if ($db_account_type == 2) {
    $account_type = "Data Processor/Encoder";
    
}else{
    echo "<script>window.location.href='../Login';</script>";
    
}

if (isset($_GET['page'])) {
    $page = $_GET['page'];
}else {
    $page = 1;
}
$num_per_page = 1;
$start_from = ($page - 1)*1;

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
    margin-top:10px;
    padding:0;
    color:rgba(0,0,0,0.705); 
    font-size: .9em;
    font-weight: 800; 
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
    max-height:50px;
    margin:0;
    padding:0;
    padding-left: 40px;
    line-height: 1;
    color:rgba(0,0,0,0.6);
    font-weight:600;
    font-size:.95em;
    word-wrap:break-word;
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
                   <li class="current"><a href="../logout.php">Logout</a></li>
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
                       
                    </div>
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

                    
                            $query = mysqli_query($conn, "SELECT * FROM questiontbl where Survey_ID=$surveyID");
                            $result = mysqli_num_rows($query);
                            if ($result == 0) {
                        
                      echo  "<div class='divNote'>
                                        
                                    <label class='NoteText' ><img src='../img/note1.png'> Oops.. No Response(s)</label>

                                    <button name='addQbtn' class='addbtn'><a href='Add_Questionnaire?$encrypted&&SID=$surveyID'><img src='../img/addQ.png' alt=''> Add Questionnaires</a></button>
 
                            </div>";


                    }else{

                        $sqltotal = "SELECT * FROM Respondenttbl WHERE Survey_ID='$surveyID'";
                        $resulttotal = $conn-> query($sqltotal);
                        $totalcount = $resulttotal-> num_rows;
                        $sqlrespondent = "SELECT * FROM Respondenttbl WHERE Survey_ID='$surveyID' LIMIT $start_from,$num_per_page";
                        $resultrespondent = $conn-> query($sqlrespondent);
                            
                            if ($resultrespondent-> num_rows > 0){
                                    
                                    while ($rowrespondent = $resultrespondent-> fetch_assoc()){
                                            $RID = $rowrespondent['RID'];
                        
                    ?>
                                <div class='divNote'>
                                <?php 
                                if ($page == 1) {
                                    $hideprev = "style='visibility:hidden'";
                                }else{
                                    $hideprev = "";
                                }
                                ?>
                                    <a <?php echo $hideprev; ?> href="Individual_response?page=<?php echo $page - 1; ?>&&SID=<?php echo $surveyID; ?>" class="prev">
                                    <img src="../img/next.png" alt=""></a>   
                               
                                    <span class='NoteText'>Individual Response <?php echo $page; ?> of <?php echo $totalcount; ?></span>
                                <?php 
                                if ($page == $totalcount) {
                                    $hidenext = "style='visibility:hidden'";
                                }else{
                                    $hidenext = "";
                                }
                                
                                ?>
                                    <a <?php echo $hidenext; ?> href="Individual_response?page=<?php echo $page + 1; ?>&&SID=<?php echo $surveyID; ?>" class="next">
                                    <img src="../img/next.png" alt=""></a>
                                        
                                </div>

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
                                       if ($QType == "ShortAnswer") {

                                       
                    
                             
                            ?> 


                        <!---================================== Question No. 1 Short Answer =============================--->
                            <div class="shadowbox">

                            <div class="question-row">
                                    
                            <input readonly class="MainQuestion" type="text" name="Question[<?php echo $count; ?>]" value="<?php echo "Q".$count.".) ". $Question; ?>">
                                                                                                           
                            </div>

                            <div class="questionnaires">
                                                
                                        <?php 
                                        $sql1 = "SELECT * FROM responsetbl WHERE Question_ID='$QID' LIMIT $start_from,$num_per_page";
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

                                <label  class="Answerlabel" <?php echo $color ?>><?php echo $Response; ?></label>


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
                                                    
                                        
                                        <?php 
                                        $sql1 = "SELECT * FROM responsetbl WHERE Question_ID='$QID' LIMIT $start_from,$num_per_page";
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

                                        <label  class="Answerlabel" <?php echo $color ?>><?php echo $Response; ?></label>
                                        
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
                            <?php 
                                        $sql1 = "SELECT * FROM responsetbl WHERE Question_ID='$QID' LIMIT $start_from,$num_per_page";
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
                            <label  class="Answerlabel" <?php echo $color ?>><?php echo $Response; ?></label>
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
                            <?php 

                                    $queryother = mysqli_query($conn, "SELECT * FROM otherstbl WHERE RespondentID=$RID AND Question_ID=$QID");
                                    $othercount = mysqli_num_rows($queryother);
                                    if ($othercount > 0) {
                                        $otherresult = mysqli_fetch_assoc($queryother);
                                        $other = $otherresult['Response'];
                                    }
                                    if ($othercount > 0) {
                                        echo "<label  class='Answerlabel'>$other</label> <br>";
                                    }

                                        $sql1 = "SELECT * FROM responsetbl WHERE Question_ID='$QID' AND RespondentID=$RID";
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
                                                    
                            <label  class="Answerlabel" <?php echo $color ?>><?php echo $Response; ?></label> <br>


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
                                                
                            <?php 
                                        $sql1 = "SELECT * FROM responsetbl WHERE Question_ID='$QID' LIMIT $start_from,$num_per_page";
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


                                <label  class="Answerlabel"<?php echo $color ?>><?php echo $Response; ?></label>
                            

                                                <?php } } ?>


    
                            </div>

                        </div>


                  <!--  end of loop =>      
                            <?php 
                                    
                                    
                                
                            
                        }

                    }
                }
            }
        }
            
                            ?>


                <!-=====================Footer Done button ------>
                            <div class='divFooter'>
                                        
                                    

                                    <button name='addQbtn' class='addbtn'><a href='user_response?$encrypted&&SID=<?php echo $surveyID;?>'>BACK</a></button>
 
                            </div>

        <?php } ?>
            </div>

            </div>
                
         </div>
         <script language="javascript">

                function deleteme(qid){

                    if (confirm("Youre about to delete Questionnaire, continue?")) {

                                window.location.href='Del_Question?QID='+qid+'';
            return true;
            }
        }

</script>

</body>
</html>
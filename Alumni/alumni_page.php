<?php
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
$sql = mysqli_query($conn, "SELECT Stud_No,year_graduated,GID from graduates_infotbl WHERE UID='$UID'");
$fetchSN = mysqli_fetch_assoc($sql);
$SN = $fetchSN['Stud_No'];
$batch = $fetchSN['year_graduated'];
$GID = $fetchSN['GID'];
if ($db_account_type == 3) {
    $account_type = "Alumni / ".$SN;
    
}else{
    echo "<script>window.location.href='../Login';</script>";
    
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
.div-jobs{
    width:800px;
   
    height:220px;
}
.div-surveys{
    width:800px;
    
    height:220px;
}
.view-all:hover{
    opacity:0.7;
}
.viewjob{
    letter-spacing:0.2;
    margin-left:720px;
    padding:4; 
    background:#2e68aa; 
    color:aliceblue; 
    border:0; 
    border-radius: 3px 3px 3px 3px; 
    cursor:pointer;
    font-size:13px;
    font-weight:500;
    text-decoration:none;
    box-shadow:2px 2px 2px 1px rgba(0,0,0,0.350);
}
.viewjob:hover{
    opacity:0.7;
}
.tooltipv{
    display:none;
}
.bt-view{
    background: #2e68aa;
    color:aliceblue;
    border-radius: 3px 3px 3px 3px;
    padding: 4 5 5 5;
}
.bt-view:hover{
    opacity:0.7;
}
.bt-view:hover ~ .tooltipv{
    font-weight:bold;
    display:block;
    position:absolute;
    color:black;
    background: #f8fbfc81;
    border: 1px solid grey;
    margin-top:10px;
}
.divText{
    width:190px;
    text-overflow: ellipsis;
    overflow: hidden;
    margin:none;
    padding:none;
}

.toolr{
    border-radius: 3px 3px 3px 3px;
    color: aliceblue;
    font-size: 13px;
    background: #2e68aa;
    padding: 5 6 6 6;
    text-decoration: none;
    border:none;
    cursor: pointer;
   
}
.toolr:hover, .toolq:hover{
    opacity:0.7;
}
.tooltips{
    display:none;
}
.toolr:hover ~ .tooltips{
    font-weight:bold;
    display:block;
    position:absolute;
    color:black;
    background: #f8fbfc81;
    border: 1px solid grey;
    margin-left:30px;
    margin-top:10px;
    
}
.toolq{
    border-radius: 3px 3px 3px 3px;
    color: #ffffff;
    font-size: 13px;
    background: #2e68aa;
    padding: 5px 7px 5px 7px;
    text-decoration: none;
    border:none;
    cursor: pointer;
}
.tooltip{
    display:none;
}
.toolq:hover ~ .tooltip{
    font-weight:bold;
    display:block;
    position:absolute;
    color:black;
    background: #f8fbfc81;
    border: 1px solid grey;
    margin-top:10px;
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
                    
                    <label for="E" style="margin:0; padding:0;"><a href="" style="text-decoration:none; color:#0c1c22; padding:200px 150px 15px 30px;"><i class="fa fa-home"></i> Dashboard</a></label> 
                 
                  </div>
                </div>

                <div class="item">
                    <input type="checkbox" id="A">
                    <img src="../img/emaildropdown5.png" class="arrow"><label for="A"><i class="fa fa-pen"></i> Surveys</label>
                    <ul>
                        <li><a style="padding-top:20px; padding-bottom:20px;" href="alumni_surveys"><i class="fa fa-pen"></i> Surveys</a></li>
                    </ul>
                </div>
                <div class="item">
                    <input type="checkbox" id="B">
                    <img src="../img/emaildropdown5.png" class="arrow"><label for="B"><i class="fa fa-briefcase"></i> Jobs</label>
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
           <div class="div-jobs">
           <h3>Recent Job Post</h3>
           <a href='alumni_job_offerings' taget="_blank" class='viewjob' > View All</a>
           <table border="0" width="500" align="center"class="table-stripped" >
           <thead>
                        <tr height="30"> 
                            <th >Job Title</th>
                            <th>Company</th>
                            <th >Location</th>
                            <th >Actions</th>
                        </tr>
                    </thead>
            <?php 
            $query = mysqli_query($conn, "SELECT * FROM job_offeringtbl");
            $total_count = mysqli_num_rows($query);
            if ($total_count == 0) {
                echo "<tr><td colspan='4'>
                <center><b>No Record Found</b></center>
                </td></tr></table>";
            } else {

            $sql = "SELECT * FROM job_offeringtbl order by JID desc limit 0,4";
            $result = $conn-> query($sql);

            if ($result-> num_rows > 0){
                
                $showcount = 0;
                while ($row = $result-> fetch_assoc()){
                    $showcount = $showcount + 1;
                    $JID = $row['JID'];
                    $title = $row['title'];
                    $company = ucfirst($row['company']);
                    $location = $row["location"];
                   
                    

                $jScript = md5(rand(1,9));
                $newScript = md5(rand(1,9));
                $getUpdate = md5(rand(1,9));
                $getDelete = md5(rand(1,9));
                    
    
                echo "<tbody><tr height=30>
                        <td ><div class='divText'>$title</div></td>
                        <td ><div class='divText'>$company</div></td>
                        <td ><div class='divText'>$location</div></td>
                        
                      
                       <td width='40px'>
                       <a href='alumni_job_details?jScript=$jScript && newScript=$newScript && view=$getUpdate && JID=$JID' class='bt-view'>
                       <i class='fa fa-eye'></i></a>
                       <span class='tooltipv'>View more details</span>
                      
                       </td>                         
                     </tr>
                     </tbody>
                     
                     ";
                     
    
                }
                echo "</table>";
            }
        }
            ?>

           </div>

            <br>

           <div class="div-surveys">
           <h3>Latest Surveys</h3>
           <a href='alumni_surveys' taget="_blank" class='viewjob' > View All</a>
            <table border="0" width="100%" align="center"class="table-stripped" >

                   <thead>
                       <tr height="35"> 
                           
                           <th >Title</th>
                           <th >Status</th>
                           <th >No. of Question</th>
                           <th >Date Sent</th>
                           <th >Deadline</th>
                           <th >Actions</th>

                       </tr>
                   </thead>
                   <?php 
               //***************************Showing all Surveys  */ 
                                   
                       $query = mysqli_query($conn, "SELECT * FROM sent_surveytbl WHERE batch='$batch'");
                       $total_count = mysqli_num_rows($query);
                       if ($total_count == 0) {
                           echo "<tr><td colspan='6'>
                           <center><b>No Survey Available</b></center>
                           </td></tr></table>";
                       } else {
           
                       $sql = "SELECT * FROM sent_surveytbl WHERE batch = $batch ORDER BY ID DESC limit 0,4";
                       $result = $conn-> query($sql);

                       if ($result-> num_rows > 0){
                           $showcount = 0;
                           while ($row = $result-> fetch_assoc()){
                            $showcount = $showcount + 1;
                            $surveyID = $row['Survey_ID'];
                            $db_datesent = $row["date_sent"]."(".$row['time_sent'].")";
                            
                            $get_question = mysqli_query($conn, "SELECT * FROM questiontbl WHERE Survey_ID=$surveyID");
                            $db_no_question = mysqli_num_rows($get_question);
                            $get_respondent = mysqli_query($conn, "SELECT * FROM admin_respondenttbl WHERE Survey_ID=$surveyID AND GID=$GID");
                            $db_respondent = mysqli_num_rows($get_respondent);
                            if ($db_respondent == 0) {
                                $answered = "Not Answered";
                                $hideeye = "hidden";
                                $hideanswer = "";
                            }else{
                                $answered = "Answered";
                                $hideeye = "";
                                $hideanswer = "hidden";
                            }
                            $get_title = mysqli_query($conn, "SELECT Title, Description,end_date FROM mysurveytbl WHERE Survey_ID=$surveyID");
                            $fetchtitle = mysqli_fetch_assoc($get_title);
                            $db_enddate = $fetchtitle["end_date"];
                            $db_title = $fetchtitle['Title'];
                            $db_description = $fetchtitle['Description'];

                        $jScript = md5(rand(1,9));
                        $newScript = md5(rand(1,9));
                        $getResponse = md5(rand(1,9));
                        $getQuestion = md5(rand(1,9));
                        $getEdit = md5(rand(1,9));
                        $getDelete = md5(rand(1,9));


               //******************************SHOWING Survey TABLE <img src='../img/responsewhite.png'> <img  src='../img/questionwhite.png'>  <img src='../img/Addreswhite.png'> <img src='../img/delete1.png'>*/
                           
                           echo "<tbody><tr height=30>

                                   <td><div class='divText'>$db_title</div></td>
                                   <td>$answered</td>
                                   <td>$db_no_question</td>
                                   <td>$db_datesent</td>
                                   <td>$db_enddate</td>
                                   
                                 
                                  <td width='50px'>
                                  <button $hideeye class='toolr' onClick='sendme($surveyID)'>
                                  <i class='fa fa-eye'></i></button>
                                  <span $hideeye class='tooltips'>Review Answer</span>
                                  <a $hideanswer class='toolq' href='alumni_response?jScript=$jScript && newScript=$newScript && getQuestion=$getQuestion && SID=$surveyID && GID=$GID' >
                                  <i class='fa fa-pencil-alt'></i></a>
                                  <span $hideanswer class='tooltip'>Answer Survey</span>
                                 
                                  </td>                         
                                </tr>
                                </tbody>
                                
                                ";
                           }
                           echo "</table>";
                        }
                    }
                           ?>

           </div>
                


            </div>
                
         </div>
  <script>
  function sendme(sid){
         window.location.href='alumni_review_res?SID='+sid+'';
                                 
    }
  </script>

</body>
</html>
<?php
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
?>
<style>
.datapanel h3{
    font-size:1.3em;
    font-weight:400;
}
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
.logs-container{
    width:93%;
    height:410;
    overflow-y:scroll;
    background: rgba(0,0,0,0.02);
}
.logs-content{
    width:96%;
    height:Auto;
    margin-left:13px;
    border-radius: 5px;
    box-shadow: 0 0 .3em rgba(0,0,0,.10);
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
                    <li><a style="padding-top:20px; padding-bottom:20px;" href="#"><i class="fa fa-history"></i> Logs</a></li>
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
                    <li><a style="padding-top:20px; padding-bottom:20px;" href="Logs"><i class="fa fa-pen"></i> Surveys</a></li>
                    <li><a style="padding-top:20px; padding-bottom:20px;" href="Allsurveys"><i class="fa fa-comment"></i> Feedback</a></li>
                    
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
                
           <CAPTION><h3>Activity Logs</h3></CAPTION>
            <br>
            <div class="logs-container" style="margin-left:30px;">
            
               
            <?php
            
            $sql = "SELECT * from logstbl ORDER BY LID DESC";
                $result = $conn-> query($sql);
                $currentDate = '';   
                $currentUID = 0;
                if ($result-> num_rows > 0){
                    while ($row = $result-> fetch_assoc()){
                        $date = $row['Date'];
                        $UID = $row['UID'];
                        $LID = $row['LID'];
                        $sql1 = "SELECT Name, Email from userstb WHERE ID = $UID";
                        $result1 = $conn-> query($sql1);
                        $row1 = $result1-> fetch_assoc();
                        $Uname = $row1['Name'];
                        $email = $row1['Email'];
                        
                        if ($currentDate != strtotime($date)) {

                        echo "<p style='text-decoration:none; margin-top:10px; padding-top: 5px; padding-bottom: 6px; padding-left: 3px; box-shadow: 0 .5em .5em rgba(0,0,0,0.10);'>$date</p>";

                        
                        }
                        
                        if ($currentUID != $UID || $currentDate != strtotime($date)) {
                        $currentDate = strtotime($date);
                        echo "<div class='logs-content'>
                        <h4 style='padding:7px; margin:2px; background:rgba(37, 174, 192, 0.600); border-radius: 5px 5px 0px 0px; color:rgba(0,0,0,0.8);'>$Uname [$email]</h4>";
                        $sql2 = "SELECT * from activity_log WHERE LID = $LID ORDER BY AID DESC";
                        $result2 = $conn-> query($sql2);
                        if ($result2-> num_rows > 0){
                            while ($row2 = $result2-> fetch_assoc()){
                                $time = $row2['Time'];
                                $activity = $row2['Activity'];
                                
                        echo "
                        <span style='line-height:1.7; padding:5px; width:100px; margin:8px; font-weight:450; color:rgba(0,0,0,0.750);'>$activity</span>
                        <span style='float:right; font-weight:400; padding-right:10px;'>$time</span><br>
                        "; 
                                }
                            }
                        
                        echo "</div><br><br>";
                        $currentUID = $UID;
                        }



                    }
                   
                }

            ?>

            
            </div>




                
            </div>
                
         </div>
  

</body>
</html>
<?php
 $encrypted = md5(rand(1,9));
 session_start();
 if (isset($_SESSION["email"])) {
     $email = $_SESSION["email"];
 }else{
     echo "<script>window.location.href='../Login';</script>";
     
 }
 
 include_once '../includes/connection.php';
 
 $sql_query = mysqli_query($conn, "SELECT ID, Name, account_type, Password from userstb WHERE Email='$email'");
 $fetch = mysqli_fetch_assoc($sql_query);
 $db_name = ucfirst($fetch['Name']);
 $db_account_type = $fetch['account_type'];
 $db_pass = $fetch['Password'];
 $ID = $fetch['ID'];
 $db_email = $email;
 $sql = mysqli_query($conn, "SELECT Stud_No from graduates_infotbl WHERE UID='$ID'");
 $fetchSN = mysqli_fetch_assoc($sql);
 $SN = $fetchSN['Stud_No'];
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
    margin-top: 0;
}
.navpanel {
    overflow-y:hidden;
}
.cancel-btn{
    border-radius:3px;
    font-family: "roboto", sans-serif;
    outline: 0;
    height: 25px;
    width: 80px;
    background: aliceblue;
    color: #2e68aa;
    font-size: 14px;
    cursor: pointer;
    border: 1px solid #2e68aa;
    margin-top: 3.5px;
    margin-left: 5px;
    font-weight:600;
}
.btn-container{
    background:lightgrey;
    margin-top:30px;
    height:30px;
    width:100%;
}
.div-tab{
    margin-top:9px;
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
.labels{
    text-align:right;
    width:100px;
    height:40px;
    font-size:16px;
    font-weight:600;
}
.table-details{
    margin-left:110px;
    border-collapse: collapse;
}
.details{
    margin-left:10px;
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
         <input type="checkbox" id="E">
         <label for="E"><img class="emaildropdown" src="../img/emaildropdown5.png"></label>
                            <ul>
                                <li><a href="change_userpass"><i class="fa fa-lock"></i>&nbsp Change password</a></li>
                                <li><a href="alumni_personal_info"><i class="fa fa-user-cog"></i> Personal Info</a></li>
                                
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
            if (!empty($_GET['JID'])) {
               $JID = $_GET['JID'];
               $query = mysqli_query($conn, "SELECT * FROM job_offeringtbl WHERE JID = $JID");
               $result = mysqli_fetch_assoc($query);
               $title = $result['title'];
               $company = $result['company'];
               $desc = $result['description'];
               $location = $result['location'];
               $qualify = $result['qualification'];
               $daten = $result['date_needed'];
               $datep = $result['date_posted'];
               $posted = $result['posted_by'];
            }
            if (isset($_POST['cancel_btn'])) {
                echo "<script>window.location.href='alumni_job_offerings';</script>";
            }
            ?>
            </div>
           <div class="datapanel">
           <span class="title-tab">Job Details</span><br>
           <div class="div-tab">
                <div class="cpasspanel">
                    <form action="" method="POST" autocomplete="off">
                    <br>
                <table  class="table-details">

                <tr>
                <td class="labels"><span style="color:rgba(16, 94, 238, 0.650); font-weight:600;">Job Title:</span></td>
                <td class="details"><span style="margin-left:20px;"><?php echo $title; ?></span></td>
                </tr>

                <tr>
                <td class="labels"><span style="color:rgba(16, 94, 238, 0.650); font-weight:600;">Company:</span></td>
                <td class="details"><span style="margin-left:20px;"><?php echo $company; ?></span></td>
                </tr>

                <tr>
                <td class="labels"><span style="color:rgba(16, 94, 238, 0.650);font-weight:600;">Location:</span></td>
                <td class="details"><span style="margin-left:20px;"><?php echo $location; ?></span></td>
                </tr>

                <tr>
                <td class="labels"><span style="color:rgba(16, 94, 238, 0.650);font-weight:600;">Description:</span></td>
                <td class="details"><span style="margin-left:20px;"><?php echo $desc; ?></span></td>
                </tr>

                <tr>
                <td class="labels"><span style="color:rgba(16, 94, 238, 0.650);font-weight:600;">Qualification:</span></td>
                <td class="details"><span style="margin-left:20px;"><?php echo $qualify; ?></span></td>
                </tr>

                <tr>
                <td class="labels"><span style="color:rgba(16, 94, 238, 0.650);font-weight:600;">Date Needed:</span></td>
                <td class="details"><span style="margin-left:20px;"><?php echo $daten; ?></span></td>
                </tr>

                <tr>
                <td class="labels"><span style="color:rgba(16, 94, 238, 0.650);font-weight:600;">Date Posted:</span></td>
                <td class="details"><span style="margin-left:20px;"><?php echo $datep; ?></span></td>
                </tr>

                <tr>
                <td class="labels"><span style="color:rgba(16, 94, 238, 0.650);font-weight:600;">Posted by:</span></td>
                <td class="details"><span style="margin-left:20px;"><?php echo $posted; ?></span></td>
                </tr>

                </table>
                    
                    
                </div>

                <div class="btn-container">
                                <span style="margin-left:670px;">
                    
                    <input type="submit" name="cancel_btn" class="cancel-btn" Value="Back">

                    </form>
                    </div>
                </div>
                
            </div>
                
         </div>
  
  

</body>
</html>
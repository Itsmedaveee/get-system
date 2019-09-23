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

if (isset($_POST['cancel_btn'])) {
    echo "<script>window.location.href='../Admin/List_graduates';</script>";
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
.div-tab{
    margin-left:-15px;
    margin-top:5px;
    border-radius:0 0  5px 5px;
    background:rgba(0,0,0,0.03);
    width:800px;
    height:430px;
    border:1px solid rgba(0,0,0,0.120);
}
.title-tab{
    border-radius:5px 5px 0 0;
    color:rgba(16, 94, 238, 0.500);
    border:1px solid rgba(0,0,0,0.120);
    background:#e0edf5ea;
    padding:10px;
    margin-left:-15px;
    font-weight: 400;
    border-bottom:1px solid #e0edf5ea;
}
.title{
    height:20;
    margin:0;
    padding:0;
    color:rgba(16, 94, 238, 0.700);
    font-weight: 400;
    font-size:18px;
    margin-top:-9px;
    margin-left:16px;
    letter-spacing:2px;
}

#table_info{
    margin-left:10px;
}
#table_info .head{
    font-size:15px;
    line-height:1.2;
    border-radius:2px;
    font-weight:600;
    color:rgba(0,0,0,0.750);
    width:470px;
    max-width:470px;
    background:rgba(0,0,0,0.220);
}
#table_info .body{
    height:19px;
    text-overflow: ellipsis;
    overflow: hidden;
    font-size:13px;
    font-weight:600;
    border-radius:3px;
    color:rgba(0,0,0,0.650);
    max-width:470px;
    margin:0;
    padding:0;
    max-height:35px;
}
.atitle{
    font-size:19px;
    color:rgba(16, 94, 238, 0.700);
    font-weight: 500;
    letter-spacing:2px;
    line-height:3;
}
#table_accnt .abody{
    margin-right:8px;
    float:right;
    color:rgba(0,0,0,0.850);
    font-weight:500;
    font-size:15px;
    height:20px;
    letter-spacing:1px;
}
#table_accnt .dbody{
    font-weight:500;
    color:rgba(0,0,0,0.650);
    margin-left:8px;
    float:left;
    height:20px;
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
    margin-left: 570px;
    font-weight:600;
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
            <?php
            if (!empty($_GET['ID'])) {
                $GID = $_GET['ID'];
                $sql = "SELECT * FROM graduates_infotbl WHERE GID = $GID";
                        $result = $conn-> query($sql);

                        if ($result-> num_rows > 0){
                            
                            $showcount = 0;
                            while ($row = $result-> fetch_assoc()){
                                $ID = $row['UID'];
                                $GID = $row['GID'];
                                $stud_no = $row['Stud_No'];
                                $address = $row['address'];
                                $gender = $row['gender'];
                                $civil = $row['civil_status'];
                                $bday = $row['birthdate'];
                                $course = $row['course'];
                                $yg = $row['year_graduated'];
                                $date_add = $row['date_added'];
                                $last_update = $row['last_update'];
                                $query = mysqli_query($conn, "SELECT * FROM userstb WHERE ID = $ID");
                                $resrow = mysqli_fetch_assoc($query);
                                $fullname = $resrow['Name'];
                                $emailadd = $resrow['Email'];
                                $contact = $resrow['Contact'];
                                if (empty($row['address'])) {
                                    $address = "N/A";
                                }
                                if (empty($row['birthdate'])) {
                                    $bday = "N/A";
                                }

            }
        }
    }
            ?>
            <form action="" method="POST"> 
            <span class="title-tab">Graduates Profile</span><input type="submit" name="cancel_btn" class="cancel-btn" Value="Back"><br>
            <div class="div-tab">
            <label class="title">Personal Information</label><br>
            <table>
            <tr>
            <td>
            <table id="table_info">
            <tr><td class="head">Full Name</td></tr>
            <tr><td><div class="body"><?php echo $fullname; ?></div></td></tr>
            <tr><td class="head">Email Address</td></tr>
            <tr><td class="body"><?php echo $emailadd; ?></td></tr>
            <tr><td class="head">Contact Number</td></tr>
            <tr><td class="body"><?php echo $contact; ?></td></tr>
            <tr><td class="head">Address</td></tr>
            <tr><td width="300px"><div class="body"><?php echo $address; ?></div></td></tr>
            <tr><td class="head">Gender</td></tr>
            <tr><td class="body"><?php echo $gender; ?></td></tr>
            <tr><td class="head">Civil Status</td></tr>
            <tr><td class="body"><?php echo $civil; ?></td></tr>
            <tr><td class="head">Birthdate</td></tr>
            <tr><td class="body"><?php echo $bday; ?></td></tr>
            <tr><td class="head">Course</td></tr>
            <tr><td class="body"><?php echo $course; ?></td></tr>
            <tr><td class="head">Year Graduated</td></tr>
            <tr><td class="body"><?php echo $yg; ?></td></tr>
            </table>
            </td>


            <td rowpsan="18" style="width:320px">
            <table id="table_accnt" style="width:100%; height:100%">
            <tr><td colspan="2" style=" text-align:center; height:200px; "><img style="width:220px; height:180px; border:3px solid #fff; box-shadow:0 3px rgba(0,0,0,0.200);" src="../img/profile.jpeg" alt=""></td></tr>
            <tr><td colspan="2" style="text-align:center;"><span class="atitle">Account Information</span></td></tr>
            <tr><td><span class="abody">Student No</span></td><td><span class="dbody"><?php echo $stud_no; ?></span></td></tr>
            <tr><td><span class="abody">Date Added</span></td><td><span class="dbody"><?php echo $date_add; ?></span></td></tr>
            <tr><td><span class="abody">Last Update</span></td><td><span class="dbody"><?php echo $last_update; ?></span></td></tr>
            </table>
            </td>
            </tr>
            </table>
            </div>



            </form>
        </div>
                
         </div>
  

</body>
</html>
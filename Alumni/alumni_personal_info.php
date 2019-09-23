<?php
session_start();
if (isset($_SESSION["email"])) {
    $email = $_SESSION["email"];
}else{
    echo "<script>window.location.href='../Login';</script>";
    
}

include_once '../includes/connection.php';

$sql_query = mysqli_query($conn, "SELECT ID, Name, account_type, Contact, Password from userstb WHERE Email='$email'");
$fetch = mysqli_fetch_assoc($sql_query);
$db_name = ucfirst($fetch['Name']);
$db_contact = $fetch['Contact'];
$db_account_type = $fetch['account_type'];
$db_pass = $fetch['Password'];
$UID = $fetch['ID'];
$db_email = $email;
$sql = mysqli_query($conn, "SELECT * from graduates_infotbl WHERE UID='$UID'");
$fetchSN = mysqli_fetch_assoc($sql);
$GID = $fetchSN['GID'];
$SN = $fetchSN['Stud_No'];
$db_address = $fetchSN['address'];
$db_cs = $fetchSN['civil_status'];

if ($db_account_type == 3) {
    $account_type = "Alumni / ".$SN;
    
}else{
    echo "<script>window.location.href='../Login';</script>";
    
}

$date = date('m/d/y');
$inputcontact = $inputemail = $inputaddress = $inputcivil = "";
$errors= "";
if (isset($_POST['submit_btn'])) {
   
 //validation  
    if (empty($_POST["contact"])) {
        $errors = "Pleas fill all form fields";
        echo "<script>window.location.href='../alumni_update_info?notify=$errors';</script>";
    } else {
        $inputcontact = $_POST["contact"];
    }
     
    if (empty($_POST["email"])) {
        $errors = "Pleas fill all form fields";
        echo "<script>window.location.href='../Alumni/alumni_update_info?errors=$errors';</script>";
    } else {
        $inputemail = $_POST["email"];
    }

   
    if (empty($_POST["address"])) {
        $errors = "Pleas fill all form fields";
        echo "<script>window.location.href='../Alumni/alumni_update_info?errors=$errors';</script>";
    } else {
        $inputaddress = $_POST["address"];
    }

    if (empty($_POST["cs"])) {
        $errors = "Pleas fill all form fields";
        echo "<script>window.location.href='../Alumni/alumni_update_info?errors=$errors';</script>";
    } else {
        $inputcivil = $_POST["cs"];
    }
//********************************************************** */
if ($inputcontact != "" && $inputemail != "" && $inputaddress !="" && $inputcivil !="") {

    if (strlen($inputcontact) < 10) {
        $errors = "Please put valid contact number";
        echo "<script>window.location.href='../Alumni/alumni_update_info?errors=$errors';</script>";
    }else{
                    mysqli_query($conn, "UPDATE graduates_infotbl SET 
                    address = '$inputaddress', civil_status = '$inputcivil', last_update = '$date' WHERE UID = '$UID'
                    ");
                    mysqli_query($conn, "UPDATE userstb SET 
                    Contact = '$inputcontact', Email = '$inputemail' WHERE Email = '$db_email'
                    ");
                 $encrypted = md5(rand(1,9));
                 $_SESSION["email"] = $inputemail;
                    echo "<script>window.location.href='../Alumni/alumni_page?$encrypted&&notify=Updated Successfully!';</script>";
                   
                 
        
   }    
 }
}
if (isset($_POST['cancel_btn'])) {
    $encrypted = md5(rand(1,9));
    
        echo "<script>window.location.href='alumni_update_info?$encrypted';</script>";
    
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
.cpasspanel{
    width: 100%;
    height: 350px;
    margin-left:60px;
    margin-top:20px;
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
                        <li><a style="padding-top:20px; padding-bottom:20px;" href="user_survey"><i class="fa fa-briefcase"></i> Job Offerings</a></li>
                    </ul>
                </div>
               
               
                
            </div>
         </div>

         <div class="dropdownnav">
         <input type="checkbox" id="D">
         <label for="D"><img class="emaildropdown" src="../img/emaildropdown5.png"></label>
                            <ul>
                                <li><a href="alumni_changepass"><i class="fa fa-lock"></i>&nbsp Change password</a></li>
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
            if (empty($_GET['errors'])) {
                        
                echo "";
            } else {
                echo "<br><h5 class='hnoti'><font color='red'><i class='fa fa-exclamation-circle'></i> ". $_GET['errors'] ."</font></h5>";
                unset($_GET['errors']);
            }
            
            ?>
            </div>
           <div class="datapanel">
           <?php
            
              
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
    
            ?>
            <form action="" method="POST"> 
            <span class="title-tab">Graduates Profile</span><input type="submit" name="cancel_btn" class="cancel-btn" Value="Update"><br>
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


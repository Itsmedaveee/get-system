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
                    echo "<script>window.location.href='../Alumni/alumni_personal_info?$encrypted&&notify=Updated Successfully!';</script>";
                   
                 
        
   }    
 }
}
if (isset($_POST['cancel_btn'])) {
    $encrypted = md5(rand(1,9));
    
        echo "<script>window.location.href='alumni_personal_info?$encrypted';</script>";
    
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
.cinput, .infos{
    font-family: "roboto", sans-serif;
    outline: 1;
    background: aliceblue; 
    border:1px solid rgba(0,0,0,0.450);
    width: 300px;
    max-width: 300px;
    min-width: 300px;
    border-radius: 5px 5px 5px 5px;
    margin: 0 0 15px;
    padding: 3.5px;
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
.error{
    color:red;
}
.tag{
   color: #6f797e;
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
.tag{
   color: rgba(0,0,0,0.8);
   font-weight:600;
   font-size:14px;
}
.tag1{
   color: rgba(0,0,0,0.8);
   font-size:13;
   padding:0;
   margin:0;
   line-height:2;
}
form{
    border-radius:5px;
    margin-left:80px;
    text-align:center;
    width:450px;
    border:1px solid rgba(16, 94, 238, 0.300);
}
.title{
    height:20;
    margin:0;
    padding:0;
    color:rgba(16, 94, 238, 0.700);
    font-weight: 400;
    font-size:18px;
    margin-top:-9px;
    letter-spacing:2px;
}
label a:hover{
    opacity:0.7;
    
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
                
           <span class="title-tab">Update Personal Info</span><br>
           <div class="div-tab">
                <div class="cpasspanel">

                <form action="" method="POST" autocomplete="off">
                   
                <label class="title">Personal Information</label><br>
                    
                   
                    <br>
                    <span class="tag">Contact Number</span><br>
                    <input type="text" maxlength="11" name="contact" class="infos" placeholder="Enter Contact" value="<?php echo $db_contact; ?>" onkeypress='return isNumberKey(event)' >
                    
                    <br>
                    
                 
                    <span class="tag">Email Address</span><br>
                    <input type="email" name="email" class="infos" placeholder="Enter Email" value="<?php echo $db_email; ?>" >
                   
                    <br>
                    <span class="tag">Address</span><br>
                    <textarea style="max-height:50px; min-height:50px;" name="address" class="infos" placeholder="Enter address" ><?php echo $db_address; ?></textarea>
                    
                    <br>
                    <span class="tag">Civil Status</span><br>
                    <label class="tag1"><input type="radio" name="cs"  value="Single" > Single</label>
                    <label class="tag1" style="margin-bottom:5px; margin-left:4px;"><input type="radio" name="cs"  value="married" > married</label>
                    
                  
                </div>
                            <div class="btn-container">
                                <span style="margin-left:590px;">
                                <input type="submit" name="submit_btn" class="submit-btn" value="Save">
                                <input type="submit" name="cancel_btn" class="cancel-btn" Value="Cancel">
                                </span>
                                </form>
                            </div>
                </div>

            </div>
                
         </div>
  

</body>
</html>


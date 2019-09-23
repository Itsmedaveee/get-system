<?php
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
$UID = $fetch['ID'];
$db_email = $email;
$sql = mysqli_query($conn, "SELECT Stud_No from graduates_infotbl WHERE UID='$UID'");
$fetchSN = mysqli_fetch_assoc($sql);
$SN = $fetchSN['Stud_No'];
if ($db_account_type == 3) {
    $account_type = "Alumni / ".$SN;
    
}else{
    echo "<script>window.location.href='../Login';</script>";
    
}


$Allerror = "";
$company = $company_add = $type = $emp_name = $emp_email = "";
if (isset($_POST['submit_btn'])) {
    

    if (empty($_POST["company"])) {
        $Allerror = "Company Name Required!";
        
    } else {
        $company = $_POST["current"];
    }
    
    if (empty($_POST["com_address"])) {
        $Allerror = "Company Address Required!";
        
    } else {
        $company_add = $_POST["com_address"];
    }

    
    if (empty($_POST["emp_name"])) {
        $Allerror = "Employer Name Required!";
     
    } else {
        $emp_name = $_POST["emp_name"];
    }
    if (empty($_POST["emp_email"])) {
        $Allerror = "Employer Email Required";
     
    } else {
        $emp_email = $_POST["emp_email"];
    }
    if (empty($_POST["emp_email"])) {
        $Allerror = "Employer Email Required";
     
    } else {
        $emp_email = $_POST["emp_email"];
    }
    if (empty($_POST["type_com"])) {
        if (empty($_POST["othertext"])) {
            $Allerror = "Please Select Type of Company";
        }else{
            $type = $_POST["type_com"];
        }

    } else {
        $type = $_POST["type_com"];
    }
//********************************************************** */
if ($company != "" && $company_add != "" && $type !="" && $emp_name !="" && $emp_email !="") {

    if ($db_pass != $currentpw) {
        $currentpwerr = "You enter wrong password";
    }else{
        if ($newpw !== $confirmpw) {
            $confirmpwerr = "Password not Match";
        }else{    
            if (strlen($newpw) && strlen($confirmpw)  < 8) {
                $newpwerr = "Minimun of 8 characters";
                $confirmpwerr = "Minimun of 8 characters";
            }else{
                    
                if ($db_pass == $currentpw && $newpw == $confirmpw) {

                    mysqli_query($conn, "UPDATE userstb SET 
                    Password = '$newpw' WHERE Email = '$db_email'
                    ");
                 $encrypted = md5(rand(1,9));
                 if ($db_account_type == 3) {
                    echo "<script>window.location.href='alumni_page?$encrypted&&notify=Password Changed Successfully!';</script>";
                   
                 }else{
                    echo "<script>window.location.href='./Login?$encrypted';</script>";
                 }
        
        }
       }
     }
   }    
 }




}
if (isset($_POST['cancel_btn'])) {
    $encrypted = md5(rand(1,9));
    
        echo "<script>window.location.href='alumni_page?$encrypted';</script>";
    
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
    margin-left:120px;
    margin-top:20px;
}
.cinput, .ninput, .rinput{
    font-family: "roboto", sans-serif;
    outline: 1;
    background: aliceblue; 
    border:1px solid rgba(0,0,0,0.250);
    width: 525px;
    border-radius: 5px 5px 5px 5px;
    margin: 0 0 15px;
    padding: 7px;
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
label a:hover{
    opacity:0.7;
    
}
.tag1{
    width:150px;
    color: rgba(0,0,0,0.8);
    font-size:13;
    padding:0;
    margin:0;
    line-height:2;
}
.req{
    color:red;
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
            ?>
            </div>
           <div class="datapanel">
                
           <span class="title-tab">Employer Details</span><br>
           <div class="div-tab">
                <div class="cpasspanel">
                    <form action="" method="POST">
                    <span class="tag">Company Name <span class="req"> *</span></span><br>
                    <input type="password" name="company" class="cinput" placeholder="Enter Current Password" value="<?php echo $company; ?>">
                   
                    <br>
                    <span class="tag">Company Address <span class="req"> *</span></span><br>
                    <textarea name="com_address" class="cinput" id="" placeholder="Enter New Password"><?php echo $company_add; ?></textarea> 
                    
                    <br>
                    

                    <span style="float:right; margin-right:250px;">
                    <span class="tag">Employer Name <span class="req"> *</span></span><br>
                    <input style="width:350px;" type="password" name="emp_name" class="ninput" placeholder="Enter New Password" value="<?php echo $emp_name; ?>">
                    
                    <br>
                    <span class="tag">Employer Email <span class="req"> *</span></span><br>
                    <input style="width:350px;" type="password" name="emp_email" class="ninput" placeholder="Enter New Password" value="<?php echo $emp_email; ?>">
                   
                    </span>

                    <span class="tag">Type of Company <span class="req"> *</span></span><br>
                    
                    <label class="tag1"><input type="radio" name="type_com"  value="BPO" > BPO</label>
                    <label class="tag1"><input type="radio" name="type_com"  value="Trade/Retailing" > Trade/Retailing</label>
                    <label class="tag1"><input type="radio" name="type_com"  value="Academe" > Academe</label>
                    <label class="tag1"><input type="radio" name="type_com"  value="Government" > Government</label>
                    <label class="tag1"><input type="radio" name="type_com"  value="Telecommunication" > Telecommunication</label>
                    <label class="tag1"><input type="radio" name="type_com"  value="Bank" > Bank</label>
                    <label class="tag1"><input type="radio" name="type_com"  value="BPO" > BPO</label>
                    <label class="tag1" style="width:300px;"><input type="radio" name="type_com"  value="other" > Other, specify:
                    <input type="text" class="OtherAnswer-text" name="typetext"></label>
                   
                    
                    
                </div>
                <div class="btn-container">
                                <span style="margin-left:590px;">
                    <input type="submit" name="submit_btn" class="submit-btn" value="Submit">
                    <input type="submit" name="cancel_btn" class="cancel-btn" Value="Cancel">
                    </span>
                    </form>
                    </div>

                </div>


            </div>
                
         </div>
  

</body>
</html>


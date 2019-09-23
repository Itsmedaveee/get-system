<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_SESSION["email"])) {
    $email = $_SESSION["email"];
}else{
    echo "<script>window.location.href='../Login';</script>";
 
}
include_once '../includes/connection.php';
include_once '../includes/secondaryConnection.php';
$sql_query = mysqli_query($conn, "SELECT Name, account_type,Password from userstb WHERE Email='$email'");
$fetch = mysqli_fetch_assoc($sql_query);
$db_name = ucfirst($fetch['Name']);
$db_account_type = $fetch['account_type'];
$db_pass = $fetch['Password'];
$db_email = $email;

if ($db_account_type == 1) {
    $account_type = "Administrator";
}else{
    echo "<script>window.location.href='../Login';</script>";
   
}  
$Allerror = "";
$Studno = $Lname = $Fname = $Mname = $contact = $gender = $inputemail = $address = $cs = $bd = $newcontact = $course = $yg = $fullname = "";
if (isset($_POST['submit_btn'])) {
   
    //*********************Validation************************************* */
    date_default_timezone_set('Asia/Manila');
    $date = date('m/d/y');
    $address = $_POST['address'];
    $bd = $_POST['bdate'];

    if (empty($_POST["stud_no"])) {
        $Allerror = "Please fill all REQUIRED field(s)";
        
    } else {
        $Studno = $_POST["stud_no"];
        if (empty($_POST["lname"])) {
            $Allerror = "Please fill all REQUIRED field(s)";
            
        } else {
            $Lname = ucfirst($_POST["lname"]);
            if (empty($_POST["fname"])) {
                $Allerror = "Please fill all REQUIRED field(s)";
                
            } else {
                $Fname = ucfirst($_POST["fname"]);
                if (empty($_POST["mname"])) {
                    $Allerror = "Please fill all REQUIRED field(s)";
                    
                } else {
                    $Mname = ucfirst($_POST["mname"]);
                    if (empty($_POST["contact"])) {
                        $Allerror = "Please fill all REQUIRED field(s)";
                        
                    } else {
                        $contact = $_POST["contact"];
                        if (empty($_POST["gender"])) {
                            $Allerror = "Please fill all REQUIRED field(s)";
                            
                        } else {
                            $gender = $_POST["gender"];
                            if (empty($_POST["email"])) {
                                $Allerror = "Please fill all REQUIRED field(s)";
                                
                            } else {
                                $inputemail = $_POST["email"];
                                if (empty($_POST["cs"])) {
                                    $Allerror = "Please fill all REQUIRED field(s)";
                                    
                                } else {
                                    $cs = $_POST["cs"];
                                    if (empty($_POST["course"])) {
                                        $Allerror = "Please fill all REQUIRED field(s)";
                                        
                                    } else {
                                        $course = $_POST["course"];
                                        if (empty($_POST["yr_grad"])) {
                                            $Allerror = "Please fill all REQUIRED field(s)";
                                            
                                        } else {
                                            $yg = $_POST["yr_grad"];
                                            $fullname = ucfirst($Fname)." ".ucfirst($Mname)." ".ucfirst($Lname);
                                         //**********Generating Random Password */
                                            function random_password( $length = 5){
                                                $str = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ01234567890";
                                                    $shuffled = substr(str_shuffle($str), 0, $length);
                                                    return $shuffled;
                                                }     
                                                $password = random_password(8);       
                                           
                                            //send default password via email
                                        
                                        require '../PHPMailer/vendor/autoload.php';

                                        $mail = new PHPMailer(true);                              
                                        try {
                                        
                                            $mail->isSMTP();                                    
                                            $mail->Host = 'smtp.gmail.com';  
                                            $mail->SMTPAuth = true;                               
                                            $mail->Username = 'joshcanlas2017@gmail.com';     // email ng sender 
                                            $mail->Password = 'incorrect101';      // email password ng sender                      
                                            $mail->SMTPSecure = 'tls';                           
                                            $mail->Port = 587;         
                                            
                                            $mail->setFrom('joshcanlas2017@gmail.com', 'GETSystem(Administrator)'); // mula kanino (sender email, from name) 
                                        
                                            $mail->addAddress($inputemail); // dito ilalagay yung email ng pag sesendan               
                                        
                                            $mail->isHTML(true);                                 
                                            
                                            $mail->Header = 'MIME-Version: 1.0\r\nt Content-Type: text/plain; charset=utf-8\r\n
                                            X-Priority: 1\r\n'; // importante to
                                            
                                            
                                            $message = "Your Default Password is: <font color='red'><b>$password</b></font><br>You can change your Password when you login.
                                            <br>Login Here.. <a href='#'>SampleLink.com</a>";
                                                
                                                $mail->Subject = 'Default Password';
                                                $mail->Body   = $message;
                                            
                                                $mail->send();
                                                mysqli_query($conn2, "INSERT INTO userstb(Name,Email,Contact,Password,attempt,account_type) VALUES('$fullname','$inputemail','$contact','$password','0',3)");
                                            $UID = $conn2-> insert_id;
                                            mysqli_query($conn, "INSERT INTO graduates_infotbl(UID,Stud_No,lastname,firstname,middlename,gender,address,civil_status,birthdate,course,year_graduated,date_added,last_update) 
                                            VALUES($UID,$Studno,'$Lname','$Fname','$Mname','$gender','$address','$cs','$bd','$course','$yg','$date','$date')");
                                            $success = "Successfully Added";
                                            $Studno = $Lname = $Fname = $Mname = $contact = $gender = $inputemail = $address = $cs = $bd = $newcontact = $course = $yg = $fullname = "";

                                            } catch (Exception $e) {
                                                echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                                            }
                                            //end sending 
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
      
 }

if (isset($_POST['cancel_btn'])) {
    $encrypted = md5(rand(1,9));
   
        echo "<script>window.location.href='List_graduates?$encrypted';</script>";
    
}






?>

<Script type="application/javascript">
function isNumberKey(evt){

    var charCode = (evt.which) ? evt.which : event.keycode

    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    
        return true;
    }
    
}

</Script>
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
.cpasspanel{
    width: 700px;
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
.submit-btn:hover, .cancel-btn:hover{
    opacity:0.7;
}
.error{
    font-size:14px;
    padding:0;
    color:red;
}
.tag{
   color: rgba(0,0,0,0.8);
   font-weight:600;
   font-size:13px;
}
.tag1{
   color: rgba(0,0,0,0.8);
   font-size:13;
   padding:0;
   margin:0;
   line-height:2;
}
.datapanel{
    border-radius: 5px 5px 5px 5px;
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
    color:rgba(16, 94, 238, 0.600);
    border:1px solid rgba(0,0,0,0.120);
    background:#e0edf5ea;
    padding:10px;
    margin:none;
    font-weight: 400;
    border-bottom:1px solid #e0edf5ea;
    letter-spacing:.5px;
}
.req{
   
    color:red;
    font-size:13px;
}
.success{
    color:green;
    font-size:14px;
    margin:0;
    padding:0;
}
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../fonts/font-awesome.min.css">
    <link rel="stylesheet" href="../fonts/fontawesome/css/all.min.css">
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
                            <li><a style="padding-top:20px; padding-bottom:20px;" href="account_request"><i class="fa fa-user-plus"></i> Account Requests</a></li>
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
         <input type="checkbox" id="D">
         <label for="D"><img class="emaildropdown" src="../img/emaildropdown5.png"></label>
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
        
        if (!empty($success)) {

?>
           <label class='success'><i class='fa fa-check-circle'></i> <?php echo $success; ?></label> 
           <?php
           $success = "";
        }else{
            if (!empty($Allerror)) {
                ?>
                <label class='error'><i class='fa fa-exclamation-circle'></i> <?php echo $Allerror; ?></label>
                <?php
                $Allerror = "";
             }
        }
        
        ?>

        </div>

           <div class="datapanel">

           
           <span class="title-tab">Add Graduates</span>
           <span style="margin-left:30px; font-weight:500; font-size:15px; letter-spacing:1.5px;"><i class="fa fa-warning"></i> <i>Note: Form fields with ( <span class="req">*</span> ) means Required.</i></span><br>
           <div class="div-tab">
                <div class="cpasspanel">
                    <form action="" method="POST" autocomplete="off">
                    <table class="table-form">
                    <tr><td>
                    <span class="tag">Student No. <span class="req">*</span></span><br>
                    <span><input type="text" name="stud_no" class="cinput" placeholder="Enter Student No" value="<?php echo $Studno; ?>" onkeypress='return isNumberKey(event)'></span>
                    
                    <br>
                    <span class="tag">Last Name <span class="req">*</span></span><br>
                    <input type="text" name="lname"  class="infos" placeholder="Enter Lastname" value="<?php echo $Lname; ?>" >
                    
                    <br>
                    <span class="tag">First Name <span class="req">*</span></span><br>
                    <input type="text" name="fname" class="infos" placeholder="Enter Firstname" value="<?php echo $Fname; ?>">
                    
                    <br>
                    <span class="tag">Middle Name <span class="req">*</span></span><br>
                    <input type="text" name="mname" class="infos" placeholder="Enter Middlename" value="<?php echo $Mname; ?>" >
                    
                    <br>
                    <span class="tag">Contact Number <span class="req">*</span></span><br>
                    <input type="text" maxlength="11" name="contact" class="infos" placeholder="Enter Contact" value="<?php echo $contact; ?>" onkeypress='return isNumberKey(event)' >
                    
                    <br>
                    <span class="tag">Gender <span class="req">*</span></span><br>
                    <label class="tag1"><input type="radio" name="gender"  value="Male" > Male</label>
                    <label class="tag1"><input type="radio" name="gender"  value="Female" > Female</label>
                    
                    <br> <br>
                    </td>
                    <td>
                    <span class="tag">Email <span class="req">*</span></span><br>
                    <input type="email" name="email" class="infos" placeholder="Enter Email" value="<?php echo $inputemail; ?>" >
                   
                    <br>
                    <span class="tag">Address</span><br>
                    <textarea style="max-height:50px; min-height:50px;" name="address" class="infos" placeholder="Enter address" ><?php echo $address; ?></textarea>
                    
                    <br>
                    <span class="tag">Civil Status <span class="req">*</span></span><br>
                    <label class="tag1"><input type="radio" name="cs"  value="Single" > Single</label>
                    <label class="tag1" style="margin-bottom:5px;"><input type="radio" name="cs"  value="married" > married</label>
                    

                    <span class="tag">Birthdate</span><br>
                    <input type="date" name="bdate" class="infos" value="<?php echo $bd; ?>" >
                    
                    <br>
                    <span class="tag">Course <span class="req">*</span></span><br>
                    <select name="course" id="course" class="infos">
                    <option value="">-Select Course-</option>
                    <option value="BS-IT">BS-IT</option>
                    <option value="BS-CS">BS-CS</option>
                    <option value="BS_CpE">BS-CpE</option>
                    <option value="BS-IS">BS-IS</option>
                    </select>
                    
                    
                    <br>
                    <span class="tag">Year Graduated <span class="req">*</span></span><br>
                    <select name="yr_grad" id="yr_grad" class="infos">
                    <option value="">-Select Batch-</option>
                    <?php 
                    $batch = 2000;
                    while ($batch <= 2100) {
                    ?>
                    <option value="<?php echo $batch; ?>"><?php echo $batch; ?></option>
                    <?php 
                    $batch++;
                    }
                    ?>
                    </select>
                    <br>
                    
                    </td>
                    </tr>
                    </table>
                  
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
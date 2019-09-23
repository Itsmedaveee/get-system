<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include_once './includes/connection.php';
include_once './includes/secondaryConnection.php';
session_start();
//***************Restriction */
if (isset($_SESSION["email"])) {
    $email = $_SESSION["email"];
    $query_account_type = mysqli_query($conn, "SELECT * FROM userstb WHERE Email='$email'");
    $get_account_type = mysqli_fetch_assoc($query_account_type);
    $account_type = $get_account_type["account_type"];

    if ($account_type == 1) {
        echo "<script>window.location.href='Admin/admin_page';</script>";
    } else {
        echo "<script>window.location.href='User/user_page';</script>";
    }
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
        $Allerror = "Please fill all required(<span class='req'> *</span> ) field(s)";
        
    } else {
        $Studno = $_POST["stud_no"];
        if (empty($_POST["lname"])) {
            $Allerror = "Please fill all required(<span class='req'> *</span> ) field(s)";
            
        } else {
            $Lname = ucfirst($_POST["lname"]);
            if (empty($_POST["fname"])) {
                $Allerror = "Please fill all required(<span class='req'> *</span> ) field(s)";
                
            } else {
                $Fname = ucfirst($_POST["fname"]);
                if (empty($_POST["mname"])) {
                    $Allerror = "Please fill all required(<span class='req'> *</span> ) field(s)";
                    
                } else {
                    $Mname = ucfirst($_POST["mname"]);
                    if (empty($_POST["contact"])) {
                        $Allerror = "Please fill all required(<span class='req'> *</span> ) field(s)";
                        
                    } else {
                        $contact = $_POST["contact"];
                        if (empty($_POST["gender"])) {
                            $Allerror = "Please fill all required(<span class='req'> *</span> ) field(s)";
                            
                        } else {
                            $gender = $_POST["gender"];
                            if (empty($_POST["email"])) {
                                $Allerror = "Please fill all required(<span class='req'> *</span> ) field(s)";
                                
                            } else {

                                $inputemail = $_POST["email"];
                                if (empty($_POST["cs"])) {
                                    $Allerror = "Please fill all required(<span class='req'> *</span> ) field(s)";
                                    
                                } else {
                                    $cs = $_POST["cs"];
                                    if (empty($_POST["course"])) {
                                        $Allerror = "Please fill all required(<span class='req'> *</span> ) field(s)";
                                        
                                    } else {
                                        $course = $_POST["course"];
                                        if (empty($_POST["yr_grad"])) {
                                            $Allerror = "Please fill all required(<span class='req'> *</span> ) field(s)";
                                            
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
                                        
                                        require 'PHPMailer/vendor/autoload.php';

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
                                                echo "<script>window.location.href='Success_register';</script>";
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

?>
<style>
.error{
    position:absolute;
    margin-left:258px;
    margin-top:240px;
    padding:0;
    color:orange;
    font-family:sans-serif;
}
body{
    background-image: linear-gradient(#1167b1,aliceblue);
    height: 97.5vh;
    background-size: cover;
    background-position: center;
    
}
.login-page{
    width: 800px;
    height: 440px;
    padding: 0 0 0;
    margin: auto;
    background: #1167b1;
    box-shadow: 10px 10px 20px rgb(53, 93, 131);
}
.head{
    margin: auto;
    width: 360px;
    height: 150px;
    
}
.header h2{
    padding-top: 20px;
    height: 50px;
    
}
h2{
    color: aliceblue;
}
h3{
    color: aliceblue;
    
}
span{
    color: #1fb8cc;
    font-weight: bold;
   
}
.form button:hover, .form button:active{
    background: #76cf82;
}
.form .message{
    margin:  15px 0 0;
    color: aliceblue;
    font-size: 14px;
}
.form .message a{
    color: #4caf50;
    text-decoration: none;
    
}

.form .logicon{
    width: 90px;
    height: 90px;
    padding-top: 0px;
    padding-bottom: 0px;
          /* top  left bot right*/
    margin: -50px 5em 0px 5em;
    border-radius: 50px 50px 50px 50px;
    box-shadow: 10px 10px 20px rgb(14, 84, 153);
}
.cinput, .infos{
    font-family: "roboto", sans-serif;
    outline: 1;
    background: aliceblue; 
    border:1px solid rgba(0,0,0,0.450);
    height:28px;
    width: 220px;
    max-width: 220px;
    min-width: 220px;
    border-radius: 5px 5px 5px 5px;
    margin: 0 0 15px;
    padding: 2.5px;
    box-sizing: border-box;
    font-size: 15px;
}
.submit-btn{
    border-radius:3px;
    font-family:sans-serif;
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
    font-family:sans-serif;
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

.tag{
   font-family:sans-serif;
   color: aliceblue;
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
    height:50px;
    width:100%;
}
.div-tab{
    border-radius:5px;
    margin-left:22px;
    margin-top:9px;
    background:rgba(0,0,0,0.03);
    width:755px;
    border:1px solid aliceblue;
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
   
    color:orange;
    font-size:13px;
}
.success{
    color:green;
    font-size:14px;
    margin:0;
    padding:0;
}
.table-form{
    margin-left:38px;
}
button{
    font-family:sans-serif;
    text-transform: uppercase;
    outline: 0;
    width: 40%;
    padding: 15px;
    background:#4caf15;
    color: #ffffff;
    font-size: 14px;
    cursor: pointer;
    border: none;
    margin-bottom: 10px;
}
</style>

<Script type="application/javascript">
function isNumberKey(evt){

    var charCode = (evt.which) ? evt.which : event.keycode

    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    
        return true;
    }
    
}
</Script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   
    <link rel="stylesheet" href="./fonts/font-awesome.min.css">
    <title>GETSystem | Register</title>
</head>
<body>
    <div class="head">
        <div class="header">
            <center> <h2> <span>GETS</span>ystem</h2></center>
        </div>
    </div>

    <div class="login-page">

        

     <div class="form">
       <center><img src="./img/photo10.png" class="logicon"></center> 
       
       <center><h3>Alumni Form</h3></center>
       <div class="div-tab">
                <div class="cpasspanel">
                    <form action="" method="POST" autocomplete="off">
                    <?php
        
        
            if (!empty($Allerror)) {
                ?>
                <label class='error'><i class='fa fa-exclamation-circle'></i> <?php echo $Allerror; ?></label>
                <?php
                $Allerror = "";
             }else{
                echo "<label class='error' style='margin-left:230px'><i class='fa fa-exclamation-triangle'></i> Note: Fields with (<span class='req'> *</span> ) means Required</label>";
             }
        
        
        ?>
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
                    
                   
                    
                   
                    </td>
                    <td>
                    <span class="tag">Contact Number <span class="req">*</span></span><br>
                    <input type="text" maxlength="11" name="contact" class="infos" placeholder="Enter Contact" value="<?php echo $contact; ?>" onkeypress='return isNumberKey(event)' >
                    
                    <br>
                    <span class="tag">Gender <span class="req">*</span></span><br>
                    <label class="tag1"><input type="radio" name="gender"  value="Male" > Male</label>
                    <label class="tag1"><input type="radio" name="gender"  value="Female" > Female</label>
                    <br>
                    <span class="tag">Email <span class="req">*</span></span><br>
                    <input type="email" name="email" class="infos" placeholder="Enter Email" value="<?php echo $inputemail; ?>" >
                   
                    <br>
                    <span class="tag">Address</span><br>
                    <textarea style="max-height:50px; min-height:50px;" name="address" class="infos" placeholder="Enter address" ><?php echo $address; ?></textarea>
                   
                   
                    <br>
                    </td>
                    <td>
                    <span class="tag" >Civil Status <span class="req">*</span></span><br>
                    <label class="tag1"><input type="radio" name="cs"  value="Single" > Single</label>
                    <label class="tag1" style="margin-bottom:5px;"><input type="radio" name="cs"  value="married" > married</label>
                    
                    <br>
                    <span class="tag">Birthdate</span><br>
                    <input type="date" name="bdate" class="infos" value="<?php echo $bd; ?>" >
                    
                    <br>
                    <span class="tag">Course <span class="req">*</span></span><br>
                    <select name="course" id="course" class="infos" style="height:26px;">
                    <option value="">-Select Course-</option>
                    <option value="BS-IT">BS-IT</option>
                    <option value="BS-CS">BS-CS</option>
                    <option value="BS_CpE">BS-CpE</option>
                    <option value="BS-IS">BS-IS</option>
                    </select>
                    
                    
                    <br>
                    <span class="tag">Year Graduated <span class="req">*</span></span><br>
                    <select name="yr_grad" id="yr_grad" class="infos" style="height:26px;">
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
                    <br>
                    </td>
                    </tr>
                   
                    </table>
                  
                </div>
                            <div class="btn-container">
                                
                            <center>
                            
                                <button name="submit_btn">Submit</button><br>
                                <span class="tag" style="font-family:serif; text-decoration:none;">Already Registered? <a style="color:#4caf15; text-decoration:none;" href="login">Sign in</a></span>
                            </center>
                                
                                </form>
                            </div>
                </div>
    </div>
    </div>
    
    
</body>
</html>
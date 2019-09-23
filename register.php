<?php
include_once './includes/connection.php';
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

$fullname = $email = $contact = "";
$fullnameerr = $emailerr = $contacterr = "";

if (isset($_POST["btnregister"])) {
    //validation for email
    if (empty($_POST["email"])) {
        $emailerr = "Email field required!";
        
    } else {
        $email = $_POST["email"];
    }
    //validation for fullname  
    if (empty($_POST["fullname"])) {
        $fullnameerr = "Name field required!";
        
    } else {
        $fullname = $_POST["fullname"];
    }

    //validation for contact  
    if (empty($_POST["contact"])) {
        $contacterr = "Contact field required!";
     
    } else {
        $contact = $_POST["contact"];
    }

    //*******checking registered/for approval email from database */
    $query = mysqli_query($conn, "SELECT * FROM userstb WHERE Email='$email'");
    $result = mysqli_fetch_assoc($query);
    $query1 = mysqli_query($conn, "SELECT * FROM acc_req_db WHERE Email='$email'");
    $result1 = mysqli_num_rows($query1);
    

    if ($result1 > 0) {
            $emailerr = "This email is already for approval";
    }else{
    if ($result != 0) {
        $emailerr = "Email already Registered";
    }else{
    
    //*********Name Validation */
    if ($fullname && $email && $contact) {
        

       if (!preg_match("/^[a-zA-Z ]*$/",$fullname)) {
           $fullnameerr = "letters and space only!";
       } else {
        $count_fullname_string = strlen($fullname);

        if ($count_fullname_string < 2) {
            $fullnameerr = "Name is too short";
        } else {
            //**********Email Validation */
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailerr = "You must provide valid email";
            } else {
            //**********Generating Random Password */
               function random_password( $length = 5){
                   $str = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ01234567890";
                    $shuffled = substr(str_shuffle($str), 0, $length);
                    return $shuffled;
                }     
                $password = random_password(8);

                include './includes/connection.php';
                mysqli_query($conn, "INSERT INTO acc_req_db(Name,Email,Contact,Password,account_type) VALUES('$fullname','$email','$contact','$password','2')");
                
                echo "<script>window.location.href='Reg_success';</script>";

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
    color:orange;
    font-family:sans-serif;
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
    <link rel="stylesheet" href="./css/Login.css">
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
       
       <center><h3>Account Request</h3></center>
       <center> <form class="register-form" action="" method="POST" ></center>

            <span class="error"><?php echo $emailerr ?></span>
            <center><input type="text" name="email" placeholder="Email Address" value="<?php echo $email; ?>"></center> 
            <span class="error"><?php echo $fullnameerr ?></span>           
            <center><input type="text" name="fullname" placeholder="Full Name" value="<?php echo $fullname; ?>"></center>
            <span class="error"><?php echo $contacterr ?></span>
            <center><input type="text" name="contact" placeholder="Contact Number" maxlength="11" value="<?php echo $contact; ?>" onkeypress='return isNumberKey(event)'></center>
            <center><button name="btnregister">Submit</button></center>

            <center><p class="message">Already Registered? <a href="Login">Sign in</a></p></center>
                
        </form></center>
    </div>
    </div>
    
    
</body>
</html>
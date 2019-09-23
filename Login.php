<?php
include_once './includes/connection.php';
include_once './includes/secondaryConnection.php';
session_start();

if (isset($_SESSION["email"])) {
    $email = $_SESSION["email"];
    $query_account_type = mysqli_query($conn, "SELECT * FROM userstb WHERE Email='$email'");
    $get_account_type = mysqli_fetch_assoc($query_account_type);
    $account_type = $get_account_type["account_type"];
    

    if ($account_type == 1) {
        echo "<script>window.location.href='Admin/admin_page';</script>";
    } elseif($account_type == 2) {
        echo "<script>window.location.href='User/user_page';</script>";
    }else{
        echo "<script>window.location.href='Alumni/alumni_page';</script>";
    }
}else{
    echo "<script>window.location.href='../Login;</script>";
        
}


date_default_timezone_set('Asia/Manila');
$log_date = date('F d, Y');
$date_now = date('m/d/y');
$time_now = date('h:i A');
$notify = $attempt = $log_time = "";

$end_time = date('h:i A', strtotime('+5 minutes', strtotime($time_now)));

$email = $password = "";
$emailerr = $passworderr = "";

if (isset($_POST["btnlogin"])) {

    if (empty($_POST["email"])) {
        $emailerr = "valid E-mail Required!";
        
    } else {
        $email = $_POST["email"];
    }
    if (empty($_POST["password"])) {
        $passworderr = "Password Required!";
        
    } else {
        $password = $_POST["password"];
    }

    if ($email AND $password) {
        $check_email = mysqli_query($conn, "SELECT * FROM userstb WHERE Email='$email'");
        $check_row = mysqli_num_rows($check_email);

        if ($check_row > 0) {
            $fetch = mysqli_fetch_assoc($check_email);
            $db_password = $fetch["Password"];
            $db_attempt = $fetch["attempt"];
            $db_log_time = strtotime($fetch["log_time"]);
            $my_log_time = $fetch["log_time"];
            $new_time = strtotime($time_now);

            $account_type = $fetch["account_type"];

            if ($account_type == 1) {
                        
                if ($db_password == $password) {
                    $_SESSION["email"] = $email;
                    echo "<script>window.location.href='Admin/admin_page';</script>";
                }else{
                    $passworderr = "Password is Incorrect!";
                }

            } else {

                if ($db_log_time <= $new_time) {
                    
                    if ($db_password == $password) {

                        $_SESSION["email"] = $email;
                        if ($account_type == 2) {
                        $query_account_type = mysqli_query($conn, "SELECT * FROM userstb WHERE Email='$email'");
                        $get_account_type = mysqli_fetch_assoc($query_account_type);
                        $UID = $get_account_type["ID"];
                        $check_log = mysqli_query($conn, "SELECT * FROM logstbl WHERE UID=$UID AND Date = '$log_date'");
                        $rowscount = mysqli_num_rows($check_log);
                        if ($rowscount == 0) {
                            mysqli_query($conn, "INSERT INTO logstbl(UID,Date) VALUES($UID,'$log_date')");
                            $LID =  $conn-> insert_id;
                        }else{
                            $log = mysqli_query($conn, "SELECT * FROM logstbl WHERE UID=$UID AND Date = '$log_date'");
                            $rowLID = mysqli_fetch_assoc($log);
                            $LID = $rowLID['LID'];
                        }
                        mysqli_query($conn, "INSERT INTO activity_log(LID,Activity,Time) VALUES($LID,'Logged In','$time_now')");
                    }
                        mysqli_query($conn, "UPDATE userstb SET attempt='0', log_time='' WHERE Email='$email'");
                        echo "<script>window.location.href='User/user_page';</script>";
                        
                    }else{
                      
                         $attempt = $db_attempt + 1;
                    
                        if ($attempt >= 3) {
                            $attempt = 3;
                            mysqli_query($conn, "UPDATE userstb SET attempt='$attempt', log_time='$end_time' WHERE Email='$email'");
                            $notify = "You already reach three (3) times attempt to login. Please Login after 5 minutes:<b>$end_time</b>";
                        }else{
                            mysqli_query($conn, "UPDATE userstb SET attempt='$attempt' WHERE Email='$email'");
                            $passworderr = "Password is Incorrect!";
                            $notify = "Login Attempt:<b>$attempt</b>";
                        }
                    }

                } else {

                    $notify = "Im sorry you have to wait until: <b>$my_log_time</b> before login";
                }
            }

        } else {
            $emailerr = "Email is not Registered!";
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/Login.css">
    <link rel="stylesheet" href="fonts/fontawesome/css/all.min.css">
    <title>GETSystem | Login</title>
</head>
<body>
<!-- <img style="filter:blur(2px); height:80.5vh; position:absolute; opacity:0.3; margin-top:110px; rotate-y:180;" src="./img/dhvsubg.png" alt=""> -->
    <div class="head">
        <div class="header">
            <center> <h2> <span>GETS</span>ystem</h2></center>
        </div>
    </div>

    <div class="login-page">

        

     <div class="form">
     
       <center><img src="./img/photo10.png" class="logicon"></center> 
       <center><h3>Login</h3></center>
       <center> <form class="login-form" action="" method="POST"></center>

       <span class="error"><?php echo $emailerr ?></span>
       <center><input type="email" name="email" placeholder="Enter Email" value="<?php echo $email; ?>"></center>
       <span class="error"><?php echo $passworderr ?></span>
       <center><input  type="password" name="password" placeholder="Enter Password" value=""></center>
       <center><button name="btnlogin"><i class="fa fa-sign-in-alt"></i> Sign in</button></center>
       <center><span class="error"><?php echo $notify; ?></span></center>
       <center><a class="message" href="?forgot=<?php echo md5(rand(1,9)); ?>">Forgot Password?</a></center>
       <center><p class="message">Not Registered?Sign up as <a href="register">Encoder</a> / <a href="alumni_form">Alumni</a></p></center>

        </form>

       
    </div>
    </div>
    
    
</body>
</html>
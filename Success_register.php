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

if (isset($_POST['back'])) {
    echo "<script>window.location.href='Login';</script>";
}


?>
<style>
.error{
    color:red;
    
}
button{
    margin-bottom: 10px;
}
p{
    color: #ffffff;
}
h3{
    color: white;
}
</style>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/register.css">
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
       

       <center> <form class="register-form" action="" method="POST" ></center>
        
       <center>
        <h3>Successfully Register!</h3>
        <p>Your Default Password was sent on your email<br>Please check your email that you provided<br>
        You can login using your email or student no.</p>
       <button name="back">BACK</button>
       
       </center>
                
        </form></center>
    </div>
    </div>
    
    
</body>
</html>
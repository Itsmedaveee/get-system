<?php
include_once '../includes/connection.php';
include_once '../includes/secondaryConnection.php';



date_default_timezone_set('Asia/Manila');
$log_date = date('F d, Y');
$date_now = date('m/d/y');
$time_now = date('h:i A');
$notify = $attempt = $log_time = "";

$end_time = date('h:i A', strtotime('+5 minutes', strtotime($time_now)));

$email = $password = "";
$emailerr = $passworderr = "";


?>
<style>
.error{
    color:orange;
    font-family:sans-serif;
}
body{
    background-image: linear-gradient(#1167b1,aliceblue);
    height: auto;
    background-size: cover;
    background-position: center;
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
.datapanel{
    font-family:sans-serif;
    position: relative;
    z-index: 1;
    width: 800px;
    height:500px;
    max-width: 800px;
    margin: 0 auto 50px;
    margin-top:-60px;
    background: aliceblue;
    box-shadow: 0px 0px 10px rgba(0,0,0,.400);
    border-radius: 5px 5px 5px 5px;
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





.datapanel h3{
    font-size:1.3em;
    font-weight:400;
    color: rgba(0,0,0,.9);
    margin: 0;
}
.datapanel th{
    background:#b5c0cce7;
}
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="fonts/fontawesome/css/all.min.css">
    <title>GETSystem | Login</title>
</head>
<body>
<img style="filter:blur(2px); height:80.5vh; position:absolute; opacity:0.3; margin-top:110px; rotate-y:180;" src="../img/dhvsubg.png" alt=""> 
    <div class="head">
        <div class="header">
            <center> <h2> <span>GETS</span>ystem</h2></center>
        </div>
    </div>


     <div class="datapanel">
     
      <center><h3>Employer's Feedback Survey Form</h3></center> 
       
       

       
   
    </div>
    
    
</body>
</html>
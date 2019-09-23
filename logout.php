<?php
include_once './includes/connection.php';
include_once './includes/secondaryConnection.php';
session_start();
$logout = md5($_SESSION["email"]);
$email_md5 = md5($logout);
$email = $_SESSION["email"];
date_default_timezone_set('Asia/Manila');
$date_now = date('F d, Y');
$time_now = date('h:i A');
$query_account_type = mysqli_query($conn, "SELECT * FROM userstb WHERE Email='$email'");
                        $get_account_type = mysqli_fetch_assoc($query_account_type);
                        $Acc_type = $get_account_type["account_type"];
                        $UID = $get_account_type["ID"];
                       if ($Acc_type == "2") {
                        $check_log = mysqli_query($conn, "SELECT * FROM logstbl WHERE UID=$UID AND Date = '$date_now'");
                        $rowscount = mysqli_num_rows($check_log);
                        if ($rowscount == 0) {
                            mysqli_query($conn, "INSERT INTO logstbl(UID,Date) VALUES($UID,'$date_now')");
                            $LID =  $conn-> insert_id;
                        }else{
                            $log = mysqli_query($conn, "SELECT * FROM logstbl WHERE UID=$UID AND Date = '$date_now'");
                            $rowLID = mysqli_fetch_assoc($log);
                            $LID = $rowLID['LID'];
                        }
                        
                        mysqli_query($conn, "INSERT INTO activity_log(LID,Activity,Time) VALUES($LID,'Logged Out','$time_now')");

                    }
                       

unset($_SESSION["email"]);

session_unset();
session_destroy();
echo "<h3>Logging out...... Please wait.....<h3>";
echo "<script>window.location.href='Login?logout=$logout&v_1=$email_md5';</script>";
?>
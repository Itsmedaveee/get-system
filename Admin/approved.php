<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
session_start();
include_once '../includes/connection.php';
$db_id = $_GET['apprv_id'];
$query_name = mysqli_query($conn, "SELECT * FROM acc_req_db WHERE ID='$db_id'");
$row = mysqli_fetch_assoc($query_name);
$db_name = $row['Name'];
$db_email = $row['Email'];
$db_contact = $row['Contact'];
$db_password = $row['Password'];



require '../PHPMailer/vendor/autoload.php';

$mail = new PHPMailer(true);                              
try {

	//$headers = 'MIME-Version: 1.0'.PHP_EOL; // importante to
	//$headers .= 'Content-type: text/html; charset=iso-8859-1'.PHP_EOL; // importante to
	//$headers .= 'From: kay sender<From: kay sender>'.PHP_EOL;  // importante to
   
    $mail->isSMTP();                                    
    $mail->Host = 'smtp.gmail.com';  
    $mail->SMTPAuth = true;                               
    $mail->Username = 'joshcanlas2017@gmail.com';     // dito yung email ng sender 
    $mail->Password = 'incorrect101';      // email password ng sender                      
    $mail->SMTPSecure = 'tls';                           
    $mail->Port = 587;         
	
    $mail->setFrom('joshcanlas2017@gmail.com', 'GETSystem(Administrator)'); // mula kanino ? editable yan bahala kana
  
    $mail->addAddress($db_email); // dito ilalagay yung email ng pag sesendan               
   
    $mail->isHTML(true);                                 
	
    $mail->Header = 'MIME-Version: 1.0\r\nt Content-Type: text/plain; charset=utf-8\r\n
	X-Priority: 1\r\n'; // importante to
	
	
	$message = "Your Default Password is: <font color='red'><b>$db_password</b></font><br>You can change your Password when you login.
	<br>Login Here.. <a href='#'>SampleLink.com</a>";
		
		$mail->Subject = 'Default Password';
		$mail->Body   = $message;
	
		$mail->send();
		
		mysqli_query($conn, "INSERT INTO userstb(Name,Email,Contact,Password,attempt,account_type) VALUES('$db_name','$db_email','$db_contact','$db_password','0','2')");
		mysqli_query($conn, "DELETE FROM acc_req_db Where ID = '$db_id'");

                 $encrypted = md5(rand(1,9));
                 echo "<script>window.location.href='account_request?$encrypted&&notify=$db_name has been Approved and default password sent via email.';</script>";
		
	} catch (Exception $e) {
		echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
	}
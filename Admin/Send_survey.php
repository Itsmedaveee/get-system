<?php
session_start();
include_once '../includes/connection.php';
$batch = $_GET['batch'];
$SID = $_GET['sid'];
date_default_timezone_set('Asia/Manila');
$date_now = date('Y-m-d');
$time_now = date('h:i A');

$get_record = mysqli_query($conn, "SELECT * FROM sent_surveytbl WHERE Survey_ID=$SID AND batch=$batch");
$count = mysqli_num_rows($get_record);
if ($count > 0) {
   
}else{
    mysqli_query($conn, "INSERT INTO sent_surveytbl(Survey_ID,batch,date_sent,time_sent) VALUES('$SID','$batch','$date_now','$time_now')");
    
    
}

//sending email to batch selected
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$emails = array();
$query_name = mysqli_query($conn, "SELECT UID FROM graduates_infotbl WHERE year_graduated='$batch'");
while($row = mysqli_fetch_assoc($query_name)){
            $UID = $row['UID'];
       $query = mysqli_query($conn, "SELECT Email FROM userstb WHERE ID='$UID'");
       $result = mysqli_fetch_assoc($query);
            $emails[] = $result['Email'];
}

require '../PHPMailer/vendor/autoload.php';
foreach ($emails as $email) {
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
  
    $mail->addAddress($email); // dito ilalagay yung email ng pag sesendan               
   
    $mail->isHTML(true);                                 
	
    $mail->Header = 'MIME-Version: 1.0\r\nt Content-Type: text/plain; charset=utf-8\r\n
	X-Priority: 1\r\n'; // importante to
	
	
	$message = "Please Answer our Survey<br>Thank you!
	<br>Please Login Here.. <a href='#'>SampleLink.com</a>";
		
		$mail->Subject = 'New Survey';
		$mail->Body   = $message;
	
		$mail->send();
		
	} catch (Exception $e) {
		echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
	}

}
echo "<script>window.location.href='graduates_survey?SID=$SID&&notify=Survey sent Successfully!';</script>";




?>
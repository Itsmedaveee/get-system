<?php
$host2 = 'localhost';
$username2 ='root';
$pword2 = '123456';
$db2 = 'getsdb';
  $conn2 = mysqli_connect($host2, $username2, $pword2, $db2);
     if ($conn2-> connect_error) {
        die("connection failed:". $conn2-> connect_error);

         }

?>

<?php
include '../includes/connection.php';
$db_sid = $_GET['del_id'];

$query_name = mysqli_query($conn, "SELECT * FROM mysurveytbl WHERE Survey_ID='$db_sid'");

$row = mysqli_fetch_assoc($query_name);

    $Title = ucfirst($row['Title']);
    
    
    
       $query = mysqli_query($conn, "DELETE FROM mysurveytbl WHERE Survey_ID='$db_sid'");
        echo "<script>window.location.href='user_survey?notify=$Title Successfully Deleted!';</script>";
 ?>   

    
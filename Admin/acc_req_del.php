<?php
session_start();
include '../includes/connection.php';
$db_id = $_GET['del_id'];

$query_name = mysqli_query($conn, "SELECT * FROM acc_req_db WHERE ID='$db_id'");

$row = mysqli_fetch_assoc($query_name);

    $db_fullname = ucfirst($row['Name']);
    
       $query = mysqli_query($conn, "DELETE FROM acc_req_db WHERE ID='$db_id'");
        echo "<script>window.location.href='account_request?notify=$db_fullname has been Deleted!';</script>";
 ?>   

    
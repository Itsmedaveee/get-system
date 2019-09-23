<?php
include '../includes/connection.php';
$db_id = $_GET['del_id'];

$query_name = mysqli_query($conn, "SELECT * FROM enumeratortbl WHERE EID='$db_id'");

$row = mysqli_fetch_assoc($query_name);

    $db_name = ucfirst($row['Name']);
    
    
    
       $query = mysqli_query($conn, "DELETE FROM enumeratortbl WHERE EID='$db_id'");
        echo "<script>window.location.href='Manage_enumerator?notify= User: $db_name Successfully Deleted!';</script>";
 ?>   

    


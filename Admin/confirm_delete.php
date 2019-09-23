<?php
include '../includes/connection.php';
$db_id = $_GET['del_id'];

$query_name = mysqli_query($conn, "SELECT * FROM userstb WHERE ID='$db_id'");

$row = mysqli_fetch_assoc($query_name);

    $db_fullname = ucfirst($row['Name']);
    
    
    
       $query = mysqli_query($conn, "DELETE FROM userstb WHERE ID='$db_id'");
        echo "<script>window.location.href='manageusers?notify= User: $db_fullname Successfully Deleted!';</script>";
 ?>   

    


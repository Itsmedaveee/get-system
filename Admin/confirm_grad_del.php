<?php
include '../includes/connection.php';
$db_id = $_GET['del_id'];

$query_name = mysqli_query($conn, "SELECT * FROM graduates_infotbl WHERE GID=$db_id");
$row = mysqli_fetch_assoc($query_name);
    $db_name = ucfirst($row['firstname']);
    $UID = $row['UID'];
    
    
       $query = mysqli_query($conn, "DELETE FROM userstb WHERE ID=$UID");
        echo "<script>window.location.href='List_graduates?notify= $db_name Successfully Deleted!';</script>";
 ?>   

    


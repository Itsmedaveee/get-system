<?php
include '../includes/connection.php';
$db_id = $_GET['del_id'];

       mysqli_query($conn, "DELETE FROM job_offeringtbl WHERE JID=$db_id");
        echo "<script>window.location.href='alumni_my_post?notify=Successfully Deleted!';</script>";
 ?>   

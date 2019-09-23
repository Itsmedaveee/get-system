<?php
include '../includes/connection.php';
$db_rid = $_GET['del_id'];

$query_name = mysqli_query($conn, "SELECT * FROM admin_respondenttbl WHERE AR_ID='$db_rid'");
$row = mysqli_fetch_assoc($query_name);
$surveyID = $row['Survey_ID'];
        //delete response
        mysqli_query($conn, "DELETE FROM admin_respondenttbl WHERE AR_ID=$db_rid");
    
        echo "<script>window.location.href='alumni_response_record?notify=Successfully Deleted!&&SID=$surveyID';</script>";
 ?>   

    


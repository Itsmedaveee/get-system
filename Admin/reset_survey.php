<?php
include '../includes/connection.php';


        if(!empty($_GET['pw'])){
            $pw = $_GET['pw'];
            $SID = $_GET['del_id'];
        //check password
        $querypassword = mysqli_query($conn, "SELECT * FROM userstb WHERE account_type = '1' AND Password = '$pw'");
        $numrows = mysqli_num_rows($querypassword);
        if ($numrows == 0) {
            echo "<script>window.location.href='graduates_survey?errors=Incorrect password!';</script>";
        }else{
            //delete survey
            mysqli_query($conn, "DELETE FROM sent_surveytbl WHERE Survey_ID=$SID");
            mysqli_query($conn, "DELETE FROM admin_respondenttbl WHERE Survey_ID=$SID");
             echo "<script>window.location.href='graduates_survey?notify=Survey Successfully Reset!';</script>";
        }
        
        }else{
            echo "<script>window.location.href='graduates_survey?errors=Invalid Inputs!';</script>";
        }
 ?>   

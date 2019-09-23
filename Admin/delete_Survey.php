<?php
include '../includes/connection.php';


if(!empty($_GET['pw'])){
    $pw = $_GET['pw'];
    $db_sid = $_GET['del_id'];
//check password
$querypassword = mysqli_query($conn, "SELECT * FROM userstb WHERE account_type = '1' AND Password = '$pw'");
$numrows = mysqli_num_rows($querypassword);
if ($numrows == 0) {
    echo "<script>window.location.href='Allsurveys?notify=Incorrect password!&&clr=red';</script>";
}else{
    //delete survey
    $query_name = mysqli_query($conn, "SELECT * FROM mysurveytbl WHERE Survey_ID='$db_sid'");
    $row2 = mysqli_fetch_assoc($query_name);
    $Title = ucfirst($row2['Title']);
        
        mysqli_query($conn, "DELETE FROM mysurveytbl WHERE Survey_ID='$db_sid'");
            echo "<script>window.location.href='Allsurveys?notify=Survey: $Title and All its Response(s) Successfully Deleted!&&clr=green';</script>";
}

}else{
    echo "<script>window.location.href='Allsurveys?notify=Invalid Inputs!&&clr=red';</script>";
}
 ?>   

    
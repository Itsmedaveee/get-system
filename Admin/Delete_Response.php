<?php
include '../includes/connection.php';
$db_rid = $_GET['del_id'];

$query_name = mysqli_query($conn, "SELECT * FROM respondenttbl WHERE RID='$db_rid'");
$row = mysqli_fetch_assoc($query_name);
$surveyID = $row['Survey_ID'];
        //delete response
        mysqli_query($conn, "DELETE FROM respondenttbl WHERE RID=$db_rid");
        //check total respondents
        $get_record = mysqli_query($conn, "SELECT * FROM respondenttbl WHERE Survey_ID=$surveyID");
        $Rescount = mysqli_num_rows($get_record);

        //check target respondents
       $get_respondents = mysqli_query($conn, "SELECT Respondents FROM mysurveytbl WHERE Survey_ID=$surveyID");
       $respondents = mysqli_fetch_assoc($get_respondents);
       $res = $respondents['Respondents'];
        //check if complete/incomplete survey
       if ($Rescount < $res) {
           
           mysqli_query($conn, "UPDATE mysurveytbl SET Status = 'Incomplete' WHERE Survey_ID=$surveyID");
       }
        echo "<script>window.location.href='Admin_response?notify=Successfully Deleted!&&SID=$surveyID';</script>";
 ?>   

    


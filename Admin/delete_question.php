<?php
session_start();
include '../includes/connection.php';

$qid = $_GET['QID'];

$query_question = mysqli_query($conn, "SELECT * FROM questiontbl WHERE QuestionID='$qid'");
$row = mysqli_fetch_assoc($query_question);
$SID = $row['Survey_ID'];
$Qtype = $row['QuestionType'];
$Question = $row['Question'];
    mysqli_query($conn, "DELETE FROM questiontbl WHERE QuestionID='$qid'");
    echo "<script>window.location.href='graduates_questions?SID=$SID&&notify=Question($Question) has been Deleted!';</script>";
 ?>   

   
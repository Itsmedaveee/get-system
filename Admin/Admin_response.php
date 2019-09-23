<?php
session_start();


if (isset($_SESSION["email"])) {
    $email = $_SESSION["email"];
}else{
    echo "<script>window.location.href='../Login';</script>";
}
include_once '../includes/connection.php';

   

$sql_query = mysqli_query($conn, "SELECT Name, account_type from userstb WHERE Email='$email'");
$fetch = mysqli_fetch_assoc($sql_query);
$db_name = ucfirst($fetch['Name']);
$db_account_type = $fetch['account_type'];
$db_email = $email;
if ($db_account_type == 1) {
    $account_type = "Administrator";
}else{
    echo "<script>window.location.href='../Login';</script>";
}  



if (isset($_GET['page'])) {
    $page = $_GET['page'];
}else {
    $page = 1;
}
$num_per_page = 10;
$start_from = ($page - 1)*10;


if (!empty($_GET['SID'])) {
    $surveyID = $_GET['SID'];
}
?>
<style>
.emailphoto{
    width: 298px;
    height: 159px;
    position:absolute;
    box-shadow: 0 5px 15px #5a5c5f;
    
}
.accphoto{
    position:relative;
}
.emailacc{
    position:relative;
}
.hnoti{
    margin:0;
    padding:0;
}
.table-strip{
    
    border-collapse: collapse; 
    margin: 10px 0;
    font-size: 0.9em;
    max-width: 80%;
    border-radius: 5px 5px 0 0;
   
    text-align: left;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
   
}
.table-strip tr td{
    line-height: 25px;
    text-overflow: hidden;
}
.table-strip th{
    font-size: 1em;
    color:#191f25;
    border-left: 1px solid #7887966c;   
}
.table-strip td{
    border-bottom: 1px solid #7887966c;   
    border-left: 1px solid #7887966c;   
}
.table-strip tr:hover{
    background-color: #bcbcbd88;
}
.searchbtn{
    -webkit-border-radius: 0;
    -moz-border-radius: 0;
    border-radius: 3px 3px 3px 3px;
    background: #e25f08;
    text-decoration:none;
    border:none;
    padding: 3.5px 5px 3.2px 5px;
    color: #ffffff;
}
.searchbtn:hover{
    background: #aa6131;
    text-decoration:none;
}
.searchform{
    align: right;
}
.showentries{
    font-size: 0.9em;
    color: rgb(42, 47, 49);   
}
.btn-update{
    background: #4cbd3dfb;
    border-radius: 3px 3px 3px 3px;
}
.datapanel h3{
    margin: 0;
}
.hnoti{
    margin:0;
    padding:0;
}
.pagination{
    text-align:center;
    float:right;
    margin-right: 22px;
}
.prev-button{
    border-radius: 3px 3px 3px 3px;
    
    padding: 3px 5px 3px 5px;
    color:grey;
    text-decoration:underline;
    font-family: Helvetica, sans-serif;
    font-size: 0.9em;
    border:none;
    font-weight: bold;
}
.next-button{
    border-radius: 3px 3px 3px 3px;
    
    padding: 3px 5px 10px 5px;
    color:grey;
    text-decoration:underline;
    font-family: Helvetica, sans-serif;
    font-size: 0.9em;
    border:none;
    font-weight: bold;
   
}
.page-active{
    padding: 1px 12px 1px 12px;
    background:none;
    font-size:1em;
    border:none;
    border-radius: 3px 3px 3px 3px;
       
}
.mini-page{
    font-size:0.5em;
     
}
.active{
    background:#03254c;
}

.divText{
    width:130px;
    text-overflow: ellipsis;
    overflow: hidden;
}
.dataContainer{
    max-width:150px;
    min-width:150px;
    text-align:left;
    text-overflow:ellipsis;
    overflow:hidden;
}
.scroller{
    overflow-x: scroll;
    min-width:790px;
    max-width:790px;
    min-height:400px;
    max-height:400px;
}
.openbtn{
    
    margin-left:6px;
    border-radius: 3px 3px 3px 3px;
    text-decoration:none;
    padding:13px 6px 0px 6px;
    background:#49ffb3;
    
}
.openbtn:hover{
    opacity:0.7;
}
.tooltipx{
    display:none;
    
}
.exportdata img:hover ~ .tooltipx{
    font-size:.8em;
    font-weight:700;
    border: 2px solid rgba(0,0,0,.1);
    color:rgba(0,0,0,.5);
    display:inline;
    position:absolute;
    width:95px;
}
.exportdata img:hover{
    opacity:0.7;
}

.exportdata{
    text-decoration:none;
    position:relative;
}
tr td button:hover{
    opacity:0.6;
}
.actionbtn{
    position:relative;
}
.btndel:hover{
    opacity:0.3;
}
.btndel{
    background:#ff4949;  
    cursor:pointer; 
    border:none; 
    padding:3px 4px 3px 4px; 
    margin-right:5px; 
    border-radius: 3px 3px 3px 3px;
    
}
.viewtooltip{
    display:none;
    
}
.openbtn:hover ~ .viewtooltip{
    line-height:12px;
    display:inline;
    border:1px solid rgba(0,0,0,.550);
    position:absolute;
    font-weight:600;
    color:rgba(0,0,0,.750);
}
.deltooltip{
    display:none;
    
}
.btndel:hover ~ .deltooltip{
    line-height:12px;
    border:1px solid rgba(0,0,0,.550);
    display:inline;
    position:absolute;
    font-weight:600;
    color:rgba(0,0,0,.750);
}

</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../fonts/fontawesome/css/all.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>GETSysytem | Welcome</title>
 <style>
 
 
 </style>

</head>
<body>
    <header>
        <div class="container">
            <div id="title">
                <h2><span class="highlights">G</span>raduates <span class="highlights">E</span>mployability <span class="highlights">T</span>racer <span class="highlights">S</span>ystem</h2>
            </div>
            <nav>
                <ul>
                   <li class="current"><a href="../logout"><i class="fa fa-sign-out-alt"></i> Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    
        <div class="navbox">

                <div class="sidepanel">
                    <img src="../img/images 7.jpeg" class="emailphoto">
                        <div class="photo">
                            <img src="../img/photo10.png" class="accphoto">
                            <label for="" class="fullname"><?php echo $db_name; ?></label>

                        </div>

                        <div class="emailacc">
                        
                            <p class="email-user"><b><?php echo $email; ?></b><br>
                            <i><font color="#ffffff"><?php echo $account_type; ?></font></i>
                            
                            
                           
                            </p>
                            
                          
                        </div>
                            
                    </div>
            
                    
                          
            <div class="navpanel">

                <div class="multi-level">
                    <div class="item">
                        <input type="checkbox"  id="A">
                        <img src="../img/emaildropdown5.png" class="arrow"><label for="A">Users</label>
                        <ul>
                            <li><a style="padding-top:20px; padding-bottom:20px;" href="account_request"><i class="fa fa-user-plus"></i> Account Request</a></li>
                            <li><a style="padding-top:20px; padding-bottom:20px;" href="manageusers"><i class="fa fa-user-cog"></i> Manage Users</a></li>
                            <li><a style="padding-top:20px; padding-bottom:20px;" href="Manage_enumerator"><i class="fa fa-users"></i> Enumerators</a></li>
                        </ul>
                    </div>
                </div>

                <div class="item">
                    <input type="checkbox" id="B">
                    <img src="../img/emaildropdown5.png" class="arrow"><label for="B">Data Encoders</label>
                    <ul>
                    <li><a style="padding-top:20px; padding-bottom:20px;" href="Allsurveys"><i class="fa fa-pen"></i> Surveys</a></li>
                    <li><a style="padding-top:20px; padding-bottom:20px;" href="Logs"><i class="fa fa-history"></i> Logs</a></li>
                    </ul>
                </div>

                <div class="item">
                    <input type="checkbox" id="c">
                    <img src="../img/emaildropdown5.png" class="arrow"><label for="c">Graduates</label>
                    <ul>
                    <li><a style="padding-top:20px; padding-bottom:20px;" href="graduates_survey"><i class="fa fa-pen"></i> Surveys</a></li>
                    <li><a style="padding-top:20px; padding-bottom:20px;" href="List_graduates"><i class="fa fa-user-graduate"></i> List of Graduates</a></li>
                    <li><a style="padding-top:20px; padding-bottom:20px;" href="admin_reports"><i class="fa fa-chart-bar"></i> Reports</a></li>
                    </ul>
                </div>

                <div class="item">
                    <input type="checkbox" id="f">
                    <img src="../img/emaildropdown5.png" class="arrow"><label for="f">Employers</label>
                    <ul>
                    <li><a style="padding-top:20px; padding-bottom:20px;" href="Logs"><i class="fa fa-pen"></i> Surveys</a></li>
                    <li><a style="padding-top:20px; padding-bottom:20px;" href="Allsurveys"><i class="fa fa-comment"></i> Feedback</a></li>
                    </ul>
                </div>
                <div class="item">
                    <input type="checkbox" id="j">
                    <img src="../img/emaildropdown5.png" class="arrow"><label for="j">Job Offerings</label>
                    <ul>
                    <li><a style="padding-top:20px; padding-bottom:20px;" href="add_jobs"><i class="fa fa-briefcase-medical"></i> Post Jobs</a></li>
                    <li><a style="padding-top:20px; padding-bottom:20px;" href="job_offerings"><i class="fa fa-briefcase"></i> Job Offerings</a></li>
                    </ul>
                </div>



            </div>
         </div>
         <div class="dropdownnav">
         <input type="checkbox" id="E">
         <label for="E"><img class="emaildropdown" src="../img/emaildropdown5.png"></label>
                            <ul>
                                <li><a href="change_adminpass"><i class="fa fa-lock"></i> Change password</a></li>
                                <li><a href="change_adminemail"><i class="fa fa-at"></i> Update Email</a></li>
                                <li><a href="change_admincontact"><i class="fa fa-phone"></i> Update Contact</a></li>
                            </ul>

                            </ul>
        </div>

         <div class="mainpanel">
         <div class="statuspanel">
         <?php 
            if (empty($_GET['notify'])) {
                        
                echo "";
            } else {
                echo "<br><h5 class='hnoti'><font color='green'>". $_GET['notify'] ."</font></h5>";
                unset($_GET['notify']);
            }
            ?>
            </div>
            <?php
            //xls button
            $queryss = mysqli_query($conn, "SELECT * FROM respondenttbl WHERE Survey_ID = $surveyID");
            $totalRes = mysqli_num_rows($queryss);
            if ($totalRes == 0) {
                $hidden = "display:none;";

            }else{
                $hidden = "";
            }

            ?>
            
            <a style="position:absolute; margin-left:805px; margin-top:15px; <?php echo $hidden; ?>"  class="exportdata" href="Export_excel?SID=<?php echo $surveyID; ?>">
            <img style="width:50px; border-radius:29px; box-shadow:0px 0px 5px rgba(0,0,0,.550);" src="../img/excel.ico" alt="">
            <span class="tooltipx">Export Data to Excel</span>
            </a>
           <div class="datapanel">
                

           <CAPTION><h3>Responses</h3></CAPTION><br>
           
            <span style=" color:rgba(0,0,0,.750);">Total Response(s): <?php echo $totalRes;?></span>

                <div class="scroller">
                
                
                <table style="max-width:100%;" align="center" class="table-strip" >

                                    
                        <?php 

                        $querys = mysqli_query($conn, "SELECT * FROM questiontbl WHERE Survey_ID = $surveyID ");
                        $r = mysqli_num_rows($querys);
                        if ($r == 0) {
                            echo "<thead>
                            <tr height='35'>
                            <th><div style='min-width:80px; text-align:center;'>No Data Found</div></th>
                            ";
                        }else{
                            echo "<thead>
                            <tr height='35'>
                            <th style='max-width:70px; min-width:70px;'><div style='max-width:70px; text-align:center;'>Action</div></th>
                            ";
                                
                                
                        
                            
                        }
                //***************************Showing all Surveys  */ 
                    
                    
                        $querys = "SELECT * FROM questiontbl WHERE Survey_ID = $surveyID ";
                        $result = $conn-> query($querys);
                        
                        if ($result-> num_rows > 0){

                            $count = 0;
                            while ($row = $result-> fetch_assoc()){
                                
                                $QuestionType = $row['QuestionType'];
                                $Questions = $row['Question'];
                                $count = $count + 1;

                            echo "
                                <th><div class='dataContainer'>$Questions</div></th>
                                              
                               ";
                            }
                        }
                        echo "</tr>
                            ";
                        //loop for Respondent
                               $querys = "SELECT * FROM respondenttbl WHERE Survey_ID = $surveyID ";
                                $result1 = $conn-> query($querys);
                        
                                if ($result1-> num_rows > 0){
                                   $page = 0;
                                        while ($row1 = $result1-> fetch_assoc()){
                                                    $RID = $row1['RID'];
                                                    $page = $page + 1;

                             echo "<tr><td>
                                            <span class='actionbtn'>
                                    <a href='Admin_IndividualRes?page=$page&&SID=$surveyID' class='openbtn'><img src='../img/open.png'></a>
                                    <span class='viewtooltip'>View Individually</span>
                                    <button class='btndel' onClick='deleteme($RID)'><img src='../img/delete1.png'></button>
                                    <span class='deltooltip'>Delete Response</span>
                                            </span>
                                    </td>
                                  ";

                        //loop for checking Question Type
                            $query = "SELECT * FROM questiontbl WHERE Survey_ID = $surveyID ";
                            $result = $conn-> query($query);

                            if ($result-> num_rows > 0){
                                
                                while ($row = $result-> fetch_assoc()){
                                    $QID = $row['QuestionID'];
                                    $QuestionType = $row['QuestionType'];
                                
 //******************************SHOWING Response Survey in TABLE   */

                                    $queryother = mysqli_query($conn, "SELECT * FROM otherstbl WHERE RespondentID=$RID AND Question_ID=$QID");
                                    $othercount = mysqli_num_rows($queryother);
                                    if ($othercount > 0) {
                                        $otherresult = mysqli_fetch_assoc($queryother);
                                        $other = $otherresult['Response'];
                                    }
 
                        if ($QuestionType == "Checkbox"){
                            if ($othercount > 0){
                                echo "<td><div class='dataContainer'><span>".$other."</span>";
                            }else{
                           echo "<td ><div class='dataContainer'>";
                          }
                        }
                    
                        $sqlresponse = "SELECT * from responsetbl WHERE Question_ID = $QID AND RespondentID= '$RID' ";
                        $resultresponse = $conn-> query($sqlresponse);
                        
                            if ($resultresponse-> num_rows > 0){
                            
                                while ($rowresponse = $resultresponse-> fetch_assoc()){
                                    $Response = $rowresponse['Response'];
                                    
                                    if ($Response == "Not Answered") {
                                        $color = "style='color:red'";
                                    }else{
                                        $color ="";
                                    }
                                    
                                    if ($QuestionType == "Checkbox") {
                                                if ($Response == "Not Answered") {
                                                    echo "<span $color>".$Response."</span>";
                                                }else{
                                                    if ($othercount > 0) {
                                                        echo "<span>,".$Response."</span>";
                                                    }else{
                                                        echo "<span>".$Response.",</span>";
                                                    }
                                                }
                                        


                                    }else{

                                        echo "<td $color><div class='dataContainer'>$Response</div></td>";
                                    }

                                   



                            }
                            if ($QuestionType == "Checkbox") {
                                echo "</div></td>";
                             }
                        }
                      
                        
                        
                    }
                }

                echo "</tr>";
            }
        }else{
            echo "
            <tr height='35' >
            <td colspan='5'><div style='min-width:80px; text-align:center;'>No Data Found</div></td></tr>
            ";

        }
        
    
                ?>
                        </table>
                        </div>
                <script language="javascript">

                        function deleteme(delid){

                        if (confirm("Youre about to DELETE Response, continue?")) {

                            window.location.href='Delete_Response?del_id='+delid+'';
                        return true;
                            }
                        }

                </script>
                       


                
            </div>
                
         </div>
  

</body>
</html>
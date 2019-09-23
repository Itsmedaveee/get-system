<?php
$encrypted = md5(rand(1,9));
session_start();
if (isset($_SESSION["email"])) {
    $email = $_SESSION["email"];
}else{
    echo "<script>window.location.href='../Login';</script>";
    
}

include_once '../includes/connection.php';

$sql_query = mysqli_query($conn, "SELECT ID, Name, account_type from userstb WHERE Email='$email'");
$fetch = mysqli_fetch_assoc($sql_query);
$db_name = ucfirst($fetch['Name']);
$db_account_type = $fetch['account_type'];
$db_id = $fetch['ID'];
$db_email = $email;
$sql = mysqli_query($conn, "SELECT Stud_No, year_graduated, GID from graduates_infotbl WHERE UID='$db_id'");
$fetchSN = mysqli_fetch_assoc($sql);
$GID = $fetchSN['GID'];
$batch = $fetchSN['year_graduated'];
$SN = $fetchSN['Stud_No'];
if ($db_account_type == 3) {
    $account_type = "Alumni / ".$SN;
    
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
label a:hover{
    opacity:0.7;
    
}
.table-stripped{
    border-collapse: collapse; 
    margin: 10px 0;
    font-size: 0.9em;
    max-width: 80%;
    
    box-shadow: 0 0 20px rgba(0,0,0,0.20);
    text-align: left;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
   
}
.table-stripped tbody tr td{

    text-overflow: hidden;
}
.table-stripped th{
    font-size: 1em;
    color:#191f25;
}
.table-stripped tbody td{
    border-bottom: 1px solid #7887966c;   
}
.table-stripped tbody tr:hover{
    background-color: #bcbcbd88;
}
.searchbtn{
    cursor:pointer;
    border-radius: 3px 3px 3px 3px;
    background: #2e68aa;
    text-decoration:none;
    border:none;
    padding: 3.5px 5px 3.2px 5px;
    color: #ffffff;
}
.searchbtn:hover{
    opacity:0.7;
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
.tooltip{
    display:none;
}
.toolq:hover ~ .tooltip{
    font-weight:bold;
    display:block;
    position:absolute;
    color:black;
    background: #f8fbfc81;
    border: 1px solid grey;
    margin-top:10px;
}
.tooltips{
    display:none;
}

.toolr:hover ~ .tooltips{
    font-weight:bold;
    display:block;
    position:absolute;
    color:black;
    background: #f8fbfc81;
    border: 1px solid grey;
    margin-left:30px;
    margin-top:10px;
    
}
.tooltipe{
    display:none;
}
.toole:hover ~ .tooltipe{
    font-weight:bold;
    display:block;
    position:absolute;
    color:black;
    background: #f8fbfc81;
    border: 1px solid grey;
    margin-left:55px;
    margin-top:10px;
}
.toole{
    padding: 5px 5px 5px 5px;
    border-radius: 3px 3px 3px 3px;
    color: #ffffff;
    font-size: 16px;
    background: #2e68aa;
    text-decoration: none;
    border:none;
    cursor: pointer;
}
.tooltipd{
    display:none;
}
.toold:hover ~ .tooltipd{
    font-weight:bold;
    display:block;
    position:absolute;
    color:black;
    background: #f8fbfc81;
    border: 1px solid grey;
    margin-left:65px;
    margin-top:10px;
}
.toold{
    border-radius: 3px 3px 3px 3px;
    color: #ffffff;
    font-size: 13px;
    background: #ff4949;
    padding: 6px 8px 6px 8px;
    text-decoration: none;
    border:none;
    cursor: pointer;
}
.toolr:hover, .toole:hover, .toolq:hover, .toold:hover{
    opacity:0.7;
}
.toolr{
    border-radius: 3px 3px 3px 3px;
    color: #ffffff;
    font-size: 13px;
    background: #2e68aa;
    padding: 6px 6px 6px 6px;
    text-decoration: none;
    border:none;
    cursor: pointer;
   
}

.toole{
    border-radius: 3px 3px 3px 3px;
    color: #ffffff;
    font-size: 13px;
    background: #2e68aa;
    padding: 5px 6px 5px 7px;
    text-decoration: none;
    border:none;
    cursor: pointer;
}
.toolq{
    border-radius: 3px 3px 3px 3px;
    color: #ffffff;
    font-size: 13px;
    background: #2e68aa;
    padding: 5px 7px 5px 7px;
    text-decoration: none;
    border:none;
    cursor: pointer;
}
.divText{
    width:200px;
    text-overflow: ellipsis;
    overflow: hidden;
}
#filter{
    height:21px;
    outline:none;
    border:1px solid #2e68aa;
    color: #2e68aa;
}
.print_grad{
    letter-spacing:0.2;
    margin:0; 
    padding:4; 
    background:#2e68aa; 
    color:aliceblue; 
    border:0; 
    border-radius: 3px 3px 3px 3px; 
    cursor:pointer;
    font-size:13px;
    font-weight:500;
    text-decoration:none;
}
.print_grad:hover{
    opacity:0.7;
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
    
</head>
<body>
    <header>
        <div class="container">
            <div id="title">
                <h2><span class="highlights">G</span ><span style="font-family:arial;">raduates</span> <span class="highlights">E</span>mployability <span class="highlights">T</span>racer <span class="highlights">S</span>ystem</h2>
            </div>
            <nav>
                <ul>
                   <li class="current"><a href="../logout.php"><i class="fa fa-sign-out-alt"></i> Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    
        <div class="navbox">

                <div class="sidepanel">
                <img src="../img/images 7.jpeg" class="emailphoto">
                        <div class="photo">
                            <img src="../img/photo10.png" class="accphoto">
                            <label for="" class="fullname"><?php echo ucfirst($db_name); ?></label>
                            
                        </div>

                        <div class="emailacc">
                            
                            <p class="email-user" ><b><?php echo $email; ?></b><br><i><font color="#ffffff"><?php echo $account_type; ?></font></i></p>
                          
                        </div>
                            
                    </div>
            
        
            <div class="navpanel">

            <div class="multi-level">
                <div class="item">
                    
                    <label for="E" style="margin:0; padding:0;"><a href="alumni_page" style="text-decoration:none; color:#0c1c22; padding:200px 150px 15px 30px;"><i class="fa fa-home"></i> Dashboard</a></label> 
                 
                  </div>
                </div>

                <div class="item">
                    <input type="checkbox" id="A">
                    <img src="../img/emaildropdown5.png" class="arrow"><label for="A">Surveys</label>
                    <ul>
                        <li><a style="padding-top:20px; padding-bottom:20px;" href="alumni_surveys"><i class="fa fa-pen"></i> Surveys</a></li>
                    </ul>
                </div>
                <div class="item">
                    <input type="checkbox" id="B">
                    <img src="../img/emaildropdown5.png" class="arrow"><label for="B">Jobs</label>
                    <ul>
                        <li><a style="padding-top:20px; padding-bottom:20px;" href="alumni_add_job"><i class="fa fa-briefcase-medical"></i> Post Jobs</a></li>
                        <li><a style="padding-top:20px; padding-bottom:20px;" href="alumni_job_offerings"><i class="fa fa-briefcase"></i> Job Offerings</a></li>
                    </ul>
                </div>
               
               
                
            </div>
         </div>

         <div class="dropdownnav">
         <input type="checkbox" id="D">
         <label for="D"><img class="emaildropdown" src="../img/emaildropdown5.png"></label>
                            <ul>
                                <li><a href="alumni_changepass"><i class="fa fa-user-lock"></i> Change password</a></li>
                                <li><a href="alumni_personal_info"><i class="fa fa-user-cog"></i> Personal Info</a></li>
                                
                            </ul>

        </div>

         <div class="mainpanel">
            <div class="statuspanel">
            <?php 
            if (empty($_GET['notify'])) {
                        
                echo "";
            } else {
                echo "<br><h5 class='hnoti'><font color='green'><i class='fa fa-check-circle'></i> ". $_GET['notify'] ."</font></h5>";
                unset($_GET['notify']);
            }
            ?>
            </div>
           <div class="datapanel">
                
           <CAPTION><h3>Surveys</h3></CAPTION>
           
            <br>
            <br>

           <a href='Add_grad_survey' taget="_blank" class='print_grad' ><i class='fa fa-print'></i> Print Survey</a>
               <table border="0" width="100%" align="center"class="table-stripped" >

                   

                   <thead>
                       <tr height="35"> 
                           
                           <th >Title</th>
                           <th >Status</th>
                           <th >No. of Question</th>
                           <th >Date Sent</th>
                           <th >Deadline</th>
                           <th >Actions</th>

                       </tr>
                   </thead>
                           


                           <?php
               //**************************Search button */
                               if (!isset($_POST['search'])) {
                                   
                           ?>
                       
                               <?php
               //***************************Edit button */        
                               if (empty($_GET["getEdit"])) {
                               
                               


                               ?>

                                   
                       <?php 
               //***************************Showing all Surveys  */ 
                                   
                       $query = mysqli_query($conn, "SELECT * FROM sent_surveytbl WHERE batch='$batch'");
                       $total_count = mysqli_num_rows($query);
                       if ($total_count == 0) {
                           echo "<tr><td colspan='6'>
                           <center><b>No Survey Available</b></center>
                           </td></tr></table>";
                       } else {
           
                       $sql = "SELECT * FROM sent_surveytbl WHERE batch = $batch ORDER BY ID DESC limit $start_from,$num_per_page";
                       $result = $conn-> query($sql);

                       if ($result-> num_rows > 0){
                           $showcount = 0;
                           while ($row = $result-> fetch_assoc()){
                            $showcount = $showcount + 1;
                            $surveyID = $row['Survey_ID'];
                            $db_datesent = $row["date_sent"]."(".$row['time_sent'].")";
                            
                            $get_question = mysqli_query($conn, "SELECT * FROM questiontbl WHERE Survey_ID=$surveyID");
                            $db_no_question = mysqli_num_rows($get_question);
                            $get_respondent = mysqli_query($conn, "SELECT * FROM admin_respondenttbl WHERE Survey_ID=$surveyID AND GID=$GID");
                            $db_respondent = mysqli_num_rows($get_respondent);
                            if ($db_respondent == 0) {
                                $answered = "Not Answered";
                                $hideeye = "hidden";
                                $hideanswer = "";
                            }else{
                                $answered = "Answered";
                                $hideeye = "";
                                $hideanswer = "hidden";
                            }
                            $get_title = mysqli_query($conn, "SELECT Title, Description,end_date FROM mysurveytbl WHERE Survey_ID=$surveyID");
                            $fetchtitle = mysqli_fetch_assoc($get_title);
                            $db_enddate = $fetchtitle["end_date"];
                            $db_title = $fetchtitle['Title'];
                            $db_description = $fetchtitle['Description'];

                        $jScript = md5(rand(1,9));
                        $newScript = md5(rand(1,9));
                        $getResponse = md5(rand(1,9));
                        $getQuestion = md5(rand(1,9));
                        $getEdit = md5(rand(1,9));
                        $getDelete = md5(rand(1,9));


               //******************************SHOWING Survey TABLE <img src='../img/responsewhite.png'> <img  src='../img/questionwhite.png'>  <img src='../img/Addreswhite.png'> <img src='../img/delete1.png'>*/
                           
                           echo "<tbody><tr height=30>

                                   <td><div class='divText'>$db_title</div></td>
                                   <td>$answered</td>
                                   <td>$db_no_question</td>
                                   <td>$db_datesent</td>
                                   <td>$db_enddate</td>
                                   
                                 
                                  <td width='65px'>
                                  <button $hideeye class='toolr' onClick='sendme($surveyID)'>
                                  <i class='fa fa-eye'></i></button>
                                  <span $hideeye class='tooltips'>Review Answer</span>
                                  <a $hideanswer class='toolq' href='alumni_response?jScript=$jScript && newScript=$newScript && getQuestion=$getQuestion && SID=$surveyID && GID=$GID' >
                                  <i class='fa fa-pencil-alt'></i></a>
                                  <span $hideanswer class='tooltip'>Answer Survey</span>
                                 
                                  </td>                         
                                </tr>
                                </tbody>
                                
                                ";
                                
               
                           }

                           $total_page = ceil($total_count/$num_per_page);
                               
                               $count_to = $showcount + $start_from;
                               if ($page >= 1) {
                                   $start_from = $start_from + 1;
                               }
                                   echo "</table>
                                   <span class='showentries'>Showing $start_from to $count_to of  $total_count entries</span>";
                                   
                                   echo "<span class='pagination'>";
                       
                                   if ($page > 1) {
                                       echo "<a href='manageusers?page=".($page - 1)."' class='prev-button'>Previous</a>";
                                   }


                                   echo "<button disabled class='page-active'>".$page."<br><span class='mini-page'>Page</span></button>";


                                   if ($page != $total_page) {
                                       echo "<a href='manageusers?page=".($page + 1)."' class='next-button'>Next</a>";
                                   }

                                 
                               echo "</span>";


                               
                       

                   }
               }
               ?>
                       
                       <?php
                       /**Edit button */
                       }else{
                           include 'updating_users.php';
                       }
                       ?>
                       
                       <?php
                       /**Search button */
                       }else{
                           $preg_rep = $_POST['searchbox'];
                           $preg_rep = preg_replace("#[^0-9a-z@. ]#i","",$preg_rep);
                           echo "<script>window.location.href='alumni_search_survey?filt=".$preg_rep."&&cat=".$_POST['filter']."';</script>";
                       }
                       ?>
                     

                       


                     <script language="javascript">
                       var span = document.getElementsByClassName("close")[0];
                       var modal = document.getElementsByClassName("modal")[0];
                       var btn = document.getElementsByClassName("btn-confirm")[0];
                       //close button
                       span.onclick = function(){
                           modal.style.display = "none";
                       }
                       window.onclick = function(event){
                           if(event.target == modal){
                               modal.style.display = "none";
                           }
                       }
                       //delete/confirm button
                       function deleteme(delid){

                                   modal.style.display = "block";
                                   
                                   btn.onclick = function(){    
                                   var pw = document.getElementById("pw").value;
                                   if (pw != "") {
                                       window.location.href='del_grad_survey?del_id='+delid+'&&pw='+pw+'';
                                   }
                                   
                               }

                       }


                       var spansend = document.getElementsByClassName("close-send")[0];
                       var modalsend = document.getElementsByClassName("modal-send")[0];
                       var btnsend = document.getElementsByClassName("btn-confirm-send")[0];
                       
                       //close button
                       spansend.onclick = function(){
                           modalsend.style.display = "none";
                       }
                       window.onclick = function(event){
                           if(event.target == modalsend){
                               modalsend.style.display = "none";
                           }
                       }
                       //delete/confirm button
                       function sendme(sid){
                                       window.location.href='alumni_review_res?SID='+sid+'';
                                 
                       }

                       </script>

               


            </div>
                
         </div>
  

</body>
</html>
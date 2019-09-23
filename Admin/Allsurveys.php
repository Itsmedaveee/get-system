<?php

session_start();
include_once '../includes/connection.php';
if (isset($_SESSION["email"])) {
    $email = $_SESSION["email"];
}else{
    echo "<script>window.location.href='../Login';</script>";
         
 }
    
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



?>
<style>
.table-stripped{
    border-collapse: collapse; 
    margin: 10px 0;
    font-size: 0.9em;
    min-width: 700px;
    border-radius: 5px 5px 0 0;
    overflow:hidden;
    flex-wrap: nowrap;
    box-shadow: 0 0 20px rgba(0,0,0,0.20);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    
}
.table-stripped{
    text-align: left;
}
.table-stripped th{
    font-size: 1em;
    color:#191f25;
}
.table-stripped td{
    border-bottom: 1px solid #dedfdf;
    
}

.table-stripped tbody tr:hover{
    background-color: #bcbcbd88;
}
.datapanel h3{
    font-size:1.3em;
    font-weight:400;
}
.searchbtn{
    
    border-radius: 3px 3px 3px 3px;
    background: #2e68aa;
    text-decoration:none;
    border:none;
    padding: 3.5px 5px 3.2px 5px;
    color: #ffffff;
}
.searchbtn:hover{
    opacity:0.7;
    cursor:pointer;
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
    cursor: pointer;

}
.btn-update img{
    width:24px;

}
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
    padding: 0px 12px 0px 12px;
    background:none;
    font-size:1em;
    border:none;
    border-radius: 3px 3px 3px 3px;
    padding-bottom:9px;
    
    
}

.mini-page{
    font-size:0.5em; 
}
.active{
    background:#03254c;
}
.tooltips{
    display:none;
}
.toolr:hover ~ .tooltips{
    font-size:.8em;
    font-weight:bold;
    display:block;
    position:absolute;
    color:black;
    background: #f8fbfc81;
    border: 1px solid grey;
    margin-left:30px;
}
.toolr{
    background: #2e68aa;
    padding: 13px 3px 0px 3px;
    border-radius: 3px 3px 3px 3px;
}
.tooltipsummary{
    display:none;
}
.toolsummary:hover ~ .tooltipsummary{
    font-size:.8em;
    font-weight:bold;
    display:block;
    position:absolute;
    color:black;
    background: #f8fbfc81;
    border: 1px solid grey;
    margin-left:25px; 
}
.toolsummary{
    background: #2e68aa;
    padding: 13px 3px 0px 3px;
    border-radius: 3px 3px 3px 3px;
}
.toole{
    border-radius: 3px 3px 3px 3px;
    color: #ffffff;
    font-size: 16px;
    background: green;
    text-decoration: none;
    border:none;
    cursor: pointer;
}
.tooltipd{
    display:none;
}
.toold:hover ~ .tooltipd{
    font-size:.8em;
    font-weight:bold;
    display:block;
    position:absolute;
    color:black;
    background: #f8fbfc81;
    border: 1px solid grey;
    margin-left:40px;
}
.toold{
    border-radius: 3px 3px 3px 3px;
    color: #ffffff;
    font-size: 16px;
    background: #ff4949;
    padding: 3px 4px 3px 4px;
    text-decoration: none;
    border:none;
    cursor: pointer;
    margin-right:7;
}
.toold:hover, .toolr:hover, .toolsummary:hover{
    opacity:0.7;
}
.datapanel{
   
   min-width: 850px;
   max-width: 850px;
   
}
.headcontainer{
    border-radius: 5px 5px 0px 0;
    min-width:800px;
    max-width:800px;
    background: #1166b1c2;
    padding: 14 2 14 0;
    border-bottom: 3px solid #1167b1;
}
.headcontainer span{
    letter-spacing: 1px;
    font-size: 1em;
    color:rgba(0,0,0,0.705);
    padding-left: 7px;
    font-weight: 700;
}
.bodycontainer{
    padding-bottom: 9px;
    padding-top: 9px;
    padding-left: 2px;
    min-width:800px;
    max-width:800px;
    border-bottom:2px solid #1167b1;
    min-height:90px;
}
.actionbtn{
    float:right; 
    position:relative;
    margin:0;
    padding:0;
    margin-top:10px;
}
.shadowbox{
    max-width:802px;
    border-radius: 5px 5px 0 0;
    margin-left: 5px;
    background:rgb(249, 253, 255);
}
.shadowbox:hover{
    box-shadow: 0 0 3px rgba(0,0,0,0.705);
}
.filtertext{
    border:none;
    background:transparent;
    border-bottom:2px solid lightblue;
    outline:none;
    font-size:1em;
    font-weight: 500;
    color:rgba(0,0,0,0.705);
}
.filtertext:focus{
    border-bottom:2px solid blue;
}
#filter{
    outline:none;
    padding:3px;
    height:23px;
    border:1px solid #2e68aa;
    color: #2e68aa;
}
#filter:hover{
    cursor:pointer;
}
.scroller{
    overflow-y:scroll;
    height:400px;
    width:830px;
}
.B{
    font-size: 0.8em;
    letter-spacing: 1px;
    color:rgba(0,0,0,0.705);
}
.A{
    font-size: 0.8em;
    letter-spacing: 1px;
    padding-left: 6px;
    color:rgba(0,0,0,0.9);
}
.modal{
    display:none;
    position:fixed;
    z-index: 1;
    Padding-top: 300px;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgb(0,0,0);
    background-color: rgba(0,0,0,0.4);
}
.modal-content{
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    padding-top:0;
    padding-right:10px;
    border: 1px solid #888;
    width: 30%;
}
.close{
    color: #aaaaaa;
    float:right;
    font-size: 28px;
    font-weight: bold;
}
.close:hover,
.close:focus{
    color:#000;
    text-decoration: none;
    cursor:pointer;
}
.btn-confirm{
    
    border-color: #fff;
    
    font-size:15px;
    font-weight:500;
    color:rgba(0,0,0,0.750);
}
.btn-confirm:hover{
    cursor:pointer;
}
.pw{
    width:300px;
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
                <h2><span class="highlights">G</span>raduates <span class="highlights">E</span>mployability <span class="highlights">T</span>racer <span class="highlights">S</span>ystem</h2>
            </div>
            <nav>
                <ul>
                   <li class="current"><a href="../logout"><i class="fa fa-sign-out-alt"></i> Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

                    <div class="modal">
                    <div class="modal-content">
                    <span class="close">&times;</span>
                    <p style="color:rgba(0,0,0,0.750); font-size:16px; font-weight:600;"><span style="color:red;">Note:Deleting Survey will also DELETE ALL its response(s) and CAN NOT be UNDO</span><br>
                    Enter your password to continue..</p>
                    <input type="password" name="pw" id="pw" class="pw" placeholder="enter password here.." autofocus>
                    <button class="btn-confirm" >Confirm</button>
                    </div>
                    </div>
    
        <div class="navbox">

                <div class="sidepanel">
                <img src="../img/images 7.jpeg" class="emailphoto">
                        <div class="photo">
                            <img src="../img/photo10.png" class="accphoto">
                            <label for="" class="fullname"><?php echo ucfirst($db_name); ?></label>
                            
                        </div>

                        <div class="emailacc">
                            
                            <p class="email-user" ><b><?php echo $email; ?></b><br><i><font color="#ffffff"><?php echo $account_type; ?></font></i>
                            </p>
                        </div>
                            
                    </div>
            
        
            <div class="navpanel">

                <div class="multi-level">
                    <div class="item">
                        <input type="checkbox"  id="A">
                        <img src="../img/emaildropdown5.png" class="arrow"><label for="A">Users</label>
                        <ul>
                            <li><a style="padding-top:20px; padding-bottom:20px;" href="account_request"><i class="fa fa-user-plus"></i> Account Requests</a></li>
                            <li><a style="padding-top:20px; padding-bottom:20px;" href="manageusers"><i class="fa fa-user-cog"></i> Manage Users</a></li>
                            <li><a style="padding-top:20px; padding-bottom:20px;" href="Manage_enumerator"><i class="fa fa-users"></i> Enumerators</a></li>
                        </ul>
                    </div>
                </div>

                <div class="item">
                    <input type="checkbox" id="B">
                    <img src="../img/emaildropdown5.png" class="arrow"><label for="B">Data Encoders</label>
                    <ul>
                    <li class="active"><a style="padding-top:20px; padding-bottom:20px;" href="Allsurveys"><i class="fa fa-pen"></i> Surveys</a></li>
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
         <input type="checkbox" id="D">
         <label for="D"><img class="emaildropdown" src="../img/emaildropdown5.png"></label>
                            <ul>
                                <li><a href="change_adminpass.php"><i class="fa fa-lock"></i> Change password</a></li>
                                <li><a href="change_adminemail"><i class="fa fa-at"></i> Update Email</a></li>
                                <li><a href="change_admincontact"><i class="fa fa-phone"></i> Update Contact</a></li>
                            </ul>

                            </ul>
        </div>

         <div class="mainpanel">
         <div class="statuspanel">
             
         <?php
                    
                    if (empty($_GET['notify'])) {
                        echo " ";
                    } else {
                        if (!empty($_GET['clr'])) {
                            $clr = $_GET['clr'];

                        }else{
                            $clr = "green";
                        }
                        echo "<br><h5 class='hnoti'><font color='$clr'>". $_GET['notify'] ."</font></h5>";
                        $_GET['notify'] = "";
                    }

                     
               


                ?> 
            </div>
           <div class="datapanel">
           <CAPTION><h3>Manage Surveys</h3></CAPTION>
                
           <center><table border="0" class="searchtable" width="770">
            <tr><td>
            <form align="right"class="searchform" action="" method="POST">
            <input class="filtertext" type="text" name="searchbox" placeholder="Filter here.." value="<?php if(!empty($_POST['searchbox'])){ echo $_POST['searchbox'];}?>">
            <select name="filter" id="filter">
            <option value="Title">Title</option>
            <option value="User">User</option>
            <option value="Date_created">Date created</option>
            <option value="End_date">End Date</option>
            <option value="Status">Status</option>
            </select>
            <input type="submit" class="searchbtn" name="search" value="Filter">
            </td></tr>
            </form>
            </table></center>



               


                         
                        
                                <?php
                //***************************Edit button */        
                                if (empty($_GET["getEdit"])) {
                                
                                


                                ?>

                        <div class="scroller">            
                        <?php 
                //***************************Showing all Search Surveys  */ 
                if (isset($_POST['search'])) {
                    $searchdb = $_POST['searchbox'];
                    $filter = $_POST['filter'];
                    $searchdb = preg_replace("#[^0-9a-z@ ]#i","",$searchdb);
                    if ($filter == "User") {
                    
                        $sql = "SELECT * from userstb WHERE Name LIKE '%$searchdb%'";
                        $result = $conn-> query($sql);
                        if ($result-> num_rows > 0){
                            while ($rows = $result-> fetch_assoc()){
                            $searchUID = $rows['ID'];

                            $sql1 = "SELECT * from mysurveytbl WHERE user_ID = $searchUID";
                            $result1 = $conn-> query($sql1);
                            if ($result1-> num_rows > 0){
                            
                                while ($rows1 = $result1-> fetch_assoc()){


                                $surveyID = $rows1['Survey_ID'];
                                $userID = $rows1['user_ID'];
                                $db_title = ucfirst($rows1['Title']);
                                $db_description = ucfirst($rows1["Description"]);
                                $db_datecreated = $rows1["Date_created"];
                                $db_enddate = $rows1["End_date"];
                                $db_status = $rows1["Status"];
                                $db_respondents = $rows1["Respondents"];
                                $query = mysqli_query($conn, "SELECT * FROM userstb WHERE ID = $userID ");
                                $getuser = mysqli_fetch_assoc($query);
                                $userName = $getuser['Name'];
                        
                                $get_record = mysqli_query($conn, "SELECT * FROM respondenttbl WHERE Survey_ID=$surveyID");
                                $Rescount = mysqli_num_rows($get_record);


                                $jScript = md5(rand(1,9));
                                $newScript = md5(rand(1,9));

                            if ($db_status == "Completed") {
                               
                                $color ="green";
                                
                            }else{
  
                                $color ="red";
                            
                            }
                //******************************SHOWING All Survey TABLE   */
                            echo "

                            <div class='shadowbox'>
                            <div class='headcontainer'>
                            <CAPTION><span style='padding-left:9px;'>$db_title</span></CAPTION>
                            </div>

                            <div class='bodycontainer'>
                            <CAPTION><span style='color:rgba(0,0,0,.9); padding-left:5px; font-size:0.9em; '>$db_description</span></CAPTION>
                    <hr/>
                            <div class='divNote'>                               
                            <span class='B' style='padding-left:6px; font-size:0.9em;'>$userName</span><br>
                            <span class='A'>Date created:</span>
                            <span class='B'>$db_datecreated</span><span class='A'>-  End Date:</span><span class='B'>$db_enddate</span> <br>
                            <span class='A'>Status: </span>
                            <span class='B' style='color:$color' >$db_status</span> <br>
                            <span class='A'>Respondents: </span>
                            <span class='B'>$Rescount/$db_respondents</span><br>

                            <span class='actionbtn'>

                            <a class='toolsummary' href='Summary?jScript=$jScript && newScript=$newScript && SID=$surveyID' >
                            <img src='../img/summarywhite.png'></a>
                            <span class='tooltipsummary'>Summary</span>
                            
                            <a class='toolr' href='Admin_response?jScript=$jScript && newScript=$newScript && SID=$surveyID' >
                            <img src='../img/responsewhite.png'></a>
                            <span class='tooltips'>Response</span>
                    
                            <button class='toold' onClick='deleteme($surveyID)'>
                            <img src='../img/delete1.png'></button>
                            <span class='tooltipd'>Delete</span>

                            </span><br><br>
                            
                            </div>
                            </div>
                            </div>
                            <br>
                                    ";
                                    }
                            echo "</div>";
                            }
                        }
                    }
                
            
                    }else{

                      
                        $sql = "SELECT Survey_ID, user_ID, Title, Description, Date_created, End_date, Status, Respondents from mysurveytbl WHERE $filter LIKE '%$searchdb%'";
                        $result = $conn-> query($sql);

                        if ($result-> num_rows > 0){
                            
                            while ($row = $result-> fetch_assoc()){
                               
                                $surveyID = $row['Survey_ID'];
                                $userID = $row['user_ID'];
                                $db_title = ucfirst($row['Title']);
                                $db_description = ucfirst($row["Description"]);
                                $db_datecreated = $row["Date_created"];
                                $db_enddate = $row["End_date"];
                                $db_status = $row["Status"];
                                $db_respondents = $row["Respondents"];
                        $query = mysqli_query($conn, "SELECT * FROM userstb WHERE ID = $userID ");
                        $getuser = mysqli_fetch_assoc($query);
                                $userName = $getuser['Name'];

                                $get_record = mysqli_query($conn, "SELECT * FROM respondenttbl WHERE Survey_ID=$surveyID");
                                $Rescount = mysqli_num_rows($get_record);

                                $jScript = md5(rand(1,9));
                                $newScript = md5(rand(1,9));

                            if ($db_status == "Completed") {
                               
                                $color ="green";
                                
                            }else{
  
                                $color ="red";
                            
                            }
                //******************************SHOWING Survey TABLE   */
                            echo "

                            <div class='shadowbox'>
                            <div class='headcontainer'>
                            <CAPTION><span style='padding-left:9px;'>$db_title</span></CAPTION>
                            </div>

                            <div class='bodycontainer'>
                            <CAPTION><span style='color:rgba(0,0,0,.9); padding-left:5px; font-size:0.9em; '>$db_description</span></CAPTION>
                    <hr/>
                            <div class='divNote'>                               
                            <span class='B' style='padding-left:6px; font-size:0.9em;'>$userName</span><br>
                            <span class='A'>Date created:</span>
                            <span class='B'>$db_datecreated</span><span class='A'>-  End Date:</span><span class='B'>$db_enddate</span> <br>
                            <span class='A'>Status: </span>
                            <span class='B' style='color:$color' >$db_status</span> <br>
                            <span class='A'>Respondents: </span>
                            <span class='B'>$Rescount/$db_respondents</span><br>

                            <span class='actionbtn'>

                            <a class='toolsummary' href='Summary?jScript=$jScript && newScript=$newScript && SID=$surveyID' >
                            <img src='../img/summarywhite.png'></a>
                            <span class='tooltipsummary'>Summary</span>
                            
                            <a class='toolr' href='Admin_response?jScript=$jScript && newScript=$newScript && SID=$surveyID' >
                            <img src='../img/responsewhite.png'></a>
                            <span class='tooltips'>Response</span>
                    
                            <button class='toold' onClick='deleteme($surveyID)'>
                            <img src='../img/delete1.png'></button>
                            <span class='tooltipd'>Delete</span>

                            </span><br><br>
                            
                            </div>
                            </div>
                            </div>
                            <br>
                            
                                    
                                  
                                
                                 ";
                                 
                
                            }

                           
                            
                        

                    }else{
                        echo "
                        <div class='headcontainer'>
                        <CAPTION><span>No Record Found</span></CAPTION>
                        </div>    
                        ";
                    }
                    }
                    
                }else{
                    
                    $sql = "SELECT Survey_ID, user_ID, Title, Description, Date_created, End_date, Status, Respondents from mysurveytbl";
                    $result = $conn-> query($sql);

                        if ($result-> num_rows > 0){
                            
                            while ($row = $result-> fetch_assoc()){
                               
                                $surveyID = $row['Survey_ID'];
                                $userID = $row['user_ID'];
                                $db_title = ucfirst($row['Title']);
                                $db_description = ucfirst($row["Description"]);
                                $db_datecreated = $row["Date_created"];
                                $db_enddate = $row["End_date"];
                                $db_status = $row["Status"];
                                $db_respondents = $row["Respondents"];
                        $query = mysqli_query($conn, "SELECT * FROM userstb WHERE ID = $userID ");
                        $getuser = mysqli_fetch_assoc($query);
                                $userName = $getuser['Name'];

                                $get_record = mysqli_query($conn, "SELECT * FROM respondenttbl WHERE Survey_ID=$surveyID");
                                $Rescount = mysqli_num_rows($get_record);

                                $jScript = md5(rand(1,9));
                                $newScript = md5(rand(1,9));

                            if ($db_status == "Completed") {
                               
                                $color ="green";
                                
                            }else{
  
                                $color ="red";
                            
                            }
                //******************************SHOWING Survey TABLE   */
                            echo "

                            <div class='shadowbox'>
                            <div class='headcontainer'>
                            <CAPTION><span style='padding-left:9px;'>$db_title</span></CAPTION>
                            </div>

                            <div class='bodycontainer'>
                            <CAPTION><span style='color:rgba(0,0,0,.9); padding-left:5px; font-size:0.9em; '>$db_description</span></CAPTION>
                    <hr/>
                            <div class='divNote'>                               
                            <span class='B' style='padding-left:6px; font-size:0.9em;'>$userName</span><br>
                            <span class='A'>Date created:</span>
                            <span class='B'>$db_datecreated</span><span class='A'>-  End Date:</span><span class='B'>$db_enddate</span> <br>
                            <span class='A'>Status: </span>
                            <span class='B' style='color:$color' >$db_status</span> <br>
                            <span class='A'>Respondents: </span>
                            <span class='B'>$Rescount/$db_respondents</span><br>

                            <span class='actionbtn'>

                            <a class='toolsummary' href='Summary?jScript=$jScript && newScript=$newScript && SID=$surveyID' >
                            <img src='../img/summarywhite.png'></a>
                            <span class='tooltipsummary'>Summary</span>
                            
                            <a class='toolr' href='Admin_response?jScript=$jScript && newScript=$newScript && SID=$surveyID' >
                            <img src='../img/responsewhite.png'></a>
                            <span class='tooltips'>Response</span>
                    
                            <button class='toold' onClick='deleteme($surveyID)'>
                            <img src='../img/delete1.png'></button>
                            <span class='tooltipd'>Delete</span>

                            </span><br><br>
                            
                            </div>
                            </div>
                            </div>
                            <br>   
                            
                            
                            
                                 ";
                                 
                
                            }   
                           
                    }else{
                        echo "
                        <div class='headcontainer'>
                        <CAPTION><span>No Record Found</span></CAPTION>
                        </div>    
                        ";
                    }
                }

                ?>
                
                        
                        <?php
                        /**Edit button */
                        }else{
                            include 'updating_users.php';
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
                                        window.location.href='delete_Survey?del_id='+delid+'&&pw='+pw+'';
                                    }
                                    
                                }

                            
                        }

                        </script>
                        
            </div>
                
         </div>
  

</body>
</html>
<?php

session_start();
if (isset($_SESSION["email"])) {
    $email = $_SESSION["email"];
}else{
    echo "<script>window.location.href='../Login';</script>";
    
}
include_once '../includes/connection.php';

$sql_query = mysqli_query($conn, "SELECT Name, account_type,ID from userstb WHERE Email='$email'");
$fetch = mysqli_fetch_assoc($sql_query);
$db_id = $fetch['ID'];
$db_name = ucfirst($fetch['Name']);
$db_account_type = $fetch['account_type'];
$db_email = $email;
if ($db_account_type == 1) {
    $account_type = "Administrator";
}else{
    echo "<script>window.location.href='../Login';</script>";
        exit();
}


if (isset($_GET['page'])) {
    $page = $_GET['page'];
    
}else {
    $page = 1;
}
if (isset($_POST['search'])) {
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
    padding: 6px 8px 6px 6px;
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
    width:130px;
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
    padding:2px 6px 2px 6px;
    background:#2e68aa;
    color: #aaaaaa;
    float:right;
    font-size: 25px;
    font-weight: bold;
    margin-right:-10px;
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
.modal-send{
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
.modal-content-send{
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    padding-top:0;
    padding-right:10px;
    border: 1px solid #888;
    width: 30%;
}
.close-send{
    padding:2px 6px 2px 6px;
    background:#2e68aa;
    color: #aaaaaa;
    float:right;
    font-size: 25px;
    font-weight: bold;
    margin-right:-10px;
}
.close-send:hover,
.close-send:focus{
    color:#000;
    text-decoration: none;
    cursor:pointer;
}
.btn-confirm-send{
    border-radius:3px;
    border:none;
    background: #2e68aa;
    font-size:13px;
    font-weight:500;
    color:aliceblue;
    padding:4px;
}
.btn-confirm-send:hover{
    cursor:pointer;
}
#batch{
    width:150px;
    margin-left:5px;
}
.modal-reset{
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
.modal-content-reset{
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    padding-top:0;
    padding-right:10px;
    border: 1px solid #888;
    width: 30%;
}
.close-reset{
    padding:2px 6px 2px 6px;
    background:#2e68aa;
    color: #aaaaaa;
    float:right;
    font-size: 25px;
    font-weight: bold;
    margin-right:-10px;
}
.close-reset:hover,
.close-reset:focus{
    color:#000;
    text-decoration: none;
    cursor:pointer;
}
.btn-confirm-reset{
    border-radius:3px;
    border:none;
    background: #2e68aa;
    font-size:13px;
    font-weight:500;
    color:aliceblue;
    padding:4px;
}
.btn-confirm-reset:hover{
    cursor:pointer;
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
            <!--Modal for Delete -->
            <div class="modal">
                    <div class="modal-content">
                    <span class="close">&times;</span>
                    <p style="color:rgba(0,0,0,0.750); font-size:16px; font-weight:600;"><span style="color:red;"><i class="fa fa-exclamation-triangle"></i>Note:Deleting Survey will also DELETE ALL its response(s) and CAN NOT be UNDO</span><br>
                    Enter your password to continue..</p>
                    <input type="password" name="pw" id="pw" class="pw" placeholder="enter password here.." autofocus>
                    <button class="btn-confirm" >Confirm</button>
                    </div>
                    </div>
             <!--Modal for Reset -->
             <div class="modal-reset">
                    <div class="modal-content-reset">
                    <span class="close-reset">&times;</span>
                    <p style="color:rgba(0,0,0,0.750); font-size:16px; font-weight:600;"><span style="color:red;"><i class="fa fa-exclamation-triangle"></i>Note:Reseting Survey will also DELETE ALL its response(s) and CAN NOT be UNDO</span><br>
                    Enter your password to continue..</p>
                    <input type="password" name="reset" id="reset" class="pw" placeholder="enter password here.." autofocus>
                    <button class="btn-confirm-reset" >Confirm</button>
                    </div>
                    </div>        
                                       
            <!--Modal for Send -->
                    <div class="modal-send">
                    <div class="modal-content-send">
                    <span class="close-send">&times;</span>
                    <p style="margin-left:60px; color:rgba(0,0,0,0.750); font-size:16px; font-weight:600; padding-top:18px;"><span >Send to: </span>
                    
                    <select name="batch" id="batch">
                    <option value=""> Please select batch</option>
                    <?php 
                    $query = mysqli_query($conn, "SELECT year_graduated FROM graduates_infotbl group by year_graduated");
                    while ($fetch = mysqli_fetch_assoc($query)) {
                    $batch = $fetch['year_graduated'];
                    ?>
                     <option value="<?php echo $batch;?>">batch <?php echo $batch;?></option>
                     <?php }?>
                    </select>
                    <button class="btn-confirm-send" >Send</button></p>
                    
        
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
                            <li class="active"><a style="padding-top:20px; padding-bottom:20px;" href="manageusers"><i class="fa fa-users-cog"></i> Manage Users</a></li>
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
         <input type="checkbox" id="D">
         <label for="D"><img class="emaildropdown" src="../img/emaildropdown5.png"></label>
                            <ul>
                                <li><a href="change_adminpass"><i class="fa fa-lock"></i> Change password</a></li>
                                <li><a href="change_adminemail"><i class="fa fa-at"></i> Update Email</a></li>
                                <li><a href="change_admincontact"><i class="fa fa-phone"></i> Update Contact</a></li>
                            </ul>

                            </ul>
        </div>

         <div class="mainpanel">
         <div class="statuspanel">
           
            </div>
           <div class="datapanel">

           

           <CAPTION><h3>Manage Users</h3></CAPTION>
            <?php
            
            if (isset($_POST['search'])) {
                $filter = $_POST['filter'];
                $a = $_POST['searchbox'];
                $searchdb = preg_replace("#[^0-9a-z@. ]#i","",$a);
            }else{
                if(empty($_GET["getUpdate"])){

                    if (isset($_GET['filt'])) {
                        
                        $a = $_GET['filt'];
                        $filter = $_GET['cat'];
                        $searchdb = preg_replace("#[^0-9a-z@. ]#i","",$a);
                    }
                    
                    }else{
                        $searchdb = "";
                    }
            }
        
            ?>
            <center><table border="0" class="searchtable" width="770">
            <tr><td>
            <form align="right"class="searchform" action="" method="POST">
            <input type="text" name="searchbox" placeholder="Filter here..">
            <select name="filter" id="filter">
            
            <option value="Title">Title</option>
            <option value="Date_created">Date Created</option>
            <option value="End_date">End Date</option>
            <option value="Status">Status</option>
            </select>
            <input type="submit" class="searchbtn" name="search" value="Filter">
            </td></tr>
            </form>
            </table></center>

            <a href='Add_grad_survey' class='print_grad' style=''><i class='fa fa-plus'></i> Add Survey</a>
                <table border="0" width="100%" align="center"class="table-stripped" >

                    

                    <thead>
                        <tr height="35"> 
                            
                            <th >Title</th>
                            <th >Description</th>
                            <th >Date_created</th>
                            <th >End_date</th>
                            <th >Status</th>
                            <th >No. of Question</th>
                            <th >Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                    <tr height="30">
                    <td><div class='divText'>Employment Status</div></td>
                    <td><div class='divText'>Current Employment Status</div></td>
                    <td>Pre-made</td>
                    <td>-</td>
                    <td>Active</td>
                    <td><center>1</center></td>
                    <td>
                    <button class='toolr' onClick='sendme(35)'>
                                   <i class='fa fa-paper-plane'></i></button>
                                   <span class='tooltips'>Send</span>
                                   <button class='toolr' onClick='reset(35)'>
                                   <i class='fa fa-undo-alt'></i></button>
                                   <span class='tooltips'>Reset</span>
                                  
                    </td>
                    </tr>     
                                <?php

                            
                            
                                
                               
                                 
                //***************************Update button code start here */ 
                
                                if (empty($_GET["getUpdate"])) {
                                
                                


                                ?>

                                    
                        <?php 

                    
                    if(isset($_POST['search'])){
                     $searchdb = $_POST['searchbox'];
                     $filter = $_POST['filter'];
                     $searchdb = preg_replace("#[^0-9a-z@. ]#i","",$searchdb);
                    }else{
                    if(isset($_GET['filt'])) {
                        $searchdb = $_GET['filt'];
                        $filter = $_GET['cat'];
                        $searchdb = preg_replace("#[^0-9a-z@. ]#i","",$searchdb);
                    }
                }     
            

                    $query = mysqli_query($conn, "SELECT * FROM mysurveytbl WHERE $filter LIKE '%$searchdb%' AND User_ID ='$db_id' AND Survey_ID !='35' AND Survey_type = 'graduates'");
                    $total_count = mysqli_num_rows($query);
                
                    if ($total_count == 0) {
                        echo "<tr><td colspan='7'>
                        <center><b>No Record Found</b></center>
                        </td> </tr>"; 
                                      
                        } else {
                    
                        

                    $sql = "SELECT * from mysurveytbl WHERE $filter LIKE '%$searchdb%' AND User_ID ='$db_id' AND Survey_ID !='35' AND Survey_type = 'graduates' ORDER BY Survey_ID DESC limit $start_from,$num_per_page ";
                    $result = $conn-> query($sql);
                    $showcount = 0;
                    //******************************SHOWING Searchbox TABLE(userstb)   */
                    if ($result-> num_rows > 0){
                        while ($row = $result-> fetch_assoc()){
                            $showcount = $showcount + 1;
                                $surveyID = $row['Survey_ID'];
                                $db_title = $row['Title'];
                                $db_description = $row["Description"];
                                $db_datecreated = $row["Date_created"];
                                $db_enddate = $row["End_date"];
                                $db_status = $row["Status"];
                                

                                $get_question = mysqli_query($conn, "SELECT * FROM questiontbl WHERE Survey_ID=$surveyID");
                                $db_no_question = mysqli_num_rows($get_question);

                        $jScript = md5(rand(1,9));
                        $newScript = md5(rand(1,9));
                        $getEdit = md5(rand(1,9));
                        $getQuestion = md5(rand(1,9));
                        if ($db_status == "Active") {
                               
                            $color ="green";
                            
                        }else{

                            $color ="red";
                        
                        }

            //******************************SHOWING Survey TABLE <img src='../img/responsewhite.png'> <img  src='../img/questionwhite.png'>  <img src='../img/Addreswhite.png'> <img src='../img/delete1.png'>*/
                        
                        echo "<tr height=30>

                                <td><div class='divText'>$db_title</div></td>
                                <td><div class='divText'>$db_description</div></td>
                                <td>$db_datecreated</td>
                                <td>$db_enddate</td>
                                <td><font color=$color>$db_status</font></td>
                                <td><center>$db_no_question</center></td>
                              
                               <td width='125px'>
                               
                               
                               <button class='toolr' onClick='sendme($surveyID)'>
                               <i class='fa fa-paper-plane'></i></button>
                               <span class='tooltips'>Send</span>
                               <a class='toolq' href='graduates_questions?jScript=$jScript && newScript=$newScript && getQuestion=$getQuestion && SID=$surveyID && ID=$db_id' >
                               <i class='fa fa-plus'></i></a>
                               <span class='tooltip'>Add Question</span>
                               <a class='toole' href='edit_grad_survey?jScript=$jScript && newScript=$newScript && getEdit=$getEdit && SID=$surveyID && ID=$db_id' >
                               <i class='fa fa-edit'></i></a>
                               <span class='tooltipe'>Edit</span>
                               <button class='toold' onClick='deleteme($surveyID)'>
                               <i class='fa fa-trash'></i></button>
                               <span class='tooltipd'>Delete</span>
                               </td>                         
                             </tr>
                             </tbody>
                             
                             ";
                            
                        }
                        $total_page = ceil($total_count/$num_per_page);
                            
                            $count_to = $showcount + $start_from;
                            if ($page >=1) {
                                $start_from = $start_from + 1;
                            }
                                echo "</table>
                                <span class='showentries'>Showing $start_from to $count_to of  $total_count entries</span>";
                                
                                echo "<span class='pagination'>";

                                if (isset($_POST['searchbox'])) {
                                    if (isset($_GET['filt'])) {
                                    
                                    $filt = $_POST['searchbox'];
                                    $filt = preg_replace("#[^0-9a-z@. ]#i","",$filt);
                                    $cat = $_POST['filter'];
                                    }                                  
                                }else{
                                    $filt = $searchdb;
                                    $cat = $filter;
                                }
                    
                                if ($page > 1) {
                                    echo "<a href='?page=".($page - 1)."&&filt=".$filt."&&cat=".$cat."' class='prev-button'>Previous</a>";
                                }


                                echo "<button disabled class='page-active'>".$page."<br><span class='mini-page'>Page</span></button>";


                                if ($page != $total_page) {
                                    echo "<a href='?page=".($page + 1)."&&filt=".$filt."&&cat=".$cat."' class='next-button'>Next</a>";
                                }

                                
                            echo "</span>";
                            }
                    }
            
               
                
                ?>
                        
                        <?php
                        } else{
                        
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
                                        window.location.href='del_grad_survey?del_id='+delid+'&&pw='+pw+'';
                                    }
                                    
                                }

                        }


                        var spansend = document.getElementsByClassName("close-send")[0];
                        var modalsend = document.getElementsByClassName("modal-send")[0];
                        var btnsend = document.getElementsByClassName("btn-confirm-send")[0];
                        
                        var spanreset = document.getElementsByClassName("close-reset")[0];
                        var modalreset = document.getElementsByClassName("modal-reset")[0];
                        var btnreset = document.getElementsByClassName("btn-confirm-reset")[0];
                        //close button
                        spansend.onclick = function(){
                            modalsend.style.display = "none";
                        }
                        window.onclick = function(event){
                            if(event.target == modalsend){
                                modalsend.style.display = "none";
                            }
                        }
                        //send/confirm button
                        function sendme(sid){
                            modalsend.style.display = "block";
                           <?php $SID = "<script>sid</script>";?> 
                                    btnsend.onclick = function(){    
                                    var batch = document.getElementById("batch").value;
                                    if (batch != "") {
                                        window.location.href='Send_survey?sid='+sid+'&&batch='+batch+'';
                                    }
                                    
                                }

                            
                        }
                        //close button
                        spanreset.onclick = function(){
                            modalreset.style.display = "none";
                        }
                        window.onclick = function(event){
                            if(event.target == modalreset){
                                modalreset.style.display = "none";
                            }
                        }
                       function reset(delid){

                                    modalreset.style.display = "block";
                                    
                                    btnreset.onclick = function(){    
                                    var reset = document.getElementById("reset").value;
                                    if (reset != "") {
                                        window.location.href='reset_survey?del_id='+delid+'&&pw='+reset+'';
                                    }
                                    
                                }

                        }

                        </script>

                       
         
            </div>
                
         </div>
  

</body>
</html>
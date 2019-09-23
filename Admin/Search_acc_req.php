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
if (isset($_POST['search'])) {
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
    width: 400px;
    border-radius: 5px 5px 0 0;
    box-shadow: 0 0 2em rgba(0,0,0,0.15);
    text-align: left;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.table-stripped th{
    background:#b5c0cce7;
    font-size: 1em;
    font-weight:600;
    color:#191f25;
}

tr td:nth-child[even]{
    background:grey;
}
.table-stripped tbody td{
    border-bottom: 1px solid #7887966c;
    
}
.table-stripped tr td:nth-of-type[even]{
    background-color: black;
}
.table-stripped tbody tr:hover{
    background-color: #bcbcbd88;

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
    cursor:pointer;
    opacity:0.7;
    text-decoration:none;
}
.searchform{
    align: right;
}
.showentries{
    font-size: 0.9em;
    color: rgb(42, 47, 49);   
}
.bt-update{
    border:none;
    background: #2e68aa;
    color:aliceblue;
    border-radius: 3px 3px 3px 3px;
    padding: 6 6 6 6;
    cursor:pointer;
}
.bt-update:hover, .bt-delete:hover{
    opacity:0.7;
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
.datapanel h3{
    margin: 0;
    font-size:1.3em;
    font-weight:400;
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
.btn-update img{
    width:24px;
}
.tooltipu{
    display:none;
}
.bt-update:hover ~ .tooltipu{
    font-weight:bold;
    display:block;
    position:absolute;
    color:black;
    background: #f8fbfc81;
    border: 1px solid grey;
    margin-top:10px;
}
.tooltipd{
    display:none;
}
.bt-delete{
    border-radius: 3px 3px 3px 3px;
    color: aliceblue;
    background: #ff4949;
    padding: 6 6 6 6;
    text-decoration: none;
    border:none;
    cursor: pointer;
}
.bt-delete:hover ~ .tooltipd{
    font-weight:bold;
    display:block;
    position:absolute;
    color:black;
    background: #f8fbfc81;
    border: 1px solid grey;
    margin-left:25px;
    margin-top:10px;
}
.divId{
    width:30px;
    text-overflow: ellipsis;
    overflow: hidden;
    margin:0;
    padding-right:-10;
    
}
.divName{
    width:160px;
    text-overflow: ellipsis;
    overflow: hidden;
    margin:0;
    padding:0;
}
.divContact{
    width:100px;
    text-overflow: ellipsis;
    overflow: hidden;
    margin:0;
    padding:0;
}
.divEmail{
    width:200px;
    text-overflow: ellipsis;
    overflow: hidden;
    margin:0;
    padding:0;
}
.divPassword{
    width:100px;
    text-overflow: ellipsis;
    overflow: hidden;
    margin:0;
    padding:0;
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
                            <li class="active"><a style="padding-top:20px; padding-bottom:20px;" href="account_request"><i class="fa fa-user-plus"></i> Account Requests</a></li>
                            <li><a style="padding-top:20px; padding-bottom:20px;" href="manageusers"><i class="fa fa-users-cog"></i> Manage Users</a></li>
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
                    <li><a style="padding-top:20px; padding-bottom:20px;" href="Allsurveys"><i class="fa fa-sign-out-alt"></i> Feedback</a></li>
                    
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
         <?php
                    
                    if (empty($_GET['notify'])) {
                        echo " ";
                    } else {
                        echo "<br><h5 class='hnoti'><font color='green'><i class='fa fa-check-circle'> ". $_GET['notify'] ."</i></font></h5>";
                        $_GET['notify'] = "";
                    }

                     
                    if (empty($_GET['notifyerr'])) {
                        echo " ";
                    } else {
                        echo "<br><h5 class='hnoti'><font color='red'><i class='fa fa-exclamation-circle'> ". $_GET['notifyerr'] ."</i></font></h5>";
                        unset($_GET['notifyerr']);
                        
                    }


                ?> 
            </div>
           <div class="datapanel">

           

           <CAPTION><h3>Account Request</h3></CAPTION>
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
            <input type="text" name="searchbox" placeholder="Filter here.." value="<?php echo $searchdb; ?>">
            <select name="filter" id="filter">
                                            
            <option value="Name">Name</option>
            <option value="Email">Email</option>
            <option value="Contact">Contact</option>
            </select>
            <input type="submit" class="searchbtn" name="search" value="Filter">
            </td></tr>
            </form>
            </table></center>
                <table border="0" width="500" align="center"class="table-stripped" >
                    <thead>
                    <tr height="30"> 
                            <th>ID</th>
                            <th>Name</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Actions</th>

                        </tr>
                    </thead>
      
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
            

                    $query = mysqli_query($conn, "SELECT * FROM acc_req_db WHERE $filter LIKE '%$searchdb%' AND account_type !='1'");
                    $total_count = mysqli_num_rows($query);
                
                    if ($total_count == 0) {
                        echo "<tr><td colspan='6'>
                        <center><b>No Record Found</b></center>
                        </td> </tr>"; 
                                      
                        } else {
                    
                        

                    $sql = "SELECT ID, Name, Contact, Email, Password from acc_req_db WHERE $filter LIKE '%$searchdb%' AND account_type !='1' ORDER BY ID DESC limit $start_from,$num_per_page";
                    $result = $conn-> query($sql);
                    $showcount = 0;
                    //******************************SHOWING Searchbox TABLE(userstb)   */
                    if ($result-> num_rows > 0){
                        while ($row = $result-> fetch_assoc()){
                            $showcount = $showcount + 1;
                            $db_id = $row['ID'];
                                $db_name = ucfirst($row['Name']);
                                $db_contact = $row["Contact"];
                                $db_email = $row["Email"];
                                $db_password = $row["Password"];
                                

                            $jScript = md5(rand(1,9));
                            $newScript = md5(rand(1,9));
                            $getUpdate = md5(rand(1,9));
                            $getDelete = md5(rand(1,9));
                          
                            
                                

                //*******************************SHOWING ACCOUNT REQUEST TABLE(acc_req_db)   */
                            echo " <tbody>
                                    <tr height=30>

                                    <td width='30px'><div class='divId'>$db_id</div></td>
                                    <td width='160px'><div class='divName'>$db_name</div></td>
                                    <td width='100px'><div class='divContact'>$db_contact</div></td>
                                    <td width='200px'><div class='divEmail'>$db_email</div></td>
                                    <td width='100px'><div class='divPassword'>$db_password</div></td>
                                                                
                                

                                   <td width='60px'>
                                   <button onClick='approvedme($db_id)' class='bt-update' >
                                   <i class='fa fa-plus'></i></button>
                                   <span class='tooltipu'>Approve Request</span>
                                   <button onClick='deleteme($db_id)' class='bt-delete'>
                                   <i class='fa fa-trash-alt'></i></button>
                                   <span class='tooltipd'>Delete Request</span>
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
                        
        
                        <script language="javascript">
                        //**************************function for approve button
                        function approvedme(approvedid){

                                if (confirm("Confirm Action..")) {

                                    window.location.href='approved.php?apprv_id='+approvedid+'';
                                    return true;
                                        }
                                    }
                        //**************************function for delete button
                        function deleteme(delid){

                                if (confirm("do you want to delete?")) {

                                    window.location.href='acc_req_del.php?del_id='+delid+'';
                                    return true;
                                        }
                                    }

                        </script>
                       
         
            </div>
                
         </div>
  

</body>
</html>
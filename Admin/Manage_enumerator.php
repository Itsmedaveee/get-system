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

//set variable page, start from and num per page
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
    width: 400px;
    border-radius: 5px 5px 0 0;
    box-shadow: 0 0 2em rgba(0,0,0,0.15);
    text-align: left;
    white-space: nowrap;
    
}

.table-stripped th{
    background:#b5c0cce7;
    font-size: 1em;
    color:#191f25;
}
.datapanel h3{
    font-size:1.3em;
    font-weight:400;
}
.table-stripped tbody td{
    border-bottom: 1px solid #7887966c;
    
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
.bt-update{
    background: #2e68aa;
    color:aliceblue;
    border-radius: 3px 3px 3px 3px;
    padding: 4 5 5 5;
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
    margin-left:30px;
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
.addenum:hover{
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
                            <li><a style="padding-top:20px; padding-bottom:20px;" href="account_request"><i class="fa fa-user-plus"></i> Account Requests</a></li>
                            <li><a style="padding-top:20px; padding-bottom:20px;" href="manageusers"><i class="fa fa-users-cog"></i> Manage Users</a></li>
                            <li class="active"><a style="padding-top:20px; padding-bottom:20px;" href="Manage_enumerator"><i class="fa fa-users"></i> Enumerators</a></li>
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
           <?php
                    
                    if (empty($_GET['notify'])) {
                        
                        echo "";
                    } else {
                        echo "<br><h5 class='hnoti'><font color='green'><i class='fa fa-check-circle'> ". $_GET['notify'] ."</i></font></h5>";
                       unset($_GET['notify']);
                    }
                ?>
            </div>
           <div class="datapanel">

           

           <CAPTION><h3>Manage Enumerators</h3></CAPTION>
            <?php
            
            

            ?>
            <script>
            function Addenum(){
                window.location.href='Add_enumerator';
            }
            </script>

            <center><table border="0" class="searchtable" width="770">
            <tr><td>
            
            <form align="right"class="searchform" action="" method="POST">
            
            <input type="text" name="searchbox" placeholder="Filter here..">
            <select name="filter" id="filter">
            
            <option value="Name">Name</option>
            <option value="Email">Email</option>
            <option value="Contact">Contact</option>
            </select>
            <input type="submit" class="searchbtn" name="search" value="Filter"><br>
            
            </td></tr>
            </form>
            </table></center>

            <button onclick="Addenum()" class="addenum" style="margin:0; padding:4; background:#2e68aa; color:aliceblue; border:0; border-radius: 3px 3px 3px 3px; cursor:pointer;"><img src="" alt="">+ Add Enumerator</button>
                <table border="0" width="500" align="center"class="table-stripped" >

                    

                    <thead>
                        <tr height="30"> 
                            <th width='30px'>ID</th>
                            <th width='160px'>Name</th>
                            <th width='100px'>Contact</th>
                            <th width='200px'>Email</th>
                            <th width='80px'>Actions</th>

                        </tr>
                    </thead>

                            <?php
                //**************************Filtering code start here */
                                if (!isset($_POST['search'])) {
                                    
                            ?>
                        
                                <?php
                //***************************Update button code start here */        
                                if (empty($_GET["getUpdate"])) {
                                
                                


                                ?>

                                    
                        <?php 
                //***************************Showing all enumerators */ 
                $query = mysqli_query($conn, "SELECT * FROM enumeratortbl");
                        $total_count = mysqli_num_rows($query);
                        if ($total_count == 0) {
                            echo "<tr><td>
                            <center><b>No Record Found</b></center>
                            </td></tr></table>";
                        } else {

                        $sql = "SELECT EID, Name, Contact, Email FROM enumeratortbl limit $start_from,$num_per_page ";
                        $result = $conn-> query($sql);

                        if ($result-> num_rows > 0){
                            
                            $showcount = 0;
                            while ($row = $result-> fetch_assoc()){
                                $showcount = $showcount + 1;
                                $db_id = $row['EID'];
                                $db_name = ucfirst($row['Name']);
                                $db_contact = $row["Contact"];
                                $db_email = $row["Email"];
                                

                            $jScript = md5(rand(1,9));
                            $newScript = md5(rand(1,9));
                            $getUpdate = md5(rand(1,9));
                            $getDelete = md5(rand(1,9));
                                
                
                            echo "<tbody><tr height=30>

                                    <td width='30px'><div class='divId'>$db_id</div></td>
                                    <td width='160px'><div class='divNAme'>$db_name</div></td>
                                    <td width='100px'><div class='divContact'>$db_contact</div></td>
                                    <td width='200px'><div class='divEmail'>$db_email</div></td>
                                    
                                  
                                   <td width='60px'><a href=' ?jScript=$jScript && newScript=$newScript && getUpdate=$getUpdate && ID=$db_id' class='bt-update'>
                                   <i class='fa fa-edit'></i></a>
                                   <span class='tooltipu'>Update</span>
                                   <button onClick='deleteme($db_id)' class='bt-delete'>
                                   <i class='fa fa-trash-alt'></i></button>
                                   <span class='tooltipd'>Delete</span>
                                   </td>                         
                                 </tr>
                                 </tbody>
                                 
                                 ";
                                 
                
                            }

                        //Next And Prev buttons
                            $total_page = ceil($total_count/$num_per_page);
                                
                                $count_to = $showcount + $start_from;
                                if ($page >= 1) {
                                    $start_from = $start_from + 1;
                                }
                                    echo "</table>
                                    <span class='showentries'>Showing $start_from to $count_to of  $total_count entries</span>";
                                    
                                    echo "<span class='pagination'>";
                        
                                    if ($page > 1) {
                                        echo "<a href='Manage_enumerator?page=".($page - 1)."' class='prev-button'>Previous</a>";
                                    }


                                    echo "<button disabled class='page-active'>".$page."<br><span class='mini-page'>Page</span></button>";


                                    if ($page != $total_page) {
                                        echo "<a href='Manage_enumerator?page=".($page + 1)."' class='next-button'>Next</a>";
                                    }

                                  
                                echo "</span>";


                                
                        

                    }else{
                        echo "<tr><td>
                            <center><b>No Record Found</b></center>
                            </td></tr></table>";
                    }
                }
                ?>
                        
                        <?php
                        }else{

                        include 'updating_enum.php';
                        }
                        ?>

                        <?php

                        }else{

                            $preg_rep = $_POST['searchbox'];
                            $preg_rep = preg_replace("#[^0-9a-z@. ]#i","",$preg_rep);
                            echo "<script>window.location.href='Search_enum?filt=".$preg_rep."&&cat=".$_POST['filter']."';</script>";

                            } 
                        
                    
                        ?>
        
                        <script language="javascript">

                        function deleteme(delid){

                        if (confirm("Youre about to delete Enumerator, continue?")) {

                                window.location.href='confirm_enum_delete?del_id='+delid+'';
                                    return true;
                                    }
                                }

                        </script>
                       
         
            </div>
                
         </div>
  

</body>
</html>
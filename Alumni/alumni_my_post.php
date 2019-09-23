<?php
 $encrypted = md5(rand(1,9));
 session_start();
 if (isset($_SESSION["email"])) {
     $email = $_SESSION["email"];
 }else{
     echo "<script>window.location.href='../Login';</script>";
     
 }
 
 include_once '../includes/connection.php';
 
 $sql_query = mysqli_query($conn, "SELECT ID, Name, account_type, Password from userstb WHERE Email='$email'");
 $fetch = mysqli_fetch_assoc($sql_query);
 $db_name = ucfirst($fetch['Name']);
 $db_account_type = $fetch['account_type'];
 $db_pass = $fetch['Password'];
 $ID = $fetch['ID'];
 $db_email = $email;
 $sql = mysqli_query($conn, "SELECT Stud_No from graduates_infotbl WHERE UID='$ID'");
 $fetchSN = mysqli_fetch_assoc($sql);
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
.bt-update {
    background: #2e68aa;
    border-radius: 3px 3px 3px 3px;
    padding: 12 6 0 6;
}
.bt-update:hover {
    opacity:0.7;
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
.tooltipv{
    display:none;
}
.bt-view{
    color:aliceblue;
    background: #2e68aa;
    border-radius: 3px 3px 3px 3px;
    padding: 4 3 4 4;
}
.bt-view:hover{
    opacity:0.7;
}
.bt-view:hover ~ .tooltipv{
    font-weight:bold;
    display:block;
    position:absolute;
    color:black;
    background: #f8fbfc81;
    border: 1px solid grey;
    margin-top:10px;
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
    font-family: Georgia;
    color: #ffffff;
    font-size: 16px;
    background: #ff4949;
    padding: 3 5 5 4;
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
    width:100px;
    text-overflow: ellipsis;
    overflow: hidden;
    margin:0;
    padding-right:-10;
    
}
.divText{
    width:170px;
    text-overflow: ellipsis;
    overflow: hidden;
    margin:none;
    padding:none;
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
         <input type="checkbox" id="E">
         <label for="E"><img class="emaildropdown" src="../img/emaildropdown5.png"></label>
                            <ul>
                                <li><a href="change_userpass"><i class="fa fa-lock"></i>&nbsp Change password</a></li>
                                <li><a href="alumni_personal_info"><i class="fa fa-user-cog"></i> Personal Info</a></li>
                                

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
                <div class="datapanel">
                
                <CAPTION><h3>My Job Offerings</h3></CAPTION>
          

            <center><table border="0" class="searchtable" width="770">
            <tr><td>
            
            <form align="right"class="searchform" action="" method="POST">
            
            <input type="text" name="searchbox" placeholder="Filter here..">
            <select name="filter" id="filter">
            <option value="title">Job Title</option>
            <option value="company">Company</option>
            <option value="location">Location</option>
           
            </select>
            <input type="submit" class="searchbtn" name="search" value="Filter">
            
            </td></tr>
            </form>
            </table></center>

            <button onclick="jobs()" class="addenum" style="margin:0; padding:4; background:#2e68aa; color:aliceblue; border:0; border-radius: 3px 3px 3px 3px; cursor:pointer;"><img src="" alt=""><i class="fa fa-briefcase"></i> All Job Offerings</button>
            <button onclick="addjobs()" class="addenum" style="margin:0; padding:4; background:#2e68aa; color:aliceblue; border:0; border-radius: 3px 3px 3px 3px; cursor:pointer;"><img src="" alt=""><i class="fa fa-briefcase-medical"></i> Add Job Offerings</button>
            
           
                <table border="0" width="500" align="center"class="table-stripped" >

                    

                    <thead>
                        <tr height="30"> 
                            <th >Job Title</th>
                            <th>Company</th>
                            <th >Location</th>
                            <th >Actions</th>
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
                        $query = mysqli_query($conn, "SELECT * FROM job_offeringtbl WHERE UID = $ID");
                        $total_count = mysqli_num_rows($query);
                        if ($total_count == 0) {
                            echo "<tr><td colspan='4'>
                            <center><b>No Record Found</b></center>
                            </td></tr></table>";
                        } else {

                        $sql = "SELECT * FROM job_offeringtbl WHERE UID = $ID order by JID desc limit $start_from,$num_per_page ";
                        $result = $conn-> query($sql);

                        if ($result-> num_rows > 0){
                            
                            $showcount = 0;
                            while ($row = $result-> fetch_assoc()){
                                $showcount = $showcount + 1;
                                $JID = $row['JID'];
                                $title = $row['title'];
                                $company = ucfirst($row['company']);
                                $location = $row["location"];
                               
                                

                            $jScript = md5(rand(1,9));
                            $newScript = md5(rand(1,9));
                            $getUpdate = md5(rand(1,9));
                            $getDelete = md5(rand(1,9));
                                
                
                            echo "<tbody><tr height=30>
                                    <td ><div class='divText'>$title</div></td>
                                    <td ><div class='divText'>$company</div></td>
                                    <td ><div class='divText'>$location</div></td>
                                    
                                  
                                   <td width='80px'>
                                   <a href='alumni_job_details?jScript=$jScript && newScript=$newScript && view=$getUpdate && JID=$JID' class='bt-view'>
                                   <i class='fa fa-eye'></i></a>
                                   <span class='tooltipv'>View more details</span>
                                   <a href='alumni_update_post?jScript=$jScript && newScript=$newScript && view=$getUpdate && JID=$JID' class='bt-view'>
                                   <i class='fa fa-edit'></i></a>
                                   <span class='tooltipv'>Edit</span>
                                   <button onClick='deleteme($JID)' class='bt-delete'>
                                   <i class='fa fa-trash'></i></button>
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
                            echo "<script>window.location.href='Search_grad?filt=".$preg_rep."&&cat=".$_POST['filter']."';</script>";

                            } 
                        
                    
                        ?>
        
                        <script language="javascript">

                        function deleteme(delid){

                        if (confirm("Youre about to delete Alumni, continue?")) {

                                window.location.href='alumni_del_job?del_id='+delid+'';
                                    return true;
                                    }
                                }

                            function addjobs(){
                                window.location.href='alumni_add_job';
                            }
                            function jobs(){
                                window.location.href='alumni_job_offerings';
                            }
                          

            </script>


                
                </div>
                
        </div>
  

</body>
</html>
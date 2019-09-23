<?php

session_start();
if (isset($_SESSION["email"])) {
    $email = $_SESSION["email"];
}else{
    echo "<script>window.location.href='../Login';</script>";
    
}
include_once '../includes/connection.php';
$sql_query = mysqli_query($conn, "SELECT ID,Name, account_type, Password from userstb WHERE Email='$email'");
$fetch = mysqli_fetch_assoc($sql_query);
$db_name = ucfirst($fetch['Name']);
$db_account_type = $fetch['account_type'];
$db_id = $fetch['ID'];
$db_email = $email;

if ($db_account_type == 2) {
    $account_type = "Data Processor/Encoder";
    
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
    font-size: 16px;
    background: #ff4949;
    padding: 1px 5px 3px 5px;
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
    font-size: 16px;
    background: #2e68aa;
    padding: 11px 5px 0px 5px;
    text-decoration: none;
    border:none;
    cursor: pointer;
}
.toole{
    border-radius: 3px 3px 3px 3px;
    color: #ffffff;
    font-size: 16px;
    background: #2e68aa;
    padding: 11px 5px 0px 5px;
    text-decoration: none;
    border:none;
    cursor: pointer;
}
.toolq{
    border-radius: 3px 3px 3px 3px;
    color: #ffffff;
    font-size: 16px;
    background: #2e68aa;
    padding: 11px 5px 0px 5px;
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
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/main.css">
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
                   <li class="current"><a href="../logout">Logout</a></li>
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

                

                <div class="item">
                    <input type="checkbox" id="B">
                    <img src="../img/emaildropdown5.png" class="arrow"><label for="B">SURVEYS</label>
                    <ul>
                        <li><a href="add_usersurvey">Add Survey</a></li>
                        <li><a href="#">My Surveys</a></li>
                    </ul>
                </div>

                
                
            </div>
         </div>
         <div class="dropdownnav">
         <input type="checkbox" id="D">
         <label for="D"><img class="emaildropdown" src="../img/emaildropdown5.png"></label>
                            <ul>
                                <li><a href="change_userpass">Change password</a></li>
                                <li><a href="change_useremail">Update Email</a></li>
                                <li><a href="change_usercontact">Update Contact</a></li>
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
           <div class="datapanel">

           

           <CAPTION><h3>My Surveys</h3></CAPTION>
            <?php
            
            

            ?>
            <center><table border="0" class="searchtable" width="770">
            <tr><td>
            <form align="right"class="searchform" action="" method="POST">
            <input type="text" name="searchbox" placeholder="Filter here..">
            <select name="filter" id="filter">
            
            <option value="Survey_ID">ID</option>
            <option value="Title">Title</option>
            <option value="Date_created">Date Created</option>
            <option value="End_date">End Date</option>
            <option value="Status">Status</option>
            </select>
            <input type="submit" class="searchbtn" name="search" value="Filter">
            </td></tr>
            </form>
            </table></center>


                <table border="0" width="100%" align="center"class="table-stripped" >

                    

                    <thead>
                        <tr height="35"> 
                            <th >ID</th>
                            <th >Title</th>
                            <th >Description</th>
                            <th >Date_created</th>
                            <th >End_date</th>
                            <th >Status</th>
                            <th >Respondents</th>
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
                                    
                        $query = mysqli_query($conn, "SELECT * FROM mysurveytbl WHERE user_ID = $db_id ");
                        $total_count = mysqli_num_rows($query);
                        if ($total_count == 0) {
                            echo "<tr><td>
                            <center><b>No Record Found</b></center>
                            </td></tr></table>";
                        } else {
            
                        $sql = "SELECT Survey_ID, Title, Description, Date_created, End_date, Status, Respondents FROM mysurveytbl WHERE user_ID = $db_id limit $start_from,$num_per_page ";
                        $result = $conn-> query($sql);

                        if ($result-> num_rows > 0){
                            $showcount = 0;
                            while ($row = $result-> fetch_assoc()){
                                $showcount = $showcount + 1;
                                $surveyID = $row['Survey_ID'];
                                $db_title = $row['Title'];
                                $db_description = $row["Description"];
                                $db_datecreated = $row["Date_created"];
                                $db_enddate = $row["End_date"];
                                $db_status = $row["Status"];
                                $db_respondents = $row["Respondents"];

                                $get_record = mysqli_query($conn, "SELECT * FROM respondenttbl WHERE Survey_ID=$surveyID");
                                $Rescount = mysqli_num_rows($get_record);

                            $jScript = md5(rand(1,9));
                            $newScript = md5(rand(1,9));
                            $getResponse = md5(rand(1,9));
                            $getQuestion = md5(rand(1,9));
                            $getEdit = md5(rand(1,9));
                            $getDelete = md5(rand(1,9));

                            if ($db_status == "Completed") {
                               
                                $color ="green";
                                
                            }else{
  
                                $color ="red";
                            
                            }
                //******************************SHOWING Survey TABLE   */
                            echo "<tbody><tr height=30>

                                    <td width='30px'>$surveyID</td>
                                    <td><div class='divText'>$db_title</div></td>
                                    <td><div class='divText'>$db_description</div></td>
                                    <td>$db_datecreated</td>
                                    <td>$db_enddate</td>
                                    <td><font color=$color>$db_status</font></td>
                                    <td>$Rescount/$db_respondents</td>
                                  
                                   <td width='125px'>
                                   <a class='toolq' href='Questionnaire?jScript=$jScript && newScript=$newScript && getQuestion=$getQuestion && SID=$surveyID && ID=$db_id' >
                                   <img  src='../img/questionwhite.png'></a>
                                   <span class='tooltip'>Questionnaire</span>
                                   <a class='toolr' href='user_response?jScript=$jScript && newScript=$newScript && getResponse=$getResponse  && SID=$surveyID && ID=$db_id' >
                                   <img src='../img/responsewhite.png'></a>
                                   <span class='tooltips'>Response</span>
                                   <a class='toole' href='Add_response?jScript=$jScript && newScript=$newScript && getEdit=$getEdit && SID=$surveyID && ID=$db_id' >
                                   <img src='../img/Addreswhite.png'></a>
                                   <span class='tooltipe'>Add Response</span>
                                   <button class='toold' onClick='deleteme($surveyID)'><img src='../img/delete1.png'></button>
                                   <span class='tooltipd'>Delete</span>
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
                            echo "<script>window.location.href='Search_userSurvey?filt=".$preg_rep."&&cat=".$_POST['filter']."';</script>";
                        }
                        ?>
                      

                        


                        <script language="javascript">

                        function deleteme(delid){

                        if (confirm("Youre about to DELETE Survey, continue?")) {

                            window.location.href='delete_usersurvey?del_id='+delid+'';
                        return true;
                            }
                        }

                </script>
                       
         
            </div>
                
         </div>
  

</body>
</html>
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


if (!empty($_GET['SID'])) {
    $surveyID = $_GET['SID'];
}



?>
<style>
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
    text-decoration: underline;
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
    background: #green;

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
    padding: 1px 5px 2px 5px;
    text-decoration: none;
    border:none;
    cursor: pointer;
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
  margin-left:18px;
  border-radius: 3px 3px 3px 3px;
  text-decoration:none;
  padding:10px 6px 2px 6px;
  background:#49ffb3;
  
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
.actionbtn{
    position:relative;
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
                        <li><a href="user_survey">My Surveys</a></li>
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

           <CAPTION><h3>My Responses</h3></CAPTION><br>
           <?php
            $queryss = mysqli_query($conn, "SELECT * FROM respondenttbl WHERE Survey_ID = $surveyID");
            $r1 = mysqli_num_rows($queryss);
            if ($r1 == 0) {
                $hidden = "style='display:none;'";

            }else{
                $hidden = "";
            }

            ?>
            <script>
            function Addenum(sid){
                window.location.href='Add_response?SID='+sid+'';
            }
            </script>
                <button onclick="Addenum(<?php echo $surveyID;?>)" style="cursor:pointer; margin:0; padding:4; background:#2e68aa; color:aliceblue; border:0; border-radius: 3px 3px 3px 3px;"><img src="" alt="">+ Add Response</button>
                <span style="margin-left:500px; color:rgba(0,0,0,.750); text-decoration:underline;">Total Response(s): <?php echo $r1;?></span>
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
                    ?>
                    <?php 


                //***************************Showing all Surveys  */ 
                    
                    //LOOP TO DISPLAY QUESTIONNAIRE
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
                             <a href='Individual_response?page=$page&&SID=$surveyID' class='openbtn'>
                             <img src='../img/open.png'></a>
                             <span class='viewtooltip'>View Individually</span>
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
                                
 //******************************SHOWING Responses in TABLE   */
                
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
                            $c = 0;
                                while ($rowresponse = $resultresponse-> fetch_assoc()){
                                    $Response = $rowresponse['Response'];
                                    
                                    if ($Response == "Not Answered") {
                                        $color = "style='color:red'";
                                    }else{
                                        $color ="";
                                    }
                                    
                                    if ($QuestionType == "Checkbox") {
                                        $c = $c + 1;
                                                if ($Response == "Not Answered") {
                                                    echo "<span $color>".$Response."</span>";
                                                }else{
                                                    if ($othercount > 0) {
                                                        echo "<span>, ".$Response."</span>";
                                                    }else{

                                                        if ($resultresponse-> num_rows > 1) {
                                                            if ($c != $resultresponse-> num_rows) {
                                                                echo "<span>".$Response.", </span>";
                                                            }else{
                                                                echo "<span>".$Response."</span>";
                                                            }
                                                                
                                                        }else{
                                                            echo "<span>".$Response."</span>";
                                                        }
                                                        
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
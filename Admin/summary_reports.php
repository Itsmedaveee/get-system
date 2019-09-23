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

if (!empty($_GET['SID'])) {
    $surveyID = $_GET['SID'];
}
if (!empty($_GET['qid'])) {
    $QIDc = $_GET['qid'];
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
.scroller{
    background:rgba(0,0,0,.150);
    max-width:802px;
    height: 390px;
    overflow-y:scroll;
}
#question{
    cursor:pointer;
    font-size:1em;
    font-weight:600;
    outline:none;
    color:#fff;
    border:none;
    background:#03254c;
    width:802px;
    max-width:802px;
    height:35px;
}
#question:hover{
    opacity:0.7;
}
option{
    font-size:1em;
    background:#1166b1;
}
.Results{
    max-width:735px;
    background:aliceblue;
    margin-top:20px;
    margin-left:20px;
    box-shadow: 0 0 5px rgba(0,0,0,.250);
    
}
.divchoice{
    width:150px;
    max-width:150px;
    font-size:1em;
    font-weight:600;
    color:rgb(48, 133, 207);
    overflow:hidden;
    text-overflow:ellipsis;
}
.divbatch{
    color:#444444;
    width:50px;
    max-width:50px;
    text-align:center;
    font-weight:600;
}
.divcount{
    color:#444444;
    width:50px;
    max-width:50px;
    text-align:center;
    font-weight:600;
}
th .divchoice{
    width:150px;
    max-width:150px;
    font-size:1em;
    font-weight:600;
    color:rgb(48, 133, 207);
    overflow:hidden;
    text-overflow:ellipsis;
}
th .divbatch{
    color:rgb(48, 133, 207);
    width:50px;
    max-width:50px;
    text-align:center;
    font-weight:600;
}
th .divcount{
    color:rgb(48, 133, 207);
    width:50px;
    max-width:50px;
    text-align:center;
    font-weight:600;
}
.tableresult{
    width:100%;
    border-collapse:collapse;
    margin-bottom:40px;
}
.tableresult td{
    
    line-height:2;
    border-bottom:1px solid rgba(0,0,0,.400);
}
.tableresult th{
    background:#b5c0cce7;
    color:#1167b1;
}
#Doughnutchart{ 
    margin-left:110px;
    max-width:500px;
    max-height:500px;
}
#Barchart{
    margin-left:110px;
    max-width:500px;
    max-height:500px;  
}
.dlbtn{
    cursor:pointer;
    margin:0;
    float:right;
    margin-right:20px;
    border:0;
    border-radius:25px;
    background:rgb(48, 133, 207);
    
}
.dlbtn:hover{
    opacity:0.7;
}
.dl1btn:hover{
    opacity:0.7;
}
.dl1btn{
    cursor:pointer;
    margin:0;
    float:right;
    margin-right:20px;
    border:0;
    border-radius:25px;
    background:rgb(48, 133, 207);
    
}
.pdfbtn{
    width:50px; 
    border-radius:25px; 
    box-shadow:0px 0px 5px rgba(0,0,0,.650); 
    background:grey;
}
.tooltipx{
    display:none;
}
.pdfbtn:hover ~ .tooltipx{
    font-size:.8em;
    font-weight:700;
    border: 2px solid rgba(0,0,0,.1);
    color:rgba(0,0,0,.6);
    display:inline;
    position:absolute;
    width:120px;
}
.pdfbtn:hover{
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
    <script src="../Chartjs/Chart.min.js"></script>
    <script src="../Chartjs/chartjs-plugin-datalabels.min.js"></script>
    <script src="../js/jQuery.js"></script>

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
        //PDF button
           $queryRes = mysqli_query($conn, "SELECT * FROM admin_respondenttbl WHERE Survey_ID = $surveyID");
           $totalRes = mysqli_num_rows($queryRes);
           if ($totalRes > 0) {

               $encrypt = md5(rand(1,9));
               $encrypt1 = md5(rand(1,9));
               $encrypt2 = md5(rand(1,9));
           ?>
           
           <a style="position:absolute; margin-left:805px; margin-top:15px;" href="../TCPDF/User/print_summary?<?php echo $encrypt.$encrypt1.$encrypt2; ?>&&SID=<?php echo $surveyID; ?>" target="_blank">
           <img class="pdfbtn" src="../img/pdf.ico">
           <span class="tooltipx">Export Data to PDF</span>
           </a>
           <?php } ?>

           <div class="datapanel">
           
           <caption><h3>Summary</h3></caption><br>
           
              <select name="Questions" id="question" onchange="SelectQuestion()">
              <option value=''>< Select Question To Display ></option>
                <?php 
                

                
                $query = mysqli_query($conn, "SELECT * FROM questiontbl WHERE Survey_ID = $surveyID");
                $Questioncount = mysqli_num_rows($query);
                if ($Questioncount > 0 && $totalRes > 0) {
                
                while($result = mysqli_fetch_assoc($query)){
                        $QID = $result['QuestionID'];
                        $Qtype = $result['QuestionType'];
                        $Question = $result['Question'];
                      if ($Qtype == "Checkbox" || $Qtype == "Multiplechoice") {
                         
                        echo "<option value='$QID'>".$Question."</option>";
                        if (empty($QIDc)) {
                            $QIDc = $QID;
                        }
                      }
                }

                ?>
                </select> 

                <div class="scroller">

                <!-- summary table start -->
                <div class='Results'>
               
                        <?php 
                        
                        if (!empty($QIDc)) {
                           
                        $chartAnswer = '';
                        $chartPercent = '';
                        $chartCount = '';
                        $count = 0;

                    $query = mysqli_query($conn, "SELECT * FROM questiontbl WHERE Survey_ID = $surveyID AND QuestionID = $QIDc");
                    while($result = mysqli_fetch_assoc($query)){
                            $QID = $result['QuestionID'];
                            $Qtype = $result['QuestionType'];
                            $Question = $result['Question'];
                            if ($Qtype == "Checkbox" || $Qtype == "Multiplechoice") {
                                
                            echo "  
                            <center><h3 style='color:#fff; line-height:1.7; font-size:1.3em; font-weight:500; background:rgb(48, 133, 207); overflow:hidden; text-overflow:ellipsis; text-decoration:none;'>$Question<h3></center>
                            <br>
                            <table class='tableresult'>
                                <tr>
                                    <th><div class='divchoice'>Choices</div></th>";
                    $batch_chart = "";
                    $batches = array();
                    $querybatch = mysqli_query($conn, "SELECT * FROM sent_surveytbl WHERE Survey_ID = $surveyID order by batch asc");
                    while($resultbatch = mysqli_fetch_assoc($querybatch)){
                        $batch = $resultbatch['batch'];
                        $batches[] = $batch;
                        $batch_chart = $batch_chart.$batch.",";
                                   echo "<th><div class='divbatch'>$batch</div></th>";
                                }
                                  echo "<th><div class='divcount'>Total</div></th>
                                </tr>";

                    //answers from choices query
                    $batchcount_chart = "";
                    $choices_count = array();
                    $choices = array();            
                    $query2 = mysqli_query($conn, "SELECT * FROM answertbl WHERE Question_ID = $QIDc ");
                    while($result2 = mysqli_fetch_assoc($query2)){
                                $AID = $result2['Answer_ID'];
                                $Answer = $result2['Answer'];
                                $CutAnswer = substr($Answer, 0 ,30);
                                $choices[] = $CutAnswer;
                                if (strlen($CutAnswer) == 30) {
                                    $CutAnswer.="..";
                                }
                                
                        $queryAns = mysqli_query($conn, "SELECT * FROM admin_responsetbl WHERE Question_ID = $QID AND Response ='$Answer'");
                        $count = mysqli_num_rows($queryAns);

                        $chartCount = $chartCount.$count.',';
                        $chartAnswer = $chartAnswer.'"'.$CutAnswer.'",';
                       
                                echo "<tr><td>
                                <div class='divchoice'>$CutAnswer</div></td>";
                                $resultcount_chart = "";
                                foreach ($batches as $batchs) {
                                $queryb = mysqli_query($conn, "SELECT * FROM admin_respondenttbl WHERE batch = $batchs");
                                $res = mysqli_fetch_assoc($queryb);
                                $ARID = $res['AR_ID'];
                                    $querybatchs = mysqli_query($conn, "SELECT * FROM admin_responsetbl WHERE AR_ID = '$ARID' AND Question_ID = $QIDc AND Response = '$Answer'");
                                    $resultcount = mysqli_num_rows($querybatchs);
                                    $resultcount_chart = $resultcount_chart.$resultcount.",";
                                        echo "<td><div class='divbatch'>$resultcount</div></td>";
                                
                                }
                                $resultcount_chart =trim($resultcount_chart,",");
                                $choices_count[] = $resultcount_chart;
                                echo "<td><div class='divcount'>$count</div>
                                      </td></tr>";
                            }
                            //for other answer query
                            $queryother = mysqli_query($conn, "SELECT * FROM otherstbl WHERE Question_ID = $QID");
                            $countother = mysqli_num_rows($queryother);
                            
                           
                            
                            //displaying others response        
                            if ($countother > 0) {
                                $chartPercent = $chartPercent.$percent.',';
                                $chartothers = "Others";
                                $chartAnswer = $chartAnswer.'"'.$chartothers.'",';
                                $chartCount = $chartCount.$countother.',';
                                echo "<tr><td>
                            <div class='divchoice'>Others</div></td>
                            <td><div class='divpercent'></div></td>
                            <td><div class='divcount'>$countother</div>
                                  </td></tr></table><br>";

                            }

                            $queryNotans = mysqli_query($conn, "SELECT * FROM responsetbl WHERE Question_ID = $QID AND Response ='Not Answered'");
                            $countNotAns = mysqli_num_rows($queryNotans);
                            $percent = $countNotAns / $totalRes * 100;
                            $percent = Round($percent, 2);
                            $percent = number_format($percent, 2);
                            
                    //displaying not answered responses except checkbox question type        
                            if ($Qtype != "Checkbox") {
                            if ($countNotAns > 0) {
                                $chartPercent = $chartPercent.$percent.',';
                                $notAns = "Not Answered ";
                                $chartAnswer = $chartAnswer.'"'.$notAns.'",';
                                $chartCount = $chartCount.$countNotAns.',';
                            echo "<tr><td>
                            <div class='divchoice' style='color:red;'>Not Answered</div></td>
                            <td><div class='divpercent'>$percent%</div></td>
                            <td><div class='divcount'>$countNotAns</div>
                                  </td></tr></table><br>";
                                }else{
                                    echo "</table><br>";
                                }
                                
                            }
                            
                           
                        }
                       
                    }
                    echo "</table>
                    <hr>
                    <br>
                    <button class='dlbtn' onclick='downloadImage2();'><img src='../img/dl.png'></button>
                    <center><h3 style='color:rgb(48, 133, 207);'>Bar Chart</h3></center>
                    <br>
                    <br>
                     
                    <canvas id='Barchart'></canvas>     
                    <br>
                    <hr>
                    ";

                    $chartAnswer = trim($chartAnswer, ",");
                    $chartPercent = trim($chartPercent, ",");
                    $chartCount = trim($chartCount, ",");
                    $batch_chart =trim($batch_chart,",");
                    }
                }
                $datasets = "";
                //generate dynamic chart
                $legend_counter = 0;
            
                    $bcolor = array();
                    $bcolor = ["'rgba(255, 99, 132, 1.5)','rgba(255, 99, 132, 1.5)','rgba(255, 99, 132, 1.5)'",
                    "'rgba(54, 162, 235, 1.5)','rgba(54, 162, 235, 1.5)','rgba(54, 162, 235, 1.5)'",
                    "'rgba(157, 55, 125, 1.5)','rgba(157, 55, 125, 1.5)','rgba(157, 55, 125, 1.5)'",
                    "'rgba(10, 199, 90, 1.5)','rgba(10, 199, 90, 1.5)','rgba(10, 199, 90, 1.5)'",
                    "'rgba(69, 69, 246, 1.5)','rgba(69, 69, 246, 1.5)','rgba(69, 69, 246, 1.5)'",
                    "'rgba(75, 252, 192, 1.5)','rgba(75, 252, 192, 1.5)','rgba(75, 252, 192, 1.5)'",
                    "'rgba(150, 125, 205, 1.5)','rgba(150, 125, 205, 1.5)','rgba(150, 125, 205, 1.5)'",
                    "'rgba(255, 206, 86, 1.5)','rgba(255, 206, 86, 1.5)','rgba(255, 206, 86, 1.5)'",
                    "'rgba(15, 105, 105, 1.5)','rgba(15, 105, 105, 1.5)','rgba(15, 105, 105, 1.5)'",
                    "'rgba(53, 102, 55, 1.5)','rgba(53, 102, 55, 1.5)','rgba(53, 102, 55, 1.5)'",
                    "'rgba(255, 69, 46, 1.5)','rgba(255, 69, 46, 1.5)','rgba(255, 69, 46, 1.5)'"];
                    foreach ($choices as $choice) {

                        $datasets = $datasets."{
                            label: '$choice',
                            backgroundColor: [$bcolor[$legend_counter]],
                            data: [$choices_count[$legend_counter]],
                            borderColor: 'aliceblue',
                            borderWidth: 1,
                            hoverBorderWidth: 4,
                            hoverBorderColor: '#000'
                        }".",";
                        $legend_counter++;
                    }
                
                    $datasets = trim($datasets,",");

                        ?>
                
                   


                         </div>
                            <!-- summary table end -->
               
                        

                        
                </div>

            </div>
                
        </div>


            <script>
           
            // Bar Chart
                    var ctxs = document.getElementById("Barchart");
                    Chart.defaults.scale.ticks.beginAtZero = true;

                    let BarChart = new Chart(ctxs, {
                        type: 'bar',
                        data: {

                            labels: [<?php echo $batch_chart; ?>],//batch graduates

                            datasets: [<?php echo $datasets; ?>]//datasets

                        },
                        options: {
                            plugins:{
                                datalabels: {
                                color:'rgba(0,0,0,0.850)'
                            }
                            },
                            
                            animation: {
                                animateScale: true
                            }
                        }

                    })
                    function downloadImage2(){
                        BarChart.options.title.text = '[<?php echo $Question; ?>] Bar Chart';
                        BarChart.options.title.display = true;
                        BarChart.update({
                            duration: 0
                        });

                        var link = document.createElement('a');
                        link.href = BarChart.toBase64Image();
                        link.download = 'Bar Chart.png';
                        link.click();

                       
                        BarChart.options.title.display = false;
                        BarChart.update({
                            duration: 0
                        });

                    }
                    
                    function SelectQuestion() {
                        
                        var selectbox = document.getElementById('question');
                        var QID = selectbox.options[selectbox.selectedIndex].value;
                        window.location.href='summary_reports?qid='+QID+'&&SID='+<?php echo $surveyID; ?>+'';
                    }
            </script>
        
                    

</body>
</html>
                
                   
                       
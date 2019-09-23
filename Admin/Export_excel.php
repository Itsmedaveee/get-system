<?php 
include_once '../includes/connection.php';
$surveyID = $_GET['SID'];
$output = "";

//***************************Showing all Surveys  */ 
                    $que = "SELECT Title FROM mysurveytbl WHERE Survey_ID = $surveyID ";
                    $results = $conn-> query($que);
                    $rowss = $results-> fetch_assoc();
                    $Surveytitle = $rowss['Title'];

                                   $output .="<table>
                                    <thead>
                                    <tr height='35'>";
                        $querys = "SELECT * FROM questiontbl WHERE Survey_ID = $surveyID ";
                        $result = $conn-> query($querys);
                        
                        if ($result-> num_rows > 0){

                            $count = 0;
                            while ($row = $result-> fetch_assoc()){
                                
                                $QuestionType = $row['QuestionType'];
                                $Questions = $row['Question'];
                                $count = $count + 1;

                            $output .= "
                                <th>".$Questions."</th>";
                            }
                        }
                        $output .= "</tr>";

                        //loop for Respondent
                               $querys = "SELECT * FROM respondenttbl WHERE Survey_ID = $surveyID ";
                                $result1 = $conn-> query($querys);
                        
                                if ($result1-> num_rows > 0){
                                   $page = 0;
                                        while ($row1 = $result1-> fetch_assoc()){
                                                    $RID = $row1['RID'];
                                                    $page = $page + 1;

                            

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
                                $output .= "<td><span>".$other."</span>";
                            }else{
                                $output .= "<td >";
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
                                                    $output .= "<span $color>".$Response."</span>";
                                                }else{
                                                    if ($othercount > 0) {
                                                         $output .= "<span>,".$Response."</span>";
                                                    }else{
                                                        $output .= "<span>".$Response.",</span>";
                                                    }
                                                }
                                        


                                    }else{

                                        $output .= "<td $color>".$Response."</td>";
                                    }

                                   



                            }
                            if ($QuestionType == "Checkbox") {
                                $output .= "</td>";
                             }
                        }
                      
                        
                        
                    }
                }

                $output .= "</tr>";
            }
            $output .= "</table>";
            header("Content-Type: application/xls");
            header("Content-Disposition:attachment; filename=".$Surveytitle." Record.xls");
            echo $output;
        }
        
                        



?>
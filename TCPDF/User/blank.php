<?php
require_once('tcpdf_include.php');
include_once '../../includes/connection.php';

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Administrator');
$pdf->SetTitle('Graduates Employability Tracer System');
$pdf->SetSubject('Summary Report');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}


$pdf->SetFont('dejavusans', '', 10);


$pdf->AddPage('P');
if (!empty($_GET['SID'])) {
	$surveyID = $_GET['SID'];
}


//start displaying report
$count = 0;
$html = '';
$html2 = '';
$html3 = '';
$totalchkbxcount = 0;
//fetch title and description
$querytitle = mysqli_query($conn, "SELECT * FROM mysurveytbl WHERE Survey_ID = $surveyID");
$titleresult = mysqli_fetch_assoc($querytitle);
$Descr = ucfirst($titleresult['Description']);
$title = ucfirst($titleresult['Title']);
$uID = $titleresult['user_ID'];
//fetch user name
$queryuser = mysqli_query($conn, "SELECT * FROM userstb WHERE ID = $uID");
$userresult = mysqli_fetch_assoc($queryuser);
$user = ucfirst($userresult['Name']);

$pdf->SetFont('Helvetica','',11);
$pdf->Cell(180,8,"Title:".$title,0,1,'');
$pdf->Cell(180,8,"Description:".$Descr,0,1,'');
$pdf->Cell(180,8,"Processor:".$user,0,1,'');
$pdf->SetFont('Helvetica','',10);
//fetch total respondents
$queryRes = mysqli_query($conn, "SELECT * FROM respondenttbl WHERE Survey_ID = $surveyID");
$totalRes = mysqli_num_rows($queryRes);
//fetch all questions						
$query = mysqli_query($conn, "SELECT * FROM questiontbl WHERE Survey_ID = $surveyID");
                    while($result = mysqli_fetch_assoc($query)){
                            $QID = $result['QuestionID'];
                            $Qtype = $result['QuestionType'];
                            $Question = ucfirst($result['Question']);
                            if ($Qtype == "Checkbox" || $Qtype == "Multiplechoice") {
                                
							$html = '<h4><u>'.$Question.'</u></h4><br/>
                            <table border="1" width="100%">
                                <tr>
                                    <th><b>Choices</b></th>
                                    <th><b>Percent(%)</b></th>
                                    <th><b>Count</b></th>
                                </tr>';
                    //fetch all Answers or Choices            
                    $query2 = mysqli_query($conn, "SELECT * FROM answertbl WHERE Question_ID = $QID ");

                    while($result2 = mysqli_fetch_assoc($query2)){
                                $AID = $result2['Answer_ID'];
                                $Answer = $result2['Answer'];
                        $queryAns = mysqli_query($conn, "SELECT * FROM responsetbl WHERE Question_ID = $QID AND Response ='$Answer'");
                        $count = mysqli_num_rows($queryAns);

                        
                        $queryCheckbox = mysqli_query($conn, "SELECT * FROM responsetbl WHERE Question_ID = $QID AND Response != 'Not Answered'");
                        $countcheckbox = mysqli_num_rows($queryCheckbox);
                        $queryCheckother = mysqli_query($conn, "SELECT * FROM otherstbl WHERE Question_ID = $QID");
                        $countcheckother = mysqli_num_rows($queryCheckother);
                        if ($Qtype == "Checkbox") {
                            if ($countcheckbox > 0 && $countcheckother > 0) {
                                $totalchkbxcount = $countcheckother + $countcheckbox;
                            }elseif($countcheckother > 0){                      
                                    $totalchkbxcount = $countcheckother;
                            }else{
                                $totalchkbxcount = $countcheckbox;
                            }  
                            if ($count > 0) {
                                $percent = $count / $totalchkbxcount * 100;
                            }else{
                                $percent = 0;
                            }
                           
                        }else{
                            $percent = $count / $totalRes * 100;
                        }
                //displaying summary responses
                        $percent = Round($percent, 2);
                        $percent = number_format($percent, 2);
								$html .= '<tr>
								<td><b>'.$Answer.'</b></td>
                                <td>'.$percent.'%</td>
								<td>'.$count.'</td>
								</tr>';
                        }

                            $queryother = mysqli_query($conn, "SELECT * FROM otherstbl WHERE Question_ID = $QID");
                            $countother = mysqli_num_rows($queryother);
                            if ($Qtype == "Checkbox") {
                                if ($countother > 0) {
                                    $percent = $countother / $totalchkbxcount * 100;
                                }else{
                                    $percent = 0;
                                }
                            }
                            $percent = Round($percent, 2);
                            $percent = number_format($percent, 2);
                            
                    //displaying others responses
                            if ($countother > 0) {
								$html .= '<tr>
								<td><b>Others</b></td>
								<td>'.$percent.'%</td>
								<td>'.$countother.'</td>
								</tr>
								';
                            }

                            $queryNotans = mysqli_query($conn, "SELECT * FROM responsetbl WHERE Question_ID = $QID AND Response ='Not Answered'");
                            $countNotAns = mysqli_num_rows($queryNotans);
                            $percent = $countNotAns / $totalRes * 100;
                            $percent = Round($percent, 2);
                            $percent = number_format($percent, 2);
                            
                    //displaying not answered responses except checkbox question type
                            if ($Qtype != "Checkbox") {
                            if ($countNotAns > 0) {  
                            $html .= '<tr><td><b>Not Answered</b></td>
                            <td>'.$percent.'%</td>
							<td>'.$countNotAns.'</td>
							</tr>
							';
                                }
							}
							$html .= '</table>';
							$html2 = $html2.'<br/>'.$html;
                        }
                       
                    }
                   

                
						


//end



$pdf->writeHTML($html2, true, false, true, false, '');
	


$pdf->lastPage();

$pdf->Output('GETSummaryReport.pdf', 'I');


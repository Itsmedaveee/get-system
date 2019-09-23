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



$pdf->SetFont('Helvetica','B',10);
$pdf->Cell(180,10,"DHVSU CCS ALUMNI LIST",1,1,'C');
//start displaying report
$count = 0;
$html = '<table border="1" width="100%">
<tr>
    <th><b> List No.</b></th>
    <th><b> Course</b></th>
    <th><b> Year Graduated</b></th>
    <th><b> Student No.</b></th>
    <th><b> Last Name</b></th>
    <th><b> First Name</b></th>
    <th><b> Middle Name</b></th>
    
</tr>';
$pdf->SetFont('Helvetica','',10);
if (empty($_GET['select'])) {
       

$query = mysqli_query($conn, "SELECT * FROM graduates_infotbl");
        while($result = mysqli_fetch_assoc($query)){
                $count++;
                $stud_no = $result['Stud_No'];
                $lname = $result['lastname'];
                $fname = $result['firstname'];
                $mname = $result['middlename'];
                $c = $result['course'];
                $y = $result['year_graduated'];

                $html .= '<tr>
                 
                        <td> '.$count.'</td>
                        <td> '.$c.'</td>
                        <td> '.$y.'</td>
                        <td> '.$stud_no.'</td>
                        <td> '.$lname.'</td>
                        <td> '.$fname.'</td>
                        <td> '.$mname.'</td>
                        
                 
                    </tr>';

        }

        $html .= '</table>';
}else{
        $select = $_GET['select'];
        $search = $_GET['search'];


        $query = mysqli_query($conn, "SELECT * FROM graduates_infotbl WHERE $select LIKE '%$search%'");
        while($result = mysqli_fetch_assoc($query)){
                $count++;
                $stud_no = $result['Stud_No'];
                $lname = $result['lastname'];
                $fname = $result['firstname'];
                $mname = $result['middlename'];
                $c = $result['course'];
                $y = $result['year_graduated'];

                $html .= '<tr>
                 
                        <td> '.$count.'</td>
                        <td> '.$c.'</td>
                        <td> '.$y.'</td>
                        <td> '.$stud_no.'</td>
                        <td> '.$lname.'</td>
                        <td> '.$fname.'</td>
                        <td> '.$mname.'</td>
                        
                 
                    </tr>';

        }

        $html .= '</table>';
}

$pdf->writeHTML($html, true, false, true, false, '');
	


$pdf->lastPage();

$pdf->Output('GETSummaryReport.pdf', 'I');


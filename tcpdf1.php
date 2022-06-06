<?php

session_start();
   if(!isset($_SESSION['idcompte'])) 
       header('location:cabinetlogin.php');
   
      if($_SESSION['typeCompte'] != "secretaire" && $_SESSION['typeCompte'] != "medecin")
         header('location:cabinetlogin.php');
   

require "utils.php"; 

$idcompte_patient = $_SESSION["idcompte_patient"];

$conn = new mysqli('localhost', 'root', '' , 'cabinetdb') or die ('Echec de se connecter à la base de donnée');
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$users = $conn->query("SELECT * FROM compte WHERE IdCompte='$idcompte_patient'");
$row= $users->fetch_assoc();

$row1= $row['NomUser'];
$row2= $row['PrenomUser'];
$row3= $row['CinUser'];
$row4= $row['SexeUser'];
$row5= $row['NaissanceUser'];
$row6= $row['addressUser'];
$row7= $row['Ville'];
$row8= $row['Email'];
$row9= $row['TelephoneUser'];




?>

<?php



// Include the main TCPDF library (search for installation path).
require_once('./TCPDF/examples/tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->setCreator('MK');
$pdf->setAuthor('MK');
$pdf->setTitle(' la Fiche de patient');
$pdf->setSubject('la Fiche de patient');
$pdf->setKeywords('fiche, patient');

// set default header data
$pdf->setHeaderData('./logo2.jpg', PDF_HEADER_LOGO_WIDTH, 'la Fiche de patient', 'by MonCabinetX - www.moncabinetx.ma');

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->setHeaderMargin(PDF_MARGIN_HEADER);
$pdf->setFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'./TCPDF/examples/lang/eng.php')) {
	require_once(dirname(__FILE__).'./TCPDF/examples/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->setFont('times', '', 10);

// add a page
$pdf->AddPage();

// set cell padding
$pdf->setCellPaddings(1, 1, 1, 1);

// set cell margins
$pdf->setCellMargins(1, 1, 1, 1);

// set color for background
$pdf->setFillColor(255, 255, 127);

// MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)

// set some text for example
$txt = "Nom: '$row1' \t Prénom: '$row2' \n CIN: '$row3' \t Sexe: '$row4'\n Date de naissance: '$row5' ";
$txt2 = "Adresse: '$row6'\n Ville: '$row7' email: '$row8'\n Téléphone Portable: '$row9'";
// Multicell test

$pdf->setFontSubsetting(false);
$pdf->SetFont('helvetica', 'B', 20);
$pdf->Write(0, "Fiche de patient : $row1 $row2 ", '', 0, 'C', 1, 0, false, false, 0);
$pdf->Ln(10);

$pdf->SetFont('times', '', 10);

$pdf->Write(0, "les informations personnels                                                  adresse et contact", '', 0, 'L', 1, 0, false, false, 0);

$pdf->MultiCell(80, 0, ''.$txt, 1, '', 0, 0, '', '', true);
$pdf->MultiCell(80, 0, ''.$txt2, 1, '', 0, 1, '', '', true);


// set color for background
$pdf->setFillColor(220, 255, 220);


$pdf->Ln(4);





// move pointer to last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
ob_end_clean();

$pdf->Output('fichepatient.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

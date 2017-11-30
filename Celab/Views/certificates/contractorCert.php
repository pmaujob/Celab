<?php

date_default_timezone_set('America/Bogota');
@session_start();
$pRootC = $_SESSION['pRootC'];

require_once $pRootC . '/Libraries/fpdf/fpdf.php';
require_once $pRootC . '/Libraries/fpdf/PDF.php';
require_once $pRootC . '/Libraries/PDFFormats.php';
require_once $pRootC . '/Libraries/ConvertFormats.php';

$pdf = new FPDF('P', 'mm', 'Letter'); // vertical, milimetros y tamaño
$pdf->SetMargins(20, 15, 20);
$pdf->AddPage();
$pdf->SetFont('Arial', 'I', 10);

$pdf->Image('certImages/colombia_escudo.png', 34, 17, 13);
$pdf->Image('certImages/logo-client.png', 125, 17, 15);
$pdf->Ln(5);
$pdf->Cell(151.5, 6, utf8_decode('Departamento'), 0, 0, 'R');
$pdf->Ln(4);
$pdf->Cell(177, 6, utf8_decode('Administrativo de Contratación'), 0, 0, 'R');
$pdf->Ln(6);

$pdf->SetFont('Arial', '', 8);
$pdf->Cell(40, 6, utf8_decode('Libertad y Orden'), 0, 0, 'C');
$pdf->Ln(10);
$pdf->Cell(0, 6, utf8_decode('San Juan de Pasto, ') . ConvertFormats::formatDate(date("d-M-Y")));
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(0, 6, utf8_decode('EL DIRECTOR DEL DEPARTAMENTO ADMINISTRATIVO DE CONTRATACIÓN'), 0, 0, 'C');
$pdf->Ln(5);
$pdf->Cell(0, 6, utf8_decode('CERTIFICA QUE:'), 0, 0, 'C');
$pdf->Ln(10);
$pdf->SetFont('Arial', '', 8);
DisenoCertificacionesPDF::justificarParrafo(utf8_decode('El (la), ' . 'NOMBRE COMPLETO' . ', identificado con cédula de ciudadanía No. ' . 'XXXXXXXX'
                . ', celebró Contrato (s) con el Departamento de Nariño conforme a la siguiente relación: '), 0.96, $pdf);
$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 8);

$txt = 'TIPO DE CONTRATO';
$conTypeLines = $pdf->getNumberLn(44, 4, utf8_decode($txt));

if ($conTypeLines == 1) {
    $pdf->Cell(44, 8, utf8_decode($txt), 1, 0, 'C');
} else {
    DisenoCertificacionesPDF::justificarParrafo(utf8_decode($txt), 3.865, $pdf, 1, 4);
    $pdf->backLn(64, $conTypeLines * 4);
}
//foreach
$pdf->Cell(44, ($conTypeLines == 1 ? 8 : $conTypeLines * 4), utf8_decode('SUSCRIPCIÓN D/M/A'), 1, 0, 'C');
$pdf->Cell(44, ($conTypeLines == 1 ? 8 : $conTypeLines * 4), utf8_decode('TERMINACIÓN D/M/A'), 1, 0, 'C');
$pdf->Cell(44, ($conTypeLines == 1 ? 8 : $conTypeLines * 4), utf8_decode('VALOR'), 1, 0, 'C');
$pdf->Ln();
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(44, 4, utf8_decode('XXX-XXXX'), 1, 0, 'C');
$pdf->Cell(44, 4, utf8_decode('XX-XX-XX'), 1, 0, 'C');
$pdf->Cell(44, 4, utf8_decode('XX-XX-XX'), 1, 0, 'C');
$pdf->Cell(44, 4, utf8_decode('$XX.XXX.XXX'), 1, 0, 'C');
$pdf->Ln();
$pdf->Cell(0, 4, utf8_decode('OBJETO: OBJETO OBJETO OBJETO OBJETO OBJETO OBJETO OBJETO '), 1, 0);
$pdf->Ln();

$pdf->Ln(10);
//fin del foreach
//opcional **************
DisenoCertificacionesPDF::justificarParrafo(utf8_decode('Se adhieren y anulan estampillas Pro desarrollo de Nariño, '
                . 'Pro cultura y Universidad de Nariño, conforme a las disposiciones pertinentes de las ordenanzas números '
                . '028 de 2010 y 005 del 18 de julio de 2012, proferidas por la Asamblea Departamental de Nariño.'), 0.96, $pdf);
$pdf->Ln(10);
//**************
$pdf->Cell(0, 4, utf8_decode('La presente NO es una constancia laboral.'));
$pdf->Ln(10);
$pdf->Cell(0, 4, utf8_decode('Se expide a solicitud del interesado, el día ') . ConvertFormats::formatDate(date("d-M-Y")));
$pdf->Ln(20);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(0, 4, utf8_decode('JOSE ALEXANDER ROMERO TABLA'), 0, 0, 'C');
$pdf->Ln();
$pdf->Cell(0, 4, utf8_decode('Director DAC.'), 0, 0, 'C');
$pdf->Ln(10);
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(0, 4, utf8_decode('Proyectó: ' . "Nombre del Admin"));
$pdf->Ln(10);
$pdf->SetFont('Arial', 'BI', 8);
$pdf->Cell(0, 4, utf8_decode('Gobernación de Nariño'));
$pdf->Ln();
$pdf->Cell(0, 4, utf8_decode('Carrera 25 No. 17-49 - Edificio de la Beneficiencia-Cuarto piso'));
$pdf->Ln();
$pdf->Cell(44, 4, utf8_decode('Pasto-Nariño Tel 7207666 Email: '));
$pdf->SetFont('Arial', 'BIU', 8);
$pdf->Cell(44, 4, utf8_decode('Contratación@narino.gov.co'));
$pdf->Ln();
$pdf->Cell(44, 4, utf8_decode('www.narino.gov.co'));



$pdf->Output();
?>
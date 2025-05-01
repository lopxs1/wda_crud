<?php
require_once '../config.php';
require_once('../inc/pdf.php');

function dPDF()
{
    require_once '../inc/pdf.php';
    ob_start();
    $pdf = new PDF();
    $pdf->AddPage();
    $arquivo = 'usuarios.pdf';
    $tipo_pdf = 'I';
    ob_clean() ;
    $pdf->Output($arquivo, $tipo_pdf);
    ob_end_flush();
    exit;
}
?>

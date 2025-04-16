<?php 
require ("fpdf.php");

class PDF extends FPDF
{
    //page header
    function header()
    {
        //logo
        //$this->Image('logo.png'10,6,30);
        //arial bold 15
        $this->SetFont('Arial', 'B',15);
        //move to right
        //$this->Cell(40);
        //title
        $this->Cell(180,10,"Título do PDF",1,0,'C');
        //line break
        $this->Ln(20);
    }

    function footer()
    {
        //position at 1.5cm from the bottom
        $this->SetY(-15);
        //arial italic
        $this->SetFont('Arial','I', 8);
        //page number
        $this->Cell(0,10,'Página ' .$this->PageNo(). ' de {nb}',0,0,'C');
    }
}
<?php 
require ("fpdf.php");

class PDF extends FPDF
{
    //page header
    function header()
    {
        //logo
        $this->Image('../img/logo2.png',10,10,-140);
        //arial bold 15
        $this->SetFont('Arial', 'B',15);
        //move to right
        //$this->Cell(40);
        //title
        $this->Cell(180,10,"Lista de Usuários",1,0,'C');
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
        $this->Cell(0,10, 'Página ' .$this->PageNo(). ' de {nb}',0,0,'C');
    }

    function converteTexto($str) 
    {
        $str = iconv("UTF-8", "windows-1252", $str);
        return $str;
    }
}
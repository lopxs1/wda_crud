<?php 
require ("fpdf.php");

class PDF extends FPDF
{
    function header()
    {
        $this->Image('../img/logo2.png', 10, 10, -140);
        $this->SetFont('Arial', 'B', 15);

        // Aplicando a conversão no cabeçalho
        $titulo = $this->converteTexto("Lista de Usuários");
        $this->Cell(180, 10, $titulo, 1, 0, 'C');
        $this->Ln(20);
    }

    function footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);

        // Aplicando a conversão no rodapé
        $pagina = $this->converteTexto('Página ' . $this->PageNo() . ' de {nb}');
        $this->Cell(0, 10, $pagina, 0, 0, 'C');
    }

    function converteTexto($str) 
    {
        return iconv("UTF-8", "ISO-8859-1//TRANSLIT", $str);
    }
}
?>
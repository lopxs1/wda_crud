<?php
require_once '../config.php';
require_once 'pdf_teste.php';

if (isset($_GET['pdf'])) {
    dPDF();
    exit;
}
?>

<?php include(HEADER_TEMPLATE); ?>
<a href="teste.php?pdf" class="btn btn-primary mt-3">Gerar PDF</a>

<?php include(FOOTER_TEMPLATE); ?>
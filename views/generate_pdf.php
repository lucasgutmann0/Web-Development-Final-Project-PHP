<?php
// reference the Dompdf namespace

use Dompdf\Dompdf;

ob_start();
include('templates/inform.php');
$html = ob_get_clean();
/* $html = file_get_contents('templates/inform.php'); */

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml($html);

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream();

<?php

require('../reports/fpdf.php');

require_once("../models/asignaciones.model.php");

$pdf = new FPDF();
$pdf->AddPage();

$asignacion = new Asignaciones();  
// Configuración del encabezado

$pdf->SetFont('Times', 'B', 12); 
$pdf->Text(20, 20, 'Reporte  Asignaciones');

$pdf->Ln(20); 

// Cabecera de la tabla
$pdf->Cell(10, 10, "#", 1);
     $pdf->Cell(30, 10, "ID Asignacion", 1);
         $pdf->Cell(40, 10, "ID Estudiante", 1);
             $pdf->Cell(40, 10, "ID Profesor", 1);
                                  $pdf->Ln();
$listaAsignaciones = $asignacion->todos();  
if ($listaAsignaciones) {
    $index = 1;
    while ($asg = mysqli_fetch_assoc($listaAsignaciones)) {
        $pdf->Cell(10, 10, $index, 1);
        $pdf->Cell(30, 10, $asg["asignacion_id"], 1);
        $pdf->Cell(40, 10, $asg["estudiante_id"], 1);
        $pdf->Cell(40, 10, $asg["profesor_id"], 1);
        $pdf->Ln();
        $index++;
    }
} else {
    $pdf->Cell(0, 10, 'No se encontraron asignaciones.', 1, 1, 'C');
}

// Output PDF
$pdf->Output();
?>


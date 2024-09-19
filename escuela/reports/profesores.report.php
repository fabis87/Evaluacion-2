<?php
// Llamado a la librería PDF
require('../reports/fpdf.php');
// Llamado al modelo de Profesores
require_once("../models/profesores.model.php");

$pdf = new FPDF();
$pdf->AddPage();

$profesor = new Profesores();  
// Configuración del encabezado

$pdf->SetFont('Times', 'B', 12); 
$pdf->Text(20, 20, 'Reporte profesores');

$pdf->Ln(20); 

// Cabecera de la tabla
$pdf->Cell(10, 10, "#", 1);
$pdf->Cell(40, 10, "ID Profesor", 1);
$pdf->Cell(50, 10, "Nombre", 1);
$pdf->Cell(50, 10, "Apellido", 1);
$pdf->Cell(40, 10, "Especialidad", 1);
$pdf->Ln();

$listaprofesores = $profesor->todos();  

// Llenar la tabla con los datos de profesores
if ($listaprofesores) {
    $index = 1;
    while ($prof = mysqli_fetch_assoc($listaprofesores)) {
        $pdf->Cell(10, 10, $index, 1);
        $pdf->Cell(40, 10, $prof["profesor_id"], 1);
        $pdf->Cell(50, 10, $prof["nombre"], 1);
        $pdf->Cell(50, 10, $prof["apellido"], 1);
        $pdf->Cell(40, 10, $prof["especialidad"], 1);
        $pdf->Ln();
        $index++;
    }
} else {
    $pdf->Cell(0, 10, 'No se encontraron profesores.', 1, 1, 'C');
}

// Output PDF
$pdf->Output();
?>

<?php
//  librería PdF
require('../reports/fpdf.php');


require_once("../models/estudiantes.model.php");

$pdf = new FPDF();
$pdf->AddPage();

$estudiante = new Estudiantes();  

$pdf->SetFont('Arial', 'B', 12); 
$pdf->Text(20, 20, 'Reporte de Estudiantes');

$pdf->Ln(20); 

// Cabecera de la tabla
$pdf->Cell(10, 10, "#", 1);
$pdf->Cell(30, 10, "ID Estudiante", 1);
$pdf->Cell(40, 10, "Nombre", 1);
$pdf->Cell(40, 10, "Apellido", 1);
$pdf->Cell(40, 10, "Fecha Nacimiento", 1);
$pdf->Cell(30, 10, "Grado", 1);
$pdf->Ln();

$listaestudiantes = $estudiante->todos();  


if ($listaestudiantes) {

    $index = 1;
    while ($est = mysqli_fetch_assoc($listaestudiantes)) {
        $pdf->Cell(10, 10, $index, 1);


        $pdf->Cell(30, 10, $est["estudiante_id"], 1);
        $pdf->Cell(40, 10, $est["nombre"], 1);
        $pdf->Cell(40, 10, $est["apellido"], 1);
        $pdf->Cell(40, 10, $est["fecha_nacimiento"], 1);
        $pdf->Cell(30, 10, $est["grado"], 1);
        $pdf->Ln();
        $index++;
    }
} else {
    $pdf->Cell(0, 10, 'No se encontraron estudiantes.', 1, 1, 'C');
}

// Output PDF
$pdf->Output();
?>

<?php
require('fpdf/fpdf.php');
$idpaciente = $_GET['idpaciente'];
include('conexion.php');

// Consulta a la base de datos
$query = "SELECT * FROM paciente, consulta WHERE paciente.idpaciente=consulta.idpaciente AND consulta.idpaciente='$idpaciente'";
$resultado = mysqli_query($conexion, $query);

// Crear objeto PDF
$pdf = new FPDF();
$pdf->AddPage();

// Título
$pdf->SetFont('Arial', 'B', 16);
$pdf->SetTextColor(33, 37, 41); // Color del texto negro oscuro
$pdf->Cell(0, 10, 'Historia Clinica del Paciente', 0, 1, 'C');
$pdf->Ln(10);

// Encabezados de la tabla
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(220, 230, 240); // Fondo gris claro para encabezados
$pdf->Cell(40, 10, 'Nombre', 1, 0, 'C', true);
$pdf->Cell(40, 10, 'Apellido', 1, 0, 'C', true);
$pdf->Cell(50, 10, 'Sintomas', 1, 0, 'C', true);
$pdf->Cell(40, 10, mb_convert_encoding('Diagnóstico', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Receta', 1, 1, 'C', true);

// Datos de la tabla
$pdf->SetFont('Arial', '', 12);
$pdf->SetFillColor(245, 245, 245); // Fondo blanco para filas alternas
$pdf->SetTextColor(0, 0, 0);
$fill = false; // Alternar color de fondo
while ($row = mysqli_fetch_array($resultado)) {
    $pdf->Cell(40, 10, $row['nombre'], 1, 0, 'C', $fill);
    $pdf->Cell(40, 10, $row['apellido'], 1, 0, 'C', $fill);
    $pdf->Cell(50, 10, $row['sintomas'], 1, 0, 'C', $fill);
    $pdf->Cell(40, 10, $row['diagnostico'], 1, 0, 'C', $fill);
    $pdf->Cell(30, 10, $row['receta'], 1, 1, 'C', $fill);
    $fill = !$fill; // Alternar colores
}

// Pie de página
$pdf->Ln(10);
$pdf->SetFont('Arial', 'I', 10);
$pdf->SetTextColor(100, 100, 100); // Gris oscuro
$pdf->Cell(0, 10, 'Generado el: ' . date('d-m-Y H:i:s'), 0, 0, 'L');

// Salida del archivo
$pdf->Output();
?>

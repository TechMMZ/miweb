<?php
require_once('../config/conexion.php');
require_once('../vendor/tecnickcom/tcpdf/tcpdf.php');

// Crear una instancia de TCPDF
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetTitle('Reporte de Asistencias');
$pdf->SetMargins(10, 10, 10);
$pdf->AddPage();

// Conexión a la base de datos
$database = new Database();
$conn = $database->getConnection();

// Obtener los datos de la tabla
$sql = "SELECT usuario_nombre, fecha, hora_entrada, hora_salida FROM asistencia";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Agregar título
$pdf->SetFont('Helvetica', 'B', 16);
$pdf->Cell(0, 10, 'Reporte de Asistencia', 0, 1, 'C');
$pdf->Ln(3);

// Agregar subtítulo con fecha de generación
$pdf->SetFont('Helvetica', '', 12);
$pdf->Cell(0, 10, 'Generado el: ' . date('d/m/Y H:i'), 0, 1, 'C');
$pdf->Ln(5);

// Configurar encabezado de tabla
$pdf->SetFont('Helvetica', 'B', 11);
$pdf->SetFillColor(230, 230, 230);
$pdf->Cell(70, 10, 'Nombre y Apellidos', 1, 0, 'C', true);
$pdf->Cell(40, 10, 'Fecha', 1, 0, 'C', true);
$pdf->Cell(40, 10, 'Hora Entrada', 1, 0, 'C', true);
$pdf->Cell(40, 10, 'Hora Salida', 1, 1, 'C', true);

// Agregar filas de datos
$pdf->SetFont('Helvetica', '', 10);
foreach ($result as $row) {
    $pdf->Cell(70, 10, $row['usuario_nombre'], 1, 0, 'C');
    $pdf->Cell(40, 10, $row['fecha'], 1, 0, 'C');
    $pdf->Cell(40, 10, $row['hora_entrada'], 1, 0, 'C');
    $pdf->Cell(40, 10, $row['hora_salida'], 1, 1, 'C');
}

// Pie de página
$pdf->Ln(5);
$pdf->SetFont('Helvetica', 'I', 10);
$pdf->Cell(0, 10, 'Reporte generado automáticamente', 0, 1, 'C');

// Salida del PDF
$pdf->Output('asistencias.pdf', 'I'); // 'I' para previsualizar en el navegador

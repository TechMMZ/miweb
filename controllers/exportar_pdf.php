<?php
require_once('../config/conexion.php');
require_once('../vendor/tecnickcom/tcpdf/tcpdf.php');

// Recibir el filtro desde el formulario o AJAX
$filtro = isset($_GET['filtro']) ? trim($_GET['filtro']) : '';

// Crear una instancia de TCPDF
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetTitle('Reporte de Asistencias');
$pdf->SetMargins(10, 10, 10);
$pdf->AddPage();

// Conexión a la base de datos
$database = new Database();
$conn = $database->getConnection();

// Construcción de la consulta SQL con filtro
$sql = "SELECT usuario_nombre, fecha, hora_entrada, hora_salida FROM asistencia";
$params = [];

if (!empty($filtro)) {
    $sql .= " WHERE usuario_nombre LIKE :filtro";
    $params[':filtro'] = "%$filtro%";
}

$stmt = $conn->prepare($sql);
$stmt->execute($params);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Agregar título
$pdf->SetFont('Helvetica', 'B', 16);
$pdf->Cell(0, 10, 'Reporte de Asistencia', 0, 1, 'C');
$pdf->Ln(3);

// Agregar subtítulo con fecha de generación
$pdf->SetFont('Helvetica', '', 12);
$pdf->Cell(0, 10, 'Generado el: ' . date('d/m/Y H:i'), 0, 1, 'C');
$pdf->Ln(5);

if (!empty($filtro)) {
    // $pdf->Cell(0, 10, 'Filtro aplicado: ' . utf8_decode($filtro), 0, 1, 'L');
    $pdf->Cell(0, 10, 'Filtro aplicado: ' . mb_convert_encoding($filtro, 'ISO-8859-1', 'UTF-8'), 0, 1, 'L');
    $pdf->Ln(3);
}

// Configurar encabezado de tabla
$pdf->SetFont('Helvetica', 'B', 11);
$pdf->SetFillColor(230, 230, 230);
$pdf->Cell(70, 10, 'Nombre y Apellidos', 1, 0, 'C', true);
$pdf->Cell(40, 10, 'Fecha', 1, 0, 'C', true);
$pdf->Cell(40, 10, 'Hora Entrada', 1, 0, 'C', true);
$pdf->Cell(40, 10, 'Hora Salida', 1, 1, 'C', true);

// Agregar filas de datos
$pdf->SetFont('Helvetica', '', 10);

if (empty($result)) {
    $pdf->Cell(190, 10, 'No se encontraron registros', 1, 1, 'C');
} else {
    foreach ($result as $row) {
        // $pdf->Cell(70, 10, utf8_decode($row['usuario_nombre']), 1, 0, 'C');
        $pdf->Cell(70, 10, mb_convert_encoding($row['usuario_nombre'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
        $pdf->Cell(40, 10, $row['fecha'], 1, 0, 'C');
        $pdf->Cell(40, 10, $row['hora_entrada'], 1, 0, 'C');
        $pdf->Cell(40, 10, $row['hora_salida'], 1, 1, 'C');
    }
}

// Pie de página
$pdf->Ln(5);
$pdf->SetFont('Helvetica', 'I', 10);
$pdf->Cell(0, 10, 'Reporte generado automáticamente', 0, 1, 'C');

// Salida del PDF
$pdf->Output('asistencias.pdf', 'I'); // 'I' para previsualizar en el navegador

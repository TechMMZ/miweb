<?php
require_once('../config/conexion.php');

header('Content-Type: application/json');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$database = new Database();
$conn = $database->getConnection();

// Asistencias Totales
$sql_total = "SELECT COUNT(*) AS total FROM asistencia";
$stmt_total = $conn->query($sql_total);
$total_asistencias = $stmt_total->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;

// Asistencias del mes actual
$sql_mes_actual = "SELECT COUNT(*) AS total FROM asistencia WHERE MONTH(fecha) = MONTH(CURDATE())";
$stmt_mes_actual = $conn->query($sql_mes_actual);
$asistencias_mes_actual = $stmt_mes_actual->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;

// Asistencias del mes anterior
$sql_mes_anterior = "SELECT COUNT(*) AS total FROM asistencia WHERE MONTH(fecha) = MONTH(CURDATE()) - 1";
$stmt_mes_anterior = $conn->query($sql_mes_anterior);
$asistencias_mes_anterior = $stmt_mes_anterior->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;

// Variación porcentual
$variacion = ($asistencias_mes_anterior > 0) ? (($asistencias_mes_actual - $asistencias_mes_anterior) / $asistencias_mes_anterior) * 100 : 0;

// Día con más asistencias
$sql_dia_mas_asistencias = "
    SELECT fecha, COUNT(*) AS total 
    FROM asistencia 
    GROUP BY fecha 
    ORDER BY total DESC 
    LIMIT 1";
$stmt_dia = $conn->query($sql_dia_mas_asistencias);
$dia_mas_asistencias = $stmt_dia->fetch(PDO::FETCH_ASSOC)['fecha'] ?? 'No hay datos';

// Última asistencia registrada
$sql_ultima_asistencia = "SELECT fecha FROM asistencia ORDER BY fecha DESC LIMIT 1";
$stmt_ultima = $conn->query($sql_ultima_asistencia);
$ultima_asistencia = $stmt_ultima->fetch(PDO::FETCH_ASSOC)['fecha'] ?? 'No hay datos';

// Retornar los datos en JSON
echo json_encode([
    'total_asistencias' => $total_asistencias,
    'asistencias_mes_actual' => $asistencias_mes_actual,
    'variacion' => round($variacion, 2),
    'dia_mas_asistencias' => $dia_mas_asistencias,
    'ultima_asistencia' => $ultima_asistencia
]);

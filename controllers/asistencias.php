<?php
require_once '../../config/conexion.php';

$database = new Database();
$conn = $database->getConnection();

$sql = "SELECT usuario_nombre, fecha, hora_entrada, hora_salida FROM asistencia";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($result) > 0) {
    foreach ($result as $row) {
        // Convertimos la hora a formato 12h sin segundos con AM/PM
        $hora_entrada = $row['hora_entrada'] ? date("h:i A", strtotime($row['hora_entrada'])) : '';
        $hora_salida = $row['hora_salida'] ? date("h:i A", strtotime($row['hora_salida'])) : '';

        echo "<tr>
                <td>{$row['usuario_nombre']}</td>
                <td>{$row['fecha']}</td>
                <td>{$hora_entrada}</td>
                <td>{$hora_salida}</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='4'>No hay Asistencias registradas</td></tr>";
}

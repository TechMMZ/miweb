<?php
// include '../config/conexion.php';
// echo realpath(__DIR__ . '/../config/conexion.php');
// include __DIR__ . '/../config/conexion.php';
require_once '../../config/conexion.php';

$database = new Database();
$conn = $database->getConnection();

$sql = "SELECT id, nombre, dni, cargo, universidad_instituto FROM usuarios";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($result) > 0) {
    foreach ($result as $row) {
        echo "<tr>
                <td style='text-align: center;'>{$row['id']}</td>
                <td>{$row['nombre']}</td>
                <td>{$row['dni']}</td>
                <td>{$row['cargo']}</td>
                <td>{$row['universidad_instituto']}</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='5'>No hay usuarios registrados</td></tr>";
}

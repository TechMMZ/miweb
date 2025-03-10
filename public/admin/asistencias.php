<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: crear.php");
    exit();
}

require_once '../../config/conexion.php';
$database = new Database();
$db = $database->getConnection();

// $query = "SELECT * FROM asistencia ORDER BY fecha DESC";
$query = "SELECT asistencia.id, usuarios.nombre AS usuario_nombre, usuarios.cargo, asistencia.fecha, asistencia.hora_entrada, asistencia.hora_salida 
          FROM asistencia 
          INNER JOIN usuarios ON asistencia.usuario_id = usuarios.id 
          ORDER BY asistencia.fecha DESC";

$stmt = $db->prepare($query);
$stmt->execute();
$asistencias = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registro de Asistencias</title>
    <link rel="stylesheet" href="../css/asis.css">
</head>

<body>
    <h1>Registro de Asistencias</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Usuario</th>
            <th>Fecha</th>
            <th>Hora Entrada</th>
            <th>Hora Salida</th>
            <th>Cargo</th>
        </tr>
        <?php foreach ($asistencias as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row['id']) ?></td>
                <td><?= htmlspecialchars($row['usuario_nombre']) ?></td>
                <td><?= htmlspecialchars($row['fecha']) ?></td>
                <td><?= htmlspecialchars($row['hora_entrada']) ?></td>
                <td><?= htmlspecialchars($row['hora_salida']) ?></td>
                <td><?= htmlspecialchars($row['cargo']) ?></td> <!-- Nuevo campo -->
            </tr>
        <?php endforeach; ?>
    </table>
    <a href="logout.php">Cerrar sesión</a>
</body>

</html>
<?php
require_once '../config/conexion.php';

$database = new Database();
$db = $database->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dni = $_POST['dni'];
    $nombre = $_POST['nombre'];
    $cargo = $_POST['cargo'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $enfermedades = $_POST['enfermedades'];
    $horario_practicas = $_POST['horario_practicas'];
    $universidad_instituto = $_POST['universidad_instituto'];

    $query = "INSERT INTO usuarios (dni, nombre, cargo, fecha_nacimiento, enfermedades, horario_practicas, universidad_instituto) 
              VALUES (:dni, :nombre, :cargo, :fecha_nacimiento, :enfermedades, :horario_practicas, :universidad_instituto)";

    $stmt = $db->prepare($query);
    $stmt->bindParam(':dni', $dni);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':cargo', $cargo);
    $stmt->bindParam(':fecha_nacimiento', $fecha_nacimiento);
    $stmt->bindParam(':enfermedades', $enfermedades);
    $stmt->bindParam(':horario_practicas', $horario_practicas);
    $stmt->bindParam(':universidad_instituto', $universidad_instituto);

    if ($stmt->execute()) {
        echo "Usuario agregado con éxito.";
    } else {
        echo "Error al agregar usuario.";
    }
}

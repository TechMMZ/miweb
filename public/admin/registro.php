<?php
require_once '../../config/conexion.php';
$database = new Database();
$db = $database->getConnection();

$dni = "12345678";
$nombres = "Jean Meza";  // Nuevo campo
$password = password_hash("admin123", PASSWORD_DEFAULT);

$query = "INSERT INTO administradores (dni, nombres, password) VALUES (:dni, :nombres, :password)";
$stmt = $db->prepare($query);
$stmt->bindParam(':dni', $dni);
$stmt->bindParam(':nombres', $nombres);
$stmt->bindParam(':password', $password);
$stmt->execute();

echo "Administrador agregado con éxito.";

<?php
require_once '../../config/conexion.php';
$database = new Database();
$db = $database->getConnection();

$dni = "12345678";
$password = password_hash("admin123", PASSWORD_DEFAULT);

$query = "INSERT INTO administradores (dni, password) VALUES (:dni, :password)";
$stmt = $db->prepare($query);
$stmt->bindParam(':dni', $dni);
$stmt->bindParam(':password', $password);
$stmt->execute();

echo "Administrador agregado con éxito.";

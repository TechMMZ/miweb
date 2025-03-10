<?php
session_start();
require_once '../config/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dni = $_POST['codigo'];
    $password = $_POST['nombre'];

    $database = new Database();
    $db = $database->getConnection();

    $query = "SELECT * FROM administradores WHERE dni = :dni";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':dni', $dni);
    $stmt->execute();
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin'] = $admin['dni'];
        header("Location: ../public/admin/dashboardamin.php");
        exit();
    } else {
        echo "<script>alert('DNI o contraseña incorrectos'); window.location.href='index.html';</script>";
    }
}

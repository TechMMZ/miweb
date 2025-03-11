<?php
session_start();
require_once '../config/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dni = trim($_POST['codigo']); // Elimina espacios extra
    $password = trim($_POST['password']); // Elimina espacios extra

    if (empty($dni) || empty($password)) {
        echo "<script>alert('Debe completar todos los campos'); window.location.href='../public/admin/crear.php';</script>";
        exit();
    }

    $database = new Database();
    $db = $database->getConnection();

    $query = "SELECT dni, nombres, password FROM administradores WHERE dni = :dni";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':dni', $dni, PDO::PARAM_STR);
    $stmt->execute();
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin) {
        if (password_verify($password, $admin['password'])) {
            $_SESSION['admin'] = $admin['dni'];
            $_SESSION['admin_nombres'] = $admin['nombres'];
            header("Location: ../public/admin/dashboardamin.php");
            exit();
        } else {
            echo "<script>alert('Contraseña incorrecta'); window.location.href='../public/admin/crear.php';</script>";
        }
    } else {
        echo "<script>alert('DNI no encontrado'); window.location.href='../public/admin/crear.php';</script>";
    }
}

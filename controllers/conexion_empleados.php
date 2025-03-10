<?php
// conexion_empleados.php

include('../config/conexion.php'); // Incluye tu archivo de conexión a la base de datos

$database = new Database();
$conn = $database->getConnection();

// Si la solicitud es POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["usuario_id"]) && isset($_POST["codigo"])) {
        // Registrar código
        $usuario_id = $_POST["usuario_id"];
        $codigo = $_POST["codigo"];

        try {
            // Insertar el código en la tabla codigos
            $stmt = $conn->prepare("INSERT INTO codigos (usuario_id, codigo) VALUES (:usuario_id, :codigo)");
            $stmt->bindParam(":usuario_id", $usuario_id, PDO::PARAM_INT);
            $stmt->bindParam(":codigo", $codigo, PDO::PARAM_STR);

            if ($stmt->execute()) {
                // Obtener el ID del código recién insertado
                $codigo_id = $conn->lastInsertId();
                echo json_encode(["success" => true, "message" => "Código registrado correctamente.", "codigo_id" => $codigo_id]);
            } else {
                echo json_encode(["success" => false, "error" => "Error al registrar código."]);
            }
        } catch (PDOException $e) {
            echo json_encode(["success" => false, "error" => $e->getMessage()]);
        }
        exit;
    }

    if (isset($_POST["usuario_nombre"]) && isset($_POST["codigo"]) && isset($_POST["tipo"])) {
        // Registrar asistencia
        $usuario_nombre = $_POST["usuario_nombre"];
        $codigo = $_POST["codigo"];
        $tipo = $_POST["tipo"]; // Entrada o Salida

        try {
            // Verificar si el código existe en la tabla 'codigos'
            $stmt = $conn->prepare("SELECT id FROM codigos WHERE codigo = :codigo");
            $stmt->bindParam(":codigo", $codigo, PDO::PARAM_STR);
            $stmt->execute();
            $codigo_data = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$codigo_data) {
                echo json_encode(["success" => false, "error" => "Código no encontrado."]);
                exit;
            }

            $codigo_id = $codigo_data['id'];
            $fecha_actual = date("Y-m-d");
            $hora_actual = date("H:i:s");

            if ($tipo === "Entrada") {
                // Registrar entrada
                $stmt = $conn->prepare("INSERT INTO asistencia (usuario_nombre, codigo_entrada_id, fecha, hora_entrada) 
                                        VALUES (:usuario_nombre, :codigo_id, :fecha, :hora)");
                $stmt->bindParam(":usuario_nombre", $usuario_nombre, PDO::PARAM_STR);
                $stmt->bindParam(":codigo_id", $codigo_id, PDO::PARAM_INT);
                $stmt->bindParam(":fecha", $fecha_actual, PDO::PARAM_STR);
                $stmt->bindParam(":hora", $hora_actual, PDO::PARAM_STR);
            } elseif ($tipo === "Salida") {
                // Registrar salida (actualizar el registro existente de entrada)
                $stmt = $conn->prepare("UPDATE asistencia 
                                        SET codigo_salida_id = :codigo_id, hora_salida = :hora 
                                        WHERE usuario_nombre = :usuario_nombre AND fecha = :fecha 
                                        AND hora_salida IS NULL");
                $stmt->bindParam(":codigo_id", $codigo_id, PDO::PARAM_INT);
                $stmt->bindParam(":hora", $hora_actual, PDO::PARAM_STR);
                $stmt->bindParam(":usuario_nombre", $usuario_nombre, PDO::PARAM_STR);
                $stmt->bindParam(":fecha", $fecha_actual, PDO::PARAM_STR);
            } else {
                echo json_encode(["success" => false, "error" => "Tipo de asistencia inválido."]);
                exit;
            }

            if ($stmt->execute()) {
                echo json_encode(["success" => true, "message" => "Asistencia registrada correctamente."]);
            } else {
                echo json_encode(["success" => false, "error" => "Error al registrar asistencia."]);
            }
        } catch (PDOException $e) {
            echo json_encode(["success" => false, "error" => $e->getMessage()]);
        }
        exit;
    }
}

// Si la solicitud es GET, obtener los empleados
$query = "SELECT id, nombre FROM usuarios";
$stmt = $conn->prepare($query);
$stmt->execute();
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
// echo json_encode($usuarios);
return $usuarios;

<?php
// Incluir el archivo con la lógica de la base de datos
$usuarios = include('../controllers/conexion_empleados.php');
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/index.css">
</head>

<body>
    <div class="container">
        <h1>Acceso al Sistema</h1>
        <a class="navbar-brand">
            <img src="img/logo.png" width="120" height="50">
        </a>
        <form id="attendanceForm">
            <div class="input-group">
                <i class="fas fa-list icon"></i>
                <select id="options" name="options" required>
                    <option value="">Seleccione un usuario</option>
                    <?php
                    // Verificar si $usuarios contiene datos
                    if (!empty($usuarios)) {
                        foreach ($usuarios as $row) {
                            echo "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>No hay Usuarios disponibles</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="input-group">
                <i class="fas fa-lock icon"></i>
                <input type="text" id="codigo" name="codigo" placeholder="Código" required>
            </div>

            <!-- Selección de Entrada o Salida -->
            <fieldset class="form-fieldset">
                <label>Tipo de Asistencia:</label>
                <input type="radio" name="tipo" value="Entrada" required> Entrada
                <input type="radio" name="tipo" value="Salida"> Salida
            </fieldset>

            <button type="button" id="generate_code" class="btn btn-success">Generar Código</button>

            <fieldset class="form-fieldset" id="codigo_fieldset" style="display:none;">
                <label for="generated_code">Código Generado:</label>
                <input type="text" id="generated_code" readonly>
                <button type="button" id="copy_code" class="btn btn-secondary">Copiar</button>
            </fieldset>

            <button type="submit" class="btn btn-primary">Registrar Asistencia</button>
            <div class="admin-link">
                <p><a href="admin/crear.php" class="admin-link">Ingresar como Administrador</a></p>
            </div>
        </form>
    </div>

    <script src="login.js"></script>
</body>

</html>
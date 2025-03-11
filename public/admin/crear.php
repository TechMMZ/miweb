<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../css/login.css">
</head>

<body>
    <div class="container">
        <h1>Acceso Admin</h1>
        <a class="navbar-brand">
            <img src="../img/logo.png" width="120" height="50">
        </a>

        <!-- Formulario de login -->
        <form action="../../controllers/login.php" method="POST">
            <!-- Grupo DNI -->
            <div class="input-group">
                <span class="icon-container">
                    <i class="fas fa-id-card"></i>
                </span>
                <input type="text" id="codigo" name="codigo" placeholder="Ingrese Su DNI" maxlength="8" required>
            </div>

            <!-- Grupo Contraseña -->
            <div class="input-group">
                <span class="icon-container">
                    <i class="fas fa-lock"></i>
                </span>
                <input type="password" id="password" name="password" placeholder="Ingrese Su Contraseña" required>
            </div>

            <button type="submit" class="btn btn-primary">Ingresar</button>
        </form>

        <p><a href="../index.php">Registro de Asistencia</a></p>
    </div>
</body>

</html>
<?php
session_start();
// Verificar si el usuario está autenticado
if (!isset($_SESSION['admin'])) {
    header("Location: crear.php");
    exit;
}
// Obtener el nombre del administrador desde la sesión
$admin_nombres = isset($_SESSION['admin_nombres']) ? $_SESSION['admin_nombres'] : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/adm.css">
    <script src="../js/dashboardadmin.js" defer></script>
</head>

<body>
    <div class="sidebar">
        <h2>HASHTAGPE</h2>
        <div class="user-info">
            <div class="user-avatar">
                <i class="fas fa-user-circle"></i>
            </div>
            <div class="user-details">
                <span class="welcome-text">Bienvenido,</span>
                <span class="user-name"><?php echo htmlspecialchars($admin_nombres); ?></span>
            </div>
        </div>
        <ul class="sidebar-menu">
            <li><a href="#" onclick="showSection('dashboard')"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            </li>
            <li>
                <a href="#" onclick="toggleSubmenu()"><i class="fas fa-cogs"></i> Administrar</a>
                <ul id="submenu" style="display: none;">
                    <li><a href="#" onclick="showSection('asistencias')"><i class="fas fa-list"></i> Asistencias</a>
                    <li><a href="#" onclick="showSection('usuarios')"><i class="fas fa-users"></i> Usuarios</a></li>
                </ul>
            </li>
        </ul>
    </div>

    <div class="main-content">
        <div class="main-header">
            <button class="menu-toggle" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </button>
            <h1>Administración de Asistencias</h1>
            <div class="header-actions">
                <button class="btn btn-primary" onclick="logout()">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </div>
        </div>

        <div id="dashboard" class="section active">
            <div class="stats-container">
                <!-- Asistencias Totales -->
                <div class="stat-card" id="totalAsistencias">
                    <h3>Asistencias Totales</h3>
                    <p class="stat-value">Cargando...</p>
                    <p class="stat-change">Cargando...</p>
                </div>

                <!-- Día con más asistencias -->
                <div class="stat-card" id="diaMasAsistencias">
                    <h3>Día con más Asistencias</h3>
                    <p class="stat-value">Cargando...</p>
                </div>

                <!-- Última asistencia registrada -->
                <div class="stat-card" id="ultimaAsistencia">
                    <h3>Última Asistencia</h3>
                    <p class="stat-value">Cargando...</p>
                </div>
            </div>
        </div>

        <div id="asistencias" class="section">
            <div class="actions-container">
                <!-- Botón para exportar a PDF -->
                <a href="#" id="exportarPDF" target="_blank">
                    <button id="btnExportarPDF">
                        <i class="fa fa-file-pdf"></i> Exportar PDF
                    </button>
                </a>
                <!-- Contenedor de filtros -->
                <div class="name-filter-container">
                    <div class="name-input">
                        <input type="text" id="nombreFiltro" class="text-input" placeholder="Buscar por nombre">
                        <i class="fa fa-search search-icon"></i>
                    </div>
                </div>
            </div>

            <table id="asistenciasTable">
                <thead>
                    <tr>
                        <th>Nombre y Apellidos</th>
                        <th>Fecha</th>
                        <th>Hora Entrada</th>
                        <th>Hora Salida</th>
                    </tr>
                </thead>
                <tbody>
                    <?php include '../../controllers/asistencias.php'; ?>
                </tbody>
            </table>
        </div>

        <div id="usuarios" class="section">
            <div class="actions-container">
                <button id="btnAgregarUsuario">Agregar Usuario</button>
            </div>
            <!-- Modal para agregar usuario -->
            <div id="modalAgregarUsuario" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>Agregar Usuario</h2>
                    <form id="formAgregarUsuario">
                        <label for="dni">DNI:</label>
                        <input type="text" id="dni" name="dni" required>

                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" required>

                        <label for="cargo">Cargo:</label>
                        <input type="text" id="cargo" name="cargo" required>

                        <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>

                        <label for="enfermedades">Enfermedades:</label>
                        <input type="text" id="enfermedades" name="enfermedades">

                        <label for="horario_practicas">Horario de Prácticas:</label>
                        <input type="text" id="horario_practicas" name="horario_practicas" required>

                        <label for="universidad_instituto">Universidad / Instituto:</label>
                        <input type="text" id="universidad_instituto" name="universidad_instituto" required>
                        <button type="submit">Guardar</button>
                    </form>
                </div>
            </div>

            <table id="usuariosTable">
                <thead>
                    <tr>
                        <th class="center">ID Usuario</th>
                        <th>Nombres</th>
                        <th>DNI</th>
                        <th>Rol</th>
                        <th>Universidad / Instituto</th>
                    </tr>
                </thead>
                <tbody>
                    <?php include '../../controllers/usuarios.php'; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
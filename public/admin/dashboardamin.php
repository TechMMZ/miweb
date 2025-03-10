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
        <div class="user-info"><i class="fas fa-user-circle"></i>
            <span>Bienvenido, Admin</span>
        </div>
        <ul class="sidebar-menu">
            <li><a href="#" onclick="showSection('dashboard')"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            </li>
            <li>
                <a href="#" onclick="toggleSubmenu()"><i class="fas fa-cogs"></i> Administrar</a>
                <ul id="submenu" style="display: none;">
                    <li><a href="#" onclick="showSection('asistencias')"><i class="fas fa-list"></i> Asistencias</a>
                    <li><a href="#" onclick="showSection('usuarios')"><i class="fas fa-users"></i> Usuarios</a></li>
                    <li><a href="#" onclick="showSection('roles')"><i class="fas fa-user-tag"></i> Roles</a></li>
                    <li><a href="#" onclick="showSection('asignaciones')"><i class="fas fa-tasks"></i> Asignaciones</a>
                    </li>
                    <li><a href="#" onclick="showSection('permisos')"><i class="fas fa-lock"></i> Permisos</a></li>
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
                <div class="stat-card">
                    <h3>Asistencias Totales</h3>
                    <p class="stat-value">10</p>
                    <p class="stat-change">+15% vs mes anterior</p>
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
            <button id="btnAgregarUsuario">Agregar Usuario</button>
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

        <div id="roles" class="section">
            <button>Agregar Rol</button>
            <table id="rolesTable">
                <thead>
                    <tr>
                        <th>ID Rol</th>
                        <th>Nombre Usuario</th>
                        <th>Nombre del Rol</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>001</td>
                        <td>Juan Pérez</td>
                        <td>Administrador</td>
                        <td>
                            <i class="fas fa-edit action-icon" title="Editar permiso"></i>
                        </td>
                        <td>
                            <i class="fas fa-trash action-icon" title="Eliminar permiso"></i>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div id="asignaciones" class="section">
            <button>Agregar Asignación</button>
            <table id="asignacionesTable">
                <thead>
                    <tr>
                        <th>ID Asignación</th>
                        <th>Usuario</th>
                        <th>Rol Asignado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Juan Pérez</td>
                        <td>Administrador</td>
                        <td>
                            <i class="fas fa-edit action-icon" title="Editar asignación"></i>
                            <i class="fas fa-trash action-icon" title="Eliminar asignación"></i>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>María López</td>
                        <td>Usuario</td>
                        <td>
                            <i class="fas fa-edit action-icon" title="Editar asignación"></i>
                            <i class="fas fa-trash action-icon" title="Eliminar asignación"></i>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div id="permisos" class="section">
            <button>Agregar Permiso</button>
            <table id="permisosTable">
                <thead>
                    <tr>
                        <th>ID Permiso</th>
                        <th>Nombre del Permiso</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Acceso total</td>
                        <td>
                            <i class="fas fa-edit action-icon" title="Editar permiso"></i>
                            <i class="fas fa-trash action-icon" title="Eliminar permiso"></i>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Acceso limitado</td>
                        <td>
                            <i class="fas fa-edit action-icon" title="Editar permiso"></i>
                            <i class="fas fa-trash action-icon" title="Eliminar permiso"></i>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</body>

</html>
function showSection(sectionId) {
    // Oculta todas las secciones
    document.querySelectorAll('.section').forEach(section => {
        section.classList.remove('active');
    });

    // Muestra la sección seleccionada
    document.getElementById(sectionId).classList.add('active');

    // Si está en móvil, cerrar el sidebar
    if (window.innerWidth <= 768) {
        document.querySelector('.sidebar').classList.remove('active');
    }
}

function toggleSubmenu() {
    var submenu = document.getElementById('submenu');
    submenu.style.display = submenu.style.display === 'none' ? 'block' : 'none';
}

function toggleNotifications() {
    /*     var notificationArea = document.createElement('div');
        notificationArea.textContent = "No hay nuevas notificaciones";
        notificationArea.classList.add('notification-message');
        document.body.appendChild(notificationArea);
        setTimeout(function() {
            notificationArea.remove();
        }, 3000); // Desaparece en 3 segundos */
    alert("No hay nuevas notificaciones");
}

function logout() {
    alert("Sesión cerrada");
    window.location.href = '../admin/logout.php';
}

function toggleSidebar() {
    document.querySelector(".sidebar").classList.toggle("active");
}

document.getElementById("btnExportarPDF").addEventListener("click", function (e) {
    e.preventDefault();

    let filtro = document.getElementById("nombreFiltro").value.trim();
    let url = "../../controllers/exportar_pdf.php?filtro=" + encodeURIComponent(filtro);

    window.open(url, "_blank");
});

document.addEventListener("DOMContentLoaded", function () {
    // Obtener el campo de búsqueda y la tabla
    const inputNombre = document.getElementById("nombreFiltro");
    const tabla = document.getElementById("asistenciasTable");
    const filas = tabla.getElementsByTagName("tr");

    // Evento para detectar cambios en el input
    inputNombre.addEventListener("keyup", function () {
        let filtro = inputNombre.value.toLowerCase();

        // Recorrer todas las filas de la tabla (excepto la primera que es el encabezado)
        for (let i = 1; i < filas.length; i++) {
            let columnaNombre = filas[i].getElementsByTagName("td")[0]; // Primera columna (Nombre)

            if (columnaNombre) {
                let nombre = columnaNombre.textContent.toLowerCase();

                // Comprobar si el nombre coincide con el filtro
                if (nombre.includes(filtro)) {
                    filas[i].style.display = ""; // Mostrar la fila si coincide
                } else {
                    filas[i].style.display = "none"; // Ocultar la fila si no coincide
                }
            }
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {
    fetch('../../controllers/dashboard.php')
        .then(response => response.json())
        .then(data => {
            // Asistencias Totales
            document.querySelector("#totalAsistencias .stat-value").textContent = data.total_asistencias;
            document.querySelector("#totalAsistencias .stat-change").textContent = `${data.variacion}% vs mes anterior`;

            // Día con más asistencias
            document.querySelector("#diaMasAsistencias .stat-value").textContent = data.dia_mas_asistencias;

            // Última asistencia registrada
            document.querySelector("#ultimaAsistencia .stat-value").textContent = data.ultima_asistencia;
        })
        .catch(error => console.error("Error cargando datos:", error));
});

document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("modalAgregarUsuario");
    const btnAbrirModal = document.getElementById("btnAgregarUsuario");
    const btnCerrarModal = document.querySelector(".close");
    const formAgregarUsuario = document.getElementById("formAgregarUsuario");

    // Abrir el modal con display flex
    btnAbrirModal.addEventListener("click", function () {
        modal.style.display = "flex"; // Mantiene la alineación correcta
    });

    // Cerrar el modal
    btnCerrarModal.addEventListener("click", function () {
        modal.style.display = "none";
    });

    // Cerrar modal al hacer clic fuera del contenido
    window.addEventListener("click", function (e) {
        if (e.target === modal) {
            modal.style.display = "none";
        }
    });

    // Enviar datos del formulario al servidor
    formAgregarUsuario.addEventListener("submit", function (e) {
        e.preventDefault();

        const formData = new FormData(formAgregarUsuario);

        fetch('../../controllers/agregar_usuario.php', {
            method: "POST",
            body: formData
        })
            .then(response => response.text())
            .then(data => {
                alert(data); // Mensaje de éxito o error
                modal.style.display = "none";
                formAgregarUsuario.reset();
                location.reload(); // Recargar la tabla
            })
            .catch(error => console.error("Error al guardar usuario:", error));
    });
});
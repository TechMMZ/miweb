function showSection(sectionId) {
    document.querySelectorAll('.section').forEach(function (section) {
        section.classList.remove('active');
    });
    document.getElementById(sectionId).classList.add('active');
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

document.getElementById("btnExportarPDF").addEventListener("click", function (e) {
    e.preventDefault(); // Evita que el botón recargue la página

    let url = "../../controllers/exportar_pdf.php";
    window.open(url, "_blank");
});

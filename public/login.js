// Variable para almacenar el código generado
let generatedCode = "";

// Función para generar un código aleatorio de una longitud específica
function generateRandomCode(length = 8) {
    // Caracteres que se utilizarán para generar el código
    let characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    // Generar un código aleatorio utilizando los caracteres definidos
    return Array.from({ length }, () => characters.charAt(Math.floor(Math.random() * characters.length))).join("");
}

// Deshabilitar los botones de radio al inicio
document.querySelectorAll('input[name="tipo"]').forEach(radio => radio.disabled = true);

// Evento que se activa al hacer clic en el botón "Generar Código"
document.getElementById("generate_code").addEventListener("click", function () {
    // Obtener el empleado seleccionado
    let selectedEmployee = document.getElementById("options").value;

    // Verificar si se ha seleccionado un empleado
    if (!selectedEmployee) {
        alert("Por favor, seleccione un empleado antes de generar el código.");
        return; // Salir de la función si no hay empleado seleccionado
    }

    // Verificar si ya se ha generado un código
    if (generatedCode) {
        alert("El código ya fue generado. Si necesitas uno nuevo, completa el proceso o cambia el usuario.");
        return; // Salir de la función si ya hay un código generado
    }

    // Deshabilitar el campo de selección de empleados para evitar cambios
    document.getElementById("options").disabled = true;

    // Generar un nuevo código aleatorio
    generatedCode = generateRandomCode();

    // Mostrar el código generado en el campo correspondiente
    document.getElementById("generated_code").value = generatedCode;

    // (Opcional) Asignar el código generado al campo de código (si es necesario)
    // document.getElementById("codigo").value = generatedCode; // Si no deseas esto, puedes eliminar esta línea

    // Enviar el código generado y el ID del usuario al servidor

    fetch("../controllers/conexion_empleados.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `usuario_id=${selectedEmployee}&codigo=${generatedCode}` // Datos a enviar
    })
        .then(response => response.json()) // Convertir la respuesta a JSON
        .then(data => {
            // Verificar si la respuesta fue exitosa
            if (data.success) {
                alert("Código almacenado correctamente."); // Mensaje de éxito
            } else {
                alert("Error al almacenar el código: " + data.error); // Mensaje de error
            }
        })
        .catch(error => console.error("Error en la solicitud:", error)); // Manejo de errores en la solicitud

    // Mostrar el campo para el código generado
    document.getElementById("codigo_fieldset").style.display = "block";

    // Hacer que el campo de código sea editable
    document.getElementById("codigo").readOnly = false;

    // Habilitar los botones de radio para seleccionar tipo de asistencia
    document.querySelectorAll('input[name="tipo"]').forEach(radio => radio.disabled = false);
});

// Evento que se activa al hacer clic en el botón "Copiar Código"
document.getElementById("copy_code").addEventListener("click", function () {
    // Seleccionar el texto del campo de código generado
    let copyText = document.getElementById("generated_code");
    copyText.select(); // Seleccionar el texto
    document.execCommand("copy"); // Copiar el texto seleccionado al portapapeles

    // Mostrar un mensaje de confirmación
    alert("Código copiado: " + copyText.value);

    // Ocultar el campo de código generado después de copiar
    document.getElementById("codigo_fieldset").style.display = "none"; // Ocultar el campo de código generado
});

// Evento que se activa al cambiar la selección de empleado
document.getElementById("options").addEventListener("change", function () {
    // Limpiar el campo de código y el campo de código generado
    document.getElementById("codigo").value = "";
    document.getElementById("codigo").readOnly = true; // Hacer que el campo de código sea de solo lectura
    document.getElementById("generated_code").value = "";
    generatedCode = ""; // Reiniciar la variable de código generado
    document.getElementById("codigo_fieldset").style.display = "none"; // Ocultar el campo de código generado

    // Deshabilitar los botones de radio y desmarcarlos
    document.querySelectorAll('input[name="tipo"]').forEach(radio => {
        radio.disabled = true; // Deshabilitar los botones de radio
        radio.checked = false; // Desmarcar los botones de radio
    });

    // Habilitar nuevamente el campo de selección de empleados
    document.getElementById("options").disabled = false;
});

// Evento que se activa al enviar el formulario
document.getElementById("attendanceForm").addEventListener("submit", function (event) {
    // Obtener el código ingresado por el usuario
    let enteredCode = document.getElementById("codigo").value;
    let selectedEmployeeId = document.getElementById("options").value; // Obtener el ID del usuario seleccionado
    let selectedType = document.querySelector('input[name="tipo"]:checked'); // Obtener el tipo de asistencia seleccionado

    // Obtener el nombre del usuario seleccionado
    let selectedEmployeeName = document.querySelector('#options option:checked').text; // Obtener el nombre del usuario

    // Verificar si el código ingresado coincide con el código generado
    if (enteredCode !== generatedCode) {
        event.preventDefault(); // Evitar el envío del formulario
        alert("El código ingresado no es válido."); // Mensaje de error
    } else if (!selectedType) {
        event.preventDefault(); // Evitar el envío del formulario
        alert("Por favor, seleccione un tipo de asistencia."); // Mensaje de error si no se selecciona tipo
    } else {
        // Si todo es correcto, puedes enviar el formulario
        alert("El código es válido, se procederá a registrar la asistencia."); // Mensaje de éxito

        // Aquí puedes agregar lógica para enviar los datos al servidor si no se envía automáticamente
        const tipoAsistencia = selectedType.value; // Obtener el valor del tipo de asistencia

        // Crear un objeto FormData para enviar los datos
        const formData = new FormData();
        formData.append('usuario_nombre', selectedEmployeeName); // Cambiar a nombre del usuario
        formData.append('codigo', enteredCode);
        formData.append('tipo', tipoAsistencia);

        // Enviar los datos al servidor
        fetch("../controllers/conexion_empleados.php", {
            method: "POST",
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Asistencia registrada correctamente.");
                    // event.target.submit(); // Enviar el formulario si la respuesta es exitosa
                    window.location.href = "index.php";
                } else {
                    alert("Error al registrar asistencia: " + data.error);
                }
            })
            .catch(error => console.error("Error en la solicitud:", error));

        event.preventDefault(); // Evitar el envío del formulario por defecto
    }
});
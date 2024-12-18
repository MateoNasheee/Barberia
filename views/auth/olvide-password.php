
<div class="centrar-login">
<div class="contenedor-flecha">
        <a href="#" id="retroceso" class="flecha-retroceso">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
    </div>
<h1 class="nombre-pagina">Olvide Password</h1>
<p class="descripcion-pagina">Reestablece tu password escribiendo tu email a continuación</p>

<?php 
    include_once __DIR__ . "/../templates/alertas.php";
?>

<form class="formulario-login" action="/olvide" method="POST">
    <div class="campo">
        <label for="email">Email</label>
        <input 
            type="email"
            id="email"
            name="email"
            placeholder="Tu Email"
        />
    </div>

    <input type="submit" class="botonR" value="Enviar Instrucciones" >
    <div class="acciones">
    <a href="#" id="iniciar-link">¿Ya tienes una cuenta? Inicia Sesión</a>
    <a href="#" id="crear-link">¿Aún no tienes una cuenta? Create una</a>
</div>
</form>
</div>


<style>
/* Estilos para la animación */
.fade-out {
    animation: fadeOut 0.5s forwards;
}

@keyframes fadeOut {
    to {
        opacity: 0;
        transform: translateY(-10%);
    }
}
</style>

<script>
    // Obtener el enlace y agregar el evento de clic
    document.getElementById("iniciar-link").addEventListener("click", function(event) {
        event.preventDefault(); // Evitar la redirección inmediata

        // Agregar la clase de animación al body
        document.body.classList.add("fade-out");

        // Redirigir después de la animación
        setTimeout(() => {
            window.location.href = "/login";
        }, 500); // Duración de la animación en milisegundos
    });
</script>

<script>
    // Obtener el enlace y agregar el evento de clic
    document.getElementById("crear-link").addEventListener("click", function(event) {
        event.preventDefault(); // Evitar la redirección inmediata

        // Agregar la clase de animación al body
        document.body.classList.add("fade-out");

        // Redirigir después de la animación
        setTimeout(() => {
            window.location.href = "/crear-cuenta";
        }, 500); // Duración de la animación en milisegundos
    });
</script>


<script>
    // Redirección con animación suave
    document.getElementById("retroceso").addEventListener("click", function(event) {
        event.preventDefault(); // Evita la redirección inmediata

        // Agregar la animación de salida al body
        document.body.classList.add("fade-out");

        // Redirigir después de la animación
        setTimeout(() => {
            window.location.href = "/login";
        }, 500); // Duración de la animación
    });
</script>
<script>
   document.addEventListener('DOMContentLoaded', function() {
    // Variables
    const email = document.getElementById('email');
    const submit = document.querySelector('input[type="submit"]');
    const dominiosPermitidos = ['gmail.com', 'hotmail.com', 'yahoo.com', 'outlook.com'];

    // Agregar evento de validación al campo de email
    email.addEventListener('input', validarEmail);

    // Función para validar el email
    function validarEmail() {
        limpiarErrores('email');

        const emailRegex = /^[^\s@]+@[^\s@]+\.[a-z]{2,3}$/;
        const dominioEmail = email.value.split('@')[1];

        if (email.value.trim() === '') {
            agregarError('El email es obligatorio.', 'email');
        } else if (!emailRegex.test(email.value)) {
            agregarError('El email debe ser una dirección válida.', 'email');
        } else if (dominioEmail && !dominiosPermitidos.includes(dominioEmail)) {
            agregarError('El dominio del email debe ser válido.', 'email');
        }

        controlarSubmit();
    }

    // Función para agregar errores
    function agregarError(mensaje, campo) {
        const campoInput = document.getElementById(campo);
        const mensajeError = campoInput.nextElementSibling;

        if (mensajeError && mensajeError.classList.contains('mensaje-error')) {
            mensajeError.textContent = mensaje;
            mensajeError.classList.add('mostrar-error');
        } else {
            const nuevoMensajeError = document.createElement('p');
            nuevoMensajeError.classList.add('mensaje-error', 'mostrar-error');
            nuevoMensajeError.textContent = mensaje;
            campoInput.parentElement.appendChild(nuevoMensajeError);
        }

        campoInput.classList.add('error'); // Añadir clase al input con error
    }

    // Función para limpiar errores
    function limpiarErrores(campo) {
        const campoInput = document.getElementById(campo);
        const mensajeError = campoInput.nextElementSibling;

        if (mensajeError && mensajeError.classList.contains('mensaje-error')) {
            mensajeError.remove(); // Eliminar el elemento del DOM
        }

        campoInput.classList.remove('error');
    }

    // Función para controlar el estado del botón submit
    function controlarSubmit() {
        const mensajesError = document.querySelectorAll('.mensaje-error.mostrar-error');
        const emailValido = email.value.trim() !== '' && !mensajesError.length;

        submit.disabled = !emailValido;
    }

    // Deshabilitar el botón de submit inicialmente
    controlarSubmit();
});


</script>


<?php include_once __DIR__ . '/../templates/footer.php'; ?>
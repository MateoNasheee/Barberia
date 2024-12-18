
<div class="centrar-login">
    <!-- Flecha de retroceso -->
    <div class="contenedor-flecha">
        <a href="#" id="retroceso" class="flecha-retroceso">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
    </div>
    <?php include_once __DIR__ . "/../templates/alertas.php"; ?>

    <h1 class="nombre-pagina">Crear Cuenta</h1>
    <p class="descripcion-pagina">Llena el siguiente formulario para crear una cuenta</p>
    <!-- Contenedor de errores arriba del formulario -->
    <div id="contenedor-errores"></div> 

    <form class="formulario-login" method="POST" action="/crear-cuenta">
        <div class="campo">
            <label for="nombre">Nombre</label>
            <input
                type="text"
                id="nombre"
                name="nombre"
                placeholder="Tu Nombre"
                value="<?php echo s($usuario->nombre); ?>"
            />
        </div>

        <div class="campo">
            <label for="apellido">Apellido</label>
            <input
                type="text"
                id="apellido"
                name="apellido"
                placeholder="Tu Apellido"
                value="<?php echo s($usuario->apellido); ?>"
            />
        </div>

        <div class="campo">
            <label for="telefono">Teléfono</label>
            <input
                type="tel"
                id="telefono"
                name="telefono"
                placeholder="Tu Teléfono(Opcional)"
                value="<?php echo s($usuario->telefono); ?>"
            />
        </div>

        <div class="campo">
            <label for="email">E-mail</label>
            <input
                type="email"
                id="email"
                name="email"
                placeholder="Tu E-mail"
                value="<?php echo s($usuario->email); ?>"
            />
        </div>

        <div class="campo">
            <label for="password">Password</label>
            <input
                type="password"
                id="password"
                name="password"
                placeholder="Tu Password"
            />
        </div>

        <div class="campo">
        <label for="confirmar_password">Confirmar Password</label>
        <input
            type="password"
            id="confirmar_password"
            name="confirmar_password"
            placeholder="Confirma tu Password"
        />
    </div>

    <div id="loading-spinner" class="loading-spinner">
        <div class="razor"></div>
    </div> 

    <input type="submit" value="Crear Cuenta" class="botonR" id="enviar" disabled> 
    <div class="acciones">
        <a href="#" id="iniciar-link">¿Ya tienes una cuenta? Inicia Sesión</a>
        <a href="#" id="olvide-link">¿Olvidaste tu contraseña? Te Ayudamos</a>
    </div>
    </form>
</div>

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
    document.getElementById("olvide-link").addEventListener("click", function(event) {
        event.preventDefault(); // Evitar la redirección inmediata

        // Agregar la clase de animación al body
        document.body.classList.add("fade-out");

        // Redirigir después de la animación
        setTimeout(() => {
            window.location.href = "/olvide";
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
    const nombre = document.getElementById('nombre');
    const apellido = document.getElementById('apellido');
    const email = document.getElementById('email');
    const password = document.getElementById('password');
    const submit = document.querySelector('input[type="submit"]');
    const erroresContenedor = document.getElementById('contenedor-errores'); // Contenedor de errores
    const spinner = document.getElementById('loading-spinner'); // Spinner de carga
    const confirmarPassword = document.getElementById('confirmar_password');
    let errores = [];

    // Lista de dominios de correo válidos
    const dominiosPermitidos = ['gmail.com', 'hotmail.com', 'yahoo.com', 'outlook.com'];

    // Expresiones regulares
    const regexSoloLetras = /^[a-zA-Z\s]+$/;  // Solo letras y espacios
    const regexSoloNumeros = /^[0-9]+$/; // Solo números
    const regexCaracteresEspeciales = /[^\w\s]/; // Caracteres especiales

    // Validaciones individuales
    nombre.addEventListener('input', validarCampoNombre);
    apellido.addEventListener('input', validarCampoApellido);
    email.addEventListener('input', validarCampoEmail);
    password.addEventListener('input', validarCampoPassword);
    confirmarPassword.addEventListener('input', validarCampoConfirmarPassword);
    // Validación y control del spinner al enviar el formulario
    document.querySelector('form').addEventListener('submit', function(event) {
        event.preventDefault(); // Previene el envío inmediato del formulario

        validarFormularioCompleto(); // Ejecutar las validaciones

        if (errores.length === 0 && camposCompletos()) {
            // Si no hay errores, mostrar el spinner y luego enviar el formulario
            spinner.classList.add('show');

            setTimeout(function() {
                event.target.submit(); // Envía el formulario después del retraso
            }, 1000); // Ajustar este tiempo según tus necesidades
        }
    });
    // Función para verificar que las contraseñas coinciden
    function validarCampoConfirmarPassword() {
        limpiarErrores('confirmar_password');
        
        if (confirmarPassword.value.trim() === '') {
            agregarError('La confirmación de contraseña es obligatoria.', 'confirmar_password');
        } else if (password.value !== confirmarPassword.value) {
            agregarError('Las contraseñas no coinciden.', 'confirmar_password');
        }
        
        controlarSubmit();
    }
    // Función para verificar si los campos obligatorios están llenos
    function camposCompletos() {
        return nombre.value.trim() !== '' && 
               apellido.value.trim() !== '' && 
               email.value.trim() !== '' && 
               password.value.trim() !== '';
    }

    // Funciones de validación de campos
    function validarCampoNombre() {
        limpiarErrores('nombre');

        if (nombre.value.trim() === '') {
            agregarError('El nombre es obligatorio.', 'nombre');
        } else {
            if (regexSoloNumeros.test(nombre.value)) {
                agregarError('El nombre no puede contener números.', 'nombre');
            }
            if (regexCaracteresEspeciales.test(nombre.value)) {
                agregarError('El nombre no puede contener caracteres especiales.', 'nombre');
            }
            if (nombre.value.trim().length < 2 && !regexSoloNumeros.test(nombre.value) && !regexCaracteresEspeciales.test(nombre.value)) {
                agregarError('El nombre debe contener más de un carácter.', 'nombre');
            }
        }

        controlarSubmit();
    }

    function validarCampoApellido() {
        limpiarErrores('apellido');

        if (apellido.value.trim() === '') {
            agregarError('El apellido es obligatorio.', 'apellido');
        } else {
            if (regexSoloNumeros.test(apellido.value)) {
                agregarError('El apellido no puede contener números.', 'apellido');
            }
            if (regexCaracteresEspeciales.test(apellido.value)) {
                agregarError('El apellido no puede contener caracteres especiales.', 'apellido');
            }
            if (apellido.value.trim().length < 2 && !regexSoloNumeros.test(apellido.value) && !regexCaracteresEspeciales.test(apellido.value)) {
                agregarError('El apellido debe contener más de un carácter.', 'apellido');
            }
        }

        controlarSubmit();
    }

    function validarCampoEmail() {
        limpiarErrores('email');
        const emailRegex = /^[^\s@]+@[^\s@]+\.[a-z]{2,3}$/;
        const dominioEmail = email.value.split('@')[1];

        if (email.value.trim() === '') {
            agregarError('El email es obligatorio.', 'email');
        } else {
            if (!emailRegex.test(email.value)) {
                agregarError('El email debe ser una dirección válida.', 'email');
            }
            if (dominioEmail && !dominiosPermitidos.includes(dominioEmail)) {
                agregarError('El dominio del email debe ser válido.', 'email');
            }
        }

        controlarSubmit();
    }

    function validarCampoPassword() {
        limpiarErrores('password');

        if (password.value.trim() === '') {
            agregarError('El password es obligatorio.', 'password');
        } else if (password.value.length < 6) {
            agregarError('El password debe tener al menos 6 caracteres.', 'password');
        }

        controlarSubmit();
    }

    // Función para validar todo el formulario
    function validarFormularioCompleto() {
        errores = [];
        validarCampoNombre();
        validarCampoApellido();
        validarCampoEmail();
        validarCampoPassword();
    }

    // Función para agregar errores debajo del input correspondiente
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

    // Función para limpiar errores específicos
    function limpiarErrores(campo) {
        const campoInput = document.getElementById(campo);
        const mensajeError = campoInput.nextElementSibling;

        if (mensajeError && mensajeError.classList.contains('mensaje-error')) {
            mensajeError.classList.remove('mostrar-error');
            mensajeError.textContent = '';
        }

        campoInput.classList.remove('error'); // Quitar la clase del input
    }

    // Función para controlar el estado del botón submit
    function controlarSubmit() {
        const mensajesError = document.querySelectorAll('.mensaje-error.mostrar-error');
        submit.disabled = mensajesError.length > 0 || !camposCompletos();
    }
});

</script>

<?php include_once __DIR__ . '/../templates/footer.php'; ?>
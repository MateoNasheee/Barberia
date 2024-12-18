<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


<?php if ($_SERVER['REQUEST_URI'] === '/confirmar-cuenta'): ?>
    <!-- Barra específica para la página de crear cuenta -->
    <div class="barra">
    <a href="/" class="logo-barberia"></a>
        <div class="menu-hamburguesa">
            <i class="fas fa-bars" id="hamburguesa-icono" onclick="toggleMenu(); toggleIcon();"></i>
            <div class="menu-desplegable" id="menu">
                <a href="/" class="menu-item">Inicio</a>
                <a href="/login" class="menu-item">Iniciar Sesión</a>
                
            </div>
        </div>
        <div class="enlaces-fuera">
            <a href="/" class="menu-item">Inicio</a>
            <a href="/login" class="menu-item">Iniciar Sesión</a>
            
        </div>
    </div>

<?php elseif ($_SERVER['REQUEST_URI'] === '/mensaje'): ?>
    <!-- Barra específica para la página de crear cuenta -->
    <div class="barra">
    <a href="/" class="logo-barberia"></a>
        <div class="menu-hamburguesa">
            <i class="fas fa-bars" id="hamburguesa-icono" onclick="toggleMenu(); toggleIcon();"></i>
            <div class="menu-desplegable" id="menu">
                <a href="/" class="menu-item">Inicio</a>
                <a href="/login" class="menu-item">Iniciar Sesión</a>
                
            </div>
        </div>
        <div class="enlaces-fuera">
            <a href="/" class="menu-item">Inicio</a>
            <a href="/login" class="menu-item">Iniciar Sesión</a>
            
        </div>
    </div>
<?php elseif ($_SERVER['REQUEST_URI'] === '/login'): ?>
    <!-- Barra específica para la página de login -->
    <div class="barra">
    <a href="/" class="logo-barberia"></a>
        <div class="menu-hamburguesa">
            <i class="fas fa-bars" id="hamburguesa-icono" onclick="toggleMenu(); toggleIcon();"></i>
            <div class="menu-desplegable" id="menu">
                <a href="/" class="menu-item">Incio</a>
                
            </div>
        </div>
        <div class="enlaces-fuera">
            <a href="/" class="menu-item">Inicio</a>
            
        </div>
    </div>
<?php elseif (isset($_SESSION['login']) && $_SESSION['login'] === true): ?>
    <!-- Usuario logueado -->
    <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] === "1"): ?>
        <!-- Barra para administradores -->
        <div class="barra-servicios">
    <a class="boton-barra" href="/crearCita">
        <i class="fas fa-calendar-plus"></i> Crear Cita
    </a>
    <a class="boton-barra" href="/admin">
        <i class="fas fa-calendar-alt"></i> Ver Citas
    </a>
    <a class="boton-barra" href="/servicios">
        <i class="fas fa-concierge-bell"></i> Ver Servicios
    </a>
    <a class="boton-barra" href="/servicios/crear">
        <i class="fas fa-plus-circle"></i> Nuevo Servicio
    </a>
    <a class="boton-barra" href="/logout">
        <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
    </a>
</div>

    <?php else: ?>
<!-- Usuario autenticado -->
<div class="barra">
    <a href="/cita" class="logo-barberia"></a>
    <div class="menu-container">
        <div class="menu-hamburguesa">
            <i class="fas fa-bars" id="hamburguesa-icono" onclick="toggleMenu(); toggleIcon();"></i>
            <div class="menu-desplegable" id="menu">
                <a href="#inicio" class="menu-item">Inicio</a>
                <a href="#sobre-nosotros" class="menu-item">Sobre Nosotros</a>
                <a href="#servicio" class="menu-item">Servicios</a>
                <a href="#tendencias" class="menu-item">Tendencias</a>
                <a href="#precios" class="menu-item">Precios</a>
                <a href="#ubicacion" class="menu-item">Contactános</a>
            </div>
        </div>
        <div class="enlaces-fuera">
            <a href="#inicio" class="menu-item">Inicio</a>
            <a href="#sobre-nosotros" class="menu-item">Sobre Nosotros</a>
            <a href="#servicio" class="menu-item">Servicios</a>
            <a href="#tendencias" class="menu-item">Tendencias</a>
            <a href="#precios" class="menu-item">Precios</a>
            <a href="#ubicacion" class="menu-item">Contactános</a>
            
        </div>
        <div class="menu-usuario">
            <i class="fas fa-user menu-usuario-icono" onclick="toggleUserMenu();"></i>
            <div class="menu-usuario-desplegable" id="user-menu">
                <a href="#" class="menu-usuario-item" onclick="abrirModalPerfil(); return false;">
                    <i class="fas fa-user"></i> Perfil
                </a>

                <a href="#" class="menu-usuario-item" onclick="abrirModalHistorial(); return false;">
                    <i class="fas fa-calendar-alt"></i> Mis Turnos
                </a>
                <a href="/logout" class="menu-usuario-item">
                    <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                </a>
            </div>
        </div>
    </div>
</div>

    <?php endif; ?>
<?php else: ?>
    <!-- Usuario no logueado -->
    <div class="barra">
    <a href="/" class="logo-barberia"></a> 
        <div class="menu-hamburguesa">
            <i class="fas fa-bars" id="hamburguesa-icono" onclick="toggleMenu(); toggleIcon();"></i>
            <div class="menu-desplegable" id="menu">
                <a href="#inicio" class="menu-item">Inicio</a>
                <a href="#sobre-nosotros" class="menu-item">Sobre Nosotros</a>
                <a href="#servicio" class="menu-item">Servicios</a>
                <a href="#tendencias" class="menu-item">Tendencias</a>
                <a href="#precios" class="menu-item">Precios</a>
                <a href="#ubicacion" class="menu-item">Contactános</a>
                <a href="/login" class="menu-item">Iniciar Sesión</a>
            </div>
        </div>
        <div class="enlaces-fuera">
            <a href="#inicio" class="menu-item">Inicio</a>
            <a href="#sobre-nosotros" class="menu-item">Sobre Nosotros</a>
            <a href="#servicio" class="menu-item">Servicios</a>
            <a href="#tendencias" class="menu-item">Tendencias</a>
            <a href="#precios" class="menu-item">Precios</a>
            <a href="#ubicacion" class="menu-item">Contactános</a>
            <a href="/login" class="menu-item">Iniciar Sesión</a>
        </div>
    </div>
<?php endif; ?>

<script>
    document.querySelector('.logo-barberia').addEventListener('click', function() {
    window.location.href = '/';
});

</script>
<script>
function toggleUserMenu() {
    const userMenu = document.getElementById('user-menu');
    userMenu.classList.toggle('mostrar');
}

// Cerrar el menú desplegable cuando se hace clic fuera de él
document.addEventListener('click', function(event) {
    const userMenu = document.getElementById('user-menu');
    const userIcon = document.querySelector('.menu-usuario-icono');

    if (userMenu.classList.contains('mostrar') && !userMenu.contains(event.target) && !userIcon.contains(event.target)) {
        userMenu.classList.remove('mostrar');
    }
});
</script>

<script>
document.querySelectorAll('.menu-item[href^="#"]').forEach(link => {
    link.addEventListener('click', function (e) {
        e.preventDefault();

        // Remueve la clase activa de todos los enlaces
        document.querySelectorAll('.menu-item').forEach(item => {
            item.classList.remove('activo');
        });

        // Agrega la clase activa al enlace clicado
        this.classList.add('activo');

        // Realiza el scroll suave a la sección
        const targetId = this.getAttribute('href');
        const targetElement = document.querySelector(targetId);
        if (targetElement) {
            targetElement.scrollIntoView({ behavior: 'smooth' });
        }
    });
});

// Función para observar las secciones
const sections = document.querySelectorAll('.menu-item[href^="#"]');
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        const id = entry.target.getAttribute('id');
        const menuLink = document.querySelector(`.menu-item[href="#${id}"]`);

        if (entry.isIntersecting) {
            // Remueve la clase activa de todos los enlaces
            document.querySelectorAll('.menu-item').forEach(item => {
                item.classList.remove('activo');
            });

            // Agrega la clase activa al enlace en el viewport
            if (menuLink) {
                menuLink.classList.add('activo');
            }
        }
    });
}, { rootMargin: '-50% 0px -50% 0px' }); // Ajusta el margen para activar cuando la sección esté en el centro de la pantalla

// Observa cada sección
sections.forEach(link => {
    const targetId = link.getAttribute('href').substring(1);
    const targetElement = document.getElementById(targetId);
    if (targetElement) {
        observer.observe(targetElement);
    }
});
</script>






<div id="modal-historial" class="modalHistorial" style="display: none;">
    <div class="modal-contenido-historial">
        <input type="hidden" id="usuario-id" name="id" value="<?php echo $_SESSION['id']; ?>">
        <span class="cerrar-modal" onclick="cerrarModalHistorial()">&times;</span>
        <h2>Mis Turnos</h2>
        <div id="historial-content">
            <!-- Aquí se cargará el contenido del historial -->
        </div>
    </div>
</div>

<!-- Modal para seleccionar parte del día -->
<div id="modal-seleccionar-turno-editar" class="modal-seleccionar-turno">
    <div class="modal-contenido-seleccionar">
        <h3 class="text-center">Selecciona tu Horario</h3>
        <p class="text-center">¿Qué parte del día prefieres?</p>
        <div class="campo">
            <input id="fecha" type="date" />
        </div>
        <div class="campo-hora">
            <div class="botones-turno">
                <button id="turno-manana" type="button" class="button-hora" onclick="mostrarHorariosEdicion('manana')">Mañana</button>
                <button id="turno-tarde" type="button" class="button-hora" onclick= "mostrarHorariosEdicion('tarde')">Tarde</button>
            </div>
            <div id="horarios2" class="horarios-container"></div>
        </div>
        <button id="confirmar-modal-seleccionar" class="btn-confirmar confirmarselecionado" onclick="confirmar()" disabled>Confirmar</button>
        <button id="cerrar-modal-secundario" class="btn" onclick="cerrarModalSecun()";>Cerrar</button>
    </div>
</div>


<div id="modal-editar-historial" class="modal-editar" style="display: none;">
    <div id="modal-content" class="modal-content">
        <h2>Detalles del Turno</h2>
        <div id="editar-content" class="modal-body">
            <!-- Contenido de la cita cargado dinámicamente -->
        </div>
        <div class="modal-buttons">
            <button class="btn editar" onclick="editarServicio()">Cambiar Servicio</button>
            <button class="btn anular" onclick="anularServicio()">Cancelar Servicio</button>
            
        </div>
        <button class="btn cancelar" onclick="cerrarModalEditarHistorial()">Cancelar</button>
    </div>
</div>



<div id="modal-anular" class="modal-anular" style="display: none;">
    <div class="modal-content">
        <h2>¿Qué deseas anular?</h2>
        <div class="modal-body">
            <p>Elige una de las opciones:</p>
            <div class="modal-buttons-anular">
                <button class="btn anular-servicio" onclick="anularServicio()">Anular Servicio</button>
                <button class="btn anular-turno" onclick="anularTurnoCompleto()">Anular Turno Completo</button>
            </div>
        </div>
        <button class="btn cancelar" onclick="cerrarModalAnular()">Cancelar</button>
    </div>
</div>




<div id="modal-seleccion-edicion" class="modal-seleccion" style="display: none;">
    <div class="modal-content-seleccion">
        <h2>¿Qué prefieres editar?</h2>
        <div class="modal-seleccion-buttons">
            <button class="btn-opcion" onclick="editarFecha()">Fecha</button>
            <button class="btn-opcion" onclick="editarServicio()">Servicio</button>
            <button class="btn-cancelar" onclick="cerrarModalSeleccionEdicion()">Cancelar</button>
        </div>
    </div>
</div>


<div id="modal-servicio" class="modal-seleccion-servicio" style="display: none;">
    <div class="modal-content-seleccion-servicio">
        <h2 style="color: #d4af37;">Selecciona un servicio</h2> <!-- Título dorado -->
        <div id="servicios-edicion" class="listado-servicios-edicion"></div> <!-- Nuevo contenedor -->

        
    </div>
    <div class="sticky">
            <button class="btn-cancelar" onclick="cerrarModalServicio()">Cancelar</button>
            <button id="btn-confirmar-servicio" class="btn-confirmar" onclick="confirmarServicioEdicion()" disabled>Confirmar</button>
        </div>
</div>



<div id="modal-servicio-agregar" class="modal-seleccion-servicio" style="display: none;">
    <div class="modal-content-seleccion-servicio">
        <h2>Selecciona un servicio</h2>
        <div id="servicios-edicion-agregar" class="listado-servicios-edicion-agregar"></div> <!-- Nuevo contenedor -->
        
    </div>
    <div class="sticky">
    <button class="btn-cancelar" onclick="cerrarModalServicioAgregar()">Cancelar</button>
    <button id="btn-confirmar-servicio-agregar" class="btn-confirmar" onclick="confirmarServicioAgregar()" disabled>Confirmar</button>
    </div>
</div>



<div id="loading-spinner" class="loading-spinner">
    <div class="razor"></div>
</div>


<script>
   function editarServicio() {
    const modalServicio = document.getElementById('modal-servicio');
    modalServicio.style.display = 'block'; // Asegúrate de que el estilo se aplique
    modalServicio.classList.remove('hide'); // Remover clase hide
    modalServicio.classList.add('show'); // Agregar clase show
    consultarAPIEdicion(); // Llamar a la función que consulta los servicios
}

function cerrarModalServicio() {
    document.getElementById('modal-servicio').style.display = 'none';
    // Opcionalmente, puedes limpiar el contenido del modal o resetear estados
}


</script>




<div id="modal-fecha" class="modal-seleccion" style="display: none;">
    <div class="modal-content-seleccion">
        <h2>Selecciona una fecha</h2>
        <div id="calendar-container">
            <div id="calendar2"></div>
        </div>
        <button class="btn-cancelar" onclick="cerrarModalFecha()">Cancelar</button>
    </div>
</div>



<script>

// function editarCita() {
//     // Oculta el modal actual de edición de cita
   
// //    document.getElementById('blur-background2').style.display = 'block';
//     // Muestra el nuevo modal con las opciones de edición
//     const modalSeleccion = document.getElementById('modal-seleccion-edicion');
//     modalSeleccion.classList.add('show');
//     modalSeleccion.style.display = 'block';

//     document.getElementById('blur-background3').style.display = 'none'
//     cerrarModalEditarHistorial();
//    cerrarModalHistorial();
// }

// function cerrarModalSeleccion() {
//     const modalSeleccion = document.getElementById('modal-seleccion-edicion');
//     modalSeleccion.classList.remove('show');
//     setTimeout(() => {
//         modalSeleccion.style.display = 'none';
//     }, 300); // Espera el tiempo de la transición
// }

// function editarFecha() {
//     // Función para manejar la edición de fecha
//     console.log("Editar fecha seleccionado");
//     cerrarModalSeleccion();

//     // Mostrar el modal de selección de fecha
//     const modalFecha = document.getElementById('modal-fecha');
//     modalFecha.classList.add('show');
//     modalFecha.style.display = 'block';
// }
</script>


<script>

</script>








<div id="loading-spinner" class="loading-spinner" style="display: none;">
    <div class="razor"></div>
</div>

<div id="blur-background"></div>
<div id="blur-background2"></div>
<div id="blur-background3"></div>




<div id="modal-perfil" class="modal-perfil">
    <div class="modal-contenido-perfil">
        <span class="cerrar-modal" onclick="cerrarModal()">&times;</span>
        <h2>Tus Datos</h2>

        <!-- Sección Datos -->
        <div class="seccion-datos">
            <input type="hidden" id="usuario-id" name="id" value="<?php echo $_SESSION['id']; ?>">

            <form id="form-perfil" action="/perfil-editar" method="POST">
                <div class="campo-perfil">
                    <label for="nombre"><i class="fas fa-user"></i> Nombre</label>
                    <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>" required>
                    <span class="mensaje-error" id="error-nombre"></span>
                </div>
                <div class="campo-perfil">
                    <label for="apellido"><i class="fas fa-user"></i> Apellido</label>
                    <input type="text" id="apellido" name="apellido" value="<?php echo htmlspecialchars($apellido); ?>" required>
                    <span class="mensaje-error" id="error-apellido"></span>
                </div>
                <div class="campo-perfil">
                    <label for="correo"><i class="fas fa-envelope"></i> Correo</label>
                    <input type="email" id="correo" name="correo" value="<?php echo $_SESSION['email'] ?? ''; ?>" disabled class="correo-deshabilitado">
                </div>
                <input type="submit" id="boton-actualizar" class="boton disabled" value="Actualizar Perfil" disabled>
            </form>
        </div>

        <!-- Sección Contraseña -->
        <div class="seccion-contrasena">
            <h3>¿Deseas cambiar la contraseña?</h3>
            <p>Haz clic en el botón para restablecerla:</p>
            <div class="boton-restablecer">
                <button id="boton-restablecer" class="botonR">Restablecer Contraseña</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal Contra -->
<!-- Modal Contra -->
<div id="modal-contra" class="modal-oculto-contra">
    <div class="modal-contenido-contra">
        <span class="boton-cerrar" onclick="cerrarModalContra()">✕</span>
        <h2 class="titulo-modal">Restablecer Contraseña</h2>
        <p class="descripcion-pagina">Ingresa tu contraseña actual para habilitar los demás campos.</p>
        
        <form id="form-verificar" method="POST" action="/verificar-contra">
            <input type="hidden" id="usuario-id" name="usuario-id" value="<?php echo $_SESSION['id']; ?>">
            
            <!-- Campo de contraseña actual -->
            <div class="campo-modal">
                <label for="contraseña-actual">Contraseña Actual</label>
                <input type="password" id="contraseña-actual" name="contraseña_actual" required>
            </div>

            <!-- Botón de verificar contraseña -->
            <input type="submit" id="boton-verificar" class="boton disabled" value="Verificar Contraseña" disabled>
        </form>

        <!-- Segundo formulario para cambiar contraseña -->
        <form id="form-contra" method="POST" action="/actualizar-contra">
            <div class="campo-modal">
                <label for="nueva-contraseña">Nueva Contraseña</label>
                <input type="password" id="nueva-contraseña" name="nueva_contraseña" required disabled>
                <span id="error-nueva-contrasena" class="error" style="display: none;"></span>
            </div>
            
            <div class="campo-modal">
                <label for="confirmar-contraseña">Confirmar Contraseña</label>
                <input type="password" id="confirmar-contraseña" name="confirmar_contraseña" required disabled>
                <span id="error-confirmar-contrasena" class="error" style="display: none;"></span>
            </div>
            
            <!-- Botón de cambiar contraseña -->
            <input type="submit" id="boton-confirmar" class="boton disabled" value="Cambiar Contraseña" disabled>
        </form>
    </div>
</div>






<div id="loading-spinner" class="loading-spinner">
    <div class="razor"></div>
</div>


<script>
// Variables de elementos
const formVerificar = document.getElementById('form-verificar');
const formContra = document.getElementById('form-contra');

const contraseñaActualInput = document.getElementById('contraseña-actual');
const nuevaContraseñaInput = document.getElementById('nueva-contraseña');
const confirmarContraseñaInput = document.getElementById('confirmar-contraseña');

const botonVerificar = document.getElementById('boton-verificar');
const botonConfirmar = document.getElementById('boton-confirmar');

const errorNuevaContrasena = document.getElementById('error-nueva-contrasena');
const errorConfirmarContrasena = document.getElementById('error-confirmar-contrasena');

// Variable para almacenar la contraseña actual
let contraseñaActualGuardada = null;

// Función para validar el formulario de cambio de contraseña
function validarFormulario() {
    const nuevaContra = nuevaContraseñaInput.value;
    const confirmarContra = confirmarContraseñaInput.value;

    // Verificar condiciones de error
    const hayErrorNueva = nuevaContra.length < 6 || nuevaContra === contraseñaActualGuardada;
    const hayErrorConfirmar = confirmarContra !== nuevaContra;

    // Mostrar errores si es necesario
    if (nuevaContra.length < 6) {
        errorNuevaContrasena.style.display = 'block';
        errorNuevaContrasena.textContent = 'La contraseña debe tener al menos 6 caracteres.';
    } else if (nuevaContra === contraseñaActualGuardada) {
        errorNuevaContrasena.style.display = 'block';
        errorNuevaContrasena.textContent = 'La nueva contraseña no puede ser igual a la actual.';
    } else {
        errorNuevaContrasena.style.display = 'none';
    }

    if (confirmarContra !== nuevaContra) {
        errorConfirmarContrasena.style.display = 'block';
        errorConfirmarContrasena.textContent = 'Las contraseñas no coinciden.';
    } else {
        errorConfirmarContrasena.style.display = 'none';
    }

    // Habilitar/deshabilitar el botón de confirmación
    botonConfirmar.disabled = hayErrorNueva || hayErrorConfirmar;
}

// Deshabilitar botón verificar inicialmente
contraseñaActualInput.addEventListener('input', function () {
    botonVerificar.disabled = this.value.length <= 5;
});

// Evento para verificar la contraseña actual
formVerificar.addEventListener('submit', function (event) {
    event.preventDefault();
    const contraseñaActual = contraseñaActualInput.value;

    fetch('/verificar-contra', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `contraseña_actual=${encodeURIComponent(contraseñaActual)}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Guardar la contraseña actual
            contraseñaActualGuardada = contraseñaActual;

            // Habilitar campos de nueva contraseña
            nuevaContraseñaInput.disabled = false;
            confirmarContraseñaInput.disabled = false;
            botonVerificar.disabled = true;
            contraseñaActualInput.disabled = true;

            Swal.fire('Éxito', 'Contraseña verificada.', 'success');
        } else {
            Swal.fire('Error', data.message || 'Contraseña incorrecta.', 'error');
        }
    })
    .catch(error => console.error('Error:', error));
});

// Eventos para validar los campos en tiempo real
nuevaContraseñaInput.addEventListener('input', validarFormulario);
confirmarContraseñaInput.addEventListener('input', validarFormulario);
// Evento para actualizar la contraseña
formContra.addEventListener('submit', function (event) {
    event.preventDefault();

    fetch('/actualizar-contra', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams(new FormData(formContra))
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire('Éxito', 'Contraseña actualizada correctamente.', 'success');

            // Restablecer formularios y deshabilitar campos
            formContra.reset();
            formVerificar.reset();

            nuevaContraseñaInput.disabled = true;
            confirmarContraseñaInput.disabled = true;
            botonConfirmar.disabled = true;

            contraseñaActualInput.disabled = false;
            botonVerificar.disabled = true;

            // Redirigir a /cita después de 2 segundos
            setTimeout(() => {
                window.location.href = '/cita';
            }, 2000);
        } else {
            Swal.fire('Error', data.message, 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire('Error', 'Ocurrió un error inesperado.', 'error');
    });
});


</script>

<!-- Modal -->
<div id="modal-perfil" class="modal-perfil">
    <!-- Contenido del modal aquí -->
    <button class="cerrar-modal">X</button>
    <form id="form-perfil">
        <input type="text" id="nombre" placeholder="Nombre">
        <span id="error-nombre" class="error-text"></span>
        
        <input type="text" id="apellido" placeholder="Apellido">
        <span id="error-apellido" class="error-text"></span>
        
        <button type="submit" id="boton-actualizar" class="disabled" disabled>Actualizar</button>
    </form>
</div>
<div id="blur-background2" class="blur-background"></div>

<!-- Script -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const modalPerfil = document.getElementById('modal-perfil');
    const botonActualizar = document.getElementById('boton-actualizar');
    const nombreInput = document.getElementById('nombre');
    const apellidoInput = document.getElementById('apellido');
    const errorNombre = document.getElementById('error-nombre');
    const errorApellido = document.getElementById('error-apellido');

    // Función para abrir el modal
    window.abrirModalPerfil = function() {
        modalPerfil.style.display = 'flex';
        setTimeout(() => {
            modalPerfil.classList.add('show');
        }, 10);
        document.getElementById('blur-background2').style.display = 'block';
    }

    // Función para cerrar el modal
    function cerrarModalPerfil() {
        modalPerfil.classList.remove('show');
        setTimeout(() => {
            modalPerfil.style.display = 'none';
            document.getElementById('blur-background2').style.display = 'none';

            // Resetear formulario
            botonActualizar.disabled = true;
            botonActualizar.classList.add('disabled');
            nombreInput.classList.remove('error');
            apellidoInput.classList.remove('error');
            errorNombre.style.display = 'none';
            errorApellido.style.display = 'none';
        }, 300);
    }

    // Evento para cerrar el modal
    const cerrarModalPerfilBtn = modalPerfil.querySelector('.cerrar-modal');
    cerrarModalPerfilBtn.addEventListener('click', cerrarModalPerfil);

    // Función para validar campos
    function validarCampo(input, errorSpan, minLen = 2) {
        const valor = input.value.trim();
        const esValido = /^[a-zA-Z]{2,}$/.test(valor);
        if (!esValido) {
            input.classList.add('error');
            errorSpan.style.display = 'block';
            errorSpan.textContent = valor.length < minLen
                ? `Debe tener al menos ${minLen} caracteres.`
                : 'No se permiten números ni caracteres especiales.';
        } else {
            input.classList.remove('error');
            errorSpan.style.display = 'none';
        }
        return esValido;
    }

    // Función para validar el formulario
    function validarFormulario() {
        const nombreValido = validarCampo(nombreInput, errorNombre);
        const apellidoValido = validarCampo(apellidoInput, errorApellido);
        botonActualizar.disabled = !(nombreValido && apellidoValido);
        botonActualizar.classList.toggle('disabled', botonActualizar.disabled);
    }

    // Validación en tiempo real
    nombreInput.addEventListener('input', validarFormulario);
    apellidoInput.addEventListener('input', validarFormulario);

    // Envío del formulario
    const formPerfil = document.getElementById('form-perfil');
    formPerfil.addEventListener('submit', function(event) {
        event.preventDefault();
        validarFormulario();
        if (botonActualizar.disabled) return;

        const formData = new FormData(formPerfil);
        fetch('/perfil-editar', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Perfil Actualizado',
                    text: data.message,
                    confirmButtonText: 'OK'
                }).then(cerrarModalPerfil);
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.message || 'Error al actualizar el perfil',
                    confirmButtonText: 'OK'
                });
            }
        })
        .catch(error => console.error('Error:', error));
    });
});
</script>






<!-- Script para manejar la apertura y cierre del modal -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const modalContra = document.getElementById('modal-contra');
    const botonRestablecer = document.getElementById('boton-restablecer');
    const inputContrasenaActual = document.getElementById('contraseña-actual');
    const botonConfirmar = document.getElementById('boton-confirmar');
    const errorContrasena = document.getElementById('mensaje-error');

    // Abre el modal al hacer clic en el botón de restablecer
    botonRestablecer.addEventListener('click', (e) => {
        e.preventDefault();
        abrirModalContra();
    });

    function abrirModalContra() {
        modalContra.style.display = 'flex';
        setTimeout(() => {
            modalContra.classList.add('modal-activo');
        }, 10);
        document.getElementById('blur-background').style.display = 'block'; // Muestra el fondo borroso
    }

    // Cerrar modal de contraseña
    const cerrarModalContraBtn = modalContra.querySelector('.boton-cerrar');
    cerrarModalContraBtn.addEventListener('click', cerrarModalContra);

    function cerrarModalContra() {
        modalContra.classList.remove('modal-activo');
        setTimeout(() => {
            modalContra.style.display = 'none';
            document.getElementById('blur-background').style.display = 'none'; // Oculta el fondo borroso
        }, 300);
    }

  
});
</script>



<script>
   // Alternar el menú desplegable al hacer clic en la hamburguesa
function toggleMenu() {
    const menu = document.getElementById('menu');
    menu.classList.toggle('mostrar'); // Alterna la clase 'mostrar' para mostrar/ocultar el menú
}

// Cambiar el icono de hamburguesa a "X" al hacer clic
function toggleIcon() {
    const icon = document.getElementById('hamburguesa-icono');
    icon.classList.toggle('fa-bars'); // Quitar el icono de hamburguesa
    icon.classList.toggle('fa-times'); // Añadir el icono de "X"
}

// Cerrar el menú desplegable al hacer clic fuera del menú o la hamburguesa
document.addEventListener('click', function(event) {
    const menu = document.getElementById('menu');
    const hamburguesa = document.querySelector('.menu-hamburguesa');

    // Si el clic no es en el menú ni en el botón de la hamburguesa, cerrar el menú
    if (!menu.contains(event.target) && !hamburguesa.contains(event.target)) {
        menu.classList.remove('mostrar');
        document.getElementById('hamburguesa-icono').classList.remove('fa-times');
        document.getElementById('hamburguesa-icono').classList.add('fa-bars');
    }
});

// Cerrar el menú desplegable al hacer clic en un enlace del menú
document.querySelectorAll('.menu-item').forEach(item => {
    item.addEventListener('click', function() {
        const menu = document.getElementById('menu');
        menu.classList.remove('mostrar'); // Cierra el menú después de hacer clic en cualquier enlace del menú
        document.getElementById('hamburguesa-icono').classList.remove('fa-times');
        document.getElementById('hamburguesa-icono').classList.add('fa-bars');
    });
});

</script>




<?php 
    $script = "
        <script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script src='build/js/app.js'></script>
        <script src='build/js/sobrenosotros.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js'></script> <!-- Agrega Moment.js -->
    ";
?>



<script>
function logoutAndShowSpinner(event) {
    event.preventDefault();  // Prevenir el comportamiento por defecto del enlace (la redirección)

    // Mostrar el spinner
    const spinner = document.getElementById('loading-spinner');
    spinner.classList.add('show'); // Activar el spinner

    // Redirigir al usuario después de un breve retraso (para dar tiempo a que el spinner se muestre)
    setTimeout(function() {
        window.location.href = '/logout'; // Redirigir a la página de cierre de sesión
    }, 500); // El tiempo de espera puede ajustarse según tu preferencia
}

</script>
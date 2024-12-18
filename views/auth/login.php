<?php include_once __DIR__ . '/../templates/barra.php'; ?>
<div class="centrar-login">
    <h1 class="nombre-pagina">Login</h1>
    <p class="descripcion-pagina">Inicia sesión con tus datos</p>
    <?php include_once __DIR__ . "/../templates/alertas.php"; ?>

    <form class="formulario-login" method="POST" action="/login">
        <div class="campo">
            <label for="email">Email</label>
            <input
                type="email"
                id="email"
                placeholder="Tu Email"
                name="email"
            />
        </div>

        <div class="campo">
            <label for="password">Contraseña</label>
            <input 
                type="password"
                id="password"
                placeholder="Tu Contraseña"
                name="password"
            />
        </div>

        <input type="submit" class="botonR" value="Iniciar Sesión">
        <div class="acciones">
            <a href="#" id="crear-cuenta-link">¿Aún no tienes una cuenta? Crear una</a>
            <a href="#" id="olvide-link">¿Olvidaste tu contraseña? Te Ayudamos</a>
        </div>
    </form>
</div>
    <div id="loading-spinner" class="loading-spinner">
        <div class="razor"></div>
    </div>

    <script>
        document.querySelector('form').addEventListener('submit', function(event) {
            event.preventDefault(); // Previene el envío inmediato del formulario

            // Muestra el spinner de carga
            document.getElementById('loading-spinner').classList.add('show');

            // Simula un retraso antes de enviar el formulario
            setTimeout(function() {
                event.target.submit(); // Envía el formulario después del retraso
            }, 1000); // Puedes ajustar este tiempo de retraso según tus necesidades
        });
    </script>

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
    document.getElementById("crear-cuenta-link").addEventListener("click", function(event) {
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


<?php include_once __DIR__ . '/../templates/footer.php'; ?>
   
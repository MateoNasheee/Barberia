<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


<footer class="footer_section">
                    <!-- Sección de Contacto y Horarios -->
                    <section class="seccion-widget">
    <div class="contenedor">
        <div class="fila">
            <div class="columna col-3">
                <div class="widget-footer">
                <div class="logo-marca"></div>
                    <p>
                        Somos tu mejor opción, nuestro mayor capital tu comodidad y satisfacción
                    </p>
                    <ul class="social-widget">
                        <li><a href="#" data-toggle="tooltip" title="Facebook"><i class="fab fa-facebook-f fa-2x"></i></a></li>
                        <li><a href="#" data-toggle="tooltip" title="Twitter"><i class="fab fa-twitter fa-2x"></i></a></li>
                        <li><a href="#" data-toggle="tooltip" title="Instagram"><i class="fab fa-instagram fa-2x"></i></a></li>
                        <li><a href="#" data-toggle="tooltip" title="LinkedIn"><i class="fab fa-linkedin fa-2x"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="columna col-3">
                <div class="widget-footer">
                    <h3>Dirección</h3>
                    <p>
                        Av. Republica Argentina
                    </p>
                    <p>
                        mateorojasarce2003@gmail.com
                        <br>
                        (+54) 3757 673226
                    </p>
                </div>
            </div>
            <div class="columna col-3">
                <div class="widget-footer">
                    <h3>Horarios Disponibles</h3>
                    <ul class="horarios-abiertos">
                        <li>Lunes - Viernes 11:30am - 2:00 - 8:00 pm</li>
                        <li>Lunes - Viernes 11:30am - 2:00 - 8:00 pm</li>
                        <li>Lunes - Viernes 11:30am - 2:00 - 8:00 pm</li>
                        <li>Lunes - Viernes 11:30am - 2:00 - 8:00 pm</li>
                    </ul>
                </div>
            </div>
            <div class="columna col-3">
            <div class="widget-footer">
                <h3>Subscríbete a nuestro contenido</h3>
                <div class="form-suscripcion">
                <form action="/suscripcion" method="POST" class="form-suscripcion" novalidate="true" onsubmit="mostrarPantallaCarga()">
    <input type="email" name="EMAIL" id="subs-email" class="form-input" placeholder="Tu correo..." required>
    
    <div class="suscripcion-contenedor">
        <button type="submit" class="enviar" id="btn-suscribir" disabled>Suscríbete</button>
    </div>
    
    <div class="clearfix"></div>
</form>
                    <div id="pantalla-carga" style="display: none;">
                        <div class="spinner"></div>
                        <p>Enviando...</p>
                    </div>
                    <div id="mensaje-exito" style="display: none;">
                        <p>Tu suscripción ha sido enviada con éxito</p>
                    </div>
                </div>
            </div>

            </div>
        </div>
    </div>
</section>
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <!-- Izquierda: Nombre y LinkedIn -->
            <div class="col-md-4 xs-padding text-left">
                <p>Desarrollado por <a href="https://www.linkedin.com/in/mateorojas" target="_blank">Mateo Rojas</a></p>
            </div>
            <!-- Centro: Derechos reservados -->
            <div class="col-md-4 xs-padding text-center">
                <p>&copy; 2024 Todos los derechos reservados</p>
            </div>
            <!-- Derecha: Icono de LinkedIn -->
            <div class="col-md-4 xs-padding text-right">
                <a href="https://www.linkedin.com/in/mateorojas" target="_blank">
                    <i class="fab fa-linkedin fa-2x"></i>
                </a>
            </div>
        </div>
    </div>
</footer>


<script>
function mostrarPantallaCarga() {
    document.getElementById('pantalla-carga').style.display = 'flex';
    setTimeout(function() {
        document.getElementById('pantalla-carga').style.display = 'none';
        document.getElementById('mensaje-exito').style.display = 'flex';
    }, 2000); // Simulación de tiempo de carga
}
</script>



<script>

    // Obtener el input del correo y el botón de envío
    const emailInput = document.getElementById('subs-email');
    const submitButton = document.getElementById('btn-suscribir');

    // Función para validar el correo y habilitar el botón
    emailInput.addEventListener('input', function() {
        // Validar el formato del correo
        const emailValue = emailInput.value;
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        // Habilitar el botón si el correo es válido
        if (emailPattern.test(emailValue)) {
            submitButton.disabled = false;
        } else {
            submitButton.disabled = true;
        }
    });

</script>



<!-- FullCalendar Scripts -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales/es.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


<!-- Barra de navegación -->
<?php include_once __DIR__ . '/../templates/barra.php'; 
?>

<header id="inicio" class="Inicio">
    <!-- Carrusel -->
    <div class="imagen">
        <div class="carrusel">
            <!-- Diapositivas del Carrusel -->
            <div class="slide">
                <div class="texto-slide">
                    <div class="titulo">Un Corte de Cabello para cada Ocasión</div>
                    <div class="subtitulo">El corte perfecto para cada estilo, lo que necesitas está aquí.</div>
                </div>
            </div>
            <div class="slide">
                <div class="texto-slide">
                    <div class="titulo">Somos la mejor peluquería del Mundo</div>
                    <div class="subtitulo">Te queremos bien, ¡y lo demostramos con cada corte!</div>
                </div>
            </div>
            <div class="slide">
                <div class="texto-slide">
                    <div class="titulo">Acá te puedes sentir muy cómodo</div>
                    <div class="subtitulo">Relájate y disfruta de una experiencia única.</div>
                </div>
            </div>
            <div class="slide">
                <div class="texto-slide">
                    <div class="titulo">Cortes modernos y clásicos para todos</div>
                    <div class="subtitulo">Desde los cortes más innovadores hasta los clásicos atemporales.</div>
                </div>
            </div>
            <div class="slide">
                <div class="texto-slide">
                    <div class="titulo">Ven y vive la experiencia única</div>
                    <div class="subtitulo">Ven a disfrutar de un servicio único que solo nosotros te podemos ofrecer.</div>
                </div>
            </div>
        </div>
        <!-- Botones de Navegación del Carrusel -->
        <button class="prev">&#10094;</button>
        <button class="next">&#10095;</button>
        <!-- Indicadores del Carrusel -->
        <div class="indicadores">
            <span class="indicador active" data-slide="0"></span>
            <span class="indicador" data-slide="1"></span>
            <span class="indicador" data-slide="2"></span>
            <span class="indicador" data-slide="3"></span>
            <span class="indicador" data-slide="4"></span>
        </div>
    </div>
</header>


<div id="app">
    <!-- <h1 class="nombre-pagina">¡Bienvenido a BarberClub!</h1> -->
    




    
    <section id="sobre-nosotros" class="sobre-nosotros">
    <div class="separador-barberia">
        <i class="fas fa-cut"></i>
    </div>
    <div class="contenido">
        <div class="descripcion">
            <h3 class="titulo-seccion">Sobre Nosotros</h3>
            <div class="imagen-principal"></div>
            <p class="subtitulo">Descubre lo que nos hace únicos.</p>
            <p>En BarberClub, combinamos tradición y modernidad para que te sientas valorado. Nuestro equipo está aquí para realzar tu estilo con las últimas tendencias.</p>
            <button class="botonR" onclick="abrirModalHistoria()">Más acerca de nosotros</button>
        </div>
        <div class="imagenes">
            <div class="imagen-nosotros"></div>
            <div class="imagen-nosotros"></div>
            <div class="imagen-nosotros"></div>
        </div>
    </div>

    
<div id="modal-historia" class="modalHistoria">
    <div class="contenido-historia">
        <span class="close" onclick="cerrarModalHistoria()">&times;</span>
        <h2>Misión y Visión de nuestra Barbería</h2>
        <p class="modal-intro">Bienvenido a BarberClub, donde el estilo se encuentra con la excelencia. Conoce nuestra misión y visión que guían cada corte y afeitado que realizamos.</p>
        
        <div class="section">
            <h3><i class="fas fa-bullseye"></i> Misión</h3>
            <p>Proporcionar a nuestros clientes un servicio de barbería excepcional, con un enfoque en la calidad, la satisfacción y el bienestar. Nos esforzamos por ofrecer cortes de cabello y afeitados de la más alta calidad, adaptados a las necesidades individuales de cada cliente.</p>
        </div>

        <div class="section">
            <h3><i class="fas fa-eye"></i> Visión</h3>
            <p>Convertirnos en la barbería de referencia en la ciudad, reconocida por su excelencia en el servicio al cliente, sus estándares de higiene y su ambiente acogedor. Queremos ser el lugar donde cada cliente se sienta especial y bien cuidado.</p>
        </div>

        <div class="section">
            <h3><i class="fas fa-info-circle"></i> Más información</h3>
            <p>Nuestro equipo de barberos altamente capacitados y apasionados por su oficio se dedica a ofrecer un servicio personalizado en cada cita. Además, nos aseguramos de usar productos de calidad que cuidan la salud capilar y facial de nuestros clientes.</p>
        </div>

        <div class="section">
            <h3><i class="fas fa-handshake"></i> Valores</h3>
            <ul class="valores">
                <li><i class="fas fa-scissors"></i> <strong>Profesionalismo:</strong> <p>Cada corte es una obra maestra.</p></li>
                <li><i class="fas fa-paint-brush"></i> <strong>Creatividad:</strong> <p>Innovamos con estilo.</p></li>
                <li><i class="fas fa-comments"></i> <strong>Comunicación:</strong> <p>Escuchamos y entendemos tus necesidades.</p></li>
                <li><i class="fas fa-shield-alt"></i> <strong>Higiene:</strong> <p>Máximos estándares de limpieza.</p></li>
            </ul>
        </div>

       
    </div>
</div>
</section>


<div id="blur-background"></div>


<section id="servicio" class="services-section">
    <h2>Somos tu mejor opción</h2>
    <h1>Nuestros Servicios</h1>
    <div class="separador-barberia">
        <i class="fas fa-cut"></i>
    </div>
    <div class="services-container">
        <div class="service">
            <div class="icon">
                <i class="fas fa-user-tie"></i>
            </div>
            <h3>Cortes de Cabello</h3>
            <p>Los mejores cortes de cabellos adaptados a la fisonomía de tu cara</p>
        </div>
        <div class="service">
            <div class="icon">
                <i class="fas fa-cut"></i>
            </div>
            <h3>Corte de Barba</h3>
            <p>Nos ajustamos a tu barba, te damos los mejores consejos posibles.</p>
        </div>
        <div class="service">
            <div class="icon">
                <i class="fas fa-spa"></i>
            </div>
            <h3>Afeitado Suave</h3>
            <p>Incluimos un tratamiento, de cremas y bálsamos que cuidan tu piel.</p>
        </div>
        <div class="service">
            <div class="icon">
                <i class="fas fa-mask"></i>
            </div>
            <h3>Mascarilla Facial</h3>
            <p>Aplicamos los mejores tratamientos, para cuidar tu piel y humectarla.</p>
        </div>
    </div>
    <button id="scrollToPricing" class="botonR">Conoce Nuestros Servicios</button>
</section>




<section id="tendencias" class="types-section">
    <h2>Somos tu Peluquería</h2>
    <h1>Cortes Modernos en Tendencia</h1>
    <div class="types-gallery">
        <div class="gallery-item low-fade" data-description="Un estilo limpio y profesional, ideal para cualquier ocasión.">
            <p>Low Fade</p>
        </div>
        <div class="gallery-item mullet" data-description="Un corte atrevido y moderno que está en tendencia.">
            <p>Mullet</p>
        </div>
        <div class="gallery-item mohicano" data-description="Un estilo único y llamativo para los más audaces.">
            <p>Mohicano</p>
        </div>
        <div class="gallery-item mid-fade" data-description="Un desvanecido medio que combina elegancia y modernidad.">
            <p>Mid Fade</p>
        </div>
        <div class="gallery-item high-fade" data-description="Perfecto para un look fuerte y estructurado.">
            <p>High Fade</p>
        </div>
        <div class="gallery-item french-crop" data-description="Estilo europeo minimalista, ideal para un look sofisticado.">
            <p>French Crop</p>
        </div>
        <div class="gallery-item buzz-cut" data-description="Un corte clásico, práctico y siempre en tendencia.">
            <p>Buzz Cut</p>
        </div>
        <div class="gallery-item taper-fade" data-description="Transiciones suaves para un estilo moderno y fresco.">
            <p>Taper Fade</p>
        </div>
    </div>
</section>

<section  id="precios" class="pricing-section">
    <h2>Estamos para Vos</h2>
    <h1>Precios de Nuestros Servicios</h1>
    <div id="servicios-lista"></div>
    <div id="calendar-note" class="note-container">
                    <i class="fas fa-info-circle"></i> <!-- Ícono Font Awesome -->
                    <span>Nota Importante: Servicio de Corte para Infantes
                    En nuestra barbería, contamos con un servicio especializado en cortes para infantes, diseñado para atender las necesidades de nuestros clientes más jóvenes. Los padres o tutores legales que deseen realizar una cita para el corte de cabello de un menor no están obligados a iniciar sesión en nuestra plataforma.</span>
                </div>
</section>




<!-- Sección Ubicación -->
<section id="ubicacion" class="ubicacion">
    <h3>Si tienes alguna duda, envíanos un mensaje hoy!</h3>
    <div class="container">
        <div id="mapa-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d899.3925909557217!2d-54.57669140878716!3d-25.61918906782717!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94f6925a07adb41f%3A0x7b88eb8de084e358!2sBarber%C3%ADa%20Barber%20Club!5e0!3m2!1ses!2sar!4v1728337092028!5m2!1ses!2sar" 
                width="600" 
                height="450" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
        <form class="formulario-contacto" method="POST" action="/contactar" onsubmit="mostrarPantallaCarga()">
            <input type="text" name="nombre" placeholder="Tu nombre" required>
            <input type="email" name="correo" placeholder="Correo" required>
            <input type="text" name="asunto" placeholder="Asunto" required>
            <textarea name="mensaje" placeholder="Mensaje" required></textarea>
            <button type="submit">ENVIAR TU MENSAJE</button>
        </form>
        <div id="pantalla-carga" style="display: none;">
            <div class="spinner"></div>
            <p>Enviando...</p>
        </div>
        <div id="mensaje-exito" style="display: none;">
            <p>Tu correo ha sido enviado con éxito</p>
        </div>
    </div>
</section>




    <!-- Botón para reservar -->
    <div class="separar">
        <span id="iniciar-sesion" class="botonR">Reservar</span>
    </div>
</div>

<a href="https://wa.me/3757673226" class="whatsapp-icon" target="_blank">
    <i class="fab fa-whatsapp"></i>
</a>

<div id="loading-spinner" class="loading-spinner">
    <div class="razor"></div>
</div>



<div id="modal-iniciar-sesion" class="modal-sesion">
    <div class="modal-contenido-sesion">
        <h2 class="modal-titulo">Reservar</h2>
        <p>Para realizar una reserva, debes iniciar sesión.</p>
        <a href="/login" class="boton-iniciar-sesion">Iniciar Sesión</a>
        <span class="cerrar-modal-session"><i class="fas fa-times"></i></span>
    </div>
</div>



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
    document.querySelector('#scrollToPricing').addEventListener('click', function () {
        const targetSection = document.querySelector('#precios');
        targetSection.scrollIntoView({ behavior: 'smooth' });
    });
</script>



<script>
// Seleccionamos el modal y sus elementos
const modal = document.getElementById("modal-iniciar-sesion");
const openModalButton = document.getElementById("iniciar-sesion");
const closeModalButton = document.querySelector(".cerrar-modal-session");

// Seleccionamos el spinner y el botón de iniciar sesión
const loadingSpinner = document.getElementById('loading-spinner');
const loginButton = document.querySelector('.boton-iniciar-sesion');

// Abrir el modal al hacer clic en el botón "Reservar"
openModalButton.addEventListener("click", function () {
    modal.classList.add("show"); // Mostramos el modal agregando la clase "show"
    modal.style.pointerEvents = "auto"; // Permite la interacción
});

// Cerrar el modal al hacer clic en el ícono de cerrar
closeModalButton.addEventListener("click", function () {
    modal.classList.remove("show"); // Ocultamos el modal eliminando la clase "show"
    modal.style.pointerEvents = "none"; // Evita la interacción
});

// Cerrar el modal al hacer clic fuera del contenido del modal
window.addEventListener("click", function (event) {
    if (event.target === modal) {
        modal.classList.remove("show");
        modal.style.pointerEvents = "none";
    }
});

// Acción cuando se hace clic en "Iniciar Sesión"
loginButton.addEventListener('click', function (event) {
    event.preventDefault(); // Evitamos la acción predeterminada del enlace

    // Mostrar el spinner de carga
    loadingSpinner.style.visibility = 'visible'; // Asegura que se muestra el spinner
    loadingSpinner.style.opacity = '1'; // Hace el spinner completamente visible

    // Simulación de carga (puedes hacer una petición real aquí si lo deseas)
    setTimeout(() => {
        loadingSpinner.style.visibility = 'hidden'; // Ocultar el spinner después del retraso
        loadingSpinner.style.opacity = '0'; // Hace el spinner invisible
        window.location.href = "/login"; // Redirigir a la página de login
    }, 1000); // 2 segundos de espera (ajustable según tu necesidad)
});



</script>


<?php 
    $script = "
        <script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script src='build/js/sobrenosotros.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js'></script> <!-- Agrega Moment.js -->
    ";
?>


<?php include_once __DIR__ . '/../templates/footer.php'; ?>
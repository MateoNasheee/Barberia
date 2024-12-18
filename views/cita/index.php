

<!-- FullCalendar Scripts -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales/es.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<!-- Barra de navegación -->
<?php include_once __DIR__ . '/../templates/barra.php'; ?>

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

    
    <section id="precios" class="pricing-section">
    <h2>Estamos para Vos</h2>
    <h1>Precios de Nuestros Servicios</h1>

    <?php 
    $categorias = ['Cabello', 'Facial', 'Barba', 'Combo'];

    foreach ($categorias as $categoria) :
        // Filtrar los servicios de esta categoría
        $serviciosCategoria = array_filter($servicios, function($servicio) use ($categoria) {
            return $servicio->categoria === $categoria;
        });

        if (!empty($serviciosCategoria)) : ?>
            <div class="categoria">
                <h3><?php echo $categoria; ?></h3>

                <table class="tabla-servicios">
                    <thead>
                        <tr>
                            <th>Servicio</th>
                            <th>Precio</th>
                            <th>Duración</th>
                            <th>Descripción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($serviciosCategoria as $servicio) : ?>
                            <tr>
                                <td data-label="Servicio"><?php echo $servicio->nombre; ?></td>
                                <td data-label="Precio">$<?php echo $servicio->precio; ?></td>
                                <td data-label="Duración"><?php echo $servicio->duracion; ?> min</td>
                                <td data-label="Descripción"><?php echo $servicio->descripcion; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>

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






    <a href="https://wa.me/3757465921" class="whatsapp-icon" target="_blank">
        <i class="fab fa-whatsapp"></i>
    </a>

        <!-- Botón para reservar -->
        <div class="separar">
        <span id="reservar-turno" class="botonR">Reservar</span>
        </div>

</div>



<div id="blur-background"></div>

<!-- Modal para Crear Nueva Cita -->
<div id="modal" class="modal" style="display: none;">
    <span id="cerrar-modal" class="cerrar">&times;</span>

    <h2 class="nombre-pagina">Crear Nueva Cita</h2>
    <p class="descripcion-pagina">Elige tus servicios y coloca tus datos</p>
    <!-- Navegación de pestañas -->
    <nav class="tabs">
        <button class="actual" type="button" data-paso="1">Servicios</button>
        <button type="button" data-paso="2">Información Cita</button>
        <button type="button" data-paso="3">Resumen</button>
    </nav>

    <div class="modal-contenido">

<!-- Sección Servicios -->
<div id="paso-1" class="seccion mostrar">
    <h2>Servicios</h2>
    <p class="text-center">Elige tus servicios a continuación</p>

    <!-- Filtro de categoría -->
    <div class="filtro-categoria text-center">
        <label for="filtro-servicios">Filtrar por categoría:</label>
        <select id="filtro-servicios" onchange="filtrarServicios()">
            <option value="todos">Todos</option>
            <option value="Facial">Facial</option>
            <option value="Cabello">Cabello</option>
            <option value="Combo">Combo</option>
            <option value="Barba">Barba</option>
        </select>
    </div>

    <!-- Texto que muestra la categoría seleccionada -->
    <p id="categoria-seleccionada" class="text-center"></p>

    <!-- Contenedor de servicios -->
    <div id="servicios" class="listado-servicios">
        <?php foreach ($servicios as $servicio) : ?>
            <div class="servicio" 
                 data-id-servicio="<?php echo $servicio->id; ?>" 
                 data-categoria="<?php echo $servicio->categoria; ?>" 
                 onclick='seleccionarServicio(<?php echo json_encode($servicio); ?>)'>

                <!-- Ícono de información -->
                <div class="icono-informacion" 
                    onclick='event.stopPropagation(); mostrarDescripcion(<?php echo json_encode($servicio->descripcion); ?>)'>
                    <i class="fa-solid fa-circle-info"></i>
                </div>

                <!-- Nombre y precio del servicio -->
                <p class="nombre-servicio"><?php echo $servicio->nombre; ?></p>
                <p class="precio-servicio">$<?php echo $servicio->precio; ?></p>

                <!-- Duración del servicio en pequeño -->
                <p class="duracion-servicio" style="font-size: 0.8em; color: #888;">
                    Duración: <?php echo $servicio->duracion; ?> minutos
                </p>
            </div>
        <?php endforeach; ?>
    </div>
</div>







        <!-- Sección Información Cita -->
        <div id="paso-2" class="seccion">
            <h2>Fechas y Horarios</h2>
            <p class="text-center">Selecciona tu fecha preferida</p>

            <form class="formulario">
                <!-- Nombre -->
                <div class="campo2">
                    <label for="nombre">Nombre</label>
                    <input id="nombre" type="text" placeholder="Tu Nombre" value="<?php echo $nombre; ?>" disabled />
                </div>

                <!-- Calendario y Fecha -->
            <div id="calendar-container">
                <div id="calendar"></div>
                <!-- Nota -->
                <div id="calendar-note" class="note-container">
                    <i class="fas fa-info-circle"></i> <!-- Ícono Font Awesome -->
                    <span>Las citas se pueden agendar con un plazo máximo de 30 días desde la fecha actual.</span>
                </div>
            </div>

                

                <!-- ID oculto -->
                <input type="hidden" id="id" value="<?php echo $id; ?>" />
            </form>
        </div>

        <!-- Sección Resumen -->
        <div id="paso-3" class="seccion contenido-resumen">
            <h2>Resumen</h2>
            <p class="text-center">Verifica que la información sea correcta</p>
            
        </div>
    </div>

    <!-- Paginación -->
    <div class="paginacion">
        <button id="anterior" class="boton ocultar">&laquo; Anterior</button>
        <button id="siguiente" class="boton">Siguiente &raquo;</button>
    </div>
</div>
<a href="https://wa.me/3757673226" class="whatsapp-icon" target="_blank">
    <i class="fab fa-whatsapp"></i>
</a>
<!-- Modal para seleccionar parte del día -->
<div id="modal-seleccionar-turno" class="modal-seleccionar-turno">
    <div class="modal-contenido-seleccionar">
        <h3 class="text-center">Selecciona tu Horario</h3>
        <p class="text-center">¿Qué parte del día prefieres?</p>
        <div class="campo">
            <input id="fecha" type="date" />
        </div>
        <div class="campo-hora">
            <div class="botones-turno">
                <button id="turno-manana" type="button" class="button-hora" onclick="mostrarHorarios('manana')">Mañana</button>
                <button id="turno-tarde" type="button" class="button-hora" onclick= "mostrarHorarios('tarde')">Tarde</button>
            </div>
            <div id="horarios" class="horarios-container"></div>
        </div>
        <button id="confirmar-modal-seleccionar" class="btn-confirmar confirmarselecionado" onclick="confirmar()" disabled>Confirmar</button>
        <button id="cerrar-modal-secundario" class="btn" onclick="cerrarModalSecun()";>Cerrar</button>
    </div>
</div>

        <!-- Modal de Información -->
        <div id="modal-informacion" class="modal-informacion oculto">
            <div class="modal-contenido-informacion">
                <span class="cerrar-modal-informacion" onclick="cerrarModalDescripcion()">
                    <i class="fa-solid fa-xmark"></i>
                </span>
                <h3>Descripción del Servicio</h3>
                <p id="modal-descripcion"></p>
            </div>
        </div>




        
<script>

function mostrarDescripcion(descripcion) {
    // Asignar la descripción al modal
    const modalDescripcion = document.getElementById('modal-descripcion');
    modalDescripcion.textContent = descripcion;

    // Mostrar el modal
    const modal = document.getElementById('modal-informacion');
    modal.classList.remove('oculto');
}

function cerrarModalDescripcion() {
    // Ocultar el modal
    const modal = document.getElementById('modal-informacion');
    modal.classList.add('oculto');
}



     function filtrarServicios() {
        // Obtener la categoría seleccionada
        const filtro = document.getElementById('filtro-servicios').value;

        // Actualizar el texto de la categoría seleccionada
        const textoCategoria = document.getElementById('categoria-seleccionada');
        textoCategoria.textContent = (filtro === 'todos') 
            ? 'Mostrando todos los servicios' 
            : `Mostrando servicios de categoría: ${filtro}`;

        // Seleccionar todas las tarjetas de servicios
        const servicios = document.querySelectorAll('.servicio');

        // Filtrar servicios dinámicamente
        servicios.forEach(servicio => {
            const categoria = servicio.dataset.categoria; // Obtener la categoría original del servicio
            if (filtro === 'todos' || categoria === filtro) {
                servicio.style.display = 'block'; // Mostrar si coincide
            } else {
                servicio.style.display = 'none'; // Ocultar si no coincide
            }
        });
    }

    // Mostrar todos los servicios al cargar la página
    document.addEventListener('DOMContentLoaded', filtrarServicios);
</script>


<!-- Scripts adicionales -->
<?php 
    $script = "
        <script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script src='build/js/app.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js'></script> <!-- Agrega Moment.js -->
    ";
?>
<script>
    // Función para manejar el cambio de filtro
// Función para manejar el cambio de categoría
function filtrarServicios() {
    const categoria = document.getElementById('categoria').value;
    
    // Redirige a la misma página con el parámetro de categoría en la URL
    window.location.href = `?categoria=${categoria}`;
}


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
    loadingSpinner.classList.add('show');

    // Simulación de carga (puedes hacer una petición real aquí si lo deseas)
    setTimeout(() => {
        loadingSpinner.classList.remove('show'); // Ocultar el spinner después del retraso
        window.location.href = "/login"; // Redirigir a la página de login
    }, 2000); // 3 segundos de espera (ajustable según tu necesidad)
});


</script>


<script>
document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('modal');
    const btnReservar = document.getElementById('reservar-turno');
    const btnCerrar = document.getElementById('cerrar-modal');
    const blurBackground = document.getElementById('blur-background'); 
    const app = document.getElementById('app');
    const barra = document.querySelector('.barra');
    let originalWidth = window.innerWidth;

        // Función para abrir el modal principal
        function abrirModal() {
            document.getElementById('modal').style.display = 'block';
            document.getElementById('app').classList.add('overflow-hidden');
        
        const scrollBarWidth = window.innerWidth - document.documentElement.clientWidth; // Ancho de la barra de desplazamiento
        const modal = document.getElementById('modal');
        const blurBackground = document.getElementById('blur-background'); 
        const barra = document.querySelector('.barra');
        // Mostrar modal y fondo desenfocado
        modal.style.display = 'block';
        // blurBackground.style.display = 'block'; 
        
        // Agregar padding al body para evitar el desplazamiento horizontal
        document.body.style.overflow = 'hidden';
        document.body.style.paddingRight = `${scrollBarWidth}px`; // Compensar por la barra de desplazamiento

        barra.classList.add('modal-abierto');
        modal.classList.add('mostrar');

        setTimeout(() => {
            modal.style.animation = 'slideIn 0.5s forwards';
        }, 10);
    }

    // Función para cerrar el modal principal
    function cerrarModal() {
        document.getElementById('modal').style.display = 'none';
    document.getElementById('app').classList.remove('overflow-hidden');
       
        modal.classList.remove('mostrar');
        modal.style.animation = 'slideOut 0.5s forwards';
        blurBackground.style.display = 'none'; 

        setTimeout(() => {
            modal.style.display = 'none'; 
            document.body.style.overflow = ''; // Restaura el overflow
            document.body.style.paddingRight = ''; // Elimina el padding
            app.style.width = '';
        }, 500); 
    }




    // Eventos
    btnReservar.addEventListener('click', abrirModal);
    btnCerrar.addEventListener('click', cerrarModal);




});


</script>

<div id="loading-spinner" class="loading-spinner">
    <div class="razor"></div>
</div>
<script>
    document.querySelector('#scrollToPricing').addEventListener('click', function () {
        const targetSection = document.querySelector('#precios');
        targetSection.scrollIntoView({ behavior: 'smooth' });
    });
</script>
<?php include_once __DIR__ . '/templates/footer.php'; ?>
    </div>
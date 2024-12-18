<script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
<!-- FullCalendar Scripts -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales/es.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>

<?php 
    include_once __DIR__ . '/../templates/barra.php';
?><div class="main-content">
<h1 class="nombre-pagina">Crear Cita</h1>
<p class="descripcion-pagina">Ingresa los datos que correspondan</p>

<form class="formulario-crear" method="POST" action="/crear-cuentaAdmin">
    <div class="campo-crear">
        <label for="servicios">Elige tus servicios</label>
        <div class="custom-combobox">
            <div class="combobox-selected">
                Selecciona uno o más servicios
            </div>
            <div class="combobox-options">
                <?php foreach ($servicios as $servicio): ?>
                    <label class="checkbox-option">
                        <input type="checkbox" value="<?php echo $servicio->id; ?>" name="servicios[]"
                               data-duration="<?php echo $servicio->duracion; ?>"
                               data-price="<?php echo $servicio->precio; ?>" /> <!-- Duración y precio -->
                        <?php echo $servicio->nombre; ?> - $<?php echo $servicio->precio; ?>
                    </label>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Otros campos del formulario -->
    <div class="campo-crear">
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" placeholder="Tu Nombre" value="<?php echo s($usuario->nombre); ?>" required />
    </div>

    <div class="campo-crear">
        <label for="apellido">Apellido</label>
        <input type="text" id="apellido" name="apellido" placeholder="Tu Apellido" value="<?php echo s($usuario->apellido); ?>" required />
    </div>

    <div class="campo-crear">
        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" placeholder="Tu E-mail (Obligatorio)" value="<?php echo s($usuario->email); ?>" required />
    </div>

    <div class="campo-crear">
        <button type="button" class="btn-ver-fechas" onclick="VerCrearCita()">Ver Fechas</button>
    </div>

    <div class="campo-crear">
        <label for="fecha">Fecha de la cita</label>
        <input type="text" id="fecha-nueva" name="fecha" />
    </div>

    <div class="campo-crear">
        <label for="hora">Hora de la cita</label>
        <input type="text" id="hora-nueva" name="hora" />
    </div>

    <div class="campo-crear">
        <label for="duracionTotal">Duración Total</label>
        <input type="number" id="duracionTotal" name="duracionTotal" value="0" readonly />
    </div>

    <div class="campo-crear">
        <label for="precioTotal">Precio Total</label>
        <input type="number" id="precioTotal" name="precioTotal" value="0" readonly />
    </div>

    <input type="submit" class="btn-confirmar" value="Crear Cita" />
</form>

<div id="spinner-overlay" class="spinner-overlay">
    <div class="spinner"></div>
</div>

<!-- Mostrar resumen de totales -->
<div>
    <p><strong>Duración Total:</strong> <span id="duracionResumen">0 minutos</span></p>
    <p><strong>Precio Total:</strong> $<span id="precioResumen">0</span></p>
</div>
</div>

<script>
// Función para actualizar los totales
function actualizarTotales() {
    let duracionTotal = 0;
    let precioTotal = 0;
    
    // Obtener todos los servicios seleccionados
    const checkboxes = document.querySelectorAll('input[name="servicios[]"]:checked');
    
    // Recorrer los servicios seleccionados
    checkboxes.forEach(function(checkbox) {
        const duracion = parseInt(checkbox.getAttribute('data-duration')); // Duración de cada servicio
        const precio = parseFloat(checkbox.getAttribute('data-price'));   // Precio de cada servicio

        // Sumar la duración y el precio
        duracionTotal += duracion;
        precioTotal += precio;
    });

    // Actualizar los valores en los campos y los resúmenes
    document.getElementById('duracionTotal').value = duracionTotal; // Actualizar el campo oculto de duración
    document.getElementById('precioTotal').value = precioTotal.toFixed(2); // Actualizar el campo oculto de precio
    document.getElementById('duracionResumen').textContent = duracionTotal + " minutos"; // Resumen de duración
    document.getElementById('precioResumen').textContent = precioTotal.toFixed(2); // Resumen de precio
}

// Agregar event listeners a los checkboxes para actualizar totales
document.querySelectorAll('input[name="servicios[]"]').forEach(function(checkbox) {
    checkbox.addEventListener('change', actualizarTotales);
});

// Llamar a la función para inicializar los totales al cargar la página
actualizarTotales();



</script>

<script>
    function mostrarSpinner() {
    document.getElementById('spinner-overlay').style.display = 'flex';
}

</script>

<div id="modal-crearcita" class="modal-seleccion" style="display: none;">
    <div class="modal-content-seleccion">
        <h2>Selecciona una fecha</h2>
        <div id="calendar-container">
            <div id="calendar-crear"></div>
        </div>
        <button class="btn-cancelar" onclick="cerrarCrearCita()">Cancelar</button>
    </div>
</div>


<div id="modal-seleccionar-turno" class="modal-seleccionar-turno">
    <div class="modal-contenido-seleccionar">
        <h3 class="text-center">Selecciona tu Horario</h3>
        <p class="text-center">¿Qué parte del día prefieres?</p>
        <div class="campo">
            <input id="fechacrear" type="date" />
        </div>


        <div class="campo-hora">
            <div class="botones-turno">
                <button id="turno-manana" type="button" class="button-hora" onclick="mostrarHorariosCrear('manana')">Mañana</button>
                <button id="turno-tarde" type="button" class="button-hora" onclick="mostrarHorariosCrear('tarde')">Tarde</button>
            </div>
            <div id="horarios-crear" class="horarios-container"></div>
        </div>
        <button id="confirmar-modal-seleccionar" class="btn-confirmar " onclick=ConfirmarHoraCrear() >Confirmar</button>
        <button id="cerrar-modal-seleccionar" class="btn" onclick=CerrarHoraCrear()>Cerrar</button>
        </div>
</div>


<?php
    $script = "<script src='build/js/buscador.js'></script>"
    
?>


    




<script>
document.addEventListener("DOMContentLoaded", () => {
    const combobox = document.querySelector(".custom-combobox");
    const selected = combobox.querySelector(".combobox-selected");
    const options = combobox.querySelector(".combobox-options");
    const checkboxes = options.querySelectorAll("input[type='checkbox']");

    selected.addEventListener("click", () => {
        options.classList.toggle("active");
    });

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener("change", () => {
            const selectedOptions = Array.from(checkboxes)
                .filter(checkbox => checkbox.checked)
                .map(checkbox => checkbox.parentNode.textContent.trim());
            
            selected.textContent = selectedOptions.length > 0
                ? selectedOptions.join(", ")
                : "Selecciona uno o más servicios";
        });
    });

    // Cerrar el combobox si haces clic fuera
    document.addEventListener("click", (e) => {
        if (!combobox.contains(e.target)) {
            options.classList.remove("active");
        }
    });
});

</script>
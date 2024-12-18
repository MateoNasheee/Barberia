<div class="main-content">
    <h1 class="nombre-pagina">Servicios</h1>
    <p class="descripcion-pagina">Administración de Servicios</p>

    <?php include_once __DIR__ . '/../templates/barra.php'; ?>

    <ul class="servicios">
        <?php foreach($servicios as $servicio) { ?>
            <li class="servicio-item">
                <p>Nombre: <span><?php echo $servicio->nombre; ?></span></p>
                <p>Precio: <span>$<?php echo $servicio->precio; ?></span></p>
                <p>Duración (Minutos): <span><?php echo $servicio->duracion; ?></span></p>
                <p>Categoría: <span><?php echo $servicio->categoria; ?></span></p> <!-- Aquí agregamos la categoría -->
                <p>Descripción: <span><?php echo $servicio->descripcion; ?></span></p> <!-- Aquí agregamos la descripción -->
                
                <div class="acciones">
                    <a class="boton" href="/servicios/actualizar?id=<?php echo $servicio->id; ?>">Actualizar</a>

                    <form action="/servicios/eliminar" method="POST">
                        <input type="hidden" name="id" value="<?php echo $servicio->id; ?>">
                        <input type="submit" value="Borrar" class="boton-eliminar">
                    </form>
                </div>
            </li>
        <?php } ?>
    </ul>
</div>

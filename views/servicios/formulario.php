<div class="main-content">
    <h1 class="nombre-pagina">Crear Servicio</h1>
    
    <div class="campo">
        <label for="nombre">Nombre</label>
        <input 
            type="text"
            id="nombre"
            placeholder="Nombre Servicio"
            name="nombre"
            value="<?php echo $servicio->nombre; ?>"
        />
    </div>

    <div class="campo">
        <label for="precio">Precio</label>
        <input 
            type="number"
            id="precio"
            placeholder="Precio Servicio"
            name="precio"
            value="<?php echo $servicio->precio; ?>"
        />
    </div>

    <div class="campo">
        <label for="duracion">Duración (minutos)</label>
        <select 
            id="duracion"
            name="duracion"
        >
            <option value="15" <?php echo ($servicio->duracion == 15) ? 'selected' : ''; ?>>15 minutos</option>
            <option value="30" <?php echo ($servicio->duracion == 30) ? 'selected' : ''; ?>>30 minutos</option>
            <option value="60" <?php echo ($servicio->duracion == 60) ? 'selected' : ''; ?>>60 minutos</option>
        </select>
    </div>

    <!-- Nuevo campo de categoría -->
    <div class="campo">
        <label for="categoria">Categoría</label>
        <select id="categoria" name="categoria">
            <option value="facial" <?php echo ($servicio->categoria == 'facial') ? 'selected' : ''; ?>>Facial</option>
            <option value="cabello" <?php echo ($servicio->categoria == 'cabello') ? 'selected' : ''; ?>>Cabello</option>
            <option value="barba" <?php echo ($servicio->categoria == 'barba') ? 'selected' : ''; ?>>Barba</option>
            <option value="combo" <?php echo ($servicio->categoria == 'combo') ? 'selected' : ''; ?>>Combo</option>
        </select>
    </div>

    <!-- Nuevo campo de descripción -->
    <div class="campo">
        <label for="descripcion">Descripción</label>
        <textarea 
            id="descripcion" 
            name="descripcion" 
            placeholder="Descripción del servicio" 
            rows="4"
        ><?php echo $servicio->descripcion; ?></textarea>
    </div>

    
</div>

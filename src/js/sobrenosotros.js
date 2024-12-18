const citaNosotros = {
    id: '',
    nombre: '',
    fecha: '',
    hora: '',
    servicios: []
}


document.addEventListener('DOMContentLoaded', function() {
    iniciarApp();

    
});

function iniciarApp() {
    consultarLista();
    
   
}


async function consultarLista() {

    try {
        const url = '/api/ListaServicios';
        const resultado = await fetch(url);
        const servicios = await resultado.json();
        mostrarListaServicio(servicios);
        console.log(servicios);
       
        
    } catch (error) {
        console.log(error);
    }
}
function mostrarListaServicio(servicios) {
    const serviciosDiv = document.querySelector('#servicios-lista');
    serviciosDiv.innerHTML = ''; // Limpiar contenido previo

    // Agrupar los servicios por categoría
    const categorias = ['Cabello', 'Facial', 'Barba', 'Combo'];

    categorias.forEach(categoria => {
        // Crear un bloque para cada categoría
        const categoriaDiv = document.createElement('div');
        categoriaDiv.classList.add('categoria');
        
        const categoriaTitulo = document.createElement('h3');
        categoriaTitulo.textContent = categoria;
        categoriaDiv.appendChild(categoriaTitulo);

        // Filtrar los servicios de esta categoría
        const serviciosCategoria = servicios.filter(servicio => servicio.categoria === categoria);

        // Crear la tabla para los servicios de esta categoría
        const tabla = document.createElement('table');
        tabla.classList.add('tabla-servicios');
        
        // Crear encabezado de la tabla
        const tablaHeader = document.createElement('thead');
        const headerRow = document.createElement('tr');
        headerRow.innerHTML = `<th>Servicio</th><th>Precio</th><th>Duración</th><th>Descripción</th>`;
        tablaHeader.appendChild(headerRow);
        tabla.appendChild(tablaHeader);

        // Crear el cuerpo de la tabla con los servicios
        const tablaBody = document.createElement('tbody');
        serviciosCategoria.forEach(servicio => {
            const row = document.createElement('tr');

            // Asignar data-label a cada celda
            row.innerHTML = `
                <td data-label="Servicio">${servicio.nombre}</td>
                <td data-label="Precio">$${servicio.precio}</td>
                <td data-label="Duración">${servicio.duracion} min</td>
                <td data-label="Descripción">${servicio.descripcion}</td>
            `;
            tablaBody.appendChild(row);
        });

        tabla.appendChild(tablaBody);
        categoriaDiv.appendChild(tabla);
        serviciosDiv.appendChild(categoriaDiv);
    });
}



function abrirModalHistoria() {
  
    const modal = document.getElementById('modal-historia');
    document.getElementById('blur-background').style.display = 'block';
    modal.style.display = 'flex'; // Muestra el modal
   

}

function cerrarModalHistoria() {
    
    const modal = document.getElementById('modal-historia');
    modal.style.display = 'none'; // Cierra el modal
    document.getElementById('blur-background').style.display = 'none';
}



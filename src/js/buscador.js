const citaAdmin = {
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
    // buscarPorFecha();
    
    generarHorarios();
    
    gestionarModalObservaciones();
     mostrarHorariosCrear();
    //mostrarHorariosPosponer();
}


function ConfirmarHoraCrear(){
     // Asegúrate de que las variables citaAdmin.fecha y citaAdmin.hora contienen los valores seleccionados
     const fechaInput = document.getElementById('fecha-nueva');
     const horaInput = document.getElementById('hora-nueva');
 
     // Rellenar los inputs con las variables citaAdmin.fecha y citaAdmin.hora
     if (citaAdmin.fecha && citaAdmin.hora) {
         fechaInput.value = citaAdmin.fecha;  // Asignar la fecha al campo de fecha
         horaInput.value = citaAdmin.hora;    // Asignar la hora al campo de hora
     }
 
     CerrarHoraCrear();
     cerrarCrearCita();
}








function cerrarModalAnular(){
    document.querySelector('#modal-observaciones-anular').style.display = 'none';
}
function eliminarCita(button){
    const citaId = button.getAttribute('data-id');
    const usuarioId= button.getAttribute('data-usuario-id');
    const email = button.getAttribute('data-email');
    console.log('el email', email)
    citaAdmin.usuarioId = usuarioId
    citaAdmin.email=email;
    console.log(citaAdmin.usuarioId);
    console.log(citaAdmin.email);
    citaAdmin.id=citaId;
    console.log("ID de la cita a posponer: " + citaAdmin.id);
    const modalObservaciones = document.querySelector('#modal-observaciones-anular');
    modalObservaciones.style.display = 'block';
    modalObservaciones.classList.add('show');
    
    setTimeout(() => {
        modalObservaciones.style.animation = 'slideIn 0.5s forwards';
    }, 10);
}
// Validar que el botón "Enviar" se habilite solo si hay más de 15 caracteres
document.querySelector('#observacion-anular').addEventListener('input', function() {
    const textarea = document.querySelector('#observacion-anular');
    const enviarButton = document.querySelector('#enviar-observacion-anular');
    
    if (textarea.value.length > 15) {
        enviarButton.disabled = false; // Habilitar el botón
    } else {
        enviarButton.disabled = true; // Deshabilitar el botón
    }
});

// Función que se llama cuando se hace clic en "Enviar"
document.querySelector('#enviar-observacion-anular').addEventListener('click', function() {
    const observacion = document.querySelector('#observacion-anular').value;

    // Llamar a la función que anula la cita
    AnularTurno(observacion);
});


function AnularTurno(observacion) {
    const usuarioId = citaAdmin.usuarioId;
    const citaid = citaAdmin.id;   // Obtener ID de la cita
    const email = citaAdmin.email;  // Obtener el email del cliente
    console.log("Longitud de la observación: ", observacion.length);
    console.log('email: ',email);
    console.log('cita: ',citaid);
    console.log('usuario: ',usuarioId);
    // Mostrar el spinner de carga mientras se procesan los datos
    const spinner = document.getElementById("loading-spinner");
    spinner.classList.add("show");

    // Verificar que la observación tenga al menos 15 caracteres y los datos estén presentes
    if (observacion.length >= 15 && citaid && email) {
        fetch('/api/anularCita', {  // Aquí usamos el endpoint de anulación
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                citaid: citaid,
                email: email,
                usuarioId: usuarioId,
                observacion: observacion
            }),
        })
        .then(response => response.text())
        .then(data => {
            console.log('Respuesta cruda del servidor:', data);
            try {
                const jsonResponse = JSON.parse(data);
                if (jsonResponse.resultado) {  // Verificamos si la respuesta es exitosa
                    spinner.classList.remove("show");

                    Swal.fire({
                        icon: 'success',
                        title: 'Cita Anulada',
                        text: 'La cita fue anulada correctamente.',
                        button: 'OK'
                    }).then(() => {
                        setTimeout(() => {
                            window.location.reload();  // Recargar la página después de la anulación
                        }, 1000);
                    });
                } else {
                    alert('Hubo un problema al anular la cita: ' + (jsonResponse.error || 'Error desconocido'));
                }
            } catch (error) {
                console.error('Error al parsear JSON:', error);
                alert('Hubo un error al procesar la respuesta del servidor');
            }
        })
        .catch(error => {
            console.error('Error al enviar los datos:', error);
            alert('Hubo un error al enviar los datos al servidor');
        });
    } else {
        alert('Por favor, ingresa una observación válida de al menos 15 caracteres.');
    }
}






var calendarVer; // Variable global para el calendario del modal
function inicializarCalendarioVer() {
    var calendarEl = document.getElementById('calendar-ver');
    var fechaInput = document.getElementById('fecha'); // Input de fecha
    var modalSeleccionarTurno = document.getElementById('modal-seleccionar-turno');
    const modalPrincipal = document.querySelector('#modal');
    var today = new Date();
    today.setHours(0, 0, 0, 0); // Resetear las horas de la fecha actual

    var calendarVer = new FullCalendar.Calendar(calendarEl, {
        locale: 'es',
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev',
            center: 'title',
            right: 'next'
        },
        events: [],
        dateClick: function(info) {
            var selectedDate = new Date(info.dateStr);
            selectedDate.setHours(0, 0, 0, 0); 

            // Redirigir a la URL para buscar por fecha (sin restricciones)
            window.location = `?fecha=${info.dateStr}`;
        },
        dayCellDidMount: function(info) {
            var currentDay = new Date(info.date);
            currentDay.setHours(0, 0, 0, 0);

            // Eliminar las restricciones de días pasados y futuros
            // Eliminar cualquier clase que estaba agregada previamente
            info.el.classList.remove('disabled-day');
            info.el.classList.remove('current-day');

            // Marcar el día actual
            if (currentDay.getTime() === today.getTime()) {
                info.el.classList.add('current-day');
            }
        },
        datesSet: function(dateInfo) {
            // Eliminar las restricciones de navegación entre meses
            const displayedMonth = dateInfo.start.getMonth();
            const displayedYear = dateInfo.start.getFullYear();

            const prevButton = document.querySelector('.fc-prev-button');
            const nextButton = document.querySelector('.fc-next-button');

            // Habilitar los botones de navegación siempre
            prevButton.disabled = false;
            nextButton.disabled = false;
        }
    });

    calendarVer.render();
}


// function buscarPorFecha() {
//     const fechaInput = document.querySelector('#fecha');
//     fechaInput.addEventListener('input', function(e) {
//         const fechaSeleccionada = e.target.value;

//         window.location = `?fecha=${fechaSeleccionada}`;
//     });
// }


function cerrarhorarioscrear(){
    // Función para cerrar el modal secundario con animación
    const modalSecundario = document.getElementById('modal-seleccionar-turno');
        modalSecundario.style.animation = 'slideOut 0.5s forwards'; // Animación de salida
        setTimeout(() => {
            modalSecundario.style.display = 'none'; // Oculta el modal después de la animación
            modalSecundario.classList.remove('mostrar'); // Limpia las clases
            
            modal.style.pointerEvents = 'auto';
            modalSecundario.style.pointerEvents = 'none'; // Desactivar interacciones cuando el modal esté cerrado
        }, 500);
}

// Función para cerrar el modal de posponer
function cerrarCrearCita() {
    const modal = document.getElementById("modal-crearcita"); // Asegúrate de que este ID coincida con el de tu modal
    modal.style.display = "none"; // Cierra el modal ocultándolo  
    document.getElementById('blur-background').style.display = 'none'; // Oculta el fondo de desenfoque si lo tienes
    
}
function VerCrearCita(){
    // Mostrar el modal
    const modalFecha = document.getElementById('modal-crearcita');
    modalFecha.classList.add('show');
    modalFecha.style.display = 'block';
    inicializarFechas();

    // Verifica si el calendario está inicializado
    setTimeout(function () {
        if (calendarDisponible) {
            console.log('hola'); // Asegurarse de que el calendario está inicializado antes de actualizar el tamaño
            calendarDisponible.updateSize();  
        } else {
            console.error("calendarAdmin no está inicializado.");
        }
    }, 300); 
}
var calendarDisponible; // Variable global para el segundo calendario

function inicializarFechas() {
    var calendarEl = document.getElementById('calendar-crear');
    var fechaPosponerInput = document.getElementById('fechacrear'); //Puedes cambiar esto si necesitas otro input
    var modalSeleccionarTurno = document.getElementById('modal-seleccionar-turno'); // Modal secundario

    // Obtener la fecha actual
    var today = new Date();
    today.setHours(0, 0, 0, 0); // Resetear las horas de la fecha actual

    // Fecha de ayer
    var yesterday = new Date(today);
    yesterday.setDate(today.getDate()); // Restar un día para obtener ayer

    // Inicializar el segundo calendario
    calendarDisponible = new FullCalendar.Calendar(calendarEl, {
        locale: 'es',
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev',
            center: 'title',
            right: 'next'
        },
        events: [],
        dateClick: function(info) {
            var selectedDate = new Date(info.dateStr);
            selectedDate.setHours(0, 0, 0, 0); // Asegurarse de comparar solo la fecha, no la hora
            var thirtyDaysFromNow = new Date(today);
            thirtyDaysFromNow.setDate(today.getDate() + 30); // Fecha 30 días adelante
        
            // console.log("Fecha seleccionada:", selectedDate);
            // console.log("Fecha límite (30 días desde hoy):", thirtyDaysFromNow);
            // console.log("Fecha de ayer:", yesterday);
        
            // Verificar si la fecha seleccionada es anterior a hoy o posterior a los 30 días
            if (selectedDate < yesterday || selectedDate > thirtyDaysFromNow) {
                // console.log("La fecha seleccionada no está permitida.");
                return; // No permitir selección si la fecha es inválida
            }
        
            // Actualizar el input con la fecha seleccionada
            fechaPosponerInput.value = info.dateStr;
            // console.log("Fecha seleccionada actualizada en el input:", fechaInput.value);
        
            // Guardar la fecha seleccionada en la variable cita.fecha
            citaAdmin.fecha = info.dateStr;
            // console.log("Fecha guardada en cita.fecha:", cita.fecha);
        
            // Mostrar el modal de selección de turno
            modalSeleccionarTurno.style.display = 'block';
            modalSeleccionarTurno.classList.add('mostrar');
            // console.log("Modal de selección de turno mostrado.");
        
            setTimeout(() => {
                modalSeleccionarTurno.style.animation = 'slideIn 0.5s forwards';
            }, 10);
            modalSeleccionarTurno.style.pointerEvents = 'auto';
        
            // Desactivar el modal principal si es necesario

            // console.log("Modal principal desactivado.");
        },
        dayCellDidMount: function(info) {
            var currentDay = new Date(info.date);
            currentDay.setHours(0, 0, 0, 0); // Resetear las horas para que solo compare la fecha

            // Comparar con la fecha de ayer y añadir una clase a los días pasados
            if (currentDay <= yesterday) {
                info.el.classList.add('disabled-day'); // Añadir clase para deshabilitar el día
            }

            // Comparar si el día está fuera del rango de +30 días
            var thirtyDaysFromNow = new Date(today);
            thirtyDaysFromNow.setDate(today.getDate() + 30);
            if (currentDay > thirtyDaysFromNow) {
                info.el.classList.add('disabled-day'); // Añadir clase para días fuera del rango
            }

            // Aplicar borde al día actual sin fondo
            if (currentDay.getTime() === today.getTime()) {
                info.el.classList.add('current-day'); // Añadir una clase especial al día actual
            }
        },
        datesSet: function(dateInfo) {
            const displayedMonth = dateInfo.start.getMonth();
            const displayedYear = dateInfo.start.getFullYear();

            const lastMonth = new Date(today);
            lastMonth.setMonth(today.getMonth() - 1);

            const prevButton = document.querySelector('.fc-prev-button');
            prevButton.disabled = (displayedMonth === lastMonth.getMonth() && displayedYear === lastMonth.getFullYear());

            const nextButton = document.querySelector('.fc-next-button');
            nextButton.disabled = (displayedMonth === today.getMonth() && displayedYear === today.getFullYear());
        }
    });

    calendarDisponible.render();
    

}


function posponerCita(button) {
    // Obtener el ID de la cita desde el atributo data-id
    const citaId = button.getAttribute('data-id');
    const email = button.getAttribute('data-email');
    const usuarioId = button.getAttribute('data-usuario-id');
    citaAdmin.email=email;
    citaAdmin.usuarioId = usuarioId;
    console.log(citaAdmin.usuarioId);
    citaAdmin.id=citaId;
    console.log("ID de la cita a posponer: " + citaAdmin.id);

    // Mostrar el modal
    const modalFecha = document.getElementById('modal-posponer');
    modalFecha.classList.add('show');
    modalFecha.style.display = 'block';

    // Inicializar el calendario
    inicializarCalendarioPosponer(citaId);

    // Verifica si el calendario está inicializado
    setTimeout(function () {
        if (calendar3) {
            console.log('hola'); // Asegurarse de que el calendario está inicializado antes de actualizar el tamaño
            calendar3.updateSize();  
        } else {
            console.error("calendarAdmin no está inicializado.");
        }
    }, 300); 
}

// Función para cerrar el modal de posponer
function cerrarModalFecha() {
    const modal = document.getElementById("modal-posponer"); // Asegúrate de que este ID coincida con el de tu modal
    modal.style.display = "none"; // Cierra el modal ocultándolo
    
    document.getElementById('blur-background').style.display = 'none'; // Oculta el fondo de desenfoque si lo tienes

}

function cerrarModalHora() {
    const modal = document.getElementById("modal-seleccionar-turno"); // Asegúrate de que este ID coincida con el de tu modal
    modal.style.display = "none"; // Cierra el modal ocultándolo
    
    document.getElementById('blur-background').style.display = 'none'; // Oculta el fondo de desenfoque si lo tienes

}
var calendarPosponer; // Variable global para el segundo calendario

function inicializarCalendarioPosponer() {
    var calendarEl = document.getElementById('calendar-posponer');
    var fechaPosponerInput = document.getElementById('fechaPosponer'); //Puedes cambiar esto si necesitas otro input
    var modalSeleccionarTurno = document.getElementById('modal-seleccionar-turno'); // Modal secundario

    // Obtener la fecha actual
    var today = new Date();
    today.setHours(0, 0, 0, 0); // Resetear las horas de la fecha actual

    // Fecha de ayer
    var yesterday = new Date(today);
    yesterday.setDate(today.getDate()); // Restar un día para obtener ayer

    // Inicializar el segundo calendario
    calendarPosponer = new FullCalendar.Calendar(calendarEl, {
        locale: 'es',
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev',
            center: 'title',
            right: 'next'
        },
        events: [],
        dateClick: function(info) {
            var selectedDate = new Date(info.dateStr);
            selectedDate.setHours(0, 0, 0, 0); // Asegurarse de comparar solo la fecha, no la hora
            var thirtyDaysFromNow = new Date(today);
            thirtyDaysFromNow.setDate(today.getDate() + 30); // Fecha 30 días adelante
        
            // console.log("Fecha seleccionada:", selectedDate);
            // console.log("Fecha límite (30 días desde hoy):", thirtyDaysFromNow);
            // console.log("Fecha de ayer:", yesterday);
        
            // Verificar si la fecha seleccionada es anterior a hoy o posterior a los 30 días
            if (selectedDate < yesterday || selectedDate > thirtyDaysFromNow) {
                // console.log("La fecha seleccionada no está permitida.");
                return; // No permitir selección si la fecha es inválida
            }
        
            // Actualizar el input con la fecha seleccionada
            fechaPosponerInput.value = info.dateStr;
            // console.log("Fecha seleccionada actualizada en el input:", fechaInput.value);
        
            // Guardar la fecha seleccionada en la variable cita.fecha
            citaAdmin.fecha = info.dateStr;
            // console.log("Fecha guardada en cita.fecha:", cita.fecha);
        
            // Mostrar el modal de selección de turno
            modalSeleccionarTurno.style.display = 'block';
            modalSeleccionarTurno.classList.add('mostrar');
            // console.log("Modal de selección de turno mostrado.");
        
            setTimeout(() => {
                modalSeleccionarTurno.style.animation = 'slideIn 0.5s forwards';
            }, 10);
            modalSeleccionarTurno.style.pointerEvents = 'auto';
        
            // Desactivar el modal principal si es necesario

            // console.log("Modal principal desactivado.");
        },
        dayCellDidMount: function(info) {
            var currentDay = new Date(info.date);
            currentDay.setHours(0, 0, 0, 0); // Resetear las horas para que solo compare la fecha

            // Comparar con la fecha de ayer y añadir una clase a los días pasados
            if (currentDay <= yesterday) {
                info.el.classList.add('disabled-day'); // Añadir clase para deshabilitar el día
            }

            // Comparar si el día está fuera del rango de +30 días
            var thirtyDaysFromNow = new Date(today);
            thirtyDaysFromNow.setDate(today.getDate() + 30);
            if (currentDay > thirtyDaysFromNow) {
                info.el.classList.add('disabled-day'); // Añadir clase para días fuera del rango
            }

            // Aplicar borde al día actual sin fondo
            if (currentDay.getTime() === today.getTime()) {
                info.el.classList.add('current-day'); // Añadir una clase especial al día actual
            }
        },
        datesSet: function(dateInfo) {
            const displayedMonth = dateInfo.start.getMonth();
            const displayedYear = dateInfo.start.getFullYear();

            const lastMonth = new Date(today);
            lastMonth.setMonth(today.getMonth() - 1);

            const prevButton = document.querySelector('.fc-prev-button');
            prevButton.disabled = (displayedMonth === lastMonth.getMonth() && displayedYear === lastMonth.getFullYear());

            const nextButton = document.querySelector('.fc-next-button');
            nextButton.disabled = (displayedMonth === today.getMonth() && displayedYear === today.getFullYear());
        }
    });

    calendarPosponer.render();
    

}
function CerrarHoraCrear(){
    const modal = document.querySelector('#modal-seleccionar-turno');
    modal.style.animation = 'slideOut 0.5s forwards';
    setTimeout(() => {
        modal.style.display = 'none'; // Oculta el modal
        modal.classList.remove('show');
    }, 500);
}

function cerrarmodalhorarios(){
    // Función para cerrar el modal secundario con animación
    const modalSecundario = document.getElementById('modal-seleccionar-turno');
        modalSecundario.style.animation = 'slideOut 0.5s forwards'; // Animación de salida
        setTimeout(() => {
            modalSecundario.style.display = 'none'; // Oculta el modal después de la animación
            modalSecundario.classList.remove('mostrar'); // Limpia las clases
            
            modal.style.pointerEvents = 'auto';
            modalSecundario.style.pointerEvents = 'none'; // Desactivar interacciones cuando el modal esté cerrado
        }, 500);
}


function generarHorarios(inicio, fin, intervalo) {
    let horarios = [];
    let horaActual = moment(inicio, 'HH:mm');
    let horaFinal = moment(fin, 'HH:mm');
    
    while (horaActual <= horaFinal) {
        horarios.push(horaActual.format('HH:mm'));
        horaActual.add(intervalo, 'minutes');
    }
    
    return horarios;
}

function mostrarHorariosCrear(turno) {
    const contenedorHorarios = document.querySelector('#horarios-crear');
    contenedorHorarios.innerHTML = ''; // Limpiar horarios anteriores
    contenedorHorarios.style.display = 'flex';

    let horarios = [];
    const botonManana = document.querySelector('#turno-manana');
    const botonTarde = document.querySelector('#turno-tarde');

    // Definir horarios
    if (turno === 'manana') {
        horarios = generarHorarios('08:00', '11:30', 30); // Horarios de mañana
        botonManana.classList.add('seleccionado');
        botonTarde.classList.remove('seleccionado');
    } else {
        horarios = generarHorarios('14:00', '18:30', 30); // Horarios de tarde
        botonTarde.classList.add('seleccionado');
        botonManana.classList.remove('seleccionado');
    }

    // Generar botones de horarios
    horarios.forEach((hora, index) => {
        const botonHora = document.createElement('button');
        botonHora.classList.add('botones', 'horario', 'botones-horarios', 'oculto');
        botonHora.textContent = hora;
        botonHora.style.backgroundColor = turno === 'manana' ? '#28a745' : '#ff9800';

        // Asociar evento para seleccionar hora
        botonHora.addEventListener('click', () => seleccionarHoraCrear(hora));

        setTimeout(() => {
            botonHora.classList.remove('oculto');
            botonHora.classList.add('visible');
        }, index * 100);

        contenedorHorarios.appendChild(botonHora);
    });
}
function seleccionarHoraCrear(hora) {
    const botonesHorario = document.querySelectorAll('.horario');
    const botonConfirmar = document.querySelector('#confirmar-modal-seleccionar'); // El botón confirmar

    // Buscar el botón seleccionado
    botonesHorario.forEach(boton => boton.classList.remove('seleccionado')); // Deselecciona todos
    const botonSeleccionado = Array.from(botonesHorario).find(boton => boton.textContent === hora);

    if (botonSeleccionado) {
        botonSeleccionado.classList.add('seleccionado'); // Marca como seleccionado
        citaAdmin.hora = hora; // Actualiza la hora en citaAdmin
        console.log(citaAdmin.hora);
        botonConfirmar.disabled = false; // Habilitar el botón
    } else {
        citaAdmin.hora = null; // No hay hora seleccionada
        botonConfirmar.disabled = true; // Deshabilitar el botón
    }
}




// Mostrar horarios según el turno seleccionado
function mostrarHorariosPosponer(turno) {
    const contenedorHorarios = document.querySelector('#horarios-posponer');
    contenedorHorarios.innerHTML = ''; // Limpiar horarios anteriores
    contenedorHorarios.style.display = 'flex';

    let horarios = [];
    const botonManana = document.querySelector('#turno-manana');
    const botonTarde = document.querySelector('#turno-tarde');

    // Definir horarios
    if (turno === 'manana') {
        horarios = generarHorarios('08:00', '11:30', 30); // Horarios de mañana
        botonManana.classList.add('seleccionado');
        botonTarde.classList.remove('seleccionado');
    } else {
        horarios = generarHorarios('14:00', '18:30', 30); // Horarios de tarde
        botonTarde.classList.add('seleccionado');
        botonManana.classList.remove('seleccionado');
    }

    // Generar botones de horarios
    horarios.forEach((hora, index) => {
        const botonHora = document.createElement('button');
        botonHora.classList.add('botones', 'horario', 'botones-horarios', 'oculto');
        botonHora.textContent = hora;
        botonHora.style.backgroundColor = turno === 'manana' ? '#28a745' : '#ff9800';

        botonHora.addEventListener('click', () => seleccionarHoraPosponer(hora));

        setTimeout(() => {
            botonHora.classList.remove('oculto');
            botonHora.classList.add('visible');
        }, index * 100);

        contenedorHorarios.appendChild(botonHora);
    });
}

// Función para seleccionar un horario y habilitar el botón "Confirmar"
function seleccionarHoraPosponer(hora) {
    const botonesHorario = document.querySelectorAll('.horario');
    const botonConfirmar = document.querySelector('#btn-confirmar');

    // Quitar selección previa y asignar la nueva
    botonesHorario.forEach(boton => boton.classList.remove('seleccionado'));
    const botonSeleccionado = Array.from(botonesHorario).find(boton => boton.textContent === hora);

    if (botonSeleccionado) {
        botonSeleccionado.classList.add('seleccionado');
        citaAdmin.hora = hora;
    } else {
        citaAdmin.hora = null;
    }

    // Habilitar/deshabilitar el botón "Confirmar" según la selección
    botonConfirmar.disabled = !citaAdmin.hora;

    console.log('Hora seleccionada:', citaAdmin.hora); // Depuración
    console.log('Botón confirmar habilitado:', !botonConfirmar.disabled); // Depuración
}

// Validar la longitud de la observación
function validarObservacion() {
    const textarea = document.querySelector('#observacion-textarea');
    const botonEnviar = document.querySelector('#enviar-observacion');
    const textoObservacion = textarea.value.trim();

    // Habilitar el botón si el texto tiene al menos 15 caracteres
    botonEnviar.disabled = textoObservacion.length < 15;
}

// Abrir modal de observaciones
function abrirModalObservaciones() {
    if (!citaAdmin.hora) {
        console.error('No se puede abrir el modal: No hay hora seleccionada.');
        return;
    }

    const modalObservaciones = document.querySelector('#modal-observaciones');
    modalObservaciones.style.display = 'block';
    modalObservaciones.classList.add('show');

    // Reiniciar estado del textarea y botón "Enviar"
    const textarea = document.querySelector('#observacion-textarea');
    const botonEnviar = document.querySelector('#enviar-observacion');
    textarea.value = '';
    botonEnviar.disabled = true;
}

// Cerrar modal de observaciones
function cerrarModalObservaciones() {
    const modalObservaciones = document.querySelector('#modal-observaciones');
    modalObservaciones.style.display = 'none';
    modalObservaciones.classList.remove('show');
}

// Enviar datos de la nueva fecha
function enviarFecha() {
    const observacion = document.querySelector('#observacion-textarea').value.trim();
    const fecha = citaAdmin.fecha;
    const hora = citaAdmin.hora;
    const citaid = citaAdmin.id;
    const email = citaAdmin.email;
    const usuarioId = citaAdmin.usuarioId;
    const spinner = document.getElementById('loading-spinner');

    if (observacion.length >= 15 && fecha && hora && citaid) {
        spinner.classList.add('show');

        fetch('/api/posponerFechaAdmin', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                observacion: observacion,
                fecha: fecha,
                hora: hora,
                citaid: citaid,
                usuarioId: usuarioId,
                email: email,
            }),
        })
            .then(response => response.text())
            .then(data => {
                console.log('Respuesta cruda del servidor:', data);

                try {
                    const jsonResponse = JSON.parse(data);
                    console.log('Respuesta JSON:', jsonResponse);

                    if (jsonResponse.resultado) {
                        spinner.classList.remove('show');

                        Swal.fire({
                            icon: 'success',
                            title: 'Turno Pospuesto',
                            text: 'El turno fue pospuesto correctamente.',
                            button: 'OK',
                        }).then(() => {
                            setTimeout(() => {
                                window.location.reload();
                            }, 1000);
                        });
                    } else {
                        alert('Hubo un problema al posponer el turno: ' + (jsonResponse.error || 'Error desconocido'));
                    }
                } catch (error) {
                    console.error('Error al parsear JSON:', error);
                    alert('Hubo un error al procesar la respuesta del servidor.');
                }
            })
            .catch(error => {
                console.error('Error al enviar los datos:', error);
                alert('Hubo un error al enviar los datos al servidor.');
            });
    } else {
        alert('Por favor, completa todos los campos correctamente.');
    }
}

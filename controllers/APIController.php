<?php

namespace Controllers;

use Model\Cita;
use Model\CitaServicio;
use Model\Servicio;
use Model\Usuario;
use Model\HistorialCita;
use Model\AdminCita;
use Classes\Email;
use Model\Exception; // Asegúrate de que esta clase exista


class APIController {
    public static function index() {
        $servicios = Servicio::all();
        echo json_encode($servicios);
    }

    public static function indexEdicion() {
        $serviciosEdicion = Servicio::all();
        echo json_encode($serviciosEdicion);
    }
    public static function indexAgregar() {
        $serviciosAgregar = Servicio::all();
        echo json_encode($serviciosAgregar);
    }
    public static function listaServicio() {
        $listaServicio = Servicio::all();
        echo json_encode($listaServicio);
    }

    public static function obtenerHistorialCitas() {
        session_start();
        
        // Obtén el ID del usuario de la sesión
        $usuarioId = $_SESSION['id'] ?? null;
    
        // Verifica si el usuario está autenticado
        if (!$usuarioId) {
            echo json_encode(['success' => false, 'message' => 'Usuario no autenticado.']);
            return;
        }
    
        // Consulta SQL actualizada para incluir el usuarioId
        $consulta = "SELECT citas.id AS citaId, citas.fecha, citas.hora, servicios.nombre AS servicioNombre, 
                     servicios.precio AS servicioPrecio, citas.estado, servicios.id AS servicioId, citas.usuarioId
                     FROM citas 
                     LEFT JOIN citasServicios ON citasServicios.citaId = citas.id 
                     LEFT JOIN servicios ON servicios.id = citasServicios.servicioId 
                     WHERE citas.usuarioId = ${usuarioId} AND citas.fecha >= now()
                     ORDER BY citas.fecha asc";
    
        // Ejecutar la consulta para obtener los datos
        $historial = HistorialCita::SQL($consulta);
        
        // Devolver los datos en formato JSON
        echo json_encode(['success' => true, 'historial' => $historial]);
    }

    public static function guardarCitaEnSesion() {
        session_start();
        $data = json_decode(file_get_contents("php://input"), true);
        $citaId = intval($data['citaId'] ?? 0);
        
        if ($citaId <= 0) {
            echo json_encode(['success' => false, 'message' => 'ID de cita no válido.']);
            return;
        }
    
        $_SESSION['citaId'] = $citaId;
        echo json_encode(['success' => true]);
    }
    
    public static function obtenerDetallesServicioDeSesion() {
        session_start();
        $servicioId = $_SESSION['servicioId'] ?? null;
        $usuarioId = $_SESSION['id'] ?? null;
    
        if (!$usuarioId || !$servicioId) {
            echo json_encode(['success' => false, 'message' => 'Usuario no autenticado o ID de servicio no especificado.']);
            return;
        }
    
        // Escapar los valores para prevenir inyección SQL
        $servicioId = intval($servicioId); // Asegúrate de que sea un entero
        $usuarioId = intval($usuarioId); // Asegúrate de que sea un entero
    
        // Construir la consulta SQL para obtener los detalles del servicio
        $consulta = "SELECT servicios.id AS servicioId, servicios.nombre, servicios.precio
                     FROM servicios 
                     WHERE servicios.id = $servicioId";
    
        // Ejecutar la consulta
        $servicio = Servicio::SQL($consulta);
    
        if (empty($servicio)) {
            echo json_encode(['success' => false, 'message' => 'Servicio no encontrado.']);
            return;
        }
    
        echo json_encode(['success' => true, 'servicio' => $servicio[0]]);
    }
    
    public static function guardarServicioEnSesion() {
        session_start();
        $data = json_decode(file_get_contents("php://input"), true);
        if (isset($data['servicioId'])) {
            $_SESSION['servicioId'] = $data['servicioId']; // Guardar el servicioId en la sesión
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Servicio ID no proporcionado']);
        }
    }
    


    
    public static function obtenerDetallesCitaDeSesion() {
        session_start();
        $citaId = $_SESSION['citaId'] ?? null;
        $usuarioId = $_SESSION['id'] ?? null;
        
        if (!$usuarioId || !$citaId) {
            echo json_encode(['success' => false, 'message' => 'Usuario no autenticado o ID de cita no especificado.']);
            return;
        }
    
        // Escapar los valores para prevenir inyección SQL
        $citaId = intval($citaId); // Asegúrate de que sea un entero
        $usuarioId = intval($usuarioId); // Asegúrate de que sea un entero
    
        // Construir la consulta SQL directamente
        $consulta = "SELECT citas.id AS citaId, citas.fecha, citas.hora, servicios.nombre AS servicioNombre, servicios.id as servicioId
                     FROM citas 
                     LEFT JOIN citasServicios ON citasServicios.citaId = citas.id 
                     LEFT JOIN servicios ON servicios.id = citasServicios.servicioId 
                     WHERE citas.id = $citaId AND citas.usuarioId = $usuarioId";
    
        // Ejecutar la consulta
        $cita = HistorialCita::SQL($consulta);
        
        if (empty($cita)) {
            echo json_encode(['success' => false, 'message' => 'Cita no encontrada.']);
            return;
        }
        
        echo json_encode(['success' => true, 'cita' => $cita[0]]);
    }
    



    public static function guardarUsuario() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener el ID del usuario a actualizar
            $id = $_POST['id'] ?? null;
    
            // Crear una instancia del modelo Usuario con los datos a actualizar
            $usuario = Usuario::find($id);
            $usuario->nombre = $_POST['nombre'] ?? $usuario->nombre;
            $usuario->apellido = $_POST['apellido'] ?? $usuario->apellido;
    
            // Guardar los cambios en la base de datos
            $resultado = $usuario->guardar();
             // Si el guardado fue exitoso, actualizar la sesión
            if ($resultado) {
                $_SESSION['nombre'] = $usuario->nombre;
                $_SESSION['apellido'] = $usuario->apellido;
                // Redirigir a la página de citas
                // header('Location: /cita/index');
                // exit();
            }

    
            // Responder con el resultado y los nuevos datos
            echo json_encode([
                'resultado' => $resultado,
                'nombre' => $usuario->nombre, // Agregar el nuevo nombre
                'apellido' => $usuario->apellido, // Agregar el nuevo apellido
                'mensaje' => 'Usuario actualizado correctamente'
            ]);
        }
    }

    public static function actualizarcita() {
        // Asegurarse de que la respuesta siempre sea JSON
        header('Content-Type: application/json');
    
        // Obtener los datos de la solicitud
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
    
        // Verificar si los datos de citaId y usuarioId están presentes
        if (isset($data['citaid']) && !empty($data['citaid'])) {
            $citaId = intval($data['citaid']);
        } else {
            echo json_encode(['resultado' => false, 'error' => 'Cita ID no proporcionado']);
            return;
        }
    
        // Si el usuarioId se está pasando desde el frontend, no hace falta obtenerlo de la sesión
        if (isset($data['usuarioId']) && !empty($data['usuarioId'])) {
            $usuarioId = intval($data['usuarioId']);
        } else {
            echo json_encode(['resultado' => false, 'error' => 'Usuario ID no proporcionado']);
            return;
        }
    
        // Obtener la cita actual
        $cita = Cita::findByCitaAndUsuario($citaId, $usuarioId);
    
        if ($cita) {
            // Guardar la fecha anterior antes de sincronizar los nuevos datos
            $fechaAntigua = $cita->fecha;
    
            // Verificar que se recibieron los datos de fecha y hora
            if (isset($data['fecha']) && isset($data['hora'])) {
                $cita->fecha = $data['fecha']; // Actualizar la fecha
                $cita->hora = $data['hora'];   // Actualizar la hora
    
                $resultado = $cita->actualizar();
    
                if ($resultado) {
                    // Obtener información del usuario
                    $usuario = Usuario::find($usuarioId);
    
                    // Preparar y enviar el correo
                    if ($usuario) {
                        $email = new Email($usuario->email, $usuario->nombre);
                        $email->enviarAvisoCambioFecha(
                            $usuarioId,
                            $usuario->apellido,
                            $usuario->nombre,
                            $fechaAntigua,
                            $cita->fecha,
                            $cita->hora // Nueva hora
                        );
                    }
    
                    echo json_encode(['resultado' => true]);
                } else {
                    echo json_encode(['resultado' => false, 'error' => 'Error al actualizar la cita']);
                }
            } else {
                echo json_encode(['resultado' => false, 'error' => 'No se recibieron datos de fecha o hora']);
            }
        } else {
            echo json_encode(['resultado' => false, 'error' => 'Cita no encontrada']);
        }
    }


    
    
    public static function actualizarServicioEditable() {
        session_start();
    header('Content-Type: application/json'); // Forzar el tipo de contenido a JSON
        ob_start(); // Captura toda la salida no deseada
        
        $usuarioId = intval($_SESSION['id'] ?? 0);
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        $citaId = intval($data['citaId'] ?? 0);
        // Verificar que los datos contengan servicioIdAntiguo y servicioIdNuevo
        if ($data && isset($data['servicioIdAntiguo']) && isset($data['servicioIdNuevo'])) {
            $citaServicio = CitaServicio::findByCitaAndServicio($citaId, $data['servicioIdAntiguo']);
    
            if ($citaServicio) {
                $citaServicio->servicioId = $data['servicioIdNuevo'];
                $resultado = $citaServicio->actualizar();
    
                if ($resultado) {
                    $usuario = Usuario::find($usuarioId);
                    $servicioAntiguoNombre = Servicio::obtenerNombrePorId($data['servicioIdAntiguo']);
                    $servicioNuevoNombre = Servicio::obtenerNombrePorId($data['servicioIdNuevo']);
    
                    if ($usuario && $servicioAntiguoNombre && $servicioNuevoNombre) {
                        $email = new Email($usuario->email, $usuario->nombre);
                        $email->enviarAvisoServicio(
                            $usuarioId,
                            $usuario->nombre,
                            $usuario->apellido,
                            $servicioAntiguoNombre,
                            $servicioNuevoNombre
                        );
                    }
    
                    ob_end_clean();
                    echo json_encode(['resultado' => true]);
                    return;
                } else {
                    ob_end_clean();
                    echo json_encode(['resultado' => false, 'error' => 'Error al actualizar el servicio']);
                    return;
                }
            } else {
                ob_end_clean();
                echo json_encode(['resultado' => false, 'error' => 'Servicio antiguo no encontrado para esta cita']);
                return;
            }
        } else {
            ob_end_clean();
            echo json_encode(['resultado' => false, 'error' => 'Datos no válidos']);
            return;
        }
    }
    
    
// APIController.php
// APIController.php
public static function anularServicio() {
    session_start();
    $usuarioId = intval($_SESSION['id'] ?? 0);
    // Verificamos que la solicitud sea POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obtenemos los datos del cuerpo de la solicitud
        $data = json_decode(file_get_contents("php://input"), true);

        // Verificamos que servicioId y citaId estén presentes
        if (isset($data['servicioId'], $data['citaId']) && !empty($data['servicioId']) && !empty($data['citaId'])) {
            $servicioId = $data['servicioId'];
            $citaId = $data['citaId']; // Ahora obtenemos citaId desde la solicitud

            // Buscamos la relación en la tabla citasServicios
            $citaServicio = CitaServicio::findByCitaAndServicio($citaId, $servicioId);

            if ($citaServicio) {
                 
                // $usuario = Usuario::find($usuarioId);
                // $email = new Email($usuario->nombre,$usuario->apellido);
                // $email -> ServicioAnulado(
                //     $usuarioId,
                //     $usuario->nombre,
                //     $usuario->apellido
                // );

                // Si la relación existe, la eliminamos
                if ($citaServicio->eliminar()) {
                   


                    // Si la eliminación fue exitosa, respondemos con éxito
                    echo json_encode(['success' => true]);
                } else {
                    // Si hubo un error al eliminar la relación
                    echo json_encode(['success' => false, 'message' => 'Error al eliminar la relación']);
                }
            } else {
                // Si no se encuentra la relación en citasServicios
                echo json_encode(['success' => false, 'message' => 'Relación no encontrada']);
            }
        } else {
            // Si no se enviaron servicioId o citaId
            echo json_encode(['success' => false, 'message' => 'Faltan datos en la solicitud']);
        }
    } else {
        // Si la solicitud no es POST
        echo json_encode(['success' => false, 'message' => 'Método no permitido']);
    }
}

public static function anularTurnoCompleto() {
    session_start();
    $usuarioId = intval($_SESSION['id'] ?? 0);

    // Verificamos que la solicitud sea POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obtenemos los datos del cuerpo de la solicitud
        $data = json_decode(file_get_contents("php://input"), true);

        // Verificamos que citaId esté presente
        if (isset($data['citaId']) && !empty($data['citaId'])) {
            $citaId = $data['citaId']; // Obtener citaId desde la solicitud

            // Buscar la cita por ID
            $cita = Cita::find($citaId);

            if ($cita) {
                // Cambiar el estado de la cita a 2 (anulada)
                $cita->estado = 2; // Establecemos el nuevo estado directamente

                // Asignar 0 a duracionTotal
                $cita->duracionTotal = 0;

                // Obtener el usuario para enviar el correo
                $usuario = Usuario::find($usuarioId);
                $email = new Email($usuario->nombre, $usuario->apellido);
                $email->TurnoAnulado($usuarioId, $usuario->nombre, $usuario->apellido);

                // Enviar el correo notificando la cancelación
                $email->TurnoAnulado($usuarioId, $usuario->nombre, $usuario->apellido);

                // Usamos el método actualizar() para guardar el cambio
                if ($cita->actualizar()) {
                    echo json_encode(['success' => true, 'message' => 'El turno ha sido anulado correctamente.']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error al actualizar el estado de la cita']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Cita no encontrada']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Faltan datos en la solicitud']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Método no permitido']);
    }
}



public static function AgregarServicio() {
    session_start();
    header('Content-Type: application/json'); // Forzar el tipo de contenido a JSON
    ob_start(); // Captura toda la salida no deseada

    $usuarioId = intval($_SESSION['id'] ?? 0);
    $data = json_decode(file_get_contents("php://input"), true);

    // Verificar si el usuario está autenticado
    if (!$usuarioId) {
        echo json_encode(['resultado' => false, 'error' => 'Usuario no autenticado']);
        return;
    }

    // Obtener los IDs de los servicios que se desean agregar a la cita
    $serviciosIds = $data['serviciosIds'] ?? [];
    $citaId = intval($data['citaId'] ?? 0);

    // Verificar que la cita y los servicios existen
    if ($citaId <= 0 || empty($serviciosIds)) {
        echo json_encode(['resultado' => false, 'error' => 'Datos de cita o servicios no válidos']);
        return;
    }

    // Comprobar si la cita pertenece al usuario
    $cita = Cita::find($citaId);
    if (!$cita || $cita->usuarioId != $usuarioId) {
        echo json_encode(['resultado' => false, 'error' => 'Cita no encontrada o no pertenece al usuario']);
        return;
    }

    // Agregar los servicios a la cita
    foreach ($serviciosIds as $servicioId) {
        // Comprobar si el servicio existe
        $servicio = Servicio::find($servicioId);
        if ($servicio) {
            // Insertar el servicio en la tabla de unión
            $citaServicio = new CitaServicio();
            $citaServicio->citaId = $citaId;
            $citaServicio->servicioId = $servicioId;
            $citaServicio->guardar(); // Guardar en la base de datos
        } else {
            echo json_encode(['resultado' => false, 'error' => "Servicio con ID $servicioId no encontrado"]);
            return;
        }
    }
    ob_end_clean();
    // Responder con éxito si se agregaron los servicios
    echo json_encode(['resultado' => true, 'mensaje' => 'Servicios agregados a la cita']);
    // Terminar el buffer de salida
}


    
public static function guardar() {
    // Almacena la Cita y devuelve el ID
    $cita = new Cita($_POST);
    $cita->duracionTotal = $_POST['duracionTotal']; // Agregar la duración total aquí
    $resultado = $cita->guardar();

    $id = $resultado['id'];

    // Almacena los Servicios con el ID de la Cita
    $idServicios = explode(",", $_POST['servicios']);
    $nombreServicios = '';
    foreach ($idServicios as $idServicio) {
        $args = [
            'citaId' => $id,
            'servicioId' => $idServicio
        ];
        $citaServicio = new CitaServicio($args);
        $citaServicio->guardar();

        // Obtener el nombre del servicio y agregarlo a la lista
        $servicio = Servicio::find($idServicio);
        $nombreServicios .= $servicio->nombre . ', ';
    }

    $nombreServicios = rtrim($nombreServicios, ', ');

    // Obtener los detalles del usuario
    $usuarioId = $_POST['usuarioId'];
    $usuario = Usuario::find($usuarioId);
    $nombre = $usuario->nombre;
    $apellido = $usuario->apellido;
    $email = $usuario->email;
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];

    // Enviar el correo al cliente
    $emailCliente = new Email($nombre, $email);
    $emailCliente->enviarAvisoCitaCliente(
        $usuarioId,
        $nombre,
        $apellido,
        $fecha,
        $hora,
        $nombreServicios
    );

    // Devolver el resultado
    echo json_encode(['resultado' => $resultado]);
}

    
    public static function eliminar() {
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $cita = Cita::find($id);
            $cita->eliminar();
            header('Location:' . $_SERVER['HTTP_REFERER']);
        }
    }
    public static function PosponerFecha()
    {
        session_start();
        header('Content-Type: application/json'); // Establecer el tipo de contenido a JSON
        ob_start(); // Captura la salida para evitar mostrar algo antes de que se retorne la respuesta
    
        // Obtener los datos enviados en la solicitud
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
    
        // Verificar que los datos requeridos estén presentes
        if (!isset($data['citaid']) || !isset($data['fecha']) || !isset($data['hora']) || !isset($data['observacion']) || !isset($data['email']) || !isset($data['usuarioId'])) {
            echo json_encode(['resultado' => false, 'error' => 'Faltan datos en la solicitud']);
            ob_end_clean();
            return; // Detener la ejecución si faltan datos
        }
    
        // Obtener el ID de la cita desde la solicitud
        $citaId = intval($data['citaid']);
        $usuarioId = intval($data['usuarioId']); // Ahora obtenemos el usuarioId desde el frontend
    
        // Obtener la cita actual usando el ID proporcionado
        $cita = Cita::find($citaId);
    
        if ($cita) {
            // Guardar la fecha antigua antes de actualizar
            $fechaAntigua = $cita->fecha;
    
            // Actualizar la cita con los nuevos datos (fecha, observación, etc.)
            $cita->fecha = $data['fecha']; // Nueva fecha
            $observacion = $data['observacion']; // Observación enviada por el admin
            $cita->hora = $data['hora']; // Nueva hora si aplica
    
            // Guardar la cita actualizada
            $resultado = $cita->actualizar();
    
            if ($resultado) {
                // Aquí usamos el correo recibido desde el frontend
                $emailCliente = $data['email'];  // Correo electrónico del cliente
                $usuario = Usuario::find($usuarioId); // Obtener el usuario actual con el usuarioId pasado desde el frontend
    
                if ($usuario) {
                    // Log para verificar el usuario encontrado
                    error_log("Usuario encontrado: " . $usuario->nombre . " " . $usuario->apellido);
    
                    // Preparar y enviar el correo con la información de la cita
                    $email = new Email($usuario->nombre, $emailCliente);  // Usamos el email del cliente
                    $email->enviarAvisoCambioFechaCliente(
                        $usuario->id,
                        $usuario->nombre,
                        $usuario->apellido,
                        $fechaAntigua, // Fecha anterior
                        $cita->fecha, // Nueva fecha
                        $cita->hora,  // Nueva hora
                        $observacion  // La observación sobre el cambio
                    );
                } else {
                    // Log si no se encuentra el usuario
                    error_log("No se encontró al usuario con ID: " . $usuarioId);
                }
    
                ob_end_clean();
                // Retornar una respuesta positiva al frontend
                echo json_encode(['resultado' => true, 'message' => 'Cita actualizada y correo enviado']);
            } else {
                ob_end_clean();
                echo json_encode(['resultado' => false, 'error' => 'Error al actualizar la cita']);
            }
        } else {
            ob_end_clean();
            echo json_encode(['resultado' => false, 'error' => 'Cita no encontrada']);
        }
    }
    
    


    public static function AnularTurnoAdmin()
    {
        header('Content-Type: application/json'); // Establecer el tipo de contenido a JSON
        ob_start(); // Captura la salida para evitar mostrar algo antes de que se retorne la respuesta
    
        // Obtener los datos enviados en la solicitud
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
    
        // Verificar que los datos requeridos estén presentes
        if (!isset($data['citaid']) || !isset($data['email']) || !isset($data['observacion']) || !isset($data['usuarioId'])) {
            echo json_encode(['resultado' => false, 'error' => 'Faltan datos en la solicitud']);
            ob_end_clean();
            return; // Detener la ejecución si faltan datos
        }
    
        // Obtener los datos de la solicitud
        $citaId = intval($data['citaid']);
        $email = $data['email'];  // Correo electrónico del cliente
        $usuarioId = intval($data['usuarioId']);
        $observacion = $data['observacion'];
    
        // Buscar la cita por ID
        $cita = Cita::find($citaId);
    
        if ($cita) {
            // Cambiar el estado de la cita a 2 (anulada)
            $cita->estado = 2;  // Estado "anulada"
            
            // Actualizar la cita
            $resultado = $cita->actualizar();
    
            if ($resultado) {
                // Si la cita se actualizó correctamente, enviamos el correo al cliente
                $usuario = Usuario::find($usuarioId);  // Obtener el usuario administrador
    
                if ($usuario) {
                    // Crear la instancia del correo
                    $emailCliente = new Email($usuario->nombre, $email);  // Crear email al cliente
                    // Enviar el correo notificando la anulación
                    $emailCliente->enviarAvisoAnulacionCitaCliente(
                        $usuario->id,
                        $usuario->nombre,
                        $usuario->apellido,
                        $cita->fecha,
                        $cita->hora,
                        $observacion
                    );
                }
    
                // Retornar respuesta exitosa
                ob_end_clean();
                echo json_encode(['resultado' => true, 'message' => 'Cita anulada y correo enviado al cliente']);
            } else {
                // Si hubo un error al actualizar la cita
                ob_end_clean();
                echo json_encode(['resultado' => false, 'error' => 'Error al actualizar el estado de la cita']);
            }
        } else {
            // Si no se encontró la cita
            ob_end_clean();
            echo json_encode(['resultado' => false, 'error' => 'Cita no encontrada']);
        }
    }
    
    public static function RealizarCita()
{
    session_start();
    header('Content-Type: application/json'); // Establecer el tipo de contenido a JSON
    ob_start(); // Captura la salida para evitar mostrar algo antes de que se retorne la respuesta

    // Verificar que el ID de la cita esté presente en la solicitud
    if (!isset($_POST['id'])) {
        echo json_encode(['resultado' => false, 'error' => 'Faltan datos en la solicitud']);
        ob_end_clean();
        return; // Detener la ejecución si falta el ID
    }

    // Obtener el ID de la cita desde la solicitud
    $citaId = intval($_POST['id']);

    // Buscar la cita por ID
    $cita = Cita::find($citaId);

    if ($cita) {
        // Cambiar el estado de la cita a 3 (Realizada)
        $cita->estado = 3; // El estado "3" es "Realizada"
        
        // Actualizar la cita en la base de datos
        $resultado = $cita->actualizar();

        if ($resultado) {
            header('Location:' . $_SERVER['HTTP_REFERER']);
        } else {
            ob_end_clean();
            echo json_encode(['resultado' => false, 'error' => 'Error al actualizar el estado de la cita']);
        }
    } else {
        ob_end_clean();
        echo json_encode(['resultado' => false, 'error' => 'Cita no encontrada']);
    }
}



public static function crearPorAdmin()
{
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $fecha = $_POST['fecha']; // Fecha seleccionada
    $hora = $_POST['hora']; // Hora seleccionada
    $servicios = $_POST['servicios']; // Servicios seleccionados
    $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : null; // Si el teléfono se envía, lo asignamos, si no, lo dejamos en null.

    // Validar que los campos requeridos no estén vacíos
    if (empty($nombre) || empty($apellido) || empty($email) || empty($fecha) || empty($hora) || empty($servicios)) {
        // Manejo de errores (mostrar mensaje o redirigir)
        echo "Todos los campos son obligatorios.";
        return;
    }

    // Calcular la duración total de los servicios seleccionados (en minutos)
    $duracionTotal = 0;
    foreach ($servicios as $servicioId) {
        $servicio = Servicio::find($servicioId); // Obtener el servicio
        if ($servicio && isset($servicio->duracion)) {
            $duracionTotal += $servicio->duracion; // Asumimos que 'duracion' está en minutos
        }
    }

    // Si no se ha calculado una duración total, asignar 0
    if ($duracionTotal <= 0) {
        $duracionTotal = 0;
    }

    // Iniciar transacción
    try {
        // 1. Crear el usuario (sin contraseña, con 'confirmado' en 0)
        $usuario = new Usuario();
        $usuario->nombre = $nombre;
        $usuario->apellido = $apellido;
        $usuario->email = $email;
        $usuario->telefono = $telefono; // Asignar el teléfono si se proporciona
        $usuario->confirmado = 0; // Usuario no confirmado
        $usuario->guardar(); // Usamos el método `guardar` para insertar el usuario

        // Obtener el ID del usuario recién creado usando insert_id
        $usuarioId = $usuario->obtenerUltimoId(); // Método que obtiene el último ID insertado
        
        if (empty($usuarioId)) {
            throw new Exception("El ID del usuario no se generó correctamente.");
        }

        // 2. Crear la cita para el usuario
        $cita = new Cita();
        $cita->usuarioId = $usuarioId; // Asociar la cita al usuario recién creado
        $cita->fecha = $fecha; // Establecer la fecha
        $cita->hora = $hora; // Establecer la hora
        $cita->estado = 0; // Estado de la cita (por defecto 0, puedes cambiarlo según tus necesidades)
        $cita->duracionTotal = $duracionTotal; // Asignar la duración total
        $cita->guardar(); // Usamos el método `guardar` para insertar la cita
        
        // Obtener el ID de la cita recién creada
        $citaId = $cita->obtenerUltimoId();

        // 3. Vincular los servicios seleccionados con la cita
        $nombreServicios = ''; // Variable para almacenar los nombres de los servicios
        foreach ($servicios as $servicioId) {
            // Crear la relación entre la cita y el servicio
            $citaServicio = new CitaServicio();
            $citaServicio->citaId = $citaId; // Asociar la cita
            $citaServicio->servicioId = $servicioId; // Asociar el servicio
            $citaServicio->guardar(); // Usamos el método `guardar` para insertar la relación

            // Obtener el nombre del servicio y agregarlo a la lista
            $servicio = Servicio::find($servicioId); // Supongo que tienes un método `find` para obtener el servicio
            $nombreServicios .= $servicio->nombre . ', ';
        }

        // Eliminar la última coma y espacio
        $nombreServicios = rtrim($nombreServicios, ', ');

        // 4. Enviar el correo al cliente
        $emailCliente = new Email($usuario->nombre, $email);  // Crear email al cliente
        $emailCliente->enviarAvisoCitaCliente(
            $usuario->id,
            $usuario->nombre,
            $usuario->apellido,
            $cita->fecha,
            $cita->hora,
            $nombreServicios // Enviar los nombres de los servicios en el correo
        );

        // Redirigir a /admin después de completar la operación
        header("Location: /admin");
        exit(); // Asegura que la ejecución se detenga

    } catch (Exception $e) {
        // En caso de error, deshacer la transacción
        echo "Error: " . $e->getMessage();
    }
}



public static function consultarHorarios()
{
    session_start();

    // Obtener el cuerpo de la solicitud y decodificarlo
    $inputData = json_decode(file_get_contents('php://input'), true);

    if (!isset($inputData['fecha'])) {
        echo json_encode(['error' => 'Fecha no proporcionada']);
        return;
    }

    $fecha = $inputData['fecha'];

    // Asegúrate de que la fecha esté en el formato correcto
    $fecha = date('Y-m-d', strtotime($fecha));  // Ajustar el formato de fecha según sea necesario

    // Consultar las citas con la fecha seleccionada
    $citas = Cita::consultarPorFecha($fecha);

    if (empty($citas)) {
        echo json_encode([]);
        return;
    }

    echo json_encode($citas);
}





}
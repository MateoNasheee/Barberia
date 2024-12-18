<?php
namespace Classes;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class Email{

    public $email;
    public $nombre;
    public $token;

    public function __construct($nombre=null, $email, $token = null){
        $this->email=$email;
        $this->nombre=$nombre;
        $this->token=$token;
    }

    public function enviarConfirmacion(){
        //crear el objeto de email
        $mail=new PHPMailer(true);
        $mail->SMTPDebug=0;
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'] ;
        $mail->SMTPAuth = true;        
        $mail->Username = $_ENV['EMAIL_USER'] ;
        $mail->Password = $_ENV['EMAIL_PASS'] ; 
        $mail->SMTPSecure = 'tls'; // Usa TLS
        $mail->Port = $_ENV['EMAIL_PORT'] ;
        $mail->CharSet = 'UTF-8';
    

        $mail->setFrom('bucicardi05@gmail.com','BarberClub');
        $mail->addAddress($this->email);
        $mail->Subject='Confirma tu Cuenta';
        
        //set html
        $mail->isHTML(TRUE);
        $contenido="<html>";
        $contenido.="<p><strong>Hola ".   $this->nombre. "</strong> Has creado tu cuenta en BarberClub, solo debes confirmarla presionando el siguiente enlace</p>";
        $contenido.="<p>Presiona aqui: <a href=' " . $_ENV['APP_URL'] ."/confirmar-cuenta?token=". $this->token ."'>Confirmar Cuenta</a> </p>";
        $contenido.="<p>Si tu no solicitaste esta cuenta puedes ignorar el mensaje</p>";  
        $contenido.="</html>";

        $mail->Body=$contenido;

        $mail->send();
        // if (!$mail->send()) {
        //     echo 'Error al enviar el correo: ' . $mail->ErrorInfo;
        // } else {
        //     echo 'Correo enviado exitosamente';
        // }
        
    }
    public function enviarInstrucciones(){
        
        $mail=new PHPMailer(true);
        $mail->SMTPDebug=0;
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'] ;
        $mail->SMTPAuth = true;        
        $mail->Username = $_ENV['EMAIL_USER'] ;
        $mail->Password = $_ENV['EMAIL_PASS'] ; 
        $mail->SMTPSecure = 'tls'; // Usa TLS
        $mail->Port       = $_ENV['EMAIL_PORT'] ;
        $mail->CharSet = 'UTF-8';
    

        $mail->setFrom('bucicardi05@gmail.com','BarberClub');
        $mail->addAddress($this->email);
        $mail->Subject='Restablecer Contraseña';


        $contenido="<html>";
        $contenido.="<p><strong>Hola ".   $this->nombre. "</strong> Has solicitado restablecer tu contraseña, sigue el siguiente enlace para hacerlo</p>";
        $contenido.="<p>Presiona aqui: <a href='" . $_ENV['APP_URL'] ."/recuperar?token=". $this->token ."'>Restablecer Contraseña</a> </p>";
        $contenido.="<p>Si tu no solicitaste esta cuenta puedes ignorar el mensaje</p>";  
        $contenido.="</html>";

        $mail->Body=$contenido;

        $mail->send();
    } 



    public function enviarAvisoServicio($usuarioId, $nombre, $apellido, $servicioAntiguoNombre, $servicioNuevoNombre) {
        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'] ;
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['EMAIL_USER'] ; // Correo del administrador
        $mail->Password = $_ENV['EMAIL_PASS'] ; 
        $mail->SMTPSecure = 'tls';
        $mail->Port = $_ENV['EMAIL_PORT'] ;
        $mail->CharSet = 'UTF-8';
    
        // Configuración del remitente y destinatario
        $mail->setFrom('bucicardi05@gmail.com', 'BarberClub');
        $mail->addAddress($_ENV['EMAIL_USER'] ); // Enviar al administrador
    
        // Asunto del correo
        $mail->Subject = 'Notificación de Cambio de Servicio en BarberClub';
    
        // Contenido del mensaje en HTML
        $contenido = "<html>";
        $contenido .= "<p><strong>Notificación de Cambio de Servicio</strong></p>";
        $contenido .= "<p>El cliente <strong>{$nombre} {$apellido}</strong> (ID: {$usuarioId}) ha decidido cambiar su servicio.</p>";
        $contenido .= "<p><strong>Servicio anterior:</strong> {$servicioAntiguoNombre}</p>";
        $contenido .= "<p><strong>Servicio nuevo:</strong> {$servicioNuevoNombre}</p>";
        $contenido .= "<p>Atentamente, BarberClub.</p>";
        $contenido .= "</html>";
    
        // Asignar el contenido al cuerpo del correo
        $mail->Body = $contenido;
        $mail->isHTML(true);
    
        // Enviar el correo
        try {
            $mail->send();
            echo "Correo de aviso enviado al administrador.";
        } catch (Exception $e) {
            echo "Error al enviar el correo: {$mail->ErrorInfo}";
        }
    }

    public function enviarAvisoCambioFecha($usuarioId, $nombre, $apellido, $fechaAntigua, $fechaNueva, $horaNueva) {
        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'] ;
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['EMAIL_USER'] ; // Correo del administrador
        $mail->Password = $_ENV['EMAIL_PASS'] ; 
        $mail->SMTPSecure = 'tls';
        $mail->Port = $_ENV['EMAIL_PORT'] ;
        $mail->CharSet = 'UTF-8';
    
        // Configuración del remitente y destinatario
        $mail->setFrom('bucicardi05@gmail.com', 'BarberClub');
        $mail->addAddress($_ENV['EMAIL_USER'] ); // Enviar al administrador
    
        // Asunto del correo
        $mail->Subject = 'Notificación de Cambio de Fecha en BarberClub';
    
        // Contenido del mensaje en HTML
        $contenido = "<html>";
        $contenido .= "<p><strong>Notificación de Cambio de Fecha de Cita</strong></p>";
        $contenido .= "<p>El cliente <strong>{$nombre} {$apellido}</strong> (ID: {$usuarioId}) ha realizado un cambio en la fecha de su cita.</p>";
        $contenido .= "<p><strong>Fecha anterior:</strong> {$fechaAntigua}</p>";
        $contenido .= "<p><strong>Nueva fecha:</strong> {$fechaNueva} a las {$horaNueva}</p>";
        $contenido .= "<p>Atentamente, BarberClub.</p>";
        $contenido .= "</html>";
    
        // Asignar el contenido al cuerpo del correo
        $mail->Body = $contenido;
        $mail->isHTML(true);
    
        // Enviar el correo
        try {
            $mail->send();
           
        } catch (Exception $e) {
            echo "Error al enviar el correo: {$mail->ErrorInfo}";
        }
    }
    
    public function servicioAnulado($usuarioId, $nombre, $apellido) {
        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'] ;
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['EMAIL_USER'] ; // Correo del administrador
        $mail->Password = $_ENV['EMAIL_PASS'] ; 
        $mail->SMTPSecure = 'tls';
        $mail->Port = $_ENV['EMAIL_PORT'] ;
        $mail->CharSet = 'UTF-8';
    
        // Configuración del remitente y destinatario
        $mail->setFrom('bucicardi05@gmail.com', 'BarberClub');
        $mail->addAddress($_ENV['EMAIL_USER'] ); // Enviar al administrador
    
        // Asunto del correo
        $mail->Subject = 'Notificación de Cambio de Fecha en BarberClub';
    
        // Contenido del mensaje en HTML
        $contenido = "<html>";
        $contenido .= "<p><strong>Notificación de Turno Anulado</strong></p>";
        $contenido .= "<p>El cliente <strong>{$nombre} {$apellido}</strong> (ID: {$usuarioId}) Decidio anular su cita.</p>";
        $contenido .= "<p>Atentamente, BarberClub.</p>";
        $contenido .= "</html>";
    
        // Asignar el contenido al cuerpo del correo
        $mail->Body = $contenido;
        $mail->isHTML(true);
    
        // Enviar el correo
        try {
            $mail->send();
           
        } catch (Exception $e) {
            echo "Error al enviar el correo: {$mail->ErrorInfo}";
        }
    }

    public function turnoAnulado($usuarioId, $nombre, $apellido) {
        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'] ;
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['EMAIL_USER'] ; // Correo del administrador
        $mail->Password = $_ENV['EMAIL_PASS'] ; 
        $mail->SMTPSecure = 'tls';
        $mail->Port = $_ENV['EMAIL_PORT'] ;
        $mail->CharSet = 'UTF-8';
    
        // Configuración del remitente y destinatario
        $mail->setFrom('bucicardi05@gmail.com', 'BarberClub');
        $mail->addAddress($_ENV['EMAIL_USER'] ); // Enviar al administrador
    
        // Asunto del correo
        $mail->Subject = 'Notificación de Turno Anulado en BarberClub';
    
        // Contenido del mensaje en HTML
        $contenido = "<html>";
        $contenido .= "<p><strong>Notificación de Turno Anulado</strong></p>";
        $contenido .= "<p>El cliente <strong>{$nombre} {$apellido}</strong> (ID: {$usuarioId}) ha decidido anular su turno.</p>";
        $contenido .= "<p>Atentamente, BarberClub.</p>";
        $contenido .= "</html>";
    
        // Asignar el contenido al cuerpo del correo
        $mail->Body = $contenido;
        $mail->isHTML(true);
    
        // Enviar el correo
        try {
            $mail->send();
        } catch (Exception $e) {
            echo "Error al enviar el correo: {$mail->ErrorInfo}";
        }
    }


        // Método para enviar el aviso de cambio de fecha al cliente
        public function enviarAvisoCambioFechaCliente($usuarioId, $nombre, $apellido, $fechaAntigua, $fechaNueva, $hora, $observacion) {
            $mail = new PHPMailer(true);
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = $_ENV['EMAIL_HOST'] ;
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['EMAIL_USER'] ; // Correo del administrador
            $mail->Password = $_ENV['EMAIL_PASS'] ; // Contraseña de la cuenta
            $mail->SMTPSecure = 'tls';
            $mail->Port = $_ENV['EMAIL_PORT'] ;
            $mail->CharSet = 'UTF-8';
    
            // Configuración del remitente y destinatario
            $mail->setFrom('bucicardi05@gmail.com', 'BarberClub');
            $mail->addAddress($this->email); // Enviar al correo del cliente
    
            // Asunto del correo
            $mail->Subject = 'Notificación de Cambio en Tu Cita en BarberClub';
    
            // Contenido del mensaje en HTML
            $contenido = "<html>";
            $contenido .= "<p><strong>Estimado/a {$nombre} {$apellido},</strong></p>";
            $contenido .= "<p>Te informamos que tu cita programada en BarberClub ha sido reprogramada.</p>";
            $contenido .= "<p><strong>Fecha Original:</strong> {$fechaAntigua}</p>";
            $contenido .= "<p><strong>Nueva Fecha:</strong> {$fechaNueva}</p>";
            $contenido .= "<p><strong>Hora:</strong> {$hora}</p>";
            $contenido .= "<p><strong>Observación del Administrador:</strong> {$observacion}</p>";
            $contenido .= "<p>Atentamente, BarberClub.</p>";
            $contenido .= "</html>";
    
            // Asignar el contenido al cuerpo del correo
            $mail->Body = $contenido;
            $mail->isHTML(true);
    
            // Enviar el correo
            try {
                $mail->send();
            } catch (Exception $e) {
                echo "Error al enviar el correo: {$mail->ErrorInfo}";
            }
        }
    
        public function enviarAvisoAnulacionCitaCliente($usuarioId, $nombre, $apellido, $fecha, $hora, $observacion) {
            $mail = new PHPMailer(true);
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = $_ENV['EMAIL_HOST'] ;
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['EMAIL_USER'] ; // Correo del administrador
            $mail->Password = $_ENV['EMAIL_PASS'] ; // Contraseña de la cuenta
            $mail->SMTPSecure = 'tls';
            $mail->Port = $_ENV['EMAIL_PORT'] ;
            $mail->CharSet = 'UTF-8';
        
            // Configuración del remitente y destinatario
            $mail->setFrom('bucicardi05@gmail.com', 'BarberClub');
            $mail->addAddress($this->email); // Enviar al correo del cliente
        
            // Asunto del correo
            $mail->Subject = 'Notificación de Anulación de Tu Cita en BarberClub';
        
            // Contenido del mensaje en HTML
            $contenido = "<html>";
            $contenido .= "<p><strong>Estimado/a {$nombre} {$apellido},</strong></p>";
            $contenido .= "<p>Lamentamos informarte que tu cita programada en BarberClub ha sido anulada.</p>";
            $contenido .= "<p><strong>Fecha de Cita:</strong> {$fecha}</p>";
            $contenido .= "<p><strong>Hora de Cita:</strong> {$hora}</p>";
            $contenido .= "<p><strong>Observación del Administrador:</strong> {$observacion}</p>";
            $contenido .= "<p>Si tienes alguna pregunta o deseas reagendar, por favor contáctanos.</p>";
            $contenido .= "<p>Atentamente, BarberClub.</p>";
            $contenido .= "</html>";
        
            // Asignar el contenido al cuerpo del correo
            $mail->Body = $contenido;
            $mail->isHTML(true);
        
            // Enviar el correo
            try {
                $mail->send();
            } catch (Exception $e) {
                echo "Error al enviar el correo: {$mail->ErrorInfo}";
            }
        }

        public function enviarAvisoCitaCliente($usuarioId, $nombre, $apellido, $fecha, $hora, $servicios)
        {
            $mail = new PHPMailer(true);
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = $_ENV['EMAIL_HOST'] ;
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['EMAIL_USER'] ; // Correo del administrador
            $mail->Password = $_ENV['EMAIL_PASS'] ; // Contraseña de la cuenta
            $mail->SMTPSecure = 'tls';
            $mail->Port = $_ENV['EMAIL_PORT'] ;
            $mail->CharSet = 'UTF-8';
        
            // Configuración del remitente y destinatario
            $mail->setFrom('bucicardi05@gmail.com', 'BarberClub');
            $mail->addAddress($this->email); // Enviar al correo del cliente
        
            // Asunto del correo
            $mail->Subject = 'Confirmación de tu Cita en BarberClub';
        
            // Contenido del mensaje en HTML
            $contenido = "<html>";
            $contenido .= "<p><strong>Estimado/a {$nombre} {$apellido},</strong></p>";
            $contenido .= "<p>Te confirmamos que tu cita ha sido registrada exitosamente en BarberClub.</p>";
            $contenido .= "<p><strong>Fecha de Cita:</strong> {$fecha}</p>";
            $contenido .= "<p><strong>Hora de Cita:</strong> {$hora}</p>";
            $contenido .= "<p><strong>Servicios Seleccionados:</strong> {$servicios}</p>";
            $contenido .= "<p>Si tienes alguna pregunta o deseas reagendar, por favor contáctanos.</p>";
            $contenido .= "<p>Atentamente, BarberClub.</p>";
            $contenido .= "</html>";
        
            // Asignar el contenido al cuerpo del correo
            $mail->Body = $contenido;
            $mail->isHTML(true);
        
            // Enviar el correo
            try {
                $mail->send();
            } catch (Exception $e) {
                echo "Error al enviar el correo: {$mail->ErrorInfo}";
            }
        }
        



        public function enviarMensajeContacto($nombre, $correo, $asunto, $mensaje)
        {
            $mail = new PHPMailer(true);
            try {
                // Configuración del servidor SMTP
                $mail->SMTPDebug = 0;
                $mail->isSMTP();
                $mail->Host = $_ENV['EMAIL_HOST'] ;
                $mail->SMTPAuth = true;
                $mail->Username = $_ENV['EMAIL_USER'] ; // Correo del administrador
                $mail->Password = $_ENV['EMAIL_PASS'] ; // Contraseña de la cuenta
                $mail->SMTPSecure = 'tls';
                $mail->Port = $_ENV['EMAIL_PORT'] ;
                $mail->CharSet = 'UTF-8';
        
                // Configuración del remitente y destinatario
                $mail->setFrom($correo, $nombre); // El remitente es el usuario
                $mail->addAddress($_ENV['EMAIL_USER'] , 'Administrador'); // Destinatario del mensaje
        
                // Asunto del correo
                $mail->Subject = "Nuevo mensaje de contacto: {$asunto}";
        
                // Contenido del mensaje en HTML
                $contenido = "<html>";
                $contenido .= "<p><strong>Nombre:</strong> {$nombre}</p>";
                $contenido .= "<p><strong>Correo:</strong> {$correo}</p>";
                $contenido .= "<p><strong>Asunto:</strong> {$asunto}</p>";
                $contenido .= "<p><strong>Mensaje:</strong></p>";
                $contenido .= "<p>{$mensaje}</p>";
                $contenido .= "</html>";
        
                // Asignar el contenido al cuerpo del correo
                $mail->Body = $contenido;
                $mail->isHTML(true);
        
                // Enviar el correo
                $mail->send();
            } catch (Exception $e) {
                echo "Error al enviar el correo: {$mail->ErrorInfo}";
            }
        }
        
        public function enviarConfirmacionSuscripcion($correo)
        {
            $mail = new PHPMailer(true);
            try {
                // Configuración del servidor SMTP
                $mail->SMTPDebug = 0;
                $mail->isSMTP();
                $mail->Host = $_ENV['EMAIL_HOST'] ;
                $mail->SMTPAuth = true;
                $mail->Username = $_ENV['EMAIL_USER'] ; // Correo del administrador
                $mail->Password = $_ENV['EMAIL_PASS'] ; // Contraseña de la cuenta
                $mail->SMTPSecure = 'tls';
                $mail->Port = $_ENV['EMAIL_PORT'] ;
                $mail->CharSet = 'UTF-8';
        
                // Configuración del remitente y destinatario
                $mail->setFrom('noreply@barberia.com', 'Barberia'); // El remitente puede ser un correo genérico
                $mail->addAddress($correo); // El destinatario es el correo del usuario
        
                // Asunto del correo
                $mail->Subject = "¡Gracias por suscribirte!";
        
                // Contenido del mensaje en HTML
                $contenido = "<html>";
                $contenido .= "<p>¡Gracias por suscribirte!</p>";
                $contenido .= "<p>Te mantendremos informado sobre nuestras últimas novedades.</p>";
                $contenido .= "</html>";
        
                // Asignar el contenido al cuerpo del correo
                $mail->Body = $contenido;
                $mail->isHTML(true);
        
                // Enviar el correo
                $mail->send();
            } catch (Exception $e) {
                echo "Error al enviar el correo: {$mail->ErrorInfo}";
            }
        }
        


}
    
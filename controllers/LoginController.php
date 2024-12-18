<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController {
    public static function login(Router $router) {
        $alertas = [];
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);
    
            $alertas = $auth->validarLogin();
    
            if (empty($alertas)) {
                // Comprobar que exista el usuario
                $usuario = Usuario::where('email', $auth->email);
    
                if ($usuario) {
                    // Verificar el password
                    if ($usuario->comprobarPasswordAndVerificado($auth->password)) {
                        if (isset($_POST['mantener_sesion']) && $_POST['mantener_sesion'] === 'on') {
                            // Ajustar duración de sesión a un tiempo prolongado (por ejemplo, 30 días)
                            ini_set('session.cookie_lifetime', 60 * 60 * 24 * 30);
                        }
                        // Autenticar el usuario
                        session_start();
                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = trim($usuario->nombre);
                        $_SESSION['apellido'] = trim($usuario->apellido);
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;
    
                        // Redireccionamiento
                        if ((int)$usuario->admin === 1) {
                            $_SESSION['admin'] = $usuario->admin ?? null;
                            header('Location: /admin');
                            exit;
                        } else {
                            unset($_SESSION['admin']); // Elimina 'admin' si no es administrador
                            header('Location: /cita');
                            exit;
                        }
                    } else {
                        Usuario::setAlerta('error', 'Contraseña incorrecta');
                        header('Location: /login'); // Redirige a /login en caso de contraseña incorrecta
                        exit;
                    }
                } else {
                    // Usuario no encontrado
                    Usuario::setAlerta('error', 'Usuario no encontrado');
                    header('Location: /login'); // Redirige a /login en caso de usuario inexistente
                    exit;
                }
            }
        }
    
        $alertas = Usuario::getAlertas();
    
        $router->render('auth/login', [
            'alertas' => $alertas,
            'nombre' => $_SESSION['nombre'] ?? '',   // Asegúrate de pasar el nombre
            'apellido' => $_SESSION['apellido'] ?? '',
            'id' => $_SESSION['id'] ?? null
        ]);
    }
    

    public static function logout() {
        session_start();
        $_SESSION = [];
        header('Location: /');
    }

    public static function olvide(Router $router) {

        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);
            $alertas = $auth->validarEmail();

            if(empty($alertas)) {
                 $usuario = Usuario::where('email', $auth->email);

                 if($usuario && $usuario->confirmado === "1") {
                        
                    // Generar un token
                    $usuario->crearToken();
                    $usuario->guardar();

                    //  Enviar el email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarInstrucciones();

                    // Alerta de exito
                    Usuario::setAlerta('exito', 'Revisa tu email');
                 } else {
                     Usuario::setAlerta('error', 'El Usuario no existe o no esta confirmado');
                     
                 }
            } 
        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/olvide-password', [
            'alertas' => $alertas
        ]);
    }

    public static function recuperar(Router $router) {
        $alertas = [];
        $error = false;

        $token = s($_GET['token']);

        // Buscar usuario por su token
        $usuario = Usuario::where('token', $token);

        if(empty($usuario)) {
            Usuario::setAlerta('error', 'Token No Válido');
            $error = true;
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Leer el nuevo password y guardarlo

            $password = new Usuario($_POST);
            $alertas = $password->validarPassword();

            if(empty($alertas)) {
                $usuario->password = null;

                $usuario->password = $password->password;
                $usuario->hashPassword();
                $usuario->token = null;

                $resultado = $usuario->guardar();
                if($resultado) {
                    header('Location: /');
                }
            }
        }

        $alertas = Usuario::getAlertas();
        $router->render('auth/recuperar-password', [
            'alertas' => $alertas, 
            'error' => $error
        ]);
    }

    



    public static function crear(Router $router) {
        $usuario = new Usuario;
    
        // Alertas vacías
        $alertas = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);
    
            $alertas = $usuario->validarNuevaCuenta();
    
            // Revisar que las alertas estén vacías
            if (empty($alertas)) {
                // Verificar si el usuario ya está registrado
                $resultado = $usuario->existeUsuario();
    
                // Si el resultado tiene filas (el usuario existe)
                if ($resultado->num_rows) {
                    // Si el token es 0, significa que el usuario no está confirmado
                    $usuarioExistente = $resultado->fetch_object();
                    if ($usuarioExistente->token == 0) {
                        // Si el token es 0, se puede crear la cuenta (aunque el email esté registrado)
                        // Proceder con la creación de la cuenta
                        $usuario->hashPassword(); // Hashear el Password
                        $usuario->crearToken(); // Generar el token
                        $email = new Email($usuario->nombre, $usuario->email, $usuario->token);
                        $email->enviarConfirmacion(); // Enviar el correo de confirmación
                        $resultado = $usuario->guardar(); // Guardar el nuevo usuario
    
                        // Si se guardó correctamente, redirigir a la página de mensaje
                        if ($resultado) {
                            header('Location: /mensaje');
                        }
                    } else {
                        // Si el token es diferente de 0, mostrar la alerta de error
                        $alertas = Usuario::getAlertas();
                    }
                } else {
                    // Si no existe, proceder a crear la cuenta normalmente
                    $usuario->hashPassword(); // Hashear el Password
                    $usuario->crearToken(); // Generar el token
                    $email = new Email($usuario->nombre, $usuario->email, $usuario->token);
                    $email->enviarConfirmacion(); // Enviar el correo de confirmación
                    $resultado = $usuario->guardar(); // Guardar el nuevo usuario
    
                    // Si se guardó correctamente, redirigir a la página de mensaje
                    if ($resultado) {
                        header('Location: /mensaje');
                    }
                }
            }
        }
    
        // Renderizar la vista de creación de cuenta
        $router->render('auth/crear-cuenta', [
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }
    

    public static function mensaje(Router $router) {
        $router->render('auth/mensaje');
    }

    public static function confirmar(Router $router) {
        $alertas = [];
        $token = s($_GET['token']);
        $usuario = Usuario::where('token', $token);

        if(empty($usuario)) {
            // Mostrar mensaje de error
            Usuario::setAlerta('error', 'Token No Válido');
        } else {
            // Modificar a usuario confirmado
            $usuario->confirmado = "1";
            $usuario->token = null;
            $usuario->guardar();
            Usuario::setAlerta('exito', 'Cuenta Comprobada Correctamente');
        }
       
        // Obtener alertas
        $alertas = Usuario::getAlertas();

        // Renderizar la vista
        $router->render('auth/confirmar-cuenta', [
            'alertas' => $alertas
        ]);
    }
}
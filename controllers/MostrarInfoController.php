<?php

namespace Controllers;

use Classes\Email;
use Model\MostrarInfo;
use MVC\Router;

class MostrarInfoController {

    public static function index(Router $router) {
        session_start();

        // Verificar si la sesión está activa
        if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
            // Verificar si el usuario es administrador
            if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) {
                // Redirigir a /admin si el usuario es admin
                header('Location: /admin');
                exit;
            } else {
                // Redirigir a /cita si no es admin
                header('Location: /cita');
                exit;
            }
        }

        // Renderizar la página principal si no hay sesión activa
        $router->render('SobreNosotros/sobre-nosotros', []);
    }
}


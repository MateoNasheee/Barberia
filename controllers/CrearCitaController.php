<?php

namespace Controllers;

use Model\Servicio;
use MVC\Router;

class CrearCitaController {
   
   
    public static function index(Router $router) {
       
            session_start();
            isAdmin();
            $servicios = Servicio::all();
            // Renderizar la página principal si no hay sesión activa
            $router->render('CrearCita/index', [
                'servicios' => $servicios
            ]);
         }
        
    

}
<?php

namespace Controllers;

use MVC\Router;

class CitaController {
    public static function index( Router $router ) {
        // session_start() ya se llama en Router.php, no repetir aquí
        
        isAuth();
        
        $router->render('cita/index', [
            'nombre' => $_SESSION['nombre'] ?? 'Usuario',
            'id' => $_SESSION['id'] ?? 0
        ]);
    }
}
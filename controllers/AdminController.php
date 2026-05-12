<?php

namespace Controllers;

use Model\AdminCita;
use MVC\Router;
use includes\funciones;

class AdminController {
    public static function index( Router $router ) {

    isAdmin();
    

    $fecha = $_GET['fecha'] ?? date('Y-m-d');
    $fechaArray = explode('-', $fecha);  // solo para validar con checkdate

if( !checkdate($fechaArray[1], $fechaArray[2], $fechaArray[0]) ) {
    
    header('Location: /404');
}
    

    

        //consultar la bd
        $consulta = "SELECT citas.id, citas.hora, CONCAT( usuarios.nombre, ' ', usuarios.apellido) as cliente, ";
        $consulta .= " usuarios.email, usuarios.telefono, servicios.nombre as servicio, servicios.precio  ";
        $consulta .= " FROM citas  ";
        $consulta .= " LEFT OUTER JOIN usuarios ";
        $consulta .= " ON citas.usuarioId=usuarios.id  ";
        $consulta .= " LEFT OUTER JOIN citasServicios ";
        $consulta .= " ON citasServicios.citaId=citas.id ";
        $consulta .= " LEFT OUTER JOIN servicios ";
        $consulta .= " ON servicios.id=citasServicios.servicioId ";
        $consulta .= " WHERE fecha =  '{$fecha}' ";

        $citas = AdminCita::SQL($consulta);
        $citas = $citas ?? [];

        $router->render('admin/index', [

            'nombre' => $_SESSION['nombre'],
            'citas' => $citas,
            'fecha' => $fecha

        ]);
    }
}
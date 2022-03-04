<?php
namespace Controllers;

use Model\AdminCita;
use MVC\Router;

class AdminController{
    public static function index(Router $router){
        isAdmin();
        $fecha = $_GET['fecha'] ?? date('Y-m-d');
        $fechas = explode('-',$fecha);
        
        if (!checkdate($fechas[1],$fechas[2],$fechas[0])) {
            header('location: 404');
        }
        $consulta = "SELECT citas.id, citas.hora, CONCAT( usuario.nombre, ' ', usuario.apellido) as cliente, ";
        $consulta .= " usuario.email, usuario.telefono, servicios.nombre as servicio, servicios.precio  ";
        $consulta .= " FROM citas  ";
        $consulta .= " LEFT OUTER JOIN usuario ";
        $consulta .= " ON citas.usuarioId=usuario.id  ";
        $consulta .= " LEFT OUTER JOIN citasservicios ";
        $consulta .= " ON citasservicios.citaId=citas.id ";
        $consulta .= " LEFT OUTER JOIN servicios ";
        $consulta .= " ON servicios.id=citasservicios.servicioId ";
        $consulta .= " WHERE fecha = '{$fecha}' ";
        $citas = AdminCita::SQL($consulta);
        $router->render('admin/index',[
            'nombre' => $_SESSION['nombre'],
            'citas' => $citas,
            'fecha' => $fecha
        ]);
    }
}
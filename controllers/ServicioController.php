<?php
namespace Controllers;

use Model\Cita;
use Model\Servicio;
use MVC\Router;

class ServicioController{
    public static function index(Router $router){
        isAdmin();
        $servicios = Servicio::all();
        $router->render('servicios/index',[
            'servicios' => $servicios,
            'nombre' => $_SESSION['nombre']
        ]);
    }
    public static function crear(Router $router){
        isAdmin();
        $servicio = new Servicio;
        $alertas = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $servicio->sincronizar($_POST);
            $alertas = $servicio->validar();
            if (empty($alerta)) {
                $servicio->guardar();
                header('location: /servicios');
            }
        }
        $router->render('servicios/crear',[
            'nombre' => $_SESSION['nombre'],
            'servicio' => $servicio,
            'alertas' => $alertas
        ]);
    }
    public static function actualizar(Router $router){
        isAdmin();
        $alertas=[];
        if(!is_numeric($_GET['id'])) return;
        $servicio = Servicio::find($_GET['id']);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $servicio->sincronizar($_POST);
            $alertas = $servicio->validar(); 
            if (empty($alertas)) {
                $servicio->guardar();
                header('location: /servicios');
            }
        }
        $router->render('servicios/actualizar',[
            'nombre' => $_SESSION['nombre'],
            'servicio' => $servicio,
            'alertas' =>$alertas
        ]);
    }
    public static function eliminar(){
        isAdmin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
           $servicio = Servicio::find($_POST['id']);
            $servicio->eliminar();
            header('location: /servicios');
        }
    }
}
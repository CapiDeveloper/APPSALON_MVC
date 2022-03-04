<?php
namespace Controllers;

use Model\AdminCita;
use Model\Cita;
use Model\CitaServicios;
use Model\Servicio;
use MVC\Router;

class ApiController{
    public static function index(){
        $servicios = Servicio::all();
        echo json_encode($servicios);
    }
    public static function guardar(){

        //Almacena la cita y devuelve el id
        $cita = new Cita($_POST);
        $respuesta = $cita->guardar();
        $id = $respuesta['id'];
        //Almacena los servicios con id de la cita
        $idServicios = explode(",",$_POST['servicioId']); //convertimos de cadena a arreglo

        foreach($idServicios as $idServicio){
            $args=[
                'servicioId' => $idServicio,
                'citaId' => $id
            ];
            $citaServicios = new CitaServicios($args);
            $citaServicios->guardar();
        };
        //Retornamos una respuesta para que la condicion que esta en js se cumpla,
        //esto porque $respuesta tiene una llave que contiene un boolen para saber
        //si se ha ingresado a la BD los datos
        echo json_encode($respuesta);
    }
    public static function eliminar(){
        if($_SERVER["REQUEST_METHOD"] === 'POST'){
            $id = $_POST['id'];
            $cita =  Cita::find($id);
            $cita->eliminar();
            header('location:'. $_SERVER['HTTP_REFERER']);
        }
    }
}
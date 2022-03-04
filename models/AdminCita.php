<?php
namespace Model;

class AdminCita extends ActiveRecord{
    protected static $tabla = 'citasservicios';
    protected static $columnasDB = ['id','hora', 'cliente','email', 'telefono', 'servicio','precio'];
    public $id;
    public $hora;
    public $cliente;
    public $email;
    public $telefono;
    public $servicio;
    public $precio;
    public function __construct($args = [])
    {
        $this->id = $args[''] ?? null;
        $this->hora = $args[''] ?? '';
        $this->cliente = $args[''] ?? '';
        $this->email = $args[''] ?? '';
        $this->telefono = $args[''] ?? '';
        $this->servicio = $args[''] ?? '';
        $this->precio = $args[''] ?? '';
    }
}
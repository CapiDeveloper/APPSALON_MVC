<?php

namespace Model;
class Usuario extends ActiveRecord{
    //base de datos
    protected static $tabla = 'usuario';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'email', 'password', 'telefono', 'admin', 
                                    'confirmado', 'token'];

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;

    public function __construct($args =[])
    {
        $this->id = $args['id'] ?? NULL;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->admin = $args['admin'] ?? '0';
        $this->confirmado = $args['confirmado'] ?? '0';
        $this->token = $args['token'] ?? '';
    }
    //Mensajes de validacion para la creacion de una cuenta
    public function validarNuevaCuenta()
    {
        if(!$this->nombre){
            Usuario::$alertas['error'][] = 'El nombre es obligatorio';
        }
        if(!$this->apellido){
            Usuario::$alertas['error'][] = 'El apellido es obligatorio';
        }
        if(!$this->email){
            Usuario::$alertas['error'][] = 'El email es obligatorio';
        }
        if(strlen($this->password) < 6){
            Usuario::$alertas['error'][] = 'El password debe contener almenos 6 caracteres';
        }
        if(!$this->telefono){
            Usuario::$alertas['error'][] = 'El telefono es obligatorio';
        }
        return self::$alertas;
    }
    //Revisa si el usuario ya existe
    public function existeUsuario(){
        $query = "SELECT * FROM " .self::$tabla." WHERE email = '".$this->email."' LIMIT 1"; 
        $resultado = self::$db->query($query);
        if($resultado->num_rows){
            Usuario::$alertas['error'][]="El usuario ya esta registrado";
        }
        return $resultado;
    }
    public function hashPassword(){
        $this->password = password_hash($this->password,PASSWORD_BCRYPT);
    }
    public function crearToken(){
        $this->token = uniqid(); //funcion que ayuda a crear un unico codigo de 13 digitos
    }
    public function validarLogin(){
        //revision email
        if (!$this->email) {
            self::$alertas['error'][]='El email es obligatorio';
        }
        //Revision password
        if(!$this->password){
            self::$alertas['error'][]='El password es obligatorio';
        }
        return self::getAlertas();
    }
    public function validarEmail(){
        if(!$this->email){
            self::$alertas['error'][]='El email es obligatorio';
        }
    }
    public function comprobarPasswordAndVerificado($password){
        $resultado = password_verify($password,$this->password);
        if(!$this->confirmado || !$resultado){
            self::$alertas['error'][]='La contraseña es incorrecta o no esta confirmada tu cuneta';
        }else{
            return true;
        }
    }
    public function validarPassword(){
        if(!$this->password){
            self::$alertas['error'][]='El password es obligatorio';
        }
        if(strlen($this->password < 6)){
            self::$alertas['error'][]='El password debe tener almenos 6 caracteres';
        }
        return self::$alertas;
    }
}
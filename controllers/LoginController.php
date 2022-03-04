<?php
namespace Controllers;

use Classes\Email;
use MVC\Router;
use Model\Usuario;

class loginController{
    public static function login(Router $router){
        $alertas=[];
        $auth = new Usuario;
        if($_SERVER["REQUEST_METHOD"] === 'POST'){

            $auth = new Usuario($_POST);
            $alertas = $auth->validarLogin();

            if (empty($alertas)) {
                //Comprobar que el usuario exista 
                $usuario = Usuario::where('email',$auth->email);                
                // debuguear($usuario);
                if($usuario){
                    //verificar password
                    if($usuario->comprobarPasswordAndVerificado($auth->password)){
                        // Autenticar usuario
                        session_start();
                        $_SESSION['id']= $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre . " ". $usuario->apellido;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;
                        //Redireccionamiento
                        if ($usuario->admin === '1' ) {
                            $_SESSION['admin'] = $usuario->admin ?? NULL;
                            header('location: /admin');
                            
                        }else{
                            
                            header('location: /cita');
                        }
                    }
                    
                }else{
                    Usuario::setAlerta('error','Usuario no encontrado');
                }
            }
        }
        $alertas = Usuario::getAlertas();
        $router->render('auth/login',[
            'alertas' =>$alertas,
            'auth' =>$auth
        ]);
    }
    public static function logout(Router $router){
        debuguear($_SERVER);
        session_start();
        $_SESSION=[];
        header('location: /');
    }
    public static function olvide(Router $router){
        $auth = new Usuario;
        $alertas=[];
        if($_SERVER["REQUEST_METHOD"] === 'POST'){
            $auth = new Usuario($_POST);
            $alertas = $auth->validarEmail();
            if(empty($alertas)){
               $usuario = $auth->where('email',$auth->email);
               if ($usuario && $usuario->confirmado === '1') {
                   $usuario->crearToken();
                   $usuario->guardar();

                   //Enviar email
                   $email = new Email($usuario->nombre,$usuario->email,$usuario->token);
                   $email->enviarInstrucciones();
                   //Alerta exito
                   Usuario::setAlerta('exito','Revise su email para recibir indicaciones');
               }else{
                    Usuario::setAlerta('error','El usuario no existe o no esta confimado'); 
                }
            }
        }
        $alertas = Usuario::getAlertas();
        $router->render('auth/olvide-password',[
            'alertas' => $alertas
        ]);
    }
    public static function recuperar(Router $router){
        $alertas = [];
        $error = false;
        $token = s($_GET['token']);
        $usuario = Usuario::where('token',$token);
        if(empty($usuario)){
            $alertas = Usuario::setAlerta('error','Token no valido');
            $error = true;
        }
        if($_SERVER["REQUEST_METHOD"] === 'POST'){
            //Leer el nuevo password y guardarlo
            $password = new Usuario($_POST);
            $alertas = $password->validarPassword();
            if(empty($alertas)){
                $usuario->password = null;
                $usuario->password = $password->password;
                $usuario->hashPassword();
                $usuario->token = null;
                $resultado = $usuario->guardar();
                if ($resultado) {
                    header('location: /');
                }
            }
        }
        $alertas=Usuario::getAlertas();
        $router->render('auth/recuperar-password',[
            'alertas' => $alertas,
            'error' => $error
        ]);
    }
    public static function crear(Router $router){
        $usuario = new Usuario;
        $alertas = [];
        if($_SERVER["REQUEST_METHOD"] === 'POST'){
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();
            //Revisar que alertas esten vacias
            if(empty($alertas)){
                //verificar que el usuario no este registrado
                $resultado = $usuario->existeUsuario();
                if ($resultado->num_rows) {
                    $alertas = Usuario::getAlertas();
                } else {
                    // *El usuario no esta registrado*
                    //Hasheamos el password
                    $usuario->hashPassword();
                    //Generar un Token unico
                    $usuario->crearToken();
                    //Ahora vamos a enviar el token al email
                    $email = new Email($usuario->nombre, $usuario->email, $usuario->token);
                    $email->enviarConfirmacion();

                    //Crear el usuario
                    $resultado = $usuario->guardar();
                    if($resultado){
                        header('Location: /mensaje');
                    }
                }
            }
        }
        $router->render('auth/crear-cuenta',[
            'usuario' => $usuario,
            'alertas' =>$alertas
        ]);
    }
    public static function mensaje(Router $router){
        $router->render('auth/mensaje');
    }
    public static function confirmar(Router $router){
        $alertas = [];

        $token = s($_GET['token']);
        $usuario = Usuario::where('token',$token);
        if(empty($usuario)){
            //Mostrar mensaje de error
            Usuario::setAlerta('error','Token no valido');
        }else{
            //Modificar a usuario confirmado
            $usuario->confirmado = '1';
            $usuario->token= NULL;
            $usuario->guardar();
            //mensaje exito
            Usuario::setAlerta('exito','Cuanta comprobada correctamente');
        }
        //Obtener alertas
        $alertas = Usuario::getAlertas();
        
        $router->render('auth/confirmar-cuenta',[
            'alertas' => $alertas
        ]);
    }
}
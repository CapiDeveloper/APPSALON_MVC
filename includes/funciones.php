<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

function esUltimo(string $actual,string $proximo):bool{
    if ($actual !== $proximo) {
        return true;
    }
    return false;
}
//Funcion que revisa si el usuario esta autenticado
function isAuth() : void{
    if (!isset($_SESSION['login'])) { //Si no esta definido $_SERVER['login'] entonces no puede hacer las citas
        header('location:  /');
    }
}
//Funcion revisa si el usuario es el administrador
function isAdmin(){
    if (!isset($_SESSION['admin'])) { //Si no esta definido $_SERVER['login'] entonces no puede hacer las citas
        header('location:  /');
    }
}
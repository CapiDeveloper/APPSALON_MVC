<?php 

require __DIR__ . '/../vendor/autoload.php'; //Carga automaticamente las dependencias que he descargado tuilizando composer
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

require 'funciones.php';
require 'database.php';


// Conectarnos a la base de datos
use Model\ActiveRecord;
ActiveRecord::setDB($db);
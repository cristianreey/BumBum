<?php
namespace controller;

use bd\model\BumBum;
use bd\model\Mensajes;
use bd\model\Usuario;

require_once ("../model/mensajes.php");
require_once ("../model/Usuario.php");

// Comprobamos si la sesión ya está iniciada antes de intentar iniciarla
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['idUsuario'])) {
    $idUsuario = $_SESSION['idUsuario'];
    $idUsuarioRecibe = $_SESSION['idUsuarioImagen'];


    // Nos conectamos a BD
    $pdo = BumBum::conectar();

    // Cargamos los datos de las imagenes
    $Mensajes = Mensajes::getMensajes($pdo, $idUsuario, $idUsuarioRecibe);


} else {
    exit('No se ha iniciado sesión');
}

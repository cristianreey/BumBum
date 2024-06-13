<?php
namespace controller;

use bd\model\BumBum;
use bd\model\Usuario;



require_once ("../model/Usuario.php");


// Comprobamos si la sesión ya está iniciada antes de intentar iniciarla
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['idUsuario'])) {
    $idUsuarioDetalles = $_SESSION['idUsuarioImagen'];

    // Nos conectamos a BD
    $pdo = BumBum::conectar();


    // Cargamos los detalles del usuario
    $datosUsuarioDetalles = Usuario::getDatosUsuarioDetalles($pdo, $idUsuarioDetalles);

    $datosUsuario = Usuario::getDatosUsuario($pdo, $idUsuarioDetalles);

} else {
    exit();
}
<?php
namespace controller;

use bd\model\BumBum;
use bd\model\Usuario;
use bd\model\Imagenes;


require_once ("../model/Usuario.php");
require_once ("../model/Imagenes.php");

// Comprobamos si la sesión ya está iniciada antes de intentar iniciarla
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user'])) {
    // Obtener el usuario de la sesión
    $user = $_SESSION['user'];

    // Nos conectamos a BD
    $pdo = BumBum::conectar();

    // Cargamos los datos de las imagenes
    $datosCliente = Imagenes::getImagenesUsuario($pdo, $user);
} else {
    exit();
}
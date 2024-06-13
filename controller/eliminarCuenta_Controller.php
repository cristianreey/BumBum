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
    // Nos conectamos a BD
    $pdo = BumBum::conectar();

    $idUsuario = $_SESSION['idUsuario'];

    Usuario::eliminarCuenta($pdo, $idUsuario);
    Usuario::eliminarCuentaDetalles($pdo, $idUsuario);

    header("Location: ../view/login_view.php");
} else {
    exit();
}
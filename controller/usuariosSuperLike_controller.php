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
    $idUsuario = $_SESSION['idUsuario'];

    // Nos conectamos a BD
    $pdo = BumBum::conectar();

    // Cargamos los datos de las imagenes
    $totalUsuariosSuperlike = Usuario::contarUsuariosSuperlike($pdo, $idUsuario);

} else {
    exit();
}
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
if (isset($_SESSION['idUsuario'])) {
    $idUsuario = $_SESSION['idUsuarioImagen'];

    $key = 'd4e5f6g7h8i9j0k1l2m3n4o5p6q7r8s9';
    $hashed = Usuario::encrypt($idUsuario, $key);

    // Nos conectamos a BD
    $pdo = BumBum::conectar();

    // Cargamos los datos de las imagenes
    $datosImagenesPerfil = Imagenes::getImagenesUsuarioPerfil($pdo, $idUsuario);


} else {
    exit();
}
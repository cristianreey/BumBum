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
    $idUsuarioPropone = $_SESSION['idUsuario'];
    $idUsuarioAcepta = $_SESSION['idUsuarioImagen'];
    $fechaCita = $_POST['fechaCita'];
    $ubicacionCita = $_POST['ubicacionCita'];

    $key = 'd4e5f6g7h8i9j0k1l2m3n4o5p6q7r8s9';
    $hashed = Usuario::encrypt($idUsuarioAcepta, $key);


    // Nos conectamos a BD
    $pdo = BumBum::conectar();

    // Cargamos los datos de las imagenes
    $insertarCita = Mensajes::InsertarCita($pdo, $idUsuarioPropone, $idUsuarioAcepta, $fechaCita, $ubicacionCita);
    if ($insertarCita == true) {
        // Construimos correctamente la URL con el ID encriptado
        header("Location: ../view/conversacion_view.php?id=" . urlencode($hashed));
        exit(); // Es recomendable usar exit después de una redirección para detener la ejecución del script
    } else {
        echo 'Hubo un error al enviar el mensaje';
    }
} else {
    exit('No se ha iniciado sesión');
}

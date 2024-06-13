<?php
namespace controller;

use bd\model\BumBum;
use bd\model\Mensajes;

require_once ("../model/mensajes.php");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['idUsuario'])) {
    $idUsuarioPropone = $_SESSION['idUsuario'];
    if (isset($_GET['idCita'])) {
        $idCita = $_GET['idCita'];
        $pdo = BumBum::conectar();

        Mensajes::deleteCita($pdo, $idCita);

    }


    // Redirigimos de vuelta a la vista
    header("Location: ../view/citas_view.php");
    exit();
} else {
    exit('No se ha iniciado sesión');
}
?>
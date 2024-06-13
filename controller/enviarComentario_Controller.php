<?php
namespace controller;

use bd\model\BumBum;
use bd\model\Mensajes;

require_once ("../model/mensajes.php");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['idUsuario'])) {
    $idUsuario = $_SESSION['idUsuario'];
    $idCita = $_POST['idCita'];
    $reviewCita = $_POST['comentario'];
    $pdo = BumBum::conectar();

    $result = Mensajes::insertReviewCita($pdo, $idCita, $reviewCita, $idUsuario);

    if ($result == true) {
        Mensajes::deleteCita($pdo, $idCita);
    }
    // Redirigimos de vuelta a la vista
    header("Location: ../view/citas_view.php");
    exit();
} else {
    exit('No se ha iniciado sesión');
}

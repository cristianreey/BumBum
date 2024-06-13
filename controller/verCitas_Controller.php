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
    $fechainicio = $_POST['fecha_inicio'] ?? null;
    $fechafin = $_POST['fecha_fin'] ?? null;

    // Nos conectamos a BD
    $pdo = BumBum::conectar();

    // Si las fechas han sido proporcionadas, hacemos el filtrado
    if ($fechainicio && $fechafin) {
        $datosCitas = Mensajes::getCitas($pdo, $idUsuarioPropone, $fechainicio, $fechafin);
    } else {
        // Obtener todas las citas si no se filtra por fecha
        $datosCitas = Mensajes::getCitasTodas($pdo, $idUsuarioPropone);
    }

    // Guardar citas en la sesión para mostrarlas en la vista
    $_SESSION['datosCitas'] = $datosCitas;

    // Redirigimos de vuelta a la vista
    header("Location: ../view/citas_view.php");
    exit();
} else {
    exit('No se ha iniciado sesión');
}
?>
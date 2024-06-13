<?php

namespace controller;

use bd\model\BumBum;
use bd\model\Usuario;

require_once ("../model/Usuario.php");

// Comprobamos si la sesión ya está iniciada antes de intentar iniciarla
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar si el usuario ha iniciado sesión
if (isset($_SESSION['idUsuario'])) {
    // Obtener el ID de usuario de la sesión
    $idUsuario = $_SESSION['idUsuario'];

    // Nos conectamos a la BD
    $pdo = BumBum::conectar();


    // Verificamos si se ha enviado alguna acción desde el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['accion']) && isset($_POST['idUsuarioRecibe'])) {
        $accion = $_POST['accion'];
        $idUsuarioManda = $idUsuario;
        $idUsuarioRecibe = $_POST['idUsuarioRecibe'];


        // Llamar a la función correspondiente según la acción recibida
        switch ($accion) {
            case 'SuperLike':
                Usuario::insertarUsuarioSuperlike($pdo, $idUsuarioManda, $idUsuarioRecibe);
                break;
            case 'Rechazar':
                Usuario::insertarUsuarioRechazados($pdo, $idUsuarioManda, $idUsuarioRecibe);
                break;
            case 'Bloquear':
                $motivo = $_POST['motivoBloqueo'];
                Usuario::insertarUsuarioBloquear($pdo, $idUsuarioManda, $idUsuarioRecibe, $motivo);
                break;
            default:
                break;
        }

        // Registrar la imagen como vista por el usuario actual
        $_SESSION['vistas'][] = $idUsuarioRecibe;
    }

    // Redirigir de vuelta a la página principal
    header("Location: ../view/home_view.php");
    exit(); // Importante para asegurarse de que el script se detiene después de redirigir
} else {
    // Si el usuario no ha iniciado sesión, puedes manejarlo de alguna manera, como redirigiéndolo a la página de inicio de sesión
    header("Location: ../view/login.php");
    exit();
}

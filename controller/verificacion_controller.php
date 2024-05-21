<?php
namespace controller;

use bd\model\Usuario;

require_once ("../model/Usuario.php");


// Comprobamos si la sesión ya está iniciada antes de intentar iniciarla
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


// Procesar datos del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Recibir datos del formulario
    $codigo_verificacion = $_POST['cod_verificacion'];

    $verificacionExitosa = Usuario::compararCodigoVerificacion($codigo_verificacion);


    if ($verificacionExitosa) {
        // Redirigir al usuario a la pantalla deseada
        header("Location: ../view/home_view.php");
        exit;
    } else {
        // Manejar cualquier otra acción que desees en caso de que el registro falle
        header("Location: ../view/verificacion_view.php?error=true");
        exit;
    }

}

?>
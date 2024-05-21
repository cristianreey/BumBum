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
    $nombre = $_POST['nombre'];
    $apellido1 = $_POST['apellido1'];
    $apellido2 = $_POST['apellido2'];
    $email = $_POST['email'];
    $password = $_POST['contrasena'];
    $fechaNacimiento = $_POST['fechaNacimiento'];
    $telefono = $_POST['telefono'];

    $registroExitoso = Usuario::registrarCliente($nombre, $apellido1, $apellido2, $email, $password, $fechaNacimiento);


    if ($registroExitoso) {
        // Redirigir al usuario a la pantalla deseada
        header("Location: ../view/verificacion_view.php");
        exit; // Importante: asegúrate de salir del script después de la redirección
    } else {
        // Manejar cualquier otra acción que desees en caso de que el registro falle
        echo "Hubo un error al registrar al cliente.";
    }

}

?>
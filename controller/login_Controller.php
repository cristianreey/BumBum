<?php
namespace controller;

use bd\model\Usuario;
use bd\model\BumBum;

require_once ("../model/Usuario.php");


// Comprobamos si la sesión ya está iniciada antes de intentar iniciarla
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verifica si se ha enviado el formulario de inicio de sesión
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtén los datos del formulario
    $email = $_POST['email'];
    $password = $_POST['contrasena'];
    $inciarSesion = Usuario::iniciarSesion($email, $password);

    // Si el inicio de sesión es exitoso, configura la sesión y redirige al usuario
    if ($inciarSesion) {
        // Inicia sesión y redirige al usuario a la página principal
        $_SESSION['usuario'] = $email;

        // Obtén la conexión PDO
        $pdo = BumBum::conectar();

        // Obtén los datos del usuario utilizando la función getDatosUsuario
        $datosUsuario = Usuario::getDatosUsuarioPorEmail($pdo, $email);

        // Verifica si se encontraron datos del usuario
        if ($datosUsuario) {
            // Guarda el ID del usuario en la sesión
            $_SESSION['idUsuario'] = $datosUsuario[0]['idUsuario'];
            $_SESSION['login_time'] = time();
            echo "ID de usuario guardado en la sesión correctamente.";

        } else {
            echo "No se encontraron datos del usuario.";
        }

        header("Location: ../view/home_view.php");
        exit();
    } else {
        // Si el inicio de sesión falla, redirige a la página de inicio de sesión con un parámetro de error
        header("Location: ../view/login_view.php?error=true");

    }
} else {
    exit();
}
?>
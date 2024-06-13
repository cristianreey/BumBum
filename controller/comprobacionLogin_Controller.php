<?php
namespace controller;

use bd\model\Usuario;
use bd\model\BumBum;

require_once ("../model/Usuario.php");

// Comprobamos si la sesión ya está iniciada antes de intentar iniciarla
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Comprobamos si el usuario está logueado
if (!isset($_SESSION['usuario']) && basename($_SERVER['PHP_SELF']) != 'login.php') {
    // Si no está logueado, redirigir al usuario al formulario de inicio de sesión
    header("Location: ../view/login_view.php");
    exit; // Aseguramos que el script se detenga después de redirigir
}



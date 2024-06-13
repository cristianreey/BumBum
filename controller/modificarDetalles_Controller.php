<?php
namespace controller;

use bd\model\BumBum;
use bd\model\Usuario;



require_once ("../model/Usuario.php");


// Comprobamos si la sesión ya está iniciada antes de intentar iniciarla
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['idUsuario'])) {
    // Nos conectamos a BD
    $pdo = BumBum::conectar();
    $idUsuario = $_SESSION['idUsuario'];

    // Recibimos todos los datos enviados por POST
    $provincia = $_POST['provincia'];
    $pais = $_POST['pais'];
    $domicilio = $_POST['domicilio'];
    $codigoPostal = $_POST['codigoPostal'];
    $ciudad = $_POST['ciudad'];
    $colorFavorito = $_POST['colorFavorito'];
    $comidaFavorita = $_POST['comidaFavorita'];
    $deporteFavorito = $_POST['deporteFavorito'];
    $hobbie = $_POST['hobbie'];
    $colorPiel = $_POST['colorPiel'];
    $altura = $_POST['altura'];
    $colorPelo = $_POST['colorPelo'];
    $tatuajes = $_POST['tatuajes'];
    $colorOjos = $_POST['colorOjos'];


    // Cargamos los detalles del usuario
    $datosUsuarioDetalles = Usuario::modificarUsuarioDetalles($pdo, $idUsuario, $provincia, $pais, $domicilio, $codigoPostal, $ciudad, $colorFavorito, $comidaFavorita, $deporteFavorito, $hobbie, $colorPiel, $altura, $colorPelo, $tatuajes, $colorOjos);

    header("Location: ../view/perfil_view.php");
} else {
    exit();
}
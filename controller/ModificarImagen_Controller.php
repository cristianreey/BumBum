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
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES["fileToUpload"])) {
    $pdo = BumBum::conectar();
    $idUsuario = $_SESSION['idUsuario'];
    $target_dir = "../assets/img/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Comprobar si el archivo es una imagen real
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        echo "El archivo es una imagen - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "El archivo no es una imagen.";
        $uploadOk = 0;
    }

    // Limitar el tamaño del archivo (opcional)
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Lo siento, el archivo es demasiado grande.";
        $uploadOk = 0;
    }

    // Permitir ciertos formatos de archivo
    $allowed_formats = ['jpg', 'jpeg', 'png', 'gif', 'avif', 'webp'];
    if (!in_array($imageFileType, $allowed_formats)) {
        echo "Lo siento, solo se permiten archivos JPG, JPEG, PNG , GIF, AVIF Y WEPB.";
        $uploadOk = 0;
    }

    // Comprobar si $uploadOk está establecido a 0 por un error
    if ($uploadOk == 0) {
        echo "Lo siento, tu archivo no fue subido.";
    } else {
        // Crear el directorio si no existe
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }

        // Intentar subir el archivo
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "El archivo " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " ha sido subido.";

            // Guardar la ruta completa del archivo en la base de datos
            $rutaCompleta = $target_file;
            Usuario::ModificarImagen($pdo, $idUsuario, $rutaCompleta);
            header("Location: ../view/perfil_view.php");
        } else {
            echo "Lo siento, hubo un error al subir tu archivo.";
        }
    }
} else {
    echo "Método de solicitud no permitido o archivo no encontrado.";
    exit();
}
?>
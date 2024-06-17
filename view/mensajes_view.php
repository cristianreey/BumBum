<?php
session_start();
//$_SESSION['vistas'] = array();
// Inicializar la variable $pagina_activa con el nombre del archivo actual
include ("../controller/main_Controller.php");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensajes | BumBum</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Moul&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/mensajes.css">
    <link rel="icon" type="image/x-icon" href="../assets/img/LogoBumBum.png">



    <style>

    </style>

</head>

<body>

    <div class="header" id="header">
        <div class="container">
            <img src="../assets/img/logoBumBum.png" alt="Logo" class="img-fluid">
        </div>
    </div>
    <div class="container-center">
        <div class="titulo">
            <h2>MENSAJES</h2>
        </div>

        <?php
        include ("../controller/mensajes_Controller.php");

        if (isset($datosUsuariosSuperlike) && !empty($datosUsuariosSuperlike)) {
            foreach ($datosUsuariosSuperlike as $usuarios) {
                $_SESSION['idUsuarioImagen'] = $usuarios['idUsuarioRecibe'];
                include ("../controller/ImagenesUsuarioMensajes_Controller.php");
                echo '<a href="./conversacion_view.php?id=' . urlencode($hashed) . '"><div class="container_mensajes">';
                echo ' <div class="imagen-container">';
                if (isset($datosImagenesPerfil) && !empty($datosImagenesPerfil)) {
                    foreach ($datosImagenesPerfil as $imagen) {
                        echo '<div class="imagen-perfil-container" style="background-image: url(' . $imagen['url'] . ');"></div>';
                    }
                }

                echo '</div>';

                include ('../controller/usuarioDetalles_Controller.php');
                foreach ($datosUsuario as $usuario) {
                    echo '<div class="nombre">';
                    echo '<p>' . $usuario['nombre'] . '</p>';
                    echo '</div>';
                }
                echo '</div>';
                echo '</div></a>';
            }
        } else {
            echo '<div class="container-p">';
            echo '<p class="parrafo">No hay usuarios con Superlike para enviar mensajes.</p>';
            echo '</div>';
        }

        ?>



        <footer>
            <div class="container-footer">
                <nav class="navbar navbar-expand-lg navbar-dark">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item"><a class="nav-link footer" href="./citas_view.php">CITAS</a></li>
                        <li class="nav-item"><a class="nav-link footer active" href="./mensajes_view.php">MENSAJES</a>
                        </li>
                        <li class="nav-item"><a class="nav-link footer" href="./home_view.php">HOME</a></li>
                        <li class="nav-item"><a class="nav-link footer" href="./perfil_view.php">PERFIL</a></li>
                        <li class="nav-item"><a class="nav-link footer" href="./ajustes_view.php">AJUSTES</a></li>
                    </ul>
                </nav>
            </div>
            <div class="containerMobile">
                <nav class="footerMobile navbar navbar-expand-lg navbar-dark">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item"><a class="nav-link footer" href="./citas_view.php"><i
                                    class="material-icons">calendar_today</i></a></li>
                        <li class="nav-item"><a class="nav-link footer active" href="./mensajes_view.php"><i
                                    class="material-icons">message</i></a></li>
                        <li class="nav-item"><a class="nav-link footer" href="./home_view.php"><i
                                    class="material-icons">home</i></a></li>
                        <li class="nav-item"><a class="nav-link footer" href="./perfil_view.php"><i
                                    class="material-icons">person</i></a></li>
                        <li class="nav-item"><a class="nav-link footer" href="./ajustes_view.php"><i
                                    class="material-icons">settings</i></a></li>
                    </ul>
                </nav>
            </div>

        </footer>

</body>
<script>
    function adjustMarginTop() {
        var header = document.getElementById('header');
        var containerCenter = document.querySelector('.container-center');
        var headerHeight = header.offsetHeight;
        containerCenter.style.marginTop = (headerHeight + 20) + 'px';
    }

    window.addEventListener('resize', adjustMarginTop);
    window.addEventListener('load', adjustMarginTop);
</script>






</html>
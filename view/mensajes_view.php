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
    <title>Home | BumBum</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Moul&display=swap" rel="stylesheet">


    <style>
        body {
            font-family: "Moul", serif;
            margin: 0;
        }


        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #0A203D;
            color: white;
            text-align: center;
            height: 10%;
            font-weight: 400;
            font-size: 20px;
            z-index: 9;
        }

        footer ul {
            gap: 30px;
        }

        .footer {
            color: white !important;

        }

        .nav-link {
            transition: color 0.3s, transform 0.3s;
        }

        .nav-link:hover {
            color: #F2C94C !important;
            transform: scale(1.2);
        }

        .nav-link:hover.active {
            border: 0;
        }

        .active {
            border-bottom: 7px solid;
            padding-bottom: 2px;
        }



        .header {
            position: fixed;
            top: 0;
            width: 100%;
            background-color: #EDEEF6;
            padding: 10px 0;
            height: 15%;
            z-index: 9999;

        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }


        .container img {
            width: 150px;
        }

        .container-center {
            display: flex;
            flex-direction: column;
            justify-content: start;
            height: calc(100% - (15% + 10%));
            margin-top: 10%;
            width: 100%;
        }



        .imagen-container {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            width: 30%;
            margin: 0;

        }


        .button-container {
            position: fixed;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: row;
            bottom: 10%;
            width: 100%;

        }

        .container_mensajes {
            padding: 20px;
            background-color: #f9f9f9;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: row;
            align-items: center;
            margin-bottom: 10px;
        }

        .imagen-container {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            width: 17%;
            margin: 0;
        }

        .imagen-perfil-container {
            width: 100px;
            height: 100px;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            border-radius: 50%;
            border: solid 2px black;
            margin-left: 60px;

        }

        .titulo {
            padding: 10px;
            display: flex;
            justify-content: center;
        }

        a,
        a:hover {
            text-decoration: none;
            color: #0A203D
        }

        a:hover .nombre {
            scale: 1.2;
        }

        .parrafo {
            font-family: "Montserrat Alternates", sans-serif;
            padding: 20px;
        }

        .container-p {
            margin-top: 20px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            font-family: "Montserrat Alternates", sans-serif;
        }
    </style>

</head>

<body>

    <div class="header">
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
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-dark">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item"><a class="nav-link footer" href="./citas_view.php">CITAS</a></li>
                        <li class="nav-item"><a class="nav-link footer active" href="./mensajes_view.php">MENSAJES</a>
                        </li>
                        <li class="nav-item"><a class="nav-link footer " href="./home_view.php">HOME</a></li>
                        <li class="nav-item"><a class="nav-link footer " href="./perfil_view.php">PERFIL</a></li>
                        <li class="nav-item"><a class="nav-link footer" href="./ajustes_view.php">AJUSTES</a></li>
                    </ul>
                </nav>
            </div>
        </footer>

</body>
<script>

</script>






</html>
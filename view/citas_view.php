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

        .container-center {
            padding: 50px;
            font-family: "Montserrat Alternates", sans-serif;
            height: calc(100% - (15% + 10%));
            margin-top: 5%;
            margin-bottom: 5%;
            text-align: justify;
        }

        .titulo {
            text-align: center;
            margin-bottom: 20px;
            font-family: "Moul", sans-serif;

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

        /* Estilos para el formulario de filtrado */


        .container-center form {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            width: 100%;
            gap: 20px;
        }

        .container-center label {
            margin-top: 10px;
        }

        .container-center input[type="date"] {
            padding: 8px;
            margin: 5px 0;
            width: 100%;
            box-sizing: border-box;
        }

        .container-center input[type="submit"] {
            background-color: #0A203D;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .container-center input[type="submit"]:hover {
            background-color: #F2C94C;
        }

        .fechaInicio,
        .fechafin {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .btn {
            background-color: #0A203D;
            color: white;
            padding: 15px 20px;
            border: none;
            cursor: pointer;
            opacity: 0.9;
        }



        .btn:hover {
            opacity: 1;
            color: black;
            background-color: burlywood;
        }

        .material-icons {
            vertical-align: middle;
        }

        .container-citas {
            margin-top: 20px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            font-family: "Montserrat Alternates", sans-serif;
        }

        .container-citas p {
            margin: 10px 0;
            font-size: 16px;
            color: #333;
        }

        .container-citas .cita {
            padding: 15px;
            margin-bottom: 15px;
            border-bottom: 1px solid #ddd;
        }

        .container-citas .cita:last-child {
            border-bottom: none;
        }

        .container-citas .cita-header {
            font-weight: 700;
            margin-bottom: 5px;
            color: #0A203D;
        }

        .container-citas .cita-date {
            font-size: 14px;
            color: #666;
        }

        .container-citas .cita-location {
            font-size: 14px;
            color: #999;
        }

        hr {
            border: solid #999 1px;
        }

        .btn-eliminar {
            background-color: transparent;
            color: #dc3545;
            /* Color del icono */
            border: none;
            cursor: pointer;
            font-size: 24px;
        }

        .btn-eliminar:hover {
            color: #c82333;
            /* Color del icono al pasar el ratón por encima */
        }

        .btn-comentar {

            background-color: transparent;
            color: black;
            /* Color del icono */
            border: none;
            cursor: pointer;
            font-size: 24px;
        }

        .btn-comentar:hover {
            color: #0056b3;
            /* Color del icono al pasar el ratón por encima */
        }

        /* Estilos para el contenedor de comentarios */
        .comentario-container {
            margin-top: 10px;
            display: none;
            /* Por defecto oculto */
        }

        .comentario-container textarea {
            width: 100%;
            height: 100px;
            margin-bottom: 10px;
            resize: none;
            /* Evita que el usuario pueda redimensionar el textarea */
        }

        .comentario-container .btn-enviar-comentario {
            background-color: #0A203D;
            color: white;
            padding: 8px 16px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .comentario-container .btn-enviar-comentario:hover {
            background-color: #F2C94C;
        }


        /* Responsive design */
        @media (max-width: 768px) {
            .container-citas {
                padding: 15px;
            }

            .container-citas p {
                font-size: 14px;
            }

            .container-citas .cita {
                padding: 10px;
            }

            .container-citas .cita-header {
                font-size: 16px;
            }

            .container-citas .cita-date,
            .container-citas .cita-location {
                font-size: 12px;
            }
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
            <h2>ESTAS SON TUS CITAS</h2>
        </div>
        <div>
            <form action="../controller/verCitas_Controller.php" method="POST">
                <div class="fechaInicio">
                    <label for="fecha_inicio">Fecha de inicio:</label>
                    <input type="date" id="fecha_inicio" name="fecha_inicio">
                </div>
                <div class="fechafin">
                    <label for="fecha_fin">Fecha de fin:</label>
                    <input type="date" id="fecha_fin" name="fecha_fin">
                </div>
                <button type="submit" class="btn">
                    <i class="material-icons">search</i>
                </button>
            </form>
        </div>
        <div class="container-citas">
            <?php
            if (isset($_SESSION['datosCitas'])) {
                $datosCitas = $_SESSION['datosCitas'];
                if (!empty($datosCitas)) {
                    foreach ($datosCitas as $citas) {
                        echo '<div class="cita">';
                        echo '<p class="cita-header">' . htmlspecialchars($citas['ubicacionCita']) . '</p>';
                        echo '<p class="cita-date">' . htmlspecialchars($citas['fechaCita']) . '</p>';
                        $_SESSION['idUsuarioImagen'] = $citas['idUsuarioAcepta'];
                        include ('../controller/usuarioDetalles_Controller.php');
                        foreach ($datosUsuario as $usuario) {
                            echo '<p class="cita-location"><b>' . htmlspecialchars($usuario['nombre']) . '</b></p>';
                        }
                        // Botón de eliminar con enlace que pasa el ID de la cita por GET
                        echo '<a href="../controller/deleteCita_Controller.php?idCita=' . urlencode($citas['idCita']) . '" class="btn-eliminar"><i class="material-icons">delete</i></a>';
                        // Botón de comentar para mostrar u ocultar el formulario de comentario
                        echo '<button class="btn-comentar"><i class="material-icons">comment</i></button>';
                        // Contenedor para el formulario de comentario (inicialmente oculto)
                        echo '<div class="comentario-container" style="display: none;">';
                        // Formulario para enviar el comentario
                        echo '<form action="../controller/enviarComentario_Controller.php" method="POST">';
                        echo '<textarea name="comentario" rows="4" cols="50"></textarea><br>';
                        echo '<input type="hidden" name="idCita" value="' . $citas['idCita'] . '">';
                        echo '<button type="submit" class="btn-enviar-comentario">Enviar</button>';
                        echo '</form>';
                        echo '</div>';
                        echo '<hr>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>No hay citas disponibles en el rango de fechas seleccionado.</p>';
                }
                unset($_SESSION['datosCitas']);
            } else {
                echo '<p>Filtra para poder ver tus citas disponibles.</p>';
            }
            ?>
        </div>

    </div>

    <footer>
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link footer active" href="./citas_view.php">CITAS</a></li>
                    <li class="nav-item"><a class="nav-link footer" href="./mensajes_view.php">MENSAJES</a></li>
                    <li class="nav-item"><a class="nav-link footer " href="./home_view.php">HOME</a></li>
                    <li class="nav-item"><a class="nav-link footer " href="./perfil_view.php">PERFIL</a></li>
                    <li class="nav-item"><a class="nav-link footer" href="./ajustes_view.php">AJUSTES</a></li>
                </ul>
            </nav>
        </div>
    </footer>

</body>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Obtener todos los botones de comentario
        var btnComentar = document.querySelectorAll(".btn-comentar");

        // Iterar sobre cada botón
        btnComentar.forEach(function (btn) {
            // Agregar un evento clic a cada botón
            btn.addEventListener("click", function () {
                // Obtener el contenedor de comentarios asociado
                var comentarioContainer = this.parentElement.querySelector(".comentario-container");

                // Alternar la visibilidad del contenedor de comentarios
                if (comentarioContainer.style.display === "none" || comentarioContainer.style.display === "") {
                    comentarioContainer.style.display = "block";
                } else {
                    comentarioContainer.style.display = "none";
                }
            });
        });
    });
</script>



</html>
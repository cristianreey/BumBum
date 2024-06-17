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
    <title>Citas | BumBum</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Moul&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/citas.css">
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
            <h2>ESTAS SON TUS CITAS</h2>
        </div>
        <div class="formulario">
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
        <div class="container-footer">
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
        <div class="containerMobile">
            <nav class="footerMobile navbar navbar-expand-lg navbar-dark">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link footer active" href="./citas_view.php"><i
                                class="material-icons">calendar_today</i></a></li>
                    <li class="nav-item"><a class="nav-link footer" href="./mensajes_view.php"><i
                                class="material-icons">message</i></a></li>
                    <li class="nav-item"><a class="nav-link footer" href="./home_view.php"><i
                                class="material-icons">home</i></a></li>
                    <li class="nav-item"><a class="nav-link footer" href="./perfil_view.php"><i
                                class="material-icons">person</i></a></li>
                    <li class="nav-item"><a class="nav-link footer " href="./ajustes_view.php"><i
                                class="material-icons">settings</i></a></li>
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
    function adjustMarginTop() {
        var header = document.getElementById('header');
        var containerCenter = document.querySelector('.container-center');
        var headerHeight = header.offsetHeight;
        containerCenter.style.marginTop = (headerHeight + 5) + 'px';
    }

    window.addEventListener('resize', adjustMarginTop);
    window.addEventListener('load', adjustMarginTop);
</script>



</html>
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
    <title>Conversación | BumBum</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Moul&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/conversacion.css">
    <link rel="icon" type="image/x-icon" href="../assets/img/LogoBumBum.png">


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


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
        <div class="cabecera-conversacion">
            <?php
            include ("../Controller/desencriptar_Controller.php");
            $_SESSION['idUsuarioImagen'] = $desencriptar;
            include ("../controller/ImagenesUsuarioMensajes_Controller.php");
            ?>

            <div class="container_mensajes" id="container-mensajes">
                <div class="imagen-container">
                    <?php
                    if (isset($datosImagenesPerfil) && !empty($datosImagenesPerfil)) {
                        foreach ($datosImagenesPerfil as $imagen) {
                            echo '<div class="imagen-perfil-container" style="background-image: url(' . $imagen['url'] . ');"></div>';
                        }
                    }
                    ?>
                </div>
                <div class="nombre">
                    <?php
                    include ('../controller/usuarioDetalles_Controller.php');
                    foreach ($datosUsuario as $usuario) {
                        echo '<p>' . $usuario['nombre'] . '</p>';
                    }
                    ?>
                </div>
                <div class="botones">
                    <a href="./mensajes_view.php" class="boton boton-volver" title="Volver">
                        <i class="material-icons">arrow_back</i>
                    </a>
                    <a href="#" class="boton boton-cita" title="Solicitar Cita" data-toggle="modal"
                        data-target="#solicitarCitaModal">
                        <i class="material-icons">event</i>
                    </a>
                </div>
            </div>
        </div>

        <div class="mensajes" id="mensajes">
            <?php
            include ("../controller/verMensajes_Controller.php");


            if (isset($Mensajes) && !empty($Mensajes)) {
                foreach ($Mensajes as $mensaje) {

                    if ($idUsuario == $mensaje['idUsuarioEnvia']) {
                        echo '<div class="mensaje-usuarioEnvia">';
                        echo '<p>' . $mensaje['textMensaje'] . '</p>';
                        echo '</div>';

                    } elseif ($idUsuario == $mensaje['idUsuarioRecibe']) {
                        echo '<div class="mensaje-usuarioRecibe">';
                        echo '<p>' . $mensaje['textMensaje'] . '</p>';
                        echo '</div>';
                    }

                }
            }

            ?>

        </div>
        <div class="button-enviar">
            <form action="../controller/EnviarMensajes_Controller.php" method="POST">
                <input type="text" name="mensaje" placeholder="Escribe tu mensaje aquí" required>
                <button type="submit" class="boton-enviar">
                    <i class="material-icons">send</i>
                </button>
            </form>
        </div>


    </div>
    <div class="modal fade" id="solicitarCitaModal" tabindex="-1" role="dialog"
        aria-labelledby="solicitarCitaModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="solicitarCitaModalLabel">Solicitar Cita</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="solicitarCitaForm" action="../controller/SolicitarCita_Controller.php" method="POST">
                        <div class="form-group">
                            <label for="fechaCita">Fecha de la Cita</label>
                            <input type="date" class="form-control" id="fechaCita" name="fechaCita" required>
                        </div>
                        <div class="form-group">
                            <label for="ubicacionCita">Lugar de la Cita</label>
                            <input type="text" class="form-control" id="ubicacionCita" name="ubicacionCita"
                                placeholder="Buscar ubicación" required>
                            <div id="sugerenciasUbicacion"></div>
                        </div>
                        <button type="submit" class="btn boton-solicitar">Solicitar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer id="footer">
        <div class="container-footer">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const input = document.getElementById('ubicacionCita');
        const sugerenciasUbicacion = document.getElementById('sugerenciasUbicacion');

        input.addEventListener('input', function () {
            const query = input.value;
            if (query.trim() === '') {
                sugerenciasUbicacion.innerHTML = '';
                return;
            }

            const url = `https://api.mapbox.com/geocoding/v5/mapbox.places/${query}.json?access_token=pk.eyJ1IjoiYnVtYnVtNTExIiwiYSI6ImNseDlid3FjcTE0bnMycXB6d2I4ZGs1ZnYifQ.9ZgK5Kkz0JTWzRX6oDXTRw`;

            axios.get(url)
                .then(response => {
                    const places = response.data.features;
                    // Mostrar las sugerencias de ubicaciones
                    const suggestions = places.map(place => `<div class="sugerencia">${place.place_name}</div>`).join('');
                    sugerenciasUbicacion.innerHTML = suggestions;

                    // Agregar evento de clic a cada sugerencia
                    const sugerencias = document.querySelectorAll('.sugerencia');
                    sugerencias.forEach(sugerencia => {
                        sugerencia.addEventListener('click', function () {
                            input.value = sugerencia.innerText;
                            sugerenciasUbicacion.innerHTML = '';
                        });
                    });
                })
                .catch(error => {
                    console.error('Error al buscar la ubicación:', error);
                });
        });
    });
    function adjustMarginTop() {
        var header = document.getElementById('header');
        var containerCenter = document.querySelector('.container-center');
        var headerHeight = header.offsetHeight;
        containerCenter.style.marginTop = headerHeight + 'px';
    }

    window.addEventListener('resize', adjustMarginTop);
    window.addEventListener('load', adjustMarginTop);

    function adjustMarginTopMensajes() {
        var header = document.getElementById('header');
        var containerMensajes = document.getElementById('container-mensajes');
        var containerCenter = document.querySelector('.mensajes');
        var headerHeight = header.offsetHeight;
        var containerMensajesHeight = containerMensajes.offsetHeight;
        containerCenter.style.marginTop = (headerHeight) + 'px';
    }

    window.addEventListener('resize', adjustMarginTopMensajes);
    window.addEventListener('load', adjustMarginTopMensajes);

    function adjustMarginBottomMensajes() {
        var footer = document.getElementById('footer');
        var buttonEnviar = document.querySelector('.button-enviar');
        var containerMensajes = document.querySelector('.mensajes');
        var footerHeight = footer.offsetHeight;
        var buttonEnviarHeight = buttonEnviar.offsetHeight;

        var marginBottom = footerHeight + buttonEnviarHeight;

        // Aplicar el margen inferior al contenedor de mensajes
        containerMensajes.style.marginBottom = marginBottom + 'px';
    }

    window.addEventListener('resize', adjustMarginBottomMensajes);
    window.addEventListener('load', adjustMarginBottomMensajes);

</script>

</html>
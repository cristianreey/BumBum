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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


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
            margin-top: 7%;
            width: 100%;
        }

        .imagen-container {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            width: 30%;
            float: left;
        }

        .nombre {
            overflow: hidden;
            font-size: 20px;
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
            padding: 5px;
            box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: row;
            align-items: center;
            vertical-align: center;
            margin-bottom: 10px;
            position: fixed;
            width: 100%;
            margin-top: 0;
            z-index: 99999;
            background-color: white;
        }

        .imagen-container {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            width: 17%;
            margin: 0;
            float: left;
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

        .button-enviar {
            position: fixed;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: row;
            bottom: 10%;
            width: 100%;
            padding: 2px;
            background-color: white;
        }

        input[type="text"] {
            padding: 10px;
            margin-bottom: 10px;
            width: 500px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: black;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: purple;
        }

        .mensajes {
            display: flex;
            flex-direction: column;
            margin: 10px;
            margin-top: 10%;
            padding-bottom: 10%;
            z-index: 0;
        }

        .mensaje-usuarioEnvia {
            justify-content: center;
            background-color: #0A203D;
            padding: 15px;
            align-items: center;
            color: white;
            border-radius: 20px 20px;
            align-self: flex-end;
            max-width: 70%;
            margin-bottom: 10px;
        }

        .mensaje-usuarioRecibe {
            justify-content: flex-start;
            background-color: #EDEEF6;
            color: black;
            align-items: center;
            border-radius: 20px 20px;
            align-self: flex-start;
            max-width: 70%;
            margin-bottom: 10px;
            padding: 15px;
        }

        p {
            margin-top: 1rem;
        }

        .botones {
            display: flex;
            flex-direction: row;
            gap: 10px;
            position: absolute;
            right: 10px;
        }

        .boton {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px 20px;
            background-color: black;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 16px;
        }


        .boton-volver,
        .boton-cita {
            background-color: black;
        }

        .boton:hover i {
            color: purple;
        }

        .modal {
            position: relative;
            z-index: 9999;
            margin-bottom: 50%;
        }

        #ubicacionCita {
            width: 100%;
        }

        .sugerencia {
            padding: 5px 10px;
            cursor: pointer;
        }

        .sugerencia:hover {
            background-color: antiquewhite;
        }

        .boton-solicitar {
            background-color: black;
            color: white;
        }

        .boton-solicitar:hover {
            background-color: purple;
            color: white;

        }

        .modal {
            position: fixed;
            top: 75%;
            /* Posiciona el modal en el centro verticalmente */
            left: 50%;
            /* Posiciona el modal en el centro horizontalmente */
            transform: translate(-50%, -50%);
            /* Centra el modal exactamente */
            z-index: 99999;
            /* Asegura que el modal esté por encima del resto del contenido */
        }

        .modal-dialog {
            max-width: 90%;
            /* Ajusta el ancho máximo del modal */
        }

        .modal-content {
            border-radius: 20px;
            /* Añade bordes redondeados al modal */
        }

        .modal-header {
            border-bottom: none;
            /* Elimina el borde inferior del encabezado del modal */
        }

        .modal-body {
            padding: 20px;
            /* Añade espacio interno al cuerpo del modal */
        }

        .modal-footer {
            border-top: none;
            /* Elimina el borde superior del pie de página del modal */
        }

        #sugerenciasUbicacion {
            position: absolute;
            z-index: 9999;
            background-color: white;
            border: 1px solid #ccc;
            width: calc(100% - 20px);
            /* Ajusta el ancho de las sugerencias */
            max-height: 200px;
            /* Establece una altura máxima para las sugerencias */
            overflow-y: auto;
            /* Añade desplazamiento vertical si es necesario */
        }

        .sugerencia {
            padding: 10px;
            cursor: pointer;
        }

        .sugerencia:hover {
            background-color: #f0f0f0;
            /* Cambia el color de fondo al pasar el cursor */
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
        <div class="cabecera-conversacion">
            <?php
            include ("../Controller/desencriptar_Controller.php");
            $_SESSION['idUsuarioImagen'] = $desencriptar;
            include ("../controller/ImagenesUsuarioMensajes_Controller.php");
            ?>

            <div class="container_mensajes">
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

        <div class="mensajes">
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
                <input type="submit" value="Enviar">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const input = document.getElementById('ubicacionCita');
        const sugerenciasUbicacion = document.getElementById('sugerenciasUbicacion');

        input.addEventListener('input', function () {
            const query = input.value;
            if (query.trim() === '') {
                sugerenciasUbicacion.innerHTML = ''; // Limpiar sugerencias si el campo está vacío
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
</script>







</html>
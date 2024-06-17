<?php
session_start();
//$_SESSION['vistas'] = array();
// Inicializar la variable $pagina_activa con el nombre del archivo actual
// Verificar si existen cookies con imágenes vistas anteriormente y agregarlas a la sesión si existen

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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" type="image/x-icon" href="../assets/img/LogoBumBum.png">

    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Moul&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/home.css">


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

        <div class="container-body">
            <h4> ¡AQUÍ TIENES TUS RESULTADOS! </h4>
            <h2 class="titulo"><i class="material-icons icon-left">favorite</i> Disfruta en la búsqueda del amor <i
                    class="material-icons icon-right">favorite</i></h2>


            <div class="image-container">
                <?php
                include ('../controller/ImagenesHome_Controller.php');


                if (isset($datosImagenes) && !empty($datosImagenes)) {
                    foreach ($datosImagenes as $index => $imagen) {
                        $idUsuarioImagen = $imagen['idUsuario'];
                        include ('../controller/comprobacionImagenes_Controller.php');

                        // Verificar relaciones
                        if (
                            !$existeSuperlike &&
                            !$existeDenegados &&
                            !$existeBloqueados
                        ) {

                            // Añadir idUsuarioImagen a $_SESSION['vistas']
                            $_SESSION['vistas'][] = $idUsuarioImagen;

                            // También puedes asignar $_SESSION['idUsuarioImagen'] si es necesario
                            $_SESSION['idUsuarioImagen'] = $idUsuarioImagen;

                            include ('../controller/usuarioDetalles_Controller.php');


                            // Si el usuario no ha visto esta imagen, mostrarla y agregar los botones de acción
                            echo '<div class="image-wrapper">';

                            // Icono de información en la esquina superior izquierda
                            echo '<i class="material-icons info-icon" onclick="mostrarDetallesUsuario()">info</i> ';

                            // Contenedor de detalles del usuario
                            echo '<div class="user-details-container" id="userDetailsContainer">';

                            // Iterar sobre los detalles de cada usuario
                            foreach ($datosUsuarioDetalles as $usuarioDetalles) {
                                // Presentar los campos de detalles del usuario
                                echo '<div class="details-container">';
                                // Mostrar el nombre del usuario
                                foreach ($datosUsuario as $usuario) {
                                    echo '<h2>' . $usuario['nombre'] . '</h2>';
                                }
                                // Mostrar los detalles del usuario
                                echo '<div class="detail"><i class="material-icons">location_on</i> Provincia: <span class="detail-value">' . $usuarioDetalles['provincia'] . '</span></div>';
                                echo '<div class="detail"><i class="material-icons">public</i> País: <span class="detail-value">' . $usuarioDetalles['pais'] . '</span></div>';
                                echo '<div class="detail"><i class="material-icons">home</i> Domicilio: <span class="detail-value">' . $usuarioDetalles['domicilio'] . '</span></div>';
                                echo '<div class="detail"><i class="material-icons">local_post_office</i> Código Postal: <span class="detail-value">' . $usuarioDetalles['codigoPostal'] . '</span></div>';
                                echo '<div class="detail"><i class="material-icons">location_city</i> Ciudad: <span class="detail-value">' . $usuarioDetalles['ciudad'] . '</span></div>';
                                echo '<div class="detail"><i class="material-icons">color_lens</i> Color Favorito: <span class="detail-value">' . $usuarioDetalles['colorFavorito'] . '</span></div>';
                                echo '<div class="detail"><i class="material-icons">restaurant</i> Comida Favorita: <span class="detail-value">' . $usuarioDetalles['comidaFavorita'] . '</span></div>';
                                echo '<div class="detail"><i class="material-icons">sports_soccer</i> Deporte Favorito: <span class="detail-value">' . $usuarioDetalles['deporteFavorito'] . '</span></div>';
                                echo '<div class="detail"><i class="material-icons">favorite</i> Hobbie: <span class="detail-value">' . $usuarioDetalles['hobbie'] . '</span></div>';
                                echo '<div class="detail"><i class="material-icons">face</i> Color Piel: <span class="detail-value">' . $usuarioDetalles['colorPiel'] . '</span></div>';
                                echo '<div class="detail"><i class="material-icons">height</i> Altura: <span class="detail-value">' . $usuarioDetalles['altura'] . '</span></div>';
                                echo '<div class="detail"><i class="material-icons">palette</i> Color Pelo: <span class="detail-value">' . $usuarioDetalles['colorPelo'] . '</span></div>';
                                echo '<div class="detail"><i class="material-icons">style</i> Tatuajes: <span class="detail-value">' . $usuarioDetalles['tatuajes'] . '</span></div>';
                                echo '<div class="detail"><i class="material-icons">visibility</i> Color Ojos: <span class="detail-value">' . $usuarioDetalles['colorOjos'] . '</span></div>';

                                echo '</div>';
                            }

                            echo '</div>';

                            echo '<img src="' . $imagen['url'] . '" class="img-fluid">';
                            echo '<div class="button-container">';

                            // Formulario para el botón Superlike
                            echo '<form action="../controller/botones_Controller.php" method="post" onsubmit="superlike(); actionPerformed(); recargarPagina();">';
                            echo '<input type="hidden" name="idUsuarioRecibe" value="' . $imagen['idUsuario'] . '">';
                            echo '<input type="hidden" name="accion" value="SuperLike">';
                            echo '<button type="submit"><i class="material-icons">favorite</i></button>';
                            echo '</form>';

                            //Formulario para el botón de Bloquear
                            echo '<form id="blockForm" action="../controller/botones_Controller.php" method="post" onsubmit="return bloquear(); recargarPagina();">';
                            echo '<input type="hidden" name="idUsuarioRecibe" value="' . $imagen['idUsuario'] . '">';
                            echo '<input type="hidden" name="accion" value="Bloquear">';
                            echo '<button type="submit"><i class="material-icons">block</i></button>';
                            echo '<div id="motivoBloqueo" style="display:none;">';
                            echo '<span class="close-btn" onclick="cerrarMotivoBloqueo()">&times;</span>';
                            echo '<h2>Indica el motivo de bloqueo</h2>';
                            echo '<input type="text" name="motivoBloqueo" placeholder="Motivo de bloqueo">';
                            echo '<button type="submit">Enviar</button>';
                            echo '</div>';
                            echo '</form>';


                            // Formulario para el botón Rechazar
                            echo '<form action="../controller/botones_Controller.php" method="post" onsubmit="rechazar(); actionPerformed(); recargarPagina();">';
                            echo '<input type="hidden" name="idUsuarioRecibe" value="' . $imagen['idUsuario'] . '">';
                            echo '<input type="hidden" name="accion" value="Rechazar">';
                            echo '<button type="submit"><i class="material-icons">close</i></button>';
                            echo '</form>';

                            echo '</div>';
                            echo '</div>';

                            // Detener el bucle después de mostrar la primera imagen disponible
                            break;
                        }
                    }

                }
                ?>
            </div>




        </div>

    </div>

    <footer>
        <div class="container-footer">
            <nav class="navbar navbar-expand-lg navbar-dark">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link footer" href="./citas_view.php">CITAS</a></li>
                    <li class="nav-item"><a class="nav-link footer" href="./mensajes_view.php">MENSAJES</a></li>
                    <li class="nav-item"><a class="nav-link footer active" href="./home_view.php">HOME</a></li>
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
                    <li class="nav-item"><a class="nav-link footer" href="./mensajes_view.php"><i
                                class="material-icons">message</i></a></li>
                    <li class="nav-item"><a class="nav-link footer active" href="./home_view.php"><i
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
    // Función para cambiar el estilo de los checkbox al hacer clic en las etiquetas
    function toggleCheckbox(checkbox) {
        var label = checkbox.parentNode;
        if (checkbox.checked) {
            label.classList.add("checked");
        } else {
            label.classList.remove("checked");
        }
    }

    // Variable global para almacenar el índice de la imagen actual
    var currentIndex = 0;




    function superlike() {
        mostrarSiguienteImagen();

    }

    function bloquear() {
        mostrarSiguienteImagen();

    }

    function rechazar() {
        mostrarSiguienteImagen();

    }

    // Variable global para almacenar el índice de la imagen actual
    var currentIndex = 0;

    // Verificar si se ha realizado alguna acción en la primera imagen
    var actionTaken = false;

    function actionPerformed() {
        actionTaken = true;
    }

    // Función para mostrar la siguiente imagen si se ha realizado una acción en la primera imagen
    function showNextImageIfActionTaken() {
        if (actionTaken) {
            mostrarSiguienteImagen();
        }
    }

    // Función para mostrar la siguiente imagen
    function mostrarSiguienteImagen() {
        // Incrementar el índice para obtener la siguiente imagen
        currentIndex++;

        // Verificar si hemos alcanzado el final de las imágenes
        if (currentIndex >= <?php echo count($datosImagenes); ?>) {
            // Reiniciar el índice si hemos alcanzado el final
            currentIndex = 0;
        }

        // Obtener la siguiente imagen del array de datos
        var nextImage = <?php echo json_encode($datosImagenes); ?>[currentIndex];

        // Actualizar la imagen en el contenedor
        document.querySelector('.image-container img').src = nextImage.url;

    }




    // Llamar a la función para mostrar la siguiente imagen si se ha realizado una acción en la primera imagen
    showNextImageIfActionTaken();

    // Función para mostrar u ocultar los detalles del usuario
    function mostrarDetallesUsuario() {
        var userDetailsContainer = document.getElementById('userDetailsContainer');
        // Alternar la visibilidad del contenedor
        userDetailsContainer.style.display = userDetailsContainer.style.display === 'none' ? 'block' : 'none';
    }



    function bloquear() {
        var motivoBloqueo = document.getElementById("motivoBloqueo");
        if (motivoBloqueo.style.display === "none") {
            motivoBloqueo.style.display = "block";
            return false; // Evitar el envío del formulario antes de ingresar el motivo
        }
        return true;
    }

    function cerrarMotivoBloqueo() {
        document.getElementById("motivoBloqueo").style.display = "none";
    }

    function validateMotivo(event) {
        var motivoBloqueo = document.getElementById("motivoBloqueo").getElementsByTagName("input")[0];
        if (motivoBloqueo.value.trim() === "") {
            alert("Por favor, ingresa un motivo de bloqueo.");
            event.preventDefault();
        }
    }

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
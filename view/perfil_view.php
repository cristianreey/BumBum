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

        .primera-section {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            gap: 30px;
            width: 100%;
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


        .imagen-perfil-container {
            width: 200px;
            height: 200px;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            border-radius: 50%;
            border: solid 2px black;
            margin-left: 60px;

        }


        .container-center {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            height: calc(100% - (15% + 10%));
            margin-top: 10%;
        }

        .numero-usuarios {
            width: 170px;
            height: 90px;
            background-color: #EDEEF6;
            display: flex;
            justify-content: center;
            align-items: center;
            border: solid 3px black;

        }

        .numero-usuarios p {
            font-size: 30px;
            text-align: center;
            margin: 0;

        }

        .segunda-section {
            display: flex;
            flex-direction: column;
            width: 90%;
        }

        .usuarios-superlike,
        .usuarios-bloqueados,
        .usuarios-denegados {
            display: flex;
            flex-direction: column;
            align-items: center;

        }

        .texto {
            text-align: center;
            margin-top: 10px;

        }

        .container-estadisticas {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
            width: 70%;
            margin-right: 80px;
        }

        .imagen-container {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            width: 30%;
            margin: 0;


        }


        .space-10 {
            border: solid 2px #7A7A7A;
            width: 90%;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .titulo {
            display: flex;
            justify-content: center;
            text-align: center;
        }

        .details-container {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 90px;
            background-color: #f9f9f9;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .details-container h2 {
            margin-top: 0;
        }

        .detail {
            margin-bottom: 10px;
            margin-left: 40px;
        }

        .detail i {
            margin-right: 5px;
        }

        .detail-value {
            font-weight: bold;
        }

        .material-icons {
            vertical-align: middle;
        }

        /* Estilo para el botón "Modificar datos" */
        #btnModificarDatos,  #btnInsertarDatos {
            background-color: black;
            /* Color de fondo verde */
            color: white;
            /* Color de texto blanco */
            border: none;
            /* Sin borde */
            padding: 10px 20px;
            /* Espaciado interno */
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 5px;
            /* Bordes redondeados */
        }

        #btnModificarDatos:hover {
            background-color: purple;
        }

        #btnInsertarDatos:hover {
            background-color: purple;
        }

        /* Estilo para el botón "Guardar cambios" */
        .container-datos-modificar button[type="submit"] {
            background-color: black;
            /* Color de fondo azul */
            color: white;
            /* Color de texto blanco */
            border: none;
            /* Sin borde */
            padding: 10px 20px;
            /* Espaciado interno */
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 5px;
            /* Bordes redondeados */
        }

        .container-datos-insertar button[type="submit"] {
            background-color: black;
            /* Color de fondo azul */
            color: white;
            /* Color de texto blanco */
            border: none;
            /* Sin borde */
            padding: 10px 20px;
            /* Espaciado interno */
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 5px;
            /* Bordes redondeados */
        }

        .container-datos-modificar button[type="submit"]:hover {
            background-color: purple;
        }
        .container-datos-insertar button[type="submit"]:hover {
            background-color: purple;
        }


        .container-datos,
        .container-datos-modificar, .container-datos-insertar {
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
        <div class="primera-section">
            <div class="imagen-container">
                <?php
                include ("../controller/ImagenesPerfil_Controller.php");

                if (isset($datosImagenesPerfil) && !empty($datosImagenesPerfil)) {
                    foreach ($datosImagenesPerfil as $index => $imagen) {
                        echo '<div class="imagen-perfil-container" style="background-image: url(' . $imagen['url'] . ');"></div>';
                    }
                }
                ?>
            </div>
            <div class="container-estadisticas">
                <div class="usuarios-superlike">
                    <div class="numero-usuarios">
                        <?php
                        include ("../controller/usuariosSuperLike_Controller.php");

                        if (isset($totalUsuariosSuperlike) && !empty($totalUsuariosSuperlike)) {
                            echo '<p>' . $totalUsuariosSuperlike . '</p>';
                        } else {
                            echo '<p>0</p>';
                        }
                        ?>

                    </div>
                    <div class="texto">
                        <h5>USUARIOS SUPERLIKE</h5>
                    </div>

                </div>
                <div class="usuarios-denegados">
                    <div class="numero-usuarios">
                        <?php
                        include ("../controller/usuariosDenegados_Controller.php");

                        if (isset($totalUsuariosDenegados) && !empty($totalUsuariosDenegados)) {
                            echo '<p>' . $totalUsuariosDenegados . '</p>';
                        } else {
                            echo '<p>0</p>';
                        }
                        ?>

                    </div>
                    <div class="texto">
                        <h5>USUARIOS DENEGADOS</h5>
                    </div>
                </div>
                <div class="usuarios-bloqueados">
                    <div class="numero-usuarios">
                        <?php
                        include ("../controller/usuariosBloqueados_Controller.php");

                        if (isset($totalUsuariosBloqueados) && !empty($totalUsuariosBloqueados)) {
                            echo '<p>' . $totalUsuariosBloqueados . '</p>';
                        } else {
                            echo '<p>0</p>';
                        }
                        ?>

                    </div>
                    <div class="texto">
                        <h5>USUARIOS BLOQUEADOS</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-10">

        </div>

        <div class="segunda-section">
            <h2 class="titulo">Detalles del perfil</h2>
            <div class="details-container">
            <?php
// Obtener los detalles del usuario asociado a esta imagen
$_SESSION['idUsuarioImagen'] = $_SESSION['idUsuario'];
include("../controller/usuarioDetalles_Controller.php");

// Presentar los campos de detalles del usuario
foreach ($datosUsuario as $usuario) {
    echo '<h2>' . $usuario['nombre'] . '</h2>';
}
echo '<div class="container-datos">';

if (empty($datosUsuarioDetalles)) {
    echo '<div class="detail"><i class="material-icons">location_on</i> Provincia: <span class="detail-value"></span></div>';
    echo '<div class="detail"><i class="material-icons">public</i> País: <span class="detail-value"></span></div>';
    echo '<div class="detail"><i class="material-icons">home</i> Domicilio: <span class="detail-value"></span></div>';
    echo '<div class="detail"><i class="material-icons">local_post_office</i> Código Postal: <span class="detail-value"></span></div>';
    echo '<div class="detail"><i class="material-icons">location_city</i> Ciudad: <span class="detail-value"></span></div>';
    echo '<div class="detail"><i class="material-icons">color_lens</i> Color Favorito: <span class="detail-value"></span></div>';
    echo '<div class="detail"><i class="material-icons">restaurant</i> Comida Favorita: <span class="detail-value"></span></div>';
    echo '<div class="detail"><i class="material-icons">sports_soccer</i> Deporte Favorito: <span class="detail-value"></span></div>';
    echo '<div class="detail"><i class="material-icons">favorite</i> Hobbie: <span class="detail-value"></span></div>';
    echo '<div class="detail"><i class="material-icons">face</i> Color Piel: <span class="detail-value"></span></div>';
    echo '<div class="detail"><i class="material-icons">height</i> Altura: <span class="detail-value"></span></div>';
    echo '<div class="detail"><i class="material-icons">palette</i> Color Pelo: <span class="detail-value"></span></div>';
    echo '<div class="detail"><i class="material-icons">style</i> Tatuajes: <span class="detail-value"></span></div>';
    echo '<div class="detail"><i class="material-icons">visibility</i> Color Ojos: <span class="detail-value"></span></div>';
    echo '<button id="btnInsertarDatos" type="button">Añadir datos</button>';
} else {
    foreach ($datosUsuarioDetalles as $usuarioDetalles) {
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
        echo '<button id="btnModificarDatos" type="button">Modificar datos</button>';
    }
}

echo '</div>';
?>

                <div class="container-datos-modificar" style="display: none;">
                    <form action="../controller/modificarDetalles_Controller.php" method="POST">
                        <?php foreach ($datosUsuarioDetalles as $usuarioDetalles): ?>
                            <!-- Detalles del perfil -->
                            <div class="detail">
                                <label for="provincia">Provincia:</label>
                                <input type="text" id="provincia" name="provincia"
                                    value="<?= $usuarioDetalles['provincia'] ?>">
                            </div>
                            <div class="detail">
                                <label for="pais">País:</label>
                                <input type="text" id="pais" name="pais" value="<?= $usuarioDetalles['pais'] ?>">
                            </div>
                            <div class="detail">
                                <label for="domicilio">Domicilio:</label>
                                <input type="text" id="domicilio" name="domicilio"
                                    value="<?= $usuarioDetalles['domicilio'] ?>">
                            </div>
                            <div class="detail">
                                <label for="codigoPostal">Código Postal:</label>
                                <input type="text" id="codigoPostal" name="codigoPostal"
                                    value="<?= $usuarioDetalles['codigoPostal'] ?>">
                            </div>
                            <div class="detail">
                                <label for="ciudad">Ciudad:</label>
                                <input type="text" id="ciudad" name="ciudad" value="<?= $usuarioDetalles['ciudad'] ?>">
                            </div>
                            <div class="detail">
                                <label for="colorFavorito">Color Favorito:</label>
                                <input type="text" id="colorFavorito" name="colorFavorito"
                                    value="<?= $usuarioDetalles['colorFavorito'] ?>">
                            </div>
                            <div class="detail">
                                <label for="comidaFavorita">Comida Favorita:</label>
                                <input type="text" id="comidaFavorita" name="comidaFavorita"
                                    value="<?= $usuarioDetalles['comidaFavorita'] ?>">
                            </div>
                            <div class="detail">
                                <label for="deporteFavorito">Deporte Favorito:</label>
                                <input type="text" id="deporteFavorito" name="deporteFavorito"
                                    value="<?= $usuarioDetalles['deporteFavorito'] ?>">
                            </div>
                            <div class="detail">
                                <label for="hobbie">Hobbie:</label>
                                <input type="text" id="hobbie" name="hobbie" value="<?= $usuarioDetalles['hobbie'] ?>">
                            </div>
                            <div class="detail">
                                <label for="colorPiel">Color Piel:</label>
                                <input type="text" id="colorPiel" name="colorPiel"
                                    value="<?= $usuarioDetalles['colorPiel'] ?>">
                            </div>
                            <div class="detail">
                                <label for="altura">Altura:</label>
                                <input type="text" id="altura" name="altura" value="<?= $usuarioDetalles['altura'] ?>">
                            </div>
                            <div class="detail">
                                <label for="colorPelo">Color Pelo:</label>
                                <input type="text" id="colorPelo" name="colorPelo"
                                    value="<?= $usuarioDetalles['colorPelo'] ?>">
                            </div>
                            <div class="detail">
                                <label for="tatuajes">Tatuajes:</label>
                                <input type="text" id="tatuajes" name="tatuajes"
                                    value="<?= $usuarioDetalles['tatuajes'] ?>">
                            </div>
                            <div class="detail">
                                <label for="colorOjos">Color Ojos:</label>
                                <input type="text" id="colorOjos" name="colorOjos"
                                    value="<?= $usuarioDetalles['colorOjos'] ?>">
                            </div>
                        <?php endforeach; ?>
                        <!-- Botón de envío -->
                        <button type="submit">Guardar cambios</button>
                    </form>
                </div>
                <div class="container-datos-insertar" style="display: none;">
                    <form action="../controller/insertarDetalles_Controller.php" method="POST">
                            <!-- Detalles del perfil -->
                            <div class="detail">
                                <label for="provincia">Provincia:</label>
                                <input type="text" id="provincia" name="provincia"
                                    value="">
                            </div>
                            <div class="detail">
                                <label for="pais">País:</label>
                                <input type="text" id="pais" name="pais" value="">
                            </div>
                            <div class="detail">
                                <label for="domicilio">Domicilio:</label>
                                <input type="text" id="domicilio" name="domicilio"
                                    value="">
                            </div>
                            <div class="detail">
                                <label for="codigoPostal">Código Postal:</label>
                                <input type="text" id="codigoPostal" name="codigoPostal"
                                    value="">
                            </div>
                            <div class="detail">
                                <label for="ciudad">Ciudad:</label>
                                <input type="text" id="ciudad" name="ciudad" value="">
                            </div>
                            <div class="detail">
                                <label for="colorFavorito">Color Favorito:</label>
                                <input type="text" id="colorFavorito" name="colorFavorito"
                                    value="">
                            </div>
                            <div class="detail">
                                <label for="comidaFavorita">Comida Favorita:</label>
                                <input type="text" id="comidaFavorita" name="comidaFavorita"
                                    value="">
                            </div>
                            <div class="detail">
                                <label for="deporteFavorito">Deporte Favorito:</label>
                                <input type="text" id="deporteFavorito" name="deporteFavorito"
                                    value="">
                            </div>
                            <div class="detail">
                                <label for="hobbie">Hobbie:</label>
                                <input type="text" id="hobbie" name="hobbie" value="">
                            </div>
                            <div class="detail">
                                <label for="colorPiel">Color Piel:</label>
                                <input type="text" id="colorPiel" name="colorPiel"
                                    value="">
                            </div>
                            <div class="detail">
                                <label for="altura">Altura:</label>
                                <input type="text" id="altura" name="altura" value="">
                            </div>
                            <div class="detail">
                                <label for="colorPelo">Color Pelo:</label>
                                <input type="text" id="colorPelo" name="colorPelo"
                                    value="">
                            </div>
                            <div class="detail">
                                <label for="tatuajes">Tatuajes:</label>
                                <input type="text" id="tatuajes" name="tatuajes"
                                    value="">
                            </div>
                            <div class="detail">
                                <label for="colorOjos">Color Ojos:</label>
                                <input type="text" id="colorOjos" name="colorOjos"
                                    value="">
                            </div>
                        <!-- Botón de envío -->
                        <button type="submit">Guardar cambios</button>
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
                    <li class="nav-item"><a class="nav-link footer" href="./mensajes_view.php">MENSAJES</a></li>
                    <li class="nav-item"><a class="nav-link footer " href="./home_view.php">HOME</a></li>
                    <li class="nav-item"><a class="nav-link footer active" href="./perfil_view.php">PERFIL</a></li>
                    <li class="nav-item"><a class="nav-link footer" href="./ajustes_view.php">AJUSTES</a></li>
                </ul>
            </nav>
        </div>
    </footer>

</body>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Función para mostrar el contenedor de modificar datos
        function mostrarModificarDatos() {
            document.querySelector('.container-datos').style.display = 'none';
            document.querySelector('.container-datos-modificar').style.display = 'block';
        }

        // Función para mostrar el contenedor de insertar datos
        function mostrarInsertarDatos() {
            document.querySelector('.container-datos').style.display = 'none';
            document.querySelector('.container-datos-insertar').style.display = 'block';
        }

        // Verifica si el elemento btnModificarDatos existe antes de agregar el event listener
        var btnModificarDatos = document.getElementById('btnModificarDatos');
        if (btnModificarDatos) {
            btnModificarDatos.addEventListener('click', mostrarModificarDatos);
        } else {
            console.error('No se encontró el botón btnModificarDatos');
        }

        // Verifica si el elemento btnInsertarDatos existe antes de agregar el event listener
        var btnInsertarDatos = document.getElementById('btnInsertarDatos');
        if (btnInsertarDatos) {
            btnInsertarDatos.addEventListener('click', mostrarInsertarDatos);
        } else {
            console.error('No se encontró el botón btnInsertarDatos');
        }
    });
</script>







</html>
<?php
session_start();
//$_SESSION['vistas'] = array();
include ("../controller/main_Controller.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajustes | BumBum</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Moul&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/ajustes.css">
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
        <h2>AJUSTES</h2>
        <div class="space-10"></div>
        <div class="container-ajustes">
            <div class="section-cuenta">
                <h4>CUENTA</h4>
                <hr class="hr">
                <p onclick="toggleSubseccion('subseccion-cuenta')">VER</p>
                <div class="subseccion" id="subseccion-cuenta">
                    <p onclick="mostrarFormularioCambioContrasena()">Cambiar contraseña</p><br>
                    <p id="btnEliminarCuenta">Eliminar cuenta</p><br>
                    <a href="../controller/logout.php">
                        <p>Cerrar sesión</p>
                    </a>
                    <!-- Formulario para eliminar la cuenta -->
                    <form id="formEliminarCuenta" action="../controller/eliminarCuenta_Controller.php" method="POST"
                        style="display:none;">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="submit" value="Eliminar cuenta">
                    </form>
                    <br>
                </div>

                <!-- Contenedor del formulario para cambiar contraseña (inicialmente oculto) -->
                <div id="contenedor-cambio-contrasena" style="display: none;">
                    <div class="formulario-cambio-contrasena">
                        <!-- Aquí irá tu formulario para cambiar la contraseña -->
                        <h5>Cambiar Contraseña</h5>
                        <br>

                        <form action="../controller/modificarContraseña_Controller.php" method="POST">

                            <div class="password-input-container">
                                <input type="password" id="contrasena" name="contrasena" placeholder="Contraseña"
                                    required>
                                <button class="toggle-password-btn"
                                    onclick="togglePasswordVisibility('contrasena', event)">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <br>
                            <div class="password-input-container">
                                <input type="password" id="confirmar_contrasena" name="confirmar_contrasena"
                                    placeholder="Confirmar contraseña" required>
                                <button class="toggle-password-btn"
                                    onclick="togglePasswordVisibility('confirmar_contrasena', event)">
                                    <i class="fas fa-eye"></i>
                                </button>



                            </div><br>
                            <button class="btnModificarDatos" id="btnModificarDatos" type="submit">Guardar
                                Cambios</button>
                        </form>
                    </div>
                    <br>
                </div>

                <p onclick="toggleSubseccion('subseccion-seguridad')">SEGURIDAD</p>
                <div class="subseccion" id="subseccion-seguridad">
                    <p onclick="mostrarActividadReciente()">Verificar actividad reciente</p>
                    <br>
                    <div id="actividad-reciente-container"></div>
                </div>
            </div>
            <br>

            <br>
            <div class="section-notificaciones">
                <h4>NOTIFICACIONES</h4>
                <hr class="hr">
                <p onclick="toggleSubseccion('subseccion-permitir-notificaciones')">PERMITIR NOTIFICACIONES</p>
                <div class="subseccion" id="subseccion-permitir-notificaciones">
                    <p id="permitir" onclick="permitirNotificaciones()">Sí, permitir todas las notificaciones</p><br>
                    <p id="desactivar" onclick="desactivarNotificaciones()">No, desactivar todas las notificaciones</p>
                    <br>
                </div>
            </div>

            <br>
            <div class="section-privacidad">
                <h4>PRIVACIDAD</h4>
                <hr class="hr">
                <a href="./PoliticaPrivacidad_view.php">
                    <p>POLITICA DE PRIVACIDAD</p>
                </a>
            </div>

        </div>


        <footer>
            <div class="container-footer">
                <nav class="footer navbar navbar-expand-lg navbar-dark">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item"><a class="nav-link footer" href="./citas_view.php">CITAS</a></li>
                        <li class="nav-item"><a class="nav-link footer" href="./mensajes_view.php">MENSAJES</a></li>
                        <li class="nav-item"><a class="nav-link footer " href="./home_view.php">HOME</a></li>
                        <li class="nav-item"><a class="nav-link footer " href="./perfil_view.php">PERFIL</a></li>
                        <li class="nav-item"><a class="nav-link footer active" href="./ajustes_view.php">AJUSTES</a>
                        </li>
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
                        <li class="nav-item"><a class="nav-link footer" href="./home_view.php"><i
                                    class="material-icons">home</i></a></li>
                        <li class="nav-item"><a class="nav-link footer" href="./perfil_view.php"><i
                                    class="material-icons">person</i></a></li>
                        <li class="nav-item"><a class="nav-link footer active" href="./ajustes_view.php"><i
                                    class="material-icons">settings</i></a></li>
                    </ul>
                </nav>
            </div>

        </footer>

    </div>
</body>

<script>
    function toggleSubseccion(id) {
        var subseccion = document.getElementById(id);
        if (subseccion.style.display === "none") {
            subseccion.style.display = "block";
        } else {
            subseccion.style.display = "none";
        }
    }

    function mostrarFormularioCambioContrasena() {
        // Ocultar todos los otros contenedores de subsecciones
        var subsecciones = document.getElementsByClassName("subseccion");
        for (var i = 0; i < subsecciones.length; i++) {
            subsecciones[i].style.display = "none";
        }

        // Mostrar el contenedor del formulario de cambio de contraseña
        var contenedor = document.getElementById("contenedor-cambio-contrasena");
        contenedor.style.display = "block";
    }

    // Manejamos la visibilidad de la contraseña y el campo confirmar contraseña
    function togglePasswordVisibility(inputId, event) {
        event.preventDefault();
        var passwordInput = document.getElementById(inputId);

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            passwordInput.nextElementSibling.querySelector("i").classList.remove("fa-eye");
            passwordInput.nextElementSibling.querySelector("i").classList.add("fa-eye-slash");
        } else {
            passwordInput.type = "password";
            passwordInput.nextElementSibling.querySelector("i").classList.remove("fa-eye-slash");
            passwordInput.nextElementSibling.querySelector("i").classList.add("fa-eye");
        }
    }

    function verificarContraseña() {
        var contrasena = document.getElementById("contrasena").value;

        var ConfirmarContrasena = document.getElementById("confirmar_contrasena").value;

        if (contrasena != ConfirmarContrasena) {
            Swal.fire({
                icon: "error",
                title: "¡Oops!",
                text: "Por favor, confirma la contraseña correctamente.",
                confirmButtonColor: "black",
                confirmButtonText: "Entendido",
            });
            return false;
        }
        return true;
    }

    // Evento para mostrar la confirmación antes de eliminar la cuenta
    const btnEliminarCuenta = document.getElementById("btnEliminarCuenta");
    const formEliminarCuenta = document.getElementById("formEliminarCuenta");

    btnEliminarCuenta.addEventListener("click", () => {
        Swal.fire({
            icon: "warning",
            title: "¡Atención!",
            text: "¿Estás seguro de que quieres eliminar tu cuenta?",
            confirmButtonColor: "black",
            confirmButtonText: "Sí, estoy seguro.",
            showCancelButton: true,
            cancelButtonText: "Cancelar",
            cancelButtonColor: "black",
            customClass: {
                title: 'text-black',
                text: 'text-black'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                formEliminarCuenta.submit();
            }
        });
    });

    function mostrarActividadReciente() {
        var contenedor = document.getElementById("actividad-reciente-container");

        if (contenedor.style.display === "block") {
            // Si el contenedor ya está visible, lo ocultamos
            contenedor.style.display = "none";
        } else {
            // Si el contenedor está oculto, hacemos la solicitud AJAX para obtener la actividad reciente
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // La solicitud se ha completado correctamente
                        contenedor.innerHTML = xhr.responseText;
                        contenedor.style.display = "block"; // Mostramos el contenedor
                    } else {
                        // La solicitud falló
                        console.error("Error al obtener la actividad reciente");
                    }
                }
            };
            xhr.open("GET", "../controller/actividadReciente_Controller.php", true);
            xhr.send();
        }
    }

    function toggleSubseccion(id) {
        var subseccion = document.getElementById(id);
        if (subseccion.style.display === "none" || subseccion.style.display === "") {
            subseccion.style.display = "block";
        } else {
            subseccion.style.display = "none";
        }
    }

    function permitirNotificaciones() {
        if (Notification.permission === "granted") {
            alert("Las notificaciones ya están permitidas.");
        } else if (Notification.permission !== "denied") {
            Notification.requestPermission().then(function (permission) {
                if (permission === "granted") {
                    alert("Notificaciones permitidas.");
                    // Enviar una notificación de prueba con un mensaje personalizado
                    new Notification("Notificaciones activadas", {
                        body: "Has activado las notificaciones en tu navegador.",
                        icon: "../assets/img/LogoBumBum.png"
                    });
                }
            });
        }
    }

    function desactivarNotificaciones() {
        alert("Las notificaciones están desactivadas.");

    }

    // Inicialización de estado
    document.addEventListener("DOMContentLoaded", function () {
        var subseccion = document.getElementById("subseccion-permitir-notificaciones");
        subseccion.style.display = "none";
    });


    // Agrega un event listener al botón "Guardar Cambios" para llamar a la función de verificación antes de enviar el formulario
    document.getElementById("btnModificarDatos").addEventListener("click", function (event) {
        // Verificar contraseñas antes de enviar el formulario
        if (!verificarContraseña()) {
            event.preventDefault();
        }
    });

    function adjustMarginTop() {
        var header = document.getElementById('header');
        var containerCenter = document.querySelector('.container-center');
        var headerHeight = header.offsetHeight;
        containerCenter.style.marginTop = (headerHeight + 20) + 'px';
    }

    window.addEventListener('resize', adjustMarginTop);
    window.addEventListener('load', adjustMarginTop);



</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


</html>
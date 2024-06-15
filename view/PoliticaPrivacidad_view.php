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
        }

        .container, .container-footer {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }


        .container img {
            width: 150px;
        }
        .containerMobile{
           display: none;
        }

     

        @media (max-width: 992px) {
            .containerMobile{
                display:flex;
                flex-direction: row;
                justify-content: center;
            }

            .containerMobile ul{
                display:flex;
                flex-direction:row;
            }

            .containerMobile i{
               font-size: 32px;
            }


            .container-footer{
            display:none;
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
            <h2>POLÍTICA DE PRIVACIDAD</h2>
        </div>
        <p>Política de privacidad de BumBum<br><br>

            En BumBum, valoramos y respetamos tu privacidad. Esta Política de Privacidad describe cómo recopilamos,
            usamos y protegemos la información personal que nos proporcionas a través de nuestro sitio web y aplicación
            móvil. Al utilizar nuestros servicios, aceptas los términos y condiciones de esta política.<br><br>

            <b> 1. Información que Recopilamos</b><br><br>

            Información de Registro: Al crear una cuenta en BumBum, recopilamos información como tu nombre, dirección de
            correo electrónico, fecha de nacimiento, género, preferencias de citas y otros detalles necesarios para
            proporcionar nuestros servicios.<br><br>

            Información del Perfil: Puedes optar por proporcionar información adicional en tu perfil, como fotos,
            descripción personal, intereses y preferencias.<br><br>

            Información de Actividad: Recopilamos información sobre tu actividad en nuestra plataforma, incluidas tus
            interacciones con otros usuarios, mensajes enviados, perfiles visitados y otras acciones realizadas en
            nuestro sitio web y aplicación.<br><br>

            Información de Dispositivos: Podemos recopilar información técnica sobre tu dispositivo, como tu dirección
            IP, tipo de navegador, sistema operativo, proveedor de servicios de Internet y otros datos
            similares.<br><br>

            <b>2. Uso de la Información</b><br><br>

            Utilizamos la información que recopilamos para los siguientes fines:<br><br>

            Proporcionar y Mejorar Nuestros Servicios: Utilizamos la información para ofrecerte una experiencia
            personalizada en nuestra plataforma, facilitar conexiones entre usuarios, mejorar nuestros servicios y
            desarrollar nuevas características.<br><br>

            Comunicación: Utilizamos tu dirección de correo electrónico para enviarte notificaciones, actualizaciones de
            la cuenta, mensajes importantes y otras comunicaciones relacionadas con el servicio.<br><br>

            Seguridad: Utilizamos la información para proteger la seguridad y la integridad de nuestra plataforma,
            prevenir actividades fraudulentas y garantizar el cumplimiento de nuestras políticas.<br><br>

            <b> 3. Compartir Información</b><br><br>

            Compartimos tu información con terceros solo en la medida necesaria para proporcionar nuestros servicios,
            cumplir con las obligaciones legales, proteger nuestros derechos o en respuesta a solicitudes legales
            válidas.<br><br>

            No vendemos, alquilamos ni compartimos tu información personal con terceros con fines publicitarios sin tu
            consentimiento explícito.<br><br>

            <b>4. Cookies y Tecnologías Similares</b><br><br>

            Utilizamos cookies y tecnologías similares para recopilar datos de navegación, mejorar la funcionalidad del
            sitio web, personalizar tu experiencia y proporcionar anuncios relevantes. Puedes gestionar tus preferencias
            de cookies a través de la configuración de tu navegador.<br><br>

            <b> 5. Seguridad de la Información</b><br><br>

            Implementamos medidas de seguridad técnicas y organizativas para proteger tus datos personales contra el
            acceso no autorizado, el uso indebido, la alteración o la divulgación.<br><br>

            <b>6. Tus Derechos y Opciones</b><br><br>

            Tienes derecho a acceder, corregir, actualizar o eliminar tu información personal. También puedes optar por
            no recibir ciertas comunicaciones de nuestra parte. Para ejercer tus derechos de privacidad o para obtener
            más información sobre nuestras prácticas de privacidad, contáctanos utilizando la información proporcionada
            al final de esta política. <br><br>

            <b>7. Cambios en esta Política</b> <br><br>

            Nos reservamos el derecho de actualizar esta Política de Privacidad en cualquier momento. Te notificaremos
            sobre cambios significativos mediante una notificación en nuestro sitio web o por otros medios antes de que
            los cambios entren en vigencia. <br><br>

            <b>8. Contacto</b><br><br>

            Si tienes preguntas, comentarios o inquietudes sobre esta Política de Privacidad o nuestras prácticas de
            privacidad, no dudes en contactarnos a través de cris11salle@gmail.com.
        </p>

    </div>

    <footer>
        <div class="container-footer">
            <nav class="navbar navbar-expand-lg navbar-dark">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link footer" href="./citas_view.php">CITAS</a></li>
                    <li class="nav-item"><a class="nav-link footer" href="./mensajes_view.php">MENSAJES</a></li>
                    <li class="nav-item"><a class="nav-link footer " href="./home_view.php">HOME</a></li>
                    <li class="nav-item"><a class="nav-link footer" href="./perfil_view.php">PERFIL</a></li>
                    <li class="nav-item"><a class="nav-link footer active" href="./ajustes_view.php">AJUSTES</a></li>
                </ul>
            </nav>
        </div>
        <div class="containerMobile">
            <nav class="footerMobile navbar navbar-expand-lg navbar-dark">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item"><a class="nav-link footer" href="./citas_view.php"><i class="material-icons">calendar_today</i></a></li>
                        <li class="nav-item"><a class="nav-link footer" href="./mensajes_view.php"><i class="material-icons">message</i></a></li>
                        <li class="nav-item"><a class="nav-link footer" href="./home_view.php"><i class="material-icons">home</i></a></li>
                        <li class="nav-item"><a class="nav-link footer" href="./perfil_view.php"><i class="material-icons">person</i></a></li>
                        <li class="nav-item"><a class="nav-link footer active" href="./ajustes_view.php"><i class="material-icons">settings</i></a></li>
                    </ul>
    </nav>
            </div>
           
    </footer>

</body>


</html>
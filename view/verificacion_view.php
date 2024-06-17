<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/verificacion.css">
    <link rel="stylesheet" href="../assets/css/estilo.css">
    <link rel="icon" type="image/x-icon" href="../assets/img/LogoBumBum.png">


    <title>Verificación | BumBum</title>
</head>
<style>
    @media (max-width: 700px) {
        .logoimg {
            display: block;
        }

        .portada {
            display: none;
        }

        .formulario {
            width: 100%;

        }

        .login-form {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;

        }
    }
</style>

<body>
    <section class="portada">
        <img src="../assets/img/logoBumBum.png" alt="">
        <div class="eslogan">"Encuentra tu chispa"</div>
    </section>

    <!-- Capa de color con opacidad -->
    <div class="formulario-overlay"></div>

    <!-- Imagen de fondo -->
    <img src="../assets/img/fondoLogin.webp" class="formulario-background" alt="">

    <section class="formulario">
        <div class="container-form">
            <form class="login-form" action="../controller/verificacion_Controller.php" method="POST"
                onsubmit="eliminarEspacios()">
                <img class="logoimg" src="../assets/img/logoBumBum.png" alt="">
                <h3 class="titulo-formulario">Introduce tu código de verificación</h3>
                <input type="text" id="cod_verificacion" name="cod_verificacion" placeholder="Código de verificación"
                    required><br><br>
                <button class="botones" type="submit">Verificar</button>
            </form>
        </div>
    </section>
    <script src="../assets/js/login.js"> </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../assets/scss/estilo.css">
    <title>Inicio de Sesión | BumBum</title>
</head>
<style>
    /* Estilos para la capa de color con opacidad */
    .formulario-overlay {
        position: relative;
        top: 0;
        right: 50px;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1;

    }

    /* Estilos para la imagen */
    .formulario-background {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1;

    }

    /* Ajusta el formulario para que esté encima de la capa de color */
    .container-form {
        position: relative;
        z-index: 2;

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
            <form class="login-form" action="../controller/login_Controller.php" method="POST">
                <h3 class="titulo-formulario">INICIO DE SESIÓN</h3>
                <input type="text" id="usuario" name="usuario" placeholder="Usuario o Email" required><br><br>
                <div class="password-input-container">
                    <input type="password" id="contrasena" name="contrasena" placeholder="Contraseña" required>
                    <button class="toggle-password-btn" onclick="togglePasswordVisibility()">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                <button class="botones" type="submit">Entrar</button>
                <a href="/">¿Olvidaste tu contraseña?</a>
                <a href="./register_view.php"><button class="botones" type="button" className="create-account-btn">
                        Crea una cuenta
                    </button></a>
            </form>
        </div>
    </section>
    <script src="../assets/js/login.js"> </script>
</body>
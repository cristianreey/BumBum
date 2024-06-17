<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/register.css">
    <link rel="stylesheet" href="../assets/css/estilo.css">
    <link rel="icon" type="image/x-icon" href="../assets/img/LogoBumBum.png">



    <title>Registro | BumBum</title>
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
            height: auto;
            padding-bottom: 20px;
        }

        .formulario-background {
            width: 100%;
            height: 100%;
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
    <img src="../assets/img/fondoLogin.webp" class="formulario-background" id="formulario-background" alt="">
    <section class="formulario">
        <div class="container-form">
            <form class="registro-form" action="../controller/registro_Controller.php" method="POST">
                <img class="logoimg" src="../assets/img/logoBumBum.png" alt="">
                <h3 class="titulo-formulario">Crea tu cuenta</h3>
                <input type="text" id="nombre" name="nombre" placeholder="Nombre" required><br>
                <input type="text" id="apellido1" name="apellido1" placeholder="Primer apellido" required><br>
                <input type="text" id="apellido2" name="apellido2" placeholder="Segundo apellido" required><br>
                <input type="email" id="email" name="email" placeholder="Email" required><br>
                <div class="password-input-container">
                    <input type="password" id="contrasena" name="contrasena" placeholder="Contraseña" required>
                    <button class="toggle-password-btn" onclick="togglePasswordVisibility('contrasena')">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                <div class="password-input-container">
                    <input type="password" id="confirmar_contrasena" name="confirmar_contrasena"
                        placeholder="Confirmar contraseña" required> <button class="toggle-password-btn"
                        onclick="togglePasswordVisibility('confirmar_contrasena')">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                <input type="date" id="fechaNacimiento" name="fechaNacimiento" placeholder="Fecha de Nacimiento"
                    required><br>
                <input type="text" id="telefono" name="telefono" placeholder="Teléfono" required><br><br>
                <button class="botones" type="submit">Crea una cuenta</button>
            </form>
        </div>
    </section>
    <script src="../assets/js/login.js"> </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</body>
<script>
    function adjustMarginTop() {
        var foto = document.getElementById('formulario-background');
        var formulario = document.querySelector('.formulario');
        var headerHeight = formulario.offsetHeight;
        foto.style.height = (headerHeight) + 'px';
    }

    window.addEventListener('resize', adjustMarginTop);
    window.addEventListener('load', adjustMarginTop);
</script>

</html>
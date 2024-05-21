<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../assets/scss/estilo.css">
    <title>Registro | BumBum</title>
</head>

<style>
    /* Estilos personalizados para los inputs */
    input[type="text"],
    input[type="email"],
    input[type="password"],
    input[type="date"] {
        width: 90%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        transition: border-color 0.3s ease;
        font-size: 16px;
    }

    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="password"]:focus,
    input[type="date"]:focus {
        border-color: #6cb2eb;
        outline: none;
    }

    /* Estilo para el botón */
    .botones {
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 5px;
        background-color: purple;
        color: #fff;
        font-size: 18px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .botones:hover {
        background-color: black;
    }

    .password-input-container {
        position: relative;
    }

    .toggle-password-btn {
        position: absolute;
        right: 20px;
        top: 35%;
        transform: translateY(-50%);
        cursor: pointer;
        font-size: 20px;
        color: #555;
        background: none;
        border: none;
        padding: 0;
    }

    .toggle-password-btn:focus {
        outline: none;
    }

    .toggle-password-btn i {
        pointer-events: none;
    }


    .toggle-password-btn i {
        font-size: inherit;
    }

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
            <form class="registro-form" action="../controller/registro_Controller.php" method="POST">
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

</html>
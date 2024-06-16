<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="../assets/css/verificacion.css">
    <link rel="stylesheet" href="../assets/css/estilo.css">


    <title>Verificación | BumBum</title>
    <style>

    </style>
</head>

<script>
    function eliminarEspacios() {
        var inputCodigo = document.getElementById("cod_verificacion");
        inputCodigo.value = inputCodigo.value.replace(/\s/g, '');
    }
</script>

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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        // Obtener el parámetro 'error' de la URL
        const urlParams = new URLSearchParams(window.location.search);
        const error = urlParams.get("error");

        // Mostrar una alerta si 'error' es 'true'
        if (error === "true") {
            // Alerta con SweetAlert2 si el formato del teléfono es incorrecto
            Swal.fire({
                icon: "error",
                title: "¡Oops!",
                text: "Por favor, Vuelve a introducir el código de verificación correcto.",
                confirmButtonColor: "black",
                confirmButtonText: "Entendido",
            });

        }
    </script>
</body>

</html>
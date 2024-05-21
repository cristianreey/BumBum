<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | BumBum</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Moul&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: "Moul", serif;
        }

        /* Estilo personalizado para el footer */
        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #0A203D;
            color: white;
            text-align: center;
            padding: 15px 0;
            font-weight: 400;
            font-size: 20px;

        }

        footer ul {
            gap: 30px;
        }

        .footer {
            color: white !important;
        }

        /* Estilo personalizado para la cabecera */
        .header {
            position: fixed;
            top: 0;
            width: 100%;
            background-color: #EDEEF6;
            padding: 10px 0;
            height: 130px;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .container-body {
            margin-top: 9%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: #0A203D;
        }

        .container img {
            width: 150px;
        }

        .checkbox-custom {
            display: none;
        }

        .checkbox-label {
            cursor: pointer;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin: 5px;
            color: #5C697E;
        }

        .checkbox-label:hover {
            background-color: #f0f0f0;
        }

        .checkbox-label.checked {
            background-color: #0A203D;
            color: white;
        }

        .checkbox-container {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            gap: 20px;

        }
    </style>
</head>

<body>

    <div class="header">
        <div class="container">
            <img src="../assets/img/logoBumBum.png" alt="Logo" class="img-fluid">
        </div>
    </div>

    <div class="container-body">
        <h4>¿CÓMO QUIERES FILTRAR TUS RESULTADOS?</h4>
        <div class="checkbox-container">
            <label class="checkbox-label" for="checkbox1">
                <input type="checkbox" class="checkbox-custom" id="checkbox1" onchange="toggleCheckbox(this)">
                COLOR PELO
            </label>
            <label class="checkbox-label" for="checkbox2">
                <input type="checkbox" class="checkbox-custom" id="checkbox2" onchange="toggleCheckbox(this)">
                PROVINCIA
            </label>
            <label class="checkbox-label" for="checkbox3">
                <input type="checkbox" class="checkbox-custom" id="checkbox3" onchange="toggleCheckbox(this)">
                COLOR OJOS
            </label>
            <label class="checkbox-label" for="checkbox4">
                <input type="checkbox" class="checkbox-custom" id="checkbox4" onchange="toggleCheckbox(this)">
                ALTURA
            </label>
            <label class="checkbox-label" for="checkbox5">
                <input type="checkbox" class="checkbox-custom" id="checkbox5" onchange="toggleCheckbox(this)">
                DEPORTE
            </label>
            <label class="checkbox-label" for="checkbox6">
                <input type="checkbox" class="checkbox-custom" id="checkbox6" onchange="toggleCheckbox(this)">
                COMIDA
            </label>
        </div>
        <div class="image-container">
            <?php
            include ('../controller/ImagenesHome_Controller.php');

            foreach ($datosCliente as $imagen) {
                echo '<img src="<?php echo $imagen["url"]; ?>" alt="Imagen">';
            }


            ?>


        </div>
    </div>

    <footer>
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link footer" href="#">CITAS</a></li>
                    <li class="nav-item"><a class="nav-link footer" href="#">MENSAJES</a></li>
                    <li class="nav-item"><a class="nav-link footer" href="./home_view.php">HOME</a></li>
                    <li class="nav-item"><a class="nav-link footer" href="#">PERFIL</a></li>
                    <li class="nav-item"><a class="nav-link footer" href="#">AJUSTES</a></li>
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
</script>

</html>